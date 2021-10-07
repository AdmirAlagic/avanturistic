@extends('layouts.app')

@section('content')
<div style="min-height:750px;"> 
    <div class="kt-container" style="padding:0;" id="public-profile">
        <div class="row">
            <div class="col-md-5 col-sm-5">
                <!--begin::Portlet-->
                <div class="kt-grid__item kt-app__toggle " id="">

                    <!--Begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid" style="margin-bottom:0;">

                        <div class="kt-portlet__body padding0" >
                            <div class="">

                                <div class="row">

                                    <div class="col-12 text-center">

                                        <div class="kt-widget__section">
                                            <a href="#" class="kt-widget__username text-dark" >
                                                <h1 class="m-lr-auto" style="font-size:1.4rem;font-weight:300;margin:2rem; position:relative;width:max-content;">{{ $model->name }}
                                                    @if($model->email_verified_at)
                                                    <span style="position: absolute;top: -5px; right: -20px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-success"  style="width:18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                                        </svg>
                                                    </span>
                                                @endif
                                            </h1>
                                            </a>
                                        </div>
                                        <div class="kt-widget__media text-center">
                                            
                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle- " >
                                                <div  class="kt-avatar__holder {{ $user && $user->id == $model->id ? 'dropzone-file-area dropzone dz-clickable' : '' }} img-circle" id="avatarImage" style="border-style:solid !important;border-radius:50%;background-image: url('{{ $model->avatar ? url($model->avatar) : '/img/avatar.png' }}');">
                                                    @if($user && $user->id == $model->id)
                                                        <div class="dz-message">
                                                            <label class="kt-avatar__upload dropzone-file-area  dz-clickable" >
                                                                <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                  </svg>
                                                            </label>
                                                        </div>
                                                    @endif
                                                    @if(!$model->avatar || $model->avatar == ' ' || $model->avatar == '')
                                                        <div  style="padding-top:1.5em;font-size:2rem;" >{{ ucfirst($model->name[0]) }}</div>
                                                    @endif
                                                    <input type="hidden" name="avatar">
                                                </div>
                                                <div class="dz-previews dz-clickable" style="display: none; visibility: hidden;"></div>
                                                
                                            </div>
                                            <br>
                                            @if($user && $model->id != $user->id)
                                            <br>
                                          
                                            @endif
                                            @if($user && $model->id == $user->id)
                                                <a href="/profile" class="btn btn-line-rounded  mt-10 mb-10">
                                                    <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" style="width:16px;" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="kt-nav__link-text">Edit Profile </span>
                                                </a>
                                               
                                            @endif 
                                            @if($hasSocial)
                                                <div class="kt-widget__content mt-10 mb-10 profile-social-links " style="padding-bottom:15px;">
                                                    
                                                    <div class="row">

                                                        <div class="col-12 text-center">
                                                            @if(isset($model->social_links['website']) && $model->social_links['website'] && $model->social_links['website'] != ' ')
                                                            <p>
                                                                <a class="font-light" target="_blank" href="{{ UtilHelper::externalURL($model->social_links['website'] , '') }}">
                                                                     {{ UtilHelper::cleanUrl($model->social_links['website']) }}
                                                                </a>
                                                            </p>
                                                            @endif
                                                           
                                                            @if(isset($model->social_links['facebook']))
                                                                <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['facebook'] , 'facebook.com') }}">
                                                                    <i class="la la-facebook  img-fade-hover" style="font-size:2.3rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['instagram']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['instagram'] , 'instagram.com') }}">
                                                                    <i class="la la-instagram img-fade-hover" style="font-size:2.3rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['youtube']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['youtube'] , 'youtube.com/channel') }}">
                                                                    <i class="la la-youtube-play img-fade-hover" style="font-size:2.3rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['pinterest']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['pinterest'] , 'pinterest.com') }}">
                                                                    <i class="la la-pinterest img-fade-hover" style="font-size:2.3rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['linkedin']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['linkedin'] , 'linkedin.com/in') }}">
                                                                    <i class="la la-linkedin img-fade-hover" style="font-size:2.3rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['twitter']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['twitter'] , 'twitter.com') }}">
                                                                    <i class="la la-twitter img-fade-hover" style="font-size:2.3rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['tripadvisor']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['tripadvisor'] , 'tripadvisor.com') }}">
                                                                    <i class="la la-tripadvisor img-fade-hover"  style="font-size:2.3rem;"></i>
                                                                </a>
                                                            @endif
                                                        
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                @endif
                                                @if($model->group == \App\User::$_USER_GROUP_BUSINESS)
                                                <div class="kt-portlet p25 text-left m-lr-auto br-8" style="margin-bottom: 0;">
                                                    @if($model->country)
                                                        <div class=" mb-10">
                                                             
                                                            <span class="font-light text-right " >
                                                                <span class="mr-10" style="font-size:1.5rem;">
                                                                    {{ $model->country->emoji }}
                                                                    </span>{{ $model->country->title }}
                                                            {{--   @if($model->country)
                                                                    <span class="text-gray">{{ $model->country->title }}</span>
                                                                @endif --}}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    @if(isset($model->business_fields['address'])  && $model->business_fields['address'])
                                                        <div class=" mb-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  class="mr-10 text-dark"  style="width:22px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                            <span class="font-light text-right">
                                                                {{ $model->business_fields['address'] }}
                                                            {{--   @if($model->country)
                                                                    <span class="text-gray">{{ $model->country->title }}</span>
                                                                @endif --}}
                                                            </span>
                                                        </div>
                                                    @endif

                                                    @if(isset($model->business_fields['phone'])  && $model->business_fields['phone'])
                                                        <div class=" mb-10" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-10 text-dark" style="width:22px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                
                                                            </svg>
                                                            <a  class="font-light" href="tel:{{ $model->business_fields['phone'] }}">{{ $model->business_fields['phone'] }}</a>
                                                        </div>
                                                    @endif

                                                    @if(isset($model->business_fields['email'])  && $model->business_fields['email'])
                                                        <div class=" mb-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  class="mr-10 text-dark"  style="width:22px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                              </svg>
                                                            <a class="font-light" href="mailto:{{ $model->business_fields['email'] }}">{{ $model->business_fields['email'] }}</a>
                                                        </div>
                                                    @endif

                                                    @if($alwaysOpen)
                                                        <div class="flex items-center mb-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  class="mr-10 text-dark"  style="width:22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg> 
                                                            <span class="text-green font-boldest">Open now</span>
                                                        </div>
                                                    @else
                                                        @if($openingHours)
                                                            <div class="flex items-center mb-10">
                                                                <svg xmlns="http://www.w3.org/2000/svg"  class="mr-10 text-dark"  style="width:22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg> 
                                                            
                                                                <div>   
                                                                    {{ $openingHours }}
                                                                    <b>@if($isOpen)
                                                                        <span class="text-green">Open</span>
                                                                        @else
                                                                        Currently closed
                                                                        @endif</b>
                                                                </div>
                                                            </div>
                                                        @else
                                                        <div class="flex items-center mb-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  class="mr-10 text-dark"  style="width:22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg> 
                                                         
                                                                Currently closed
                                                        </div>
                                                     
                                                        @endif
                        
                                                    @endif
                                                    @if($user->id != $model->id)
                                                    <div class="flex items-center">
                                                        <a class="btn btn-line-rounded mt-10 mb-10 btn-tall mr-10" style="width:max-content;" href="/message/{{ $model->id }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  style="width:18px;margin-top: -2px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                            </svg>
                                                            <span class="font-light">Send Message</span>
                                                                
                                                        </a>
                                                        @if(isset($model->business_fields['phone']) && $model->business_fields['phone'])
                                                        <a class="btn btn-line-rounded btn-tall mt-10 mb-10 font-light  " style="width:max-content;" href="tel:{{ $model->business_fields['phone'] }}">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  style="width: 18px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                            </svg>
                                                            Call {{ $model->business_fields['phone'] }}
                                                        </a>
                                                    </div>
                                                    @endif
                                                @endif
                                                </div>

                                                @endif
                                              
                                                @if($model->description)
                                                    <div class="row">
                                                        <div class="col-12 flex items-center justify-center" style="padding:20px;">
                                                        

                                                            <svg xmlns="http://www.w3.org/2000/svg" style="width:16px;" class="mr-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>

                                                                <span class="kt-widget__data text-center" style="font-size:0.9em;">

                                                            {!! $model->description!!}
                                                            </span>
                                                        
                                                        </div>
                                                    </div>
                                                @endif
                                                @include('profile.quests.set_info')
                                               
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                </div>
            </div>
            <div class="col-md-7 col-sm-7" style="padding:0;margin:0;">

                <div class="kt-portlet kt-portlet--tabs profile-tabs text-center " style="padding: 0;margin-bottom: 0;-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;margin-bottom: 0px;">
                    <div class="text-center bb-e" >
                    
                        <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-line-brand" role="tablist" style=" display: inline-flex;margin:0;">  
                            <li class="nav-item" id="nav-item-adventures" style="display: inline-block;">
                                <a id="nav-link-info" class="nav-link active"  style="font-size:0.8em;"  data-toggle="tab" href="#adventures" role="tab">
                                
                                    <div class="nav-link-desc" style="text-transform: uppercase;text-align:center;color:#3C3C3C;">
                                        Adventures
                                    </div>
                                </a>
                                
                            </li>
                            <li class="nav-item nav-adventures" style="display: inline-block;">
                                <a  id="nav-link-interests" class="nav-link "  style="font-size:0.8em;"  data-toggle="tab" href="#info" role="tab">
                                     
                                    <div class="nav-link-desc" style="text-transform: uppercase;text-align:center;color:#3C3C3C;">
                                        Info
                                    </div>
                                </a>
                                
                            </li>
                            
                        </ul>
                    
                    </div>
                </div> 
                <div class="tab-content" style="min-height:600px;">
                    <div class="tab-pane active" id="adventures" role="tabpanel">
                        
                        <div class="kt-container kt-profile-post">
                        <div id="profile-map" style="width:100%;z-index:1;height:250px;border-top-right-radius: px; border-top-left-radius: 0px;border-bottom:1px solid #FFFFFF;">
                           
                        </div>
                        
                        <div class="profile-masonry-grid" style="margin-left:-1px;margin-right:-1px;">
                            <div class="grid-sizer"></div>
                            {!! Form::hidden('user_id', $model->id, ['id' => 'hidden-user_id']) !!}
                            <div id="profile-posts">
                                {{--js--}}
                            </div>
                        </div>
                        </div>
                         
                    </div>
                    <div class="tab-pane" id="info" role="tabpanel">
                        <div class="kt-portlet">
                            <div class="kt-portlet__body">
                                <div class="kt-widget__body">
                                    <div class="kt-widget__content" style="padding: 10px;">
                                        
                                        <div class="clearfix text-center">

                                            <div class="row">
                                                
                                                @if($model->country)
                                                    <div class="col-4">
                                                        <h5 style="font-size: 0.9em;" class="text-center">Country</h5> 

                                                            <a href="/country/{{ $model->country->slug }}" class="img-fade-hover">
                                                            <div style="background-image:url('/img/countries/svg/{{ strtolower($model->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover;  border:2px solid #999999;   background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 30px; height: 30px;margin-left: auto; margin-right: auto;padding: 0px;">
                                                
                                                                </div>
                                                                
                                                                <h6 class="text-gray" style="font-size: 0.8em;margin-top:10px;font-weight:300;">
                                                                    {!! $model->country->title  !!}
                                                                </h6>
                                                            </a>

                                                            <input type="hidden" id="country-lat"
                                                                value="{{ $model->country->lat }}">
                                                            <input type="hidden" id="country-lng"
                                                                value="{{ $model->country->lng }}">
                                                        
                                                    
                                                    </div>
                                                @endif
                                               
                                                    <div class="col-4">
                                                        <h5 style="font-size: 0.9em;" class="text-center">Outdoor <br> Adventures</h5> 
                                                        
                                                      
                                                        <span style="font-size:1.5em;">
                                                            {{ count($model->posts) }}
                                                        </span>
                                                         
                                                    </div>
                                                
                                               
                                                <div class="col-4">
                                                    @if(isset($model->options['visited_countries']) && count($model->options['visited_countries']))
                                                        
                                                        <h5  style="font-size: 0.9em;" class="text-center">Countries <br> Visited</h5> 
                                                         
                                                        <span class="kt-boldest" style="font-size:1.5em;">
                                                            {{  count($model->options['visited_countries']) }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                        </div>
                                        
                                                
                                                    
                                        @if(isset($model->options['badges']))
                                            <div class="row text-center mt-10 mb-10" >
                                                <div class="col-12">
                                                    <h5 style="font-size: 0.9em;" class="text-center">Services</h5> 
                                                </div>
                                            </div>
                                            <div class="row text-center mb-10" >
                                            @foreach($model->options['badges'] as $key => $val)

                                                @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                    <div class="col-4 flex items-center justify-center" style="margin-bottom:20px;">
                                                        <a href="/outdoor-adventures/{{ $key }}" style="margin-right: 10px;font-size:0.8em;">
                                                            <div class="badge-wrap" style="cursor:pointer;display: inline-block;margin-right: 10px;border:2px solid {{ $badges[$key]['color'] }}; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;margin-left: auto; margin-right: auto;padding: 6px;">
                                                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;filter: invert(0.8);">
                                                            </div>
 
                                                            <div class="text-dark mt-10 " style="font-weight:normal;">{{ $badges[$key]['name'] }}</div>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        @endif

                                        @if($visitedCountries && count($visitedCountries))
                                        <br>
                                            <div class="row text-center  mt-20 ">
                                                <div class="col-12">
                                                    <h5 style="font-size: 0.9em;" class="text-center">Visited Countries</h5> 
                                                </div>
                                            </div>
                                             
                                           <div class="row mt-10" style="padding-left:2rem;padding-right:2rem;">
                                               <div class="col-12 text-center">
                                                    <div class="flex justify-center" style="flex-wrap:wrap;">
                                                        @foreach($visitedCountries as $visitedCountry)
                                                           
                                                            {{--     <a class=" mr-10 mb-10 img-fade-hover text-muted" style="font-weight:400;" href="/country/{{ $visitedCountry->slug }}">
                                                                    <div style=" display:inline-block;border:1px solid #999;background-image:url('/img/countries/svg/{{ strtolower($visitedCountry->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 30px; height: 30px;">
                                                                    </div>
                                                                </a> --}}
                                                                <div class="">
                                                                    <a class="btn" href="/country/{{ $visitedCountry->title }}">
                                                                         <span class="">{!! $visitedCountry->emoji !!}</span>
                                                                        {{ $visitedCountry->title }}
                                                                    </a>
                                                                </div>
                                                            
                                                        @endforeach
                                                    </div>
                                               </div>
                                           </div>
                                            
                                        @endif
                                                    
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
