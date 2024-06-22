<?php

namespace App\Http\Controllers\api\cleanup;

use App\Models\Companies;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\getallcompanyresource;

class companyController extends Controller
{
    use ApiTraits;
    public function createcompany(CompanyRequest $request) {

        $company = Companies::create([
            'name'=>$request->name,
            'image'=>$request->image,
            'description'=>$request->description,
            'price'=>$request->price,
            'lat'=>$request->lat,
            'long'=>$request->long
        ]);

        return $this->data(compact('company'));
    
    }

    public function getcompany(){
        $compaines = Companies::all();
        $totalCompanies = Companies::count('id');
        return ['totalCompanies'=>$totalCompanies , 'data' => getallcompanyresource::collection($compaines)];

        return getallcompanyresource::collection($compaines);

    }
    public function getcompanylocation($id){
        $company = Companies::find($id);
        
        return $this->data(compact('company'));

    }
    
    public function store_company(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable',
            'description' => 'required|string|max:255',
            'lat' => 'nullable',
            'long' => 'nullable',
            
        ]);
        
        if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            
            $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
            
            Companies::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imageName,
                'description' => $request->description ,
                'lat' => $request->lat,
                'long' => $request->long ,
              
            ]);
            if($request->has('image')){

            Storage::disk('public')->put($imageName , file_get_contents($request->image));
            }
            return response()->json(['message' => 'New Antika Inserted successfully'], 201);
        }
        public function edit_company($id){
           $Company = Companies::find($id);
           return  $this->data(compact('Company'), 'done') ;
        
        }
        public function update_company($id ,request $request)  {
    
    
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'image' => 'nullable',
                'description' => 'required|string|max:255',
                'lat' => 'nullable',
                'long' => 'nullable',
    
                
            ]);
    
          
            
            if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
    
    
            $antika= Companies::find($id);
            if($antika){
                $data = $request->except('image');
                    
                    if($request->has('image')){
                        $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
    
                        Storage::disk('public')->put($imageName , file_get_contents($request->image));
                        
                        $data['image']= $imageName;
                    }
                    Companies::where('id' , $id)->update($data);
                    return  $this->MessageSuccess("success" );
    
                    }
                    
            
    
            else{
                return  $this->MessageSuccess("not found " );
    
            }
    
            
            
            
            
            
        }
        public function delete_company($id)  {
        
            $product = Companies::find($id);
            if($product){
                $deleted = Companies::where('id', $id)->delete();
                if($deleted){
                    return $this->MessageSuccess("deleted");
                }
            }else{
           
    
                return $this->MessageError(["id is invalid"]);
    
            }
    
    
        }


}
