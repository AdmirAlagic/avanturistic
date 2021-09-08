@extends('layouts.app')

@section('content')
<div style="min-height:750px;"> 
    <div class="kt-container" style="padding:0;">
        <div class="row">
            <div class="col-md-5 col-sm-5">
                <!--begin::Portlet-->
                <div class="kt-grid__item kt-app__toggle " id="">

                    <!--Begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid" style="margin-bottom:0;">

                        <div class="kt-portlet__body" style="padding-left:0;padding-right:0;">
                            <div class="">

                                <div class="row">

                                    <div class="col-12 text-center">

                                        <div class="kt-widget__section">
                                            <a href="#" class="kt-widget__username text-dark" >
                                                <h1 style="font-size:1.5rem;">{{ $model->name }}</h1>
                                            </a>
                                        </div>
                                        <div class="kt-widget__media text-center">
                                            <br>
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
                                                        <div class="text-white" style="padding-top:1.5em;font-size:2rem;" ><b>{{ ucfirst($model->name[0]) }}</b></div>
                                                    @endif
                                                    <input type="hidden" name="avatar">
                                                </div>
                                                <div class="dz-previews dz-clickable" style="display: none; visibility: hidden;"></div>
                                                
                                            </div>
                                            <br>
                                            @if($user && $model->id != $user->id)
                                            <br>
                                            <a href="/message/{{ $model->id }}" class="kt-nav__link" >
                                                <div class="img-circle sendMessageBtn">
                                                <i  class="fa fa-envelope"></i>
                                                    <span><small>Send message</small></span>
                                                </div> 
                                                
                                            </a><br><br>
                                            @endif
                                            @if($user && $model->id == $user->id)
                                                <a href="#" class="dropdown-toggle dots "data-toggle="dropdown">
                                                    <div class="text-muted btn-dots" style="font-size:2.2em;margin-right:5px;">
                                                    ...
                                                    </div>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-center text-center" style="margin:0;">
                                                    <ul class="kt-nav">
                                                    <li class="kt-nav__item">
                                                            <a href="/profile" class="kt-nav__link">
                                                                <i class="fa fa-cogs text-muted"></i> 
                                                                <span class="kt-nav__link-text">Edit Profile</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif 
                                            @if($hasSocial)
                                                <div class="kt-widget__content">
                                                    <hr>
                                                    <div class="row">

                                                        <div class="col-12 text-center">
                                                            @if(isset($model->social_links['website']))
                                                                <a target="_blank" href="{{ UtilHelper::externalURL($model->social_links['website'] , '') }}">
                                                                    <i class="la la-globe text-dark img-fade-hover" style="font-size:2.4rem;"></i>
                                                                </a>
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
                                                                        
                                                                            <span class="text-dark">Upload <b>profile picture</b>
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
                                                                        
                                                                            <span class="text-dark">Set your<b> country</b>
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
                                                                        
                                                                            <span class="text-dark">Choose your<b> interests</b>
                                                                        
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

                <div class="kt-portlet kt-portlet--tabs text-center" style="padding: 0;margin-bottom: 0;-webkit-border-radius: 0px;-moz-border-radius: 0px;border-radius: 0px;margin-bottom: 0px;">
                    <div class="text-center">
                    
                        <ul class="nav nav-tabs nav-tabs-space-xl nav-tabs-line nav-tabs-line-brand" role="tablist" style=" display: inline-flex;margin:0;">  
                            <li class="nav-item" id="nav-item-adventures" style="display: inline-block;">
                                <a id="nav-link-info" class="nav-link active"  style="font-size:0.8em;"  data-toggle="tab" href="#adventures" role="tab">
                                
                                    <div class="nav-link-desc" style="text-transform: uppercase;text-align:center;color:#333;">
                                        Adventures
                                    </div>
                                </a>
                                
                            </li>
                            <li class="nav-item nav-adventures" style="display: inline-block;">
                                <a  id="nav-link-interests" class="nav-link "  style="font-size:0.8em;"  data-toggle="tab" href="#info" role="tab">
                                     
                                    <div class="nav-link-desc" style="text-transform: uppercase;text-align:center;color:#333;">
                                        Info
                                    </div>
                                </a>
                                
                            </li>
                            @if(count($timelapses))
                            <li class="nav-item nav-timelapses" style="display: inline-block;">
                                <a  id="nav-link-timelapses" class="nav-link "  style="font-size:0.8em;"  data-toggle="tab" href="#timelapses" role="tab">
                                     
                                    <div class="nav-link-desc" style="text-transform: uppercase;text-align:center;color:#333;">
                                        Timelapses
                                    </div>
                                </a>
                                
                            </li>
                            @endif
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
                                                        <h5 style="font-size: 0.9em;"><b>Country</b></h5> 

                                                            <a href="/country/{{ $model->country->slug }}" class="img-fade-hover">
                                                            <div style="background-image:url('/img/countries/svg/{{ strtolower($model->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover;  border:2px solid #999;   background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;margin-left: auto; margin-right: auto;padding: 0px;">
                                                
                                                                </div>
                                                                
                                                                <h6 class="text-muted" style="font-size: 0.9em;margin-top:10px;">
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
                                                        <h5 style="font-size: 0.9em;"><b>Outdoor Adventures</b></h5> 
                                                        
                                                      
                                                        <span class="text-green" style="font-size:1.3em;"><b>{{ count($model->posts) }}</b></span>
                                                         
                                                    </div>
                                                
                                               
                                                <div class="col-4">
                                                    @if(isset($model->options['visited_countries']) && count($model->options['visited_countries']))
                                                        
                                                        <h5 style="font-size: 0.9em;"><b>Countries Visited</b></h5> 
                                                         
                                                        <span class="text-green" style="font-size:1.3em;">
                                                            <b>
                                                            {{  count($model->options['visited_countries']) }}
                                                            </b>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                    
                                        </div>
                                        
                                                
                                                    
                                        @if(isset($model->options['badges']))
                                            <div class="row text-center" style="margin-top:10px;">
                                                <div class="col-4">
                                                    <h5 style="font-size: 0.9em;"><b>Interests</b></h5> 
                                                </div>
                                            </div>
                                            <div class="row text-center" >
                                            @foreach($model->options['badges'] as $key => $val)

                                                @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                    <div class="col-4 " style="margin-bottom:10px;">
                                                        <a href="/outdoor-adventures/{{ $key }}" style="margin-right: 10px;font-size:0.8em;">
                                                            <div class="badge-wrap" style="cursor:pointer;display: inline-block;margin-right: 10px;border:2px solid {{ $badges[$key]['color'] }}; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;margin-left: auto; margin-right: auto;padding: 6px;">
                                                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;filter: invert(0.5);">
                                                            </div>

                                                            <br>
                                                            <span class="text-dark " style="padding-left:5px;font-weight:normal;">{{ $badges[$key]['name'] }}</span>
                                                        </a>
                                                    </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        @endif
                                                    
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane " id="timelapses" role="tabpanel">
                    <div class="kt-portlet">
                        <div class="kt-portlet__body padding0">
                            <div class="kt-container">
                           
                                    <div id="highlights">
                                        <div class="row" >
                                            @foreach($timelapses as $timelapse)

                                                <div class="col-12 col-sm-4 offset-sm-4 text-right " style="padding:0;">
                                                    <div class="video-block">
                                                        <video style="width:100%;position:relative;"    poster="{{ url('/img/placeholder-trans.png') }}"     loop muted class="lazy" >
                                                            <source src="" data-src="{{ url($timelapse->path) }}" type="video/mp4">
                                                            <source src="" data-src="{{ url($timelapse->path_webm) }}" type="video/webm">
                                                        </video>

                                                        <span class="volume">
                                                            <i class="fa fa-volume-mute"></i>
                                                        </span>
                                                        
                                                        @if($timelapse->post && $timelapse->post->is_recommended)
                                                        
                                                            <div style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 30px; height: 30px;position:absolute;bottom:12%;left:10px;">
                                                                <img class="lazy" src="{{ url('/img/placeholder-trans.png') }}" data-src="{{ url('/img/star.svg') }}" alt="Avanturistick Pick" data-srcset="{{ url('/img/star.svg') }}" style="width:35px;">
                                                            </div>
                                                        @endif
                                                    </div>

                                                    
                                                </div>
                                            
                                            @endforeach
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
</div>

@endsection
