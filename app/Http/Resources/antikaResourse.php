<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class antikaResourse extends JsonResource
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
            "Desc"=> $this->remember_token,
            "category_name"=>$this->category->name,
            "status"=>$this->category->status,
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,

    ];
    }
}
