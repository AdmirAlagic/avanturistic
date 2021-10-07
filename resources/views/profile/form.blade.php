@extends('layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-container profile-container">
    <div class="kt-portlet kt-portlet--tabs text-center" style="padding: 10px;margin-bottom: 0;-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;margin-bottom: 0px;">
        <div class="text-center">
        
            <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold  " role="tablist" style=" display: inline-flex;">  
                <li class="nav-item" style="display: inline-block;">
                    <a id="nav-link-info" class="nav-link nav-link-profile active"  style="font-size:0.8em;"  data-toggle="tab" href="#info" role="tab">
                        <div class="img-circle flex items-center justify-center  " style="margin-left: auto;margin-right: auto;padding:5px;width:40px;height:40px;border-width:2px;text-align:center;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left:auto;margin-right:auto;" fill="none" viewBox="0 0 24 24" stroke="#474747" >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                              </svg>
                        </div>
                        <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                            Profile
                        </div>
                    </a>
                    
                </li>
                @if($user->group == \App\User::$_USER_GROUP_BUSINESS)
                    <li class="nav-item nav-adventures" style="display: inline-block;">
                        <a  id="nav-link-business" class="nav-link nav-link-profile"  style="font-size:0.8em;"  data-toggle="tab" href="#business" role="tab">
                            <div class="img-circle flex items-center justify-center "   style="margin-left: auto;margin-right: auto;padding:5px;width:40px;height:40px;border-width:2px;text-align:center;">
                                <svg xmlns="http://www.w3.org/2000/svg"  style="margin-left:auto;margin-right:auto;"  fill="none" viewBox="0 0 24 24" stroke="#474747">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                  </svg>
                            </div>
                            <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                                Business Info
                            </div>
                        </a>
                        
                    </li>
                @endif
                <li class="nav-item nav-adventures" style="display: inline-block;">
                    <a  id="nav-link-interests" class="nav-link nav-link-profile"  style="font-size:0.8em;"  data-toggle="tab" href="#interests" role="tab">
                        <div class="img-circle flex items-center justify-center " style="margin-left: auto;margin-right: auto;padding:5px;width:40px;height:40px;border-width:2px;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left:auto;margin-right:auto;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14v6m-3-3h6M6 10h2a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2zm10 0h2a2 2 0 002-2V6a2 2 0 00-2-2h-2a2 2 0 00-2 2v2a2 2 0 002 2zM6 20h2a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
                              </svg>
                        </div>
                        <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                            {{ $model->group == \App\User::$_USER_GROUP_BUSINESS ? 'Services' : 'Interests' }}
                        </div>
                    </a>
                    
                </li>
             
                <li  class="nav-item nav-map" style="display: inline-block;">
                    <a id="nav-link-visited-countries"  class="nav-link nav-link-profile"  style="font-size:0.8em;"  data-toggle="tab" href="#visited-countries" role="tab" >
                        <div class="img-circle flex items-center justify-center " style="margin-left: auto;margin-right: auto;padding:5px;width:40px;height:40px;border-width:2px;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left:auto;margin-right:auto;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                        </div>
                        <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                            Visited countries
                        </div>
                    </a>
                    
                </li>
                <li class="nav-item" style="display: inline-block;">
                    <a  id="nav-link-security" class="nav-link nav-link-profile"  style="font-size:0.8em;"  data-toggle="tab" href="#security" role="tab">
                        <div class="img-circle flex items-center justify-center " style="margin-left: auto;margin-right: auto;padding:5px; width:40px;height:40px;border-width:2px;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="margin-left:auto;margin-right:auto;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                              </svg>
                        </div>
                        <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                            Account
                        </div>
                    </a>
                    
                </li>        
            </ul>
           
        </div>
    </div> 
    
    <div class="kt-portlet" style="padding:15px;">
    <div class="kt-portlet__body" style="padding-top:20px;">
        
        {!! Form::model($model , ['url' => 'updateProfile', 'method' => 'POST', 'enctype' => 'multipart/form-data'])  !!}
            <div class="tab-content" style="min-height:600px;">
                <div class="tab-pane active" id="info" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                <h5 class="text-center text-gray font-light mb-10">Profile Info</h5>   
                                <br>
                                    @if(session()->has('success') || session()->has('error') || $errors->any())
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9 col-xl-6">
                                                @include('shared.success_error')
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">{{ $model->group == \App\User::$_USER_GROUP_BUSINESS ? 'Business Logo' : 'Profile Picture' }}</label>
                                        <div class="col-sm-9 col-xl-6 text-center ">
                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle- "  >
                                                <div class="kt-avatar__holder dropzone-file-area dropzone dz-clickable" id="avatarImage" style="border-style:solid !important;border-radius:50%;background-image: url(&quot;{{ $model->avatar ? $model->avatar : '/img/avatar.png' }}&quot;);">
                                                    <div class="dz-message"><label class="kt-avatar__upload dropzone-file-area  dz-clickable">
                                                            <i class="fa fa-camera text-muted"></i>

                                                        </label></div>

                                                    <input type="hidden" name="avatar">
                                                </div>
                                                <div class="dz-previews dz-clickable" style="display: none; visibility: hidden;"></div>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">{{ $model->group == \App\User::$_USER_GROUP_BUSINESS ? 'Business Name' : 'Profile name' }}</label>
                                        <div class="col-sm-9 col-xl-6">

                                            <div class="form-group">
                                                {!! Form::text('name', $model->name, ['class' => 'form-control']) !!}
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">About</label>
                                        <div class="col-sm-9 col-xl-6">

                                            <div class="form-group">

                                                <div class="description-emoji">
                                                    {!! Form::textarea('description', $model->description, ['class' => 'form-control','data-emojiable' => 'true','maxlength' => '100', 'rows' => '5', 'placeholder' =>   $model->group == \App\User::$_USER_GROUP_BUSINESS ? 'Describe your services' : 'About me'  ]) !!}

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">
                                            Country&nbsp;
                                        </label>

                                        <div class="col-sm-9 col-xl-6">
                                            <small class="text-gray">Country flag will be shown on your profile</small>
                                            <select class="form-control"  name="country_code" id="" style="margin-top: 10px;">
                                                <option value="">Select your country</option>
                                                @foreach($countries as $obj)
                                                    <option {{ $obj->code2 == $model->country_code ? 'selected' : '' }} value="{{ $obj->code2 }}">{{ $obj->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">
                                            Social Links&nbsp;
                                        </label>

                                        <div class="col-sm-9 col-xl-6">
                                            <div class="input-group mt-10" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-globe" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[website]', null, ['class' => 'form-control', 'placeholder' => 'https://yourwebsite.com']) !!}
                                            </div>
                                            <div class="input-group" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-facebook" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[facebook]', null, ['class' => 'form-control', 'placeholder' => 'Facebook']) !!}
                                            </div>
                                            <div class="input-group" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-instagram" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[instagram]', null, ['class' => 'form-control','placeholder' => 'Instagram']) !!}
                                            </div>
                                            <div class="input-group" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-youtube-play" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[youtube]', null, ['class' => 'form-control', 'placeholder' => 'YouTube']) !!}
                                            </div>
                                            <div class="input-group" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-pinterest" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[pinterest]', null, ['class' => 'form-control', 'placeholder' => 'Pinterest']) !!}
                                            </div>
                                            <div class="input-group" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-linkedin" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[linkedin]', null, ['class' => 'form-control', 'placeholder' => 'LinkedIn']) !!}
                                            </div>
                                            <div class="input-group" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-twitter" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[twitter]', null, ['class' => 'form-control', 'placeholder' => 'Twitter']) !!}
                                            </div>
                                            <div class="input-group" style="margin-bottom:0.3em;">
                                                <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                                <i class="la la-tripadvisor" style="font-size:2em;"></i>
                                                        </span>
                                                </div>
                                                {!! Form::text('social_links[tripadvisor]', null, ['class' => 'form-control', 'placeholder' => 'Trip Advisor']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group  row">
                                        <div class="col-xl-3 col-sm-3 col-form-label"></div>
                                        <div class="col-sm-9 col-xl-6">
                                            {!! Form::submit(__('general.update'), ['class' => 'btn btn-success']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="security" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                <h5 class="text-center text-gray font-light mb-10">Account Settings</h5>
                                <br>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">Email Address</label>
                                        <div class="col-sm-9 col-xl-6">
                                            <div class="input-group">

                                                <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                    </svg>

                                                    </span></div>
                                                {!! Form::text('email', $model->email, ['class' => 'form-control', 'aria-describedby', 'basic-addon1', 'disabled' => true]) !!}
                                            </div>
                                            <small class="text-gray">Email address is not visible on your profile</small>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-10">
    
                                        <div class="col-sm-9 col-xl-6 offset-sm-3 offset-xl-3">
                                            <a class="btn btn-line-roundedd pl-0 flex items-center" href="/profile/change-password" style="font-weight:normal;">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;" class="mr-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                    </svg>
                                                    <span>Change Password</span>
                                            </a>   
                                        </div>
                                    </div>
                                    @if($model->group == \App\User::$_USER_GROUP_USER)
                                    <div class="form-group row">

                                        <div class="col-sm-9 col-xl-6 offset-sm-3 offset-xl-3">
                                            <a class="btn pl-0   sweet-alert-custom flex items-center" href="{{ url('/switch-to-businesss') }}" data-alert_title="Are you sure you want to switch your account to business?" data-alert_type="warning" data-alert_text="You wont be able to revert this change.">
                                                <svg xmlns="http://www.w3.org/2000/svg" style="width:20px;" class="mr-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                <span>
                                                    Switch to business account
                                                
                                                </span>
                                            </a>
                                            
                                            <small class="pl-10 text-gray">
                                                
                                            </small>
                                            
                                        </div>
                                        
                                    </div>
                                @endif
                                    <div class="form-group row">

    
                                        <div class="col-sm-9 col-xl-6 offset-sm-3 offset-xl-3">
                                            <a class="btn pl-0  flex items-center" href="{{ url('/support') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-10" style="width:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                <span>
                                                    Contact Support
                                                    
                                                </span>
                                            </a>
                                            
                                            <div class="pl-10 text-gray" style="padding-left:30px;">
                                                <small>
                                                    If you are experiencing any issues with your account or just want to share an idea with us - send a direct message to our support.
                                                </small>
                                            </div>
                                                
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="business" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                <h5 class="text-center text-gray font-light">Business Info</h5>
                                <br>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">Contact Email</label>
                                        <div class="col-sm-9 col-xl-6">
                                            <div class="input-group">

                                                <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg"  style="width:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                        </svg>
                                                    </span></div>
                                                {!! Form::text('business_fields[email]', isset($model->business_fields['email']) ? $model->business_fields['email']  : null , ['class' => 'form-control', 'aria-describedby', 'basic-addon1', 'placeholder' => 'Enter contact email address']) !!}
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">Business Phone</label>
                                        <div class="col-sm-9 col-xl-6">
                                            <div class="input-group">

                                                <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                        
                                                        </svg>
                                                </span></div>
                                                {!! Form::text('business_fields[phone]', isset($model->business_fields['phone']) ? $model->business_fields['phone']  : null , ['class' => 'form-control', 'placeholder' => 'Enter business phone number']) !!}
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">Business Address</label>
                                        <div class="col-sm-9 col-xl-6">
                                            <div class="input-group">

                                                <div class="input-group-prepend"><span class="input-group-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg"  style="width:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        </svg>
                                                </span></div>
                                                {!! Form::text('business_fields[address]', isset($model->business_fields['address']) ? $model->business_fields['address']  : null , ['class' => 'form-control', 'placeholder' => 'Enter business address']) !!}
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">
                                        
                                            Business Hours</label>
                                        <div class="col-sm-9 col-xl-6">
                                            <label class="mt-10 always-open">
                                            {!! Form::checkbox('opening_hours' ,'allways-open' , null, [  'id' => 'always-open-checkbox']) !!} &nbsp; Always open  
                                            </label>
                                            <div class="opening-hours">
                                                @php $days = [1 => 'monday', 2 => 'tuesday', 3 =>  'wednesday', 4 => 'thursday', 5 => 'friday', 6 => 'saturday', 0 => 'sunday' ];@endphp
                                                @foreach($days as $key => $day) 
                                                    
                                                    <div class="form-group mt-10">
                                                    
                                                        <div class="row">
                                                            <div class="col-4 items-center flex">
                                                                <label class="text-gray font-light">
                                                                    <b> {{ ucfirst($day)}}</b>
                                                                </label>
            
                                                            </div>
                                                            <div class="col-4  text-right">
                                                            
                                                                {!! Form::select('opening_hours['.$key.'][from]', UtilHelper::getWorkingHours(), isset($model->opening_hours[$key]['from']) ? $model->opening_hours[$key]['from']  : null , ['class' => 'form-control', 'placeholder' => 'From']) !!}
                                                            </div>
                                                            <div class="col-4 text-right">
                                                                {!! Form::select('opening_hours['.$key.'][to]', UtilHelper::getWorkingHours(), isset($model->opening_hours[$key]['to']) ? $model->opening_hours[$key]['to']  : null , ['class' => 'form-control', 'placeholder' => 'To']) !!}
                                                            </div>
                                                        </div>
                                                        

                                                    
                                                    </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-10">
                                        <label class="col-xl-3 col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9 col-xl-6">
                                            <div class="form-group">
                                                {!! Form::submit(__('general.update'), ['class' => 'btn btn-success']) !!}
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="tab-pane" id="interests" role="tabpanel">
                <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <h5 class="text-center text-gray font-light">
                                        
                                        {{ $model->group == \App\User::$_USER_GROUP_BUSINESS ? 'Outdoor Services' : 'Outdoor Activities Interests' }}
                                    </h5>
                                    <br>
                                    @if($model->group !=  \App\User::$_USER_GROUP_BUSINESS)
                                        <p class="text-center text-gray">
                                            <small>
                                                Selected activities will be shown on your profile
                                            </small>
                                        </p>
                                    @endif
                                        
                                    <div class="form-group  row">
                                        <div class="row">
                                            @foreach($badges as $key => $val)
                                                <div class="col-4 col-sm-3 col-lg-2 text-center">
                                                    <div class="kt-switch" style="margin:5px;">
                                                        
                                                        <label style="margin-top: 5px;">
                                                        
                                                            <div class="badge-wrap {{ isset($model->options['badges'][$key]) || request()->category == $key ? '' : 'inactive' }}" style="-webkit-box-shadow: 0px 0px 3px 0px rgb(102 102 102);-moz-box-shadow: 0px 0px 3px 0px rgb(102 102 102);box-shadow: 0px 0px 3px 0px rgb(102 102 102); border:3px solid {{ $val['color'] }};background: #474747;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 45px; height: 45px;margin-left: auto; margin-right: auto;padding: 7px;">
                                                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;">
                                                            </div>
                                                            <input type="checkbox" name="options[badges][{{ $key }}]" {{ isset($model->options['badges'][$key]) || request()->category == $key ? 'checked' : '' }} >


                                                        </label>
                                                    </div>
                                                    <div style="white-space: nowrap;font-style: italic; font-size:0.9rem;">{{ $val['name'] }}</div><br>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                                    
                                    <div class="text-center">
                                    {!! Form::submit(__('general.update'), ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="visited-countries" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    @if($model->country)
                                        <input type="hidden" id="country-lat" value="{{ $model->country->lat }}">
                                        <input type="hidden" id="country-lng" value="{{ $model->country->lng }}">
                                    @endif
                                    <h5 class="text-center text-gray font-light">Visited Countries</h5>
                                    <br>
                                    <p class="text-center text-gray"><small>Visited countries are automatically updated when you share adventure locations</small></p>
                                    <h6 class="text-center"><span class="font-size:0.9em;"><i class="fa fa-hand-pointer text-success"></i></span>&nbsp;<b><em>Tap on map to mark country as visited</em></b></h6>
                                    <div id="visiteds-map" style="width:100%; height:300px;">
                                    </div>
                                    <p class="text-center text-gray"><small>Changes are automatically saved</small></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>

    
</div>
<!-- end:: Content -->
@endsection

