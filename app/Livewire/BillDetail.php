<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Dispute;
use App\Services\PdfReportService;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class BillDetail extends Component
{
    public Bill $bill;
    public bool $showDisputeModal = false;
    public string $disputeNotes   = '';

    public function mount(Bill $bill): void
    {
        abort_unless($bill->user_id === auth()->id(), 403);
        $this->bill = $bill->load(['analysis', 'provider', 'dispute']);
    }

    public function render()
    {
        return view('livewire.bill-detail')
            ->layout('layouts.dashboard', ['pageTitle' => 'Bill Details']);
    }

    public function generateReport(): void
    {
        abort_unless($this->bill->user_id === auth()->id(), 403);

        if (!$this->bill->analysis) {
            session()->flash('error', 'No analysis available for this bill.');
            return;
        }

        app(PdfReportService::class)->generateReport($this->bill->analysis);
        $this->bill = $this->bill->fresh(['analysis', 'provider', 'dispute']);
        session()->flash('success', 'Report generated successfully.');
    }

    public function createDispute(): void
    {
        abort_unless($this->bill->user_id === auth()->id(), 403);

        if (!$this->bill->analysis) {
            return;
        }

        Dispute::create([
            'bill_id'          => $this->bill->id,
            'user_id'          => auth()->id(),
            'bill_analysis_id' => $this->bill->analysis->id,
            'status'           => 'draft',
            'notes'            => $this->disputeNotes,
        ]);

        $this->bill->update(['status' => 'disputed']);
        $this->bill = $this->bill->fresh(['analysis', 'provider', 'dispute']);

        $this->showDisputeModal = false;
        $this->disputeNotes     = '';
        session()->flash('success', 'Dispute created successfully. You can download the dispute letter below.');
    }

    public function reanalyze(): void
    {
        abort_unless($this->bill->user_id === auth()->id(), 403);

        $this->bill->update(['status' => 'uploaded']);
        \App\Jobs\AnalyzeBillJob::dispatch($this->bill);
        session()->flash('success', 'Re-analysis started. Please check back in a few minutes.');
    }
}
