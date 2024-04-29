<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Models\Category as ModelsCategory;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class category extends Controller
{
    public function add_category(Request $request){

        $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();

 
        ModelsCategory::create([

                'name' => $request ->name,
                'image'=>$imageName,
                'status'=>$request ->status,
            ]);
            Storage::disk('public')->put($imageName , file_get_contents($request->image));
            return response()->json([

                'message' =>'Category is successfully added.' , 200
    
            ]);

           }

           public function add_subcategory(Request $request){

            $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
    
     
            Subcategory::create([
    
                    'name' => $request ->name,
                    'image'=>$imageName,
                    'status'=>$request ->status,
                    'subcategory_id'=>$request ->subcategory_id,
                ]);
                Storage::disk('public')->put($imageName , file_get_contents($request->image));
                return response()->json([
    
                    'message' =>'SubCategory is successfully added.' , 200
        
                ]);
    
               }
               public function get_category()  {

                $category = ModelsCategory::get();
        
                return response()->json(['categories'=>$category],200);
                
            }
            public function get_subcategory()  {

                $subcategory = SubCategory::get();
        
                return response()->json(['subcategories'=>$subcategory],200);
                
            }
}
