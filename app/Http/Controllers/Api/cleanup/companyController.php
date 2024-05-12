<?php

namespace App\Http\Controllers\api\cleanup;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\traits\ApiTraits;
use App\Models\Companies;
use Illuminate\Http\Request;

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
        return $this->data(compact('compaines'));

    }
    public function getcompanylocation($id){
        $company = Companies::find($id);
        
        return $this->data(compact('company'));

    }


}
