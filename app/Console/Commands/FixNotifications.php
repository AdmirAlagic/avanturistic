<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
use App\Notification;
use App\User;
use Storage;
use Str;
use File;
use App\Repositories\Notifications\NotificationRepository;
class FixNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fix:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes messages older than one month';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users =  User::chunk(50, function($users){
            foreach($users as $user){
                  //          Type  - Likes

                  $type = 'more_likes';
                  $sql = 'SELECT  seen, posts.id as post_id, posts.slug, users.id as user_id, users.name as username, users.name_slug as username_slug, users.avatar, posts.image, post_likes.created_at FROM post_likes';
                  $sql .= ' LEFT JOIN users ON users.id=post_likes.user_id';
                  $sql .= ' LEFT JOIN posts ON posts.id=post_likes.post_id';
                  $sql .= ' WHERE post_likes.post_user_id = '.$user->id;
                   
                  $sql .= ' AND post_likes.user_id  !='.$user->id;
                  $sql .= ' ORDER BY post_likes.created_at DESC';
  
                  try{
                      $activityLikes = DB::select(DB::raw($sql));
                  }
                  catch (\Exception $e){
                      $activityLikes = [];
                  }
  
  
  //          Type  - Visiteds
                  $type = 'more_activity';
                  $sql = 'SELECT seen, posts.id as post_id,posts.slug, users.id as user_id, users.name as username, users.name_slug as username_slug, users.avatar, posts.image, post_visiteds.created_at FROM post_visiteds';
                  $sql .= ' LEFT JOIN posts ON posts.id=post_visiteds.post_id';
                  $sql .= ' LEFT JOIN users ON users.id=post_visiteds.user_id';
                  $sql .= ' WHERE post_visiteds.post_user_id = '.$user->id;
                  $sql .= ' AND post_visiteds.user_id != '.$user->id;
                   
                  $sql .= ' ORDER BY post_visiteds.created_at DESC';
  
                  try{
                      $activityVisiteds = DB::select(DB::raw($sql));
  
                  } catch (\Exception $exception){
  
                      $activityVisiteds = [];
                  }
  //          Type  - Comments
                  $type = 'more_comments';
                  $sql = 'SELECT  seen, comments.post_id,posts.slug, users.id as user_id, users.name as username, users.name_slug as username_slug, users.avatar, posts.image, comments.created_at FROM comments';
                  $sql .= ' LEFT JOIN posts ON posts.id=comments.post_id';
                  $sql .= ' LEFT JOIN users ON users.id=comments.user_id';
                  $sql .= ' WHERE comments.post_user_id = '.$user->id;
                  $sql .= ' AND comments.user_id != '.$user->id;
                  $sql .= ' AND comments.approved = true';
  
                
  //                $sql .= ' AND comments.user_id  !='.$user->id;
                  $sql .= ' ORDER BY comments.created_at DESC';
  
                  try{
                      $activityComments = DB::select(DB::raw($sql));
  
                  } catch (\Exception $exception){
  
                      $activityComments = [];
                  }
  
                  $newNotifications['likes'] = $activityLikes;
                  $newNotifications['visiteds'] = $activityVisiteds;
                  $newNotifications['comments'] = $activityComments;
                  
                  foreach($newNotifications['likes'] as $likes){
                    $image = json_decode($likes->image); 
                    NotificationRepository::newNotification($user->id, Notification::$_TYPE_LIKE, '/adventure/'. $likes->post_id .'/'.$likes->slug, $likes->user_id, null, isset($image[0]->thumb_path) ? $image[0]->thumb_path : null, $likes->created_at, $likes->seen );
                }
                  foreach($newNotifications['visiteds'] as $visiteds){
                    $image = json_decode($visiteds->image); 
                    NotificationRepository::newNotification($user->id, Notification::$_TYPE_VISITED, '/adventure/'. $visiteds->post_id .'/'.$visiteds->slug, $visiteds->user_id, null, isset($image[0]->thumb_path) ? $image[0]->thumb_path : null, $visiteds->created_at, $visiteds->seen );
                }
                    foreach($newNotifications['comments'] as $comments){
                        $image = json_decode($comments->image); 
                        NotificationRepository::newNotification($user->id, Notification::$_TYPE_COMMENT, '/adventure/'. $comments->post_id .'/'.$comments->slug, $comments->user_id, null, isset($image[0]->thumb_path) ? $image[0]->thumb_path : null, $comments->created_at, $comments->seen );

                    }
  
            }
        });
        
    }
}
