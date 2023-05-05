<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verifyotp(Request $request)
    {
        $user = User::where('otp', $request->otp)->first();
        if($user){
            $user->markEmailAsVerified();
            event(new Verified($user));
            return response()->json(['success' => true, 'message' => "Email is verified"], 200);
        }
    }
    public function verify($id, $hash)
    {
        $user = User::find($id);
        abort_if(!$user, 403);
        abort_if(!hash_equals($hash, sha1($user->getEmailForVerification())), 403);
 
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            event(new Verified($user));
        }
        return response()->json(['success' => true, 'message' => "Email is verified"], 200);
   }
 
    public function resendNotification(Request $request) {
        $request->user()->sendEmailVerificationNotification();
 
        return ['message'=> 'OK.'];
    }
}
