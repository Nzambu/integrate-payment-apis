<?php

namespace App\Http\Resources\Errors;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public static $wrap = "error";
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => "error",
            "status" => $this->status,
            "title" => $this->title,
            "message" => $this->message,
            "metadata" => [                
                "authors" => [
                    "name" => "Patrick Nzambu",
                    "email" => "patricknzambu@gmail.com"
                ],
                "copyright" => "Copyright 2021 Patrick Nzambu",
            ]
        ];
    }
}
