<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-dark">My Dashboard</h1>
            <button wire:click="$set('showUploadModal', true)" class="btn-primary flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Upload New Bill
            </button>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
                <p>{{ session('message') }}</p>
            </div>
        @endif

        <!-- Bills List -->
        <div class="bg-white rounded-2xl shadow-sm border border-secondary/10 overflow-hidden">
            <table class="min-w-full divide-y divide-secondary/10">
                <thead class="bg-background">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-dark/60 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-dark/60 uppercase tracking-wider">Utility</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-dark/60 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-dark/60 uppercase tracking-wider">Savings</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-dark/60 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-secondary/10">
                    @forelse($bills as $bill)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-dark">{{ $bill->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-dark capitalize">{{ $bill->utility_type }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs font-bold rounded-full 
                                @if($bill->status == 'analyzed') bg-green-100 text-green-700 
                                @elseif($bill->status == 'processing') bg-blue-100 text-blue-700 
                                @else bg-gray-100 text-gray-700 @endif">
                                {{ ucfirst($bill->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold @if($bill->analysis && $bill->analysis->overcharge_amount > 0) text-green-600 @else text-dark @endif">
                            {{ $bill->analysis ? $bill->currency . ' ' . number_format($bill->analysis->overcharge_amount, 2) : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if($bill->analysis && $bill->analysis->report_pdf_path)
                                <a href="{{ Storage::url($bill->analysis->report_pdf_path) }}" class="text-primary hover:text-dark transition mr-4" target="_blank">View Report</a>
                            @endif
                            <a href="#" class="text-secondary hover:text-dark transition">Details</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-dark/50">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 mb-4 text-secondary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <p>No bills uploaded yet.</p>
                                <button wire:click="$set('showUploadModal', true)" class="mt-4 text-primary font-bold">Upload your first bill</button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Upload Modal (Simplified) -->
        @if($showUploadModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-dark/50 backdrop-blur-sm">
            <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Upload Bill</h2>
                    <button wire:click="$set('showUploadModal', false)" class="text-dark/40 hover:text-dark">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="uploadBill" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2">Utility Type</label>
                        <select wire:model="utilityType" class="w-full border-secondary/20 rounded-lg p-2 focus:ring-primary focus:border-primary">
                            <option value="electricity">Electricity</option>
                            <option value="gas">Gas</option>
                            <option value="water">Water</option>
                            <option value="internet">Internet</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2">Currency</label>
                        <select wire:model="currency" class="w-full border-secondary/20 rounded-lg p-2 focus:ring-primary focus:border-primary">
                            <option value="USD">USD ($)</option>
                            <option value="GBP">GBP (£)</option>
                            <option value="CAD">CAD (CA$)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-dark mb-2">Bill File (PDF or Image)</label>
                        <input type="file" wire:model="billFile" class="w-full text-sm text-dark/60 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-dark">
                        @error('billFile') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full btn-primary font-bold py-3">
                        Start AI Analysis
                    </button>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
