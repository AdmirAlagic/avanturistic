<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppController;
use App\Mail\CustomMail;
use App\Repositories\SendEmailRepository;
use Illuminate\Http\Request;
use App\User;
use Exception;
use Mail;
use Log;


class NewsletterController extends AdminController
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
        view()->share('active', ['0' => 'newsletter']);
 
        return view('admin.newsletter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        $data['formOptions'] = ['route' => ['admin.newsletter.store'], 'method' => 'POST'];
        $scripts[] = 'https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js';

        view()->share('scripts', $scripts);

        $mixScripts[] = '/dist/js/create-blog.js';
        view()->share('mixScripts', $mixScripts);
        return view('admin.newsletter.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request->input('content');
        $subject = $request->input('subject');
        $emails = [];
        if($request->input('type') == 'all'){
            $emails = User::where('group', 'user')->where('newsletter', true)->pluck('email');
        } else {
            $emails = explode(',', $request->input('emails'));
        }
        $emailService = new SendEmailRepository();
        
            foreach($emails as $email){
                try{
                    if($email != '' && $email != ' '){
                        $mailable = new \App\Mail\CustomMail($content, $subject);
                        $user = User::where('email', $email)->first();
                        if($user)
                        $emailService->sendEmailByMailable($user, $mailable, $user);
                    }
                  /*   \Mail::to($email)->send(new \App\Mail\CustomMail($content, $subject)); */
                } catch (Exception $e){
                    Log::info('Failed to send mail to '.$email .'Error: '.$e->getMessage());
                }
            }
         
       
        return redirect('/admin/newsletter')->with('success', 'Mail sent to '.count($emails) . ' address');
    }
 
}
