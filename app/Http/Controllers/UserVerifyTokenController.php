<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;

class UserVerifyTokenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function validateUser(Request $request) {
        // Do a validation for the input
        $this->validate($request, [
        	'email' => 'required|email',
        ]);
        $email = $request->input('email');
        //Query the database with the email giving
        $user = User::where('email', $email)->first();
        //Check if rthe user exist
        if ($user === null) {
        	return response()->json(['data' =>['error' => false, 'message' => 'Not found']], 404);
        }

        try{
             Mail::to($user->email)->send(new VerificationCode($user));
             $user->save();
             return response()->json(['data' =>['success' => true, 'message' => "A verfication code has been sent to ".$user->email."!"]], 200);
          } catch (Exception $ex) {
             return response()->json(['data' =>['success' => true, 'message' => "Try again"]], 500);
          }

    }

}
