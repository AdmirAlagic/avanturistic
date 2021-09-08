<?php

namespace App\Http\Controllers;
use App\Country;
use App\Comment;
use App\FavoriteUser;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Conversation;
use DB;
use App\Post;
use App\PostLike;
use App\PostVisited;
use Str;
use UtilHelper;
use App\Repositories\Notifications\NotificationRepository;
use Exception;
use Mail;

class AjaxController extends Controller
{
    public function getRandomImage(Request $request){
        $sql = 'SELECT id, title, lat, lng, image from posts';

        $sql .= ' WHERE likes > 3 ORDER BY RAND() LIMIT 1';
        $posts = DB::select( DB::raw($sql));

        return response()->json(['posts' => $posts]);
    }

    public function getLastMessagesView(){

        $user = Auth::user();
        $data['user'] = $user;

        $conversations = Conversation::whereHas('messages')->where('users', 'LIKE', '%["'.$user->id .'",%')
        ->orWhere('users', 'LIKE', '%,"'. $user->id .'"]%')
        ->orderBy('updated_at', 'desc')->take(10)->get();
        $data['conversations'] = $conversations;
        $data['show'] = true;
        return view('shared.last_messages', $data);
    }

    public function getAllMessagesView(){

        $user = Auth::user();
        $data['user'] = $user;

        $conversations = Conversation::where('users', 'LIKE', '%'. $user->id .'%')->where('blocked_from_id', 0)->orderBy('updated_at', 'desc')->get();
        $data['conversations'] = $conversations;

        return view('shared.all_messages', $data);
    }

    public function getSingleMessageView(Request $request){

        $message = Message::findOrFail($request->input('message_id'));

        $user = Auth::user();

        $linkRegexPattern = $pattern = '@(http(s)?://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
        view()->share('linkRegexPattern', $linkRegexPattern);

        $data['user'] = $user;
        $replaceEmojis = [
            ':D' => '😄',
            ':)' => '😃',
            ':*' => '😘',
            '<3' => '❤️',
            ';)' => '😉'
        ];

        foreach($replaceEmojis as $key => $val){
            $message->body  = str_replace($key, $val, $message->body);
        }
        $message->body =  preg_replace($linkRegexPattern, '<a target="_blank" href="http$2://$3">$0</a>', $message->body);
        $data['obj'] = $message;
        return view('shared.single_message', $data);
    }

    public function searchUsers(Request $request){

        $query = $request->input('query');
        $data['users'] = User::where('name', 'LIKE', '%'.$query.'%')->orWhere('email', 'LIKE', '%'.$query.'%')->take(10)->get();
        $data['query'] = $query;
        return view('shared.users_search', $data);
    }
    public function setLocation(Request $request){
        $input = $request->input();
        $user = Auth::user();
        DB::beginTransaction();
        if($user){

            $user->lat = $input['lat'];
            $user->lng =  $input['lng'];
            $user->location_updated_at = Carbon::now();
            $user->save();

        } else{
            $request->session()->put('user_location',['lat' => $input['lat'], 'lng' => $input['lng']]);

        }
        DB::commit();
        return response()->json(['lat' => $input['lat'], 'lng' => $input['lng']]);

    }
    public function addRemoveUserFromFavorites(Request $request){
        $input = $request->input();
        $user = Auth::user();
        $favUser = FavoriteUser::where('user_id', $user->id)->where('favorite_user_id', $input['user_id'])->first();
        $type = 'add';
        if(!$favUser){
            $favUser = FavoriteUser::create([
                'user_id' => $user->id,
                'favorite_user_id' => $input['user_id']
            ]);
        } else {
            $type = 'remove';
            $favUser->delete();
        }

        return response()->json($type);

    }
    public function getProfilePosts(Request $request){
        $input = $request->input();
        $model = User::findOrFail($input['user_id']);
        $page = isset($input['page']) ? $input['page'] : 1;
        $perPage = 10;
        $skip = $page > 1 ? ($page - 1) * $perPage : 0;
        //$posts = $model->posts()->skip($skip)->take($page * $perPage)->get();
        $sql = 'SELECT title,slug, likes,visiteds, comments_count, image,video, posts.created_at, posts.options as options, posts.id FROM posts';
        $sql .= ' WHERE posts.deleted_at IS NULL AND user_id = '. $model->id;
        $sql .=  ' ORDER BY created_at DESC ';

        $sql .= ' LIMIT '.$perPage;
        if($page > 1)
            $sql .=  ' OFFSET '.($page -1) * $perPage;


       // try{
            $posts = DB::select(DB::raw($sql));

       // } catch (\Exception $exception){
        //    $posts = [];
       // }

        return response()->json(['posts' => $posts]);
    }
    public function getProfileBlog(Request $request){
        $input = $request->input();
        $model = User::findOrFail($input['user_id']);
        $page = isset($input['page']) ? $input['page'] : 1;
        $perPage = 3;

        $sql = 'SELECT title, description, image, blog.created_at, blog.id  as post_id , slug as post_slug FROM blog';
        $sql .= ' WHERE user_id = '. $model->id;
        $sql .= ' LIMIT '.$perPage;
        if($page > 1)
            $sql .=  ' OFFSET '.$page * $perPage;


        try{
            $posts = DB::select(DB::raw($sql));

        } catch (\Exception $exception){
            return 'false';
            $posts = [];
        }
        if(!count($posts)){
            return 'false';
        }
        $data['blog'] = $posts;
        return view('shared.profile.more_blog', $data);

    }
    public function getPostsByLocation(Request $request){
        $ip = $request->getClientIp();
        $input = $request->input();
        $data = $this->getPostsByLocationBack($input, 4, $ip);
        if(!count($data['posts'])){
            return 'false';
        }
        return view('shared.more_posts', $data);
    }

    public function getPostsByLocationData(Request $request){
        $ip = $request->getClientIp();
        $input = $request->input();
        $data = $this->getPostsByLocationBack($input, 5, $ip);

        return $data;
    }

    public function getPostsByLocationDataInput($input, $limit, $ip){
         
        $data = $this->getPostsByLocationBack($input, $limit, $ip);

        return $data;
    }

    public function getPostsByLocationBack($input, $limit, $ip){
        /* $ip = $request->getClientIp();
        $input = $request->input(); */
        $location = null;
        $user = Auth::user();
        $radius = isset($input['radius']) ? $input['radius'] : 500;
        $sort = isset($input['sort']) ? $input['sort'] : 'date';
        $page = isset($input['page']) ? $input['page'] : 1;
        $perPage = isset($input['perPage']) ? $input['perPage'] : $limit;
        $posts = [];
        $mainActivity = null;

        if(isset($input['lat']) && isset($input['lng'])){
//            Guest
            session('user_location' , ['lat' => $input['lat'], 'lng' => $input['lng']]);
            $lat = $input['lat'];
            $lng = $input['lng'];
        } else {
            if($user) {
//              User
                if(!$user->location_updated_at ||  !$user->lat|| !$user->lng){
                    $result = geoip($ip);
                    if (isset($result['lat']) && isset($result['lon'])) {

                        $lat = $result['lat'];
                        $lng = $result['lon'];

                        $user->lat = $lat;
                        $user->lng = $lng;
                        $user->location_updated_at = Carbon::now();
                        $user->save();
                    }
                }
                $lat = $user->lat;
                $lng = $user->lng;

            } else{
                $userLocation = session('user_location');

                if(isset($userLocation['lat']) && isset($userLocation['lng'])){
                    $lat = $userLocation['lat'];
                    $lng = $userLocation['lng'];
                } else {
                    $result = geoip($ip);
                    if (isset($result['lat']) && isset($result['lon'])) {
                        $lat = $result['lat'];
                        $lng = $result['lon'];
                        session()->put('user_location',['lat' => $result['lat'], 'lng' => $result['lon']]);
                    }
                }
            }
        }

        if($lat && $lng){

            $sql = 'SELECT title, slug, likes,visiteds, comments_count, image, posts.is_recommended, posts.video,posts.country_code,posts.has_route, posts.created_at, posts.options as opts, posts.id, users.name AS username, users.name_slug as username_slug,users.group, users.id as user_id, users.avatar, 
            ( 6371.392896  * acos( cos( radians('.$lat.') ) * cos( radians( posts.lat ) ) 
            * cos( radians( posts.lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin(radians(posts.lat)) ) ) AS distance';

            if($user){
                $sql.= ',(exists (select 1
                from post_likes v
                where v.post_id = posts.id and v.user_id = '.$user->id.'
               )
       ) as isLiked';
                $sql.= ',(exists (select 1
                from post_visiteds v
                where v.post_id = posts.id and v.user_id = '.$user->id.'
               )
       ) as isVisited';

            }
            $sql .= ' FROM posts';


            $sql .= ' LEFT JOIN users ON users.id=posts.user_id';

            $sql .= " WHERE posts.deleted_at IS NULL AND posts.is_public = 1";
            
            if(isset($input['country']) && $input['country']){
                $sql .= ' AND posts.country_code = "'.$input['country'] .'"';
                $sort = 'c';
            }

            if(isset($input['filters']) && count($input['filters'])){
             
                $badges = $input['filters'];
                $count = 0;
                foreach($badges as $key => $val){
                    if($count == 0)
                    {
                        $mainActivity = $val;
                        $sql .= ' AND (';
                        $sql .= " posts.options LIKE '%". $val . "%'";
                    } else {
                        $sql .= " OR posts.options LIKE '%". $val . "%'";
                    }


                    if($count == count($badges) - 1)
                        $sql .= ')';
                    $count++;
                }

            }  

            if(isset($input['country_code'])){
                $sql .= ' AND  posts.country_code = "'.$input['country_code'].'" ';
                $sort = 'c';
            }

            if($input['sort'] == 'latest_nearest')
                $sql .= ' ORDER BY created_at DESC,distance ASC';


            if($input['sort'] == 'nearest')
                $sql .= ' ORDER BY distance ASC';

            if($input['sort'] == 'date' || $input['sort'] == 'c')
                $sql .= ' ORDER BY created_at DESC';

            if($input['sort'] == 'distance')
                $sql .= ' ORDER BY distance ASC';


            $sql .= ' LIMIT '.$perPage;
            if($page > 1)
                $sql .=  ' OFFSET '.($page -1) * $perPage;



            $posts = DB::select(DB::raw($sql));



        }

        $data['user'] = $user;
        $data['posts'] = $posts;
        $data['badges'] = config('badges.list');
        $data['sort'] =  $sort;
        $data['mainActivity'] = $mainActivity;
        return $data;
    }

    public function saveVisitedCountry(Request $request){
        $input = $request->input();
        $user = Auth::user();

        $options = $user->options;
        if(!$options){
            $options = [];
        }
        $visitedCountries = [];

        if(!isset($options['visited_countries'])){
            $options['visited_countries'] = [];
        }
        $visitedCountries = $options['visited_countries'];
        if(!in_array($input['country_id'], $visitedCountries)){
            $visitedCountries[] = $input['country_id'];

        } else {
            $newArray = [];
            foreach($visitedCountries as $key => $val){
                if($val != $input['country_id']){
                    $newArray[] = $val;
                }
            }
            $visitedCountries = $newArray;
        }

        $options['visited_countries'] = $visitedCountries;
        $user->options = $options;
        $user->save();
        return response()->json($visitedCountries);

    }
    public function getVisitedCountries(Request $request){

        if($request->has('user_id')){
            $user =  User::findOrFail($request->input( 'user_id'));
        } else {
            $user = Auth::user();
        }

        $options = $user->options;
        if(!$options){
            $options = [];
        }
        $visitedCountries = [];

        if(isset($user->options['visited_countries']) && count($user->options['visited_countries'])){
            return response()->json($user->options['visited_countries']);
        }
        else {
            return [];
        }
    }

    public function getPost(Request $request){
        $id = $request->input('post_id');
        $user = Auth::user();
        $post = Post::findOrFail($id);
        $data['post']  = $post;

        $data['user'] = $user;
        $data['comments'] = $post->comments()->approved()->orderBy('created_at', 'asc')->paginate(20);
        $postLikeExists = false;
        $postVisitedsExists = false;
        if($user){
            $postLikeExists = DB::table('post_likes')->where('user_id' , $user->id)->where('post_id', $post->id)->first();
            $postVisitedsExists = DB::table('post_visiteds')->where('user_id' , $user->id)->where('post_id', $post->id)->first();
        }

        $data['country'] = $post->country ? $post->country->title : null;
        $data['countryFlag'] = $post->country ? $post->country->emoji : null;;
        $data['countrySlug'] = $post->country ? $post->country->slug : null;;
        $data['alreadyLiked'] = $postLikeExists ? true : false;
        $data['alreadyVisited'] = $postVisitedsExists ? true : false;
        $badgesList = config('badges.list', []);
        $data['badges'] = $badgesList;
        $lat = $post->lat;
        $lng = $post->lng;

        $sql = 'SELECT id,title,slug,map_options, options, country_code, image, posts.address , posts.country_code, ( 6371.392896  * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) 
            * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin(radians(lat)) ) ) AS distance 
            FROM posts';

        $sql .= ' WHERE  is_public = 1 AND id != "'.$post->id . '" ORDER BY distance ASC LIMIT 20' ;
        $nearbyPosts = DB::select( DB::raw($sql));

        foreach($nearbyPosts as $obj){
            $opts = json_decode($obj->options, true);
            $badge = isset($opts['badges']) && count($opts['badges']) ? array_key_first($opts['badges']) : null;
            $badge = $badge != null && array_key_exists($badge, $badgesList) ? $badge : null;
            $obj->badge = $badge;

        }
        $data['nearbyPosts'] = $nearbyPosts;
        $translatableText = '';

        if($post->description)
            $translatableText .= strip_tags(html_entity_decode(str_replace(['/', '-',], '', str_replace('&nbsp;', ' ', $post->description))));
        $data['dms'] =  UtilHelper::latLngtoDMS($post->lat,$post->lng);
        $data['translatableText'] = $translatableText;

        if(preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo 
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
            , $_SERVER["HTTP_USER_AGENT"])){
            $isMobile = true;
        } else{
            $isMobile = false;
        }


        view()->share('isMobile', $isMobile);
        return view('shared.post_modal', $data);
    }
    public function getFavoritesPosts(Request $request){

        $input = $request->input();
        $user = Auth::user();
        $data['user'] = $user;

        $page = isset($input['page']) ? $input['page'] : 1;
        $perPage =  10;

        $favorites = $user->favorites()->orderBy('id', 'desc')->pluck('favorite_user_id')->toArray();

        $sql = 'SELECT title,slug, likes,visiteds, comments_count, image,posts.video, posts.options, posts.created_at, posts.options as opts, posts.id, users.name AS username,users.group, users.name_slug as username_slug, users.id as user_id, users.avatar FROM posts';
        $sql .= ' LEFT JOIN users ON users.id=posts.user_id';
        $sql .= '  WHERE  posts.user_id IN ('. implode(',', $favorites) . ')';
        $sql .= '  ORDER BY created_at DESC';
        $sql .= ' LIMIT '.$perPage;
        if($page >= 1)
            $sql .=  ' OFFSET '.($page -1) * $perPage;

        try{
            $posts = DB::select(DB::raw($sql));

        } catch (\Exception $exception){
            dd($exception);
            $posts = [];
        }

        $data['posts'] = $posts;
        $data['badges'] = config('badges.list');
        if(!count($posts)){
            return 'false';
        }
        return view('shared.more_posts', $data);
    }

    public function getProfileActivity(Request $request){

        $input = $request->input();
        $type = $input['type'];
        if(!$request->filled('user_id')){
            $currentUser = Auth::user();
            if($request->filled('post_id')){
                $post = Post::find($input['post_id']);
            }
            if(isset($post) && $post){
                $user = $post->user;
            }
            else {
                $user = $currentUser;
            }

        } else {
            $user = User::findOrFail($input['user_id']);
        }

        $currentUser = Auth::user();
        $page = isset($input['page']) ? $input['page'] : 1;
        $perPage =  3;

        if($type == 'likes'){
            if(!$currentUser || $currentUser->id != $user->id){
                return 'false';
            }
            $view = 'more_likes';
            $sql = 'SELECT  posts.id as post_id, slug, users.id as user_id, users.name as username, users.name_slug as username_slug,users.group, users.avatar, posts.image, post_likes.created_at FROM post_likes';

            $sql .= ' LEFT JOIN users ON users.id=post_likes.user_id';
            $sql .= ' LEFT JOIN posts ON posts.id=post_likes.post_id';
            $sql .= ' WHERE post_likes.post_user_id = '.$user->id;
            if($request->filled('post_id')){
                $sql .= ' AND post_likes.post_id = '.$input['post_id'];
            }
            $sql .= ' ORDER BY post_likes.created_at DESC';
        } else{
//            Visited by
            $view = 'more_activity';
            $sql = 'SELECT  posts.id as post_id, slug, users.id as user_id, users.name as username, users.name_slug as username_slug, users.avatar,users.group, posts.image, post_visiteds.created_at FROM post_visiteds';


            $sql .= ' LEFT JOIN posts ON posts.id=post_visiteds.post_id';

            if($type == 'user'){
                $sql .= ' LEFT JOIN users ON users.id=post_visiteds.user_id';
                if($user)
                $sql .= ' WHERE post_visiteds.user_id = '.$user->id;
            }
            if($type == 'others'){
                $sql .= ' LEFT JOIN users ON users.id=post_visiteds.user_id';
                if($user)
                $sql .= ' WHERE post_visiteds.post_user_id = '.$user->id . ' AND  post_visiteds.user_id != '.$user->id;

            }
            if($request->filled('post_id')){
                $sql .= ' AND post_visiteds.post_id = '.$input['post_id'];
            }
            $sql .= ' ORDER BY post_visiteds.created_at DESC';
        }

        $sql .= ' LIMIT '.$perPage;

        if($page > 1)
            $sql .=  ' OFFSET '. ($page - 1) * $perPage;

        try{
            $activity = DB::select(DB::raw($sql));

        } catch (\Exception $exception){
            return 'false';
            $activity = [];
        }
        if(!count($activity))
            return 'false';

        $data['activity'] = $activity;
        $data['type'] = $type;
        $data['hasPost'] = isset($post) && $post ? true : false;
        return view('shared.profile.'.$view, $data);
    }

    public function removeNotifications(Request $request){
        $user = Auth::user();
        if($user ){
           $sql = 'UPDATE notifications  SET seen = 1 WHERE seen =  0 AND user_id ='.$user->id;
            DB::update(DB::raw($sql));
 
        }
        return response()->json('success');
    }

    public function getFavoritesView(Request $request){
        $user = Auth::user();
        if($user){
            $favorites = $user->favorites()->orderBy('created_at', 'desc')->pluck('favorite_user_id')->toArray();

            $sql = 'SELECT name, id, name_slug, avatar FROM users';
            $sql .= '  WHERE  id IN ('. implode(',', $favorites) . ')';
            $sql .= '  ORDER BY name asc';


            try{
                $favorites = DB::select(DB::raw($sql));

            } catch (\Exception $exception){

                $favorites = [];
            }

            $data['favorites'] = $favorites;
            return view('shared.favorites', $data);
        }
    }

    public function getBadges(Request $request){
        $badges = config('badges.list');
        $badgesArray = [];
        $term = $request->input('term');

        foreach($badges as $key => $val){
            if( !$term || strpos(strtolower($val['name']), strtolower($term)) !== false) {
                $badgesArray[] = ['img' => $val['icon'], 'value' => $val['name'], 'id' => $key, 'value' => $val['name']];
            }

        }
        return response()->json($badgesArray);
    }

    public function fbLogin(Request $request){
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if(!$user){
            $user = User::create([
                'email' => $email,
                'name' => $request->input('name'),
                'name_slug' => Str::slug($request->input('name'), '-'),
                'password' => bcrypt(Str::random(7)) ,
                'input_source' => 'facebook' ,
                'email_verified_at' => Carbon::now(),
                'fb_id' => $request->input('fb_id'),
//                'avatar' => $avatar,
            ]);
            $generalNotificationHtml = '<p><b>Welcome to Avanturistic!</b></p><p>Complete your profile and start sharing adventures. <br>If you have any questions or suggestions feel welcome to contact us directly through  <a href="https://avanturistic.com/support">support chat</a>. <br> Let\'s create the world map of adventures together! </p>';
            NotificationRepository::newNotification($user->id, Notification::$_TYPE_GENERAL, url('/profile'), null, $generalNotificationHtml, url('/img/logo.svg'));
            try{
                \Mail::to($user->email)->send(new \App\Mail\WelcomeMail($user));
            } catch (Exception $e){
                Log::info('Failed to send mail:', $e->getMessage());
            }
        }
        $user->update([
            'last_login_at' => Carbon::now()
        ]);

        Auth::login($user, true);

        return response(['status' => 'success'], 200);
    }


    public function googleLogin(Request $request){
        $email = $request->input('email');
        $user = User::where('email', $email)->first();
        if(!$user){
            $user = User::create([
                'email' => $email,
                'name' => $request->input('name'),
                'name_slug' => Str::slug($request->input('name'), '-'),
                'password' => bcrypt(Str::random(7)) ,
                'input_source' => 'facebook' ,
                'email_verified_at' => Carbon::now(),
                'google_id' => $request->input('user_id'),
//                'avatar' => $avatar,
            ]);
            $generalNotificationHtml = '<p><b>Welcome to Avanturistic!</b></p><p>Complete your profile and start sharing adventures. <br>If you have any questions or suggestions feel welcome to contact us directly through  <a href="https://avanturistic.com/support">support chat</a>. <br> Let\'s create the world map of adventures together! </p>';
            NotificationRepository::newNotification($user->id, Notification::$_TYPE_GENERAL, url('/profile'), null, $generalNotificationHtml, url('/img/logo.svg'));
           try{
            \Mail::to($event->user->email)->send(new \App\Mail\WelcomeMail($user));
           } catch (Exception $e){
               Log::info('Failed to send mail:', $e->getMessage());
           }
        }
        $user->update([
            'last_login_at' => Carbon::now()
        ]);

        Auth::login($user, true);

        return response(['status' => 'success'], 200);
    }

    public function getCountryGeometry(Request $request){
        $country  = Country::where('code3', $request->input('country_code'))->first();
        return json_encode([$country->geo_data]);
    }

    public function deleteComment(Request $request){
        $user = Auth::user();
        $comment = Comment::where('id', $request->input('comment_id'))->where('user_id', $user->id);
        $comment->delete();
        return response()->json('success');
    }

    public function deletePost(Request $request){
        $user = Auth::user();
        $post = Post::where('id', $request->input('post_id'))->where('user_id', $user->id);
        $post->delete();
        return response()->json('success');
    }
}
