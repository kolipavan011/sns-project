<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\FileManager;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder;

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
