<?php

namespace App\Http\Controllers;

use App\Models\Category;
use RalphJSmit\Laravel\SEO\Support\SEOData;


class CategoryController extends Controller
{
    function index()
    {
        $post = Category::query()
            ->select('id', 'slug', 'featured_image', 'summary', 'meta')
            ->latest()
            ->paginate(12);

        return view('themes.categorylist')->with([
            'posts' => $post,
            'SEOData' => new SEOData(
                title: 'Explore Whatsapp Status Videos Categories',
                description: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima expedita quaerat officia eaque, molestias, neque adipisci aperiam officiis',
            ),
        ]);
    }

    function show(string $slug)
    {
        $category = Category::query()
            ->firstWhere('slug', $slug);

        if (!$category) {
            return abort(404);
        }

        $posts = $category->post()
            ->paginate(14);

        if ($category) {
            return view('themes.category', [
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
