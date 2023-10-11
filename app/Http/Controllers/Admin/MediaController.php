<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\FileManager;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class MediaController extends Controller
{

    /**
     * Update Media Name or Infomation
     *
     * @param String $id
     * @return JsonResponse
     */
    public function store(String $id): JsonResponse
    {
        $name = request()->input('name', 'New Media');
        $folder = File::query()
            ->findOrFail($id)
            ->update([
                'name' => $name
            ]);

        return response()->json([
            'massage' => 'Success',
            'folder' => $folder,
            'name' => $name
        ]);
    }

    /**
     * Upload Media Handling on server
     *
     * @param string $id
     * @return JsonResponse
     */
    public function upload(string $id): JsonResponse
    {
        $payload = request()->file();
        $now = Carbon::now();

        if (!$payload) {
            return response()->json(null, 400);
        }

        // Only grab the first element because single file uploads
        // are not supported at this time
        $file = reset($payload);

        $path = $file->storeAs('public/' . $now->year . '/' . $now->month, $file->getClientOriginalName());

        if (!$path) {
            return response()->json(['massage' => 'failed to upload']);
        }

        $media = File::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $file->getClientOriginalName(),
            'path' => Storage::url($path),
            'type' => explode('/', Storage::mimeType($path))[0],
            'user_id' => request()->user()->id,
            'folder_id' => $id,
            'detail' => [
                'size' => Storage::size($path)
            ]
        ])->save();

        return response()->json([
            'massage' => 'uploaded succes',
            'url' => $media
        ]);
    }

    /**
     * Delete Media
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $obj = File::query()
            ->findOrFail($id, ['id'])
            ->delete();

        return response()->json([
            'massage' => 'delete successfully',
        ]);
    }
}