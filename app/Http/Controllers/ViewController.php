<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    /**
     * Handle incoming request
     *
     * @return View
     */
    function index()
    {
        $user = request()->user();
        $category = Category::query()
            ->get(['slug', 'title']);

        return view('vidmin')->with([
            'jsVars' => [
                'version' => '1.0.0',
                'category' => $category,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ],
                'setting' => setting()->all()
            ]
        ]);
    }
}
