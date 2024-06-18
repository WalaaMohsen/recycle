<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;




class NewPasswordController extends Controller
{
    public function forget_password(Request $request){

        
        $validator = $request->validate([

            'email'=> 'required|email|exists:users',
        ]);
        if(!$validator){

            return response()->json(['message'=>'Invalid , This Email not founded.']);

        }
        $user = User::where('email' , $request->email)->first();

        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json(['message'=>'Please Check Your Account , We send you  Message.']);


         
    }


    

    public function reset_password(Request $request){

        $request->validate([

            'password' =>'required|min:8',
            'cpassword' => 'required',
                       
        ]);
            $token = $request->header("Authorization") ;
    
            $authuser = Auth::guard('sanctum')->user();
    
            $user = User::where('id' , $authuser->id )->first(); 

        
        User::where('id' , $user->id)->update(['password'=>Hash::make($request->password)]);
        
        return response()->json(['message'=>'Password Reseted successfully.']);

    }
  



        
    }

