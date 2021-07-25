<?php

namespace App\Services;

class ProfileService extends Service
{   

    /**
     * Read all records
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($request) 
    {
        // Extract optional id
        // $id = $request->route('profile') ?? null;
        // return $this->make_http_request('GET', "profile_service/public/api/service/profile/{$id}");

        // Make request and return response
        return $this->make_http_request('GET', "profile_service/public/api/service/profile");
        
    }

    /**
     * Create new record
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($request) 
    {
        // Extract record id
        $data = $request->all();

        // Make request and return response
        return $this->make_http_request('POST', 'profile_service/public/api/service/profile', $data);

    }

    /**
     * Select particular record
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($request) 
    {
        // Extract record id
        $id = $request->route('profile');

        // Make request and return response
        return $this->make_http_request('SHOW', "profile_service/public/api/service/profile/{$id}");

    }

    /**
     * Update particular record
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($request) 
    {
        // Extract record id
        $id = $request->route('profile');

        // Extract all form data
        $data = $request->all();

        // Set method based on request method
        $method = ($request->isMethod('patch')) ? "PATCH" : "PUT";

        // Make request and return response
        return $this->make_http_request($method, "profile_service/public/api/service/profile/{$id}", $data);

    }

    /**
     * Delete particular record
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($request) 
    {
        // Extract record id
        $id = $request->route('profile');

        // Make request and return response
        return $this->make_http_request('DELETE', "profile_service/public/api/service/profile/{$id}");

    }
}