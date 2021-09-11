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

@if(isset($mixStyles))
    @foreach($mixStyles as $key => $value)
        <link  href="{{mix(url($value)) }}" rel="stylesheet" media="all">
    @endforeach
@endif

</head>

<body style="background:#fff;" class=" kt-header--fixed kt-header-mobile--fixed">
@if(isset($user) && $user)
        <input type="hidden" name="loged_user" id="loged_user" value="{{ $user->email }}">
    @endif
    <script>
console.log(document.getElementById('loged_user').value)
</script>
<!-- begin:: Header Mobile -->
@if(!isset($disableHeader))

<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    {{-- <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
    </div> --}}
    <div class="kt-header-mobile__logo" style="min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;margin-right:8px;">
      
        <a href="/" class="flex items-center"  title="Avanturistic.com">
            <img  src="{{ url('/img/logo.svg') }}" style="width:30px !important;" alt="avanturistic.com" title="Avanturistic" /> 
            @if(isset($mobileTitle) && $mobileTitle && Auth::check())
                <span style="margin-left: 10px;">
                {{ str_replace('', '', $mobileTitle) }}
                </span>
            @else
            <span class="logo-text" style="font-weight:500;margin-left:10px;">
                Avanturistic
            </span>
            @endif
        </a>
       

    </div>
    <div class="kt-header-mobile__toolbar" style="color:#f8f8fb;">
        @if(isset($user) && $user)

                <div class="kt-header__topbar-item kt-header__topbar-item--user">

                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" st>

                        @if($user->avatar && $user->avatar != '' && $user->avatar != ' ')
                            <span class="kt-header__topbar-icon "><img style="border-width: 2px;width:36px;border-color:#474747;" class="img-circle" alt="{{ $user->name }}" src="{{ $user->avatar }}" /></span>
                        @else
                            <div style="padding-top: 6px;" class="post-avatar img-circle "><b class=" text-white">{{ ucfirst($user->name[0]) }}</b></div>
                        @endif

                    </div>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-sm" >

                        

                        <!--begin: Navigation -->
                        <div class="kt-notification">
                            @if($user->group == 'admin')
                                <a href="/admin" class="kt-notification__item">
                                    <div class="kt-notification__item-icon" style="padding-left:5px;">
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
                                    <div class="kt-notification__item-icon" style="padding-left:5px;">
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
                                            <b>View Profile</b>
                                        </div>

                                    </div>
                                </a>
                                <a href="/profile" class="kt-notification__item">
                                    <div class="kt-notification__item-icon" style="padding-left:7px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect opacity="0.200000003" x="0" y="0" width="24" height="24"/>
                                                <path d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z" fill="#000000" opacity="0.3"/>
                                                <path d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z" fill="#000000"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Profile Settings</b>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Edit profile preferences
                                        </div>
                                    </div>
                                </a>
                                <a href="/my-adventures" class="kt-notification__item">
                                    <div class="kt-notification__item-icon" style="padding-left:2px;">
                                        <img src="/img/triangles-black.svg" alt="My Adventures" style="width:24px;" width="24">
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>My Adventures</b>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Manage your adventures
                                        </div>
                                    </div>
                                </a>
                             {{--    <a href="/my-timelapses" class="kt-notification__item">
                                    <div class="kt-notification__item-icon" style="padding-left:2px;">
                                        <img src="/img/reel.svg" alt="My Timelapses" style="height:22px;">
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>My Timelapses</b>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Manage your timelapses
                                        </div>
                                    </div>
                                </a> --}}
                            <div class="kt-notification__custom kt-space-between">
                                {!! Form::open(['route' => 'logout','method' => 'POST', 'onclick' => 'signOutGoogle()']) !!}
                                <button class="btn  btn-xs" style="margin-left:-15px;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                        <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                        <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                                    </g>
                                </svg>
                                Sign Out
                                </button>
                                
                                {!! Form::close() !!}
                            </div>
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
                    <Fpan>
                    </a>
                </div>
            @endif
            @if(Request::segment(1) != 'register')
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
        <div {{ isset($disableHeader) ? 'style=padding-top:0px;' : '' }} class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" >
            @if(!isset($disableHeader))
                @include('shared.header')
            @endif
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-scroll" id="kt_content" style="position:relative;padding-bottom: 0px;">
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
