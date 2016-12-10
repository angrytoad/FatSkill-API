<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller {

    public function test() {
        return response()->json(['Code' => 0001, 'Message' => 'This is a response.']);
    }

}