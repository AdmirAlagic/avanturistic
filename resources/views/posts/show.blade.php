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
                                <div class="swiper-wrapper "  data-page="false" data-autohide="false" data-zoom="false" data-infinite="true" data-fullscreen="false" data-autofit="false" style="position:relative;">
                                    @foreach($post->image as $image)
                                        <div class="swiper-slide" style="position:relative;z-index:2;min-height:200px; {{ count($post->image) == 1 ? 'border-bottom:3px solid #474747;' : '' }}">
                                            <img src="{{ url($image['path']) }}" alt="{{ isset($image['title']) ? $image['title'] : $post->title }}"  data-title="{{ isset($image['title']) ? $image['title'] : ''}}" class="" data-src="{{ url($image['path']) }}"> 
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
                            <div class="swiper-container gallery-thumbs" style="height:80px;border-bottom:1px solid #eeeeee;">
                                <div class="swiper-wrapper" style="height:80px;">
                                    @foreach($post->image as $image)
                                        <div class="swiper-slide  swiper-lazy"  data-background="{{ url($image['thumb_path']) }}"></div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;padding:10px;padding-top:0;">
                        
                        @if($post)
                            <div class="row post lastPost" " data-routes="{{ isset($post->map_options['route']) ? json_encode($post->map_options['route']) : null  }}"  data-title="{{ $post->title }}" data-lat="{{ $post->lat }}" data-lng="{{ $post->lng }}" data-img="{{ isset($post->image[0]['thumb_path']) ? $post->image[0]['thumb_path'] : 'default' }}">
                                
                                @include('shared.post.post_toolbar')
                                @if($nextPost && !$isMobile)
                             
                                <a class=" img-fade-hover" href="{{ $nextPostUrl}}" style="width:100%;color:#474747;">
                                    <div class="text-right" style="width:100%;border-bottom:1px solid #eeeeee;margin-bottom:10px;">
                                        <div class="nextPostBtn justify-center" style="  padding:10px;display: flex;align-items: center; margin:1rem;"> 
                                            
                                            <span style="margin-right:20px;">
                                            @if($sort && $sort == 'u')
                                               More from <b>{{ $post->user->name }}</b>
                                            @elseif($sort && $sort == 'c' && isset($post->country->title))
                                               Next adventure in <b>{{ $post->country->title }}</b>
                                            @else
                                            {{ $nextPost->title}}
                                            @endif
                                        </span>
                                            <div class="next-post-info" style="position: absolute;top:0;right:0;display:none;">
                                                {{ $nextPost->title}}
                                            </div>
                                            <div style="border-radius:50%;padding:5px;display:inline-flex;width:60px;height:60px;background: linear-gradient(267deg,#e25d98 0,#26bcbd 70%,#acc957 100%) left bottom transparent no-repeat;">
                                                <img src="{{ $nextPost->image[0]['thumb_path'] }}" alt="Next Adventure" width="50"  height="50" style="border-radius:50%;width:50px;height:50px;border: 2px solid #FFF;">
                                            </div>
                                            <span>&nbsp;
                                                
                                                  <svg xmlns="http://www.w3.org/2000/svg"  style="width:20px;" class="ml-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                                  </svg>
                                        </div>
                                    </div>
                                    </a>
                                @endif
                                @if($nextPost && $isMobile && isset($nextPost->image[0]['thumb_path']))
                                <div class="text-center mt-10" style="width:100%;padding:10px;">
                                    <div id="button-background" data-next-url="{{ $nextPostUrl}}">
                                        <span class="slide-text flex items-center justify-between">
                                            @if($sort && $sort == 'u')
                                               More from&nbsp;<b>{{ $post->user->name }}</b>
                                            @elseif($sort && $sort == 'c' && isset($post->country->title))
                                            More from&nbsp;<b>{{ $post->country->title }}</b>
                                            @else
                                                @if($nextPost->title)
                                                    {{ Str::words($nextPost->title, 10)}}
                                                    
                                                @else
                                                    Next adventure
                                                @endif
                                            @endif
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 18px;" class="ml-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                              </svg>
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
                                        @include('shared.post.badges')
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

                                        @if($post->embeded_code && $post->embeded_code != '')
                                          
                                            <p>
                                                {!! $post->embeded_code !!}
                                            </p>
                                            
                                        @endif
                                        @if($post->description)
                                          <div style="padding:10px;">
                                            <br>
                                            {!! $post->description !!}
                                            <br>
                                            @if($translatableText && $translatableText != '')

                                                <a target="_blank" class="ml-5" href="https://translate.google.com/#view=home&op=translate&sl=auto&tl=en&text={{ $translatableText }}">
                                                    <small><i class="fa fa-language text-muted"></i> <b>See translation</b></small>
                                                </a>
                                            @endif
                                            
                                          </div>
                                        @endif

                                    </div>
                                    
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__body" style="padding:15px;">
                            <h3 class="font-light text-center" style="font-size:1.3rem;"><small> Have more info about this location or want to a ask question?
                            <br><span style="" class="text-gray font-light"> Share your toughts in comments</span> </small></h3>

                            
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
                @if($post->user->group == \App\User::$_USER_GROUP_BUSINESS)
                   <div class="kt-portlet">
                       <div class="kt-portlet__body" style="padding:15px;">
                          
                           
                            <a href="/{{ '@'. $post->user->name_slug }}">
                                <h3 class="text-dark" style=margin-bottom:0px;">{{ $post->user->name }}</h3>
                            </a>
                            <div class="flex flex-col mt-10">
                                @if(isset($post->user->social_links['website']) && $post->user->social_links['website'])
                                    <a class="font-light" href="{{ $post->user->social_links['website'] }}">
                                        <b>{{ UtilHelper::cleanUrl($post->user->social_links['website']) }}</b>
                                        </a>
                                @endif
                                @if(isset($post->user->business_fields['email']) && $post->user->business_fields['email'])
                            
                                <a class="font-light" href="{{ $post->user->business_fields['email'] }}"> <small>{{ $post->user->business_fields['email'] }}</small></a>
                                @endif
                                
                            </div>
                            <div class="flex  profile-social-links mt-10">
                            
                                @if(isset($post->user->social_links['facebook']))
                                    <a target="_blank" class="ml-5" href="{{ UtilHelper::externalURL($post->user->social_links['facebook'] , 'facebook.com') }}">
                                        <i class="la la-facebook  img-fade-hover" style="font-size:2.3rem;"></i>
                                    </a>
                                @endif
                                @if(isset($post->user->social_links['instagram']))
                                <a target="_blank" class="ml-5" href="{{ UtilHelper::externalURL($post->user->social_links['instagram'] , 'instagram.com') }}">
                                        <i class="la la-instagram img-fade-hover" style="font-size:2.3rem;"></i>
                                    </a>
                                @endif
                                @if(isset($post->user->social_links['youtube']))
                                <a target="_blank" class="ml-5" href="{{ UtilHelper::externalURL($post->user->social_links['youtube'] , 'youtube.com/channel') }}">
                                        <i class="la la-youtube-play img-fade-hover" style="font-size:2.3rem;"></i>
                                    </a>
                                @endif
                                @if(isset($post->user->social_links['pinterest']))
                                <a target="_blank" class="ml-5" href="{{ UtilHelper::externalURL($post->user->social_links['pinterest'] , 'pinterest.com') }}">
                                        <i class="la la-pinterest img-fade-hover" style="font-size:2.3rem;"></i>
                                    </a>
                                @endif
                                @if(isset($post->user->social_links['linkedin']))
                                <a target="_blank" class="ml-5" href="{{ UtilHelper::externalURL($post->user->social_links['linkedin'] , 'linkedin.com/in') }}">
                                        <i class="la la-linkedin img-fade-hover" style="font-size:2.3rem;"></i>
                                    </a>
                                @endif
                                @if(isset($post->user->social_links['twitter']))
                                <a target="_blank" class="ml-5" href="{{ UtilHelper::externalURL($post->user->social_links['twitter'] , 'twitter.com') }}">
                                        <i class="la la-twitter img-fade-hover" style="font-size:2.3rem;"></i>
                                    </a>
                                @endif
                                @if(isset($post->user->social_links['tripadvisor']))
                                <a target="_blank" class="ml-5" href="{{ UtilHelper::externalURL($post->user->social_links['tripadvisor'] , 'tripadvisor.com') }}">
                                        <i class="la la-tripadvisor img-fade-hover"  style="font-size:2.3rem;"></i>
                                    </a>
                                @endif
                            
                            </div>
                            
                           
                            @if($openingHours)
                                <div class="flex items-center mt-10">
                                    <svg xmlns="http://www.w3.org/2000/svg"  style="width:18px;" class="mr-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg> 
                                
                                    <div>   
                                        {{ $openingHours }}
                                        <b>@if($isOpen)
                                            <span class="text-green">Open</span>
                                            @else
                                            Closed
                                            @endif</b>
                                    </div>
                                </div>
                            

                            @endif
                            <div class="flex justify-start mt-10" style="width:100%;">
                                <a class="btn btn-line-rounded mt-10 mb-10 btn-tall mr-10" style="width:max-content;" href="/message/{{ $post->user->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg"  style="width:18px;margin-top: -2px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-light">Send Message</span>
                                        
                                </a>
                                @if(isset($post->user->business_fields['phone']) && $post->user->business_fields['phone'])
                                    <a class="btn btn-line-rounded btn-tall mt-10 mb-10 font-light  " href="tel:{{ $post->user->business_fields['phone'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg"  style="width: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $post->user->business_fields['phone'] }}
                                    </a>
                                @endif
                            

                            </div>
                                          
                       </div>
                   
                   </div>
                        
                @endif
                <div class="kt-portlet" style="padding-top:10px;margin-bottom:0px;">
                   
                    <div class="flex">
                        @if($post->address)
                        <div class="kt-portlet__head" style="width:38.2%;">
                            <div class="kt-portlet__head-label" style="width:100%;">
                            <span class="kt-portlet__head-icon" style="padding-right:0px;text-align:center;width:35px;margin-right:5px;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:35px;height:35px;margin-right:10px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                  </svg>
                            </span>
                                
                                    <small>{{ $post->address }}</small>
                             
                            </div>
                        </div>
                    @endif
                    @if($post->country)
                        <div class="kt-portlet__head justify-end" style="width: 61.8%;">
                            <div class="kt-portlet__head-label" style="width:100%;">
                            <a class="text-muted flex" style="font-weight:500;" href="/country/{{ $post->country->slug }}">
                                <div style="margin-left:-1px;margin-right:10px;border:1px solid #999;background-image:url('/img/countries/svg/{{ strtolower($post->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;">
                                             
                                </div>
                              
                                  <div>
                                    <small> <span class="font-light">{{ $post->country->title }}</span> <div class="text-gray">{{ $post->country->subregion }}</div></small>   
                                  </div>
                               
                                 
                            </a>
                            </div>
                        </div>
                    @endif
                    </div>
                    <div class="kt-portlet__body" style="padding-bottom:0px;">
                        <div class="row">
                            <div class="col-sm-12">
                                <div style="position:relative;">
                               {{--   <span  style="position: absolute;padding:5px;left: 0;top:0px;z-index: 1;background-color: #333333c7; color:#FFFFFF;  border-top-left-radius: 4px; border-bottom-right-radius: 4px; padding-left:10px;padding-right:10px;">
                                 <b>{{ UtilHelper::latLngtoDMS($post->lat,$post->lng) }}</b><br>
                                </span> --}}

                                    <div  style="position: absolute;left: 0;bottom:0px;z-index: 1;background-color: #474747; border-bottom-left-radius: 4px; border-top-right-radius: 4px;  ">

                                        <a style="padding-left:10px;padding-right:10px;" class="btn showSatelite  text-white" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                              </svg>
                                        </a>
                                    </div>
                                    <div id="single-map"  style="width:100%;height:270px;z-index: 0;"></div>
                                </div>

                                @include('shared.post.map_options')
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="kt-notification" style="margin-top:10px;">
                                    {{-- @if($user && $post->user_id == $user->id && $post->likes > 0)
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
                                    @endif --}}

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
