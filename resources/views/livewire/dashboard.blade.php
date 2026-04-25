<div>
    {{-- ─── Welcome Banner ──────────────────────────────────────────── --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="font-heading text-2xl font-bold text-dark">
                Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!
            </h2>
            <p class="text-dark/50 text-sm mt-1">Here's a summary of your utility audits.</p>
        </div>
        <a href="{{ route('bills.index') }}" class="btn-primary py-2.5 px-6 text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Upload New Bill
        </a>
    </div>

    {{-- ─── Stats Grid ───────────────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
        <div class="stat-card">
            <div class="stat-icon bg-primary/10">
                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold font-heading text-dark">{{ $totalBills }}</p>
                <p class="text-xs font-semibold text-dark/50 uppercase tracking-wider mt-0.5">Total Bills</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-green-100">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold font-heading text-dark">{{ $analyzedBills }}</p>
                <p class="text-xs font-semibold text-dark/50 uppercase tracking-wider mt-0.5">Analyzed</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-accent/20">
                <svg class="w-7 h-7 text-accent-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold font-heading text-dark">
                    {{ auth()->user()->currency ?? 'USD' }} {{ number_format($totalSavings, 2) }}
                </p>
                <p class="text-xs font-semibold text-dark/50 uppercase tracking-wider mt-0.5">Total Savings Found</p>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-blue-100">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
            <div>
                <p class="text-2xl font-extrabold font-heading text-dark">{{ $activeDisputes }}</p>
                <p class="text-xs font-semibold text-dark/50 uppercase tracking-wider mt-0.5">Active Disputes</p>
            </div>
        </div>
    </div>

    {{-- ─── Recent Bills ─────────────────────────────────────────────── --}}
    <div class="card overflow-hidden">
        <div class="flex items-center justify-between px-6 py-5 border-b border-secondary/10">
            <h3 class="font-heading font-bold text-dark">Recent Bills</h3>
            <a href="{{ route('bills.index') }}" class="text-sm text-primary font-bold hover:underline">
                View All
            </a>
        </div>

        @if($recentBills->isEmpty())
            <div class="py-16 text-center">
                <div class="w-16 h-16 bg-secondary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-secondary/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <p class="text-dark/50 font-medium mb-4">No bills uploaded yet.</p>
                <a href="{{ route('bills.index') }}" class="btn-primary py-2.5 px-6 text-sm">
                    Upload Your First Bill
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-secondary/10">
                    <thead class="bg-background">
                        <tr>
                            <th class="table-header">Date</th>
                            <th class="table-header">Utility</th>
                            <th class="table-header">Status</th>
                            <th class="table-header">Savings Found</th>
                            <th class="table-header text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-secondary/10">
                        @foreach($recentBills as $bill)
                        <tr class="hover:bg-background/60 transition">
                            <td class="table-cell font-medium">{{ $bill->created_at->format('M d, Y') }}</td>
                            <td class="table-cell capitalize">{{ $bill->utility_type }}</td>
                            <td class="table-cell">
                                @switch($bill->status)
                                    @case('analyzed') <span class="badge-success">Analyzed</span> @break
                                    @case('processing') <span class="badge-info">Processing</span> @break
                                    @case('disputed') <span class="badge-warning">Disputed</span> @break
                                    @case('resolved') <span class="badge-success">Resolved</span> @break
                                    @case('failed') <span class="badge-danger">Failed</span> @break
                                    @default <span class="badge-default">{{ ucfirst($bill->status) }}</span>
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
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- ─── Quick Actions ────────────────────────────────────────────── --}}
    <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-5">
        <a href="{{ route('bills.index') }}"
           class="card p-6 flex items-center gap-4 hover:shadow-md transition group">
            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center group-hover:bg-primary group-hover:text-white transition">
                <svg class="w-6 h-6 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-dark text-sm">Upload a Bill</p>
                <p class="text-xs text-dark/50 mt-0.5">Start a new AI audit</p>
            </div>
        </a>

        <a href="{{ route('disputes.index') }}"
           class="card p-6 flex items-center gap-4 hover:shadow-md transition group">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-600 transition">
                <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-dark text-sm">View Disputes</p>
                <p class="text-xs text-dark/50 mt-0.5">Track your dispute status</p>
            </div>
        </a>

        <a href="{{ route('profile') }}"
           class="card p-6 flex items-center gap-4 hover:shadow-md transition group">
            <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center group-hover:bg-secondary group-hover:text-white transition">
                <svg class="w-6 h-6 text-secondary-700 group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <p class="font-bold text-dark text-sm">Edit Profile</p>
                <p class="text-xs text-dark/50 mt-0.5">Update your details</p>
            </div>
        </a>
    </div>
</div>
