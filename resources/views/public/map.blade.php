@extends('layouts.app')

@section('content')
    <!--begin::Portlet-->
    @include('shared.success_error')
    <style>
     
     .swiper-container {
      width: 100%;
      height: 100%;
      text-align:center;
    }

    .swiper-slide {
      text-align: center;
      
      background: #fff;
      width: 60px;

      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }
    
    .swiper-scrollbar {
    position: absolute;
    left: 1%;
    bottom: 3px;
    z-index: 50;
    height: 5px;
    width: 98%;
    border-radius: 10px;
    position: relative;
    -ms-touch-action: none;
    background: rgba(0,0,0,0.4);
    }
    .swiper-slide {
      width:70px;
    }
    .swiper-scrollbar-drag {
    height: 100%;
    width: 100%;
    position: relative;
    background: rgba(255,255,255,0.9);
    border-radius: 10px;
    left: 0;
    top: 0;
} 
  </style>
    <div id="home" class="text-center">

    <h1 class="text-white k-font" style="background:#474747;border-top:1px solid #3C3C3C;padding:1em;width:100%;font-weight:900;font-size:1.3rem;margin:0;"><b> <i class="fa fa-map-marker-alt text-success"></i> &nbsp;  The world map of outdoor adventures</b></h1>
    <div class="map-container" style="position:relative;left:0;wheight: 100%;
    width: 100vw;text-align: center;height:80vh;">
        <div id="world-map" class="home-map-mobile"  style="background:#f2efe9;z-index: 1;height: 100%;
    width: 100vw;margin-top:0;">
            <!--  <img src="/img/seek_for_adventure.jpg" alt="Avanturistic Background" style="width:100%;height: 90vh;object-fit: cover;">
-->
        </div>
        <div class="profile-badges profile-badge text-center" id="reset-filters" data-key="reset" style="position:absolute;left:10px;top:90px;z-index:3;display:none;">

            <span class="btn text-white " style="cursor:pointer;padding:5px;font-size:0.8em;margin-top:0;background:#474747;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px !important;">
                &nbsp;<i class="fa fa-times"></i> Reset 
            </label>

        </div>
        <div class="swiper-container " style="position:absolute;top:0;left:0;;background:#333333db;height: 80px;padding-top: 8px;">
            <div class="swiper-wrapper" style="margin-left:30px;">
                @foreach($badges as $key => $val)
                    <div class="swiper-slide text-center" style="background:transparent;" >
                        <div class="profile-badges profile-badge" data-key="{{ $key }}" style="cursor: pointer;margin-bottom:5px;">
                            <div class="badge-wrap" style=" border:2px solid {{ $val['color'] }};background: #474747;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 40px; height: 40px;margin-left: auto; margin-right: auto;padding: 7px;">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ $badges[$key]['icon_empty'] }}" data-srcset="{{ $badges[$key]['icon_empty'] }}" width="22" height="22">
                            </div>
                            <div>
                                <span class="text-white" style="white-space: nowrap;font-size:0.9rem;">{{ $val['name'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="swiper-slide text-center" style="background:transparent;" style="width:25px;" >
                         
                    </div>
            </div>
            <div class="swiper-button-prev text-white"></div>
            <div class="swiper-button-next  text-white"></div>
           <!--  <div class="swiper-scrollbar"></div> -->
        </div>
    </div>
                
    </div>
     
    </div>
 
    
@endsection
