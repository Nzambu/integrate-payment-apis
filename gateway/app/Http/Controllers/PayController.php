<?php

namespace App\Http\Controllers;

use App\Services\PayService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * @group Payment
 *
 * Only authenticated users can make the get and post requests using the endpoints provided in this section. 
 * Integration into different languages is shown using relevant example requests. Follow the examples as a guide showing how to
 * provide the parameters in the right place.
 *  
 * @authenticated
 * 
 * @package Controllers
 */
class PayController extends Controller
{
    /**
     * The service to consume the payment micro-service
     * @var payService
     */
    private $payService;

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
     * @bodyParam phone string required The phone number of the recipient
     * @bodyParam amount integer required The amount to sent
     * 
     * @responseFile 200 responses/paymentSingle.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return $this->payService->store($request);
    }

    /**
     * Payment - Show
     * 
     * Make a get request to search a particular record. Provide the id of the record at the end of the route as shown on the given example request.
     * The expected response should be similar to example response shown.
     * 
     * @urlParam pay string required The reference id of the transaction
     * 
     * @responseFile 200 responses/paymentSingle.json
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request)
    {
        return $this->payService->show($request);
    }
}
