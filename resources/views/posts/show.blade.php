@extends('layouts.app')

@section('content')
    <div class="kt-container post">
        @include('shared.success_error')
        <div class="row">
            <div class="col-sm-7">
                <!--begin::Portlet-->
                <div class="kt-portlet" style="background: none;">
                    <div class="" style="padding: 0;width:100% !important;">
                        <div class="kt-portlet__head-label" style="width:100%;display: block;position: relative;">
                            <div class="swiper-container gallery-top" style="width:100%; height: auto; ">
                                <div class="swiper-wrapper spotlight-group"  data-page="false" data-autohide="false" data-zoom="false" data-infinite="true" data-fullscreen="false" data-autofit="false" style="position:relative;">
                                    @foreach($post->image as $image)
                                        <div class="swiper-slide" style="position:relative;z-index:2;min-height:200px; {{ count($post->image) == 1 ? 'border-bottom:3px solid #474747;' : '' }}">
                                            <img src="{{ url($image['path']) }}" alt="{{ isset($image['title']) ? $image['title'] : $post->title }}"  data-title="{{ isset($image['title']) ? $image['title'] : ''}}" class="spotlight" data-src="{{ url($image['path']) }}"> 
                                            @if(isset($image['title']))
                                                <div style="position:absolute;bottom:0;left:0;width:100%;height:40px;padding:10px;color:#FFFFFF; 
                                                            background: linear-gradient(180deg, rgba(180,214,119,0) 0%, rgba(51,51,51,0.7) 100%);"> 
                                                    <b>{{ Str::words($image['title'], 10) }}</b>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    
                                    
                                </div>
                               
                                @if(count($post->image) > 1)
                                    <!-- Add Arrows -->
                                    <div style="z-index:2;" class="swiper-pagination "></div>
                                @endif
                            </div>
                            @if(count($post->image) > 1)
                            <div class="swiper-container gallery-thumbs" style="height:80px;border-bottom:3px solid #474747;">
                                <div class="swiper-wrapper" style="height:80px;">
                                    @foreach($post->image as $image)
                                        <div class="swiper-slide  swiper-lazy"  data-background="{{ url($image['thumb_path']) }}"></div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;">
                        
                        @if($post)
                            <div class="row post lastPost" data-routes="{{ isset($post->map_options['route']) ? json_encode($post->map_options['route']) : null  }}"  data-title="{{ $post->title }}" data-lat="{{ $post->lat }}" data-lng="{{ $post->lng }}" data-img="{{ isset($post->image[0]['thumb_path']) ? $post->image[0]['thumb_path'] : 'default' }}">
                                
                                @include('shared.post.post_toolbar')
                                @if($nextPost && !$isMobile)
                              
                                <a class="text-muted img-fade-hover" href="{{ $nextPostUrl}}" style="width:100%;color:#999;">
                                    <div class="text-right" style="width:100%;border-bottom:1px solid #eeeeee;margin-bottom:20px;">
                                        <div class="nextPostBtn" style="  padding:10px;display: flex;align-items: center;justify-content: flex-end;"> 
                                            
                                            <span style="margin-right:20px;">
                                            @if($sort && $sort == 'u')
                                               More adventures from <b>{{ $post->user->name }}</b>
                                            @elseif($sort && $sort == 'c' && isset($post->country->title))
                                               Next adventure from <b>{{ $post->country->title }}</b>
                                            @else
                                                Next {{ $nextTxt != 'next' ? $nextTxt : '' }} {{ isset($mainActivity) && $mainActivity ? $mainActivity : ''}}  adventure
                                            @endif
                                        </span>
                                            <div style="border-radius:50%;padding:5px;display:inline-flex;width:60px;height:60px;background: linear-gradient(267deg,#e25d98 0,#26bcbd 70%,#acc957 100%) left bottom transparent no-repeat;">
                                                <img src="{{ $nextPost->image[0]['thumb_path'] }}" alt="Next Adventure" style="border-radius:50%;width:50px;border: 2px solid #FFF;">
                                            </div>
                                            <span>&nbsp;
                                            <i class="fa fa-angle-right"></i></span>
                                         
                                        </div>
                                    </div>
                                    </a>
                                @endif
                                @if($nextPost && $isMobile && isset($nextPost->image[0]['thumb_path']))
                                <div class="text-center" style="width:100%;padding:10px;">
                                    <div id="button-background" data-next-url="{{ $nextPostUrl}}">
                                        <span class="slide-text">
                                            @if($sort && $sort == 'u')
                                               Swipe for more adventures from <b>{{ $post->user->name }}</b>
                                            @elseif($sort && $sort == 'c' && isset($post->country->title))
                                            Swipe for more adventures from <b>{{ $post->country->title }}</b>
                                            @else
                                                Swipe to  {{ $nextTxt }}  {{ isset($mainActivity) && $mainActivity ? $mainActivity : ''}}  adventure
                                            @endif
                                           
                                        </span>
                                        <div id="nextpostswipe"  style="width:60px;height:60px;background: linear-gradient(267deg,#e25d98 0,#26bcbd 70%,#acc957 100%) left bottom transparent no-repeat;">
                                            <i id="locker"  ><img  src="{{ $nextPost->image[0]['thumb_path'] }}" alt="Next Adventure" style="border-radius:50%;border:2px solid #FFF;"></a></i>
                                        </div>
                                    </div>
                                </div>
                                
                                @endif
                                <div class="col-sm-12">
 
                                    <div class="clearfix">
                                      

                                        
                                        @if($post->title)
                                            <div class="row">
                                                <div class="col-12">
                                                    <h1 class="blog-title text-center" style="margin-top: 10px; font-size: 1.6rem;">{{ $post->title }}</h1>
                                                </div>
                                            </div>
                                           
                                        @endif
                                        @if($post->video && $post->video != ' ')

                                            @php
                                                $videoId = UtilHelper::parseYtUrl($post->video);

                                            @endphp
                                            @if($videoId)
                                                <hr>
                                                <iframe class="video-iframe" style="border:none; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;"  width="100%" height="315" allowfullscreen="allowfullscreen"
                                                        mozallowfullscreen="mozallowfullscreen"
                                                        msallowfullscreen="msallowfullscreen"
                                                        oallowfullscreen="oallowfullscreen"
                                                        webkitallowfullscreen="webkitallowfullscreen"
                                                        data-src="https://www.youtube.com/embed/<?php echo $videoId ?>?rel=0&showinfo=0&color=white&iv_load_policy=3">
                                                </iframe>
                                               
                                            @endif
                                        @endif

                                        @if($post->embeded_code)
                                            <hr>
                                            <p>
                                                {!! $post->embeded_code !!}
                                            </p>
                                            
                                        @endif
                                        @if($post->description)
                                            <hr>
                                            {!! $post->description !!}
                                            <br>
                                            @if($translatableText && $translatableText != '')

                                                <a target="_blank" href="https://translate.google.com/#view=home&op=translate&sl=auto&tl=en&text={{ $translatableText }}">
                                                    <small><i class="fa fa-language text-muted"></i> <b>See translation</b></small>
                                                </a>
                                            @endif
                                            
                                        @endif

                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__body" style="padding:15px;">
                            <h3 class="text-gray text-center" style="font-size:1.3rem;"><small> Have more info about this location or want to a ask question?
                            <br><span style="font-style: italic;" class="text-muted"> Share your toughts in comments</span> </small></h3>

                            
                            <div id="comments-list" style="margin-top:10px;">
                                @foreach($comments as $obj)
                                    @include('shared.single_comment')
                                @endforeach
                            </div>
                            @include('shared.comment_form')
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-sm-5">
                <!--begin::Portlet-->
                <div class="kt-portlet" style="padding-top:10px;margin-bottom:0px;">
                   
                    @if($post->country)
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label" style="width:100%;">
                            <a class="text-muted" style="font-weight:400;padding-bottom:6px;" href="/country/{{ $post->country->slug }}">
                                <div style="margin-left:-1px;display:inline-block;border:1px solid #999;background-image:url('/img/countries/svg/{{ strtolower($post->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;">
                                             
                                </div>
                                <div style="margin-left:45px;margin-top:-42px;line-height:18px;">
                                    {{ $post->country->title }} <small> <br><span class="text-gray">{{ $post->country->subregion }}</span></small> &nbsp;<i class="fa fa-search-location text-gray"></i>   
                                </div>
                                 
                            </a>
                            </div>
                        </div>
                    @endif
                    @if($post->address)
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label" style="width:100%;">
                            <span class="kt-portlet__head-icon" style="padding-right:0px;text-align:center;width:35px;">
                                <i class="fa fa-map-marker-alt text-muted" style="font-size:1.8rem;"></i>
                            </span>
                                <h2 class="kt-portlet__head-title text-left" style="width: 100%;margin-left:5px;">
                                    <small>{{ $post->address }}</small>
                                </h2>
                            </div>
                        </div>
                    @endif
                    @include('shared.post.badges')
                    <div class="kt-portlet__body" style="padding-bottom:0px;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div style="position:relative;">
                                 <span  style="position: absolute;padding:5px;left: 0;top:0px;z-index: 1;background-color: #333333c7; color:#FFFFFF;  border-top-left-radius: 4px; border-bottom-right-radius: 4px; padding-left:10px;padding-right:10px;">
                                 <b>{{ UtilHelper::latLngtoDMS($post->lat,$post->lng) }}</b><br>
                                </span>

                                    <span  style="position: absolute;right: 0;top:0px;z-index: 1;background-color: #333333c7; border-bottom-left-radius: 4px; border-top-right-radius: 4px; padding-left:10px;padding-right:10px; ">

                                    <a style="padding:5px;"  class="btn showSatelite  text-white" href="#">Satellite Map</a>
                                </span>
                                    <div id="single-map"  style="width:100%;height:270px;z-index: 0;"></div>
                                </div>

                                @include('shared.post.map_options')
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="kt-notification" style="margin-top:10px;">
                                    @if($user && $post->user_id == $user->id && $post->likes > 0)
                                        <div class="tab-pane " id="kt_widget6_tab5_content" aria-expanded="true">
                                            <div class="kt-notification">
                                                <p class="text-muted text-center"><small>Only you can see who liked your adventure</small></p>
                                                <div id="more-activity-likes"></div>
                                                @if($post->likes > 3)
                                                    <div class="col-12 text-center">
                                                        <br>
                                                        <a href="#" style="-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;" class="btn btn-success getMoreActivity" data-type="likes"><span class="text-white">Load more</span></a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                    @endif

                                    @if($user && $post->visiteds > 0)

                                        <div id="more-activity-others">

                                        </div>
                                        @if($post->visiteds > 3)
                                            <div class="col-12 text-center">
                                                <br>
                                                <a href="#"  style="-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;" class="btn btn-success getMoreActivity" data-type="others"><span class="text-white">Load more</span></a>
                                            </div>
                                        @endif
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
                <br>
                <ins class="adsbygoogle"
                     style="display:block; text-align:center;"
                     data-ad-layout="in-article"
                     data-ad-format="fluid"
                     data-ad-client="ca-pub-5528772671541930"
                     data-ad-slot="8883451940"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
                <br>
                {{--begin:portlet--}}
                @include('shared.post.nearby_posts')
            </div>

        </div>
         
    </div>
    
@endsection
