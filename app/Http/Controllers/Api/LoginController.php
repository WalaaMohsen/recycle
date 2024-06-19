<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Requests\loginrequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiTraits ;

    public function login(loginrequest $request) {
        $user = User::where('email' , $request->email)->first();

             if(! Hash::check($request->password, $user->password)){
            return $this->MessageError(['login' => "incorrect email or password"] , "tryagain" , 401);
        }
            $user->token = $user->createToken($user->name)->plainTextToken;

            return new UserResourse($user) ;
        
        
        
    }
    public function logout_all_devices(){
        $authuser =  Auth::guard('sanctum')->user();
        $authuser->tokens()->delete();
        return $this->MessageSuccess('sucsses');
    }
}

