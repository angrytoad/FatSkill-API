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
        $tests = Auth::user()->tests()->with('revisions')->get();

        return response()->json($tests,200);
    }
    
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'public' => 'required',
        ]);
        $uuid = Uuid::generate();
        $test = new Test();
        $test->id = $uuid;
        $test->name = $request->get('name');
        $test->description = $request->get('description');
        $test->public = $request->get('public');
        $test->user_id = Auth::user()->id;
        $test->save();
        return response()->json([
          "uuid" => $uuid->string
        ],200);
    }

    public function view($uuid)
    {
        $test = Test::find($uuid);
        $revisions = $test->revisions;
        return response()->json([
            "test" => $test,
            "revisions" => $revisions
        ]);
    }

}