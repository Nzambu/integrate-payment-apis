<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class PayAfricaResource extends JsonResource
{
    public static $wrap = "transaction";
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "type" => "payment",
            "id" => (string)$this->id,
            "attributes" => [
                "reference" => $this->reference,
                "phone" => $this->phone,
                "amount" => $this->amount,
                "vendor_id" => $this->vid
            ],
        ];
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request){
        return [
          'message' => $this->message
        ];
    }
}
