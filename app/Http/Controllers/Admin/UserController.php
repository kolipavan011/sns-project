<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    function store(UserRequest $request)
    {
        $data = $request->validated();

        User::query()
            ->where('id', request()->user()->id)
            ->update([
                'email' => $data['email'],
                'name' => $data['name'],
            ]);

        return response()->json([
            'massage' => 'Updated',
            'data' => $data
        ]);
    }
}
