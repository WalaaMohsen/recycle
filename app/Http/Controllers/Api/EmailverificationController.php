<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmailverificationController extends Controller
{
   use ApiTraits;

   public function sendcode(Request $request) {
        $token = $request->header("Authorization") ;

        $authuser = Auth::guard('sanctum')->user();

        $user = User::where('id' , $authuser->id )->first();

        $code = rand(10000 , 99999) ;

        $user->code = $code ;
        $user->code_expired_at = date('Y-m-d H:i:s' , strtotime('+2 minutes') ) ;
        $user->save();
        $user->token = $token ;

        //send email

        return $this->data(compact('user') , 'generate code');
   }

   public function checkcode(Request $request) {
        $token = $request->header("Authorization") ;

        $authuser = Auth::guard('sanctum')->user();

        $user = User::where('id' , $authuser->id )->first();

        $validation = [
            'code' => ['required' , 'digits:5' ,'exists:users,code']
         ] ;
   
         $request ->validate($validation);
            // dd(date('Y-m-d H-i-s')) ;
            // dd($user->code_expired_at < date('Y-m-d H-i-s')) ;
         if($request->code == $user->code && $user->code_expired_at > date('Y-m-d H:i:s')){
            $user->status = '1' ;
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
            $user->token = $token ;
            return $this->data(compact('user') , 'success') ;
        }else{
           $user->token = $token ;
  
           return $this->data(compact('user') , "error") ;
  
        }
   }
}
