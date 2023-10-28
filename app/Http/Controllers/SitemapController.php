<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class SitemapController extends Controller
{
    public $sitemaps = ['posts.xml', 'tags.xml', 'category.xml', 'pages.xml'];

    function index()
    {
        $sitemaps = collect($this->sitemaps)->map(function ($item) {
            return [
                'url' => route('sitemap.single', $item),
                'time' => today()->tz('UTC')->toAtomString()
            ];
        });

        return response()->view('themes.sitemap', compact('sitemaps'))
            ->header('Content-Type', 'application/xml');
    }

    function show(string $slug)
    {
        if (!in_array($slug, $this->sitemaps)) {
            return abort(404);
        }

        switch ($slug) {
            case 'pages.xml':
                $sitemaps = $this->pages();
                break;

            case 'tags.xml':
                $sitemaps = $this->tags();
                break;

            case 'category.xml':
                $sitemaps = $this->category();
                break;

            case 'posts.xml':
                $sitemaps = $this->posts();
                break;

            default:
                $sitemaps = [];
                break;
        }

        return response()->view('themes.sitemap', compact('sitemaps'))
            ->header('Content-Type', 'application/xml');
    }

    function posts()
    {
        return Post::query()
            ->where('published_at', '!=', null)
            ->latest()
            ->where('published_at', '!=', null)
            ->get(['slug', 'updated_at'])
            ->map(function ($item) {
                return [
                    'url' => route('posts.single', $item->slug),
                    'time' => $item->updated_at->tz('UTC')->toAtomString()
                ];
            });
    }

    function tags()
    {
        return Tag::query()
            ->get(['slug', 'updated_at'])
            ->map(function ($item) {
                return [
                    'url' => route('tag.single', $item->slug),
                    'time' => $item->updated_at->tz('UTC')->toAtomString()
                ];
            });
    }

    function category()
    {
        return Category::query()
            ->get(['slug', 'updated_at'])
            ->map(function ($item) {
                return [
                    'url' => route('cat.single', $item->slug),
                    'time' => $item->updated_at->tz('UTC')->toAtomString()
                ];
            });
    }

    function pages()
    {
        $pages = ['privacy-policy', 'term-and-condition', 'disclaimer'];

        return collect($pages)->map(function ($item) {
            return [
                'url' => route('pages', $item),
                'time' => today()->tz('UTC')->toAtomString()
            ];
        });
    }
}
