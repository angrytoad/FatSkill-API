<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\User_verification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\registrationEmail;

class ApiAuthController extends Controller {

    use AuthenticatesUsers;

    public function login(Request $request){
        if($this->attemptLogin($request)){
            $user = Auth::user();
            $user->api_token = str_random(60);
            $user->save();
            return response()->json([
                'api_token' => $user->api_token
            ], 200);
        }
    }

    public function register(Request $request) {

        // Verify the Input data and return errors on failure
        $email = $request->input('email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['status' => false, 'message' => 'Email address supplied is invalid.']);
        }
        $password = $request->input('password');
        if (strlen($password) < 8) {
            return response()->json(['status' => false, 'message' => 'Password must be 8 characters or longer.']);
        }
        $passwordConfirm = $request->input('passwordConfirm');
        if (strlen($passwordConfirm) < 8) {
            return response()->json(['status' => false, 'message' => 'Password must be 8 characters or longer.']);
        }
        if ($password !== $passwordConfirm) {
            return response()->json(['status' => false, 'message' => 'Passwords must match.']);
        }
        // Check for duplicate emails
        $user = User_verification::where('email', '=', $email)->get();
        if (!$user->isEmpty()) {
            return response()->json(['status' => false, 'message' => 'Email already in table.']);
        }

        // Make a url safe token for the user to authenticate with
        $urlCode = urlEncode(str_random(60));
        $urlString = 'http://fatskill.com/activate?key=' . $urlCode;
        $urlString = urlencode($urlString);

        $user_verification = new User_verification();
        $user_verification->id = rand(1, 1000000); //Change pls
        $user_verification->email = $email;
        $user_verification->token = $urlCode;
        $user_verification->name = $request->input('name');
        $user_verification->password = Hash::make($password);
        $user_verification->save();

        // Send authentication email and return success event
        Mail::to($email)->send(new registrationEmail($urlString));
        return response()->json(['status' => True, 'message' => 'Registration was successful, an activation email has been sent to the supplied email address!']);

    }

}