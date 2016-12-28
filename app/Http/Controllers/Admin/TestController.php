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
use App\Test;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


/**
 * Class AdminCreationController
 * @package App\Http\Controllers\Admin
 */
class TestController extends Controller
{

    public function index()
    {
        $recent_tests = Test::orderBy('created_at','DESC')->limit(20)->get();
        $recent_revisions = Revision::orderBy('created_at','DESC')->limit(20)->get();
        $test_count = Test::count();

        return view('admin/tests/index', array(
            'recent_tests' => $recent_tests,
            'recent_revisions' => $recent_revisions,
            'test_count' => $test_count
        )); 
    }

    public function creation_page()
    {
        return view('admin/tests/create', array(

        ));
    }
    
}