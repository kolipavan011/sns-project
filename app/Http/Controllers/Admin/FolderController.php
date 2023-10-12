<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Models\FileManager;
use App\Models\File;
use Illuminate\Database\Eloquent\Builder;
use Ramsey\Uuid\Uuid;

class FolderController extends Controller
{
    /**
     * Fetch List Of Media And folder List
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $folders = FileManager::query()
            ->select('id', 'name', 'folder_id', 'created_at')
            ->where('folder_id', request()->query('folder', FileManager::ROOT))
            ->orderBy('folder_slug')
            ->get()
            ->map(function ($item) {
                $item->type = 'folder';
                return $item;
            });

        $files = File::query()
            ->select('id', 'name', 'preview', 'path', 'folder_id', 'detail', 'type', 'created_at')
            ->where('folder_id', request()->query('folder', FileManager::ROOT))
            ->when(request()->query('duration', 'today') != 'all', function (Builder $query) {
                return $this->getDuration($query, request()->query('duration', 'today'));
            }, function (Builder $query) {
                return $query;
            })
            ->when(request()->query('type', 'image') != 'all', function (Builder $query) {
                return $query->where('type', '=', request()->query('type', 'image'));
            }, function (Builder $query) {
                return $query;
            })
            ->latest()
            ->get();

        return response()->json([...$folders, ...$files]);
    }

    /**
     * Update Folder Name or Infomation
     *
     * @param String $id
     * @return JsonResponse
     */
    public function store(String $id): JsonResponse
    {
        $name = request()->input('name', 'Folder Name');
        $folder = FileManager::query()
            ->findOrFail($id)
            ->update([
                'name' => $name,
                'folder_slug' => trim(substr($name, 0, 5))
            ]);

        return response()->json([
            'massage' => 'Success',
            'folder' => $folder,
            'name' => $name
        ]);
    }

    /**
     * Delete Media Or Folder
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        $folder = FileManager::query()
            ->findOrFail($id, ['id', 'folder_id']);

        File::query()
            ->where('folder_id', $folder->id)
            ->update(['folder_id' => $folder->folder_id]);

        $folder->delete();

        return response()->json([], 204);
    }

    /**
     * Update media and folder to new folder id
     * Basically this moves items to specific folder id
     *
     * @param string $id
     * @return JsonResponse
     */
    public function paste(string $id): JsonResponse
    {
        $folder = request()->input('folder', []);
        $files = request()->input('files', []);

        FileManager::query()
            ->whereIn('id', $folder)
            ->update(['folder_id' => $id]);

        File::query()
            ->whereIn('id', $files)
            ->update(['folder_id' => $id]);

        return response()->json([
            'massage' => 'Moved Successfully',
        ]);
    }

    /**
     * Create Folder Name or Infomation
     *
     * @param String $id
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $name = request()->input('name', 'New Folder');
        $id = request()->input('id', FileManager::ROOT);

        $folder = FileManager::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $name,
            'folder_slug' => trim(substr($name, 0, 5)),
            'folder_id' => $id,
        ]);

        if ($folder->save()) {
            return response()->json([
                'massage' => 'Success',
                'success' => true
            ]);
        }

        return response()->json([
            'massage' => 'Success',
            'success' => false

        ]);
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
}
