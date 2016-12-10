<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiAuthController extends Controller {

    use AuthenticatesUsers;

    public function login(Request $request){
        if($this->attemptLogin($request)){
            $user = Auth::user();
            $user->api_token = str_random(60);
            $user->save();
            return response()->json([
                'api_token' => $user->api_token
            ], 200);
        }
    }

}