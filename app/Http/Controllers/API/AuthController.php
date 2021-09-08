<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Str;
use Log;

class AuthController extends Controller
{
    public function login(Request $request){
        $error = null;
        $data = [];
        $email = $request->input('email');

        if(Auth::attempt([
            'email' => $email,
            'password' => $request->input('password')
        ])){
            $loggedIn = true;
            $data = [
                'user' => User::where('email', $email)->firstOrFail()
            ];
            Log::info('login from App - '. $email);
        } else{
            $error = 'Wrong email or password.';
            Log::warning('login from App - '. $request->input('email'));
        }

        return response()->json($error ? ['error' => $error] : $data, $error ? 400 : 200);
    }
    public function register(Request $request){
        $error = null;
        $data = [];
        $userExisted = false;
        $input = $request->input();
        $input['password'] = bcrypt($input['password']);
        $input['name_slug'] = Str::slug($input['name']);
        Log::warning('register from App - '. $request->input('email'));
        $user = User::where('email', $input['email'])->first();
        if($user)
            return response()->json(['error' => 'Account with '.$input['email'] .' already exist.'], 400);

        $user = User::create($input);
        $data = [
            'user' => $user,
        ];

        return response()->json($error ? ['error' => $error] : $data, $error ? 400 : 200);
    }

    public function saveFCMToken(Request $request){
        $email = str_replace('"','', $request->input('email'));
        $token = $request->input('token');
        $input = $request->input();
        Log::info($input);
        $user = User::where('email', $email)->firstOrFail();
        $user->update([
            'fcm_token' => $token
        ]);
        return response()->json('success');
    }

}
