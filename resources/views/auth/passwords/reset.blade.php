@extends('layouts.app')

@section('content')
    <div class="kt-hidden-tablet-and-mobile" style="min-height: 40px;">

    </div>
    <div class="row">
        <div class="col-sm-4 offset-sm-4" style="min-height: 680px;">
            <div class="container"  style=" ">
                <div class="text-center" style="position:relative;background: transparent; ">
                    <div class="kt-portlet kt-portlet--height-fluid" style="">
                        <div class="kt-portlet__head text-center" style="width:100%">
                            <div class="kt-portlet__head-label text-center" style="width:100%">
                                <h4 class="kt-portlet__head-title text-center" style="width:100%;color:#474747;">
                                    Reset Password
                                </h4>
                            </div>
                        </div>
                        <div class="kt-portlet__body" style="background: #FFFFFF;padding:4em;">

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @include('shared.success_error')
                            {!! Form::open(['url' => route('password.update') , 'method' => 'POST', 'id' => 'kt_login_form', 'class' => 'kt-form', 'novalidate' => 'novalidate']) !!}
                            {{--$token = Password reset token--}}
                            {!! Form::hidden('token', $token) !!}
                            <div class="form-group">
                                {!! Form::text('email', request('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'New password']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm New Password']) !!}
                            </div>
                            <!--begin::Action-->
                            <div class="kt-login__actions">
                                {!! Form::submit('Reset Password', ['class' => 'btn btn-success']) !!}


                            </div>

                            <!--end::Action-->
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
