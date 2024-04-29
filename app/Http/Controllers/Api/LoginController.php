<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\NewAccessToken;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class LoginController extends Controller
{
    public function login(Request $request) {

       
            $validator = Validator($request->all(),[
                     'email' => 'required|email|exists:users,email',
                     'password' =>'required|min:8',
                      ]);
                
                if(!$validator->fails()){

                    $user = User::where('email' , $request->email)->first();

                    if(Hash::check($request->password , $user->password)){

                        $token = Str::random(64);
                        DB::table('password_reset_tokens')->insert([
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => Carbon::now(),
                         ]);
                         return response()->json(['token'=>$token,'user'=>$user]);
                        }
                        else{
                            
                            return 'Can not Login , Please Check again your email and your password.';

                        }
                       }
                       else{
                             return response()->json([
                                'messege'=> $validator->getMessageBag()->first()
                             ] , HttpResponse::HTTP_BAD_REQUEST);
                       }
            
            
        
    }


}
