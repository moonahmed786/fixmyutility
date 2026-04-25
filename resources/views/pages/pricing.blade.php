@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h1 class="text-4xl md:text-6xl font-extrabold text-dark mb-6">Simple, Transparent <span class="text-primary">Pricing</span></h1>
            <p class="text-xl text-dark/60 max-w-2xl mx-auto">Choose the plan that fits your needs. No hidden fees, no subscriptions. Pay per audit.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
            @foreach($plans as $plan)
            <div class="bg-white p-12 rounded-3xl shadow-xl border-2 @if($plan->slug == 'pro') border-primary @else border-secondary/10 @endif relative overflow-hidden flex flex-col">
                @if($plan->slug == 'pro')
                    <div class="absolute top-0 right-0 bg-primary text-white text-xs font-bold px-4 py-2 rounded-bl-xl uppercase tracking-widest">Most Popular</div>
                @endif
                
                <h3 class="text-3xl font-extrabold text-dark mb-4">{{ $plan->name }}</h3>
                <p class="text-dark/60 mb-8">{{ $plan->description }}</p>
                
                <div class="flex items-baseline gap-1 mb-10">
                    <span class="text-5xl font-extrabold text-primary">${{ number_format($plan->price_usd, 2) }}</span>
                    <span class="text-dark/40 font-bold">/ audit</span>
                </div>

                <ul class="space-y-4 mb-12 flex-grow">
                    @php $features = json_decode($plan->features, true) ?? []; @endphp
                    @foreach($features as $feature)
                    <li class="flex items-center gap-3 font-medium">
                        <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('register', ['plan' => $plan->slug]) }}" class="w-full text-center py-4 rounded-xl font-extrabold text-lg transition shadow-lg @if($plan->slug == 'pro') bg-primary text-white hover:bg-dark @else bg-secondary/10 text-primary hover:bg-secondary/20 @endif">
                    Select {{ $plan->name }}
                </a>
            </div>
            @endforeach
        </div>

        <!-- FAQ Section in Pricing -->
        <div class="mt-32 max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>
            <div class="space-y-8">
                <div class="bg-white p-8 rounded-2xl border border-secondary/10">
                    <h4 class="text-xl font-bold mb-2">How does the audit work?</h4>
                    <p class="text-dark/60">Upload your PDF or scanned bill. Our AI analyzes it against local tariffs and regulations to find overcharges. You get a report and a dispute letter.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl border border-secondary/10">
                    <h4 class="text-xl font-bold mb-2">Is my data secure?</h4>
                    <p class="text-dark/60">Yes, we use bank-level encryption. Your bills are stored securely and only used for the audit process.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
