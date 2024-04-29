<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;


class GetUserController extends Controller
{
    public function get_user()  {

        $user = User::get();

        return response()->json(['users'=>$user],200);
        
    }
}
