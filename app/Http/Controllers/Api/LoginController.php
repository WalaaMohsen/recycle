<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Requests\loginrequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use ApiTraits ;

    public function login(loginrequest $request) {
        $user = User::where('email' , $request->email)->first();
            $user->token = $user->createToken($user->name)->plainTextToken;

            return $this->data(compact('user') , 'successful opearation') ;
        
        
        
    }
    public function logout_all_devices(){
        $authuser =  Auth::guard('sanctum')->user();
        $authuser->tokens()->delete();
        return $this->MessageSuccess('sucsses');
    }
}

