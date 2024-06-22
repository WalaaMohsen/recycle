<?php

namespace App\Http\Controllers\api\recycle;

use App\Http\traits\ApiTraits;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SendRequest;
use App\Http\Controllers\Controller;
use App\Models\RecycQuantity;
use Illuminate\Support\Facades\Auth;

class sendRequestController extends Controller
{
    use ApiTraits ;
    public function sendrequest(SendRequest $request)  {
        $token = $request->header("Authorization") ;

        $authuser = Auth::guard('sanctum')->user();

        $user = User::where('id' , $authuser->id )->first(); 


        if($request->weightofblastic ==0 && $request->weightofiron ==0 && $request->weightofglass ==0 ){
            
            return $this->MessageError(['error'=>'There is no data to send '] , 'Choose one of them');

        }
        if(!$request->weightofblastic ==0 ){
            $weightofblastic = RecycQuantity::create([
                'user_id' => $user->id ,
                'recycle_id' => 1 ,
                'weight' => $request->weightofblastic ,
                'points'  => $request->weightofblastic * 10 
            ]);
        }
        if(!$request->weightofiron ==0 ){
            $weightofiron = RecycQuantity::create([
                'user_id' => $user->id ,
                'recycle_id' => 2 ,
                'weight' => $request->weightofiron ,
                'points'  => $request->weightofiron * 100 

            ]);
        }
        if(!$request->weightofglass ==0 ){
            $weightofglass = RecycQuantity::create([
                'user_id' => $user->id ,
                'recycle_id' => 3 ,
                'weight' => $request->weightofglass ,
                'points'  => $request->weightofglass * 5 

            ]); 
        }

        return $this->MessageSuccess('done request'); 
        
    }
}
