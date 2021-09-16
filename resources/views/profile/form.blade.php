@extends('layouts.app')

@section('content')
<!-- begin:: Content -->
<div class="kt-portlet kt-portlet--tabs text-center" style="padding: 10px;margin-bottom: 0;-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;margin-bottom: 0px;">
    <div class="text-center">
    
        <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold  " role="tablist" style=" display: inline-flex;">  
            <li class="nav-item" style="display: inline-block;">
                <a id="nav-link-info" class="nav-link nav-link-profile active"  style="font-size:0.8em;"  data-toggle="tab" href="#info" role="tab">
                    <div class="img-circle" style="margin-left: auto;margin-right: auto;width:45px;height:45px;border-width:2px;text-align:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="25px" viewBox="0 0 23 23" version="1.1" class="kt-svg-icon" style="margin:0;margin-top:6px;">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.5"/>
                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg>
                    </div>
                    <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                        Profile
                    </div>
                </a>
                
            </li>
            <li class="nav-item nav-adventures" style="display: inline-block;">
                <a  id="nav-link-interests" class="nav-link nav-link-profile"  style="font-size:0.8em;"  data-toggle="tab" href="#interests" role="tab">
                    <div class="img-circle" style="margin-left: auto;margin-right: auto;width:45px;height:45px;border-width:2px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 23 23" version="1.1" class="kt-svg-icon"  style="margin:0;margin-top:5px;">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           
                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3"/>
                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000"/>
                        </g>
                    </svg>
                    </div>
                    <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                        Interests
                    </div>
                </a>
                
            </li>
            <li  class="nav-item nav-map" style="display: inline-block;">
                <a id="nav-link-visited-countries"  class="nav-link nav-link-profile"  style="font-size:0.8em;"  data-toggle="tab" href="#visited-countries" role="tab" >
                    <div class="img-circle" style="margin-left: auto;margin-right: auto;width:45px;height:45px;border-width:2px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25px" height="30px" viewBox="0 0 23 23" version="1.1" class="kt-svg-icon" style="margin:0;margin-top:5px;">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                 
                                <path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg>
                    </div>
                    <div class="kt-hidden-tablet-and-mobile nav-link-desc" style="text-transform: uppercase;text-align:center;margin-left:10px;color:#3C3C3C;">
                        Visited countries
                    </div>
                </a>
                
            </li>
            <li class="nav-item" style="display: inline-block;">
                <a  id="nav-link-security" class="nav-link nav-link-profile"  style="font-size:0.8em;"  data-toggle="tab" href="#security" role="tab">
                    <div class="img-circle" style="margin-left: auto;margin-right: auto; width:45px;height:45px;border-width:2px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 23 23" version="1.1" class="kt-svg-icon" style="margin:0;margin-top:5px;">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                
                                <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#FFFFFF" opacity="0.3"/>
                                <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.8"/>
                                <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.8"/>
                            </g>
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
<div class="kt-container  kt-grid__item kt-grid__item--fluid" style="padding:0 15px;">
    <div class="kt-portlet__body" style="padding-top:20px;">
        
        {!! Form::model($model , ['url' => 'updateProfile', 'method' => 'POST', 'enctype' => 'multipart/form-data'])  !!}
            <div class="tab-content" style="min-height:600px;">
                <div class="tab-pane active" id="info" role="tabpanel">
                    <div class="kt-form kt-form--label-right">
                        <div class="kt-form__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                <h5 class="text-center text-gray font-light">Profile Info</h5>   
                                    @if(session()->has('success') || session()->has('error') || $errors->any())
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-3 col-form-label"></label>
                                            <div class="col-sm-9 col-xl-6">
                                                @include('shared.success_error')
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">Profile Picture</label>
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
                                        <label class="col-xl-3 col-sm-3 col-form-label">Display Name</label>
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
                                                    {!! Form::textarea('description', $model->description, ['class' => 'form-control','data-emojiable' => 'true','maxlength' => '100', 'rows' => '5', 'placeholder' => 'Status/About me']) !!}

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
                                            <div class="input-group" style="margin-bottom:0.3em;">
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
                                <h5 class="text-center text-gray font-light">Account Settings</h5>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-sm-3 col-form-label">Email Address</label>
                                        <div class="col-sm-9 col-xl-6">
                                            <div class="input-group">

                                                <div class="input-group-prepend"><span class="input-group-text"><b>@</b></span></div>
                                                {!! Form::text('email', $model->email, ['class' => 'form-control', 'aria-describedby', 'basic-addon1', 'disabled' => true]) !!}
                                            </div>
                                            <small class="text-gray">Email address is not visible on your profile</small>
                                        </div>
                                    </div>
                                    <div class="form-group row mt-10">

                                        <label class="col-xl-3 col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9 col-xl-6">
                                            <a class="btn pl-0 flex items-center" href="/profile/change-password" style="font-weight:normal;">
                                               <i class="fa fa-key   mr-10" style="width:18px;"></i> <span>Change Password</span>
                                            </a>   
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-xl-3 col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9 col-xl-6">
                                            <a class="btn pl-0  flex items-center" href="{{ url('/support') }}">
                                                <img class="lazy mr-10" src="/img/placeholder-dark.svg"  data-src="/img/support.svg" data-srcset="/img/support.svg" alt="Avanturistic Support"  style="width: 18px; height: 18px;">
                                                <span>
                                                    Contact Support
                                                   
                                                </span>
                                            </a>
                                           
                                            <small class="pl-10 text-gray">
                                                If you are experiencing any issues with your account or just want to share an idea with us - send a direct message to our support.
                                            </small>
                                               
                                        </div>
                                        
                                    </div>

                                  {{--   <h4 >
                                        We care for your feedback
                                    </h4> --}}
                                   
                                      
                                      
                                    
                                   
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
                                        Outdoor Activities Interests
                                    </h5>
                                    <p class="text-center text-gray"><small>
                                        Selected activities will be shown on your profile</small></p>
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

<!-- end:: Content -->
@endsection

