@extends('layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-container padding0">
    <div class="kt-portlet">
        <div class="kt-portlet__head text-center" style="min-height:30px;border-top:1px solid #f6f6f6;">
            <div class="kt-portlet__head-label" style="width:100%;min-height:30px;">
                <h4 class="kt-portlet__head-title text-center" style="width:100%;border-radius:0px !important;margin:10px;">
                    Change Password
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body" >
            @include('shared.success_error')
            <div class="kt-form kt-form--label-right">
                <div class="kt-form__body">
                    <div class="kt-section kt-section--first">
                        <div class="kt-section__body">
                            {!! Form::open(['method' => 'POST', 'url' => '/profile/change-password' ]) !!}
                                
                                <div class="form-group row">

                                    <label class="col-xl-3 col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9 col-xl-6">
                                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter new password', 'autofocus']) !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9 col-xl-6">
                                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Repeat new password']) !!}
                                    </div>
                                </div>
                                <div class="form-group  row">
                                    <div class="col-xl-3 col-sm-3 col-form-label"></div>
                                    <div class="col-sm-9 col-xl-6">
                                        {!! Form::submit(__('general.update'), ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- end:: Content -->
@endsection

