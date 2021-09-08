@extends('layouts.app')

@section('content')
  
    <div class="kt-container">

        <div class="kt-portlet" style="min-height:650px;">
        <div class="kt-portlet__head text-center" style="z-index: 1;background:#FFFFFF;">
            <div class="kt-portlet__head-label text-center" style="width:100%">


            <h4 class="kt-portlet__head-title" style="width:100%;border-radius:0px !important;margin-bottom: 10px;">
                            Manage Email Preferences
                        </h1>

            </div>
        </div>
            <div class="kt-portlet__body">
                @include('shared.success_error')
                <div class="col-sm-6">
                <h5>Unsubscribe</h2>
                <hr>
                {!! Form::open(['url' => 'postUnsubscribe', 'method' => 'POST'])  !!}
                    @csrf
                    <div class="form-grup">
                        <label>Email Address</label>
                        {!! Form::text('email', isset($user) && $user ? $user->email : '', ['class' => 'form-control', 'placeholder' => 'Enter your email address']) !!}
                        <br>
                        {!! Form::submit('Stop receving email notifications', ['class' => 'form-control btn btn-default']) !!}
                    </div>
                {!! Form::close() !!}
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>
    
@endsection
