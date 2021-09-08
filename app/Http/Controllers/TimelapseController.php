<?php

namespace App\Http\Controllers;

use App\Timelapse;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use File;
use App\TimelapseLike;
use App\Notification;
use App\Repositories\Notifications\NotificationRepository;
use App\Events\ActivityCreated;
use App\Http\Requests\StoreTimelapseRequest;
use App\Repositories\Timelapse\TimelapseService;
use App\Post;

class TimelapseController extends AppController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index(){

        $scripts[] =  '/dist/js/timelapses.js';
        view()->share('scripts', $scripts);

        $data = [
            'timelapses' => $this->user->timelapses()->custom()->orderBy('created_at', 'desc')->paginate(15)
        ];
        return view('timelapse.index', $data);
    }

    public function delete(Request $request){
        $timelapse = $this->user->timelapses()->findOrFail($request->input('timelapse_id'));
        $timelapse->delete();
        $path = public_path($timelapse->path);
        if(File::exists($path))
            File::delete($path);
        return response()->json('success');
    }

    public function like(Request $request){
        $input = $request->input();
        if(!$this->user){
            return response('login',200);
        }

        $timelapse = Timelapse::findOrFail($input['timelapse_id']);
        $timelapseLikeExists = TimelapseLike::where('user_id' , $this->user->id)->where('timelapse_id', $input['timelapse_id'])->first();

        $likeInc = 1;
        if($timelapseLikeExists){

            $likeInc = -1;
            $timelapseLikeExists->delete();

        } else {
            $timelapseLike = TimelapseLike::create(['user_id' => $this->user->id, 'timelapse_id' => $input['timelapse_id'],'timelapse_user_id' => $timelapse->user_id]);
            event(new ActivityCreated($this->user->name, $timelapse->user_id, 'timelapse_like'));
            NotificationRepository::newNotification($timelapse->user_id, Notification::$_TYPE_TIMELAPSE_LIKE, '/my-timelapses', $this->user->id, null, $timelapse->thumb_path ? $timelapse->thumb_path  : null);
        }

     /*    $timelapse->update(['likes' => count($timelapse->likes) + $likeInc]);
 */

        return response()->json(count($timelapse->likes));
    }

    public function create(){
        
        if(!$this->user)
            return redirect('/login');

        $mixScripts[] =  '/dist/js/timelapse.js';
        $scripts[] =  '/dist/metronic/assets/js/pages/custom/wizard/wizard-1.js';
        $scripts[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.js';

        $styles[] = '/dist/css/share.css';
        $styles[] = '/dist/css/timelapse.css';
        $styles[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.css';

        
        view()->share('scripts', $scripts);
        view()->share('styles', $styles);
        view()->share('mixScripts', $mixScripts);

        if($this->user->group == 'admin')
        {
            $posts = Post::where('is_public', true)->get();
        } else {
            $posts = $this->user->posts()->orderBy('created_at', 'desc')->get();
        }
     
        $paths = [];

        foreach($posts as $post){
            foreach($post->image as $img){
                $paths[] = $img;
            }
        }

        $data = [
             'paths' => $paths,
             'formOptions' =>  ['method' => 'POST', 'route' => 'timelapse.store']
         ];

       
         return view('timelapse.form', $data);
     }

     public function storeTimelapse(StoreTimelapseRequest $request){
        
        $paths = $request->input('paths');
        $audio = $request->input('audio');
        $title = $request->input('title');
        $isPublic = $request->input('is_public');
        $color = $request->input('color');
        $effect = $request->input('effect');

        $response = TimelapseService::createTimelapseFromPaths($this->user, $paths, $audio, $isPublic, $title, $color, $effect);
        if($response->errors)
            return view('errors.custom', ['message' => 'Failed to generate timelapse']);
       
        $data = [
            'timelapse' => $response->data['timelapse']
        ];
       
        return redirect('my-timelapses');
     }

     public function downloadTimelapse($id){
         if($this->user->group == 'admin')
         {
            $timelapse = Timelapse::findOrFail($id);
         } else {
            $timelapse = $this->user->timelapses()->findOrFail($id);
         }

      
         return response()->download(public_path($timelapse->path), 'Timelapse.mp4');
     }

     public function changeVisibility($id){
        $timelapse = $this->user->timelapses()->findOrFail($id);
        $timelapse->update([
            'is_public' => !$timelapse->is_public
        ]);
        return  redirect()->back();
      }


 

}
