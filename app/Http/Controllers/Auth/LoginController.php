<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use \Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware(function ($request, $next) {
//            $scripts[] = '/auth/login.js';
//            view()->share('scripts', $scripts);
            view()->share('pageTitle', 'Login • Avanturistic');
            view()->share('pageDescription', 'Log in to Avanturistic. Continue with Facebook. Continue with Google. Don\'t have an account?. Sign up');
            view()->share('pageImage', url('/img/avanturistic.jpg'));
            $isWebView = false;
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.omnitask.avanturistic") {
                    $isWebView = true;
                }
            }
            view()->share('isWebView', $isWebView);
            return $next($request);
        });
    }

    public function authenticate(Request $request)
    {
       
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();
            $user->update([
                'last_login_at' => Carbon::now()
            ]);
            return redirect()->intended('/');
        } else{
            return redirect()->back()->withErrors('Wrong password or email address.')->withInput();
        }
    }

    
}
