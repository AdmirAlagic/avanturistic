<div class="row" >
        <div class="col-12">
        <div style="z-index:1;">
                <div class="text-center" style="position:relative;background: transparent; ">
                    <div class="kt-portlet kt-portlet--height-fluid" style="margin-bottom:0;">
                        <div class="kt-portlet__head text-center" style="width:100%">
                            <div class="kt-portlet__head-label text-center" style="width:100%">
                                <h2 class="kt-portlet__head-title text-center" style="width:100%;color:#474747;">
                                    Welcome aboard!
                                </h2>
                                
                            </div>
                        </div>
                        <div class="kt-portlet__body" style="padding-top:10px;">
                            
                            <p class="text-center " >
                                <b>Create your account</b>
                            </p>
                            {!! Form::open(['url' => 'register', 'method' => 'POST', 'class' => 'kt-form', 'novalidate' => 'novalidate', 'style' => 'padding:15px;padding-top:0;padding-bottom:5px;', 'id' => 'signup-form']) !!}
                            <div class="row class-text-center">
                                <div class="col-12 ">
                                    <div id="signup-errors" style="margin-top:10px;"></div>
                                    <!--begin::Form-->
                                    <div class="form-group">
                                        {!! Form::text('email', null, ['class' => 'auth-input form-control', 'placeholder' => 'Email', ]) !!}
                                    </div>
                                    <div class="form-group" style="margin-bottom:1rem;">
                                        {!! Form::text('name', null, ['class' => 'auth-input form-control', 'placeholder' => 'Display Name', ]) !!}
                                    </div>
                                    <div class="form-group" >
                                        {!! Form::password('password', ['class' => 'auth-input form-control', 'placeholder' => 'Password', 'id' => 'password', ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::password('password_confirmation', ['class' => 'auth-input form-control', 'placeholder' => 'Confirm Password', ]) !!}
                                    </div>

                                   

                                </div>
                               
                            </div>

                           <div class="form-group">
                            <button id="signupSubmit" class="btn btn-green" style="padding: 5px;position:relative;-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important; width:100%;height:35px;">
                                <span style="position:absolute;right:35%;top:15px;display:none;" class="kt-spinner  kt-spinner--sm kt-spinner--light signupLoading" ></span> <span class="text-white font-boldest signupSubmit">
                                    Sign Up
                                </span>
                                </button>
                               
                             
                           </div>
                           
                            <br>
                            <div class="kt-login__divider ">
                                <div class="kt-divider kt-auth-divider">
                                    <span></span>
                                    <span style="color:#999;"><b>OR</b></span>
                                    <span></span>
                                </div>
                            </div>
                            <br>
                            <p class="font-light">Continue with</p>

                            @include('shared.fb_google_signup')
                          
                             
                            <p class="mt-10 mb-10 text-gray" style="line-height:1rem; font-weight:300; ">
                                <small> By signing up, you agree to our  
                                    <a class="text-muted" href="/terms-and-conditions">terms</a> &
                                    <a class="text-muted" href="/privacy-policy">privacy policy</a>.</small>
                            </p>
                            {!! Form::close() !!}


                           
                           {{--  <p style="padding-top:0px;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 20 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="20" height="20"/>
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                        <rect fill="#FFFFFF" x="11" y="10" width="2" height="7" rx="1"/>
                                        <rect fill="#FFFFFF" x="11" y="7" width="2" height="2" rx="1"/>
                                    </g>
                                </svg>
                                <a class="text-muted" style="color:#999;" href="https://avanturistic.com/welcome-adventurer"><small>&nbsp;Discover more about AVANTURISTIC</small></a>
                            </p> --}}
                        </div>
                    </div>

                 {{-- 
                    @if($isMobile && !$isWebView)
                    <div class="kt-portlet kt-portlet--height-fluid" style="margin-bottom:0;">
                        <div class="kt-portlet__body" style="">
                            <p class="text-gray">Download App</p>
                            <a href="https://play.google.com/store/apps/details?id=com.omnitask.avanturistic">
                                <img src="/img/google-play.png" style="width:131px;" alt="">
                            </a>
                        </div>
                    </div>
                    

                    @endif --}}
                   
                </div>
            </div>
        </div>
    </div>
