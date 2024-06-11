<?php

namespace App\Http\Controllers\api\cleanup;

use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
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
        return getallcompanyresource::collection($compaines);

    }
    public function getcompanylocation($id){
        $company = Companies::find($id);
        
        return $this->data(compact('company'));

    }


}
