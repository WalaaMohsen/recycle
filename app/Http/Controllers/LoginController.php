<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class LoginController extends Controller
{
    public function getlogin() {

        return view('user.login');
        
    }

    public function login(Request $request)  {

        $request ->validate([
            'email' => 'required|email',
            'password' =>'required',
             ]);

        $user = User::where('email' , $request->email)->first();

        if(!Hash::check($request->password , $user->password)){

            return 'Can not Login , Please Check again your email and your password.';

        }

            $token = Str::random(64);
            DB::table('password_reset_tokens')->insert([
                   'email' => $request->email,
                   'token' => $token,
                   'created_at' => Carbon::now(),
         ]);

        return view('profile',compact(['token'=>$token,'user'=>$user]));
    }
}
