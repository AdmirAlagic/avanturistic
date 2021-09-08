<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Post;
use App\Notification;
use App\PostRank;
use Illuminate\Http\Request;
use App\Repositories\Notifications\NotificationRepository;
use App\Events\FCMCreated;
use App\Repositories\Timelapse\TimelapseService;

class AdminPostsController extends AdminController
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
        view()->share('active', ['0' => 'posts']);

        $data['posts'] = Post::orderBy('created_at', 'desc')->paginate(100);
        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        view()->share('active', ['0' => 'posts']);

        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        $breadcrumbs[] = ['text' => __('Posts')];
        $breadcrumbs[] = ['text' => __('Show')];
        view()->share('breadcrumbs', $breadcrumbs);

        $data['post'] = Post::findOrFail($id);


        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $data['model'] = $post;
        return view('admin.posts.form', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->input();
        $post = Post::findOrFail($id);
        $post->update($input);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully');
    }

    public function markAsFeatured($id)
    {
        
        $post = Post::findOrFail($id);
        $post->update([
            'is_recommended' => true
        ]);

        $generalNotificationHtml =  '<p> <b>Congratulations!</b> <br> Your adventure is tagged as Avanturistic Pick. <br> Keep up the good work!</p>';
         
        $image = url('/img/star.svg');
        /* if(isset($post->image[0]['thumb_path']))
            $image = url($post->image[0]['thumb_path']); */
        NotificationRepository::newNotification($post->user_id, Notification::$_TYPE_GENERAL, url('/adventure/'. $post->id . '/'. $post->slug), null, $generalNotificationHtml, $image);
        $message = 'Congratulations! Your adventure';
        if($post->title )
            $message .= ' "'.$post->title.'"';
        $message .= ' is tagged as Avanturistic Pick.';
       
        event(new FCMCreated($post->user, $message));  

        if(count($post->image) > 2)
        TimelapseService::generateTimelapseForPost($post, true);

        return back()->with('success', 'Post ID:'. $post->id . ' successfully marked as starred');
    }
}
