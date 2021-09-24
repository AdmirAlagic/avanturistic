<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Register;
use App\User;
use App\Http\Controllers\Controller;
use App\UserRank;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use Str;
use App\Repositories\Notifications\NotificationRepository;
use App\Notification;
use \Carbon\Carbon;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware(function ($request, $next) {
//            $scripts[] = '/auth/register.js';
//            view()->share('scripts', $scripts);
            view()->share('pageTitle', 'Sign Up');
            view()->share('pageDescription', 'Create a free account and share outdoor adventures with locations, photos and videos. Get involved in creating the world map of outdoor adventures!');
            view()->share('pageImage', url('/img/avanturistic.jpg'));

            if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo 
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
                , $_SERVER["HTTP_USER_AGENT"])){
                $isMobile = true;
            } else{
                $isMobile = false;
            }


            view()->share('isMobile', $isMobile);


            $isWebView = false;
            if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
                if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "com.omnitask.avanturistic") {
                    $isWebView = true;
                }
            }
            view()->share('isWebView', $isWebView);

            return $next($request);

        });
        $this->middleware('guest');
    }

    public function register(Register $request)
    {
        $input = $request->input();
        $userExists = User::where('email', $input['email'])->withTrashed()->first();
        if($userExists)
            return back()->withInput()->with('error', 'User with this email address already exists');

        $nameExists = User::where('name', $input['name'])->withTrashed()->first();
            if($nameExists)
                return back()->withInput()->with('error', 'Profile name already exists. Please choose another one.');
        try{
            DB::beginTransaction();
            $input['password'] = bcrypt($input['password']);
            $input['name_slug'] = Str::slug($input['name']);
            //we set parent_id in Form request
            $user = User::create($input);

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            Log::error('Registration failed: ' . $e->getMessage());
            return redirect('register')->withInput()->withError('There has been an error trying to create your account. Please try again, or contact us at info@avanturistic.com.');
        }
        $generalNotificationHtml = '<p><b>Welcome to Avanturistic!</b></p><p>Complete your profile and start sharing adventures. <br>If you have any questions or suggestions feel welcome to contact us directly through the <a href="https://avanturistic.com/support">support chat</a>. <br> Let\'s create the world map of adventures together! </p>';
        NotificationRepository::newNotification($user->id, Notification::$_TYPE_GENERAL, url('/profile'), null, $generalNotificationHtml, url('/img/logo.svg'));

        event(new Registered($user));
        $user->update([
            'last_login_at' => Carbon::now()
        ]);
        Auth::login($user, true);
        return redirect('/profile')->with('success', 'Welcome adventurer! Please <b>check your email</b> to confirm your account.');
    }

    public function asyncRegister(Register $request){
        $input = $request->input();
        /* $userExists = User::where('email', $input['email'])->withTrashed()->first();
        if($userExists)
            return response()->json('error', 'User with this email address already exists');

        $nameExists = User::where('name', $input['name'])->withTrashed()->first();
            if($nameExists)
                return response()->json(['error' => 'Profile name already exists. Please choose another one.']); */
        try{
            DB::beginTransaction();
            $input['password'] = bcrypt($input['password']);
            $input['name_slug'] = Str::slug($input['name']);
            //we set parent_id in Form request
            $user = User::create($input);

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
            Log::error('Registration failed: ' . $e->getMessage());
            return response()->json(['error' => 'There has been an error trying to create your account. Please try again, or contact us at info@avanturistic.com.' ] );
        }
        $generalNotificationHtml = '<p><b>Welcome to Avanturistic!</b></p><p>Complete your profile and start sharing adventures. <br>If you have any questions or suggestions feel welcome to contact us directly through the <a href="https://avanturistic.com/support">support chat</a>. <br> Let\'s create the world map of adventures together! </p>';
        NotificationRepository::newNotification($user->id, Notification::$_TYPE_GENERAL, url('/profile'), null, $generalNotificationHtml, url('/img/logo.svg'));

        event(new Registered($user));
        $user->update([
            'last_login_at' => Carbon::now()
        ]);
        Auth::login($user, true);
        session('success', 'Welcome adventurer! Please <b>check your email</b> to confirm your account.');
        return response()->json('success');
    }

    public function getRegister(Request $request){
        return view('auth.register');
    }
}
 