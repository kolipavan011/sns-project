<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    function index()
    {
        $post = Tag::query()
            ->latest()
            ->paginate(12);

        // dd($post);

        return view('themes.tagslist')->with([
            'posts' => $post,
        ]);
    }

    function show(string $slug)
    {
        $category = Tag::query()
            ->firstWhere('slug', $slug);

        $posts = $category->post()
            ->paginate(14);

        if ($category) {
            return view('themes.tag', [
                'category' => $category,
                'posts' => $posts,
            ]);
        }

        return response("", 404);
    }
}
