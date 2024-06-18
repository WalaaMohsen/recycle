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
            "user_id"=> $this->user->name,
            "recycle_type"=> $this->recycle->type,
            "created_at"=> $this->created_at,


        ];
    }
}
