<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Socialite;
use Log;
use App\Repositories\Notifications\NotificationRepository;
use App\Notification;
use Exception;
use Mail;

class OAuthLoginController extends Controller
{
    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback(Request $request, $driver)
    {


        $user = Socialite::driver($driver)->stateless()->user();

        try{
            if(isset($user)){
                Log::info('User logged in from '. $driver, ['response' => $user]);

                $userExists = User::where('email', $user->email)->first();

                if(!$userExists){

                    $user = User::create([
                        'email' => $user->email,
                        'name' => $user->name,
                        'name_slug' => Str::slug($user->name, '-'),
                        'password' => bcrypt('xxx123') ,
                        'input_source' => 'facebook' ,
                        'email_verified_at' => Carbon::now(),
//                        'avatar' => $user->avatar,
                    ]);
                    $generalNotificationHtml = '<p><b>Welcome to Avanturistic!</b></p><p>Complete your profile and start sharing adventures. <br>If you have any questions or suggestions feel welcome to contact us at <a href="mailto:info@avanturistic.com">info@avanturistic.com</a>. <br> Let\'s create the world map of adventures together! </p>';
                    NotificationRepository::newNotification($user->id, Notification::$_TYPE_GENERAL, url('/profile'), null, $generalNotificationHtml, url('/img/logo.svg'));
                    \Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
                    
                } else {
                    $user = $userExists;
                }
                $user->update([
                    'last_login_at' => Carbon::now()
                ]);

                Auth::login($user, true);

                return redirect()->intended('/');
            }
        } catch (\Exception $e){
            Log::error('oauth '. $driver, ['exception'=> $e]);
        }


    }
}