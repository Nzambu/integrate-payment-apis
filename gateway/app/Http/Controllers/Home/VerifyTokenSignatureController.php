<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class VerifyTokenSignatureController extends Controller
{
    /**
     * 
     */
    public function home() {

        $path = storage_path('oauth-public.key');

        $file = File::get($path);

        return $file;
    }
}
