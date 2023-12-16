<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Alaouy\Youtube\Facades\Youtube;

class VidbotCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vidbot {keyword}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Vidbot for youtube video download';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $keyword = $this->argument('keyword');

        // Search playlists, channels and videos. return an array of PHP objects
        $results = Youtube::searchVideos($keyword);

        $this->info(json_encode($results));
    }
}
