@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm font-medium text-dark/50" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <span class="mx-2">&rarr;</span>
            <a href="{{ route('services.index') }}" class="hover:text-primary">Services</a>
            <span class="mx-2">&rarr;</span>
            <span class="text-dark">{{ $service->title }}</span>
        </nav>

        <h1 class="text-4xl md:text-5xl font-bold text-dark mb-8">{{ $service->title }}</h1>
        
        <div class="prose prose-lg max-w-none text-dark/80">
            {!! $service->content !!}
        </div>

        <div class="mt-20 pt-12 border-t border-secondary/10">
            <h2 class="text-3xl font-bold text-dark mb-8 text-center">Have questions about this service?</h2>
            
            @if(session('success'))
                <div class="mb-8 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl font-medium">
                    <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contact.send') }}" method="POST" class="bg-white p-8 rounded-3xl shadow-lg border border-secondary/10">
                @csrf
                <input type="hidden" name="service_slug" value="{{ $service->slug }}">
                <input type="hidden" name="subject" value="Inquiry for {{ $service->title }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-input @error('name') border-red-400 @enderror"
                               placeholder="John Doe" required>
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-input @error('email') border-red-400 @enderror"
                               placeholder="john@example.com" required>
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                
                <div class="mb-6">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                           class="form-input @error('phone') border-red-400 @enderror"
                           placeholder="+1 (555) 000-0000" required>
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-8">
                    <label class="form-label">Message</label>
                    <textarea name="message" rows="4"
                              class="form-input @error('message') border-red-400 @enderror"
                              placeholder="How can we help you with your {{ $service->title }}?" required>{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full btn-primary py-4 font-bold text-base">
                    Submit Inquiry
                </button>
            </form>
        </div>

        <div class="mt-12 p-8 bg-primary rounded-2xl text-white text-center">
            <h3 class="text-2xl font-bold mb-4">Start your audit today</h3>
            <p class="mb-8 text-white/80">Upload your bill and let our AI find potential savings in minutes.</p>
            <a href="{{ route('register') }}" class="bg-white text-primary px-8 py-3 rounded-lg font-bold hover:bg-accent transition inline-block">
                Get Started
            </a>
        </div>
    </div>
</div>
@endsection
