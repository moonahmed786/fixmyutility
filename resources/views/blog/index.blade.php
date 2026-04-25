@extends('layouts.app')

@section('content')
<div class="py-24 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-dark mb-4">Insights & News</h1>
            <p class="text-dark/60 max-w-2xl mx-auto">Stay informed about utility market trends, billing tips, and how to save more money.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
            <article class="bg-white rounded-2xl shadow-sm border border-secondary/10 overflow-hidden hover:shadow-md transition">
                @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-secondary/10 flex items-center justify-center">
                        <svg class="w-12 h-12 text-secondary/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                <div class="p-8">
                    <div class="flex items-center gap-4 mb-4 text-xs font-bold text-primary uppercase">
                        <span>{{ $post->category?->name ?? 'Utility Tips' }}</span>
                        <span class="text-dark/20">&bull;</span>
                        <span class="text-dark/40">{{ $post->published_at->format('M d, Y') }}</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 hover:text-primary transition">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-dark/60 mb-6 line-clamp-3">{{ $post->excerpt }}</p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-primary font-bold flex items-center gap-2">
                        Read More 
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-24 text-dark/40 font-medium">
                No articles published yet.
            </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection
