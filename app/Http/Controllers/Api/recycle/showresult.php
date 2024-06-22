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

        $points = RecycQuantity::where('user_id' , $user->id)->where('remember_token' , '1')->sum('points');
        $pointsofblastic = RecycQuantity::where('user_id' , $user->id)->where('recycle_id' , 1)->where('remember_token' , '1')->sum('points');
        $pointsofiron = RecycQuantity::where('user_id' , $user->id)->where('recycle_id' , 2)->where('remember_token' , '1')->sum('points');
        $pointsofglasses = RecycQuantity::where('user_id' , $user->id)->where('recycle_id' , 3)->where('remember_token' , '1')->sum('points');
     

        

        return $this->data(compact('points' , 'pointsofblastic' , 'pointsofiron' , 'pointsofglasses')) ;
        
    }

    public function showresultforuser(Request $request) {
        $token = $request->header("Authorization") ;

        $authuser = Auth::guard('sanctum')->user();

        $user = User::where('id' , $authuser->id )->first(); 
    

        $showreuslt = RecycQuantity::where('user_id' , $user->id)->where('remember_token' , '1')->get();
        // dd($showreuslt->user->name); 
        if($showreuslt->isEmpty()){
                return $this->MessageSuccess('not operation yet'); 
            }
            return showuserResultResourse::collection($showreuslt) ;
    }

    public function showallopeartion(){
        $show_all_opeartions = RecycQuantity::get();
        $totalopeartion = RecycQuantity::count('id');
        return ['totalopeartion'=>$totalopeartion , 'data' => showuserResultResourse::collection($show_all_opeartions)] ;
    }
    public function Confirm_the_operation($id){
        $Confirm_the_operation = RecycQuantity::where('id' , $id)->update([
            'remember_token' => '1' 
        ]);

        return $this->MessageSuccess('operation success'); 


    

}
}
