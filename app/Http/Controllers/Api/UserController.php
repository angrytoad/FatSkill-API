<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function me(){
        return response()->json([], 200);
    }

}