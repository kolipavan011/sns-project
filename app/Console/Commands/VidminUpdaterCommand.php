<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use XiDanko\UpdateManager\UpdateManager;

class VidminUpdaterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vidmin:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update to latest version';

    /**
     * Execute the console command.
     */
    public function handle(UpdateManager $updateManager)
    {
        $this->info("Current Version : " . $updateManager->getCurrentVersion());


        if ($updateManager->isNewVersionAvailable()) {

            $this->info('New Update Available : ' . $updateManager->getLatestVersion());

            if ($this->confirm('Do you wish to continue?')) {
                $updateManager->updateToLatestVersion();
                $this->info('App Updated to ' . $updateManager->getCurrentVersion());
            }
        } else {
            $this->info('No Update Available');
        }
    }
}
