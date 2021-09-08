<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Notification;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\Notifications\NotificationRepository;
use App\Events\FCMCreated;

class NotificationsController extends AdminController
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
        view()->share('active', ['0' => 'notifications']);

        $data['notifications'] = Notification::orderBy('created_at', 'desc')->groupBy('created_at')->byAdmin()->paginate(300);
        return view('admin.notifications.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['model'] = new Notification();
        $data['formOptions'] = ['route' => ['admin.notifications.store'], 'method' => 'POST'];
        $scripts[] = 'https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js';

        view()->share('scripts', $scripts);

        $mixScripts[] = '/dist/js/create-blog.js';
        view()->share('mixScripts', $mixScripts);
        return view('admin.notifications.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $generalNotificationHtml =  $request->input('content');
        if($request->input('type') == 'all'){
            $users = User::all();
        } else {
            $emails = explode(',', $request->input('emails'));
            $users = User::whereIn('email', $emails)->get();
        }
       
        foreach ($users as $user) {
            NotificationRepository::newNotification($user->id, Notification::$_TYPE_GENERAL, $request->input('url'), null, $generalNotificationHtml, url('/img/logo.svg'));
        }

        return redirect('/admin/notifications')->with('success', 'Notification sent to '.count($users) . ' users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        view()->share('active', ['0' => 'notifications']);

        $breadcrumbs[] = ['text' => __('general.admin_dashboard')];
        $breadcrumbs[] = ['text' => __('Notifications')];
        $breadcrumbs[] = ['text' => __('Show')];
        view()->share('breadcrumbs', $breadcrumbs);

        $data['notification'] = Notification::findOrFail($id);


        return view('admin.notifications.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $notification = Notification::findOrFail($id);
        $data['model'] = $notification;
        $data['formOptions'] = ['route' => ['admin.notifications.update', $notification->id], 'method' => 'PATCH'];
        return view('admin.notifications.form', $data);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->back()->with('success', 'Notification deleted successfully');
    }
}
