<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\CompanyReview;
use Illuminate\Http\Resources\Json\JsonResource;

class getallcompanyresource extends JsonResource
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
                "description"=>$this->description,
                "price"=> $this->price,
                "lat"=> $this->lat,
                "long"=> $this->long,
                "created_at"=> $this->created_at,
                'rate' => CompanyReview::where('company_id' , $this->id)->avg('value')

        ];
    }
}
