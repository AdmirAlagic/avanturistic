<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\User;
use App\UserRank;
use App\Events\FCMCreated;
use Illuminate\Http\Request;
use Auth;

class AdminUsersController extends AdminController
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
        view()->share('active', ['0' => 'users']);
        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        $breadcrumbs[] = ['text' => __('Users')];
        view()->share('breadcrumbs', $breadcrumbs);

        $data['users'] = User::withTrashed()->orderBy('last_login_at', 'desc')->paginate(100);
        return view('admin.users.index', $data);
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
        view()->share('active', ['0' => 'users']);

        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        $breadcrumbs[] = ['text' => __('Users')];
        $breadcrumbs[] = ['text' => __('Show')];
        view()->share('breadcrumbs', $breadcrumbs);

        $data['user'] = User::findOrFail($id);
        $data['userRanks'] = $data['user']->ranks()->get();

        return view('admin.users.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      /*   view()->share('active', ['0' => 'users']);

        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        $breadcrumbs[] = ['text' => __('Users')];
        $breadcrumbs[] = ['text' => __('Edit')];
        view()->share('breadcrumbs', $breadcrumbs);

        $data['user'] = User::findOrFail($id);
        return view('admin.users.form', $data); */

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
      /*   $user = User::findOrFail($id);
        $input = $request->except('password', 'password_confirmation');

        if($request->has('password') && $request->filled('password')){
            $input['password'] = bcrypt($request['password']);
        }
        $user->update($input);
         
        return redirect()->back()->with('success', 'User updated successfully'); */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function loginAsUser($id){
        Auth::loginUsingId($id, true);
        return redirect('/');
    }

    public function fcmForm($id){
        $user = User::findOrFail($id);
        $data = [
            'formOptions' => ['method' => 'POST', 'route' => ['admin.fcm.send']],
            'user' => $user
        ];
        return view('admin.users.fcm_form', $data);
    }

    public function sendFcm(Request $request){
       
        $user = User::findOrFail($request->input('user_id'));
        $message = $request->input('message');
        event(new FCMCreated($user, $message));
        
        return redirect('/admin/users')->with('success', 'Notification sent to user '. $user->email .' device');
    }
}
