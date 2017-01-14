<?php

namespace App\Http\Controllers\Api;

use App\Candidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Job;
use Uuid;

class FulfillmentController extends Controller {

    /**
     * Get all non-expired jobs that the user currently has
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest() {
        $jobs = Auth::user()->jobs()->where('expiry', '>', Carbon::now())->orderBy('position','ASC')->get();
        return response()->json($jobs,200);
    }

    /**
     * Get the 10 most recently added jobs by a user
     *
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Create a new position
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Get information about a position
     *
     * @param $job_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getJob($job_id) {
        $job = Job::find($job_id);
        if($job->user->first()->id === Auth::user()->id){
            $job_candidates = $job->candidates()->orderBy('email','ASC')->get();

            $overall_score = 0;

            $completion_count = 0;
            $candidates = [];
            foreach($job_candidates as $key => $candidate){
                $candidates[] = [
                    "email" => $candidate->email,
                    "name" => 'Thomas Freeborough',
                    "added" => Carbon::parse($candidate->pivot->created_at),
                    "completed" => true,
                    "score" => 87-$key
                ];
                if(true){
                    $completion_count++;
                }
                /*
                if($candidate->results->completed){
                    $completion_count++;
                }
                */
            };

            return response()->json([
                "id" => $job->id,
                "position" => $job->position,
                "sector" => $job->sector,
                "company" => $job->company,
                "location" => $job->location,
                "expiry" => $job->expiry,
                "candidate_count" => count($candidates),
                "candidates_completed" => $completion_count,
                "overall_score" => $overall_score,
                "candidates" => $candidates
            ],200);
        }
        return response()->json('Unauthenticated',403);
    }


    /**
     * Link a candidate to the position
     *
     * @param Request $request
     * @param $job_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCandidate(Request $request, $job_id) {
        $job = Job::find($job_id);
        if($job->user->first()->id === Auth::user()->id){
            $candidate = Candidate::find($request->get('candidate_id'));
            if(!is_null($candidate)){
                if(!$candidate->ownedBy(Auth::user()->id)){
                    $candidate->jobs->attach($job_id);
                }
                return response()->json('This candidate is already part of this position',422);
            }
        }
        return response()->json('Unauthenticated',403);
    }

    /**
     * Create a new candidate and then link them to the position given
     *
     * @param Request $request
     * @param $job_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function createAndAddCandidate(Request $request, $job_id){
        $job = Job::find($job_id);
        if($job->user->first()->id === Auth::user()->id){
            $this->validate($request, [
                'candidate_email' => 'required|email|max:255',
            ]);
            if(!Auth::user()->hasCandidate($request->get('candidate_email'))){
                $candidate = new Candidate();
                $candidate->id = Uuid::generate();
                $candidate->email = $request->get('candidate_email');
                $candidate->user_id = Auth::user()->id;
                $candidate->save();

                $candidate->jobs()->attach($job_id);
                return response()->json([],200);
            }else{
                $candidate = Auth::user()->candidates()->where('email',$request->get('candidate_email'));
                if(!$candidate->ownedBy(Auth::user()->id)){
                    $candidate->jobs()->attach($job_id);
                    return response()->json([],200);
                }
                return response()->json('This candidate is already part of this position',422);
            }
        }
        return response()->json('Unauthenticated',403);
    }

}