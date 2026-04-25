<?php

namespace App\Services;

use App\Models\BillAnalysis;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfReportService
{
    public function generateReport(BillAnalysis $analysis): string
    {
        $pdf = Pdf::loadView('pdf.bill-report', ['analysis' => $analysis, 'bill' => $analysis->bill]);

        $filename = "reports/bill-{$analysis->bill_id}-report.pdf";
        Storage::disk('local')->put($filename, $pdf->output());

        $analysis->update(['report_pdf_path' => $filename]);

        return $filename;
    }

    public function generateDisputeLetter(BillAnalysis $analysis): string
    {
        $pdf = Pdf::loadView('pdf.dispute-letter', ['analysis' => $analysis, 'bill' => $analysis->bill]);

        $filename = "disputes/bill-{$analysis->bill_id}-dispute.pdf";
        Storage::disk('local')->put($filename, $pdf->output());

        return $filename;
    }
}
