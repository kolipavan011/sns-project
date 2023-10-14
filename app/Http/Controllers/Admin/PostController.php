<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Post;
use App\Models\Tag;
use Canvas\Http\Requests\PostRequest;
use Ramsey\Uuid\Uuid;

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
        $uuid = Uuid::uuid4();

        return response()->json([
            'post' => Post::query()->make([
                'id' => $uuid->toString(),
                'slug' => "post-{$uuid->toString()}",
            ]),
            'tags' => Tag::query()->get(['title', 'slug']),
            'category' => Category::query()->get(['title', 'slug']),
        ]);
    }

    public function show($id): JsonResponse
    {
        $posts = Post::query()
            ->with('tags:id,title', 'category:id,title')
            ->findOrFail($id);

        $tags = Tag::query()->get(['id', 'slug', 'title']);
        $category = Category::query()->get(['id', 'slug', 'title']);

        return response()->json([
            'post' => $posts,
            'tags' => $tags,
            'category' => $category
        ]);
    }

    /**
     * Syncing video with posts
     *
     * @param string $id
     * @return JsonResponse
     */
    public function videoSync(string $id): JsonResponse
    {
        $videos = request()->input('videos', []);

        $posts = Post::query()
            ->findOrFail($id, ['id']);

        $posts->videos()
            ->sync($videos);

        return response()->json(['msg' => 'success']);
    }

    public function videoDetach(string $id): JsonResponse
    {
        $videoID = request()->input('videoid', null);

        if ($videoID) {
            $posts = Post::query()
                ->findOrFail($id, ['id']);

            $posts->videos()
                ->detach($videoID);
        }

        return response()->json(['msg' => 'success']);
    }

    public function store(PostRequest $request, $id): JsonResponse
    {
        $data = $request->validated();

        $post = Post::query()
            ->find($id);

        if (!$post) {
            $post = new Post(['id' => $id]);
        }

        $post->fill($data);
        $post->user_id = $post->user_id ?? request()->user('canvas')->id;
        $post->save();

        $tagsToSync = collect($request->input('tags', []))->map(function ($tag) {
            return (string) $tag->id;
        })->toArray();

        $categoryToSync = collect($request->input('category', []))->map(function ($tag) {
            return (string) $tag->id;
        })->toArray();

        $post->tags()->sync($tagsToSync);
        $post->category()->sync($categoryToSync);

        return response()->json($post->refresh(), 201);
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
        $posts = Post::query()
            ->select('id', 'created_at', 'title')
            ->with('videos')
            ->findOrFail($id);

        return response()->json($posts->videos);
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
