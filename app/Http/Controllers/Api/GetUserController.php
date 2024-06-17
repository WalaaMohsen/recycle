<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\password_reset_tokens;

use function Laravel\Prompts\password;

class GetUserController extends Controller
{
    public function get_user(Request $request)  {

        $user = User::get();

        return response()->json(['users'=>$user],200);

        

        
    }
}
