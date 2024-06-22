<?php

namespace App\Http\Controllers\Api;

use App\Http\traits\ApiTraits;
use App\Models\Antikae;
use App\Models\Category;
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
use ApiTraits ;

    public function show_all_products(Request $request){
        $show_all_products = Subcategory::get();
        $totalproduct = Subcategory::count('id');
        return ['totalproduct'=>$totalproduct , 'data' => antikaResourse::collection($show_all_products)] ;
    
         
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

public function create_antika(Request $request){
   $Categories = Category::select('id' , 'name')->get();
   return  $this->data(compact('Categories'), 'done') ;

}

public function store_antika(Request $request)
{
   
   $validator = Validator::make($request->all(), [
       'name' => 'required|string|max:255',
       'subcategory_id' => 'required|exists:categories,id',
       'image' => 'required',
       'description' => 'required|string|max:100',
       
   ]);
   
   if ($validator->fails()) {
           return response()->json($validator->errors(), 400);
       }
       
       $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
       
       Subcategory::create([
           'name' => $request->name,
           'subcategory_id' => $request->subcategory_id,
           'image' => $imageName,
           'remember_token' => $request->description ,
         
       ]);
       
       Storage::disk('public')->put($imageName , file_get_contents($request->image));
       
       return response()->json(['message' => 'New Antika Inserted successfully'], 201);
   }
   public function edit_antika($id){
      $antika = Subcategory::find($id);
      $Categories = Category::select('id' , 'name')->get();
      return  $this->data([new antikaResourse($antika) , compact('Categories')], 'done') ;
   
   }
   public function update_antika($id ,request $request)  {


       $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'subcategory_id' => 'required|exists:categories,id',
           'image' => 'nullable',
           'remember_token' => 'required|string|max:100',

           
       ]);

     
       
       if ($validator->fails()) {
               return response()->json($validator->errors(), 400);
           }


       $antika= Subcategory::find($id);
       if($antika){
           $data = $request->except('_token','_method' ,'page' , 'image');
               
               if($request->has('image')){
                   $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();

                   Storage::disk('public')->put($imageName , file_get_contents($request->image));
                   
                   $data['image']= $imageName;
               }
               Subcategory::where('id' , $id)->update($data);
               return  $this->MessageSuccess("success" );

               }
               
       

       else{
           return  $this->MessageSuccess("not found " );

       }
        
        
        
        
        
    }
    public function delete_antika($id)  {
    
        $product = Subcategory::find($id);
        if($product){
            $deleted = Subcategory::where('id', $id)->delete();
            if($deleted){
                return $this->MessageSuccess("deleted");
            }
        }else{
       

            return $this->MessageError(["id is invalid"]);

        }


    }


}

