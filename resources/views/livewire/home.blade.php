<div class="bg-background">
    <!-- Hero Section -->
    <section class="relative py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="lg:grid lg:grid-cols-2 lg:gap-16 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-5xl md:text-7xl font-extrabold text-dark leading-tight mb-6">
                        Stop Overpaying for <span class="text-primary">Utilities</span>
                    </h1>
                    <p class="text-xl text-dark/70 mb-10 max-w-xl mx-auto lg:mx-0">
                        Our AI-powered auditing tool analyzes your electricity, gas, and water bills to find errors and hidden charges. We help you dispute overcharges and save hundreds every year.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="btn-primary text-lg font-bold shadow-xl shadow-primary/20 flex items-center justify-center">
                            Start Free Analysis
                        </a>
                        <a href="{{ route('services.index') }}" class="bg-white border-2 border-secondary text-primary px-8 py-3 rounded-lg font-bold hover:bg-secondary/10 transition text-lg flex items-center justify-center">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="mt-16 lg:mt-0 relative">
                    <div class="bg-gradient-to-tr from-accent/30 to-secondary/30 absolute -inset-4 rounded-3xl blur-3xl opacity-50 -z-10"></div>
                    <div class="bg-white p-8 rounded-2xl shadow-2xl border border-secondary/10">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-xl font-bold">Sample Bill Audit</h3>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold">Analyzed</span>
                        </div>
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold">Tariff Mismatch Found</h4>
                                    <p class="text-sm text-dark/60">You are being charged on 'Peak Rate' during 'Off-Peak' hours.</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 bg-accent/20 rounded-lg flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold">Overcharge Detected</h4>
                                    <p class="text-sm font-bold text-red-500">Estimated Saving: $142.50</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-dark mb-4">How We Help You Save</h2>
                <p class="text-dark/60 max-w-2xl mx-auto">Expert utility auditing for various bill types across the USA, UK, and Canada.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredServices as $service)
                <div class="p-8 rounded-2xl bg-background border border-secondary/10 hover:shadow-xl transition-all duration-300 group">
                    <div class="w-16 h-16 bg-primary text-white rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <!-- Simplified icons based on slug -->
                        @if($service->slug == 'electricity-audit')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        @elseif($service->slug == 'gas-audit')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.98 7.98 0 01-2.343 5.657z"></path></svg>
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        @endif
                    </div>
                    <h3 class="text-2xl font-bold mb-4">{{ $service->title }}</h3>
                    <p class="text-dark/60 mb-6">{{ $service->excerpt }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="text-primary font-bold inline-flex items-center hover:gap-2 transition-all">
                        View Details 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-primary rounded-3xl p-12 md:p-20 text-center relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-accent/20 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-secondary/20 rounded-full blur-3xl"></div>
                <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 relative z-10">Ready to Lower Your Bills?</h2>
                <p class="text-white/80 text-xl mb-10 max-w-xl mx-auto relative z-10">Join thousands of customers who have already saved money with our audit service.</p>
                <a href="{{ route('register') }}" class="bg-white text-primary px-10 py-4 rounded-xl font-extrabold text-xl hover:bg-accent transition shadow-2xl relative z-10 inline-block">
                    Get Started Now
                </a>
            </div>
        </div>
    </section>
</div>
