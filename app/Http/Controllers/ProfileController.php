<?php

namespace App\Http\Controllers;

use App\Conversation;
use App\Events\MessageSent;
use App\FavoriteUser;
use App\Http\Requests\UpdateProfile;
use App\Http\Requests\ChangePassword;
use App\Message;
use App\PostVisited;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Str;
use App\Post;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use App\PostLike;
use App\Country;

class ProfileController extends AppController
{
    public function __construct()
    {
        parent::__construct();

    }
    public function privateProfile(){

        if(!$this->user){
            return redirect('/')->with('success', 'Log in to continue');
        }
        $scripts[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.js';
        $scripts[] = '/js/libs/cropper/cropper.js';
        $scripts[] = '/js/libs/cropper/jquery-cropper.min.js';
        
        $mixScripts[] = '/dist/js/visiteds-map.js';

        $mixScripts[] = '/dist/js/avatar.js';

        $styles[] = '/dist/metronic/assets/plugins/line-awesome/css/line-awesome.css';
        $styles[] = ' /js/libs/cropper/cropper.css';

        view()->share('styles', $styles);
        view()->share('mixScripts', $mixScripts);
        view()->share('scripts', $scripts);

        $activePage = 'home';
        view()->share('activePage', $activePage);

        
        $data = [
            'pageTitle' => 'Profile • Avanturistic',
            'model' => $this->user,
            'badges' => $this->badges,
            'countries' =>  Country::orderBy('title', 'asc')->get(),
        ];
        return view('profile.form', $data);
    }

    public function updateProfile(UpdateProfile $request){


        $input = $request->except( 'password', 'password_confirmation', 'avatar', 'group');
        
        $message = 'Your profile has been updated.';
        $nameExists = User::where('name', $input['name'])->where('id', '!=', $this->user->id)->withTrashed()->first();
        if($nameExists)
            return back()->with('error', 'Display name already exists. Please choose another one.');
        $input['name_slug'] = Str::slug($input['name']);
        $user = Auth::user();
       
        $options = [];
        if(isset($this->user->options) && $this->user->options)
            $options = $this->user->options;
        if(isset($input['options'])){
            $options = array_merge($options, $input['options']);
            $input['options']  = $options;
        }

        $this->user->update($input);

        return redirect()->to('/@'.$user->name_slug)->with('success', $message);
    }
    public function publicProfile($slug = null){

        if(!$this->user){
            return redirect('/register')->with('error', 'Create an account to see users profiles.');
        }

        if(!$this->user){
            return redirect('/')->with('success', 'Log in to continue');
        }
        if($slug){
            $user = User::where('name_slug', $slug)->first();
        } else {
            $user = User::where('group', 'support')->first();
        }
        if($this->user && $this->user->id == $user->id){
            $scripts[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.js';
            $scripts[] = '/js/libs/cropper/cropper.js';
            $scripts[] = '/js/libs/cropper/jquery-cropper.min.js';
            $styles[] = ' /js/libs/cropper/cropper.css';
            $mixScripts[] = '/dist/js/avatar.js';
            view()->share('mixScripts', $mixScripts);
        }
        

        $scripts[] = '/js/libs/imagesLoader.min.js';
        $scripts[] = '/js/libs/masonry.min.js';
        $mixScripts[] = '/dist/js/map/user-map.js';
        $mixScripts[] = '/dist/js/profile.js';
        $mixScripts[] = '/dist/js/timelapses.js';
//        $scripts[] = '/js/libs/spotlight/spotlight.min.js';
        view()->share('scripts', $scripts);
        view()->share('mixScripts', $mixScripts);

        $styles[] = '/dist/metronic/assets/plugins/line-awesome/css/line-awesome.css';
//        $styles[] = '/js/libs/spotlight/css/spotlight.css';
        view()->share('styles',$styles);

        $currentUser = Auth::user();
        if(!$currentUser){
            return redirect('/login')->with('success', 'Log in or create account.');
        }
       

        if($this->user->id == $user->id){

            $activePage = 'my-profile';
            view()->share('activePage', $activePage);

        }


        $pageTitle = $user->name . ' • Avanturistic';
        $visitedCountriesCount = 0;
        if(isset($user->options['visited_countries']) && count($user->options['visited_countries']))
            $visitedCountriesCount = count($user->options['visited_countries']);

        $pageDescription = 'Adventures: '. count($user->posts);
        if($visitedCountriesCount)
            $pageDescription .= ' Visited Countries: '. $visitedCountriesCount;

        $pageImage = url($user->avatar ? $user->avatar : '/img/logo.svg');
        if($user->avatar)
            $pageImage = url($user->avatar);

        $hasSocial = false;
        if($user->social_links && count($user->social_links)){
            foreach($user->social_links as $key => $val){
               
                if($val && $val != ' ' && $val != ''){
                    $hasSocial = true;
                }
            }
        } 
        $meta = [
            'og:image' => $pageImage,
            'og:title' => $pageTitle,
            'og:description' => $pageDescription
         ];

        $data = [
            'model' => $user,
            'pageTitle' => $pageTitle,
            'pageDescription' => $pageDescription,
            'pageImage' => $pageImage,
            'hasSocial' => $hasSocial,
            'timelapses' => $user->timelapses()->public()->latest()->get()
        ];

        view()->share('meta', $meta);

        

        if($user->group == 'support' || $user->group == 'admin')
            return redirect('/message/'.$user->id);


        return view('profile.public', $data);
    }

    public function notifications(){
        if(!Auth::user())
        return redirect('/login');
        $unreadNotifications = $this->user->notifications()->unread()->get();
        foreach($unreadNotifications as $obj){
            $obj->update([
                'seen' => true
            ]);
        }
        $data = [
            'pageTitle' => 'Notifications • Avanturistic',
            'unreadNotifications' => 0
        ];
        return view('notifications.index', $data);
    }

    public function getMessage($id){
        if(!Auth::check()){
            return redirect('/');
        }
        $data['disableFooter'] = true;
        $toUser = User::findOrFail($id);
        $data['toUser'] = $toUser;

        $mixStyles[] = '/dist/css/chat.css';
      
        view()->share('styles',$mixStyles);
        $scripts[] = '/js/message.js';
        view()->share('scripts', $scripts);

        $userIds = [];
        $userIds[] = (string) $this->user->id;
        $userIds[] =  (string)$id;

        $conversation = Conversation::where('users', 'LIKE', '%["'.$this->user->id .'","'.$id .'"]%')->orWhere('users', 'LIKE', '%["'.$id.'","'.$this->user->id .'"]%')->first();
        if(!$conversation)
            $conversation = Conversation::create(['users' => $userIds]);

        $data['is_blocked'] = $conversation->blocked_from_id;
        $messages= $conversation->messages;
        $replaceEmojis = [
            ':D' => '😄',
            ':)' => '😃',
            ':*' => '😘',
            '<3' => '❤️',
            ';)' => '😉'
        ];


        foreach($messages as $obj){
            if($obj->to_user_id == $this->user->id){
                $obj->update(['seen' => true]);
            }
            foreach($replaceEmojis as $key => $val){
                $obj->body  = str_replace($key, $val, $obj->body);
            }
        }
        $data['conversation_id'] = $conversation->id;

        $data['messages'] = $messages;
        return view('profile.message', $data);
    }

    public function postMessage(Request $request){
        $input = $request->input();
        $conversation = Conversation::find($input['conversation_id']);
        $conversation->update(['updated_at' => Carbon::now()]);

        $message = Message::create(['from_user_id' => $this->user->id, 'to_user_id' => $input['to_user_id'], 'body' => $input['body'], 'conversation_id' => $input['conversation_id']]);
        event(new MessageSent($message));

        return response()->json($message);
    }

    public function messages(){

        if(!Auth::check())
            return redirect('/login');
        $data = [
           
        ];

        return view('profile.messages', $data);
    }

    public function blockUser($id){

        $conversation = Conversation::findOrFail($id);
        $blockedUser = User::find($conversation->users[0] == $conversation->id ? $conversation->users[1] : $conversation->users[0]);
        if($conversation->blocked_from_id){
            $conversation->update(['blocked_from_id'=> null]);
            return back()->with('success', 'User '.$blockedUser->name . ' unblocked.');
        } else{
            $conversation->update(['blocked_from_id'=> $this->user->id]);
            return back();
        }
        return back();
    }

    public function changePassword(){
        return view ('profile.settings.change_password');
    }

    public function postChangePassword(ChangePassword $request){
        $this->user->update([
            'password' => bcrypt($request->password)
        ]);
        return redirect('profile')->with('success', 'Password changed.');
    }


}
