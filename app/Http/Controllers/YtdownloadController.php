<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use YouTube\YouTubeDownloader;
use YouTube\Utils\Utils;
use YouTube\Exception\YouTubeException;
use Carbon\Carbon;
use App\Models\File;
use App\Models\FileManager;
use Ramsey\Uuid\Uuid;

class YtdownloadController extends Controller
{
    function index(): JsonResponse
    {
        $params = request()->all();
        $youtube = new YouTubeDownloader();

        try {
            $downloadOptions = $youtube->getDownloadLinks("https://www.youtube.com/watch?v=" . $params['id']);

            if ($downloadOptions->getAllFormats()) {
                $formats = $downloadOptions->getCombinedFormats();

                $video = Utils::arrayFilterReset($formats, function ($format) {
                    return strpos($format->mimeType, 'video/mp4') === 0 && !empty($format->audioQuality);
                });

                $this->saveVideo($params['id'], $video[0]->url, $params['keyword'], $params['title']);
                return response()->json(['massage' => 'success']);
            } else {
                return response()->json(['massage' => 'No links found'], 400);
            }
        } catch (YouTubeException $e) {
            return response()->json(['massage' => $e->getMessage()], 400);
        }
    }

    private function saveVideo(string $id, string $url, string $keyword, string $title): Bool
    {
        $now = Carbon::now();
        $path = "public/{$now->year}/{$now->month}/";

        $imgPath = "{$path}{$id}.jpg";


        Storage::put($imgPath, file_get_contents('http://img.youtube.com/vi/' . $id . '/hqdefault.jpg'));

        File::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $keyword . ' image-' . time(),
            'preview' => Storage::url($imgPath),
            'path' => Storage::url($imgPath),
            'type' => 'image',
            'user_id' => request()->user()->id,
            'folder_id' => FileManager::ROOT,
            'detail' => [
                'size' => substr((Storage::size($imgPath) / 1000000), 0, 3) . 'MB',
            ]
        ])->save();

        // Get video from youtube and add

        $keyword = str_replace(" ", "-", "{$keyword} " . time());
        $videoPath = "{$path}{$keyword}.mp4";

        Storage::put($videoPath, file_get_contents($url));

        File::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => $title,
            'preview' => Storage::url($imgPath),
            'path' => Storage::url($videoPath),
            'type' => 'video',
            'user_id' => request()->user()->id,
            'folder_id' => FileManager::ROOT,
            'detail' => [
                'size' => substr((Storage::size($videoPath) / 1000000), 0, 3) . 'MB',
            ]
        ])->save();

        return true;
    }
}
