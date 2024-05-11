<?php 

namespace  App\Http\traits;

trait ApiTraits{
    public function MessageSuccess(string $message='' , int $code =200)  {
        return response()->json(
            [
            'message' => $message ,
            'errors'  => (object)[] ,
            'deta'  =>  (object)[] ,
        ]
        , $code
     );
    }
    public function MessageError(array $errors,string $message='' , int $code =422)  {
        return response()->json(
            [
            'message' => $message ,
            'errors'  => $errors ,
            'deta'  =>  (object)[] ,
        ]
        , $code
     );
    }
    public function data(array $data,string $message='' , int $code =200)  {
        return response()->json(
            [
            'message' => $message ,
            'errors'  => [] ,
            'deta'  =>   $data ,
        ]
        , $code
     );
    }
}
