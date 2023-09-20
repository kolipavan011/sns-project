<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    function index() {
        // code
    }

    public function home() {
        return response('welcome');
    }
}
