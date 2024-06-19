<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\RecycQuantity;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "image"=> $this->image,
            "email"=> $this->email,
            "phone"=>$this->phone,
            "token"=> $this->token,
            "points"=>RecycQuantity::where('user_id' , $this->id)->sum('points')


    ];
    }
}
