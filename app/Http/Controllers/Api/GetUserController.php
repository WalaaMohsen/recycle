<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\traits\ApiTraits;
use App\Http\Controllers\Controller;

use App\Http\Resources\UserResourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\password_reset_tokens;
use App\Http\Requests\RegisterRequest;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GetUserController extends Controller
{
    use ApiTraits ;
    public function get_user(Request $request)  {

        $user = User::get();

        return response()->json(['users'=>$user],200);

        

        
    }

    public function edit_user_info( Request $request){
        $validator = Validator::make($request->all(), [
            'name' =>['required' , 'max:100'],
            'oldpassword' => ['required' , 'min:8'],
            'password'=> ['required' , 'min:8' , 'confirmed'],
            
        ]);
        
        if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            
            $token = $request->header("Authorization") ;
            $authuser = Auth::guard('sanctum')->user();
    
            $user= User::find($authuser->id) ;

            if(! Hash::check($request->oldpassword, $user->password)){
                return $this->MessageError(['error' => "incorrect password"] , "tryagain" , 401);
            }

            $password = Hash::make($request->password);

                 User::where('id' , $user->id)->update([
                    'name'=> $request->name ,
                    'password' => $password 
                 ]);

                 return  $this->MessageSuccess("updated" );






        


     
     }
    public function edit_user($id){
        $user = User::find($id);
        return  $this->data([new UserResourse($user)], 'done') ;
     
     }
     public function update_user($id ,Request $request)  {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required' , 'max:100'],
            'phone' => ['required' ,  'unique:users,phone,'.$id , 'min:11' , 'max:11'],
            'email' => ['required' , 'email' ,'unique:users,email,'.$id ],
            'password'=> ['required' , 'min:8' , 'confirmed'],
            'image' => ['nullable']
            
        ]);

      
        
        if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
  
         $User= User::find($id);
         if($User){
             $data = $request->except('image' , 'password' , 'password_confirmation');
                 
                 if($request->has('image' )){
                     $imageName = Str::random(32).".".$request->image->getClientOriginalExtension();
                     Storage::disk('public')->put($imageName , file_get_contents($request->image));
                     
                     $data['image']= $imageName;
                 }
                 $data['password'] = Hash::make($request->password);

                 User::where('id' , $id)->update($data);
                 return  $this->MessageSuccess("success" );
  
                 }
                 
         
  
         else{
             return  $this->MessageSuccess("not found " );
  
         }
          
          
          
          
          
      }
      public function delete_user($id)  {
      
          $product = User::find($id);
          if($product){
              $deleted = User::where('id', $id)->delete();
              if($deleted){
                  return $this->MessageSuccess("deleted");
              }
          }else{
         
  
              return $this->MessageError(["id is invalid"]);
  
          }
  
  
      }
  
}
