<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class HomeController extends Controller
{
    function home()
    {
        $category = Category::query()
            ->latest()
            ->limit(5)
            ->get(['title', 'slug']);
        $tag = Tag::query()
            ->latest()
            ->limit(5)
            ->get(['slug']);

        $posts = Post::query()
            ->latest()
            ->paginate(16);

        return view('themes.home')->with([
            'category' => $category,
            'tag' => $tag,
            'posts' => $posts,
            'SEOData' => new SEOData(
                title: 'Explore Quotes, Shayari and Status - Storynstatus',
                description: 'Explore our collection, find daily inspiration and share the power of words with others. Whatsapp Status Video to express your feeling and Status for share emotion',
            ),
        ]);
    }
}
