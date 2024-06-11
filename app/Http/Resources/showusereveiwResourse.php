<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\CompanyReview;
use Illuminate\Http\Resources\Json\JsonResource;

class showusereveiwResourse extends JsonResource
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
                "value"=>  $this->value,
                "comment"=>  $this->comment,
                "user_name"=>  $this->user->name,
                "company_name"=> $this->company->name,
                "created_at"=>  $this->created_at,
                'rate' =>  CompanyReview::where('company_id' , $this->company->id)->average('value')

        ];
    }
}
