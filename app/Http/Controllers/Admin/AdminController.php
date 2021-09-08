<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Comment;

class AdminController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();


            $unaprovedComments = Comment::unapproved()->whereNotNull('email')->orderBy('created_at', 'desc')->count();

            view()->share('user', $this->user);
            view()->share('unaprovedComments', $unaprovedComments);

            return $next($request);
        });


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        view()->share('active', ['0' => 'dashboard']);

        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        view()->share('breadcrumbs', $breadcrumbs);
        $data['users'] = DB::table('users')->orderBy('created_at', 'desc')->get();
        $data['posts'] = DB::table('posts')->orderBy('created_at', 'desc')->orderBy('dislikes', 'desc')->get();
        $supportUser = User::where('group', 'support')->first();
        $data['newMessagesForSupport'] = DB::table('messages')->where('seen', 0)->where('to_user_id', $supportUser->id)->count();
        return view('admin.dashboard.index', $data);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
