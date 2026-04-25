<div>
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <p class="text-dark/50 text-sm mt-1">Upload, track, and manage your utility bills.</p>
        </div>
        <button wire:click="$set('showUploadModal', true)" class="btn-primary py-2.5 px-6 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Upload New Bill
        </button>
    </div>

    {{-- Session flash --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl text-sm font-medium">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Filter --}}
    <div class="mb-5 flex items-center gap-3 flex-wrap">
        @foreach([''=>'All', 'uploaded'=>'Uploaded', 'processing'=>'Processing', 'analyzed'=>'Analyzed', 'disputed'=>'Disputed', 'resolved'=>'Resolved'] as $val => $label)
            <button wire:click="$set('filterStatus', '{{ $val }}')"
                    class="px-4 py-1.5 rounded-full text-xs font-bold transition border
                           {{ $filterStatus === $val
                               ? 'bg-primary text-white border-primary'
                               : 'bg-white text-dark/60 border-secondary/20 hover:border-primary/30 hover:text-dark' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    {{-- Bills Table --}}
    <div class="card overflow-hidden">
        @if($bills->isEmpty())
            <div class="py-20 text-center">
                <div class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-secondary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-dark/50 font-medium mb-4">
                    {{ $filterStatus ? 'No bills with this status.' : 'No bills uploaded yet.' }}
                </p>
                @if(!$filterStatus)
                    <button wire:click="$set('showUploadModal', true)" class="btn-primary py-2.5 px-6 text-sm">
                        Upload Your First Bill
                    </button>
                @endif
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary/10">
                    <thead class="bg-background">
                        <tr>
                            <th class="table-header">Date</th>
                            <th class="table-header">Utility Type</th>
                            <th class="table-header">Provider</th>
                            <th class="table-header">Status</th>
                            <th class="table-header">Savings Found</th>
                            <th class="table-header text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-secondary/10">
                        @foreach($bills as $bill)
                        <tr class="hover:bg-background/60 transition">
                            <td class="table-cell font-medium">{{ $bill->created_at->format('M d, Y') }}</td>
                            <td class="table-cell">
                                <span class="capitalize inline-flex items-center gap-2">
                                    @switch($bill->utility_type)
                                        @case('electricity')
                                            <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                            @break
                                        @case('gas')
                                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.98 7.98 0 01-2.343 5.657z"/></svg>
                                            @break
                                        @case('water')
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 0v20M2 12h20"/></svg>
                                            @break
                                        @default
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    @endswitch
                                    {{ ucfirst($bill->utility_type) }}
                                </span>
                            </td>
                            <td class="table-cell text-dark/60">{{ $bill->provider?->name ?? '—' }}</td>
                            <td class="table-cell">
                                @switch($bill->status)
                                    @case('analyzed')  <span class="badge-success">Analyzed</span>  @break
                                    @case('processing') <span class="badge-info">Processing</span>  @break
                                    @case('disputed')  <span class="badge-warning">Disputed</span>  @break
                                    @case('resolved')  <span class="badge-success">Resolved</span>  @break
                                    @case('failed')    <span class="badge-danger">Failed</span>     @break
                                    @default           <span class="badge-default">{{ ucfirst($bill->status) }}</span>
                                @endswitch
                            </td>
                            <td class="table-cell font-bold {{ ($bill->analysis?->overcharge_amount ?? 0) > 0 ? 'text-green-600' : 'text-dark/40' }}">
                                {{ ($bill->analysis?->overcharge_amount ?? 0) > 0
                                    ? ($bill->currency . ' ' . number_format($bill->analysis->overcharge_amount, 2))
                                    : '—' }}
                            </td>
                            <td class="table-cell text-right">
                                <a href="{{ route('bills.show', $bill->id) }}"
                                   class="text-primary font-semibold text-sm hover:underline">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-secondary/10">
                {{ $bills->links() }}
            </div>
        @endif
    </div>

    {{-- ─── Upload Modal ─────────────────────────────────────────────── --}}
    @if($showUploadModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-dark/50 backdrop-blur-sm"
         x-data x-on:keydown.escape.window="$wire.set('showUploadModal', false)">
        <div class="bg-white rounded-2xl p-8 max-w-lg w-full shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-heading text-2xl font-bold text-dark">Upload Bill for Analysis</h2>
                <button wire:click="$set('showUploadModal', false)"
                        class="text-dark/30 hover:text-dark transition p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <form wire:submit.prevent="uploadBill" class="space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="form-label">Utility Type</label>
                        <select wire:model="utilityType"
                                class="form-input">
                            <option value="electricity">⚡ Electricity</option>
                            <option value="gas">🔥 Gas</option>
                            <option value="water">💧 Water</option>
                            <option value="internet">🌐 Internet</option>
                            <option value="other">📄 Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="form-label">Currency</label>
                        <select wire:model="currency" class="form-input">
                            <option value="USD">USD ($)</option>
                            <option value="GBP">GBP (£)</option>
                            <option value="CAD">CAD (CA$)</option>
                        </select>
                    </div>
                </div>

                @if($providers->isNotEmpty())
                <div>
                    <label class="form-label">Utility Provider <span class="text-dark/40 font-normal">(optional)</span></label>
                    <select wire:model="utilityProviderId" class="form-input">
                        <option value="">Select provider…</option>
                        @foreach($providers as $provider)
                            <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div>
                    <label class="form-label">Bill File</label>
                    <div class="mt-1 border-2 border-dashed border-secondary/30 rounded-xl p-6 text-center hover:border-primary/40 transition"
                         x-data="{ dragging: false }"
                         @dragover.prevent="dragging = true"
                         @dragleave.prevent="dragging = false"
                         :class="dragging ? 'border-primary bg-primary/5' : ''">
                        <input type="file" wire:model="billFile"
                               class="absolute opacity-0 w-0 h-0"
                               id="billFileInput"
                               accept=".pdf,.jpg,.jpeg,.png">
                        <label for="billFileInput" class="cursor-pointer">
                            <svg class="w-10 h-10 text-secondary/50 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            <p class="text-sm font-semibold text-dark/70">
                                @if($billFile)
                                    <span class="text-primary">{{ $billFile->getClientOriginalName() }}</span>
                                @else
                                    <span class="text-primary">Click to upload</span> or drag & drop
                                @endif
                            </p>
                            <p class="text-xs text-dark/40 mt-1">PDF, JPG, PNG up to 10MB</p>
                        </label>
                    </div>
                    @error('billFile')
                        <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" wire:click="$set('showUploadModal', false)"
                            class="flex-1 py-3 border border-secondary/30 text-dark/60 rounded-xl font-semibold hover:bg-background transition text-sm">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 btn-primary py-3 text-sm">
                        <span wire:loading.remove>Start AI Analysis</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Uploading…
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
