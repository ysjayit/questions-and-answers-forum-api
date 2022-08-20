<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Interfaces\UserRepositoryInterface;
use App\Traits\ResponseAPI;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Log;

class UserRepository implements UserRepositoryInterface {

    use ResponseAPI;

    /**
     * Register API
     *
     * @return \Illuminate\Http\Response
     */
    public function register(UserRegisterRequest $request) {

        try {
            
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            $success['token'] =  $user->createToken('MyApp')->accessToken;
            $success['name'] =  $user->name;
            $success['role'] =  $user->role;
    
            return $this->sendResponse($success, 'User register successfully.');
            
        } catch(\Exception $e) {
            Log::error('Register Error => '.$e->getMessage());
            return $this->sendError('Error in registration.', ['error' => $e->getCode()]);
        }        

    }

    /**
     * Login API
     *
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request) {

        try {
            
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $user = Auth::user();
                
                $success['token'] =  $user->createToken('MyApp')->accessToken; 
                $success['name'] =  $user->name;
                $success['role'] =  $user->role;
       
                return $this->sendResponse($success, 'User login successfully.');
    
            } else {
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
            
        } catch(\Exception $e) {
            Log::error('Login Error => '.$e->getMessage());
            return $this->sendError('Error in login.', ['error' => $e->getCode()]);
        }

    }



}