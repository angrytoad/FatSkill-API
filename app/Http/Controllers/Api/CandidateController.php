<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Candidate;
use Uuid;

class CandidateController extends Controller {

    public function basicCandidateList() {
        $candidates = Auth::user()->candidates()->get();
        return response()->json($candidates,200);
    }


}