<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
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

    public function show($id): JsonResponse
    {
        $posts = Post::query()
            ->select('id', 'created_at', 'title')
            ->with('videos')
            ->findOrFail($id);

        return response()->json($posts->videos);
    }

    public function store(): JsonResponse
    {

        return response()->json([]);
    }

    public function destroy(): JsonResponse
    {

        return response()->json([]);
    }

    /**
     * Fetch post related videos
     *
     * @param string $id
     * @return JsonResponse
     */
    public function videos(string $id): JsonResponse
    {
        $posts = Post::query()->findOrFail($id)->videos();

        return response()->json($posts);
    }

    /**
     * Fetch post related videos
     *
     * @param string $id
     * @return JsonResponse
     */
    public function insertVideos(string $id): JsonResponse
    {
        $posts = Post::query()->findOrFail($id);
        $videos = File::query()->where('type', 'video')->get(['id']);

        $dataToSync = collect($videos)->map(function ($item) {
            return $item->id;
        });

        $posts->videos()->sync($dataToSync);
        return response()->json($videos);
    }
}
