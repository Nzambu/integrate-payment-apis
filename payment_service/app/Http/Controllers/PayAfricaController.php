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

use App\Http\Requests\PayAfricaRequest;
use App\Http\Resources\Profile\PayAfricaResource;
use App\Http\Services\PayService;
use Illuminate\Http\Request;

/**
 * @group PaymentMicroservice
 *
 * Only authenticated users can make the get and post requests using the endpoints provided in this section. 
 * Integration into different languages is shown using relevant example requests. Follow the examples as a guide showing how to
 * provide the parameters in the right place.
 *  
 * @authenticated
 * 
 * @package Controllers
 */
class PayAfricaController extends Controller
{
    /**
     * Service to consume ipay service
     * 
     * @var $payService 
     */
    protected $payService;

    /**
     * Class constructor
     */
    public function __construct(PayService $payService)
    {
        $this->payService = $payService;
    }
    
    /**
     * Payment - Create
     * 
     * Make a post request to create a new payment record. Provided form data should be in json format and supplied according to the given example request. 
     * The expected response should be similar to example response shown.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PayAfricaRequest $request)
    {
        // Secret key
        $secret_key = "demo";

        // Data string
        $data_string = "amount=".$request->amount."phone=".$request->phone."vid=".$request->vid;

        // Hash form data
        $hash = hash_hmac("sha256", $data_string, $secret_key);

        // Format form data
        $form_data = [
            "amount" => $request->amount,
            "hash" => $hash,
            "phone" => $request->phone,
            "reference" => "",
            "vid" => $request->vid
        ];

        // Create transaction and return response
        return response(new PayAfricaResource($this->payService->transact($form_data)))->withHeaders(['Content-Type', 'application/json']);
    }

    /**
     * Payment - Show
     * 
     * Make a get request to search a particular record. Provide the id of the record at the end of the route as shown on the given example request.
     * The expected response should be similar to example response shown.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($request)
    {
        // The param to search transaction
        $search = $request;

        // Search transaction and return response
        return response(new PayAfricaResource($this->payService->search($search)))->withHeaders(['Content-Type', 'application/json']);
    }
}
