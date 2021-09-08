<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="title" content="Avanturistic">
    <meta name="author" content="Admir Alagić">
    <meta property="og:site_name" content="Avanturistic.com">

    <meta name="google" value="notranslate" />
    <title>{{ isset($pageTitle) ? $pageTitle : 'Avanturistic' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-language" content="en"><meta name="keywords" content="{{ isset($post->title) ? $post->title .' ,' : '' }} {{ isset($post->address) ? $post->address .' ,' : '' }} avanturistic, adventure outdoors, outdoors, outdoor adventures,  tour, avanturistic.com, adrenaline tourism, rare locations, sport, travel photos, travel videos, travel blog, extreme sports, travel, blog, profile, user, adventure, adventourist, adventoruous, turist, tourism, photos, facebook login, google login, social-network, social, share, explore, hiking, traveling, seasight {{isset($badges_kewords) ? $badges_kewords : ''}} ">
    <meta name="robots" content="index, follow">
    <meta name="language" content="English">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <!--[if IE]><link rel="shortcut icon" href="/favicon.ico"><![endif]-->
    <link rel="apple-touch-icon-precomposed" href="/apple-icon-precomposed.png">
    <link rel="icon" href="/favicon-96x96.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="google-signin-client_id" content="888833607318-j2j07k86jdprhisoshg5p7vpq6d16k73.apps.googleusercontent.com">
    @if(isset($pageDescription))
        <meta name="description" content="{{ $pageDescription }}">
    @else
        <meta name="description" content="Avanturistic is a network for adventure. Explore Outdoor adventures locations, photos and videos and get involved in creating the world map of outdoor adventures!">
    @endif
    @if(isset($pageImage))
        <meta name="image" content="{{ url($pageImage) }}">
    @else
        <meta name="image" content="{{ url('/img/logo.svg') }}">
    @endif
    @php $badges_kewords = '';@endphp
    @if(isset($badges))
        @foreach($badges as $key => $val)
            @php $badges_kewords .= ', '.str_replace('-',' ', $val['name']); @endphp
        @endforeach
    @endif
    @if (isset($meta))
        @foreach ($meta as $key => $obj)
            <meta property="{{$key}}" content="{{ $obj }}" />
        @endforeach
    @else
        <meta property="og:description" content="Avanturistic is a network for adventure. Explore Outdoor adventures locations, photos and videos and get involved in creating the world map of outdoor adventures!">
        <meta property="og:image" name="og:image" content="{{ url('/img/logo.svg') }}">
    @endif
    <link rel="preload" href="/dist/css/fonts/fa-solid-900.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">
     
    <script>
        window.auth_check = '{{ isset($user)  && $user ? "true" : "false"}}'
    </script>

    @if(isset($styles))
        @foreach($styles as $key => $value)
            <link rel="stylesheet" href="{{$value}}"/>
        @endforeach
    @endif


    @if(isset($user))
        <script>

            window.auth_user_id = '{{ $user ? $user->id : null }}'
        </script>
    @endif
    <script>
        window.swipersList = [];
    </script>
    <link rel="preload"  onload="this.onload=null;this.rel='stylesheet'" as="style"  href="{{ (mix('/dist/css/preload.min.css')) }}" media="all">
    <link rel="stylesheet"  href="{{ (mix('/dist/css/style.min.css')) }}" rel="stylesheet" media="all">
    <link href="{{ mix('dist/css/auth.min.css') }}" rel="stylesheet">
 
    @if(config('app.debug') == false)
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-29252906-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-29252906-1');
        </script>
    @endif
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">

    <style>
    .abcRioButton.abcRioButtonLightBlue { width: 17.5rem !important; border-radius:1px; margin: 0 auto;line-height:25px;margin-top:10px;}</style>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
</head>
<body  class="kt-header--fixed kt-header-mobile--fixed">
@if(!isset($disableHeader))
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        </div>
        <div class="kt-header-mobile__logo">
            <a href="/" class="cs-logo text-white font-weight-bold" alt="avanturistic.com" title="Avanturistic.com"><img  src="/img/logo.png" style="width:30px !important;margin-top:-5px;" alt="avanturistic.com"/> <span class="logo-text"><b>AVANTURISTIC</b></span></a>

        </div>
        <div class="kt-header-mobile__toolbar">

        </div>
    </div>
@endif
<div id="app" class="kt-grid kt-grid--hor kt-grid--root">
@if(isset($user) && $user)
        <input type="hidden" name="loged_user" id="loged_user" value="{{ $user->email }}">
    @endif
    <messages-component></messages-component>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div {{ isset($disableHeader) ? 'style=padding-top:0px' : '' }} class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" >
            <!-- begin:: Header -->
            <!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-header--fixed" data-ktheader-minimize="on"  >
    <div class="kt-container ">

        <!-- begin:: Brand -->
        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand" style="padding:10px;">
            {{--<a class="kt-header__brand-logo" href="?page=index&demo=demo4">--}}
            {{--<img alt="Logo" src="/metronic/assets/media/logos/logo-4.png" class="kt-header__brand-logo-default" />--}}
            {{--<img alt="Logo" src="/metronic/assets/media/logos/logo-4-sm.png" class="kt-header__brand-logo-sticky" />--}}
            {{--</a>--}}

            <a href="/" class=" text-white font-weight-bold"><img class="header-logo-img" src="/img/logo.svg" style="width:28px; position:absolute; top:10px;left:2px;" alt="avanturistic.com"/>  <span style="margin-left:5px;" class="logo-text"><b>AVANTURISTIC</b></span></a>
        </div>

        <!-- end:: Brand -->

        <!-- begin: Header Menu -->

        <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper"  >
            <button class="kt-header-menu-wrapper-close text-white"  id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile " >
                @if(isset($user) && $user)
                    <div class="kt-visible-tablet-and-mobile" style="border-bottom: 1px dotted #333;">
                        <!--begin: Head -->
                        <a href="/{{ '@' .$user->name_slug}}">
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="height:80px;background:#000000 !important; color:#FFFFFF;">
                                <div class="">
                                    @if($user->avatar && $user->avatar != '' && $user->avatar != ' ')
                                        <img class="img-circle"  style="width:40px;" alt="Avatar" src="{{ $user->avatar }}" />
                                    @else
                                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success" style="color: #ffffff !important;">{{ ucfirst($user->name[0]) }}</span>
                                    @endif
                                </div>
                                <div class="kt-user-card__name">
                                    <b>{{ $user->name }}</b>
                                </div>
                            </div>
                        </a>
                    </div>
                @else
                    <div class="kt-visible-tablet-and-mobile" style="border-bottom: 1px dotted #333;">
                        <!--begin: Head -->
                        <a  class="text-white" href="/login">
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="height:80px;background:#1c1e21 !important; color:#FFFFFF;">
                                <div class="kt-user-card__avatar">
                                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold text-white ">A</span>
                                </div>
                                <div class="kt-user-card__name" style="margin-left:10px;">
                                    <b>Adventurer</b>


                                </div>
                            </div>
                        </a>
                    </div>
            @endif
            <!--end: Head -->

                <ul class="kt-menu__nav " style="padding-top:0 !important;padding-bottom: 0;">
                    <li style="padding-left:0;" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel kt-hidden-tablet-and-mobile  " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                        <a href="/" class="kt-menu__link {{ isset($activePage) && $activePage == 'home' ?  'kt-menu__link--active' :  '' }} ">
                            <span class="kt-menu__link-text  "  style="padding-top: 15px;padding-bottom: 15px;">
                                &nbsp;<b>HOME</b></span></span>
                        </a>
                    </li>
                    <li style="padding-left:0;" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel   " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                        <a href="/outdoor-adventures" class="kt-menu__link {{ isset($activePage) && $activePage == 'adventures' ?  'kt-menu__link--active' :  '' }} ">
                            <span class="kt-menu__link-text  " >
                                 <div class="img-circle" style="display:inline-block;width:30px;height:30px;border-width:2px;padding:4px;border-color:#555;background: #101010;margin-right:2px;">
                                    <img class="" src="/img/badges/empty/backpacking.svg" style="height:17px;" alt="Backpacking Adventures">
                                 </div> <span style="font-size:0.9rem;padding-left:0.5rem;margin-right:1px;"> <b>ADVENTURES</b></span>

                            </span>
                        </a>
                    </li>

                    <li style="" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel  " data-ktmenu-submenu-toggle="click" aria-haspopup="true" >
                        <a href="/the-world-map-of-outdoor-adventures" class="kt-menu__link {{ isset($activePage) && $activePage == 'map' ?  'kt-menu__link--active' :  '' }}">
                            <span class="kt-menu__link-text  " >
                                 <div class="img-circle" style="display:inline-block;width:30px;height:30px;border-width:2px;border-color:#555;background: #101010;margin-right:2px;">
                                    <i class="fa fa-map-marker-alt" style="font-size:16px;margin-left:7px;margin-top:5px;"></i>&nbsp;&nbsp;
                                </div><span style="font-size:0.9rem;padding-left:0.5rem;margin-right:1px;"> <b>MAP</b></span>
                            </span>
                        </a>
                    </li>

                    <li  class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel  " data-ktmenu-submenu-toggle="click" aria-haspopup="true" >
                        <a href="/watch" class="kt-menu__link {{ isset($activePage) && $activePage == 'videos' ?  'kt-menu__link--active' :  '' }}">
                            <span class="kt-menu__link-text " >
                                <div class="img-circle" style="display:inline-block;width:30px;height:30px;border-width:2px;border-color:#555;background: #101010;margin-right:2px;">
                                   <i class="fa fa-play " style="font-size:14px; margin-left:9px;margin-top:6px;"></i>&nbsp;&nbsp;
                                </div><span style="font-size:0.9rem;padding-left:0.5rem;margin-right:1px;"> <b>WATCH</b></span>

                            </span>
                        </a>
                    </li>
                    @if(isset($stories) && count($stories) > 4)
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true" >
                        <a href="/stories" class="kt-menu__link {{ isset($activePage) && $activePage == 'stories' ?  'kt-menu__link--active' :  '' }}">
                            <span class="kt-menu__link-text"> 
                            <div class="img-circle" style="display:inline-block;width:30px;height:30px;border-width:2px;padding:4px;border-color:#555;background: #101010;margin-right:2px;">
                                    <img class="" src="/img/stories_white.svg" style="width:24px;" alt="Adventure Stories">
                                 </div> <span style="font-size:0.9rem;padding-left:0.5rem;margin-right:1px;"> <b>STORIES</b></span>
                        </a>
                    </li>
                    @endif
                    
                 
                    </ul>
                        <hr>
                        <div class="text-center kt-visible-tablet-and-mobile" style="height: 150px; margin-top:200px;">
                            @if(isset($user) && !$user)
                            <a href="/login" class="btn btn-default text-white" style="background:transparent !important;">LOGIN</a>
                            <a href="/sign-up" class="btn btn-green"><span class="text-white">SIGN UP</span></a>
                            <hr>
                            @endif
                            <a  target="_blank" href="https://www.facebook.com/avanturistic">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ url('/img/social/fb-white.svg') }}"  data-srcset="{{ url('/img/social/fb-white.svg') }}" alt="Avanturistic on Facebook" style="width: 30px; height: 30px;">
                            </a>
                            <a target="_blank" href="https://www.instagram.com/avanturistic.com.app">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ url('/img/social/instagram-white.svg') }}" data-srcset="{{ url('/img/social/instagram-white.svg') }}" alt="Avanturistic on Instagram"  style="width: 30px; height: 30px;margin-left:1px;margin-right: 2px;">
                            </a>

                            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.omnitask.avanturistic">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ url('/img/social/google-play-white.svg') }}" data-srcset="{{ url('/img/social/google-play-white.svg') }}" alt="Avanturistic on Instagram"  style="width: 25px; height: 25px;">
                            </a>

                        </div>
                   

            </div>
        </div>

        <!-- end: Header Menu -->

        <!-- begin:: Header Topbar -->
 

        <!-- end:: Header Topbar -->
    </div>
</div>

<!-- end:: Header -->

            <!-- end:: Header -->

            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body" style="background-color:#fbfbfb;padding: 0;">
                <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="position:relative;padding: 0;">
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="padding:0;">
                        @yield('content')
                    </div>
                    <!-- end:: Content -->
                </div>
            </div>
            @if(!isset($disableFooter))
            <!-- begin:: footer -->
                @include('shared.footer')
            <!-- end:: footer -->
            @endif
        </div>
    </div>
</div>


<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#366cf3",
                "light": "#ffffff",
                "dark": "#041734",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<script src="{{ url(mix('/dist/js/libs.min.js')) }}"></script>
 
@if(isset($scripts))
    @foreach($scripts as $key => $value)
        <script src="{{$value}}"></script>
    @endforeach
@endif

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    window.pageHostname = '{{ url('/') }}';

</script>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '445067332826256',
            cookie: true,
            xfbml: true,
            version: 'v6.0'
        });
        FB.AppEvents.logPageView();

    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script>
function checkLoginState() {
    if (window.auth_check === 'false') {
        FB.getLoginStatus(function (response) {
            console.log(response)
            if (response.status === 'connected') {
                FB.api(
                    "/" + response.authResponse.userID + "?fields=email,name",
                    function (userResponse) {
                        console.log(userResponse)
                        if (userResponse && !userResponse.error) {
                            $.ajax({
                                'method': 'POST',
                                'url': '/fbLogin',
                                'data': {email: userResponse.email, name: userResponse.name, fb_id: userResponse.id},
                                success: function (data) {
                                    window.auth_check = true;
                                    window.location = '/';
                                },
                                error: function (data) {

                                }
                            })
                        }
                    }
                );
            }
        });
    }

}
 
 
    document.addEventListener("DOMContentLoaded", function() {
        var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

        if ("IntersectionObserver" in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.srcset = lazyImage.dataset.srcset;
                        lazyImage.classList.remove("lazy");
                        lazyImage.classList.add("lazyloaded");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            });

            lazyImages.forEach(function(lazyImage) {
                lazyImageObserver.observe(lazyImage);
            });
        } else {
            // Possibly fall back to event handlers here
        }
    });
</script>
 
</body>
</html>
