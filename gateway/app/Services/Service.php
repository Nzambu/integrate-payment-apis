<?php

namespace App\Services;

use App\Traits\FormatApiResponseTrait;
use App\Traits\GuzzleTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Service {

    // Use trait to format api response
    use FormatApiResponseTrait;

    protected $http_request;
    protected $service_endpoint;
    protected $form_data;
    protected $base_uri;

    public function __construct(Request $request) 
    {
        // Pick application uri from .env file
        $this->base_uri = env('APP_URL');

        // Set the headers
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
        
        // Add token and headers to the http client - prepare to make request
        $this->http_request = Http::withToken($request->bearerToken())->withHeaders($headers);

    }

    /**
     * Make the http request
     * 
     * @param $method 
     * 
     * @param $endpoint
     * 
     * @param $form_params
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function make_http_request($method, $endpoint, $form_params = []) {
        
        // Prepare the url to make the request
        $this->service_endpoint = $this->base_uri.$endpoint;
        
        // Optional form params, only used when posting or updating
        if($form_params) {
            $this->form_data = $form_params;
        }
        
        // Switch case based on request method
        switch ($method) {

            // Get method
            case 'GET' :

                // Call method to list all data
                return $this->get_request();

            // Post method
            case 'POST' :

                // Call method to post data
                return $this->post_request();
            
            // Show method
            case 'SHOW' :

                // Call method to select one record
                return $this->show_request();
            
            // Put method
            case 'PUT' :

                // Call method to update a particular record
                return $this->put_request();

            // Patch method
            case 'PATCH' :

                // Call method to update a particular record
                return $this->patch_request();

            // Delete method
            case 'DELETE' :

                // Call method to remove a particular record
                return $this->delete_request();
            
            // Missing method
            default :
                
                // Return missing method error
                return response()->json(['errors' => ["message" => "The http request method is missing"]])->setStatusCode(422);                
        }
    }
    
    /**
     * Get all records
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_request() {

        // Make http get request
        $response = $this->http_request->get($this->service_endpoint);
        
        // Return json response
        return $this->json_response($response);
    }

    /**
     * Create new record
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function post_request() {

        // Make http post request
        $response =  $this->http_request->post($this->service_endpoint, $this->form_data);

        // Return json response
        return $this->json_response($response);
    }

    /**
     * Select one record
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show_request() {

        // Make http show request
        $response = $this->http_request->get($this->service_endpoint);

        // Return json response
        return $this->json_response($response);
    }

    /**
     * Update existing record
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function put_request() {

        // Make http put request
        $response = $this->http_request->put($this->service_endpoint, $this->form_data);

        // Return json response
        return $this->json_response($response);
    }

    /**
     * Update existing record
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function patch_request() {

        // Make http patch request
        $response = $this->http_request->patch($this->service_endpoint, $this->form_data);

        // Return json response
        return $this->json_response($response);
    }

    /**
     * Delete existing record
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete_request() {

        // Make http delete request
        $response = $this->http_request->delete($this->service_endpoint);

        // Return json response
        return $this->json_response($response);
    }
}