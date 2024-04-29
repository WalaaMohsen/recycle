<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function create(){
        return view('user.create');
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'email_verified_at' => 'nullable|date',
            'phone' => 'required|numeric|min:11',
            'password' => 'required|min:8' ,
        ]);

        User::create([
            'name' => $request ->name,
            'email' => $request ->email,
            'email_verified_at' => $request ->verfied_at,
            'phone' => $request ->phone,
            'password' => Hash::make($request ->password),
        ]);

        return redirect('getlogin')->with('success' , 'Registered Successfully.');

    }
}
