<?php

namespace App\Http\Controllers\Api;

use App\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Revision;
use App\Question_Type;
use Uuid;

class RevisionController extends Controller {

    public function create(Request $request, $test_id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required',
            'questions' => 'required',
        ]);

        $uuid = Uuid::generate();
        $revision = new Revision();
        $revision->id = $uuid;
        $revision->title = $request->get('name');
        $revision->description = $request->get('description');
        $revision->test_id = $test_id;
        $revision->save();

        $types = Question_Type::all();
        $questions = $request->get('questions');

        foreach($questions as $key => $question){
            $question_uuid = Uuid::generate();
            $saving = new Question();
            $saving->id = $question_uuid;
            $saving->title = $question['name'];
            $saving->description = $question['description'];
            $saving->revision_id = $uuid;
            $saving->order = $key;
            $saving->answers = json_encode($question['answers']);

            foreach($types as $type){
                if($type->name === $question['type']){
                    $saving->question_type_id = $type->id;
                }
            }

            $saving->save();
        }

        return response()->json([
            "uuid" => $uuid->string
        ],200);
    }

}