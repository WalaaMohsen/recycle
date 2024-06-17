<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\ForgetPasswordMail;




class NewPasswordController extends Controller
{
    public function forget_password(Request $request){

        
        $validator = $request->validate([

            'email'=> 'required|email|exists:users',
        ]);
        if(!$validator){

            return response()->json(['message'=>'Invalid , This Email not founded.']);

        }
        $token = Str::random(64);
        DB::table('password_reset_tokens')->insert([
                  'email' => $request->email,
                  'token' => $token,
                  'created_at' => Carbon::now(),
        ]);
        Mail::send('emails.forget',['token' =>$token],function($message) use ($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return response()->json(['message'=>'Please Check Your Account , We send you  Message.']);


         
    }


    

    public function reset_password(Request $request){

        $request->validate([

            'email'=> 'required|email|exists:users',
            'password' =>'required|min:8',
            'cpassword' => 'required',
                       
        ]);
    if($request->password == $request->cpassword){
        $updatePassword = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if(!$updatePassword){

            return response()->json(['message'=>'Invalid, Not Founded This Email.']);

        }
        User::where('email' , $request->email)->update(['password'=>Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        
        return response()->json(['message'=>'Password Reseted successfully.']);

    }
    else{
        return response()->json(['message'=>'Password and Confirm are not match.']);

    }



        
    }
}
