<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    function index()
    {
        $post = Post::query()
            ->latest()
            ->paginate(12);

        // dd($post);

        return view('themes.postlist')->with([
            'posts' => $post,
        ]);
    }

    function show(string $slug)
    {
        $post = Post::query()
            ->with('category', 'tags')
            ->firstWhere('slug', $slug);

        $videos = $post->videos()
            ->paginate(14);

        $tagRelatedPost = Post::query()
            ->select('posts.*')
            ->join('posts_tags', 'posts_tags.post_id', '=', 'posts.id')
            ->distinct('posts.id')
            ->where('posts.published_at', '!=', null)
            ->whereIn('posts_tags.tag_id', $post->tags->pluck('id'))
            ->limit(10)
            ->get();

        $catRelatedPost = Post::query()
            ->select('posts.*')
            ->join('posts_category', 'posts_category.post_id', '=', 'posts.id')
            ->distinct('posts.id')
            ->where('posts.published_at', '!=', null)
            ->whereNotIn('posts.id', $tagRelatedPost->pluck('id'))
            ->whereIn('posts_category.category_id', $post->category->pluck('id'))
            ->limit(10)
            ->get();



        if ($post) {
            return view('themes.post', [
                'post' => $post,
                'videos' => $videos,
                'relatedCat' => $catRelatedPost,
                'relatedTag' => $tagRelatedPost
            ]);
        }

        return response("", 404);
    }
}
