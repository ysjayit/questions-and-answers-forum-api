<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\UserRepositoryInterface;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class RegisterController extends Controller
{

    private UserRepositoryInterface $userInterface;

    public function __construct(UserRepositoryInterface $userInterface)
    {
        $this->userInterface = $userInterface;
    }

    /**
     * Register API
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request) {

        return $this->userInterface->register($request);

    }

    /**
     * Login API
     *
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request) {

        return $this->userInterface->login($request);

    }

}
