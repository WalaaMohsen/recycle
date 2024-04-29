<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class LoginController extends Controller
{
    public function login(Request $request) {

       
            $request ->validate([
                     'email' => 'required|email',
                     'password' =>'required|string',
                      ]);
            $user = User::where('email' , $request->email)->first();

            if( !$user || (!Hash::check($request->password , $user->password))){

                return 'Can not Login , Please Check again your email and your password.';

            }
            
            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                   'email' => $request->email,
                   'token' => $token,
                   'created_at' => Carbon::now(),
         ]);

            return response()->json(['token'=>$token,'user'=>$user]);
            
    
        
    }


}
