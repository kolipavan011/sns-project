<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    function index()
    {
        $post = Category::query()
            ->latest()
            ->paginate(12);

        // dd($post);

        return view('themes.categorylist')->with([
            'posts' => $post,
        ]);
    }

    function show(string $slug)
    {
        $category = Category::query()
            ->firstWhere('slug', $slug);

        $posts = $category->post()
            ->paginate(14);

        if ($category) {
            return view('themes.category', [
                'category' => $category,
                'posts' => $posts,
            ]);
        }

        return response("", 404);
    }
}
