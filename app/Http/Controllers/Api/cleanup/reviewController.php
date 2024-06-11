<?php

namespace App\Http\Controllers\api\cleanup;

use App\Models\User;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Models\CompanyReview;
use App\Http\traits\ApiTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\showusereveiwResourse;

class reviewController extends Controller
{
    use ApiTraits ;

    public function sendReview($id , ReviewRequest $request ) {
        $token = $request->header("Authorization") ;
        $authuser = Auth::guard('sanctum')->user();

        $user= User::find($authuser->id) ;
        $company= Companies::find($id) ;

        $company_review = CompanyReview::create(
            [
                'value' => $request->value ,
                'comment' =>$request->comment ,
                'user_id'=> $user->id ,
                'company_id' => $company->id 
            ]

        );

        return $this->MessageSuccess('review is successful');


        
    }

    public function showreview($id , Request $request){
        $token = $request->header("Authorization") ;
        $authuser = Auth::guard('sanctum')->user();

        $user= User::find($authuser->id) ;
        $company= Companies::find($id) ;


        $company_showReviews = CompanyReview::where('company_id' , $company->id)->get();

        return showusereveiwResourse::collection($company_showReviews) ;


    }
}
