<?php

namespace App\Jobs;

use App\Models\Bill;
use App\Services\BillAnalysisService;
use App\Services\PdfReportService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AnalyzeBillJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Bill $bill) {}

    public function handle(BillAnalysisService $analysisService, PdfReportService $reportService): void
    {
        try {
            $analysis = $analysisService->analyze($this->bill);
            $reportService->generateReport($analysis);
            $reportService->generateDisputeLetter($analysis);
            
            Log::info('Bill analysis job completed', ['bill_id' => $this->bill->id]);
        } catch (\Throwable $e) {
            Log::error('Bill analysis job failed', ['bill_id' => $this->bill->id, 'error' => $e->getMessage()]);
            throw $e;
        }
    }
}
