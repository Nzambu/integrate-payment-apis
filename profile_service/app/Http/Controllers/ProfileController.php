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
 * @copyright  Copyright (c) 2021 Patrick Nzambu (linkedin.com/in/nzambu)
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

use App\Http\Traits\CountRecordsTrait;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\Profile\ProfileResource;
use App\Models\User;

/**
 * @group ProfileMicroservice
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
    use CountRecordsTrait;

    /**
     * Profile - List
     * 
     * Make a get request using the endpoint to obtain a list of all available records. The endpoint has no route parameters as seen on the
     * given example request. The desired response will be similar to the example response shown.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request) 
    {     
        // Step 1: Select all users
        $data = User::all();
        
        // Step 2: Process top level message
        $message = $this->count_records($data);

        return (ProfileResource::collection($data))->additional(["message" => $message]);
    }
    
    /**
     * Profile - Create
     * 
     * Make a post request to create a new record. Provided form data should be in json format and supplied according to the given example request. 
     * The expected response should be similar to example response shown.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProfileRequest $request, User $user)
    {
        // Step 1: Request only fillable fields
        $data = $request->only($user->getFillable());
        
        // Step 2: Populate the fields and save data
        $create = $user->fill($data)->save();

        // Step 4: Process top level message
        $user['message'] = $this->create_record($create);
    
        // Step 5: Return new record
        return new ProfileResource($user);
    }

    /**
     * Profile - Show
     * 
     * Make a get request to select a particular record. Provide the id of the record at the end of the route as shown on the given example request.
     * The expected response should be similar to example response shown.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, User $profile)
    {
        // Step 1: Process top level message
        $profile['message'] = $this->select_record($profile);

        // Step 2: Return selected record
        return new ProfileResource($profile);
    }

    /**
     * Profile - Update
     * 
     * Make a put or patch request to update the record. Provide the id of the record at the end of the route as shown on the given example request.
     * The form data should be in json format and provided according to the example request. The expected response should be similar to example 
     * response shown.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProfileRequest $request, User $profile)
    {
        // Step 1: Request only fillable fields
        $data = $request->only($profile->getFillable());

        // Step 2: Populate the fields and update record
        $update = $profile->fill($data)->update();

        // Step 4: Process top level message
        $profile['message'] = $this->update_record($update);

        // Step 5: Return updated record
        return new ProfileResource($profile);
    }

    /**
     * Profile - Delete
     * 
     * Make a delete request to remove the record. Provide the id of the record at the end of the route as shown on the given example request.
     * The expected response should be similar to example response shown.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, User $profile)
    {
        // Step 1: Delete the record
        $delete = $profile->delete();

        // Step 2: Process top level message
        $profile['message'] = $this->delete_record($delete);

        // Step 3: Return deleted record
        return new ProfileResource($profile);
    }
}
