<?php

namespace App\Http\Controllers;

use RalphJSmit\Laravel\SEO\Support\SEOData;

class PageController extends Controller
{
    function index(string $slug)
    {
        $pages = ['privacy-policy', 'term-and-condition', 'disclaimer'];

        if (in_array($slug, $pages)) {
            $title = implode(' ', explode('-', $slug));

            return view('themes.pages.' . $slug, [
                'SEOData' => new SEOData(
                    title: $title,
                    description: "Please refer to $title",
                )
            ]);
        }

        return response("", 404);
    }
}
