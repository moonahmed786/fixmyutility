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
