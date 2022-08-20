<?php

namespace App\Interfaces;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

interface UserRepositoryInterface 
{
    public function register(UserRegisterRequest $request);
    public function login(UserLoginRequest $request);
}