<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class showuserResultResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            "weight" => $this->weight,
            "points"=> $this->points,
            "user_id"=> $this->user->id,
            "user_name"=> $this->user->name,
            "user_email"=> $this->user->email,
            "user_phone"=> $this->user->phone,
            "recycle_id"=> $this->recycle->id,
            "recycle_type"=> $this->recycle->type,
            'remember_token'=> $this->remember_token,
            "created_at"=> $this->created_at,


        ];
    }
}
