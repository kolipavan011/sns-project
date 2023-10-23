<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class DashController extends Controller
{
    public function index(): JsonResponse
    {
        $postsCount = Post::query()->count();
        $catsCount = Category::query()->count();
        $tagsCount = Tag::query()->count();

        return response()->json([
            'posts' => $postsCount,
            'category' => $catsCount,
            'tags' => $tagsCount,
        ]);
    }
}
