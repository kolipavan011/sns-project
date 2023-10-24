<?php

namespace App\Http\Controllers;

use App\Models\Post;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class PostController extends Controller
{
    function index()
    {
        $post = Post::query()
            ->select('id', 'slug', 'featured_image', 'title', 'summary')
            ->where('published_at', '!=', null)
            ->latest()
            ->paginate(12);

        // dd($post);

        return view('themes.postlist')->with([
            'posts' => $post,
            'SEOData' => new SEOData(
                title: 'Explore Latest Whatsapp Status Videos',
                description: 'Explore our collection of Latest Whatsapp Status, find daily inspiration and share the power of videos with others. Whatsapp Status Video to express your feeling and share emotion',
            ),
        ]);
    }

    function show(string $slug)
    {
        $post = Post::query()
            ->with('category', 'tags')
            ->where('published_at', '!=', null)
            ->firstWhere('slug', $slug);

        if (!$post) {
            return abort(404);
        }

        $videos = $post->videos()
            ->paginate(14);

        $tagRelatedPost = Post::query()
            ->select('posts.*')
            ->join('posts_tags', 'posts_tags.post_id', '=', 'posts.id')
            ->distinct('posts.id')
            ->where('posts.published_at', '!=', null)
            ->where('posts.id', '!=', $post->id)
            ->whereIn('posts_tags.tag_id', $post->tags->pluck('id'))
            ->limit(10)
            ->get();

        $catRelatedPost = Post::query()
            ->select('posts.*')
            ->join('posts_category', 'posts_category.post_id', '=', 'posts.id')
            ->distinct('posts.id')
            ->where('posts.published_at', '!=', null)
            ->whereNotIn('posts.id', $tagRelatedPost->pluck('id'))
            ->where('posts.id', '!=', $post->id)
            ->whereIn('posts_category.category_id', $post->category->pluck('id'))
            ->limit(10)
            ->get();



        if ($post) {
            return view('themes.post', [
                'post' => $post,
                'videos' => $videos,
                'relatedCat' => $catRelatedPost,
                'relatedTag' => $tagRelatedPost,
                'SEOData' => new SEOData(
                    title: $post->meta['title'],
                    description: $post->meta['description'],
                ),
            ]);
        }

        return response("", 404);
    }
}
