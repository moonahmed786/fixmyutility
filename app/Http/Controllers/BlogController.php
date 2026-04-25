<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_active', true)
            ->whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(12);
            
        return view('blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
            
        return view('blog.show', compact('post'));
    }
}
