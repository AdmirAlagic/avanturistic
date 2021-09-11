<?php

namespace App\Http\Controllers;

use App\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Notification;

class AppController extends Controller
{
    protected $user;
    protected $badges;
    public function __construct()
    {


        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            view()->share('user', $this->user);

           

            $this->badges = config('badges.list', []);
            $badges_kewords = '';

                foreach($this->badges as $key => $val){
                    $badges_kewords .= ', '.str_replace('-',' ', $val['name']) . ' photos and videos';
                    $badges_kewords .= ', '.str_replace('-',' ', $val['name']) . ' outdoor adventures';
                    $badges_kewords .= ', '.str_replace('-',' ', $val['name']) . ' near me';
                    $badges_kewords .= ', '.str_replace('-',' ', $val['name']) . ' locations';

                }

            view()->share('badges_kewords', $badges_kewords);
            view()->share('badges', $this->badges);

            view()->share('pageTitle', 'Avanturistic • A network for adventure.');
           /*  view()->share('pageDescription', 'A place to share your outdoor adventure stories or adventure tourism services for free. Find outdoor activities near you and get useful information.'); */
            view()->share('pageImage', url('/img/avanturistic.jpg'));

            $conversations = [];
            if($this->user){

                $conversations = Conversation::whereHas('messages')->where(function($query) {
                    $query->where('users', 'LIKE', '%["'.$this->user->id .'",%')
                    ->orWhere('users', 'LIKE', '%,"'. $this->user->id .'"]%');
                })->orderBy('updated_at', 'desc')->take(10)->get();
            }

            view()->share('conversations', $conversations);
            $linkRegexPattern = $pattern = '@(http(s)?://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
            view()->share('linkRegexPattern', $linkRegexPattern);
 
            if($this->user ){
                $notifications = $this->user->notifications()->with('fromUser')->latest()->take(15)->get();
                $unreadNotifications = $this->user->notifications()->unread()->count();
                view()->share('notifications', $notifications);
                view()->share('unreadNotifications', $unreadNotifications);
            }

            if(isset($_SERVER["HTTP_USER_AGENT"]) && preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo 
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

    }

}
