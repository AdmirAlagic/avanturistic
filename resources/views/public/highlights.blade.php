@extends('layouts.app')

@section('content')

    <!-- begin:: Content -->

    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="padding:0;" >

        <div class="kt-portlet" style="margin-bottom:0;padding-bottom:0;border-bottom:1px solid #474747;border-radius: 0px !important;">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-container padding0">
                    
                    <div id="highlights">
                        @foreach($timelapses as $timelapse)
                         
                                <div >
                                    <div class="row" >
                                        <div class="col-sm-4 offset-sm-4 text-right " style="background:#3C3C3C; padding:10px;padding-bottom:3px;padding-top:0px;">
                                            <div class="video-block">
                                                <video style="width:100%;position:relative;"    poster="{{ url('/img/placeholder-trans.png') }}"  playsinline autoplay loop muted class="lazy" >
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

                                            <div class="row" style="padding-left:5px;padding-right:5px;height:49px;padding-top:5px;">
                                                <div class="col-4 text-left " style="position:relative;">
                                                
                                                        @if($timelapse->user && $timelapse->user->group == 'user')
                                                        
                                                                <a class="text-white img-fade-hover overflow-dots" href="@{{ $timelapse->user->name }}" style="position: relative; display:inline-block;">
                                                                    <span>
                                                                        <small>
                                                                        @if($timelapse->user->avatar && $timelapse->user->avatar != ' ' && $timelapse->user->avatar != '')
                                                                                <span><img  class="lazy img-circle img-fade-hover"  src="/img/placeholder-trans.png" data-src="{{ $timelapse->user->avatar }}" data-srcset="{{ $timelapse->user->avatar }}" width="37" height="37" style="width:37px;border:1px solid #474747;" alt="{{ $timelapse->user->name  }}"></span>
                                                                            @else
                                                                                <div style="display:inline-block; padding-top:10px;padding-left:1px;margin:0;" class=" kt-header__topbar-icon text-white post-avatar"><b>{{ ucfirst($timelapse->user->name[0]) }}</b></div>
                                                                            @endif
                                                                    </small>
                                                                    </span>
                                                                    <span  style="padding-top:16px;left:5px;white-space: nowrap;"> <small><b>&nbsp;{{ $timelapse->user->name }}</b></small></span>
                                                                </a>
                                                            
                                                        @else
                                                            <span class="text-white" style="padding-top:5px;"><img class="avatar" src="/img/logo.svg" width="36" height="36" style="width:36px;"  alt="Avanturistic"> </span>
                                                        @endif
                                                    
                                                    
                                                
                                                </div>
                                                <div class="col-6 text-left">
                                                @if($timelapse->post)
                                                        <a class="btn  img-fade-hover text-white btnOutline" href="/adventure/{{ $timelapse->post->id }}/{{ $timelapse->post->slug }}">
                                                            View Adventure
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="col-2 text-right">
                                                    <div class="circle-timelapses-toolbar text-right" style="padding:0px;">

                                                        <div style="font-size: 16px;">
                                                        
                                                            
                                                             
                                                                <a  href="#" data-timelapse_id="{{ $timelapse->id }}" class="like  text-center" style="margin-right: 5px;">

                                                                <i class="fa fa-heart {{ isset($timelapse->likeExists) && $timelapse->likeExists   ? 'text-success' : 'text-white' }}" style="width:36px;height:36px;; -webkit-border-radius: 99999em;-moz-border-radius: 99999em;border-radius: 99999em;  padding-top: 10px;background: #474747; "></i>

                                                                </a>
                                                            
                                                        </div>
                
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                          
                                        </div>
                                    
                                    </div>
                                </div>
                            
                         
                            
                        
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

