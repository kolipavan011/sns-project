<?php

namespace App\Traits;

use Illuminate\Support\Facades\Artisan;

trait ClearsResponseCache
{
    public static function bootClearsResponseCache()
    {
        self::created(function () {
            Artisan::call('page-cache:clear');
        });

        self::updated(function () {
            Artisan::call('page-cache:clear');
        });

        self::deleted(function () {
            Artisan::call('page-cache:clear');
        });
    }
}
