<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use Auth;

class LoginController extends Controller
{
    public function Login(LoginRequest $request)
    {
        if(!Auth::attempt($request->only('email','password'))){
            Helper::sendError('Email Or Password is wroing !!!');
        }
        return new UserResource(auth()->user());
    }
}
