@extends('layouts.errors')

@section('content')
    <div class="kt-portlet text-center">
        <div class="kt-portlet__body text-center">
            <!--begin::Signin-->

            <div class="kt-login__title">
                <img src="/img/logo.svg"  style="width:50px;" alt="Avanturistic">
                <hr>

                <h3 style="font-size:2em; margin-top:50px;" class="text-muted"><b>Avanturistic seems to be unavailable.</b></h3>

                <div   style="margin-bottom:100px;">

                    <p>Sorry, this content is temporarily unavailable. Please refresh or try again later.</p>
                    <a href="{{ url()->previous() }}"><span class="text-muted"></span> Go Back</a> |  <a href="{{ url('/') }}"><span class="text-muted"></span> Home</a>
                </div>
            </div>

        </div>
    </div>
@endsection
