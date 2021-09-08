@extends('layouts.iframe')

@section('content')
    <div class="map-container" style="position:relative;">
        <div class="text-center" style="position:absolute;top:0;left:48%;z-index:99999 !important;background-color: rgba(0,0,0,0.33);padding: 20px; border-bottom-left-radius: 40%;border-bottom-right-radius: 40%;" >
            <a style="" href="/"><img src="/img/logo.png" width="50" alt=""> <span class="text-white"><b>AVANTURISTIC</b></span></a>
        </div>
        <div id="map" class="home-map-mobile"  style="z-index: 0;width:100%;height:100%;"></div>
        <div class="map-control" style="position:absolute;bottom:16px;right:0px;">
            <button class="kt-pulse kt-pulse--light btn btn-pink btn-icon randomImage" style="margin:10px;-webkit-border-radius: 50% !important;-moz-border-radius: 50% !important;border-radius: 50% !important;">
                <i class="fa fa-random"></i>
                <span class="kt-pulse__ring "></span>
            </button>
        </div>
    </div>

@endsection
