@extends('layouts.app')

@section('content')
    <div class="kt-hidden-tablet-and-mobile" style="min-height: 40px;">

    </div>
    <div class="row" >
        <div class="col-sm-4 offset-sm-4" style="min-height: 680px;padding:0;">
        <div class="container" style="min-height:720px;">
                <div class="text-center" style="position:relative;background: transparent; ">
                    <div class="kt-portlet kt-portlet--height-fluid" style="">
                        <div class="kt-portlet__head text-center" style="width:100%">
                            <div class="kt-portlet__head-label text-center" style="width:100%">
                                <h2 class="kt-portlet__head-title text-center" style="width:100%;color:#474747;">
                                    Welcome aboard!
                                </h2>
                                
                            </div>
                        </div>
                        <div class="kt-portlet__body" style="background: #FFFFFF;padding-top:10px;">
                            
                            
                           
                           
                            @include('shared.success_error')
                            <p class="text-center " >
                                <b>Create your account</b>
                            </p>
                            {!! Form::open(['url' => 'register', 'method' => 'POST', 'class' => 'kt-form', 'novalidate' => 'novalidate', 'style' => 'padding:15px;padding-top:0;padding-bottom:5px;']) !!}
                            <div class="row class-text-center">
                                <div class="col-12 ">

                                    <!--begin::Form-->
                                    <div class="form-group">
                                        {!! Form::text('email', null, ['class' => 'auth-input form-control', 'placeholder' => 'Email', ]) !!}
                                    </div>
                                    <div class="form-group" style="margin-bottom:1rem;">
                                        {!! Form::text('name', null, ['class' => 'auth-input form-control', 'placeholder' => 'Profile name', ]) !!}
                                    </div>
                                    <div class="form-group" >
                                        {!! Form::password('password', ['class' => 'auth-input form-control', 'placeholder' => 'Password', 'id' => 'password', ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::password('password_confirmation', ['class' => 'auth-input form-control', 'placeholder' => 'Confirm Password', ]) !!}
                                    </div>



                                </div>
                               
                            </div>

                            <button id="kt_login_signin_submit" class="btn btn-green" style="padding: 5px;-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important; width:100%;height:35px;">
                                <span class="text-white"><b>Sign Up</b></span>
                            </button>

                            <br>

                            {!! Form::close() !!}
                            <br>
                            <div class="kt-login__divider mt-10">
                                <div class="kt-divider kt-auth-divider">
                                    <span></span>
                                    <span style="color:#999;"><b>OR</b></span>
                                    <span></span>
                                </div>
                            </div>
                            <br>
                            <p class="font-light ,">Continue with</p>

                            @include('shared.fb_google_signup')
                          
                             
                            <p class="mt-10 mb-10 text-gray" style="line-height:1rem; font-weight:300; ">
                                <small> By signing up, you agree to our  
                                    <a class="text-muted" href="/terms-and-conditions">terms</a> &
                                    <a class="text-muted" href="/privacy-policy">privacy policy</a>.</small>
                            </p>
 
                           
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--height-fluid" style="">
                        <div class="kt-portlet__head text-center" style="width:100%">
                            <div class="kt-portlet__head-label text-center" style="width:100%">
                                <h4 class="kt-portlet__head-title text-center" style="width:100%;color:#474747;">
                                   Already have an account?
                                    <a class="text-success" href="/login" >
                                        <b> Log In </b>
                                    </a>
                                </h4>

                            </div>
                        </div>

                    </div>
                    @if($isMobile && !$isWebView)
                    <div class="kt-portlet kt-portlet--height-fluid" style="">
                        <div class="kt-portlet__body" style="">
                           <small>Download app</small> <br>
                            <a href="https://play.google.com/store/apps/details?id=com.omnitask.avanturistic">
                                <img src="/img/google-play.jpg" style="width:131px;" alt="">
                            </a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

@endsection
