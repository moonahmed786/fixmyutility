<div class="bg-background">

    {{-- ─── Hero ─────────────────────────────────────────────────────── --}}
    <section class="relative py-28 overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-bl from-accent/10 to-transparent -z-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="text-center lg:text-left">
                    <span class="inline-block px-4 py-1.5 bg-primary/10 text-primary text-xs font-bold rounded-full uppercase tracking-widest mb-6">
                        AI-Powered Bill Auditing
                    </span>
                    <h1 class="font-heading text-5xl md:text-6xl xl:text-7xl font-extrabold text-dark leading-tight mb-6">
                        Stop Overpaying for <span class="text-primary">Utilities</span>
                    </h1>
                    <p class="text-xl text-dark/60 mb-10 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Our AI analyzes your electricity, gas, water, and internet bills to find errors and hidden charges — then generates a dispute letter to get your money back.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}"
                           class="btn-primary text-base px-8 py-4 shadow-xl shadow-primary/20">
                            Start Free Analysis
                        </a>
                        <a href="{{ route('services.index') }}"
                           class="btn-secondary text-base px-8 py-4">
                            Explore Services
                        </a>
                    </div>
                    <p class="text-sm text-dark/40 mt-6 font-medium">
                        USA · Canada · United Kingdom &nbsp;·&nbsp; No subscription required
                    </p>
                </div>

                {{-- Sample Audit Card --}}
                <div class="mt-16 lg:mt-0 relative">
                    <div class="bg-white p-8 rounded-3xl shadow-2xl border border-secondary/10 relative">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="font-heading font-bold text-dark">Sample Audit Result</h3>
                                <p class="text-xs text-dark/40 mt-0.5">Electricity Bill · June 2025</p>
                            </div>
                            <span class="badge-success text-sm py-1.5 px-4">Analyzed</span>
                        </div>
                        <div class="space-y-4">
                            <div class="flex gap-4 p-4 bg-red-50 border border-red-100 rounded-xl">
                                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-dark text-sm">Tariff Mismatch</p>
                                    <p class="text-xs text-dark/60 mt-0.5">Peak rate applied during off-peak hours</p>
                                    <p class="text-xs font-bold text-red-600 mt-1">Overcharge: $38.50</p>
                                </div>
                            </div>
                            <div class="flex gap-4 p-4 bg-red-50 border border-red-100 rounded-xl">
                                <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-dark text-sm">Estimated Reading Error</p>
                                    <p class="text-xs text-dark/60 mt-0.5">Actual reading significantly lower</p>
                                    <p class="text-xs font-bold text-red-600 mt-1">Overcharge: $104.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 pt-5 border-t border-secondary/10 flex justify-between items-center">
                            <span class="text-sm font-medium text-dark/50">Total Overcharge Found</span>
                            <span class="font-heading text-2xl font-extrabold text-green-600">$142.50</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── How It Works ─────────────────────────────────────────────── --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl font-extrabold text-dark mb-4">How It Works</h2>
                <p class="text-dark/60 max-w-xl mx-auto">From upload to refund in four simple steps.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                @foreach([
                    ['icon'=>'M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12', 'step'=>'1', 'title'=>'Upload Your Bill', 'desc'=>'PDF or image format. We support electricity, gas, water, and internet bills.'],
                    ['icon'=>'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z', 'step'=>'2', 'title'=>'AI Analyzes', 'desc'=>'Our AI cross-references every charge against current tariff data and regulations.'],
                    ['icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'step'=>'3', 'title'=>'Get Your Report', 'desc'=>'Download a detailed PDF report showing every error and the potential savings.'],
                    ['icon'=>'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'step'=>'4', 'title'=>'Send the Dispute', 'desc'=>'Use our AI-generated dispute letter to challenge your provider and get a refund.'],
                ] as $step)
                <div class="text-center relative">
                    <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $step['icon'] }}"/>
                        </svg>
                    </div>
                    <span class="inline-block w-7 h-7 bg-primary text-white rounded-full text-xs font-extrabold flex items-center justify-center mx-auto mb-4">
                        {{ $step['step'] }}
                    </span>
                    <h3 class="font-heading font-bold text-dark mb-2">{{ $step['title'] }}</h3>
                    <p class="text-dark/60 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── Services ─────────────────────────────────────────────────── --}}
    @if($featuredServices->isNotEmpty())
    <section class="py-24 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl font-extrabold text-dark mb-4">How We Help You Save</h2>
                <p class="text-dark/60 max-w-2xl mx-auto">
                    Expert utility auditing for various bill types across the USA, UK, and Canada.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredServices as $service)
                <div class="p-8 rounded-2xl bg-white border border-secondary/10 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-primary/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary transition">
                        @switch($service->slug)
                            @case('electricity-audit')
                                <svg class="w-8 h-8 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                @break
                            @case('gas-audit')
                                <svg class="w-8 h-8 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.98 7.98 0 01-2.343 5.657z"/>
                                </svg>
                                @break
                            @default
                                <svg class="w-8 h-8 text-primary group-hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                        @endswitch
                    </div>
                    <h3 class="font-heading text-xl font-bold mb-3">{{ $service->title }}</h3>
                    <p class="text-dark/60 mb-6 text-sm leading-relaxed">{{ $service->excerpt }}</p>
                    <a href="{{ route('services.show', $service->slug) }}"
                       class="text-primary font-bold text-sm inline-flex items-center gap-1 hover:gap-3 transition-all">
                        View Details
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('services.index') }}" class="btn-secondary">
                    View All Services
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- ─── Testimonials ─────────────────────────────────────────────── --}}
    @if($testimonials->isNotEmpty())
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-heading text-4xl font-extrabold text-dark mb-4">Trusted by Customers</h2>
                <p class="text-dark/60 max-w-xl mx-auto">Real savings, real results from people just like you.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($testimonials as $t)
                <div class="bg-background border border-secondary/10 p-8 rounded-2xl hover:shadow-md transition">
                    <div class="flex items-center mb-5">
                        @for($i=0; $i<5; $i++)
                            <svg class="w-4 h-4 {{ $i < $t->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-dark/70 text-sm leading-relaxed mb-6">"{{ $t->content }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-primary/10 rounded-full flex items-center justify-center font-bold text-primary text-sm">
                            {{ strtoupper(substr($t->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-bold text-dark text-sm">{{ $t->name }}</p>
                            @if($t->company)
                                <p class="text-xs text-dark/40">{{ $t->company }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ─── CTA ──────────────────────────────────────────────────────── --}}
    <section class="py-24 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-dark rounded-3xl p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 w-96 h-96 bg-primary/20 rounded-full blur-3xl -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/10 rounded-full blur-3xl -ml-48 -mb-48"></div>
                <div class="relative z-10">
                    <h2 class="font-heading text-4xl md:text-5xl font-extrabold text-white mb-6">
                        Ready to Recover Your Money?
                    </h2>
                    <p class="text-white/60 text-xl mb-10 max-w-xl mx-auto">
                        Join thousands of customers who have already saved money with our AI-powered audit service.
                    </p>
                    <a href="{{ route('register') }}"
                       class="bg-white text-primary px-10 py-4 rounded-xl font-extrabold text-lg hover:bg-accent hover:text-white transition shadow-2xl inline-block">
                        Get Started — It's Free
                    </a>
                    <p class="text-white/40 text-sm mt-6">No credit card required to start.</p>
                </div>
            </div>
        </div>
    </section>
</div>
