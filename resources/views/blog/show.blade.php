@extends('layouts.app')

@section('content')
<article class="py-24 bg-background">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex mb-8 text-sm font-medium text-dark/50" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <span class="mx-2">&rarr;</span>
            <a href="{{ route('blog.index') }}" class="hover:text-primary">Blog</a>
            <span class="mx-2">&rarr;</span>
            <span class="text-dark">{{ $post->title }}</span>
        </nav>

        <header class="mb-12">
            <div class="flex items-center gap-4 mb-6 text-sm font-bold text-primary uppercase">
                <span>{{ $post->category?->name ?? 'Utility Tips' }}</span>
                <span class="text-dark/20">&bull;</span>
                <span class="text-dark/40">{{ $post->published_at->format('M d, Y') }}</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-extrabold text-dark leading-tight mb-8">{{ $post->title }}</h1>
            
            @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full rounded-3xl shadow-2xl mb-12">
            @endif
        </header>

        <div class="prose prose-lg max-w-none text-dark/80">
            {!! $post->content !!}
        </div>

        <footer class="mt-16 pt-8 border-t border-secondary/10">
            <div class="flex justify-between items-center">
                <div class="flex gap-4">
                    <button class="w-10 h-10 rounded-full bg-white border border-secondary/20 flex items-center justify-center hover:bg-secondary/10 transition">
                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </button>
                    <!-- Add more social share buttons as needed -->
                </div>
                <a href="{{ route('blog.index') }}" class="font-bold text-primary hover:underline">&larr; Back to Articles</a>
            </div>
        </footer>
    </div>
</article>
@endsection
