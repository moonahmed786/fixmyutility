@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="font-heading text-4xl md:text-5xl font-extrabold text-dark mb-4">
                Our Audit <span class="text-primary">Services</span>
            </h1>
            <p class="text-dark/60 max-w-2xl mx-auto text-lg">
                We provide comprehensive utility auditing to ensure you never pay more than you should.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services as $service)
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-secondary/10 hover:shadow-lg transition-all duration-300 group">
                <div class="w-14 h-14 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary group-hover:text-white transition">
                    @switch($service->icon ?? $service->slug)
                        @case('bolt')
                        @case('electricity-audit')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                            @break
                        @case('fire')
                        @case('gas-audit')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.98 7.98 0 01-2.343 5.657z"/>
                            </svg>
                            @break
                        @case('droplet')
                        @case('water-audit')
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2z"/>
                            </svg>
                            @break
                        @default
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                    @endswitch
                </div>
                <h3 class="font-heading text-xl font-bold text-dark mb-3">{{ $service->title }}</h3>
                <p class="text-dark/60 mb-6 text-sm leading-relaxed">{{ $service->excerpt }}</p>
                <a href="{{ route('services.show', $service->slug) }}"
                   class="text-primary font-bold text-sm inline-flex items-center gap-1.5 hover:gap-3 transition-all">
                    Learn More
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-16 text-dark/40">
                <p>No services available yet.</p>
            </div>
            @endforelse
        </div>

        {{-- CTA --}}
        <div class="mt-24 bg-primary rounded-3xl p-12 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-primary to-dark opacity-90 rounded-3xl"></div>
            <div class="relative z-10">
                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-white mb-4">
                    Not sure which service you need?
                </h2>
                <p class="text-white/70 mb-8 max-w-lg mx-auto">
                    Upload any utility bill and our AI will automatically detect the type and run the appropriate audit.
                </p>
                <a href="{{ route('register') }}"
                   class="bg-white text-primary px-8 py-4 rounded-xl font-extrabold hover:bg-accent transition inline-block">
                    Start Free Analysis
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
