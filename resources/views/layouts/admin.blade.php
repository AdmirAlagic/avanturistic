<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Avanturistic">
    <meta name="description" content="Avanturistic is community where you can explore & share adventures and events,  exchange tourist/host based informations with like-minded people  and expand your social circles.">
    @php $badges_kewords = '';@endphp
    @if(isset($badges))
        @foreach($badges as $key => $val)
            @php $badges_kewords .= ', '.str_replace('-',' ', $val['name']); @endphp
        @endforeach
    @endif

    <meta name="keywords" content="adventure, adventurist, turist, tourism, photos, facebook login, google login, social-network, social, share, explore, hiking, traveling, seasight {{isset($badges_kewords) ? $badges_kewords : ''}} ">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Avanturistic') }}</title>

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">        <!--end::Fonts -->

    
    <link rel="preload"  onload="this.onload=null;this.rel='stylesheet'" as="style"  href="{{ (mix('/dist/css/preload.min.css')) }}" media="all">
    <link rel="stylesheet"  href="{{ (mix('/dist/css/style.min.css')) }}" rel="stylesheet" media="all">
    <!-- Leaflet from CDN-->
    
    
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
  
    <script>

        window.pageHostname = '{{ url('/') }}';

    </script>
    
    {{--<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">--}}
        <style>
            .table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #eceeef;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #eceeef;
}

.table tbody + tbody {
  border-top: 2px solid #eceeef;
}

.table .table {
  background-color: #fff;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}

.table-bordered {
  border: 1px solid #eceeef;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #eceeef;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}

.table-striped tbody tr:nth-of-type(odd) {
  background-color: rgba(0, 0, 0, 0.05);
}

.table-hover tbody tr:hover {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-hover .table-active:hover > td,
.table-hover .table-active:hover > th {
  background-color: rgba(0, 0, 0, 0.075);
}

.table-success,
.table-success > th,
.table-success > td {
  background-color: #dff0d8;
}

.table-hover .table-success:hover {
  background-color: #d0e9c6;
}

.table-hover .table-success:hover > td,
.table-hover .table-success:hover > th {
  background-color: #d0e9c6;
}

.table-info,
.table-info > th,
.table-info > td {
  background-color: #d9edf7;
}

.table-hover .table-info:hover {
  background-color: #c4e3f3;
}

.table-hover .table-info:hover > td,
.table-hover .table-info:hover > th {
  background-color: #c4e3f3;
}

.table-warning,
.table-warning > th,
.table-warning > td {
  background-color: #fcf8e3;
}

.table-hover .table-warning:hover {
  background-color: #faf2cc;
}

.table-hover .table-warning:hover > td,
.table-hover .table-warning:hover > th {
  background-color: #faf2cc;
}

.table-danger,
.table-danger > th,
.table-danger > td {
  background-color: #f2dede;
}

.table-hover .table-danger:hover {
  background-color: #ebcccc;
}

.table-hover .table-danger:hover > td,
.table-hover .table-danger:hover > th {
  background-color: #ebcccc;
}

.thead-inverse th {
  color: #fff;
  background-color: #292b2c;
}

.thead-default th {
  color: #464a4c;
  background-color: #eceeef;
}

.table-inverse {
  color: #fff;
  background-color: #292b2c;
}

.table-inverse th,
.table-inverse td,
.table-inverse thead th {
  border-color: #fff;
}

.table-inverse.table-bordered {
  border: 0;
}

.table-responsive {
  display: block;
  width: 100%;
  overflow-x: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
}

.table-responsive.table-bordered {
  border: 0;
}
        </style>
</head>
<body  style="background-image: url(/img/background.png);background-size: auto; " class="kt-page--loading-enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header--minimize-menu kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent ">
{{--kt-header__topbar--mobile-on--}}
<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
    </div>
    <div class="kt-header-mobile__logo">
        <a href="/" class="cs-logo text-white font-weight-bold"><img  src="/img/logo.svg" style="width:25px !important;" alt=""/> Avanturistic</a>

    </div>
    <div class="kt-header-mobile__toolbar">
        @if(isset($user) && $user)
            <a class="kt-menu__link text-success" href="/share">
                <i class="fa fa-camera"></i>
            </a>

            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
        @else

            <div class="kt-header__topbar-item ">
                <div class="kt-header__topbar-wrapper">
                    <a href="/login" class="kt-header__topbar-icon" >
                         <span style="padding: 15px;">
                         <i class="fa fa-user text-white"></i>
                    </span>
                    </a>

                </div>

            </div>
        @endif
    </div>
</div>

<div id="app" class="kt-grid kt-grid--hor kt-grid--root">
    <messages-component></messages-component>
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            @include('admin.shared.header')
            <div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
                <div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                    <!-- begin:: breacrumbs -->

                    <!-- end:: breadcrumbs -->

                    <!-- begin:: Content -->
                    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="padding:5px;">
                        <br>
                        @yield('content')
                        <div id="kt_scrolltop" class="kt-scrolltop">
                            <i class="fa fa-arrow-up"></i>
                        </div>
                    </div>
                    <!-- end:: Content -->
                </div>
            </div>
            <!-- begin:: footer -->
        @include('shared.footer')
        <!-- end:: footer -->
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

<script src="/dist/metronic/assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="/dist/metronic/assets/js/scripts.bundle.js"  type="text/javascript"></script>
<!-- Load Leaflet from CDN -->
<script src="/js/libs/jquery-ui/jquery-ui.min.js"></script>
 
<script src="{{ mix('dist/js/app.js') }}" defer></script>

@if(isset($scripts))
    @foreach($scripts as $key => $value)
        <script src="{{$value}}"></script>
    @endforeach
@endif


@if(isset($mixScripts))
@foreach($mixScripts as $key => $value)
    <script src="{{mix($value)}}"></script>
@endforeach
@endif


</body>
</html>
