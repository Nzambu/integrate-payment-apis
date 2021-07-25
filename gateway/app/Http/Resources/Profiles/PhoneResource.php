<?php

namespace App\Http\Resources\Profiles;

use Illuminate\Http\Resources\Json\JsonResource;

class PhoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => "phone",
            "id" => (string)$this->phn_id,
            "attributes" => [
                "phone" => $this->phone,
                "primary" => $this->primary,
            ],
            "links" => [
                "self" => url("api/user/{$request->user_id}/phone/{$this->phn_id}")
            ]
        ];
    }
}
