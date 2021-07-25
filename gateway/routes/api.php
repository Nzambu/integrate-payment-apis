<?php

use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\Home\VerifyTokenSignatureController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['middleware' => 'api'], function(){

    /*
    |-----------------------------------------------------------------------------------------------------------------------------
    | Authentication Routes - login, forgot password && change password
    |-----------------------------------------------------------------------------------------------------------------------------
    | The routes address login, forgot and change password
    |
    */
    Route::post('login', [AuthController::class, 'login']); 
    Route::post('register', [AuthController::class,'register']);    
    
// });

Route::group(['middleware' => 'auth:api'], function ()
{ 

    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('verify_token_certificate' , [VerifyTokenSignatureController::class, 'home']);

    /*
    |-----------------------------------------------------------------------------------------------------------------------------
    | Profile - CRUD
    |-----------------------------------------------------------------------------------------------------------------------------
    | The routes controll profile records
    |
    */

    Route::apiResource('/profile', ProfileController::class);

    /*
    |-----------------------------------------------------------------------------------------------------------------------------
    | Payment - create and show
    |-----------------------------------------------------------------------------------------------------------------------------
    | The routes controll making and searching payments
    |
    */

    Route::apiResource('/pay', PayController::class);
});
