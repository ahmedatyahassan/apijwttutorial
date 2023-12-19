<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    use ApiResponseTrait;
   
    public function register(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password');

        $rules = [
            'name' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',  
            'password' => 'required',
        ];
        
        $validator = Validator::make($credentials, $rules);
        if($validator->fails()) {
            return $this->validationErrorResponse($validator->messages());
        }

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);

        return $this->createdResponse($user);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (! $token = auth('api')->attempt($credentials)) {
            return $this->unauthorizedResponse();
        }
        return $this->showResponse($token);
    }

}