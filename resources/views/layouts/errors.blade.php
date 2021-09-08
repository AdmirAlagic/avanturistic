<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="title" content="Avanturistic">
    <meta name="author" content="Admir Alagić">
    <meta property="og:site_name" content="Avanturistic.com">

    <meta name="google" value="notranslate" />
    <title>{{  config('app.name', 'Avanturistic')  }} {{ isset($pageTitle) ? ' | ' .$pageTitle : '' }}</title>
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

    <link href="/dist/css/style.css" rel="stylesheet" type="text/css" media="all" />
    <!-- Leaflet from CDN-->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.css"
          integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
          crossorigin="">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <!-- Styles -->
    <link rel="stylesheet" href="/leaflet/fullscreen/Control.FullScreen.css">
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
    <link href="{{ mix('dist/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('dist/css/responsive.css') }}" rel="stylesheet">

</head>

<div id="app" class="kt-grid kt-grid--hor kt-grid--root">

    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">


            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body" style="padding: 0;">
                <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="position:relative;padding: 0;">
                    <!-- begin:: Content -->
                    <div class="kt-container  kt-grid__item kt-grid__item--fluid">
                        @yield('content')
                    </div>
                    <!-- end:: Content -->
                </div>
            </div>

    </div>
</div>


</body>
</html>
