<div>
    <div class="mb-8">
        <p class="text-dark/50 text-sm mt-1">Manage and track your utility bill disputes.</p>
    </div>

    {{-- Filter --}}
    <div class="mb-5 flex items-center gap-3 flex-wrap">
        @foreach([''=>'All', 'draft'=>'Draft', 'sent'=>'Sent', 'in_review'=>'In Review', 'resolved'=>'Resolved', 'rejected'=>'Rejected'] as $val => $label)
            <button wire:click="$set('filterStatus', '{{ $val }}')"
                    class="px-4 py-1.5 rounded-full text-xs font-bold transition border
                           {{ $filterStatus === $val
                               ? 'bg-primary text-white border-primary'
                               : 'bg-white text-dark/60 border-secondary/20 hover:border-primary/30 hover:text-dark' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <div class="card overflow-hidden">
        @if($disputes->isEmpty())
            <div class="py-20 text-center">
                <div class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-secondary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <p class="text-dark/50 font-medium mb-4">No disputes found.</p>
                <p class="text-dark/40 text-sm max-w-xs mx-auto">
                    After an AI audit finds overcharges, you can raise a dispute from the bill detail page.
                </p>
                <a href="{{ route('bills.index') }}" class="btn-primary py-2.5 px-6 text-sm mt-6">
                    Go to My Bills
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary/10">
                    <thead class="bg-background">
                        <tr>
                            <th class="table-header">#</th>
                            <th class="table-header">Bill</th>
                            <th class="table-header">Overcharge</th>
                            <th class="table-header">Status</th>
                            <th class="table-header">Created</th>
                            <th class="table-header">Sent</th>
                            <th class="table-header text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-secondary/10">
                        @foreach($disputes as $dispute)
                        <tr class="hover:bg-background/60 transition">
                            <td class="table-cell font-bold text-primary">#{{ $dispute->id }}</td>
                            <td class="table-cell">
                                <a href="{{ route('bills.show', $dispute->bill_id) }}"
                                   class="font-semibold hover:text-primary transition capitalize">
                                    {{ ucfirst($dispute->bill?->utility_type ?? 'Bill') }} Bill
                                </a>
                                <p class="text-xs text-dark/40 mt-0.5">
                                    {{ $dispute->bill?->created_at->format('M d, Y') }}
                                </p>
                            </td>
                            <td class="table-cell font-bold text-green-600">
                                {{ $dispute->analysis ? ($dispute->bill?->currency . ' ' . number_format($dispute->analysis->overcharge_amount, 2)) : '—' }}
                            </td>
                            <td class="table-cell">
                                @switch($dispute->status)
                                    @case('draft')     <span class="badge-default">Draft</span>      @break
                                    @case('sent')      <span class="badge-info">Sent</span>          @break
                                    @case('in_review') <span class="badge-warning">In Review</span>  @break
                                    @case('resolved')  <span class="badge-success">Resolved</span>   @break
                                    @case('rejected')  <span class="badge-danger">Rejected</span>    @break
                                @endswitch
                            </td>
                            <td class="table-cell text-dark/60">{{ $dispute->created_at->format('M d, Y') }}</td>
                            <td class="table-cell text-dark/60">
                                {{ $dispute->sent_at ? $dispute->sent_at->format('M d, Y') : '—' }}
                            </td>
                            <td class="table-cell text-right space-x-3">
                                @if($dispute->status === 'draft')
                                    <button wire:click="markSent({{ $dispute->id }})"
                                            wire:confirm="Mark this dispute as sent?"
                                            class="text-blue-600 font-semibold text-sm hover:underline">
                                        Mark Sent
                                    </button>
                                @endif
                                <a href="{{ route('bills.show', $dispute->bill_id) }}"
                                   class="text-primary font-semibold text-sm hover:underline">
                                    View Bill
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-secondary/10">
                {{ $disputes->links() }}
            </div>
        @endif
    </div>
</div>
