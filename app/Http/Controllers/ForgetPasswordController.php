<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgetPasswordMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ForgetPasswordController extends Controller
{
    public function forget() {

        return view('user.forget');
        
    }

    public function forget_password(Request $request){

         /*$user = User::where('email' , '=' , $request->email)->first();
         if(!empty($user)){

            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ForgetPasswordMail($user));

            return redirect()->back()->with('success' , 'Please check your email and reset your password.');

         }
         else{

            return redirect()->back()->with('error' , 'Email not found in the system.');
         }*/
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
         return redirect()->to(route('forget'))->with('success' , 'Please check your email and reset your password.');

        
    }
    public function reset($token){

        /*$user = User::where('remember_token' , '=' , $token)->first();

        if(!empty($user)){

            $data['user'] = $user;

             return view('user.reset' ,compact('data'));
        }
        else{

            abort(404);
        }*/
        return view('user.reset' ,compact('token'));
        
    }
    public function post_reset(Request $request){

        /*$user = User::where('remember_token' , '=' , $token)->first();

        if(!empty($user)){

            
            if($request->password == $request->cpassword){
                $user->password = Hash::make($request->password);
                if(empty($user->email_verified_at)){

                     $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->remember_token = Str::random(40);
                $user->save();
                return redirect('getlogin')->with('success' , 'Password reseted successfully.');


            }
            else{
                return redirect()->back()->with('error' , 'Password and Confirm Password does not match.');

            }
        }
        else{

            abort(404);
        }*/

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

            return redirect()->back()->with('error' , 'Invalid');
        }
        User::where('email' , $request->email)->update(['password'=>Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        
        return redirect()->to(route('getlogin'))->with('success' , 'Password Reseted Successfully.');

    }
    else{
        return redirect()->back()->with('error' , 'Password and Confirm Password does not match.');

    }



        
    }
}
