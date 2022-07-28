<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\Post;
use App\Blog;
use App\PostLike;
use App\User;
use App\Timelapse;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Illuminate\Support\Facades\Session;
use Str;
use Log;



class PublicController extends AppController
{
    public function __construct()
    {

        parent::__construct();

    }

    public function index(Request $request)
    {
       
         
        $activePage = 'home';
        view()->share('activePage', $activePage);
        
        $posts = [];
        $posts = Post::with('user')->where('is_public', 1)->whereHas('user')->latest()->get();
        $posts = $posts->unique('user_id')->take(4);
        
        $videoPosts = Post::whereNotNull('video')->where('is_public', 1)->latest()->take(1)->get();
         
        if($this->user){
            $this->user->update([
                'last_login_at' => Carbon::now()
            ]);   
        }

        $latestBadges = [];
        $postsArray= [];
        foreach ($posts as $post) {

            if (isset($post->options['badges'])) {
                foreach ($post->options['badges'] as $key => $obj)
                    if (!in_array($key, $latestBadges)){
                        $latestBadges[] = $key;
                    }

            }
            $likeExists = false;
            $sessionPostId  = session()->get('post_id_'.$post->id);
      
            if(!$sessionPostId){
                $post->update([
                    'views' => $post->views + 1
                ]);
                session(['post_id_'. $post->id => $post->id]);
                
            }
            if($this->user){
                $likeExists = DB::table('post_likes')->where('post_id', $post->id)->where('user_id', $this->user->id)->first();
                if($likeExists)
                    $likeExists = true;
            }
            $post->likeExists = $likeExists;
            $postsArray[] = $post;
        }
       
        $quotesIdsList = session()->get('quotesIdList', []);
        
        $quote =  DB::table('quotes')->whereNotIn('id', $quotesIdsList )->inRandomOrder()->first();
      
        if(!$quote){
          $quote =   DB::table('quotes')->inRandomOrder()->first();
            $quotesIdsList = [];
        }
        $stories = Blog::orderBy('created_at', 'desc')->where('is_published', 1)->take(4)->get();
        $latestUsers = User::orderBy('created_at', 'desc')->whereHas('posts', function ($query) {
            $query->where('is_public', 1)->where('created_at', '>', Carbon::now()->subMonths(3));
        }, '>=', 5)->take(5)->orderBy('created_at', 'desc')->get();
     
        $data = [
            'pageDescription' => 'Explore the great outdoors on interactive map of outdoor adventures. Create a free account and share your adventures with outdoor enthusiasts worldwide.',
            'latestBadges' => $latestBadges,
            'posts' => $postsArray,
            'countries' =>  Country::whereHas('posts')->get(),
            'videoPosts' => $videoPosts,
            'badges' => config('badges.list'),
            'quote' => $quote,
            'stories' => $stories,
            'latestUsers' => $latestUsers,
        ];

        $quotesIdsList[] = $quote->id;
        session()->put('quotesIdList', $quotesIdsList);

        $mixScripts[] = '/dist/js/home.js';
        view()->share('mixScripts', $mixScripts);
        
        return view('public.home', $data);
    }

    public function activities(Request $request)
    {

        $activePage = 'activities';
        view()->share('activePage', $activePage);

        $badges = config('badges.list');
        $postListIds = [];
        $postList = [];
        foreach ($badges as $badge => $obj) {
            $post = DB::table('posts')->whereNotIn('id', $postListIds)->where('options', 'LIKE', '%' . $badge . '%')->orderBy('created_at', 'desc')->first();
            if ($post) {
                $postListIds[] = $post->id;
                $postList[$badge] = $post;
            }

        }
        $data['badgesPost'] = $postList;

        return view('public.categories', $data);
    }

    public function videos(Request $request)
    {

        $activePage = 'videos';
        view()->share('activePage', $activePage);

        $posts = Post::whereNotNull('video')->where('is_public', 1)->orderBy('created_at', 'desc');
        $nextPost = Post::whereNotNull('video')->where('is_public', 1)->orderBy('created_at', 'desc');

        if ($request->has('page')) {
            $posts = $posts->skip($request->input('page'));
            $nextPost = $nextPost->skip($request->input('page') + 1)->first();
        } else {
            $nextPost = $nextPost->skip(1)->first();
        }
        $posts = $posts->take(1)->get();
        if (count($posts) == 0) {
            abort(404);
            $posts = Post::whereNotNull('video')->orderBy('created_at', 'desc')->take(1)->get();

        }
        $title = 'Watch';
        $description = 'Watch adventure videos from outdoor enthusiasts worldwide. Promote your YouTube videos for free.';

        $meta['og:title'] = $title;
        $meta['og:description'] = $description;
        view()->share('meta', $meta);

        $data = [
            'posts' => $posts,
            'nextPost' => $nextPost,
            'pageTitle' => $title,
            'mobileTitle' => 'Watch',
            'pageDescription' => $description,
        ];

        return view('public.videos', $data);
    }

    public function activity($slug)
    {

        $activePage = 'activities';
        view()->share('activePage', $activePage);

        $mixScripts[] = '/js/activity.js';
        view()->share('mixScripts', $mixScripts);

        $scripts[] = '/js/libs/imagesLoader.min.js';
        $scripts[] = '/js/libs/masonry.min.js';
        view()->share('scripts', $scripts);

        $badges = config('badges.list');
        if (!isset($badges[$slug])) {
            abort(404);
        }

        $activity =  Category::where('slug', $slug)->firstOrFail();
        $data['activity'] = $activity;

        $title =  ucfirst($activity->title) . ' adventures';
        
        $pageDescription = isset($activity->options['meta_description']) ? $activity->options['meta_description'] : ($activity->options['intro_description_explore'] ? Str::limit($activity->options['intro_description_explore'], 160) : $title);
        $hasPosts = DB::table('posts')->where('options', 'LIKE', '%'.$activity->slug.'%')->get();
        
        $data['hasPosts'] = count($hasPosts) ? true : false;
        $data['pageImage'] = url($activity->bg_image);
        $data['pageTitle'] = $title;
        $data['mobileTitle'] = $title;
        $data['pageDescription'] = $pageDescription;

        $meta['og:image'] = url($activity->bg_image);
        $meta['og:title'] = $title;
        $meta['og:description'] = $pageDescription;
        view()->share('meta', $meta);

        return view('public.activity', $data);
    }

    public function search(Request $request)
    {
        $activePage = 'search';
        view()->share('activePage', $activePage);

        $scripts[] = 'https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js';
        view()->share('scripts', $scripts);

        $mixScripts[] = '/dist/js/search.js';
        view()->share('mixScripts', $mixScripts);

        $users = [];
        $countries = [];
        $results = [];
        $posts = [];
      
        $data = [
            'badges' => Category::all(),  
            'pageTitle' => 'Search',
            'mobileTitle' => 'Search',
         
        ];
        return view('public.search', $data);
    }

    public function postSearch(Request $request){
        $users = [];
        $countries = []; 
        $results = [];
        $posts = [];
        $data = [
            'users' => [],
            'countries' => [],
            'posts' => [],
        ];
        if ($request->has('query') && $request->query != '' && $request->query != ' ') {
            
            $q = $request->input('query');
            $users = DB::table('users')->whereIn('group', ['user', 'business'])->where('name', 'LIKE',  $q . '%')->take(10)->latest()->get();
            $countries = Country::where('title', 'LIKE', '%' . $q . '%')->whereHas('posts')->take(10)->get();
            $posts = Post::where('title', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q )->orWhere('address', 'LIKE', '%' . $q )->orWhere('options', 'LIKE', '%' . $q . '%')->latest()->with('country')->take(20)->get();
        }
        
        $data = [
            'users' => $users,
            'countries' => $countries,
            'posts' => $posts,
        ];

        return view('search.results', $data);
    }

    public function privacy(Request $request)
    {
        $activePage = 'privacy';
        view()->share('activePage', $activePage);
        $data = [
            'pageTitle' => 'Privacy policy',
            'mobileTitle' => 'Privacy policy',
            'pageDescription' => 'Read about Avanturistic\'s privacy regulations.',
        ];
        return view('shared.privacy', $data);
    }

    public function terms(Request $request)
    {
        $activePage = 'terms';
        view()->share('activePage', $activePage);
        $data = [
            'pageTitle' => 'Terms and Conditions',
            'mobileTitle' => 'T&C',
            'pageDescription' => 'Read about Avanturistic\'s terms of usage.',
        ];
        return view('shared.terms', $data);
    }

    public function country($slug, Request $request)
    {
        $activePage = 'countries';
        view()->share('activePage', $activePage);

        $mixScripts[] = '/dist/js/map/country-map.js';
        view()->share('mixScripts', $mixScripts);
        
        $scripts[] = '/js/libs/imagesLoader.min.js';
        $scripts[] = '/js/libs/masonry.min.js';
        view()->share('scripts', $scripts);

        $country = Country::where('slug', $slug)->first();
        if(!$country){
            $country =  Country::where('code2', strtoupper($slug))->orWhere('code3', strtoupper($slug))->firstOrFail();
            if($country){
                return redirect()->to('/country/'. $country->slug);
            }
        }
        $latestPost = Post::where('country_code', $country->code3)->latest()->orderBy('views', 'desc')->first();
        $bestPost = Post::where('country_code', $country->code3)->orderBy('likes', 'desc')->first();
        $data = [
            'hasCategoryFilter' => true,
            'country' => $country,
            'selectedCategory' => $request->session()->pull('selectedCategory'),
            'badges' => config('badges.list'),
            'pageTitle' => $country->title . ' map of outdoor adventures',
            'pageIcon' => url('/img/countries/svg/'.strtolower($country->code2).'.svg'),
            'mobileTitle' => $country->title,
            
            'pageImage' => url(isset($bestPost->image[0]['path']) ? $bestPost->image[0]['path'] : '/img/avanturistic.jpg'),
            'pageDescription' => 'Find best outdoor activities in ' . $country->title . ' and explore personal experiences from outdoor adventures in this country.'
        ];

        return view('public.country', $data);
    }

    public function countries()
    {
       /*  return redirect('/the-world-map-of-outdoor-adventures'); */
       $data = [
        'countries' =>  Country::whereHas('posts')->get(),
        'pageTitle' => 'Countries',
        'mobileTitle' => 'Countries'
       ];

       return view('public.countries',$data);
    }

    public function blog(Request $request)
    {
        $activePage = 'stories';
        view()->share('activePage', $activePage);
        $blog = Blog::orderBy('created_at', 'desc')->where('is_published', 1)->paginate(15);
        $data['blog'] = $blog;
        $data['pageTitle'] = 'A network for adventure. Outdoor adventures locations, photos and videos.';

        return view('public.blog', $data);
    }

   /*  public function popular(Request $request)
    {
        $activePage = 'popular';
        view()->share('activePage', $activePage);

        $scripts[] = '/dist/js/popular.js';
        view()->share('scripts', $scripts);
        $data['pageTitle'] = 'A network for adventure. Most popular adventures.';


        $data['top100'] = Post::orderBy('likes', 'desc')
            ->orderBy('visiteds', 'desc')
            ->where('likes', '>', 0)
            ->where('is_public', 1)
            ->with('user')
            ->take(50)
            ->get();

        return view('public.popular', $data);
    } */

    /* public function favorites(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }
        $activePage = 'favorites';
        view()->share('activePage', $activePage);

        $scripts[] = '/dist/js/favorites.js';
        view()->share('scripts', $scripts);


        $favorites = $this->user->favorites()->pluck('favorite_user_id')->toArray();

        $sql = 'SELECT name, id, name_slug, avatar FROM users';
        $sql .= '  WHERE  id IN (' . implode(',', $favorites) . ')';
        $sql .= '  ORDER BY created_at DESC';
        $sql .= '  LIMIT 12';


        try {
            $favorites = DB::select(DB::raw($sql));

        } catch (\Exception $exception) {

            $favorites = [];
        }
        $data['last_favorites'] = $favorites;
        return view('public.favorites', $data);
    } */

    /* public function allFavorites(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/');
        }


        $favorites = $this->user->favorites()->pluck('favorite_user_id')->toArray();

        $sql = 'SELECT name, id, name_slug, avatar FROM users';
        $sql .= '  WHERE  id IN (' . implode(',', $favorites) . ')';
        $sql .= '  ORDER BY name asc';


        try {
            $favorites = DB::select(DB::raw($sql));

        } catch (\Exception $exception) {

            $favorites = [];
        }
        $data['all_favorites'] = $favorites;
        return view('public.all_favorites', $data);
    } */

    public function myPosts(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $activePage = 'my-adventures';
        view()->share('activePage', $activePage);

        $mixScripts[] = '/dist/js/my_adventures.js';
        view()->share('mixScripts', $mixScripts);

        $posts = Post::where('user_id', $this->user->id)->orderBy('created_at', 'desc')->paginate(30);
        $data = [
            'posts' => $posts,
            'pageTitle' => 'My adventures',
            'mobileTitle' => 'My adventures',
            'pageDescription' => 'Manage your published outdoor adventures.',
        ];
        return view('public.my_adventures', $data);
    }

    public function map(Request $request)
    {
        $activePage = 'map';
        view()->share('activePage', $activePage);
        $countries = Country::whereHas('posts', function ($query) {
            $query->public();
        })->get();
        $data = [
           'countries' => $countries,
            'badges' => config('badges.list'),
            'pageTitle' => 'The world map of outdoor adventures',
            'mobileTitle' => 'The world map of outdoor adventures',
            'pageDescription' => 'Interactive map of outdoor adventures by outdoor enthusiasts worldwide. Discover your favorite outdoor activities locations near you.',
        ];

        $mixScripts[] = '/dist/js/map/map.js';
        view()->share('mixScripts', $mixScripts);
        return view('public.map', $data);
    }

    public function adventures(Request $request)
    {

       /*  if ($this->user) {
//              User
            if (!$this->user->location_updated_at || !$this->user->lat || !$this->user->lng) {
                $result = geoip($request->ip());
                if (isset($result['lat']) && isset($result['lon'])) {

                    $lat = $result['lat'];
                    $lng = $result['lon'];

                    $this->user->lat = $lat;
                    $this->user->lng = $lng;
                    $this->user->location_updated_at = Carbon::now();
                    $this->user->save();
                }
            }
            $lat = $this->user->lat;
            $lng = $this->user->lng;

        } else {
            $userLocation = session('user_location');
            if (isset($userLocation['lat']) && isset($userLocation['lng'])) {
                $lat = $userLocation['lat'];
                $lng = $userLocation['lng'];
            } else {
                $result = geoip($request->ip());
                if (isset($result['lat']) && isset($result['lon'])) {
                    $lat = $result['lat'];
                    $lng = $result['lon'];
                    $request->session()->put('user_location', ['lat' => $result['lat'], 'lng' => $result['lon']]);

                }
            }
        } */
      /*   if ($lat && $lng) {


        } */
        $data = [];
        $page = 1;
        if($request->has('page'))
            $page = $request->input('page');
            
        $ip = $request->getClientIp();
        $input = $request->input();
        $input['sort'] = 'date';
        $input['filters'] = [$request->session()->get('selectedCategory')];
       
        if(isset($input['filters']) && $input['filters'][0] == null)
            unset($input['filters']);
        
       
        $posts =  app('App\Http\Controllers\AjaxController')->getPostsByLocationDataInput($input, 4, $ip);
        $pagePrev = null;
        $pageNext = null;
        if(count($posts['posts']) == 0)
        abort(404);

        if($page > 1)
            $pagePrev = $page - 1;

        $pageNext = $page + 1;
        $data['more_posts'] = view('shared.more_posts', $posts);
        $data = array_merge($posts, $data);
  
        $data = array_merge($data, [
            'hasCategoryFilter' => true,
            'selectedCategory' => $request->session()->pull('selectedCategory'),
            'badges' => config('badges.list'),
            'pageLinkPrev' => $pagePrev ? url('/adventures?page='. $pagePrev) : null,
            'pageLinkNext' => $pageNext ? url('/adventures?page='. $pageNext) : null,
            'pageTitle' => 'Outdoor Adventures',
            'mobileTitle' => 'Outdoor Adventures',
            'pageDescription' => 'Explore through personal experiences of adventures from outdoor enthusiast worldwide and share your favorite spots.'
        ]);


        $activePage = 'adventures';
        view()->share('activePage', $activePage);

        $scripts[] = '/js/libs/imagesLoader.min.js';
        $scripts[] = '/js/libs/masonry.min.js';
        view()->share('scripts', $scripts);

        $mixScripts[] = '/dist/js/map/adventures.js';
        view()->share('mixScripts', $mixScripts);
        return view('public.adventures', $data);
    }

    public function unsubscribe(){
        return view('public.unsubscribe');
    }

    public function postUnsubscribe(Request $request){
        $email = $request->input('email');
        Log::info('unsubscribe email:'. $email);
        $user = User::where('email', $email)->first();
        if(!$user)
        return redirect()->back()->with('error', 'User with email address: '.$email . ' does not exist');

        $user->update([
            'newsletter' => false
        ]);
        if(Auth::user()){
            $redirect = 'profile';
        } else {
            $redirect = 'email-preferences';
        }
        return redirect('/'.$redirect)->with('success', 'You have succesfully updated your email preferences');
    }

    public function highlights(){
        $scripts[] =  '/dist/js/timelapses.js';
        view()->share('scripts', $scripts);
        $timelapses = Timelapse::public()->latest()->with('post')->take(30)->get();
        $timelapsesArray = [];
        foreach ($timelapses as $obj) {

          
            $likeExists = false;
            
            if($this->user){
                $likeExists = DB::table('timelapses_likes')->where('timelapse_id', $obj->id)->where('user_id', $this->user->id)->first();
                if($likeExists)
                    $likeExists = true;
            }
            $obj->likeExists = $likeExists;
            $timelapsesArray[] = $obj;
        }
        $data = [
            'timelapses' => $timelapsesArray
        ];
        return view('public.highlights', $data);
    }

    public function asnycSetTimeZone(Request $request){
        $request->session()->put('timezone', $request->input('timezone'));
    }
}
