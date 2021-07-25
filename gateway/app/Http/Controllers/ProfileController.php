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

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;

/**
 * @group Profile
 *
 * Only authenticated users can make the get, post, put, patch and delete requests using the endpoints provided in this section. 
 * Integration into different languages is shown using relevant example requests. Follow the examples as a guide showing how to
 * provide the parameters in the right place.
 *  
 * @authenticated
 * 
 * @package Controllers
 */
class ProfileController extends Controller
{

    /**
     * The service to consume the profiles micro-service
     * @var profileService
     */
    private $profileService;

    /**
     * Class constructor
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Profile - List
     * 
     * Make a get request using the endpoint to obtain a list of all available records. The endpoint has no route parameters as seen on the
     * given example request. The desired response will be similar to the example response shown.
     * 
     * @responseFile 200 responses/profileCollection.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return $this->profileService->index($request);
    }

    /**
     * Profile - Create
     * 
     * Make a post request to create a new record. Provided form data should be in json format and supplied according to the given example request. 
     * The expected response should be similar to example response shown.
     * 
     * @bodyParam name string required The full name of the customer profile
     * @bodyParam email string required The email of the customer
     * 
     * @responseFile 201 responses/profileSingle.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->profileService->store($request);
    }

    /**
     * Profile - Show
     * 
     * Make a get request to select a particular record. Provide the id of the record at the end of the route as shown on the given example request.
     * The expected response should be similar to example response shown.
     * 
     * @responseFile 200 responses/profileSingle.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        return $this->profileService->show($request);
    }

    /**
     * Profile - Update
     * 
     * Make a put or patch request to update the record. Provide the id of the record at the end of the route as shown on the given example request.
     * The form data should be in json format and provided according to the example request. The expected response should be similar to example 
     * response shown.
     * 
     * @bodyParam name string required The full name of the customer profile
     * @bodyParam email string required The email of the customer
     * 
     * @responseFile 200 responses/profileSingle.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        return $this->profileService->update($request);
    }

    /**
     * Profile - Delete
     * 
     * Make a delete request to remove the record. Provide the id of the record at the end of the route as shown on the given example request.
     * The expected response should be similar to example response shown.
     * 
     * @responseFile 200 responses/profileSingle.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        return $this->profileService->destroy($request);
    }
}
