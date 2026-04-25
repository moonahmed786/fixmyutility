<?php

namespace App\Livewire;

use App\Models\Bill;
use App\Models\UtilityProvider;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Bills extends Component
{
    use WithFileUploads, WithPagination;

    public bool  $showUploadModal = false;
    public        $billFile;
    public string $utilityType    = 'electricity';
    public string $currency       = 'USD';
    public ?int   $utilityProviderId = null;
    public string $filterStatus   = '';

    protected function rules(): array
    {
        return [
            'billFile'           => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'utilityType'        => 'required|in:electricity,gas,water,internet,other',
            'currency'           => 'required|in:USD,GBP,CAD',
            'utilityProviderId'  => 'nullable|exists:utility_providers,id',
        ];
    }

    public function mount(): void
    {
        $this->currency = auth()->user()->currency ?? 'USD';
    }

    public function render()
    {
        $bills = Bill::where('user_id', auth()->id())
            ->with(['analysis', 'provider'])
            ->when($this->filterStatus, fn ($q) => $q->where('status', $this->filterStatus))
            ->orderByDesc('created_at')
            ->paginate(10);

        $providers = UtilityProvider::where('is_active', true)->orderBy('name')->get();

        return view('livewire.bills', compact('bills', 'providers'))
            ->layout('layouts.dashboard', ['pageTitle' => 'My Bills']);
    }

    public function uploadBill(): void
    {
        $this->validate();

        $bill = Bill::create([
            'user_id'              => auth()->id(),
            'utility_type'         => $this->utilityType,
            'currency'             => $this->currency,
            'utility_provider_id'  => $this->utilityProviderId,
            'status'               => 'uploaded',
        ]);

        $bill->addMedia($this->billFile->getRealPath())
            ->usingFileName('bill-' . $bill->id . '.' . $this->billFile->getClientOriginalExtension())
            ->toMediaCollection('bill');

        \App\Jobs\AnalyzeBillJob::dispatch($bill);

        $this->reset(['billFile', 'utilityProviderId']);
        $this->showUploadModal = false;

        session()->flash('success', 'Bill uploaded! AI analysis will begin shortly.');
    }

    public function updatedFilterStatus(): void
    {
        $this->resetPage();
    }
}
