<?php

namespace App\Http\Resources\Authentication;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
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
            "type" => "jwt",
            "id" => (string) $this->user_id,
            "token" => [
                "token" => $this->first_name,
                "type" => "Bearer Token"
            ]
        ];
    }
}
