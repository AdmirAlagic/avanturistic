<?php

namespace App\Http\Controllers;


use App\Http\Requests\CommentRequest;
use App\Blog;
use App\BlogLike;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use DB;
use Log;
use File;
use Auth;
use Carbon\Carbon;
use Str;
use App\Comment;

class BlogController extends AppController
{

    protected $user;
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

        $blog = Blog::latest()->paginate(15);
        if(!$this->user)
            return redirect('/');

        $data['drafts'] = Blog::where('user_id', $this->user->id)->where('is_published', 0)->get();

        $data['blog'] = $blog;
        return view('blog.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->user){
            return redirect()->to('/')->with('success', 'Log in or create account to share experiences');
        }
        $styles[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.css';
        view()->share('styles', $styles);

        $scripts[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.js';
        $scripts[] = 'https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js';

        view()->share('scripts', $scripts);

        $mixScripts[] = '/dist/js/create-blog.js';
        view()->share('mixScripts', $mixScripts);
        $data['model'] = new Blog();
        $data['formOptions'] = ['method' => 'POST', 'route' => 'blog.store'];
        return view('blog.form', $data);
    }
    public function edit($id)
    {

        $styles[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.css';
        view()->share('styles', $styles);

        $scripts[] = '/dist/metronic/assets/plugins/dropzone/dropzone.min.js';
        $scripts[] = 'https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js';

        view()->share('scripts', $scripts);

        $mixScripts[] = '/dist/js/create-blog.js';
        view()->share('mixScripts', $mixScripts);

        $blog = Blog::findOrFail($id);
        Log::info('edit blog ip:'. request()->ip());
        if($blog->user_id != $this->user->id){
            Log::warning($this->user->email . ' tried to edit someone elses blog ID: '.$id);
            return redirect('/');
        }


        $data['model'] = $blog;
        $data['formOptions'] = ['method' => 'PATCH', 'route' => ['blog.update', $id]];
        return view('blog.edit', $data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogRequest $request)
    {
        if(!$this->user){
            redirect('/');
        }
        $input = $request->input();

        $input['slug'] = Str::slug($input['title']);

        $input['published_at'] = Carbon::now();

        if ($request->has('image')) {
            foreach($request->input('image') as $obj){
                $images[] = json_decode($obj);
            }

            $input['image'] = $images;

        }

        $input['user_id'] = $this->user->id;
        $blog = Blog::create($input);

        return redirect('/my-experiences/'. $blog->id.'/edit');
    }
    public function publish($id){
        $blog = Blog::findOrFail($id);
        if($blog->user_id != $this->user->id){
            Log::warning($this->user->email . ' tried to edit someone elses blog ID: '.$id);
            return redirect('/');
        }
        $blog->published_at = Carbon::now();
        $blog->is_published = 1;
        $blog->save();

        return redirect('/my-experiences/'. $blog->id.'/edit');
    }

    public function update(Request $request, $id){
        $blog = Blog::findOrFail($id);
        if($blog->user_id != $this->user->id){
            Log::warning($this->user->email . ' tried to edit someone elses blog ID: '.$id);
            return redirect('/');
        }

        $input = $request->input();
        if ($request->has('image')) {
            foreach($request->input('image') as $obj){
                $images[] = json_decode($obj);
            }

            $input['image'] = $images;

        }

        $input['slug'] = Str::slug($input['title']);
        $blog->update($input);

        return redirect('/my-experiences/'. $blog->id.'/edit');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $mixScripts[] = '/dist/js/show-blog.js';
        $scripts[] = '/js/libs/spotlight/spotlight.min.js';
        $styles[] = '/js/libs/spotlight/css/spotlight.css';
        view()->share('styles',$styles);
        view()->share('scripts', $scripts);
        view()->share('mixScripts', $mixScripts);

        $blog = Blog::where('slug', $slug)->firstOrFail();
        $sessionPostId  = session('blog_id_'.$blog->id);
        
        if(!$sessionPostId){
            $blog->update([
                'views' => $blog->views + 1
            ]);
            session(['blog_id_'. $blog->id => $blog->id]);
        }

        $title = $blog->title;
        $desc = $blog->description;
        $image =  url(isset($blog->image[0]['path']) ? $blog->image[0]['path'] : '/img/avanturistic.jpg');

        $meta['og:image'] = $image;
        $meta['og:title'] = $title;
        $meta['og:description'] = $desc;

        view()->share('meta', $meta);


        $latestAdventures = Post::where('is_public' , 1)->orderBy('created_at', 'desc')->with('country')->take(5)->get();

        $data = [
            'latestAdventures' => $latestAdventures,
            'otherBlog' => Blog::where('id', '!=', $blog->id)->published()->latest()->take(10)->get(),
            'comments' => $blog->comments()->approved()->orderBy('created_at', 'desc')->paginate(20),
            'blog' => $blog,
            'pageTitle' => $title,
            'pageDescription' => strip_tags($desc),
            'pageImage' => $image,

        ];

        return view('blog.show', $data);
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
        $blog = Blog::findOrFail($id);
        $imagePath = isset($blog->image['path']) ? $blog->image['path'] : null;
        $thumbPath = isset($blog->image['thumb_path']) ? $blog->image['thumb_path'] : null;
        if($imagePath && File::exists(public_path(). $imagePath)){
            File::delete(public_path(). $imagePath);
        }
        if($thumbPath && File::exists(public_path(). $thumbPath)){
            File::delete(public_path(). $thumbPath);
        }

        $blog->delete();
        return redirect('/my-experiences');

    }
    public function deleteComment($id)
    {
        $blog = Comment::findOrFail($id);
        $blog->delete();
        return back();

    }

    public function getBlog(Request $request)
    {
        return Blog::firstOrFail($request->input('blog_id'));
    }

    //ovaj custom request CommentRequest sluzi samo za validaciju ima li body
    public function comment(CommentRequest $request){
        $input = $request->input();
        if($this->user){
            $input['user_id'] = $this->user->id;
            $input['approved'] = true;
        }

        $blog = Blog::find($input['blog_id']);

        $comment = Comment::create($input);

//        $userName = $this->user ? $this->user->name : $input['name'];
//        event(new ActivityCreated($userName, $post->user_id, 'comment'));

        if($this->user){
            return view('shared.single_comment', ['obj' => $comment]);
        } else {
            return view('shared.guest_comment_msg', ['obj' => $comment]);
        }
    }
    public function like(Request $request){
        $input = $request->input();
        if(!$this->user){
            return response('error',404);
        }

        $blog = Blog::findOrFail($input['blog_id']);
        $blogLikeExists = BlogLike::where('user_id' , $this->user->id)->where('blog_id', $input['blog_id'])->first();
        $likeInc = 1;
        if($blogLikeExists){
            $likeInc = -1;
            $blogLikeExists->delete();

        } else {
            $blogLike = BlogLike::create(['user_id' => $this->user->id, 'blog_id' => $input['blog_id']]);
        }


        $blog->update(['likes' => $blog->likes + $likeInc ]);

        return response()->json(count($blog->likesModel));
    }
    
}
