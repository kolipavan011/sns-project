<?php

namespace App\Http\Controllers;

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

        return view('vidmin')->with([
            'jsVars' => [
                'version' => '1.0.0',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ]
        ]);
    }
}
