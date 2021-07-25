<?php
/**
 * Patrick Nzambu
 *
 * LICENCE: MIT
 *
 * @category   PN
 * 
 * @package    microservice_example_api
 * 
 * @copyright  Copyright (c) 2021 Patrick Nzambu Nzioki (linkedin.com/in/nzambu)
 * 
 * @license    MIT
 * 
 * @version    1.0
 * 
 * @since      1.0
 * 
 * @author  Patrick Nzambu <patricknzambu@gmail.com>
 * 
 */

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\LoginRequest;
use App\Http\Requests\Authentication\RegisterRequest;
use App\Http\Resources\Errors\ErrorResource;
use App\Http\Resources\Profiles\ProfileResource;
use App\Models\Profiles\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * @group Authentication
 *
 * Only authenticated users can make the get, post, put, patch and delete requests using the endpoints provided in this section. 
 * Integration into different languages is shown using relevant example requests. Follow the examples as a guide showing how to
 * provide the parameters in the right place.
 * 
 * @package Controllers
 */
class AuthController extends Controller
{
    /**
     * Authentication - Register
     * 
     * @return object The newly registered user data
     */
    public function register(RegisterRequest $request, User $user) 
    {
        // Step 1: Hash the password
        $request['password'] = Hash::make($request->password);

        // Step 2: Get the fillable attributes/fields
        $data = $request->only($user->getFillable());

        // Step 3: Save the user data
        $create = $user->fill($data)->save();
        
        // Step 4: If created, save primary email, else return error
        if($create) {

            $user->createToken('Laravel Password Grant Client')->accessToken;

            // Step 5: Extract id of the new user
            $request->usr_id = $user->usr_id;

            // Step 6: Call method for saving primary email and check if true
            if ($this->primary_email($request)) {

                // Step 7: Return the success response
                return "User created successfully";

            } else {

                // Step 8: Return the error
                return "Failed to add email";

            }
        } else {

            // Step 9: Return failed to create user error
            return "Failed to create user";
        }
    }

    /**
     * Create primary email
     * 
     * @return bool State of creating primary email
     */
    public function primary_email($request)
    {
        // Step 1: Create record and return the response(bool)
        return Email::create([
            "email" => $request->email,
            "user_id" => $request->usr_id,
            "primary" => true
        ]);
    }

    /**
     * Authentication - Login
     * 
     * Users sign up or log in by making a post request with user email and password. The endpoint is open to the public to aid users gain access to their accounts.
     * The login credentials are explained in the body section below. Integration in sample languages is shown with example requests. The desired response is as
     * shown in example response 200.
     * 
     * @responseFile 200 responses/profile.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        // Step 1: Extract user credentials
        $email =  $request->email;
        $password = $request->password;

        // Step 2: Select user with given primary email
        $user = User::whereHas('emails', function($query) use($email) {
            $query->where([
                ['email', $email],
                ['primary', true]
            ]);
        })->first();

        // Step 3: If record found, login the user, else return error
        if($user) {

            // Step 4: If user password match, grant access token, else return wrong password error
            if(Hash::check($password, $user->password)) {

                // Step 5: Create user token
                $token = $user->createToken('Laravel Login User')->accessToken;
                $user['token'] = $token;

                // Step 6: Return success response
                return new ProfileResource($user);

            } else {

                // Step 7: Format wrong password error                
                $request["status"] = 403;
                $request["title"] = "Password";
                $request["message"] = "Incorrect password, check your password";

                // Step 8: Return error
                return (new ErrorResource($request))->response()->setStatusCode(403);
            }
        } else {

            // Step 9: Format user not found
            $request["status"] = 403;
            $request["title"] = "Password";
            $request["message"] = "Login with the primary email";

            // Step 10: Return error
            return (new ErrorResource($request))->response()->setStatusCode(403);
        }
    }

    /**
     * Authentication - Logout
     * 
     * 
     * @responseFile 200 responses/logout.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
