@if(count($posts))
    <div class="row">
        @foreach($posts as $obj)
            <div class="col-sm-6 col-lg-3" style="margin-bottom: 15px; position:relative">
                <div class="top-border-radius" style=" -webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;overflow:hidden;">

                    <div style="position:relative;">

                      
                            
                                <div class="top-border-radius" style="position:absolute;left: 0px;z-index:1;top: 0px; width:100%; background: rgba(0,0,0,0.8);padding:15px;padding-bottom:10px;">
                                
                                    <div class="row"> 
                                        <div class="col-10 text-left text-white ">
                                            @if($obj->title)
                                                <a class="text-white" href="/adventure/{{ $obj->id }}/{{ $obj->slug }}">
                                                    <h4 class=" k-font" style=" font-size: 1.2rem; "><b>{{ Str::limit($obj->title, 56) }}</b></h4>  
                                                </a>
                                            @endif
                                        </div>
                                        <div class="col-2 text-right">
                                            @if($obj->country)
                                                <a class=" img-fade-hover text-muted" style="font-weight:400;" href="/country/{{ $obj->country->slug }}">
                                                    <div style=" display:inline-block;border:2px solid #474747;background-image:url('/img/countries/svg/{{ strtolower($obj->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 36px; height: 36px;">
                                                    </div>
                                                </a>
                                            @endif 
                                        </div>
                                    </div>
                                    
                                </div>
                           
                      

                        <div class="" style="z-index: 0;position: relative;">
                          
                                <div class="row" style="position:absolute;left: 0;z-index:3; bottom:-1px;" >
                                    <div class="col-sm-12" >
                                        <div   style="padding-left:10px;padding-bottom:10px;padding-right:10px;">
                                            @if($obj->is_recommended)
                                                <button   class="btn  single-badge"  style="margin-right:5px;padding:0;" data-toggle="kt-tooltip" title="" data-placement="top" data-original-title="Avanturistic Pick">
                                                    <div style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;margin-left: auto; margin-right: auto;"  >
                                                        <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ url('/img/star.svg') }}" alt="Starred" data-srcset="{{ url('/img/star.svg') }}" style="width:35px;">
                                                    </div>
                                                </button>
                                            @endif
                                            
                                            @if(isset($obj->options['badges']) && ($obj->options['badges'])  )
                                                @php $countBadge = 0;@endphp
                                                @foreach($obj->options['badges'] as $key => $val)
                                                    @if($countBadge < 3)
                                                        @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                            <button   class="btn img-fade-hover single-badge"  style="margin-right:5px;padding:0;" title="{{ $badges[$key]['name'] }}">
                                                                <div style="border:2px solid {{ $badges[$key]['color'] }};background: #3C3C3C;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;margin-left: auto; margin-right: auto;padding: 5px;">
                                                                    <a href="/outdoor-adventures/{{ $key }}">
                                                                    <img alt="{{ $key }} adventures" src="{{ $badges[$key]['icon_empty'] }}" style="width:35px;">
                                                                    </a>

                                                                </div>
                                                            </button>

                                                        @endif
                                                        @php $countBadge++;@endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                            @if($obj->has_route)
                                                <button   class="btn img-fade-hover single-badge"  style="margin-right:5px;padding:0;">
                                                    <div style="border:2px solid #FFFFFF;background: #FFFFFF;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;margin-left: auto; margin-right: auto;padding: 5px;">
                                                        <img alt="Route" src="{{ url('/img/route.svg') }}" style="width:35px;">
                                                    </div>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                          
                            <div style="position:relative;width:100%;height:300px;">

 
                                <a href="/adventure/{{ $obj->id }}/{{ $obj->slug }}?s=date" class="loading">
                                    @if(count($obj->image) > 1)
                                        <div class="swiper-container inactive " id="swiper-{{$obj->id}}">

                                            <div class="swiper-wrapper  " style="background-color:#000000;">
                                                @foreach($obj->image as $img)
                                               
                                                    <div class="swiper-slide swiper-lazy"  style="background-color:#000000;">
                                                        <img src="{{url(isset($img['placeholder']) ? $img['placeholder'] : '/img/logo.png') }}" data-src="{{ url($img['thumb_path']) }}" class="swiper-lazy">
                                                        <div class="swiper-lazy-preloader"></div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div style="z-index:2;" class="swiper-pagination swiper-pagination-{{$obj->id}}"></div>
                                        </div>
                                    @else
                                        <div style="height:300px;background-color:#000000;" class="  overflowH postImg">
                                            <img class="lazy " src="{{url(isset($obj->image[0]['placeholder']) ? $obj->image[0]['placeholder'] : '/img/logo.png') }}" data-src="{{ $obj->image[0]['thumb_path']}}" data-srcset="{{ $obj->image[0]['thumb_path'] }}" alt="{{ $obj->title }}" style="width: 100%;height:100%;object-fit: cover;">
                                        </div>
                                    @endif
                                </a>
                                @if($obj->video && $obj->video != '' && $obj->video != ' ')
                                    <span class="flex justify-center" style="z-index:1;position:absolute;right:15px;bottom:10px;color:#FFFFFF;background: #333333bf;text-align:center;border-radius:50%;border:2px solid #FFF; width:36px;height:36px;">
                                       
                                        <img src="/img/video.svg" width="22" alt="{{ $obj->title }} Video" style="width:22px;filter:brightness(0) invert(1);">
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="post-heading " style="border-bottom: 1px solid #222;border-top: 1px solid #474747;padding:10px; background-color:#000;height:60px;">
                            <div class="row">
                                <div class="col-6 text-left " style="position:relative;">
                                   
                                        @if($obj->user && $obj->user->group == 'user')
                                          
                                                <a class="text-white img-fade-hover overflow-dots" href="/{{ !$user ? '#' : '@' .$obj->user->name_slug }}"  {{ !$user ? 'data-toggle=modal data-target=#signUpModal' : 'data-toggle=kt-tooltip' }} style="position: relative; display:inline-block;">
                                                    <span>
                                                        <small>
                                                        @if($obj->user->avatar && $obj->user->avatar != ' ' && $obj->user->avatar != '')
                                                                <span><img  class="lazy circle img-fade-hover"  src="/img/placeholder-trans.png" data-src="{{ $obj->user->avatar }}" data-srcset="{{ $obj->user->avatar }}" width="37" height="37" style="width:37px;border:1px solid #474747;" alt="{{ $obj->user->name  }}"></span>
                                                            @else
                                                                <div style="display:inline-block; padding-top:10px;padding-left:1px;margin:0;" class=" kt-header__topbar-icon text-white post-avatar"><b>{{ ucfirst($obj->user->name[0]) }}</b></div>
                                                            @endif
                                                    </small>
                                                    </span>
                                                    <span  style="padding-top:16px;left:5px;white-space: nowrap;"> <small><b>&nbsp;{{ $obj->user->name }}</b></small></span>
                                                </a>
                                            
                                        @else
                                            <span class="text-white" style="padding-top:5px;"><img class="avatar" src="/img/logo.svg" width="36" height="36" style="width:36px;"  alt="Avanturistic"> </span>
                                        @endif
                                    
                                    
                                   
                                </div>
                                <div class="col-6 text-right">
                                    <div class="circle-posts-toolbar text-right" style="padding:0px;margin-top:1px;">

                                        <div style="font-size: 16px;">
                                        
                                            
                                               
                                                <a  data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="I Was Here!" href="#" data-post_id="{{ $obj->id }}" class="visitedBtn text-center ">
                                                    <i class="fa fa-shoe-prints  {{ isset($obj->isVisited) && $obj->isVisited ? 'text-success' : 'text-white' }}" style="font-size:1em !important;width:36px;height:36px; -webkit-border-radius: 99999em;-moz-border-radius: 99999em;border-radius: 99999em; padding-top: 11px;background: #474747;"></i>
 
                                                </a>
                                                <a  href="#" data-post_id="{{ $obj->id }}" class="likeBtn  text-center" >

                                                <i class="fa fa-heart {{ isset($obj->likeExists) && $obj->likeExists   ? 'text-success' : 'text-white' }}" style="width:36px;height:36px;; -webkit-border-radius: 99999em;-moz-border-radius: 99999em;border-radius: 99999em;  padding-top: 10px;background: #474747; "></i>

                                                </a>
                                            
                                        </div>
 
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>

                </div>
            </div>
        @endforeach
    </div>


@endif

