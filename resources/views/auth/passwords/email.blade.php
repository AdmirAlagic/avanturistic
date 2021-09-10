@extends('layouts.auth')

@section('content')
    <div class="kt-visible-desktop" style="min-height: 40px;">

    </div>
    <div class="row">
        <div class="col-sm-4 offset-sm-4" style="min-height: 680px;padding:0;">
            <div class="container"  style=" ">
                <div class="text-center" style="position:relative;background: transparent; ">
                    <div class="kt-portlet kt-portlet--height-fluid" style="">
                        <div class="kt-portlet__head text-center" style="width:100%">
                            <div class="kt-portlet__head-label text-center" style="width:100%">
                                <h4 class="kt-portlet__head-title text-center" style="font-weight: bold;width:100%;color:#474747;">
                                    Reset Password
                                </h4>
                            </div>
                        </div>
                        <div class="kt-portlet__body" style="background: #FFFFFF;">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @include('shared.success_error')
                            {!! Form::open(['url' => route('password.email') , 'method' => 'POST', 'id' => 'kt_login_form', 'class' => 'kt-form', 'novalidate' => 'novalidate']) !!}
                            <div class="form-group">
                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            </div>


                            <!--begin::Action-->
                            <div class="kt-login__actions">

                                <button id="kt_login_signin_submit" class="btn btn-green" style="padding: 5px;-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important; width:100%;">
                                    <span class="text-white"><b>Send Password Reset Link</b></span></button>

                                <br><br>
                                <p>Back to <a href="/login">Login</a></p>
                            </div>
                            <br>
                            <p>If you are not receiving password reset email, contact us at <a href="mailto:info@avanturistic.com">info@avanturistic.com</a> and we will help you.</p>
                            <!--end::Action-->
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
