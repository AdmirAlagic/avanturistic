@extends('layouts.app')

@section('content')
    <div class="kt-portlet">
        <div class="kt-portlet__body">
            <div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper cs-scroll">


                <!--begin::Body-->
                <div class="kt-portlet">

                    <!--begin::Signin-->
                    <div class="kt-portlet__body text-center">
                        <div class="kt-login__title">
                            <h5 class="text-success">Verify Email Address</h5><br>
                        </div>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        <br>
                        {{ __('If you did not receive the email') }},
                        <hr>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-success">{{ __('Resend verification email') }}</button>
                        </form>
                        <hr>
                        <p><i class="fa fa-info-circle text-muted"></i> If you don't receive verification email</p>
                        <div class="text-center">

                            <a style="width:200px;" href="/support" class="btn btn-label ">Contact Support</a>
                        </div>
                        <!--end::Action-->
                    {!! Form::close() !!}
                    <!--end::Form-->

                    </div>

                    <!--end::Signin-->
                </div>

                <!--end::Body-->
            </div>
        </div>
    </div>

@endsection
