<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"> <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/> <meta name="author" content="Admir Alagić"> <meta property="og:site_name" content="Avanturistic.com"> <meta property="og:type" content="website"/> <meta name="google" value="notranslate"/> <meta name="googlebot" content="index,follow,noodp" /><meta name="robots" content="index,follow,noodp"> <meta name="language" content="English"> <meta http-equiv="content-language" content="en"> <meta name="csrf-token" content="{{csrf_token()}}"> <meta name="mobile-web-app-capable" content="yes"> <meta property="fb:pages" content="108753130584073"/> <meta name="application-name" content="Avanturistic"/> <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/apple-touch-icon-57x57.png"/> <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/apple-touch-icon-114x114.png"/> <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/apple-touch-icon-72x72.png"/> <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/apple-touch-icon-144x144.png"/> <link rel="apple-touch-icon-precomposed" sizes="60x60" href="/apple-touch-icon-60x60.png"/> <link rel="apple-touch-icon-precomposed" sizes="120x120" href="/apple-touch-icon-120x120.png"/> <link rel="apple-touch-icon-precomposed" sizes="76x76" href="/apple-touch-icon-76x76.png"/> <link rel="apple-touch-icon-precomposed" sizes="152x152" href="/apple-touch-icon-152x152.png"/> <link rel="icon" type="image/png" href="/favicon-196x196.png" sizes="196x196"/> <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96"/> <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32"/> <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16"/> <link rel="icon" type="image/png" href="/favicon-128.png" sizes="128x128"/> <meta name="msapplication-TileColor" content="#FFFFFF"/> <meta name="msapplication-TileImage" content="/mstile-144x144.png"/> <meta name="msapplication-square70x70logo" content="/mstile-70x70.png"/> <meta name="msapplication-square150x150logo" content="/mstile-150x150.png"/> <meta name="msapplication-wide310x150logo" content="/mstile-310x150.png"/> <meta name="msapplication-square310x310logo" content="/mstile-310x310.png"/> <meta property="fb:app_id" content="445067332826256" > <meta name="theme-color" content="#000000"> <link rel="manifest" href="/site.webmanifest">

    <title>{{ isset($pageTitle) && $pageTitle != '' ?  $pageTitle . ' • Avanturistic'  : '' }}</title>
    <meta name="title" content="{{ isset($pageTitle) && $pageTitle ? $pageTitle : '' }}">
    <meta name="description" content="{{ isset($pageDescription) && $pageDescription ? $pageDescription : 'Explore & share Outdoor adventures locations, photos and videos and get involved in creating the world map of outdoor adventures!' }}">
    <meta name="image" content="{{ isset($pageImage) ? $pageImage : url('/img/avanturistic.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="logo" type="image/svg" href="{{ url('/img/logo.svg') }}"  >

    <!-- Styles -->
    <link rel="preload" href="{{ url('/dist/css/fonts/fa-solid-900.woff2') }}" as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"  onload="this.onload=null;this.rel='stylesheet'" as="style"   href="{{ url('/js/libs/swiper/swiper.min.css') }}">
    <link rel="preload"  onload="this.onload=null;this.rel='stylesheet'" as="style"   href="{{ url('/dist/css/swal2.css') }}">
    <link rel="preload"  onload="this.onload=null;this.rel='stylesheet'" as="style"  href="{{ (mix('/dist/css/preload.min.css')) }}" media="all">
    <link rel="stylesheet"  href="{{ (mix('/dist/css/style.min.css')) }}" rel="stylesheet" media="all">
    <link  rel="preload"  onload="this.onload=null;this.rel='stylesheet'" as="style"  href="{{ url('/leaflet/fullscreen/Control.FullScreen.css') }}" media="screen">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <style>
        .leaflet-editing-icon{
            background:#FFFFFF;
            border-radius:8px;
        }
        path{stroke-dasharray: 30, 5 !important;}
    </style>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;1,700&family=Delius+Swash+Caps&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sriracha&display=swap" rel="stylesheet">
    <script>
        window.auth_check = '{{ isset($user)  && $user ? "true" : "false"}}'
    </script>
    <link rel="alternate" href="android-app://com.omnitask.avanturistic/https/avanturistic.com/{{ str_replace('https://avanturistic.com/', '',url()->current()) }}" />
    @if(isset($keywords) && $keywords)
        <meta name="keywords" content="{{ $keywords }}">
    @else
        <meta name="keywords" content="{{ isset($post->title) ? $post->title .' ,' : '' }} {{ isset($post->address) ? $post->address .' ,' : '' }} avanturistic, adventure outdoor, outdoor adventure photos, outdoors activity near me, outdoor adventure videos, outdoor adventures, adventure outdoors, outdoors, outdoor activity near me,  adventures near me, fun adventures near me, avanturistički, adventure stories, personal outdoor experiences, discover new travel destinations,  adrenaline tourism, rare locations, sport, travel photos, travel videos, travel blog, extreme sports, travel,  adventourist, adventoruous, turist, tourism, adventures outdoors,  share adventures, explore, hiking, traveling, seasight {{isset($badges_kewords) ? $badges_kewords : ''}} ">
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.16/moment-timezone-with-data.min.js"></script>
    @if (isset($meta))
    @foreach ($meta as $key => $obj)<meta property="{{$key}}" content="{{ $obj }}" />
    @endforeach
    @else
    <meta property="og:title" content="{{ isset($pageTitle)? $pageTitle : 'Avanturistic' }}">
    <meta property="og:description" content="{{ isset($pageDescription) ? $pageDescription : 'Explore & share Outdoor adventures locations, photos and videos and get involved in creating the world map of outdoor adventures!' }}">
    <meta property="og:image" content="{{ isset($pageImage) ? $pageImage : url('/img/avanturistic.jpg') }}">
    @endif

    @if(isset($post) && $post)
    <meta property="og:type" content="article" />
    <meta property="article:published_time" content="{{ $post->created_at }}" />
    <meta property="article:modified_time" content="{{ $post->updated_at }}">
    @else
        <meta property="og:type" content="website" />
    @endif
    @if(isset($styles))
        @foreach($styles as $key => $value)
            <link rel="stylesheet" href="{{$value}}"/>
        @endforeach
    @endif

    <script>
        window.pageHostname = '{{ url('/') }}';
        window.swipersList = [];
    </script>
    @if(isset($user))
        <script>
            window.auth_user_id = '{{ $user ? $user->id : null }}'
        </script>
            
    @endif
   

    @if(config('app.debug') == false && ((!isset($user) || !$user) || (($user && $user->email != 'admir@omnitask.ba') &&  ($user && $user->group != 'admin'  && $user->group != 'moderator'))))
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-29252906-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-29252906-1');
        </script>
    @endif
    @if (Route::current() && Route::current()->uri() != '/')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
        <script data-ad-client="ca-pub-5528772671541930" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    @endif
    @if(isset($post) && $post)
        <script type="application/ld+json">
         {
          "@context": "https://schema.org",
          "@type": "NewsArticle",
          "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ url()->current() }}"
          },
          "headline": "{{ $post->title }}",
          "image": "{{ isset($post->image[0]['path']) ? url($post->image[0]['path']) : ''  }}",
          "datePublished": "{{ $post->created_at }}",
          "dateModified": "{{ $post->updated_at }}",
          "author": {
            "@type": "Person",
            "name": "{{ $post->user->name }}"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Avanturistic",
            "logo": {
              "@type": "ImageObject",
              "url": "https://avanturistic.com/img/logo.png"
                }
            }
        }
        </script>
    @endif
    @if(isset($activity->options['structured_data']))
        {!! $activity->options['structured_data'] !!}
    @endif
  
@if(isset($pageLinkPrev) && $pageLinkPrev)
<link rel="prev" href="{{ $pageLinkPrev }}" />
@endif
@if(isset($pageLinkNext) && $pageLinkNext)
<link rel="next" href="{{ $pageLinkNext }}" />
@endif
@if(Request::path()  == '/')
<link rel="preconnect" href="https://a.tile.openstreetmap.org">
<link rel="preconnect" href="https://b.tile.openstreetmap.org">
<link rel="preconnect" href="https://c.tile.openstreetmap.org">
    @if(isset($post) && $post)
    <link rel="preconnect" href="https://ajax.googleapis.com">
    <link rel="preconnect" href="https://googleads.g.doubleclick.net">
    
    @endif
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://www.google-analytics.com"> 
@endif
<meta  rel="preconnect" href="https://images.unsplash.com/">
@if(isset($mixStyles))
    @foreach($mixStyles as $key => $value)
        <link  href="{{mix(url($value)) }}" rel="stylesheet" media="all">
    @endforeach
@endif

</head>

<body style="background:#fff;" class=" kt-header--fixed kt-header-mobile--fixed"  >
@if(isset($user) && $user)
        <input type="hidden" name="loged_user" id="loged_user" value="{{ $user->email }}">
    @endif
    <script>
console.log(document.getElementById('loged_user').value)
</script>
<!-- begin:: Header Mobile -->
@if(!isset($disableHeaderMobile))

    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed kt-header--minimize">
        {{-- <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
        </div> --}}
        <div class="kt-header-mobile__logo" style=" margin-right:8px;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
        
                @if(isset($backUrl))
                    <a href="{{ $backUrl }}" class="btn pl-0">
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:16px" fill="none" viewBox="0 0 24 24" stroke="#636363">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                @else
                    <img  src="{{ url('/img/logo.svg') }}" style="width:30px !important;" alt="avanturistic.com" title="Avanturistic" /> 
                @endif
                @if(isset($mobileTitle) && $mobileTitle)
                    <h2 style="margin-left: 10px;min-width:0;overflow: hidden; text-overflow: ellipsis; white-space: nowrap;font-size:1.2rem;margin: 0; margin-left: 10px;font-weight:300;">
                        {{ str_replace('', '', $mobileTitle) }}
                    </h2>
                @else
                    <a href="/" class="flex items-center"  title="Avanturistic.com" style="">
                        <span class="logo-text" style="font-weight:500;margin-left:10px;">
                            Avanturistic
                        </span>
                    </a>
                @endif
        
        

        </div>
        <div class="kt-header-mobile__toolbar" style="color:#f8f8fb;">
            @if(isset($user) && $user)

                    <div class="kt-header__topbar-item kt-header__topbar-item--user">

                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" st>

                            @if($user->avatar && $user->avatar != '' && $user->avatar != ' ')
                                <span class="kt-header__topbar-icon "><img style="border-width: 1px;width:30px;border-color:#474747;" class="img-circle" alt="{{ $user->name }}" src="{{ $user->avatar }}" /></span>
                            @else
                                <div   class="post-avatar flex items-center justify-center "><b class=" text-white">{{ ucfirst($user->name[0]) }}</b></div>
                            @endif

                        </div>
                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-sm" >

                            

                            <!--begin: Navigation -->
                            <div class="kt-notification" style="z-index:999;">
                                @if($user->group == 'admin')
                                    <a href="/admin" class="kt-notification__item">
                                        <div class="kt-notification__item-icon items-center justify-center items-center justify-center" style="">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon" style="margin:0;margin-top:0.6em;">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.5"/>
                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                <b>Admin</b>
                                            </div>

                                        </div>
                                    </a>
                                @endif
                                    <a href="/{{ '@' .$user->name_slug}}" class="kt-notification__item">
                                        <div class="kt-notification__item-icon items-center justify-center items-center justify-center" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                              </svg>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Profile
                                            </div>

                                        </div>
                                    </a>
                                    <a href="/profile" class="kt-notification__item">
                                        <div class="kt-notification__item-icon items-center justify-center items-center justify-center" style="">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                              </svg>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Settings
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Edit profile preferences
                                            </div>
                                        </div>
                                    </a>
                                    <a href="/my-adventures" class="kt-notification__item">
                                        <div class="kt-notification__item-icon items-center justify-center items-center justify-center" style="">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                              </svg>
                                        </div>
                                        <div class="kt-notification__item-details">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                Adventures
                                            </div>
                                            <div class="kt-notification__item-time">
                                                Manage your adventures
                                            </div>
                                        </div>
                                    </a>
                                
                                    <a href="/logout" class="kt-notification__item">
                                        <div class="kt-notification__item-icon items-center justify-center items-center justify-center" >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                              </svg>
                                        </div>
                                        <div class="kt-notification__item-title">
                                            <div class="kt-notification__item-title kt-font-bold">
                                                {!! Form::open(['route' => 'logout','method' => 'POST']) !!}
                                                <button class="btn  btn-xs" style="padding-left:0;font-weight:500;">
                                            
                                                Log out
                                                </button>
                                                {!! Form::close() !!}
                                            </div>
                                            
                                        </div>
                                    </a>
                            </div>

                            <!--end: Navigation -->
                        </div>
                    </div>
            @else
                @if(Request::segment(1) != 'login')
                    <div class=" kt-header__topbar-item  kt-hidden-desktop " style=" justify-content: center;" >
                        <a style="display: inline-flex;align-items:center;" href="/login"  >
                        <span class=" kt-header__topbar-wrapper " style="padding-left:5px; ">


                            <span style="white-space: nowrap; margin-right:10px;color:#3C3C3C;font-size:1rem;"><b>LOGIN</b></span>
                        <span>
                        </a>
                    </div>
                @endif
                @if(Request::segment(1) != 'register' && Request::segment(1) != 'sign-up')
                    <div class=" kt-header__topbar-item  kt-hidden-desktop " style="border-left:1px solid #f8f8fb;justify-content: center;" >
                        <a style="display: inline-flex;align-items:center;" href="#" data-toggle="modal" data-target="#signUpModal" >
                        <span class=" kt-header__topbar-wrapper " style="padding-left:5px; ">

                            <span style="white-space: nowrap;margin-left:5px; color:#3C3C3C;font-size:1rem;"><b>SIGN UP</b></span>
                        </span>
                        </a>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endif
<div class="kt-grid kt-grid--hor kt-grid--root">
    @if(isset($user) && $user)
        <div id="app">
            <messages-component></messages-component>
        </div>
    @endif
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver">
        <div {{ isset($disableHeaderMobile) ? 'style=padding-top:0px;' : '' }} class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" >
            @if(!isset($disableHeader))
                @include('shared.header')
            @endif
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor " id="kt_content" style="position:relative;padding-bottom: 0px;">
                    <!-- begin:: Content -->

                        @yield('content')
                        <div id="overlay-loading" style="z-index:9999;">
                            <div class="text-center" style="margin-left:-24px;">
                                <span class="kt-spinner kt-spinner--left kt-spinner--sm kt-spinner--light"></span>
                            </div>
                        </div>
                <!-- end:: Content -->
                </div>
            </div>
            @if(!isset($disableFooter) && (isset($isWebView) &&  !$isWebView))
                <!-- begin:: footer -->
                @include('shared.footer')
                <!-- end:: footer -->
                @else
                <div style="min-height:45px;"></div>
            @endif
        </div>
    </div>
        <!-- Modal -->
<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
 
    <div class="modal-content">
    <button type="button" class="btn btn-icon" style="position:absolute;top:0;right:0;z-index:2;" data-dismiss="modal"><i class="fa fa-times text-gray"></i></button>
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
      <div class="modal-body padding0">
       @include('shared.signup')
      </div>
       
    </div>
  </div>
</div>
</div>

<script>
    var KTAppOptions = {

    };
</script>
 
<script src="{{ url(mix('/dist/js/libs.min.js')) }}"></script>


<script defer src="https://unpkg.com/esri-leaflet@2.3.0/dist/esri-leaflet.js"
        integrity="sha512-1tScwpjXwwnm6tTva0l0/ZgM3rYNbdyMj5q6RSQMbNX6EUMhYDE3pMRGZaT41zHEvLoWEK7qFEJmZDOoDMU7/Q=="
        crossorigin=""></script>
@if (Route::current() && Route::current()->uri() != '/')
<script defer src="{{ url('/js/libs/jquery.validate.min.js') }}"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.67.0/src/L.Control.Locate.min.js"></script>
        <script defer src="{{ url('/js/libs/spotlight/spotlight.min.js') }}"></script>
      
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    @if(isset($post) && $post)
    
       
  
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Kaushan+Script:100,400,400i,700' ] }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>
    @endif
@endif
<script>
    var tz = moment.tz.guess();
    if(tz !== undefined){
            $.ajax({
            url: '/set-timezone',
            method: 'POST',
            dataType:'json',
            data: {timezone:tz},
            success:function(response){
            
            },
        
        });
        
    }
    
</script>
<script defer src="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.js"
        integrity="sha512-uK5jVwR81KVTGe8KpJa1QIN4n60TsSV8+DPbL5wWlYQvb0/nYNgSOg9dZG6ViQhwx/gaMszuWllTemL+K+IXjg=="
        crossorigin=""></script>

<script defer src="{{ url('/js/libs/swiper/swiper-bundle.min.js') }}"></script>

@if(isset($scripts))
    @foreach($scripts as $key => $value)
        <script src="{{ url($value) }}"></script>
    @endforeach
@endif

@if(isset($mixScripts))
    @foreach($mixScripts as $key => $value)
        <script src="{{mix($value)}}"></script>
    @endforeach
@endif

@if(isset($user) && $user)
<script src="{{ url(mix('/dist/js/vue.js')) }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

        if ("IntersectionObserver" in window) {
            let lazyImageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.srcset = lazyImage.dataset.srcset;
                       
                        lazyImage.addEventListener('load', function() {
                            lazyImage.classList.remove("lazy");
                            lazyImage.classList.add("lazyloaded");
                        });
                       
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
    function signOutGoogle() {
        
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            window.location = '/';
        });
    }
</script>
<script defer src="{{ url('/leaflet/markerCluster/leaflet.markercluster.js') }}"></script>
</body>
</html>
