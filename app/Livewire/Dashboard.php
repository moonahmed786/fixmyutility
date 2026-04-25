<?php

namespace App\Livewire;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use WithFileUploads;

    public $showUploadModal = false;
    public $billFile;
    public $utilityType = 'electricity';
    public $currency = 'USD';

    public function render()
    {
        $bills = Bill::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.dashboard', [
            'bills' => $bills,
        ])->layout('layouts.app');
    }

    public function uploadBill()
    {
        $this->validate([
            'billFile' => 'required|mimes:pdf,jpg,png|max:10240',
            'utilityType' => 'required',
            'currency' => 'required',
        ]);

        $bill = Bill::create([
            'user_id' => auth()->id(),
            'utility_type' => $this->utilityType,
            'currency' => $this->currency,
            'status' => 'uploaded',
        ]);

        $bill->addMedia($this->billFile->getRealPath())
            ->toMediaCollection('bill');

        \App\Jobs\AnalyzeBillJob::dispatch($bill);

        $this->showUploadModal = false;
        $this->billFile = null;

        session()->flash('message', 'Bill uploaded successfully! Analysis will start shortly.');
    }
}
