<?php

namespace App\Http\Resources\Profiles;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            "type" => "profile",
            "id" => (string) $this->usr_id,
            "token" => [
                "token" => $this->token,
                "type" => "Bearer Token"
            ],
            "attributes" => [
                "first_name" => $this->first_name,
                "middle_name" => $this->middle_name,
                "last_name" => $this->last_name
            ],
            "relationships" => [
                "email" => [
                    EmailResource::collection($this->emails)
                ]
            ],
            "links" => [
                "self" => url("api/profile/{$this->usr_id}")
            ]
        ];
    }
}
