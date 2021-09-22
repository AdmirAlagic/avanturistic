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
                                                <h1 style="font-size:1.4rem;font-weight:300;margin:2rem;">{{ $model->name }}</h1>
                                            </a>
                                        </div>
                                        <div class="kt-widget__media text-center">
                                            
                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle- " >
                                                <div  class="kt-avatar__holder {{ $user && $user->id == $model->id ? 'dropzone-file-area dropzone dz-clickable' : '' }} img-circle" id="avatarImage" style="border-style:solid !important;border-radius:50%;background-image: url('{{ $model->avatar ? url($model->avatar) : '/img/avatar.png' }}');">
                                                    @if($user && $user->id == $model->id)
                                                        <div class="dz-message">
                                                            <label class="kt-avatar__upload dropzone-file-area  dz-clickable">
                                                                <i class="fa fa-camera text-muted"></i>

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
                                                <a href="/profile" class="flex items-center justify-center mt-10 mb-10">
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
                                                                     {{ UtilHelper::stripUrl($model->social_links['website']) }}
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
                                                <div class="kt-portlet p25 text-left m-lr-auto br-8" style="width: max-content;margin-bottom: 0;">
                                                    @if(isset($model->business_fields['address'])  && $model->business_fields['address'])
                                                    <div class=" mb-10">
                                                        <svg xmlns="http://www.w3.org/2000/svg"  class="mr-10 text-dark"  style="width:20px;" fill="none" viewBox="0 0 24 24" stroke="#999">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                          </svg>
                                                          <span class="font-light">
                                                            {{ $model->business_fields['address'] }}
                                                          </span>
                                                    </div>
                                                @endif
                                                    @if(isset($model->business_fields['phone'])  && $model->business_fields['phone'])
                                                        <div class=" mb-10" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-10 text-dark" style="width:20px;" fill="none" viewBox="0 0 24 24" stroke="#999">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                                
                                                            </svg>
                                                            <a  class="font-light" href="tel:{{ $model->business_fields['phone'] }}">{{ $model->business_fields['phone'] }}</a>
                                                        </div>
                                                    @endif
                                                    @if(isset($model->business_fields['email'])  && $model->business_fields['email'])
                                                        <div class=" mb-10">
                                                            <svg xmlns="http://www.w3.org/2000/svg"  class="mr-10 text-dark"  style="width:20px;" fill="none" viewBox="0 0 24 24" stroke="#999">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                                              </svg>
                                                            <a class="font-light" href="mailto:{{ $model->business_fields['email'] }}">{{ $model->business_fields['email'] }}</a>
                                                        </div>
                                                    @endif

                                                    <a class="btn btn-default mt-10 mb-10" href="/message/{{ $model->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg"  style="width:18px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                          </svg>
                                                          <span>Send Message</span>
                                                    </a>
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
                                                @if($user && $model->id == $user->id)
                                                    @if(!$model->country || !isset($model->options['badges']) || !$model->avatar)
                                                        <div style="padding:10px;margin:10px;border:1px solid #eeeeee;" class="border-r4">
                                                            @php $progressCountry = 1;@endphp
                                                            @if($model->avatar)
                                                                @php $progressCountry += 33;@endphp
                                                            @endif
                                                            @if($model->country)
                                                                @php $progressCountry += 33;@endphp
                                                            @endif
                                                            @if(isset($model->options['badges']) && count($model->options['badges']))
                                                                @php $progressCountry += 33;@endphp
                                                            @endif
                                                            <p class="text-center" style="margin-top:20px;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#666666" fill-rule="nonzero" opacity="0.3"/>
                                                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#666666" fill-rule="nonzero"/>
                                                                </g>
                                                            </svg>
                                                            Complete your profile
                                                            </p>
                                                            <p class="text-gray" style="margin:0;">
                                                            {{
                                                                intval( $progressCountry / 30)
                                                            }}/3 completed
                                                            </p>
                                                        
                                                                
                                                            <div class="progress">
                                                                    <div class="progress-bar kt-bg-success" role="progressbar" style="width: {{ $progressCountry}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            <div style="margin-bottom:20px;">
                                                                
                                                            
                                                            @if(!$model->avatar)
                                                                <a href="/profile#info" class="btn btn-line-rounded" style="width:100%;padding: .5em;">
                                                                    <div class="row img-fade-hover">
                                                                        <div class="col-2">
                                                                            <i style="font-size:1.1em;" class="fa fa-user text-muted"></i>
                                                                        </div>
                                                                        <div class="col-10 text-left">
                                                                        
                                                                            <span class="text-dark">Upload profile picture
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                
                                                                </a>
                                                                <br>
                                                            @endif
                                                            
                                                            @if(!$model->country)
                                                                <a href="/profile#info" class="btn btn-line-rounded" style="width:100%;padding: .5em;">
                                                                    <div class="row img-fade-hover">
                                                                        <div class="col-2">
                                                                            <i style="font-size:1.1em;" class="fa fa-flag text-muted"></i> 
                                                                        </div>
                                                                        <div class="col-10 text-left">
                                                                        
                                                                            <span class="text-dark">Set your country
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                
                                                                </a>
                                                                <br>
                                                                
                                                            @endif
                                                            
                                                            @if(!isset($model->options['badges']))
                                                                <a href="/profile#interests" class="btn btn-line-rounded" style="width:100%;padding: .5em;">
                                                                    <div class="row img-fade-hover">
                                                                        <div class="col-2">
                                                                            <i style="font-size:1.1em;" class="fa fa-mountain text-muted"></i> 
                                                                        </div>
                                                                        <div class="col-10 text-left">
                                                                        
                                                                            <span class="text-dark">Choose your services
                                                                        
                                                                        </div>
                                                                    </div>
                                
                                                                </a>
                                                             
                                                            @endif
                                                            <br>
                                                        </div>
                                                    </div>
                                                       
                                                @endif
                                            @endif
                                            @include('profile.quests.promote_country')
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
                    <div class="text-center">
                    
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