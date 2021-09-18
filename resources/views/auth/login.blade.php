@extends('layouts.app')

@section('content')
    <div class="kt-hidden-tablet-and-mobile" style="min-height: 40px;">

    </div>
    <div class="kt-container">
        <div class="row">
            <div class="col-sm-4 offset-sm-4 " style="padding:0;">
            <div class="login-container" style="">
                    <div class="text-center" style="position:relative;background: transparent; ">
                        <div class="kt-portlet kt-portlet--height-fluid" style="">
                            <div class="kt-portlet__head text-center kt-hidden-tablet-and-mobile" style="width:100%">
                                <div class="kt-portlet__head-label text-center" style="width:100%">
                                    <h4 class="kt-portlet__head-title text-center" style="width:100%;color:#474747;">
                                        <b>Login</b>
                                    </h4>
                                </div>
                            </div>
                            <div class="kt-portlet__body" style="background: #FFFFFF;padding: 3em;;min-height: 550px;">
                                @include('shared.success_error')
    
                                {!! Form::open(['url' => 'login', 'method' => 'POST', 'id' => 'kt_login_form', 'class' => 'kt-form', 'novalidate' => 'novalidate']) !!}
                                <div class="form-group">
                                    {!! Form::text('email', null, ['class' => 'form-control auth-input', 'placeholder' => 'Email']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::password('password', ['class' => 'form-control auth-input', 'placeholder' => 'Password']) !!}
                                </div>
    
    
                                <button id="kt_login_signin_submit" class="btn btn-green " style="padding: 5px;-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important; width:100%;height:35px;"><span class="text-white font-boldest">Log In</span></button>
                                @if (Route::has('password.request'))
                                    <a class="btn text-gray" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                              

                                <div>
                                    <div class="kt-login__divider " style="margin-top:1rem;">
                                        <div class="kt-divider kt-auth-divider">
                                            <span></span>
                                            <span style="color:#999;"><b>OR</b></span>
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <p class="font-light">Continue with</p>
                                @include('shared.fb_google_signup')
                                
                                
    
                            <!--end::Action-->
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
