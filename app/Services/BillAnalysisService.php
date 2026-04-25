<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\BillAnalysis;
use EchoLabs\Prism\Prism;
use EchoLabs\Prism\Enums\Provider;
use Illuminate\Support\Facades\Log;
use Spatie\PdfToText\Pdf;

class BillAnalysisService
{
    public function analyze(Bill $bill): BillAnalysis
    {
        $analysis = BillAnalysis::create([
            'bill_id' => $bill->id,
            'currency' => $bill->currency,
            'status' => 'pending',
        ]);

        try {
            $text = $this->extractText($bill);

            $bill->update(['extracted_text' => $text, 'status' => 'processing']);

            $result = $this->callAI($text, $bill->currency, $bill->utility_type);

            $analysis->update([
                'errors' => $result['errors'] ?? [],
                'overcharge_amount' => $result['overcharge_amount'] ?? 0,
                'dispute_letter' => $result['dispute_letter'] ?? '',
                'ai_response' => $result,
                'status' => 'completed',
            ]);

            $bill->update(['status' => 'analyzed']);
        } catch (\Throwable $e) {
            Log::error('Bill analysis failed', ['bill_id' => $bill->id, 'error' => $e->getMessage()]);
            $analysis->update(['status' => 'failed']);
            $bill->update(['status' => 'failed']);
            throw $e;
        }

        return $analysis->fresh();
    }

    private function extractText(Bill $bill): string
    {
        if ($bill->extracted_text) {
            return $bill->extracted_text;
        }

        $media = $bill->getFirstMedia('bill');
        if (!$media) {
            throw new \RuntimeException('No bill file attached.');
        }

        return Pdf::getText($media->getPath());
    }

    private function callAI(string $billText, string $currency, string $utilityType): array
    {
        $currencySymbol = match (strtoupper($currency)) {
            'GBP' => '£',
            'CAD' => 'CA$',
            default => '$',
        };

        $prompt = <<<PROMPT
You are a utility bill auditing expert. Analyze this {$utilityType} utility bill and identify any errors, overcharges, or billing discrepancies.

Bill text:
{$billText}

Respond ONLY with valid JSON in this exact format:
{
  "errors": [
    {"type": "string", "description": "string", "amount": number}
  ],
  "overcharge_amount": number,
  "summary": "string",
  "dispute_letter": "string (formal letter to the utility company disputing the charges)"
}

Currency is {$currency} ({$currencySymbol}). Be precise and professional.
PROMPT;

        $response = Prism::text()
            ->using(Provider::Anthropic, 'claude-3-5-sonnet-20241022')
            ->withPrompt($prompt)
            ->generate();

        $json = $response->text;

        // Strip markdown code fences if present
        $json = preg_replace('/^```json\s*|\s*```$/s', '', trim($json));

        return json_decode($json, true) ?? ['errors' => [], 'overcharge_amount' => 0, 'dispute_letter' => $json];
    }
}
