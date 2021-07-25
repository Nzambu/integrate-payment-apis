<?php

namespace App\Services;

class PayService extends Service
{   
    /**
     * Make new payment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($request) 
    {
        // Extract record id
        $data = $request->all();

        // Make request and return response
        return $this->make_http_request('POST', 'payment_service/public/api/service/ipay', $data);

    }

    /**
     * Search payment
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($request) 
    {
        // Extract record id
        $id = $request->route('pay');

        // Make request and return response
        return $this->make_http_request('SHOW', "payment_service/public/api/service/ipay/{$id}");

    }

}