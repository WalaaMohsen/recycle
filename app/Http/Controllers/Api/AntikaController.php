<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Antikae;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class AntikaController extends Controller

{


    public function show_vaza(Request $request){
        $vaza = Subcategory::where('subcategory_id' , 4)->get();
        return response()->json(['vaza'=>$vaza],200);
    
         
}
   public function show_camera(Request $request){
      $camera = Subcategory::where('subcategory_id' , 1)->get();
      return response()->json(['camera'=>$camera],200);  
   }
   public function show_coin(Request $request){
    $coin = Subcategory::where('subcategory_id' , 2)->get();
    return response()->json(['coin'=>$coin],200);  
 }
 public function show_jewelry(Request $request){
    $jewelry = Subcategory::where('subcategory_id' , 3)->get();
    return response()->json(['jewelry'=>$jewelry],200);  
 }
 public function show_typewriter(Request $request){
    $typewriter = Subcategory::where('subcategory_id' , 5)->get();
    return response()->json(['typewriter'=>$typewriter],200);  
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

