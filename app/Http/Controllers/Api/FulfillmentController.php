<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Job;
use Uuid;

class FulfillmentController extends Controller {

    public function latest() {
        $jobs = Auth::user()->jobs()->orderBy('position','ASC')->get();
        return response()->json($jobs,200);
    }

    public function recent() {
        $jobs = Auth::user()->jobs()->orderBy('created_at','DESC')->limit(10)->get();
        $jobs_array = array();
        foreach($jobs as $job){
            $jobs_array[] = [
                'id' => $job->id,
                'position' => $job->position,
                'candidates' => $job->candidates()->count(),
                'expiry' => $job->expiry
            ];
        }

        return response()->json($jobs_array, 200);
    }
    
    public function create(Request $request) {
        $this->validate($request, [
            'position' => 'required|max:255',
            'sector' => 'required|max:255',
            'company' => 'required|max:255',
            'location' => 'required|max:255',
            'expiry' => 'required'
        ]);

        $job = new Job();
        $job->id = Uuid::generate();
        $job->position = $request->get('position');
        $job->sector = $request->get('sector');
        $job->company = $request->get('company');
        $job->location = $request->get('location');
        $job->expiry = Carbon::createFromFormat('d/m/Y', $request->get('expiry'))->toDateTimeString();
        $job->save();
        Auth::user()->jobs()->attach($job->id->string);


        return response()->json([],200);
    }

    public function getJob($job_id) {
        $job = Job::find($job_id);
        if($job->user->first()->id === Auth::user()->id){
            $job_candidates = $job->candidates->all();

            $candidates = [];
            foreach($job_candidates as $candidate){

            };


            return response()->json([
                "id" => $job->id,
                "position" => $job->position,
                "sector" => $job->sector,
                "company" => $job->company,
                "location" => $job->location,
                "expiry" => $job->expiry,
                "candidate_count" => count($candidates),
                "candidates" => $candidates
            ],200);
        }
        return response()->json('Unauthenticated',403);
    }

}