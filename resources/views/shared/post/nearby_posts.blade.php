@if(count($nearbyPosts))

    <div class="kt-portlet" style="margin-bottom:0px;">
        <div class="kt-portlet__head" style="border-bottom:1px solid #eee;">
            <div class="kt-portlet__head-label" style="width:100%;">
                                                        <span class="kt-portlet__head-icon">
                                                            <i class="fa fa-map-signs text-success"></i>
                                                        </span>
                <h4 class="text-center kt-portlet__head-title text-capitalize" style="width:100%;">
                    @if(isset($mainActivity) && $mainActivity)
                    <b>{{ ucfirst($mainActivity)}} adventures near this location</b>
                    @else
                        <b>Outdoor adventures near this location</b>
                    @endif
                </h4>
            </div>
        </div>
        <div class="kt-portlet__body" style="padding:0;">
            <div class="row" style="margin-left:-1px;margin-right:-1px;margin-bottom:-1px;overflow: hidden;">
                {{-- @foreach($nearbyPosts as $obj)
                
                    @if($obj->image)
                        @php $image = json_decode($obj->image);@endphp
                        @if(isset($image[0]))
                        <div class="col-6 col-sm-3 overflowH postImg" style="position:relative;padding: 1px;">
                            <a href="/adventure/{{ $obj->id }}/{{ $obj->slug }}" class="loading ">
                                <img  src="{{ url(isset($image[0]->placeholder) ? $image[0]->placeholder : '/img/placeholder-trans.png') }}" data-src="{{ url($image[0]->thumb_path) }}" data-srcset="{{ url($image[0]->thumb_path) }}" class="img-fade-hover lazy"  alt="{{ $obj->title }} {{ $obj->address }}">
                                <div style="position:absolute;top:1px;right:1px;">
                                    
                                    @if(isset($obj->distance))
                                        <p class="text-white text-right" style="margin-bottom:1px;padding-left:10px;padding-right:10px; background-color: #474747;">
                                            <small style="font-size:0.8em;">
                                                {{ number_format($obj->distance, 2, '.', '') }} km
                                                &nbsp;<i class="fa fa-location-arrow"></i>
                                            </small>
                                        </p>
                                    @endif

                                </div>
                            </a>
                        </div>
                        @endif
                    @endif
                @endforeach --}}
                <div class="swiper-container nearby-swiper" style="width:100%; height: auto; ">
                    <div class="swiper-wrapper "  data-page="false" data-autohide="false" data-zoom="false" data-infinite="true" data-fullscreen="false" data-autofit="false" style="position:relative;">
                        @foreach($nearbyPosts as $obj)
                        
                            @if($obj->image)
                                @php $image = json_decode($obj->image);@endphp
                                @if(isset($image[0]))
                                    <div class="swiper-slide " style="position:relative;z-index:2;min-height:200px; {{ count($post->image) == 1 ? 'border-bottom:3px solid #474747;' : '' }}">
                                        <a href="/adventure/{{ $obj->id }}/{{ $obj->slug }}" class="loading img-hover-zoom">
                                        <img style="width:100%;" src="{{ url(isset($image[0]->placeholder) ? $image[0]->placeholder : '/img/placeholder-trans.png') }}" data-src="{{ url($image[0]->thumb_path) }}" data-srcset="{{ url($image[0]->thumb_path) }}" class="swiper-lazy" > 
                                       
                                        @if($obj->title)
                                            <div class="  flex items-center" style="bottom:-13px;position:absolute;left:0px;width:100%;">
                                                
                                                <div class=" overflow-dots k-font text-white" style="padding:0.5rem 1rem;font-size: 1.2rem; height:40px;background-color: #000000;"> 
                                                    @if($obj->title)<b>{{ Str::limit($obj->title, 56) }}  @endif 
                                                    </b>
                                                </div>  
                                                @if(isset($obj->distance))
                                                <div class="text-white text-right " style="padding:0.5rem 1rem;width:42%; height:40px;background-color: #000000;">
                                                    <small style="font-size:0.8em;">
                                                        {{ number_format($obj->distance, 2, '.', '') }} km
                                                        &nbsp;<i class="fa fa-location-arrow"></i>
                                                    </small>
                                                </div>
                                            @endif
                                            </div>
                                        @endif
                                        

                                    </a>
                                    <div class="swiper-lazy-preloader"></div>
                                    </div>
                                     
                                @endif
                            @endif
                        @endforeach
                    </div>
                    @if(count($nearbyPosts) > 1)
                    <div class="swiper-button-prev text-white"></div>
                    <div class="swiper-button-next  text-white"></div>
                    @endif
                </div>
               
            </div>
             
            @if($isMobile && !$isWebView)
                <a class="text-center" style="margin:10px;width:100%;" href="android-app://com.omnitask.avanturistic/https/avanturistic.com/{{ str_replace('https://avanturistic.com/', '',url()->current()) }}">Open In App</a>
            @endif
        </div>
    </div>
@endif