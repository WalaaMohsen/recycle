<?php

namespace App\Http\Controllers\api\recycle;

use App\Http\traits\ApiTraits;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\showuserResultResourse;
use App\Models\RecycQuantity;
use Illuminate\Support\Facades\Auth;

class showresult extends Controller
{
    use ApiTraits ;
    public function showtotalresult(Request $request) {
        $token = $request->header("Authorization") ;

        $authuser = Auth::guard('sanctum')->user();

        $user = User::where('id' , $authuser->id )->first(); 

        $points = RecycQuantity::where('user_id' , $user->id)->sum('points');
        $pointsofblastic = RecycQuantity::where('user_id' , $user->id)->where('recycle_id' , 1)->sum('points');
        $pointsofiron = RecycQuantity::where('user_id' , $user->id)->where('recycle_id' , 2)->sum('points');
        $pointsofglasses = RecycQuantity::where('user_id' , $user->id)->where('recycle_id' , 3)->sum('points');
     

        

        return $this->data(compact('points' , 'pointsofblastic' , 'pointsofiron' , 'pointsofglasses')) ;
        
    }

    public function showresultforuser(Request $request) {
        $token = $request->header("Authorization") ;

        $authuser = Auth::guard('sanctum')->user();

        $user = User::where('id' , $authuser->id )->first(); 
    

        $showreuslt = RecycQuantity::where('user_id' , $user->id)->get();
        // dd($showreuslt->user->name); 
        if($showreuslt->isEmpty()){
                return $this->MessageSuccess('not operation yet'); 
            }
            return showuserResultResourse::collection($showreuslt) ;
    }

}
