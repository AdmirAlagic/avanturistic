@extends('layouts.app')

@section('content')
    <!--begin::Portlet-->
   

    <div class="full-width-bg" style="position:relative;overflow: hidden;background:rgba(0,0,0,0.4);">

       
        <div class="kt" style=" {{ $user ? 'padding: 10px 20px 10px 20px;' : 'padding: 50px 20px 0px 20px;' }} ">

            @if(!$user)
            <div class="row" >
                <div class="col-12 text-center ">
                    <h1 class="text-white" style="font-size:2.3em;letter-spacing:2px;font-weight: 900;">AVANTURISTIC</h1>
                    <h2 class="text-white" style="font-size:1.5em;z-index: 0;font-weight:400; margin-top:-8px;"><span class="border-r4 " style="background: #b4d677;padding-left: 10px;padding-right: 10px;margin-left:-2px;padding-top: 1px;padding-bottom: 3px; ">World map of adventure</span></h2>
                     
                      
                </div>
               
            </div>
            @endif
            <br>
            <div  class="text-center text-white">
                @if(!$user)
                    
                      
                    <h3 class="k-font" style="margin-top:15px;margin-bottom:15px;padding:20px;"  >Welcome to a network for outdoor enthusiasts, nature lovers and travelers</b>.</h3>
                   <!-- 
                    <a href="/share" class="btn-more btn-more-share  btn--with-icon loading  mt20" style="box-shadow:none;margin-bottom:10px;">
                        <div class="img " style="padding:0px 10px 0px 10px;width:47px;height:50px;" >  
                            
                            <img class="" src="/img/badges/empty/backpacking.svg"   alt="Add new adventure" style="margin-top: 10px;margin-left:-5px;height:32px;">
                            
                        </div>
                        <div>SHARE ADVENTURE</div>
                    </a> -->
                   <!--  <p>
                        Share your favorite adventure locations
                            and make your
                            <em><a class=" loading text-white img-fade-hover " href="{{ url('/the-world-map-of-outdoor-adventures') }}">
                                map of outdoor adventures
                            </a></em>
                    
                    </p> -->
                   
                  <!--    
                    <h4>
                        <em><b>Get inspired</b> for your next  trip <b>&</b>  <b>discover</b></em> new destinations <br> 
                            Explore personal impressions of best outdoor locations  & find adventure activities near you.
                    </h5> -->
                    
                    
                    <!-- <button class="text-white go-to-menu border-r8" style="background:transparent;margin:10px;border:1px solid #FFFFFF;background:#00000075;padding:10px;">
                    Start exploring now 
                       &nbsp;
                        <i class="fa fa-angle-down text-white"></i>
                         
                    </button>
                          -->
                    
                    
                @else
                   <div class="kt-container text-center">
                        @include('shared.success_error')
                   </div>
                    <h4 class="k-font">Welcome <b>{{ $user->name }}</b>.</h3>
                     
                    <div class="text-center" style="margin-top:4em;margin-bottom:3em;">
                    <a style="margin-bottom:10px;margin-top:15px; padding-left:10px;padding-right:10px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding:10px;margin-top: 10px;display: inline-flex;align-items:center;background:linear-gradient(to right, #565d4873, #3c78784f, #814c6357);border:1px solid #FFF;" href="/share"  >
                       <div class=" kt-header__topbar-wrapper img-fade-hover">
                            <img  style="display:inline;height:22px;" height="22"  src="{{ url('/img/pinplus_white.svg') }}" alt="Share adventure">
                           <div style="white-space: nowrap;margin-left:10px;display:inline;"><b><span style="font-size:1.1rem;color:white;">Share adventure</span></b></div>

                       </div>
                   </a>
                    </div>
                    
                  <!--   <p><b>OR</b></p><br>
                    <div style="font-weight:400;font-size:1.5rem;">
                        <a class="btn text-white" href="/outdoor-adventures"> <h5><b>Catch up with latest adventures</b></h5></a>
                    </div> -->
                @endif
            </div>
            <div class="text-center">
            <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-bold   nav-tabs-line-brand" role="tablist" style=" display: inline-flex;margin:0;border-bottom:1px solid transparent; ">
                <li class="nav-item" style="display: inline-block;margin-left:-5px;">
                    <a class="nav-link nav-link-home active"  style="font-size:0.8em;"  data-toggle="tab" href="#explore" role="tab">
                        <div class="img-circle" style="margin-left: auto;margin-right: auto;width:50px;height:50px;border-width:2px;margin-bottom:10px;">
                            <img style="height:30px;;margin-top: 8px;display: inline;filter: brightness(0) invert(1);" src="{{ url('/img/adventures.svg') }}" alt="Explore outdoor activities near you">
                        </div>
                       <!--  <div class="kt-visible-desktop nav-link-desc" style="text-transform: uppercase;text-align:center;color:#FFFFFF;">
                            Explore <br>  Outdoor <br> Adventures
                        </div> -->
                    </a>
                    
                </li>
                
                <li class="nav-item nav-map" style="display: inline-block;">
                    <a class="nav-link nav-link-home "  style="font-size:0.8em;"  data-toggle="tab" href="#map" role="tab">
                    <div class="img-circle" style="margin-left: auto;margin-right: auto;width:50px;height:50px;border-width:2px;margin-bottom:10px;">
                            <img style="height:30px;;margin-top: 8px;display: inline;filter: brightness(0) invert(1);" src="{{ url('/img/map_pin.svg') }}" alt="The world map of outdoor adventure locations">
                        </div>
                        
                        <!-- <div class="kt-visible-desktop nav-link-desc" style="text-transform: uppercase;text-align:center;color:#FFFFFF;">
                            The World Map <br> of <br>Outdoor Adventures
                        </div> -->
                    </a>
                    
                </li>
                <li class="nav-item nav-watch" style="display: inline-block;">
                    <a class="nav-link nav-link-home "  style="font-size:0.8em;"  data-toggle="tab" href="#watch" role="tab">
                        <div class="img-circle text-center" style="margin-left: auto;margin-right: auto; width:50px;height:50px;border-width:2px;margin-bottom:10px;">
                            <i class="fa fa-play " style="color:#FFF;font-size:24px;width:50px;height:30px;;margin-top:23px;margin-left:1px;"></i>&nbsp;&nbsp;
                        </div>
                        <!-- <div class="kt-visible-desktop nav-link-desc" style="text-transform: uppercase;text-align:center;color:#FFFFFF;">
                            Watch<br>Latest <br>Video
                        </div> -->
                    </a>
                    
                </li>
                @if(count($stories))
                <li class="nav-item" style="display: inline-block;">
                    <a class="nav-link nav-link-home "  style="font-size:0.8em;"  data-toggle="tab" href="#stories" role="tab">
                        <div class="img-circle" style="margin-left: auto;margin-right: auto;width:50px;height:50px;border-width:2px;margin-bottom:10px;">
                            <img style="height:30px;margin-top: 8px;display: inline;margin-left:1px;filter: brightness(0) invert(1);" src="{{ url('/img/blog.svg') }}" alt="Latest news & stories">
                        </div>
                       <!--  <div class="kt-visible-desktop nav-link-desc" style="text-transform: uppercase;text-align:center;color:#FFFFFF;">
                            News <br> & <br> Stories
                        </div> -->
                    </a>
                </li>
                @endif
            </ul>
        </div>
        </div>

    </div>

    <div id="menu" class="kt-portlet kt-portlet--tabs text-center" style="background:transparent;padding: 0;margin-bottom: 0;-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;margin-bottom: 0px;">
        
        <div class="text-center" >
            <div class="tab-content " style="padding: 0;">
                {{--explore--}}
                <div class="kt-portlet tab-pane active"  role="tabpanel" style="border-radius:0px;padding:0;margin-bottom: 0px;background:transparent;" id="explore">
                    <section style="background:#FFFFFF;">
                            <div class="kt-portlet__head text-center" style="min-height:30px;">
                                <div class="kt-portlet__head-label" style="width:100%;min-height:30px;">
                                    <h3 class="kt-portlet__head-title text-center" style="font-size: 1.5rem;width:100%;border-radius:0px !important;margin:10px;padding:10px;">
                                       <!--  <b>Latest outdoor adventures</b> -->
                                        Explore The Great Outdoors
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body  padding0" >
                                <div class="kt-container padding0" >
                                    
                                   <!--  <br>
                                    <p><span class="text-gray">Latest outdoor adventures from outdoor activities:</span>
                                        @php $countLatestBadges = 1;@endphp
                                        @foreach($latestBadges as $k => $v)
                                            <a href="/outdoor-adventures/{{  $v }}" style="padding-right: 0;">
                                                <span class="text-success">#</span><span id="span" class="text-muted">{{  $v }}</span></a>
                                            @if($countLatestBadges < count($latestBadges))<span>,</span>&nbsp;@endif
                                            @php $countLatestBadges++;@endphp
                                        @endforeach 

                                    </p>
                                    <hr> -->
                                    <div class="row">
                                            <div class="col-12 text-center">
                                                <br>
                                                <div class="clearfix">
                                                
                                                    <a href="/outdoor-adventures" class="btn-more btn--with-icon  kt-pulse kt-pulse--light loading">
                                                        <i class="btn-icon fa fa-angle-right"></i> 
                                                        <span class="kt-pulse__ring " style="top: 5px;left: -2px;"></span>
                                                        <div>EXPLORE ADVENTURES</div>
                                                    </a>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    <div id="more-posts" style="min-height:100px;padding-left:10px;padding-right:10px;">
                                        
                                        @include('public.home.latest')
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </section>
                    <section  style="background:#FFFFFF;">
                        <div class="kt-portlet__head text-center" style="background:transparent;min-height:30px;border-top:1px solid #f6f6f6;">
                            <div class="kt-portlet__head-label" style="width:100%;min-height:30px;">
                                <h3 class="kt-portlet__head-title text-center" style="font-size: 1.5rem;width:100%;border-radius:0px !important;margin:10px;padding:10px;">
                                    Find Your Next Adventure
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body" style="margin-bottom: 0;padding-bottom:0;">
                            <div class="kt-container" >
                                <p class="text-center">
                                    Explore <b>personal impressions</b> from other users outdoor adventures and <b>get useful tips</b>.
                                    <br> Every adventure is location based, so we will help you to find outdoor recreation activity <b>near you</b>.
                                </p>
                                <p class="text-gray"><em>Choose your favorite outdoor activity</em></p>
                                <div class="row" style="margin-bottom:20px;margin-top: 30px; ">

                                    @foreach($badges as $key => $val)
                                        <div class="col-3 col-sm-2  text-center"  style="padding:0;margin-bottom:20px;">
                                            <a href="/outdoor-adventures/{{ $key }}" class="loading ">
                                                <div class="profile-badges profile-badge " data-key="{{ $key }}" style="cursor: pointer;margin-bottom:5px;">
                                                    <div class="badge-wrap img-fade-hover" style="-webkit-box-shadow: 0px 0px 2px 0px #111;
                                                            -moz-box-shadow: 0px 0px 2px 0px #111;
                                                            box-shadow: 0px 0px 2px 0px #111; border:3px solid {{ $val['color'] }};
                                                            background: #555;-webkit-border-radius: 50%;
                                                            -moz-border-radius: 50%;
                                                            border-radius: 50%; width: 45px; height: 45px;margin-left: auto; margin-right: auto;padding: 7px;margin-bottom:5px;">
                                                        <img  class="lazy" alt="{{ $key }} outdoor activity"   src="/img/placeholder-trans.png" data-src="{{ $badges[$key]['icon_empty'] }}" data-srcset="{{ $badges[$key]['icon_empty'] }}" style="width:3.6rem !important;">
                                                    </div>
                                                    <div>
                                                        <span style="white-space: nowrap;font-weight:normal;">{{ $val['name'] }}</span>
                                                    </div>
                                                </div>
                                            </a>
                                            
                                        </div>
                                    @endforeach
                                    
                                    <div class="col-3 col-sm-2  text-center"  style="padding:0;margin-bottom:20px;">
                                        <a href="/outdoor-adventures/" class="loading">
                                            <div class="profile-badges profile-badge" data-key="{{ $key }}" style="cursor: pointer;margin-bottom:5px;">
                                                <div class="badge-wrap" style="-webkit-box-shadow: 0px 0px 3px 0px #000000;
                                                        -moz-box-shadow: 0px 0px 3px 0px #000000;
                                                        box-shadow: 0px 0px 3px 0px #000000; border:3px solid #FFFFFF;
                                                        background: #555;-webkit-border-radius: 50%;
                                                        -moz-border-radius: 50%;margin-bottom:5px;
                                                        border-radius: 50%; width: 45px; height: 45px;margin-left: auto; margin-right: auto;padding-top: 10px;">
                                                    <span class="text-white"><i class="fa fa-search" style="font-size:16px;margin-left:1px;"></i></span>
                                                </div>
                                                <div>
                                                 <!--    <span style="white-space: nowrap;font-weight:normal;">All</span> -->
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                </div>
                                {{--<hr style="border-top: 1px solid #eee !important;width: 100%;">--}}
                            </div>
                        </div>
                    </section>
                    
                    @if(!$user)
                    <section style="background:rgba(0,0,0,0.5);">
                       
                        <div class="kt-portlet__body" >
                            <div class="kt-container ">
                            <br>
                                <h3 class="text-white">
                                   
                                    Join Avanturistic now and make your map of favorite outdoor locations.                                 
                               </h5>
                               <br>
                               
                               <div class="row">
                                   <div class="col-12 text-center">
                                           <div class="clearfix">
                                               <a  href="#" data-toggle="modal" data-target="#signUpModal" class="btn-more btn--with-icon">
                                                   <i class="btn-icon fa fa-angle-right"></i> 
                                                   <div>CREATE A FREE ACCOUNT</div>
                                               </a>
                                           </div>
                                       </div>
                                   </div>
                               <br>
                            <br>
                                <div class="row">
                                    <div class="col-sm-3" style="">
                                        <div class="kt-portlet kt-portlet--height-fluid border-r8" style="background:#00000075;">
                                            <div style="padding-top:10px;padding-bottom:10px;border-bottom:1px solid #eee;">
                                                <div   style="width:60px;height:60px;background:#666;padding:15px;border-radius:50%;margin:10px;margin-left:auto;margin-right:auto;">
                                                            <img class="lazy" width="40" height="40" style="margin-bottom:15px;margin-left:auto;margin-right:auto;filter: drop-shadow(0px 3px 3px #000) !important;" 
                                                            src="/img/placeholder-icon.svg" alt="Outdoor photography & film" data-src="{{ url('/img/photos-white.svg') }}" data-srcset="{{ url('/img/photos-white.svg') }}">
                                                        </div>
                                                        <h2 class="text-white" style="font-size:1.2rem;"><b>Outdoor Photography & Film</b></h2>
                                            </div> 
                                            <div class="kt-portlet__body text-center" style="padding:20px;">
                                                <div class="text-justify">
                                                <p class="text-center text-white">
                                                   <em>Interested in outdoor & nature photography and film? </em>
                                                </p>
                                                <p class="text-white">
                                                Whether you are a professional or amateur  share  <b>photos</b> and <b>videos</b> of your outdoor activities & favorite adventure locations. <br> Attach  <b>YouTube's</b>  videos just by 
                                                    inserting video URL and increase your videos visibility.
                                                </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="kt-portlet kt-portlet--height-fluid border-r8" style="background:#00000075;">
                                            <div style="padding-top:10px;padding-bottom:10px;border-bottom:1px solid #eee;">
                                                <div     style="width:60px;height:60px;background:#666;padding:15px;border-radius:50%;margin:10px;margin-left:auto;margin-right:auto;">
                                                        <img class="lazy" width="40" height="40" style="margin-bottom:15px;margin-left:auto;margin-right:auto;filter: drop-shadow(0px 3px 3px #000) !important;" 
                                                        src="/img/placeholder-icon.svg" alt="Trip & travel stories" data-src="{{ url('/img/travel.svg') }}" data-srcset="{{ url('/img/travel.svg') }}">
                                                    </div>
                                                    <h2 class="text-white" style="font-size:1.2rem;"><b>Trip & Travel Stories</b></h2>
                                            </div>  
                                            <div class="kt-portlet__body text-center" style="padding:20px;">
                                                <div style="width:100%">
                                                
                                                   
                                                </div>
                                                <div class="text-justify text-white">
                                                    <p class="text-center">
                                                    <em>Do you write stories about trips & travel?</em>
                                                    </p>
                                                    <p class="text-white">
                                                        Share your stories from trips & travel and <b>promote your blog</b>.<br>  Give others useful tips about travel destinations & outdoor activities that you have experienced in your country or while traveling.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="kt-portlet kt-portlet--height-fluid border-r8"  style="background:#00000075;">
                                            <div style="padding-top:10px;padding-bottom:10px;border-bottom:1px solid #eee;">
                                                <div     style="width:60px;height:60px;background:#666;padding:15px;border-radius:50%;margin:10px;margin-left:auto;margin-right:auto;">
                                                        <img class="lazy " width="40" height="40" style="margin-bottom:15px;margin-left:auto;margin-right:auto;filter: drop-shadow(0px 3px 3px #000) !important;" 
                                                        src="/img/placeholder-icon.svg" alt="Adventure Tourism" data-src="{{ url('/img/tourism-white.svg') }}" data-srcset="{{ url('/img/tourism-white.svg') }}">
                                                    </div>
                                                    <h2 class="text-white" style="font-size:1.2rem;"><b>Adventure Tourism</b></h2>
                                            </div>   
                                            <div class="kt-portlet__body text-center" style="padding:20px;">
                                                    
                                                   
                                                    <div class="text-justify text-white">
                                                        <p class="text-center ">
                                                            <em>Do you provide adventure tourism services?</em>
                                                        </p>
                                                        <p>You are welcome to promote your <b>adventure tourism services</b> for free and help others discover them.</p>
                                                        <p>Provide exact locations with contact information and make your business visible.</p>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="kt-portlet kt-portlet--height-fluid border-r8" style="background:#00000075;">
                                            <div style="padding-top:10px;padding-bottom:10px;border-bottom:1px solid #eee;">
                                                <div   style="width:60px;height:60px;background:#666;padding:15px;border-radius:50%;margin:10px;margin-left:auto;margin-right:auto;">
                                                        <img class="lazy" width="40" height="40" style="margin-bottom:15px;margin-left:auto;margin-right:auto;filter: drop-shadow(0px 3px 3px #000) !important;" 
                                                        src="/img/placeholder-icon.svg" alt="Local tourism promotion" data-src="{{ url('/img/map-white.svg') }}" data-srcset="{{ url('/img/map-white.svg') }}">
                                                    </div>
                                                    <h2 class="text-white" style="font-size:1.2rem;"><b>Promote Your Country</b></h2>
                                                </div> 
                                            <div class="kt-portlet__body text-center" style="padding:20px;">
                                                    
                                            <div class="text-justify text-white">
                                                    <p class="text-center">
                                                        <em>Engage in <b>local tourism promotion</b> and share your country's hidden gems.</em>
                                                    </p> 
                                                    <p>Let others discover the best outdoor activities that they can experience in your country and less popular outdoor locations that you admire the most. </p>
                                                    <p>
                                                        <b>
                                                            <em>Show us your country in a way you see it.</em>
                                                        </b>
                                                    </p>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </section>
                    @endif
                </div>

 


                {{--map--}}
                <div class="kt-portlet tab-pane"  role="tabpanel" style="margin-bottom: 0;padding-bottom:30px;border-radius:0px;" id="map">
                    <section>
                        <div class="kt-portlet__head text-center" style="min-height:30px;">
                            <div class="kt-portlet__head-label" style="width:100%;">
                                <h3 class="kt-portlet__head-title text-center" style="font-size: 1.5rem;width:100%;border-radius:0px !important;margin:10px;padding:10px;">
                                    World Map Of Adventure
                                </h3>

                            </div>

                        </div>
                        <div class="kt-portlet__body" style="padding-top:0;">
                            <div class="kt-container"  style="padding:15px;padding-top:0;">
                                
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <br>
                                        <div class="clearfix" style="margin-top: 0px;margin-bottom:10px;">
                                                <a href="/the-world-map-of-outdoor-adventures" class="btn-more btn--with-icon loading"><i class="btn-icon fa fa-globe" style="font-size:1.4rem;"> </i> 
                                                    <div>GO TO MAP</div>
                                                </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                 
                                <p class="text-center text-gray">Explore through interactive map and find adventures  by <em><b>outdoor activity</b></em>.</p>
                               
                                <hr>
                                 @if(!$user)
                                <p class="text-center">Every country has its own hidden gems. Show us <b>your country's best outdoor locations</b>. <br>
                                    Add adventure locations with  photos & videos, routes & trails <br>   and get involved in creating the world map of outdoor adventures!</p>
                                    @endif
                                    <br>
                                 
                                    <div class="row">
                                        @foreach($countries as $obj)
                                      
                                            <div class="col-4 col-sm-3 text-center" style="margin-bottom:15px;height:100px;">
                                            <a href="/country/{{ $obj->slug }}" class="img-fade-hover">
                                                    @if($obj->code2)
                                                    <div style="margin-left:-1px;position:relative;display:inline-block;border:1px solid #fbfbfb;background-image:url('/img/countries/svg/{{ strtolower($obj->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 50px; height: 50px;border:1px solid #999;">
                                                    <div style="position:absolute;right:-15px;top:-10px;padding:5px;border-radius:50%;width:35px;height:35px;background:#666;color:#FFFFFF;border:2px solid #FFFFFF;">{{ count($obj->posts) }}</div>
                                                    </div>
                                                    
                                                    @endif
                                                    <h6 class="text-muted">{{ $obj->title }}</h6>
                                                    <br>
                                                     
                                                  
                                                </a>
                                            </div>
                                            
                                        @endforeach

                                        
                                    </div>
                                    @if(!$user)
                                    <p> <i class="fa fa-question-circle"></i>  You don't see the flag of your country? Be first to <a href="/share">share an adventure</a> location from your country!</p>
                                    @endif
                            </div>
                        </div>
                    </section>
                 </div>


                {{--video--}}
                <div class="kt-portlet tab-pane"  role="tabpanel" style="padding-bottom:30px;margin-bottom: 0;border-radius:0px;" id="watch">
                    <section>
                    <div class="kt-portlet__head text-center" style="min-height:30px;">
                        <div class="kt-portlet__head-label" style="width:100%;">
                            <h3 class="kt-portlet__head-title text-center" style="font-size: 1.5rem;width:100%;border-radius:0px !important;margin:10px;padding:10px;">
                                Latest Video
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="padding-top:0;">
                        <div class="kt-container" style="padding:0;">
                         <br>
                            <div class="clearfix text-center" style="margin-bottom:10px;">
                                <a href="/watch" class="btn-more btn--with-icon  loading"><i class="btn-icon fa fa-angle-right"></i> 
                                    <div>WATCH ADVENTURE VIDEOS</div>
                                </a>
                               
                            </div>
                                <p class="text-gray">
                                    Videos from adventure locations by outdoor enthusiasts worldwide
                                </p>
                            <hr>    
                            <div class="row">
                                @php $countVideo = 0;@endphp
                                @foreach($videoPosts as $obj)
                                    @php
                                        $videoId = UtilHelper::parseYtUrl($obj->video);
                                    @endphp
                                    @if($obj->video != ' ' && $videoId)
                                        @php $countVideo++@endphp
                                        <div class="col-12 col-sm-6">
                                            <div class="kt-portlet kt-portlet--height-fluid" style="background:transparent;">

                                                <div class="kt-portlet__body "  style="padding:0px;background:transparent;">

                                                    @if($videoId)
                                                        <iframe loading="lazy"  style="border:none;
                                                                        -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;"  width="100%" height="350" allowfullscreen="allowfullscreen"
                                                                mozallowfullscreen="mozallowfullscreen"
                                                                msallowfullscreen="msallowfullscreen"
                                                                oallowfullscreen="oallowfullscreen"
                                                                webkitallowfullscreen="webkitallowfullscreen"
                                                                data-src="https://www.youtube.com/embed/<?php echo $videoId ?>?rel=0&showinfo=0&color=white&iv_load_policy=3{{ $countVideo == 1 ? '&autoplay=0' : '' }}&mute=1">
                                                        </iframe>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="kt-portlet kt-portlet--height-fluid">
                                                <div class="kt-portlet__head">
                                                    <div class="kt-portlet__head-label" style="width:100%;min-height:30px;">
                                                        <h6 class="kt-portlet__head-title text-center" style="font-size: 1.4rem;width:100%;border-radius:0px !important;margin:10px;">
                                                            @if($obj->user->group == 'user')
                                                                <a class="text-muted text-left  loading" href="/{{ '@' .$obj->user->name_slug }}" >
                                                                    @if($obj->user->avatar && $obj->user->avatar != ' ' && $obj->user->avatar != '')
                                                                        <small style="margin-top:5px">
                                                                            <img  class="lazy img-circle"   src="/img/placeholder-trans.png" data-src="{{ $obj->user->avatar }}" data-srcset="{{ $obj->user->avatar }}"  style="width:36px;height:36px;">
                                                                        </small>
                                                                    @else
                                                                    <div style="margin-left:8px;display:inline-block; padding-top:8px;padding-left:1px;margin-top:0px;" class=" kt-header__topbar-icon text-white post-avatar">
                                                                        <b>{{ ucfirst($obj->user->name[0]) }}</b>
                                                                    </div>
                                                                        
                                                                    @endif
                                                                    <span class="text-right" style="font-size: 0.8em;">{{ $obj->user->name }}&nbsp;</span>

                                                                </a>

                                                            @else
                                                                <div class="text-left"><img class="avatar" src="/img/logo.svg" style="width:40px;"  alt="Avanturistic"> <b>Avanturistic</b></div>

                                                            @endif
                                                        </h6>
                                                    </div>

                                                </div>
                                                <div class="kt-portlet__body " style="padding:15px;">
                                                @if($obj->title)
                                                        <div class="kt-portlet__head">
                                                            <div class="kt-portlet__head-label" style="width:100%;">

                                                                <h2 class="text-left" style="width:100%;font-size:1.4em;">

                                                                    <a class="loading text-dark" href="/adventure/{{ $obj->id }}/{{ $obj->slug }}">
                                                                        {!! $obj->title !!}
                                                                    </a>

                                                                </h2>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                    @if(isset($obj->options['badges']) && count($obj->options['badges']))
                                                        <div class="kt-portlet__head">
                                                            <div class="kt-portlet__head-label" style="width:100%;padding-top:15px;">
                                                                <div class="row ">
                                                                    <div class="col-sm-12" style="padding-left:16px;" >
                                                                        <div class="row">
                                                                            @foreach($obj->options['badges'] as $key => $val)

                                                                                @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                                                    <div class="col-xs-3" style="margin-bottom: 10px;">
                                                                                        <a href="/outdoor-adventures/{{ $key }}" style="margin-right: 10px;font-size:0.8em;">
                                                                                        <div class="badge-wrap" style="cursor:pointer;display: inline-block;margin-right: 10px;border:2px solid {{ $badges[$key]['color'] }}; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 40px; height: 40px;margin-left: auto; margin-right: auto;padding: 6px;">
                                                                                            <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;filter:invert(0.5);" alt="{{ $key }} adventure location ">
                                                                                        </div>
<!-- <br>
                                                                                            <span class="text-dark" style="text-transform: lowercase;">&nbsp;<span class="text-success">#</span>{{ $badges[$key]['name'] }}</span> -->
                                                                                        </a>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                            
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                   
                                                    @if($obj->address)
                                                        <div class="kt-portlet__head">
                                                            <div class="kt-portlet__head-label" style="width:100%;">
                                                            <span class="kt-portlet__head-icon">
                                                                <i class="fa fa-map-marker-alt"></i>
                                                            </span>
                                                                <h3 class="kt-portlet__head-title text-left" style="width: 100%;">
                                                                    <small>{{ $obj->address }}</small>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($obj->country)
                                                        <div class="kt-portlet__head">
                                                            <div class="kt-portlet__head-label" style="width:100%;">
                                                            <span class="kt-portlet__head-icon">
                                                            <div style="margin-left:-1px;display:inline-block;border:1px solid #fcfcfc;background-image:url('/img/countries/svg/{{ strtolower($obj->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;">
                                                            </div>
                                                            </span>
                                                                <h4 class="text-left" style="width:100%;">

                                                                    <small style="font-size:0.7em;" class="text-muted">
                                                                        {{ $obj->country->title }}
                                                                    </small>

                                                                </h4>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            
                        </div>
                    </div> 
                    </section>
                </div>
                @if(count($stories))
                <div class="kt-portlet tab-pane "  role="tabpanel" style="padding-bottom:30px;margin-bottom:0;border-radius:0px;" id="stories">
                    <section>
                        <div class="kt-portlet__head text-center" style="min-height:30px;">
                            <div class="kt-portlet__head-label" style="width:100%;min-height:30px;">
                                <h3 class="kt-portlet__head-title text-center" style="font-size: 1.5rem;width:100%;border-radius:0px !important;margin:10px;padding:10px;">
                                    News & Stories
                                </h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body" >
                            <div class="kt-container ">
                                @if(count($stories))
                                    <div class="row">
                                        @foreach($stories as $obj)
                                            <div class="col-sm-3 ">
                                                <div class="kt-portlet  kt-portlet--height-fluid" >
                                                    <div class="kt-portlet__body" style="position:relative;padding:0;">
                                                        <a href="/{{$obj->slug}}">
                                                            <img class="image-thumbnail lazy top-radius" style=""  src="/img/placeholder-trans.png" data-src="{{ $obj->image[0]['thumb_path'] }}" data-srcset="{{ $obj->image[0]['thumb_path'] }}" alt="{{ $obj->title }} " title="{{ $obj->title }}" style="-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">

                                                            <h3 style="font-weight: 900;font-size:1.4rem;margin-top:10px;padding:15px;" class="text-dark">
                                                                {{ $obj->title }}
                                                            </h3>
                                                        </a>
                                                        <div class="text-muted" style="padding:15px;"> {!! $obj->description !!} </div>

                                                    </div>
                                                    <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                                                        <span> <small class="text-muted">{!! $obj->created_at->format('jS F Y') !!} </small></span>
                                                        
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                    @if(count($stories) > 4)
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="clearfix">
                                                    <a class="pull-right main-button loading" href="/stories"> VIEW ALL STORIES <i style="margin-left: 5px;" class="text-muted fa fa-angle-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </section>
                </div>
                @endif
            </div>
        </div>
    </div>
    @if($quote)
        <div style="background:rgba(0,0,0,0.5);">
        <!-- <section>
            <div class="kt-media-group text-center" style="display:block;margin:20px;margin-top:0;padding-top:40px;">
                    <h3 style="font-weight: bold;font-size:1.4rem;margin-top:10px;" class="text-white">
                        The Most Active Adventurers
                    </h3>
                    <div  style="padding-left:10px;">
                    @foreach($latestUsers as $obj)
                    
                        <a href="/{{ !$user ? '#' :'@' .$obj->name_slug}}" {{ !$user ? 'data-toggle=modal data-target=#signUpModal' : 'data-toggle=kt-tooltip' }} class="kt-media kt-media--sm kt-media--circle" style="position:relative;" data-skin="info" data-placement="top" title="" data-original-title="{{ ucfirst($obj->name)}}">
                            <img style="width:5rem;height:5rem;" width="60" height="60" class="lazy"   src="/img/placeholder-trans.png" data-src="{{ $obj->avatar ? $obj->avatar : '/img/avatar.png' }}" data-srcset="{{ $obj->avatar ? $obj->avatar : '/img/avatar.png' }}"  alt="{{ $obj->name }}" title="{{ $obj->name }}">
                            <div class="text-white" style="position:absolute;top:30%;left:0;right:0;">
                                @if(!$obj->avatar)
                                    {{ ucfirst($obj->name[0])}}
                                @endif
                            </div>
                        </a>
                    @endforeach
                    </div>
                    
                    
                </div>
            </section> -->
     
            
            <div class="kt-container text-center" >
                <section>
                    <div class="text-center text-white" style="padding-top:40px;width:80%;margin-left:auto;margin-right:auto;padding-bottom:40px;">
                        <h3 class="quote k-font" style="font-weight:400;font-size:1.8rem; font-style:italic;">{{ $quote->title}}</h3>
                        <p class="text-center" style="padding-left: 10px;padding-right: 10px;">
                            <b>&#8212;</b> {{ $quote->author }}
                        </p>
                    </div>
                </section>
            </div>
        </div>
    @endif
@endsection
