<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;
use App\Http\Requests\TagRequest;

class CategoryController extends Controller
{
    /**
     * List the category
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tags = Category::query()
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
     * Show category
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $tag = Category::query()
            ->findOrFail($id);

        return response()->json(['post' => $tag]);
    }

    /**
     * Create new category
     *
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $uuid = Uuid::uuid4();

        return response()->json([
            'post' => Category::query()->make([
                'id' => $uuid->toString(),
                'slug' => "cat-{$uuid->toString()}",
            ])
        ]);
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

        $category = Category::query()
            ->find($id);

        if (!$category) {
            $category = new Category(['id' => $id]);
        }

        $category->fill($data);
        $category->user_id = $category->user_id ?? request()->user()->id;
        $category->save();

        return response()->json($category->refresh(), 201);
    }
}
