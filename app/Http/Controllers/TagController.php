<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class TagController extends Controller
{
    function index()
    {
        $post = Tag::query()
            ->select('id', 'slug', 'featured_image', 'title', 'summary')
            ->latest()
            ->paginate(12);

        // dd($post);

        return view('themes.tagslist')->with([
            'posts' => $post,
            'SEOData' => new SEOData(
                title: 'Explore Whatsapp Status Videos Tags',
                description: 'Tag Description Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita quaerat officia eaque, molestias, neque adipisci aperiam',
            ),
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
                'SEOData' => new SEOData(
                    title: $category->meta['title'],
                    description: $category->meta['description'],
                ),
            ]);
        }

        return response("", 404);
    }
}
