<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Events\ActivityCreated;
use App\Http\Requests\CommentRequest;

use App\Repositories\Timelapse\TimelapseService;
use App\Post;
use App\PostLike;
use App\PostVisited;
use App\Timelapse;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use DB;
use Log;
use File;
use Auth;
use Str;
use App\Repositories\Notifications\NotificationRepository;
use App\Notification;
use App\Http\Controllers\AppController;
 
 
class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
      

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->user){
            return redirect()->to('/sign-up');
        }
        $activePage = 'share';
        view()->share('activePage', $activePage);

        $scripts[] = '/js/libs/ckeditor/ckeditor.js';
        $scripts[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.js';
        $scripts[] =  '/dist/metronic/assets/js/pages/custom/wizard/wizard-1.js';

        $mixScripts[] = '/dist/js/create-post.js';
        $mixScripts[] = '/dist/js/posts.js';

        $styles[] = '/dist/css/share.css';
        $styles[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.css';

        view()->share('mixScripts', $mixScripts);
        view()->share('scripts', $scripts);
        view()->share('styles', $styles);
//        view()->share('styles', $styles);


        $data['disableFooter'] = true;
        $data['disableHeader'] = true;
        $data['model'] = new Post();
        $data['formOptions'] = ['method' => 'POST', 'route' => 'posts.store'];
        return view('posts.form', $data);
    }
    public function edit($id)
    {
        $scripts[] = '/js/libs/jquery-ui.min.js';
        $scripts[] = '/js/libs/touchpunch.js';
        $scripts[] = '/js/libs/ckeditor/ckeditor.js';
        $scripts[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.js';
        $scripts[] = '/js/libs/spotlight/spotlight.min.js';

        $styles[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.css';
        $styles[] = '/js/libs/spotlight/css/spotlight.css';
        $styles[] = '/dist/css/share.css';

        $mixScripts[] = '/dist/js/edit-post.js';
        $mixScripts[] = '/dist/js/posts.js';

        view()->share('mixScripts', $mixScripts);
        view()->share('scripts', $scripts);
        view()->share('styles', $styles);
        
        if(!Auth::check()){
            return redirect()->to('/login');
        }
        $post = $this->user->posts()->where('id', $id)->firstOrFail();
        if($post->user_id != $this->user->id){
            Log::warning( request()->ip(). ' tried to edit someone elses post ID: '.$id);
            return redirect('/login');
        }

        view()->share('scripts', $scripts);
        view()->share('styles', $styles);
        $data['post'] = $post;
        $data['formOptions'] = ['method' => 'PATCH', 'route' => ['posts.update', $id]];

        $data = [
            'post' => $post,
            'formOptions' => ['method' => 'PATCH', 'route' => ['posts.update', $id]],
            'pageTitle' => 'Edit adventure',
            'mobileTitle' => 'Edit adventure',
        ];
        return view('posts.edit', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        if(!$this->user){
            redirect('/');
        }
        $input = $request->input();
        // Upload attachments
        if ($request->has('image')) {
            foreach($request->input('image') as $obj){
                $images[] = json_decode($obj);
            }

            $input['image'] = $images;

        }

        if (isset($input['map_options']['route']) )  {
            $route = json_decode($input['map_options']['route']);
            $input['map_options']['route'] = $route;
            if($route && is_array($route) && count($route))
                $input['has_route'] = true;

        }

        $input['slug'] = Str::slug($input['title']);
        $input['user_id'] = $this->user->id;

        $post = Post::create($input);

        if($input['country_code'])
            $options = $this->user->options;

            if(!isset($options['visited_countries']) || !in_array($input['country_code'], $options['visited_countries']))
                $options['visited_countries'][] = $input['country_code'];
            
            $this->user->options = $options;
            $this->user->save();

        return redirect('/adventure/'. $post->id . '/'. $post->slug);
    }

    public function update(Request $request, $id){

        $post = Post::findOrFail($id);
        $input = $request->input();
        $input['slug'] = Str::slug($input['title']);
 
        if($post->user_id != $this->user->id){
            Log::warning($this->user->email . ' tried to edit someone elses post ID: '.$id);
            return redirect('/');
        }

//        $images = $post->image;
        $imagesArray = [];
        if ($request->has('image')) {
             foreach($request->image as $image){
                if(is_array($image)){
                    $imagesArray[] =  $image;
                } else{
                    $imagesArray[] =  json_decode($image);
                }
             }
             $input['image'] = $imagesArray;

        }

        if (isset($input['map_options']['route']) && $input['map_options']['route'] && $input['map_options']['route'] != '' )  {

            $route = json_decode($input['map_options']['route']);
            
            $input['map_options']['route'] = $route;
            if($route && is_array($route) && count($route)){
                $input['has_route'] = true;
            } else {
                $input['has_route'] = false;
            }
               

        } else {
            $input['map_options']['route'] = isset($post->map_options['route']) ?  $post->map_options['route'] : null;
        }

        $post->update($input);

        return redirect('/adventure/'. $post->id . '/'. $post->slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug = null, Request $request)
    {

        $mixScripts[] = '/dist/js/post.js';
        $scripts[] = '/js/libs/spotlight/spotlight.min.js';
        view()->share('scripts', $scripts);
        view()->share('mixScripts', $mixScripts);

      
        $post = Post::findOrFail($id);
        $sessionPostId  = session('post_id_'.$id);
        $mainActivity = null;
        $sort = 'date';
        $keywords = [];
        $postLikeExists = false;
        $postVisitedsExists = false;
        $pageTitle = '';
        $pageDescription = null;
        $badges = config('badges.list');
        $country = null; $countryFlag = false;
        if(!$sessionPostId){
            $post->update([
                'views' => $post->views + 1
            ]);
            session(['post_id_'. $id => $id]);
            
        }
       
        if($request->filled('s')){
            $sort = $request->input('s');
            session('sort', $sort);
        } else {
            $sort = session()->pull('sort', 'date');
        }
        if($request->filled('a')){
            $mainActivity = $request->input('a');
            session(['selectedCategory' => $mainActivity ]);
            
        } 
       
        if($this->user){
            $postLikeExists = DB::table('post_likes')->where('user_id' , $this->user->id)->where('post_id', $post->id)->first();
            $postVisitedsExists = DB::table('post_visiteds')->where('user_id' , $this->user->id)->where('post_id', $post->id)->first();
        }

       
        $country = $post->country ? $post->country->title : null;

        $badgesStr = '';
        if($post->options && count($post->options['badges']))
        {

            foreach($post->options['badges'] as $key => $val){

                if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name'])){
                    $name = strtolower($badges[$key]['name']);
                    $badgesStr .= $name . ', ';
                    $keywords[] =  implode(',', $badges[$key]['keywords']);
                    $keywords[] = $name;
                    $keywords[] = $name  . ' near me';
                    if($post->address){
                       
                        $keywords[] = $post->address . ' '. $name;
                    }

                }

            }
        }
        $badgesStr = ucfirst(rtrim($badgesStr,', '));

        if($post->title){
            $pageTitle =  $post->title;
            $keywords[] = html_entity_decode(strip_tags($pageTitle), ENT_QUOTES, 'UTF-8');
        } else {

            $pageTitle =   ($post->address  ? ($post->address . ', ') : '') . ($country ?  $country : '');

        }

        
        if($post->address){
            $keywords[] = $post->address;
        }
        

        
       
        if($post->address){
            $keywords[] = 'Things to do in '. $post->address . '?';
        }


        $keywords[] = $post->address . ' '. $country;
        $keywords[] = 'What to visit in '. $country . '?';
        $keywords[] = 'Outdoor activities in '. $country . '?';
        $keywords[] = 'Things to do in '. $country . '?';
        $keywords[] = 'Adventures near me';

        if($post->description){
            $pageDescription =  ($badgesStr != '' ?  $badgesStr  . ' ' : 'Outdoor') . ' adventure by '. $post->user->name. '. '. ($post->address  ? ('Location: ' .$post->address . ', ') : '') . ($country ?  $country : '').'. ';
            $pageDescription .= strip_tags(Str::words($post->description, 29, ''));

            rtrim($pageDescription, ',');
        } else {
            /* if($post->address){
                $pageDescription .= $post->address .' '.  $badgesStr . ' adventure with photos ';
                if($post->video)
                    $pageDescription .= ',video ';
                $pageDescription .= 'and location by '. $post->user->name. '. ';
            } else {

            } */
            $pageDescription =  ($badgesStr != '' ?  $badgesStr  : 'Outdoor') . ' adventure with photos '. ($post->video ? ' & video ': '')  .'by '. $post->user->name. '. '. ($post->address  ? ('Location: ' .$post->address . ', ') : '') . ($country ?  $country : '') ;

        }
       
        
        
        $pageDescription = str_replace(['nbsp;'], '' , Str::limit($pageDescription, 160));
        $lat = $post->lat;
        $lng = $post->lng;
    
       // Next Post date/distance 
        $nextPostId = null;
        if(!$request->filled('next')){
            $request->session()->forget('seen_posts_'.$sort);
        }
        $sql = 'SELECT id,slug, title, address, image,options,(
            (
                (
                    acos(
                        sin(( '.$lat.' * pi() / 180))
                        *
                        sin(( lat * pi() / 180)) + cos(( '.$lat.' * pi() /180 ))
                        *
                        cos(( lat * pi() / 180)) * cos((( '. $lng.' - lng) * pi()/180)))
                ) * 180/pi()
            ) * 60 * 1.1515 * 1.609344
        ) AS distance 
        FROM posts';
            
        $sql .= ' where deleted_at IS NULL AND is_public = 1 AND lat is NOT NULL and lng is not null'; 
        if($mainActivity)
            $sql .= " AND posts.options LIKE '%". $mainActivity . "%' ";
        $sql .= ' ORDER BY distance ASC';
        $nearByPosts = DB::select( DB::raw($sql));
        $ids = array();
        $request->session()->push('seen_posts_'.$sort, $id);
        $seenPostsSession = $request->session()->get('seen_posts_'.$sort);
 
        /* if(!$seenPostsSession){
            $seenPostsSession = [$id];
        }
        
        */
        
        if($sort == 'distance'){
            foreach($nearByPosts as $obj){

                if((!$seenPostsSession || !in_array($obj->id, $seenPostsSession)) && $id != $obj->id ){
    
                    $ids[$obj->id] = $obj->distance;
                }
    
            }
           
            $nextPostId = array_key_first($ids);
             
            
        } 
        if($sort == 'date') {
            $sqlNext = 'SELECT id FROM posts where deleted_at IS NULL AND is_public = 1';
          
            if(count($seenPostsSession)){
               
                $sqlNext .= ' AND id NOT IN ('. implode(', ',$seenPostsSession) .') ';
            }
            if($mainActivity)
                $sqlNext .= " AND options LIKE '%". $mainActivity . "%' ";
            $sqlNext .= ' ORDER BY created_at DESC LIMIT 1';
                
            $nextPostArray = DB::select( DB::raw($sqlNext));
            
            if(isset($nextPostArray[0])){
                $nextPostId =  $nextPostArray[0]->id;  
            }
        }
        if($sort == 'u') {
            
            $sqlNext = 'SELECT id FROM posts where deleted_at  IS NULL AND user_id = '.$post->user_id;
            if(count($seenPostsSession)){
                $sqlNext .= ' AND id NOT IN ('. implode(', ',$seenPostsSession) .') ';
            } 
            $sqlNext .= ' ORDER BY created_at DESC LIMIT 1';
                
            $nextPostArray = DB::select( DB::raw($sqlNext));
          
            if(isset($nextPostArray[0])){
                $nextPostId =  $nextPostArray[0]->id;  
            }
        }
        
        if($sort == 'c') {
            
            $sqlNext = 'SELECT id FROM posts where deleted_at  IS NULL AND is_public = 1 AND country_code = "'.$post->country_code.'"';
            if(count($seenPostsSession)){
                $sqlNext .= ' AND id NOT IN ('. implode(', ',$seenPostsSession) .') ';
            } 
            $sqlNext .= ' ORDER BY created_at ASC LIMIT 1';
                
            $nextPostArray = DB::select( DB::raw($sqlNext));
          
            if(isset($nextPostArray[0])){
                $nextPostId =  $nextPostArray[0]->id;  
            }
        }

        // Next Post date/distance END

        if($nextPostId)
            $nextPost =  Post::find($nextPostId); 

        if(isset($nextPost) && $nextPost)
            $nextPostId = $nextPost->id;

        if(!$nextPostId){

                if(isset($seenPostsSession[0]))
                    $nextPostId = $seenPostsSession[0] ;
                $request->session()->forget('seen_posts_'.$sort);
                $nextPost = Post::find($nextPostId);

        }
        
        $nextPostUrl  = '/';
        if(isset($nextPost) && $nextPost){
            $nextPostUrl = '/adventure/'.  $nextPost->id. '/'. $nextPost->slug .'?next=1&s='.$sort;
                if(isset($mainActivity) && $mainActivity)
                    $nextPostUrl .= '&a='. $mainActivity;
           
        }
       
 
        $translatableText = '';
        if($post->description)
            $translatableText .= strip_tags(html_entity_decode(str_replace(['/', '-',], '', str_replace('&nbsp;', ' ', $post->description))));

        $nearbyCollection = count($nearByPosts) ? collect($nearByPosts)->skip(1)->chunk(12) : [];
        if(isset($nearbyCollection[0])){
            $nearbyCollection = $nearbyCollection[0];
        }
        $data = [
            'post' => $post,
            'sort' => $sort,
            'nextTxt' => $sort == 'date' ? 'next' : 'nearest',
            'nextPost' => $nextPost,
            'nextPostUrl' => $nextPostUrl,
            'mainActivity' =>  str_replace('-',' ', $mainActivity),
            'comments' => $post->comments()->approved()->orderBy('created_at', 'asc')->paginate(20),
            'pageTitle' => $pageTitle,
            'mobileTitle' =>  $post->title,
            'pageImage' => url(isset($post->image[0]['path']) ? $post->image[0]['path'] : '/img/avanturistic.jpg'),
            'pageDescription' => $pageDescription,
            'country' => $country,
            'countryFlag' => $countryFlag,
            'alreadyVisited' => $postVisitedsExists ? true : false,
            'alreadyLiked' => $postLikeExists ? true : false,
            'translatableText' => $translatableText,
            'nearbyPosts' => $nearbyCollection,
            'keywords'  => implode(',', $keywords)

        ];

        $meta = [
            'og:image' => url(isset($post->image[0]['path']) ? $post->image[0]['path'] : ''),
            'og:title' => $pageTitle,
            'og:description' => strip_tags($pageDescription),
        ];
        view()->share('meta', $meta);

        return view('posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $imagePath = isset($post->image['path']) ? $post->image['path'] : null;
        $thumbPath = isset($post->image['thumb_path']) ? $post->image['thumb_path'] : null;
        if($imagePath && File::exists(public_path(). $imagePath)){
            File::delete(public_path(). $imagePath);
        }
        if($thumbPath && File::exists(public_path(). $thumbPath)){
            File::delete(public_path(). $thumbPath);
        }

        $post->delete();
        return redirect('/my-adventures')->with('success', 'Adventure successfully deleted.');

    }
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        
        $comment->delete();
        return redirect('/adventure/'.$post->id. '/'. $post->slug);

    }
    public function getPosts(Request $request)
    {
        $user_id = $request->input('user_id');
        $input  =  $request->input();

        if($request->has('lat') && $request->has('lng')){


            $sql = 'SELECT id, title, slug, lat, lng, options, image,( 6371.392896  * acos( cos( radians('.$input['lat'].') ) * cos( radians( lat ) ) 
            * cos( radians( lng ) - radians('.$input['lng'].') ) + sin( radians('.$input['lat'].') ) * sin(radians(lat)) ) ) AS distance 
            FROM posts';

            $sql .= ' HAVING distance < '. $input['radius'] . ' ORDER BY distance LIMIT 150';
            $sql .= ' WHERE posts.deleted_at IS NULL AND options IS NOT NULL AND is_public = 1 and show_on_map = 1';
            if(isset($input['country_code'])){

                $sql .= ' AND  posts.country_code = "'.$input['country_code'].'" ';
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
            $result = DB::select( DB::raw($sql));


            $posts = $result;

        } else{

            if($user_id){
                $sql = 'SELECT id, title, slug, lat, lng, image, options, likes FROM posts';
                $sql .= ' WHERE user_id="'.$user_id.'" AND  posts.deleted_at IS NULL';
                $sql .= ' ORDER BY likes DESC, likes DESC LIMIT 150';
            } else {
                $sql = 'SELECT id, title, slug, lat, lng, image, options, likes FROM posts';

                $sql .= ' WHERE is_public = 1 AND  posts.deleted_at IS NULL';
                if(isset($input['country_code'])){

                    $sql .= ' AND posts.country_code = "'.$input['country_code'].'" ';
                } else{
                    $sql .= ' AND show_on_map = 1 ';
                    $sql .= ' AND options IS NOT NULL';
                }
                if(isset($input['filters']) && count($input['filters'])){
                    $badges = $input['filters'];
                    $count = 0;
                    foreach($badges as $key => $val){
                        if($count == 0)
                        {
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

                $sql .= ' ORDER BY created_at DESC, likes DESC LIMIT 150';
            }
//            return $sql;



            $result = DB::select( DB::raw($sql));
            $posts = $result;
        }


        return response()->json(['posts' => $posts , 'badges' => config('badges.list')]);

    }



    public function getPost(Request $request)
    {
        return Post::firstOrFail($request->input('post_id'));
    }

    //ovaj custom request CommentRequest sluzi samo za validaciju ima li body
    public function comment(CommentRequest $request){
        $input = $request->input();
        if($this->user){
            $input['user_id'] = $this->user->id;
            $input['approved'] = true;
        } else {
            Log::info('Guest comment from IP:'. $request->ip(), ['input' => $request->input()]);
        }

        $post = Post::find($input['post_id']);
        $input['post_user_id'] = $post->user_id;

        $comment = Comment::create($input);
        if($this->user && $post->user_id !=  $this->user->id){
            $url = '/adventure/'. $post->id .'/'.$post->slug;
            NotificationRepository::newNotification($post->user_id, Notification::$_TYPE_COMMENT, $url , $this->user ? $this->user->id : null, null, isset($post->image[0]['thumb_path']) ? $post->image[0]['thumb_path'] : null);
            event(new ActivityCreated($this->user->name, $post->user_id, 'comment', url($url)));
        }
      

//        $userName = $this->user ? $this->user->name : $input['name'];


        $post->update(['comments_count' => $post->comments_count + 1]);
        if($this->user){
            return view('shared.single_comment', ['obj' => $comment, 'post' => $post]);
        } else {
            return view('shared.guest_comment_msg', ['obj' => $comment, 'post' => $post]);
        }

    }
    public function like(Request $request){
        $input = $request->input();
        if(!$this->user){
            return response('login',200);
        }

        $post = Post::findOrFail($input['post_id']);
        $postLikeExists = PostLike::where('user_id' , $this->user->id)->where('post_id', $input['post_id'])->first();

        $likeInc = 1;
        if($postLikeExists){

            $likeInc = -1;
            $postLikeExists->delete();

        } else {
            $postLike = PostLike::create(['user_id' => $this->user->id, 'post_id' => $input['post_id'],'post_user_id' => $post->user_id]);
            if($this->user && $post->user_id !=  $this->user->id){
                $url = '/adventure/'. $post->id .'/'.$post->slug;
                NotificationRepository::newNotification($post->user_id, Notification::$_TYPE_LIKE, $url, $this->user->id, null, isset($post->image[0]['thumb_path']) ? $post->image[0]['thumb_path'] : null);
    
                event(new ActivityCreated($this->user->name, $post->user_id, 'like', url($url)));
            }
          
        }

        $post->update(['likes' => $post->likes + $likeInc]);


        return response()->json($post->likes);
    }
    public function visited(Request $request){
        $input = $request->input();
        if(!$this->user){
            return response('login',200);
        }

        $post = Post::findOrFail($input['post_id']);
        $postVisitedExists = PostVisited::where('user_id' , $this->user->id)->where('post_id', $input['post_id'])->first();

        $visitedInc = 1;
        if($postVisitedExists){
            $postVisitedExists->delete();
            $visitedInc = -1;
        } else {
            $postVisited = PostVisited::create(['user_id' => $this->user->id, 'post_id' => $input['post_id'], 'post_user_id' => $post->user_id]);
             if($this->user && $post->user_id !=  $this->user->id){
                $url = '/adventure/'. $post->id .'/'.$post->slug;
                NotificationRepository::newNotification($post->user_id, Notification::$_TYPE_VISITED, $url , $this->user->id, null, isset($post->image[0]['thumb_path']) ? $post->image[0]['thumb_path'] : null);
                event(new ActivityCreated($this->user->name, $post->user_id, 'visited', url($url)));
            }
          
        }


        $post->update(['visiteds' => $post->visiteds + $visitedInc]);

        //da mu odmah vratim uvećano, da ne moram računati u js
        return response()->json($post->visiteds);
    }
    public function report($id){

        if(!$this->user){
            return response('login',404);
        }

        $post = Post::findOrFail($id);
        $whoReported  = $post->reported_users_ids;
        if(!$whoReported || !is_array($whoReported)){
            $whoReported = [$this->user->id];
        } else {
            $whoReported[] = [$this->user->id];
        }
        $post->update(['dislikes' => $post->dislikes + 1 , 'reported_users_ids' => $whoReported ]);
        Log::warning('User '. $this->user->email . ' reported post ID:'. $id);
        return back()->with('success', 'This photo has been reported. We will look into it. Thank you.');
    }

    public function DECtoDMS($latitude, $longitude)
    {
        $latitudeDirection = $latitude < 0 ? 'S': 'N';
        $longitudeDirection = $longitude < 0 ? 'W': 'E';

        $latitudeNotation = $latitude < 0 ? '-': '';
        $longitudeNotation = $longitude < 0 ? '-': '';

        $latitudeInDegrees = floor(abs($latitude));
        $longitudeInDegrees = floor(abs($longitude));

        $latitudeDecimal = abs($latitude)-$latitudeInDegrees;
        $longitudeDecimal = abs($longitude)-$longitudeInDegrees;

        $_precision = 3;
        $latitudeMinutes = round($latitudeDecimal*60,$_precision);
        $longitudeMinutes = round($longitudeDecimal*60,$_precision);

        return sprintf('%s%s° %s %s %s%s° %s %s',
            $latitudeNotation,
            $latitudeInDegrees,
            $latitudeMinutes,
            $latitudeDirection,
            $longitudeNotation,
            $longitudeInDegrees,
            $longitudeMinutes,
            $longitudeDirection
        );

    }
    public function nextPost(Request $request, $id){

        $post = Post::findOrFail($id);
        $lat = $post->lat;
        $lng = $post->lng;

       /*  $sql = 'SELECT id,( 6371.392896  * acos( cos( radians('.$lat.') ) * cos( radians( lat ) ) 
            * cos( radians( lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin(radians(lat)) ) ) AS distance 
            FROM posts'; */
        $sql = 'SELECT id,(
            (
                (
                    acos(
                        sin(( '.$lat.' * pi() / 180))
                        *
                        sin(( lat * pi() / 180)) + cos(( '.$lat.' * pi() /180 ))
                        *
                        cos(( lat * pi() / 180)) * cos((( '. $lng.' - lng) * pi()/180)))
                ) * 180/pi()
            ) * 60 * 1.1515 * 1.609344
        ) AS distance 
        FROM posts';
            
        $sql .= ' where deleted_at IS NULL  ORDER BY distance ASC';
        $result = DB::select( DB::raw($sql));
        $ids = array();

        $seenPostsSession = $request->session()->get('seen_posts');
 
        if(!$seenPostsSession){
            $seenPostsSession = array();
        }

        foreach($result as $obj){

            if((!$seenPostsSession || !in_array($obj->id, $seenPostsSession)) && $id != $obj->id ){

                $ids[$obj->id] = $obj->distance;
            }

        }


        $request->session()->push('seen_posts', $id);


        $nextPost = array_key_first($ids);

        if($nextPost)
        {
            $post =  Post::find($nextPost);
            if($post)
            $nextPost = $post->id;

        }

        if(!$nextPost){

                if(isset($seenPostsSession[0]))
                $nextPost = $seenPostsSession[0] ;
            $request->session()->forget('seen_posts');

        }
        if(!$nextPost){

            return redirect()->to('/');
        }
        return redirect()->to('/adventure/'. $nextPost);

    }
    
    public function createTimelapse($id){
       /*  $post = $this->user->posts()->where('id', $id)->firstOrFail(); */
        $post = Post::find($id);

        if($post->timelapse){
            $timelapse = public_path($post->timelapse->path);
        } else {
            $response = TimelapseService::generateTimelapseForPost($post);
            if($response->errors)
                return view('errors.custom', ['message' => 'Failed to generate timelapse']);
            $timelapse = $response->data['timelapse'];
        }
        
      
        return response()->download($timelapse);
    }
 
}
