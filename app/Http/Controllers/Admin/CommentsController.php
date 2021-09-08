<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Events\ActivityCreated;
use App\Http\Controllers\AppController;
use App\Post;
use App\PostRank;
use Illuminate\Http\Request;
use App\Repositories\Notifications\NotificationRepository;
use App\Notification;

class CommentsController extends AdminController
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

        $data['comments'] = Comment::unapproved()->whereNotNull('email')->orderBy('created_at', 'desc')->paginate(50);
        return view('admin.comments.index', $data);
    }


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully');
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->update(['approved' => true]);

        if($comment->post){
            $post = $comment->post;
            
             NotificationRepository::newNotification($post->user_id, Notification::$_TYPE_COMMENT, '/adventure/'. $post->id .'/'.$post->slug, null, null, isset($post->image[0]['thumb_path']) ? $post->image[0]['thumb_path'] : null);

           /*  event(new ActivityCreated($userName, $comment->post->user_id, 'comment')); */
        }
//
        return redirect()->back()->with('success', 'Comment  successfully approved');
    }
}
