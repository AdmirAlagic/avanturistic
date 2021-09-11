<!-- begin:: Footer -->

<div class="kt-footer kt-grid__item" id="kt_footer" style="padding: 10px;">
    <div class="kt-footer__top">
        <div class="kt-container ">
            <div class="row">
                <div class="col-sm-4">
                    <div class="kt-footer__section">
                        <h4 class="kt-footer__title">
                            {{--<img alt="Logo" src="/img/logo.svg" style="width:25px;" class="kt-header__brand-logo-sticky">&nbsp;&nbsp;About Us--}}
                            <div class="kt-login__divider">

                                <div class="kt-divider text-muted">
                                    <span style="background-image: linear-gradient(to right, #333333, #999999);"></span>
                                    <span>
                                        <a href="/">
                                            <img alt="Avanturistic Logo"  class="lazy" src="/img/placeholder-dark.svg"  data-src="{{ url('/img/logo.svg') }}" data-srcset="{{ url('/img/logo.svg') }}" alt="avanturistic.com" style="width:35px;" class="kt-header__brand-logo-sticky">
                                        </a>
                                    </span>
                                    <span style="background-image: linear-gradient(to left, #333333, #999999);"></span>
                                </div>
                            </div>
                        </h4>
                        <div class="kt-footer__content text-center" style="color:#f8f8fb;text-align: justify;">
                            <b>Avanturistic</b> is a network for <b>adventure</b>. <br><a class="text-success" href="/">Explore</a> & <a class="text-success" href="/share">
                                share
                            </a> outdoor adventures with   routes, locations, photos, videos and  
                           get involved in creating <br> <b><a class="text-success" href="{{ url('the-world-map-of-outdoor-adventures') }}">the world map of outdoor adventures</a></b>.
                           <br>
                           <a class="text-muted" href=" https://avanturistic.com/welcome-adventurer">
                                <b>Discover more about Avanturistic</b> 
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="kt-footer__section">
                        <h4 class="kt-footer__title text-center text-gray">
                            Follow us
                        </h4>
                        <div class="kt-footer__content text-center" style="color:#f8f8fb;text-align: justify;">
                           
                          
                            <a class="text-white text-light" target="_blank" href="https://www.facebook.com/avanturistic">
                                <img class="lazy" src="/img/placeholder-dark.svg"  data-src="/img/social/fb-white.svg"  data-srcset="/img/social/fb-white.svg" alt="Avanturistic Facebook profile" style="width: 28px; height: 28px;margin-right: 2px;">&nbsp;Facebook
                            </a>
                            &nbsp;
                            <a  class="text-white text-light" target="_blank" href="https://www.instagram.com/avanturistic.com.app">
                                <img class="lazy" src="/img/placeholder-dark.svg"  data-src="/img/social/instagram-white.svg" data-srcset="/img/social/instagram-white.svg" alt="Avanturistic Instagram profile"  style="width: 30px; height: 30px;margin-left:1px;margin-right: 2px;">&nbsp;Instagram
                            </a>
                            
                        </div>
                    </div>
                    
                </div>
                @if(isset($isWebView) && !$isWebView || (isset($user) && $user))
                    <div class="col-sm-4">
                        @if(isset($isWebView) && !$isWebView)
                        <div class="kt-footer__section">
                            <h4 class="kt-footer__title text-center text-gray">
                                Download App
                            </h4>
                            <div class="kt-footer__content text-center" style="color:#f8f8fb;text-align: justify;">
                              
                                <a class="text-white text-light" target="_blank" href="https://play.google.com/store/apps/details?id=com.omnitask.avanturistic">
                                    <img class="lazy" alt="Avanturistic app on Google Play" src="/img/placeholder-dark.svg"  data-src="/img/social/google-play-white.svg" data-srcset="/img/social/google-play-white.svg"  style="width: 25px; height: 25px;">
                                    &nbsp;Google Play
                                </a>
                               
                                
                               <div class="kt-hidden-tablet-and-mobile">
                               <br> 
                                    <img class="lazy" alt="Avanturistic app on Google Play" src="/img/placeholder-dark.svg"  data-src="{{ url('/img/qrcode.svg') }}" data-srcset="{{ url('/img/qrcode.svg') }}"  style="width: 120px; height: 120px;">
                                    <br><br>
                               </div>
                           
                            </div>
                        </div>
                        @endif
                        @if(isset($user) && $user)
                            <br> <br>
                            <div class="kt-footer__section">
                                <h4 class="kt-footer__title text-center text-gray" style="padding-bottom:0;">
                                    We care for your feedback
                                </h4>
                                <div class="kt-footer__content text-center" style="color:#f8f8fb;text-align: justify;">
                                    <p style="">
                                        If you are experiencing any issues with your account or just want to share an idea with us - send a direct message to our support.
                                    </p>
                                
                                    <a class="text-white text-light" href="{{ url('/support') }}">
                                    <img class="lazy" src="/img/placeholder-dark.svg"  data-src="/img/support.svg" data-srcset="/img/support.svg" alt="Avanturistic Support"  style="width: 30px; height: 30px;margin-left:1px;margin-right: 2px;">&nbsp;Contact support
                                    </a>
                                    <br><br>
                                    
                                    
                                </div>
                            </div>
                            @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="kt-footer__bottom " style="padding-bottom:40px;margin-top: -60px;background-color: transparent;">
        <div class="kt-container ">
            <div class="kt-footer__wrapper text-center" style="padding:10px;">
                <div class="kt-footer__logo">
                    <div class="kt-footer__copyright" style="color:#999;">
                       Copyright ©
                            {{ date("Y")}}

                            <b>Avanturistic</b>
                    </div>
                </div>
                <div class="kt-footer__menu text-center">
                    <a class="text-white" href="mailto:info@avanturistic.com"><b>info@avanturistic.com</b></a>
                    <a class="text-white" href="/privacy-policy">
                        Privacy Policy
                    </a>
                    <a class="text-white" href="/terms-and-conditions">
                        Terms & Conditions
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!-- end:: Footer -->
