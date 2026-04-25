<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\Dispute;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $userId = auth()->id();

        $totalBills     = Bill::where('user_id', $userId)->count();
        $analyzedBills  = Bill::where('user_id', $userId)->where('status', 'analyzed')->count();
        $totalSavings   = Bill::where('user_id', $userId)
            ->whereHas('analysis', fn ($q) => $q->where('status', 'completed'))
            ->with('analysis')
            ->get()
            ->sum(fn ($b) => $b->analysis?->overcharge_amount ?? 0);
        $activeDisputes = Dispute::where('user_id', $userId)
            ->whereIn('status', ['draft', 'sent', 'in_review'])
            ->count();

        $recentBills = Bill::where('user_id', $userId)
            ->with('analysis')
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('livewire.dashboard', compact(
            'totalBills', 'analyzedBills', 'totalSavings', 'activeDisputes', 'recentBills'
        ))->layout('layouts.dashboard', ['pageTitle' => 'Overview']);
    }
}
