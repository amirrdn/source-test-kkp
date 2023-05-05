<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Mail\VerificationEmail;
use App\Clasess\Users;

use Validator;
use JWTFactory;
use JWTAuth;
use Auth;
use Mail;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->users                = new Users;
    }
    public function registration(Request $request)
    {
        $otp = rand(1000,9999);
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'device_name' => request('device_name'),
            'otp' => $otp
        ]);
        $token = $user->createToken(request('device_name'))->plainTextToken;
        event(new Registered($user));
        \Mail::to($user->email)->send(new VerificationEmail($user));
        //$user->sendEmailVerificationNotification();
        return $token;
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return $this->createNewToken($request,$token);
    }
    protected function createNewToken(Request $request,$token)
    {
        $users          = $this->users->getUser()->where('users.id', auth()->user()->id)->first();
        User::where('id', auth()->user()->id)->update(array('token' => $token));
        if($users->status === '0'){
            return response()->json([
                'message' => 'Your account not active'
            ]);
        }
        return response()->json([
            'success'   => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'users' => $users,
            // 'permission' => $permission,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'isLoggedIn'=> true
        ]);
    }
}
