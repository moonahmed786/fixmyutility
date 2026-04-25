@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="font-heading text-4xl md:text-6xl font-extrabold text-dark mb-6">
                    Get in <span class="text-primary">Touch</span>
                </h1>
                <p class="text-xl text-dark/60">Have questions? Our team is here to help you save.</p>
            </div>

            @if(session('success'))
                <div class="mb-8 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-2xl font-medium">
                    <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-5 gap-12">
                {{-- Form --}}
                <div class="md:col-span-3 bg-white p-10 rounded-3xl shadow-xl border border-secondary/10">
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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
                        <div>
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="form-input @error('phone') border-red-400 @enderror"
                                   placeholder="+1 (555) 000-0000" required>
                            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="form-label">Subject <span class="text-dark/40 font-normal">(optional)</span></label>
                            <input type="text" name="subject" value="{{ old('subject') }}"
                                   class="form-input"
                                   placeholder="How can we help?">
                        </div>
                        <div>
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="5"
                                      class="form-input @error('message') border-red-400 @enderror"
                                      placeholder="Tell us about your utility billing issue…" required>{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <button type="submit" class="w-full btn-primary font-bold py-4 text-base">
                            Send Message
                        </button>
                    </form>
                </div>

                {{-- Info --}}
                <div class="md:col-span-2 flex flex-col justify-center space-y-10">
                    <div>
                        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h4 class="font-heading text-xl font-bold text-dark mb-2">Email Us</h4>
                        <p class="text-dark/60">support@fixmyutility.com</p>
                        <p class="text-dark/60">billing@fixmyutility.com</p>
                    </div>

                    <div>
                        <div class="w-12 h-12 bg-secondary/10 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-secondary-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-heading text-xl font-bold text-dark mb-2">Response Time</h4>
                        <p class="text-dark/60">We respond within 24 hours on business days.</p>
                    </div>

                    <div>
                        <div class="w-12 h-12 bg-accent/20 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-accent-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h4 class="font-heading text-xl font-bold text-dark mb-2">Serving</h4>
                        <p class="text-dark/60">USA · Canada · United Kingdom</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
