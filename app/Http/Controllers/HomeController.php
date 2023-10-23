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
            ->select('id', 'slug', 'title')
            ->latest()
            ->limit(5)
            ->get(['title', 'slug']);
        $tag = Tag::query()
            ->select('id', 'slug', 'title')
            ->latest()
            ->limit(5)
            ->get(['slug']);

        $posts = Post::query()
            ->select('id', 'slug', 'featured_image', 'title', 'summary')
            ->where('published_at', '!=', null)
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
