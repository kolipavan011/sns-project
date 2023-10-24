<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class TagController extends Controller
{
    function index()
    {
        $post = Tag::query()
            ->select('id', 'slug', 'featured_image', 'title', 'summary', 'meta')
            ->latest()
            ->paginate(12);

        return view('themes.tagslist')->with([
            'posts' => $post,
            'SEOData' => new SEOData(
                title: 'Explore Whatsapp Status Videos Tags',
                description: 'Explore our tags of Latest Whatsapp Status, find daily inspiration and share the power of videos with others. Whatsapp Status Video to express your feeling and share emotion',
            ),
        ]);
    }

    function show(string $slug)
    {
        $category = Tag::query()
            ->firstWhere('slug', $slug);


        if (!$category) {
            abort(404);
        }

        $posts = $category->post()
            ->paginate(14);

        return view('themes.tag', [
            'category' => $category,
            'posts' => $posts,
            'SEOData' => new SEOData(
                title: $category->meta['title'],
                description: $category->meta['description'],
            ),
        ]);
    }
}
