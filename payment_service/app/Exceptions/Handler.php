<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Response;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Meta data to be rendered in each exception
     * 
     * @var array
     */
    protected $metadata = [
        "copyright" => "Copyright 2021 PN",
        "authors" => [
            "name" => "Patrick Nzambu",
            "email" => "patricknzambu@gmail.com"
        ]
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
            //
        // });

        $this->renderable(function (MethodNotAllowedHttpException $exception){

            $request["type"] = "Method";
            $request["code"] = "MNA001";
            $reuest["title"] = "Method Not Allowed";
            $request["status"] =  502;            
            $request["detail"] = $exception->getMessage();
            $request["meta"] = $this->metadata;
            return Response::json($this->wrap($request))->setStatusCode($exception->getStatusCode());

        });

        $this->renderable(function (BadMethodCallException $exception){

            $request["type"] = "Method";
            $request["code"] = "MNA001";
            $reuest["title"] = "Method Not Found";
            $request["status"] =  500;            
            $request["detail"] = $exception->getMessage();
            $request["meta"] = $this->metadata;
            return Response::json($this->wrap($request))->setStatusCode(500);

        });

        $this->renderable(function (ClientException $exception){

            $request["type"] = "Client";
            $request["code"] = "CEX001";
            $reuest["title"] = "Not Allowed";
            $request["status"] = 403;
            $request["detail"] = "Client forbidden, not allowed access";
            $request["meta"] = $this->metadata;
            return Response::json($this->wrap($request))->setStatusCode(403);

        });

        $this->renderable(function (ModelNotFoundException $exception) {

            $request['type'] = 'Database';
            $request['code'] = 'MNF001';
            $request['title'] = 'Route Not Found';
            $request['status'] = 404;
            $request['message'] = 'Route not found';
            $request['detail'] = $exception->getMessage();
            $request['meta'] = $this->metadata;
            return Response::json($this->wrap($request))->setStatusCode(404);

        });

        $this->renderable(function (NotFoundHttpException $exception) {

            $request['type'] = 'Record';
            $request['code'] = 'NFH002';
            $request['title'] = 'Record Not Found';
            $request['status'] = $exception->getStatusCode();            
            $request['message'] = 'Record Not found';
            $request['detail'] = $exception->getMessage();
            $request['meta'] = $this->metadata;
            return Response::json($this->wrap($request))->setStatusCode($exception->getStatusCode());

        });        

        $this->renderable(function (BindingResolutionException $exception) {

            $request['type'] = 'Class';
            $request['code'] = 'BRE001';
            $request['title'] = 'Class Not Found';
            $request['status'] = 500;            
            $request['message'] = 'Class Not found';
            $request['detail'] = $exception->getMessage();
            $request['meta'] = $this->metadata;
            return Response::json($this->wrap($request))->setStatusCode(500);

        });

    }

    public function wrap($data) {
        return ["error" => $data];
    }
}
