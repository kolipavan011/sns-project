<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json([
            'setting' => setting()->all(),
            'category' => Category::query()->get(['slug', 'title'])
        ]);
    }

    public function store()
    {

        return response()->json(setting()
            ->put(request()->all())
            ->all());
    }
}
