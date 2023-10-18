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
        return view('vidmin')->with(['jsVars' => [
            'version' => '1.0.0'
        ]]);
    }
}
