<?php

namespace App\Traits;

trait FormatApiResponseTrait
{
    
    /**
     * Format the response from the apis
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function json_response($response) : object
    {
        // Chain status code and headers to the response
        return response($response->getBody())
                    ->setStatusCode($response->status())
                    ->withHeaders(['Content-Type' => 'application/json']);
    }

}