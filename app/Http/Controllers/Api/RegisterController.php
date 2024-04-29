<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class RegisterController extends Controller
{
    public function register(Request $request){
          $validator = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:8' ,
            'phone' => 'required|numeric|min:11',
            'status'=> 'numeric',
            'image'=>'nullable|image|mimes:jpeg,jpg,gif,svg|max:2048',
            'lat'=>'required|numeric',
            'long'=>'required|numeric',
            //'email_verified_at' => 'nullable|date',
        ]);

        $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();

      if($validator){
        User::create([
            'name' => $request ->name,
            'email' => $request ->email,
            'password' => Hash::make($request ->password),
            'phone' => $request ->phone,
            'status'=>$request->status,
            'image'=>$imageName,
            'lat'=>$request->lat,
            'long'=>$request->long,
        ]);

        // save image in storge folder
        Storage::disk('public')->put($imageName , file_get_contents($request->image));

        return response()->json([

            'message' =>'User has been registered' , 200

        ]);
       }

     else{
        
        return response()->json([

            'message' =>' UnRegistered'

        ]);

    }
    }

}
