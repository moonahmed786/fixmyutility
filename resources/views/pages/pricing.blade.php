@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20">
            <h1 class="font-heading text-4xl md:text-6xl font-extrabold text-dark mb-6">
                Simple, Transparent <span class="text-primary">Pricing</span>
            </h1>
            <p class="text-xl text-dark/60 max-w-2xl mx-auto">
                Choose the plan that fits your needs. No hidden fees. Pay once, save potentially hundreds.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
            @forelse($plans as $plan)
            <div class="bg-white p-10 rounded-3xl shadow-xl border-2 relative overflow-hidden flex flex-col
                        {{ $plan->slug === 'pro' ? 'border-primary' : 'border-secondary/10' }}">
                @if($plan->slug === 'pro')
                    <div class="absolute top-6 right-6 bg-primary text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest">
                        Most Popular
                    </div>
                @endif

                <h3 class="font-heading text-2xl font-extrabold text-dark mb-3">{{ $plan->name }}</h3>
                <p class="text-dark/60 mb-8 text-sm">{{ $plan->description }}</p>

                <div class="flex items-baseline gap-1 mb-10">
                    <span class="font-heading text-5xl font-extrabold text-primary">
                        ${{ number_format($plan->price_usd, 0) }}
                    </span>
                    <span class="text-dark/40 font-semibold text-sm">/ audit</span>
                </div>

                <ul class="space-y-3 mb-10 flex-grow">
                    @php $features = is_string($plan->features) ? json_decode($plan->features, true) : ($plan->features ?? []); @endphp
                    @foreach((array)$features as $feature)
                    <li class="flex items-center gap-3 text-sm font-medium">
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>

                <a href="{{ route('register', ['plan' => $plan->slug]) }}"
                   class="w-full text-center py-4 rounded-xl font-extrabold text-base transition
                          {{ $plan->slug === 'pro'
                              ? 'bg-primary text-white hover:bg-dark shadow-lg shadow-primary/20'
                              : 'bg-background border-2 border-secondary/20 text-primary hover:border-primary' }}">
                    Select {{ $plan->name }}
                </a>
            </div>
            @empty
            <div class="col-span-2 text-center py-16 text-dark/40">
                <p>Plans coming soon.</p>
            </div>
            @endforelse
        </div>

        {{-- Currency note --}}
        <p class="text-center text-dark/40 text-sm mt-10">
            Prices shown in USD. GBP and CAD equivalents shown at checkout.
        </p>

        {{-- FAQ Section --}}
        @if($faqs->isNotEmpty())
        <div class="mt-32 max-w-3xl mx-auto">
            <h2 class="font-heading text-3xl font-extrabold text-center text-dark mb-12">
                Frequently Asked Questions
            </h2>
            <div class="space-y-4" x-data="{ open: null }">
                @foreach($faqs as $i => $faq)
                <div class="bg-white rounded-2xl border border-secondary/10 overflow-hidden">
                    <button class="w-full flex items-center justify-between px-8 py-6 text-left focus:outline-none"
                            @click="open = open === {{ $i }} ? null : {{ $i }}">
                        <span class="font-bold text-dark pr-8">{{ $faq->question }}</span>
                        <svg class="w-5 h-5 text-primary shrink-0 transition-transform duration-200"
                             :class="open === {{ $i }} ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open === {{ $i }}"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-cloak>
                        <div class="px-8 pb-6 text-dark/60 text-sm leading-relaxed border-t border-secondary/10 pt-4">
                            {{ $faq->answer }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        {{-- Static FAQs if none seeded --}}
        <div class="mt-32 max-w-3xl mx-auto">
            <h2 class="font-heading text-3xl font-extrabold text-center text-dark mb-12">Frequently Asked Questions</h2>
            <div class="space-y-4" x-data="{ open: null }">
                @foreach([
                    ['How does the audit work?', 'Upload your PDF or scanned bill. Our AI analyzes every line item against local tariffs and regulations. You get a detailed report and a dispute letter within minutes.'],
                    ['Is my data secure?', 'Yes. We use bank-level encryption. Your bills are stored securely and only used for the audit process.'],
                    ['Which countries do you support?', 'We support utility bills from the USA, Canada, and the United Kingdom. Pricing is available in USD, CAD, and GBP.'],
                    ['How long does an analysis take?', 'Most analyses complete within 1–3 minutes using our AI pipeline.'],
                ] as $i => $faq)
                <div class="bg-white rounded-2xl border border-secondary/10 overflow-hidden">
                    <button class="w-full flex items-center justify-between px-8 py-6 text-left focus:outline-none"
                            @click="open = open === {{ $i }} ? null : {{ $i }}"
                            x-data="{ open: null }">
                        <span class="font-bold text-dark pr-8">{{ $faq[0] }}</span>
                        <svg class="w-5 h-5 text-primary shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="px-8 pb-6 text-dark/60 text-sm leading-relaxed border-t border-secondary/10 pt-4"
                         x-show="open === {{ $i }}">
                        {{ $faq[1] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
