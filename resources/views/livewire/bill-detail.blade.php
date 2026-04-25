<div>
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-dark/50 mb-6 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-primary transition">Dashboard</a>
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <a href="{{ route('bills.index') }}" class="hover:text-primary transition">My Bills</a>
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
        <span class="text-dark">Bill #{{ $bill->id }}</span>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-xl text-sm font-medium">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-xl text-sm font-medium">
            <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ─── Bill Info Card ──────────────────────────────────────── --}}
        <div class="lg:col-span-1 space-y-5">
            <div class="card p-6">
                <h3 class="font-heading font-bold text-dark mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Bill Information
                </h3>

                <dl class="space-y-4 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-dark/50 font-medium">Utility Type</dt>
                        <dd class="font-bold capitalize">{{ $bill->utility_type }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-dark/50 font-medium">Provider</dt>
                        <dd class="font-bold">{{ $bill->provider?->name ?? '—' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-dark/50 font-medium">Currency</dt>
                        <dd class="font-bold">{{ $bill->currency }}</dd>
                    </div>
                    @if($bill->amount)
                    <div class="flex justify-between">
                        <dt class="text-dark/50 font-medium">Bill Amount</dt>
                        <dd class="font-bold">{{ $bill->currency }} {{ number_format($bill->amount, 2) }}</dd>
                    </div>
                    @endif
                    @if($bill->billing_period_start)
                    <div class="flex justify-between">
                        <dt class="text-dark/50 font-medium">Period</dt>
                        <dd class="font-bold text-right">
                            {{ $bill->billing_period_start->format('M d') }} –
                            {{ $bill->billing_period_end?->format('M d, Y') ?? '?' }}
                        </dd>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <dt class="text-dark/50 font-medium">Uploaded</dt>
                        <dd class="font-bold">{{ $bill->created_at->format('M d, Y') }}</dd>
                    </div>
                    <div class="flex justify-between items-center">
                        <dt class="text-dark/50 font-medium">Status</dt>
                        <dd>
                            @switch($bill->status)
                                @case('analyzed')  <span class="badge-success">Analyzed</span>  @break
                                @case('processing') <span class="badge-info">Processing…</span> @break
                                @case('disputed')  <span class="badge-warning">Disputed</span>  @break
                                @case('resolved')  <span class="badge-success">Resolved</span>  @break
                                @case('failed')    <span class="badge-danger">Failed</span>     @break
                                @default           <span class="badge-default">{{ ucfirst($bill->status) }}</span>
                            @endswitch
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Actions --}}
            <div class="card p-6">
                <h3 class="font-heading font-bold text-dark mb-4">Actions</h3>
                <div class="space-y-3">
                    @if($bill->analysis && $bill->analysis->status === 'completed')
                        @if($bill->analysis->report_pdf_path)
                            <a href="{{ Storage::url($bill->analysis->report_pdf_path) }}"
                               target="_blank"
                               class="w-full flex items-center gap-3 py-3 px-4 bg-background border border-secondary/20 rounded-xl text-sm font-semibold text-dark hover:border-primary/30 hover:text-primary transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Download Audit Report
                            </a>
                        @else
                            <button wire:click="generateReport"
                                    class="w-full flex items-center gap-3 py-3 px-4 bg-background border border-secondary/20 rounded-xl text-sm font-semibold text-dark hover:border-primary/30 hover:text-primary transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Generate PDF Report
                            </button>
                        @endif

                        @if(!$bill->dispute && ($bill->analysis->overcharge_amount ?? 0) > 0)
                            <button wire:click="$set('showDisputeModal', true)"
                                    class="w-full flex items-center gap-3 py-3 px-4 bg-primary/10 border border-primary/20 rounded-xl text-sm font-semibold text-primary hover:bg-primary hover:text-white transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                                Raise Dispute
                            </button>
                        @endif
                    @endif

                    @if(in_array($bill->status, ['failed', 'uploaded']))
                        <button wire:click="reanalyze"
                                class="w-full flex items-center gap-3 py-3 px-4 bg-background border border-secondary/20 rounded-xl text-sm font-semibold text-dark hover:border-primary/30 hover:text-primary transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Re-run Analysis
                        </button>
                    @endif

                    <a href="{{ route('bills.index') }}"
                       class="w-full flex items-center gap-3 py-3 px-4 bg-background border border-secondary/20 rounded-xl text-sm font-semibold text-dark/60 hover:text-dark transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Bills
                    </a>
                </div>
            </div>
        </div>

        {{-- ─── Analysis Results ─────────────────────────────────────── --}}
        <div class="lg:col-span-2 space-y-5">
            @if($bill->status === 'processing')
                <div class="card p-12 text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="animate-spin w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-dark mb-2">AI Analysis in Progress</h3>
                    <p class="text-dark/50 text-sm">Your bill is being analyzed. This usually takes 1–3 minutes. Refresh the page to check status.</p>
                </div>
            @elseif($bill->status === 'uploaded')
                <div class="card p-12 text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-dark mb-2">Awaiting Analysis</h3>
                    <p class="text-dark/50 text-sm mb-6">Your bill has been uploaded and is queued for analysis.</p>
                    <button wire:click="reanalyze" class="btn-primary py-2.5 px-6 text-sm">
                        Start Analysis Now
                    </button>
                </div>
            @elseif($bill->status === 'failed')
                <div class="card p-12 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <h3 class="font-heading text-xl font-bold text-dark mb-2">Analysis Failed</h3>
                    <p class="text-dark/50 text-sm mb-6">There was a problem analyzing your bill. Please try again.</p>
                    <button wire:click="reanalyze" class="btn-primary py-2.5 px-6 text-sm">
                        Retry Analysis
                    </button>
                </div>
            @elseif($bill->analysis)
                {{-- Summary Card --}}
                @php $analysis = $bill->analysis; @endphp
                <div class="card p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div>
                            <h3 class="font-heading font-bold text-dark text-lg">Analysis Summary</h3>
                            <p class="text-dark/50 text-sm mt-1">Completed {{ $analysis->updated_at->diffForHumans() }}</p>
                        </div>
                        @if($analysis->overcharge_amount > 0)
                            <div class="text-right bg-green-50 border border-green-200 rounded-xl px-5 py-3">
                                <p class="text-xs font-bold text-green-600 uppercase tracking-wider">Overcharge Found</p>
                                <p class="text-2xl font-extrabold font-heading text-green-700 mt-0.5">
                                    {{ $bill->currency }} {{ number_format($analysis->overcharge_amount, 2) }}
                                </p>
                            </div>
                        @else
                            <span class="badge-success text-sm py-1.5 px-4">No overcharges found</span>
                        @endif
                    </div>

                    @if(isset($analysis->ai_response['summary']))
                        <p class="text-dark/70 text-sm leading-relaxed">{{ $analysis->ai_response['summary'] }}</p>
                    @endif
                </div>

                {{-- Errors Found --}}
                @php $errors = $analysis->errors ?? []; @endphp
                @if(!empty($errors))
                <div class="card overflow-hidden">
                    <div class="px-6 py-4 border-b border-secondary/10 bg-red-50">
                        <h3 class="font-heading font-bold text-dark flex items-center gap-2">
                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            Billing Errors Detected ({{ count($errors) }})
                        </h3>
                    </div>
                    <div class="divide-y divide-secondary/10">
                        @foreach($errors as $error)
                        <div class="px-6 py-5">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="font-bold text-dark text-sm">{{ $error['type'] ?? 'Error' }}</p>
                                    <p class="text-dark/60 text-sm mt-1">{{ $error['description'] ?? '' }}</p>
                                </div>
                                @if(!empty($error['amount']))
                                    <div class="shrink-0 text-right">
                                        <p class="text-xs text-dark/40 font-medium">Overcharge</p>
                                        <p class="font-bold text-red-600">{{ $bill->currency }} {{ number_format($error['amount'], 2) }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="card p-6 text-center text-dark/50 text-sm">
                    <svg class="w-10 h-10 text-green-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    No billing errors were detected in this bill.
                </div>
                @endif

                {{-- Dispute Letter Preview --}}
                @if($analysis->dispute_letter)
                <div class="card overflow-hidden">
                    <div class="px-6 py-4 border-b border-secondary/10 flex items-center justify-between">
                        <h3 class="font-heading font-bold text-dark">Dispute Letter</h3>
                        <span class="badge-info">AI Generated</span>
                    </div>
                    <div class="p-6 bg-background">
                        <div class="bg-white rounded-xl border border-secondary/10 p-6 text-sm text-dark/70 leading-relaxed font-mono max-h-64 overflow-y-auto whitespace-pre-wrap">{{ $analysis->dispute_letter }}</div>
                    </div>
                </div>
                @endif

                {{-- Dispute Status --}}
                @if($bill->dispute)
                <div class="card p-6">
                    <h3 class="font-heading font-bold text-dark mb-4">Dispute Status</h3>
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-dark/60 mb-1">Dispute #{{ $bill->dispute->id }}</p>
                            <p class="text-sm font-medium text-dark">
                                Opened {{ $bill->dispute->created_at->format('M d, Y') }}
                                @if($bill->dispute->sent_at) · Sent {{ $bill->dispute->sent_at->format('M d, Y') }} @endif
                                @if($bill->dispute->resolved_at) · Resolved {{ $bill->dispute->resolved_at->format('M d, Y') }} @endif
                            </p>
                        </div>
                        @switch($bill->dispute->status)
                            @case('draft')    <span class="badge-default">Draft</span>    @break
                            @case('sent')     <span class="badge-info">Sent</span>        @break
                            @case('in_review') <span class="badge-warning">In Review</span> @break
                            @case('resolved') <span class="badge-success">Resolved</span> @break
                            @case('rejected') <span class="badge-danger">Rejected</span>  @break
                        @endswitch
                    </div>
                    @if($bill->dispute->notes)
                        <p class="mt-3 text-sm text-dark/60 bg-background rounded-lg p-3">{{ $bill->dispute->notes }}</p>
                    @endif
                </div>
                @endif
            @endif
        </div>
    </div>

    {{-- ─── Dispute Modal ────────────────────────────────────────────── --}}
    @if($showDisputeModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-dark/50 backdrop-blur-sm">
        <div class="bg-white rounded-2xl p-8 max-w-md w-full shadow-2xl">
            <div class="flex justify-between items-center mb-6">
                <h2 class="font-heading text-xl font-bold text-dark">Raise a Dispute</h2>
                <button wire:click="$set('showDisputeModal', false)" class="text-dark/30 hover:text-dark transition p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <p class="text-sm text-dark/60 mb-6">
                We'll generate a formal dispute letter you can send to your utility provider.
                Overcharge amount: <strong class="text-green-600">{{ $bill->currency }} {{ number_format($bill->analysis->overcharge_amount, 2) }}</strong>
            </p>
            <div>
                <label class="form-label">Additional Notes <span class="text-dark/40 font-normal">(optional)</span></label>
                <textarea wire:model="disputeNotes" rows="4" class="form-input"
                          placeholder="Any specific details you'd like included in the dispute…"></textarea>
            </div>
            <div class="flex gap-3 mt-6">
                <button wire:click="$set('showDisputeModal', false)"
                        class="flex-1 py-3 border border-secondary/30 text-dark/60 rounded-xl font-semibold hover:bg-background transition text-sm">
                    Cancel
                </button>
                <button wire:click="createDispute" class="flex-1 btn-primary py-3 text-sm">
                    Create Dispute
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
