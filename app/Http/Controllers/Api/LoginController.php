<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Requests\loginrequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use ApiTraits ;

    public function login(loginrequest $request) {
        $user = User::where('email' , $request->email)->first();
            $user->token = $user->createToken($user->name)->plainTextToken;

            return $this->data(compact('user') , 'successful opearation') ;
        
        
        
    }
}

