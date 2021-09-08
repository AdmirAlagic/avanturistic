<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Str;
use Log;
use DB;

class PostController extends Controller
{
    public function getPosts(Request $request){
        $error = null;
        $data = [];
        $email = $request->input('email');

        try{
            $ip = $request->getClientIp();
            $input = $request->input();
            $location = null;
            $user = User::where('email', $email)->firstOrFail();
            $radius = isset($input['radius']) ? $input['radius'] : 500;
            $sort = isset($input['sort']) ? $input['sort'] : 'latest_nearest';
            $page = isset($input['page']) ? $input['page'] : 1;
            $perPage =  10;
            $posts = [];

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
                        }
                    }
                }
            }

            if($lat && $lng){

                $sql = 'SELECT title, likes,visiteds,address,posts.lat, posts.lng, comments_count, image, posts.video,posts.country_code, posts.created_at, posts.options as opts, posts.id, users.name AS username, users.name_slug as username_slug,users.group, users.id as user_id, users.avatar, 
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

                if(isset($input['filters']) && count($input['filters'])){
                    $badges = $input['filters'];
                    $count = 0;

                    foreach($badges as $key => $val){
                        if($count == 0){
                            $sql .= " WHERE posts.options LIKE '%". $val . "%'";
                        } else {
                            $sql .= " OR posts.options LIKE '%". $val . "%'";
                        }
                        $count++;
                    }
                    $sql .= " AND posts.is_public = 1";
                } else {
                    $sql .= " WHERE posts.is_public = 1";

                }

                if($sort == 'latest_nearest')
                    $sql .= ' ORDER BY created_at DESC,distance ASC';

                if($sort == 'date')
                    $sql .= ' ORDER BY created_at DESC';

                if($sort == 'distance')
                    $sql .= ' ORDER BY distance ASC';


                $sql .= ' LIMIT '.$perPage;
                if($page > 1)
                    $sql .=  ' OFFSET '.($page -1) * $perPage;



                $posts = DB::select(DB::raw($sql));



            }

            $data['user'] = $user;

            $data['posts'] = $posts;
            $data['badges'] = config('badges.list');

        } catch (\Exception $e){
            $error = 'Failed to get posts:'.$e->getMessage();
        }

        return response()->json($error ? ['error' => $error] : $data, $error ? 400 : 200);
    }

    public function likePost(Request $request){}
    public function visitedPost(Request $request){}
    public function comment(Request $request){}
    public function report(Request $request){}
}
