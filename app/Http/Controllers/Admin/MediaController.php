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

        $path = $file->storeAs('public/' . $now->year . '/' . $now->month, str_replace(array('(', ')', " "), '', $file->getClientOriginalName()));

        if (!$path) {
            return response()->json(['massage' => 'failed to upload']);
        }

        $fileType = explode('/', Storage::mimeType($path))[0];

        $media = File::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $file->getClientOriginalName(),
            'preview' => $fileType === 'video' ? '/img/video.svg' : Storage::url($path),
            'path' => Storage::url($path),
            'type' => $fileType,
            'user_id' => request()->user()->id,
            'folder_id' => $id,
            'detail' => [
                'size' => substr((Storage::size($path) / 1000000), 0, 3) . 'MB',
            ]
        ])->save();

        return response()->json([
            'massage' => 'uploaded succes',
            'url' => $media
        ]);
    }

    public function uploadThumbnail(string $id): JsonResponse
    {
        if (request()->exists('filepond')) {

            $image = request()->input('filepond', '');
            $name = str_replace(array('(', ')', " "), '', request()->input('filename', time()));

            if (strlen($image) < 128) {
                return response()->json(null, 400);
            }

            list($mime, $data)   = explode(';', $image);
            list(, $data)       = explode(',', $data);
            $data = base64_decode($data);

            $mime = explode(':', $mime)[1];
            $ext = explode('/', $mime)[1];
            $type = explode('/', $mime)[0];
            $now = Carbon::now();

            $path = "public/{$now->year}/{$now->month}/{$name}" . time() . ".{$ext}";


            $uploadedFile = Storage::put($path, $data);

            $media = File::create([
                'id' => Uuid::uuid4()->toString(),
                'name' => "{$name}.{$ext}",
                'preview' => $type === 'video' ? '/img/video.svg' : Storage::url($path),
                'path' => Storage::url($path),
                'type' => $type,
                'user_id' => request()->user()->id,
                'folder_id' => $id,
                'detail' => [
                    'size' => substr((Storage::size($path) / 1000000), 0, 3) . 'MB',
                ]
            ])->save();

            File::query()->find(request()->input('video'))->update(['preview' => Storage::url($path)]);

            return response()->json([
                'massage' => 'uploaded succes',
                'data' => $uploadedFile
            ]);
        }

        return response()->json(null, 400);
    }

    /**
     * Delete Media
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        File::query()
            ->findOrFail($id, ['id', 'path'])
            ->delete();

        return response()->json([], 204);
    }
}
