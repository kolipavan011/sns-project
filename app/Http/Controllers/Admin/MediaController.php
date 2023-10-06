<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\FileManager;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder;

class MediaController extends Controller
{
    public function index(): JsonResponse
    {
        $folders = FileManager::query()
            ->select('id', 'folder_name as name', 'folder_parent as folder_id', 'created_at')
            ->where('folder_parent', request()->query('folder', '00000000-00000000-00000000-00000000'))
            ->orderBy('folder_slug')
            ->get();

        $files = File::query()
            ->select('id', 'path', 'folder_id', 'detail', 'type', 'created_at')
            ->where('folder_id', request()->query('folder', '00000000-00000000-00000000-00000000'))
            ->when(request()->query('duration', 'today') != 'all', function (Builder $query) {
                return $this->getDuration($query, request()->query('duration', 'today'));
            }, function (Builder $query) {
                return $query;
            })
            ->when(request()->query('type', 'image') != 'video', function (Builder $query) {
                return $query->where('type', '=', 'image');
            }, function (Builder $query) {
                return $query;
            })
            ->latest()
            ->get();

        return response()->json([...$folders, ...$files]);
    }

    /**
     * Get Duration query for sorting
     *
     * @param Builder $query
     * @param String $duration
     * @return Builder
     */
    private function getDuration(Builder $query, String $duration): Builder
    {
        switch ($duration) {
            case 'week':
                return $query->whereDate('created_at', '>', now()->subWeek()->toDateString())
                    ->whereDate('created_at', '<', now()->toDateString());
                break;

            case 'month':
                return $query->whereDate('created_at', '>', now()->subMonth()->toDateString())
                    ->whereDate('created_at', '<', now()->toDateString());
                break;

            case 'year':
                return $query->whereDate('created_at', '>', now()->subYear()->toDateString())
                    ->whereDate('created_at', '<', now()->toDateString());
                break;

            default:
                return $query->whereDate('created_at', '=', now()->toDateString());
                break;
        }

        return $query;
    }

    /**
     * Update Folder Name or Infomation
     *
     * @param String $id
     * @return JsonResponse
     */
    function store(String $id): JsonResponse
    {
        $name = request()->input('folder', 'Folder Name');
        $folder = FileManager::query()
            ->findOrFail($id)
            ->update([
                'folder_name' => $name,
                'folder_slug' => trim(substr($name, 0, 5))
            ]);

        return response()->json([
            'massage' => 'Success',
            'folder' => $folder,
            'name' => $name
        ]);
    }
}
