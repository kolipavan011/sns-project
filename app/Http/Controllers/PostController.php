<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index()
    {
        $post = Post::query()
            ->latest()
            ->paginate(12);

        // dd($post);

        return view('themes.postlist')->with([
            'posts' => $post,
        ]);
    }

    function show(string $slug)
    {
        $post = Post::query()
            ->with('category', 'tags')
            ->firstWhere('slug', $slug);

        $videos = $post->videos()
            ->paginate(4);

        if ($post) {
            return view('themes.post', [
                'post' => $post,
                'videos' => $videos
            ]);
        }

        return response("", 404);
    }
}
