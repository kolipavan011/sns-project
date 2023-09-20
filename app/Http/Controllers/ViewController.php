<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    function index()
    {
        return view('vidmin');
    }

    public function home()
    {
        return response('welcome');
    }
}
