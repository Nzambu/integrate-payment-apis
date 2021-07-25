<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TokenVerifySignature
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Extract bearer token from the request
        $token = $request->bearerToken();        
        
        // Get passport public key
        $key = $this->passport_public_key($token);
        
        // Decrypt message to determine the signature is authorized and authentic
        try {
            // Decode the token - payload
            JWT::decode($token, $key, array_keys(JWT::$supported_algs));

            // Process the request
            return $next($request);

        } catch (\Throwable $th) {

            // Return the exception
            return $th;
        }
        
    }

    public function passport_public_key($token)
    {
        // Prepare headers
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        // Make request and get the feedback
        $response = Http::withToken($token)->withHeaders($headers)->get('http://localhost/microservice/gateway/public/api/verify_token_certificate');

        // Return body from response
        return $response->body();
    }
}
