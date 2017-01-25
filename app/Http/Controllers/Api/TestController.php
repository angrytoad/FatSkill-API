<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Test;
use Uuid;

class TestController extends Controller {

    public function test() {
        return response()->json([],200);
    }

    public function listTests()
    {
        $tests = Auth::user()->tests()->get();
        return response()->json($tests,200);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'public' => 'required',
        ]);

        $test = new Test();
        $test->id = Uuid::generate();
        $test->name = $request->get('name');
        $test->description = $request->get('description');
        $test->user_id = Auth::user()->id;
        $test->save();
        return response()->json(200);
    }

}