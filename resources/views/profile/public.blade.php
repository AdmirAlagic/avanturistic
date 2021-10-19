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
                                            
                                            <div class="kt-avatar kt-avatar--outline kt-avatar--circle- " style="margin-bottom:30px;" >
                                                <div  class="kt-avatar__holder {{ $user && $user->id == $model->id ? 'dropzone-file-area dropzone dz-clickable' : '' }} img-circle" id="avatarImage" style="border-style:solid !important;border-radius:50%;background-image: url('{{ $model->avatar ? url($model->avatar) : '' }}');">
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
                                            <a class="btn btn-line-rounded mt-10 mb-10" href="/message/{{ $model->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg"  style="width:18px;margin-top: -2px;" fill="none" viewBox="0 0 24 24" stroke="#474747">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                  </svg>
                                                  <span>Send Message</span>
                                            </a>
                                          
                                            @endif
                                            @if($user && $model->id == $user->id)
                                                <a href="/profile" class="btn btn-line-rounded mt-10 mb-10">
                                                    <svg class="mr-5" xmlns="http://www.w3.org/2000/svg" style="width:16px;" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="kt-nav__link-text">Edit Profile </span>
                                                </a>
                                               
                                            @endif 
                                            @if($hasSocial)
                                                <div class="kt-widget__content mt-10 mb-10 " style="padding-bottom:15px;">
                                                    
                                                    <div class="row">

                                                        <div class="col-12 text-center">
                                                            @if(isset($model->social_links['website']) && $model->social_links['website'] && $model->social_links['website'] != ' ')
                                                            <p>
                                                                <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['website'] , '') }}">
                                                                     {{ UtilHelper::cleanUrl($model->social_links['website']) }}
                                                                </a>
                                                            </p>
                                                            @endif
                                                           
                                                            @if(isset($model->social_links['facebook']))
                                                                <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['facebook'] , 'facebook.com') }}">
                                                                    <i class="la la-facebook text-dark img-fade-hover" style="font-size:2.5rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['instagram']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['instagram'] , 'instagram.com') }}">
                                                                    <i class="la la-instagram text-dark img-fade-hover" style="font-size:2.5rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['youtube']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['youtube'] , 'youtube.com/channel') }}">
                                                                    <i class="la la-youtube-play text-dark img-fade-hover" style="font-size:2.5rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['pinterest']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['pinterest'] , 'pinterest.com') }}">
                                                                    <i class="la la-pinterest text-dark img-fade-hover" style="font-size:2.5rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['linkedin']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['linkedin'] , 'linkedin.com/in') }}">
                                                                    <i class="la la-linkedin text-dark img-fade-hover" style="font-size:2.5rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['twitter']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['twitter'] , 'twitter.com') }}">
                                                                    <i class="la la-twitter text-dark img-fade-hover" style="font-size:2.5rem;"></i>
                                                                </a>
                                                            @endif
                                                            @if(isset($model->social_links['tripadvisor']))
                                                            <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['tripadvisor'] , 'tripadvisor.com') }}">
                                                                    <i class="la la-tripadvisor text-dark img-fade-hover"  style="font-size:2.5rem;"></i>
                                                                </a>
                                                            @endif
                                                        
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                @endif
                                                @if($model->description)
                                                    <div class="row">
                                                        <div class="col-12" style="padding:20px;">
                                                        

                                                                <span><i class="fa fa-info-circle text-gray"></i></span>&nbsp;&nbsp;

                                                                <span class="kt-widget__data text-center" style="font-size:0.9em;">

                                                            {!! $model->description!!}
                                                            </span>
                                                        
                                                        </div>
                                                    </div>
                                                @endif
                                                @include('profile.quests.set_info')
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
            @if(Auth::check())
                <div class="kt-portlet kt-portlet--tabs profile-tabs text-center " style="padding: 0;margin-bottom: 0;-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;margin-bottom: 0px;">
                    <div class="text-center bb-e">
                    
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
                                                    <h5 style="font-size: 0.9em;" class="text-center">Interests</h5> 
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
            @else
                <div class="kt-portlet">
                    <div class="kt-portlet__body flex items-center" style="background-color:#eeeeee;">
                    <p style="margin:0;padding:0;">
                     
                        <svg xmlns="http://www.w3.org/2000/svg" style="width:44px;border-right: 1px solid #999; padding-right: 10px;" class="mr-10" fill="none" viewBox="0 0 24 24" stroke="#999">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <a class="btn btn-line-rounded mr-10" href="/login">Log in</a> or <a data-toggle=modal data-target=#signUpModal class="btn btn-line-rounded mr-10 ml-10" href="/sign-up">Sign Up</a> to view full profile.
                    </p>
                    </div>
                </div>
                @endif
        </div>
    </div>
</div>

@endsection
