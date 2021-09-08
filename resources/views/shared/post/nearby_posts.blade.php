@if(count($nearbyPosts))

    <div class="kt-portlet" style="margin-bottom:0px;">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label" style="width:100%;">
                                                        <span class="kt-portlet__head-icon">
                                                            <i class="fa fa-map-signs text-success"></i>
                                                        </span>
                <h4 class="text-left kt-portlet__head-title" style="width:100%;">
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
                @foreach($nearbyPosts as $obj)
                
                    @if($obj->image)
                    @php $image = json_decode($obj->image);@endphp
                    @if(isset($image[0]))
                    <div class="col-6 col-sm-3 overflowH postImg" style="position:relative;padding: 1px;">
                        <a href="/adventure/{{ $obj->id }}/{{ $obj->slug }}" class="loading ">
                            <img  src="{{ url(isset($image[0]->placeholder) ? $image[0]->placeholder : '/img/placeholder-trans.png') }}" data-src="{{ url($image[0]->thumb_path) }}" data-srcset="{{ url($image[0]->thumb_path) }}" class="img-fade-hover lazy"  alt="{{ $obj->title }} {{ $obj->address }}">
                            <div style="position:absolute;top:1px;right:1px;">
                                @if(isset($obj->badge) && $obj->badge)
                                    <p class="text-white  text-right " style="margin-bottom:1px;padding-left:5px;padding-right:5px; background-color: rgba(0,0,0,0.8);">
                                        <small style="font-size:0.7em;">

                                            <a href="/outdoor-adventures/{{$obj->badge }}">#{{$obj->badge }}</a>

                                        </small>
                                    </p>
                                @endif
                                @if(isset($obj->distance))
                                    <p class="text-white text-right" style="margin-bottom:1px;padding-left:5px;padding-right:5px; background-color: rgba(0,0,0,0.8);">
                                        <small style="font-size:0.7em;">
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
                @endforeach
            </div>
             
            @if($isMobile && !$isWebView)
                <a class="text-center" style="margin:10px;width:100%;" href="android-app://com.omnitask.avanturistic/https/avanturistic.com/{{ str_replace('https://avanturistic.com/', '',url()->current()) }}">Open In App</a>
            @endif
        </div>
    </div>
@endif