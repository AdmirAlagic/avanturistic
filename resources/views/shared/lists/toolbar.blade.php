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
   
  </style>
<div  class="flex justify-end items-center"  id="filter-toolbar">
        <span class="text-left  img-fade-hover">
            <a  href="#" class=" aquireLocation" style="font-size:1em;padding: 5px;  -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">
            <i class="fa fa-map-marker-alt text-green refresh-loc-icon" style="font-size:1.4rem;"></i> 
                <span class="loading-spinner-loc" style="margin-right:30px;display:none;">
                    <span class="kt-spinner kt-spinner--left  kt-spinner--primary"></span>
                </span>
                <span class="text-muted" style="font-weight: 400;font-size:1.1rem;">Update Location</span>
            </a>
        </span>
        <span class=" text-right  ">
            <a href="#" class="dropdown-toggle text-muted img-fade-hover"  id="dropdownSort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="padding: 10px;z-index:998;">
                <span class="category-sort " style="font-weight: normal;font-size:1.1rem;">
                    Latest
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right"  x-placement="left-start" aria-labelledby="dropdownSort" style="padding-top: 0;padding-bottom: 0;background: none;z-index:2;">

                <ul id="sortBy" style="background:white;">

                    <li class="sortBy active" data-sort="date" style="">
                        <a href="#" data-sort="date" class="text-muted">
                            <span>Latest</span>
                            <br>
                            <small>Show latest adventures.</small>
                        </a>
                    </li>
                    <li class="sortBy" data-sort="distance">
                        <a href="#" class="text-muted">
                            <span>Near Me</span>
                            <br>
                            <small>Show adventures nearest to your location. <br>To get more precise distances from your current location enable location services and use "Update location".</small>
                        </a>
                    </li>
                </ul>
            </div>
        </span>
       
        <span class="btn text-right">
            @if(isset($hasCategoryFilter))
            <a class="show-filters img-fade-hover {{ $selectedCategory ?  'active' : 'inactive' }}" href="#"   class="text-dark" style="font-size:1rem;margin-right:2px;">
            <img src="{{ $selectedCategory ?  url('img/filter-active.svg') : url('img/filter.svg')}}" width="26" height="26" style="height:26px;" alt="Show grid">
            </a>
            @endif
 
            <a class="layoutStyle  img-fade-hover active" href="#" data-sort="details" class="text-dark">
                <img src="/img/details_layout.svg" width="23" height="23" style="height:23px;" alt="Show grid">
            </a>

            <a class="layoutStyle  img-fade-hover" href="#" data-sort="simple" class="text-dark">
                <img src="/img/grid_layout.svg" width="23" height="23" style="height:23px;" alt="Show grid">
            </a>

        </span>
</div>
@if(isset($hasCategoryFilter))
<div class="swiper-categories-container" style=" {{ $selectedCategory ?  '' : 'display:none;' }}">
    <div class="kt-container " style=" overflow:hidden;position:relative;  z-index:1; padding-right:30px; border-bottom: 1px solid #f6f6f6;" id="categories-filter">
        
        <div class="swiper-categories " style="height: 80px;padding-top: 8px;">
            <div class="swiper-wrapper" style="margin-left:30px;">
                @foreach($badges as $key => $val)
                    <div class="swiper-slide text-center" style="background:transparent;" >
                        <div class="profile-badges profile-badge {{ $selectedCategory  == $key ?  'active' : 'inactive' }}" data-key="{{ $key }}" style="cursor: pointer;margin-bottom:5px;">
                            <div class="badge-wrap" style=" border:3px solid {{ $val['color'] }};background: #474747;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 40px; height: 40px;margin-left: auto; margin-right: auto;padding: 5px;">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ $badges[$key]['icon_empty'] }}" data-srcset="{{ $badges[$key]['icon_empty'] }}" width="22" height="22">
                            </div>
                            <div>
                                <span style="white-space: nowrap;font-size:0.9rem;"><b>{{ $val['name'] }}</b></span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- <div class="swiper-slide text-center" style="background:transparent;" style="width:25px;" >
                        
                    </div> -->
            </div>
        </div>
        <div class="swiper-button-prev text-gray"></div>
        <div class="swiper-button-next  text-gray"></div>
        <div class="fade" style="background-image: linear-gradient(to bottom, transparent, black);width:30px;height:100%;position:absolute;right:0;top:0;">
        </div>
    </div>
    <div class="profile-badges profile-badge text-center" id="reset-filters" data-key="reset" style="z-index:3;{{ $selectedCategory ?  '' : 'display:none;' }}">

        <div class="btn text-white " style="cursor:pointer;padding:5px;font-size:0.8em;margin-bottom:10px;margin-top:10px;background:#474747;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px !important;">
            &nbsp;<i class="fa fa-times"></i> Reset 
        </div>

    </div>
</div>

@endif