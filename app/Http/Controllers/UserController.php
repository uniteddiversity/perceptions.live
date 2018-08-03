<?php

namespace App\Controllers\User;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function profile()
    {
        return view('user.home')
            ->with(compact('users_data'));
    }

    public function uploadVideo()
    {
        return view('user.upload-video')
            ->with(compact('users_data'));
    }
}
