<div class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-dark mb-4">Our Audit Services</h1>
            <p class="text-dark/60 max-w-2xl mx-auto">We provide comprehensive utility auditing to ensure you never pay more than you should.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-secondary/10 hover:shadow-md transition">
                <div class="w-12 h-12 bg-primary/10 text-primary rounded-lg flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-2xl font-bold mb-4">{{ $service->title }}</h3>
                <p class="text-dark/60 mb-6">{{ $service->excerpt }}</p>
                <a href="{{ route('services.show', $service->slug) }}" class="text-primary font-bold hover:underline">Learn More &rarr;</a>
            </div>
            @endforeach
        </div>
    </div>
</div>
