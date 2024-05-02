<?php 

namespace  App\Http\traits;

trait Media{
    public function uplaodphto($image , $path) {
        $photaname= uniqid() . "." . $image->extension(); 
        
        $image->move(public_path("/dist/img/" . $path) , $photaname);

        return $photaname;
    }
    public function deletephoto($path) {


        if(file_exists($path)){

            unlink($path);
            return true ;
        }
        return false ;
    }
}