<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class TagController extends Controller
{
    /**
     * List tags as pagination
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tags = Tag::query()
            ->select('id', 'title', 'created_at')
            ->when(request()->query('scope', 'user') != 'all', function (Builder $query) {
                return $query->where('user_id', request()->user()->id);
            }, function (Builder $query) {
                return $query;
            })
            ->latest()
            ->paginate(10)
            ->onEachSide(2);

        return response()->json($tags);
    }

    /**
     * Store Tag
     *
     * @param TagRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function store(TagRequest $request, string $id): JsonResponse
    {
        $data = $request->validated();

        $tag = Tag::query()
            ->find($id);

        if (!$tag) {
            $tag = new Tag(['id' => $id]);
        }

        $tag->fill($data);
        $tag->user_id = $tag->user_id ?? request()->user()->id;
        $tag->save();

        return response()->json($tag->refresh(), 201);
    }

    /**
     * Show tag
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $tag = Tag::query()
            ->findOrFail($id);

        return response()->json(['post' => $tag]);
    }

    /**
     * Create new tag
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $uuid = Uuid::uuid4();

        return response()->json([
            'post' => Tag::query()->make([
                'id' => $uuid->toString(),
                'slug' => "tag-{$uuid->toString()}",
            ])
        ]);
    }
}
