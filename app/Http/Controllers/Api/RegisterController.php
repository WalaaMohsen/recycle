<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\traits\ApiTraits;

class RegisterController extends Controller
{
    use ApiTraits;
    public function register(RegisterRequest $request)  {
        $data = $request->except('password' , 'password_confirmation');
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->token = $user->createToken($request->name)->plainTextToken;

        return $this->data(compact('user'), "success");

    }
}
