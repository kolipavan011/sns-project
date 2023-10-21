<?php

// helpers.php

function setting($key = null, $default = null)
{
    if ($key === null) {
        return app(App\Services\Setting::class);
    }

    return app(App\Services\Setting::class)->get($key, $default);
}
