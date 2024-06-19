<?php

namespace App\Http\Controllers\Api;

use App\Models\Antikae;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\antikaResourse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\showuserResultResourse;


class AntikaController extends Controller

{


    public function show_all_products(Request $request){
        $show_all_products = Subcategory::get();
        return antikaResourse::collection($show_all_products) ;
    
         
}
    public function show_vaza(Request $request){
        $vaza = Subcategory::where('subcategory_id' , 4)->get();
        return antikaResourse::collection($vaza) ;
    
         
}
   public function show_camera(Request $request){
      $camera = Subcategory::where('subcategory_id' , 1)->get();
      return antikaResourse::collection($camera) ;
    }
   public function show_coin(Request $request){
    $coin = Subcategory::where('subcategory_id' , 2)->get();
    return antikaResourse::collection($coin) ;
}
 public function show_jewelry(Request $request){
    $jewelry = Subcategory::where('subcategory_id' , 3)->get();
    return antikaResourse::collection($jewelry) ;
}
 public function show_typewriter(Request $request){
    $typewriter = Subcategory::where('subcategory_id' , 5)->get();
    return antikaResourse::collection($typewriter) ;
}
 public function updateDesc($id , Request $request){
    Subcategory::where('id' , $id)->update([
        'remember_token' => $request->remember_token 
    ]);

    $x = Subcategory::where('subcategory_id' , $id)->first();


    return response()->json(compact('x'));

}
    public function new_antika(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required',
            'price' =>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();

         Subcategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
            'price'=> $request->price,
        ]);

        Storage::disk('public')->put($imageName , file_get_contents($request->image));

        return response()->json(['message' => 'New Antika Inserted successfully'], 201);
    }
}

