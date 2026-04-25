<?php

namespace App\Livewire;

use App\Models\Dispute;
use Livewire\Component;
use Livewire\WithPagination;

class Disputes extends Component
{
    use WithPagination;

    public string $filterStatus = '';

    public function render()
    {
        $disputes = Dispute::where('user_id', auth()->id())
            ->with(['bill', 'analysis'])
            ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.disputes', compact('disputes'))
            ->layout('layouts.dashboard', ['pageTitle' => 'My Disputes']);
    }

    public function markSent(int $disputeId): void
    {
        $dispute = Dispute::where('id', $disputeId)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $dispute->update(['status' => 'sent', 'sent_at' => now()]);
        $dispute->bill->update(['status' => 'disputed']);
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }
}
