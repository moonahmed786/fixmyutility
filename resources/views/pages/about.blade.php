@extends('layouts.app')

@section('content')
<div class="bg-background">
    {{-- Hero --}}
    <div class="py-24">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="font-heading text-4xl md:text-6xl font-extrabold text-dark mb-8">
                About <span class="text-primary">FixMyUtility</span>
            </h1>

            <div class="text-dark/70 space-y-6 text-lg leading-relaxed max-w-3xl">
                <p class="text-xl font-medium text-dark">
                    We started FixMyUtility with a simple goal: to help consumers get back the money they are overcharged by utility companies.
                </p>
                <p>
                    Utility bills are complex. Between estimated readings, varying tariffs, and hidden fees, it's easy for errors to slip through. Most people don't have the time or expertise to audit their own bills.
                </p>
            </div>

            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-8 rounded-2xl border border-secondary/10 text-center">
                    <div class="font-heading text-4xl font-extrabold text-primary mb-2">$500k+</div>
                    <p class="text-xs font-bold text-dark/50 uppercase tracking-widest">Total Savings Found</p>
                </div>
                <div class="bg-white p-8 rounded-2xl border border-secondary/10 text-center">
                    <div class="font-heading text-4xl font-extrabold text-primary mb-2">10k+</div>
                    <p class="text-xs font-bold text-dark/50 uppercase tracking-widest">Bills Audited</p>
                </div>
                <div class="bg-white p-8 rounded-2xl border border-secondary/10 text-center">
                    <div class="font-heading text-4xl font-extrabold text-primary mb-2">98%</div>
                    <p class="text-xs font-bold text-dark/50 uppercase tracking-widest">Accuracy Rate</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Mission & How It Works --}}
    <div class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div>
                    <h3 class="font-heading text-2xl font-bold text-dark mt-0 mb-5">Our Mission</h3>
                    <p class="text-dark/70 leading-relaxed">
                        To provide professional-grade utility auditing at an affordable price using cutting-edge AI technology. We empower consumers to take control of their utility costs and ensure they only pay for what they use.
                    </p>
                </div>
                <div>
                    <h3 class="font-heading text-2xl font-bold text-dark mt-0 mb-5">How It Works</h3>
                    <ol class="space-y-4">
                        @foreach([
                            ['Upload', 'Provide your bill in PDF or image format.'],
                            ['Analyze', 'Our AI scans every line item against tariff databases.'],
                            ['Report', 'Receive a detailed breakdown of any findings.'],
                            ['Dispute', 'Use our formal letter to challenge your provider.'],
                        ] as $i => $step)
                        <li class="flex items-start gap-4">
                            <span class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold text-sm shrink-0">{{ $i + 1 }}</span>
                            <div>
                                <span class="font-bold text-dark">{{ $step[0] }}:</span>
                                <span class="text-dark/60"> {{ $step[1] }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Testimonials --}}
    @if($testimonials->isNotEmpty())
    <div class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-dark mb-4">What Our Customers Say</h2>
                <p class="text-dark/60 max-w-xl mx-auto">Real results from real customers across the USA, Canada, and UK.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($testimonials as $t)
                <div class="bg-white p-8 rounded-2xl border border-secondary/10 hover:shadow-md transition">
                    <div class="flex items-center mb-4">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < $t->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-dark/70 mb-6 leading-relaxed text-sm">"{{ $t->content }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-sm">
                            {{ strtoupper(substr($t->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-dark text-sm">{{ $t->name }}</p>
                            @if($t->company)
                                <p class="text-xs text-dark/50">{{ $t->company }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- CTA --}}
    <div class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="font-heading text-3xl md:text-4xl font-extrabold text-dark mb-6">Start Saving Today</h2>
            <p class="text-dark/60 text-lg mb-10 max-w-xl mx-auto">Join thousands of customers who are recovering overcharges from their utility providers.</p>
            <a href="{{ route('register') }}" class="btn-primary text-lg px-10 py-4">
                Get Started for Free
            </a>
        </div>
    </div>
</div>
@endsection
