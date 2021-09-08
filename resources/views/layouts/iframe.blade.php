<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="title" content="Avanturistic">
    <meta name="author" content="Admir Alagić">
    <meta property="og:site_name" content="Avanturistic.com">
    <meta name="image" content="{{ url('/img/logo.png') }}">
    <meta name="google" value="notranslate" />
    <title>{{  config('app.name', 'Avanturistic')  }} {{ isset($pageTitle) ? ' | ' .$pageTitle : '' }}</title>

    @if(isset($pageDescription))
        <meta name="description" content="{{ $pageDescription }}">
    @else
        <meta name="description" content="Avanturistic is a network for adventure, where you can explore & share adventures and events,  exchange tourist/host based informations with like-minded people  and expand your social circles.">
    @endif
    @if(isset($pageImage))
        <meta name="image" content="{{ url($pageImage) }}">
    @else
        <meta name="image" content="{{ url('/img/logo.png') }}">
    @endif
    <meta http-equiv="content-language" content="en">
    <meta name="language" content="English">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
    @if (isset($meta))
        @foreach ($meta as $key => $obj)
            <meta property="{{$key}}" content="{{ $obj }}" />
        @endforeach
    @else

        <meta property="og:description" content="Avanturistic is a network for adventure, where you can explore & share adventures and events,  exchange tourist/host based informations with like-minded people  and expand your social circles.">
        <meta property="og:image" name="og:image" content="{{ url('/img/logo.png') }}">
    @endif
    @php $badges_kewords = '';@endphp
    @if(isset($badges))
        @foreach($badges as $key => $val)
            @php $badges_kewords .= ', '.str_replace('-',' ', $val['name']); @endphp
        @endforeach
    @endif

    <meta name="keywords" content="{{ isset($post->address) ? $post->address .' ,' : '' }} avanturistic, tour, avanturistic.com, travel, blog, profile, user, adventure, adventurist, turist, tourism, photos, facebook login, google login, social-network, social, share, explore, hiking, traveling, seasight {{isset($badges_kewords) ? $badges_kewords : ''}} ">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">        <!--end::Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <!--end::Fonts -->
    <link href="/dist/metronic/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/dist/metronic/assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!-- Leaflet from CDN-->
    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.css"
          integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
          crossorigin="">
    <link href="/emoji/css/emoji.css" rel="stylesheet">
    <link rel="stylesheet" href="/leaflet/markerCluster/MarkerCluster.css">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-29252906-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-29252906-1');
    </script>
    <script>
        window.auth_check = '{{ isset($user)  && $user ? "true" : "false"}}'
    </script>
    @if(isset($styles))
        @foreach($styles as $key => $value)
            <link rel="stylesheet" href="{{$value}}"/>
        @endforeach
    @endif
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" rel="stylesheet"/>
    {{--<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">--}}

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <!-- Styles -->
    <link rel="stylesheet" href="/leaflet/fullscreen/Control.FullScreen.css">


    <script>

        window.pageHostname = '{{ url('/') }}';

    </script>
    @if(isset($user))
        <script>
            window.auth_user_id = '{{ $user ? $user->id : null }}'
        </script>
    @endif
    <link href="/dist/metronic/assets/css/pages/wizard/wizard-1.css" rel="stylesheet" type="text/css" />
    <link href="{{ mix('dist/css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('dist/css/responsive.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/js/libs/glide/css/glide.core.css">
    <link rel="stylesheet" href="/js/libs/glide/css/glide.theme.css">
    <script src="/js/libs/katex.min.js"></script>
    <script src="/js/libs/highlight.min.js"></script>
</head>
<body  style="background:#fff;" class="kt-page--loading-enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent ">
{{--kt-header__topbar--mobile-on--}}
<!-- begin:: Header Mobile -->

<div id="app" class="kt-grid kt-grid--hor kt-grid--root">

    @yield('content')
</div>

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

<script src="/dist/metronic/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="/dist/metronic/assets/js/scripts.bundle.js"  type="text/javascript"></script>
<!-- Load Leaflet from CDN -->
<script src="/js/libs/jquery-ui/jquery-ui.min.js"></script>
<!-- Load Esri Leaflet from CDN -->
<script src="/leaflet/leaflet.js"></script>
<script src="/leaflet/fullscreen/Control.FullScreen.js"></script>
<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@2.3.0/dist/esri-leaflet.js"
        integrity="sha512-1tScwpjXwwnm6tTva0l0/ZgM3rYNbdyMj5q6RSQMbNX6EUMhYDE3pMRGZaT41zHEvLoWEK7qFEJmZDOoDMU7/Q=="
        crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.js"
        integrity="sha512-uK5jVwR81KVTGe8KpJa1QIN4n60TsSV8+DPbL5wWlYQvb0/nYNgSOg9dZG6ViQhwx/gaMszuWllTemL+K+IXjg=="
        crossorigin=""></script>
<!-- Glide js-->
<script src="/js/libs/glide/glide.min.js"></script>
<script src="{{ mix('dist/js/app.js') }}" defer></script>

@if(isset($scripts))
    @foreach($scripts as $key => $value)
        <script src="{{$value}}"></script>
    @endforeach
@endif

<script src="/dist/metronic/assets/js/pages/custom/chat/chat.js" type="text/javascript"></script>

{{--<script src="https://{{ Request::getHost() }}:{{env('ECHO_PORT','6009')}}/socket.io/socket.io.min.js"></script>--}}
<script src="/emoji/js/config.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.5/socket.io.min.js"></script>

<script src="/emoji/js/util.js"></script>
<script src="/emoji/js/jquery.emojiarea.js"></script>
<script src="/emoji/js/emoji-picker.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.67.0/src/L.Control.Locate.min.js"></script>
<script src="/dist/metronic/assets/js/pages/components/extended/sweetalert2.js" type="text/javascript"></script>
<script src="/leaflet/markerCluster/leaflet.markercluster-src.js"></script>

</body>
</html>
