<?php

namespace App\Http\Controllers\api\cleanup;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResourse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LocationRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserLocationController extends Controller
{
    use ApiTraits;

    public function Userlocation(LocationRequest $request){
        $token = $request->header("Authorization") ;
        $authuser = Auth::guard('sanctum')->user();

        $user= User::find($authuser->id) ;
        $Location = User::where('id' , $user->id)->update(
            [
                'lat' => $request->lat ,
                'long' =>$request->long ,
            ]);
            
            $user= User::find($authuser->id) ;

        return $this->data(compact('user')) ;
    }

    
       
     

    
}
