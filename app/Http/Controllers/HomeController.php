<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

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

        return view('themes.home')->with([
            'category' => $category,
            'tag' => $tag,
        ]);
    }
}
