<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 03/12/2016
 * Time: 02:12
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Question;
use App\Question_Type;
use App\Revision;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Uuid;


/**
 * Class AdminCreationController
 * @package App\Http\Controllers\Admin
 */
class QuestionTypeController extends Controller
{

    public function index()
    {
        $question_types = Question_Type::where('enabled',true)->get();

        return view('admin/tests/question_types_index', array(
            'question_types' => $question_types
        ));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'question_type_name' => 'required|max:255',
            'question_type_description' => 'required',
        ]);

        $question_type = new Question_Type();
        $question_type->id = Uuid::generate();
        $question_type->name = $request->get('question_type_name');
        $question_type->description = $request->get('question_type_description');
        $question_type->enabled = true;
        $question_type->save();

        return redirect('/admin/tests/question_types');
    }

    public function delete($uuid)
    {
        $question_type = Question_Type::find($uuid);
        $question_type->enabled = false;
        $question_type->save();

        return redirect('/admin/tests/question_types');
    }

}