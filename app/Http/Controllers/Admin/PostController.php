<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;

class PostController extends Controller
{
    public function index() //: JsonResponse
    {
        $posts = Post::query()
            ->select('id', 'title', 'published_at', 'created_at')
            ->when(request()->query('scope', 'user') != 'all', function (Builder $query) {
                return $query->where('user_id', request()->user()->id);
            }, function (Builder $query) {
                return $query;
            })
            ->when(request()->query('status', 'published') != 'draft', function (Builder $query) {
                return $query->where('published_at', '<=', now()->toDateTimeString());
            }, function (Builder $query) {
                return $query->where('published_at', '=', null)->orWhere('published_at', '>', now()->toDateTimeString());
            })
            ->latest()
            ->paginate(10)
            ->onEachSide(2);

        return response()->json($posts);
    }

    public function create(): JsonResponse
    {

        return response()->json([]);
    }

    public function show(): JsonResponse
    {

        return response()->json([]);
    }

    public function store(): JsonResponse
    {

        return response()->json([]);
    }

    public function destroy(): JsonResponse
    {

        return response()->json([]);
    }
}
