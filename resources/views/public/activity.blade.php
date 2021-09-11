@extends('layouts.app')

@section('content')
 
    <!--begin::Portlet-->
    <style>.full-width-bg:before {

            background: url('{{ $activity['bg_image'] }}') no-repeat center center;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            will-change: transform; // creates a new paint layer
        z-index: -1;
        }</style>
    @include('shared.success_error')
    <div class="full-width-bg" style="color:#FFFFFF;position:relative;overflow: hidden; border-bottom:2px solid #3C3C3C;">
        <div class="intro" style="z-index: 1;padding: 20px;margin-bottom: 150px; margin-top: 150px;background: #000000ad; font-size:1.4rem;font-weight: 600;">
            @if(!$user)
                <div class="text-center text-white">
                    @if(isset($activity->options['intro_description_share1']))
                    {!! $activity->options['intro_description_share1'] !!}
                    @endif
                    <a  style="-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;display: inline-flex;" class="btn btn-success text-white" href="/share?category={{ $activity->slug  }}">
                        <div style="display: inline;width:45px;height:45px;margin-right: 10px;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; border:3px solid #FFFFFF; padding: 5px;">
                            <img width="45" src="{{ $activity->icon_empty  }}" alt="Share {{ $activity->title  }} adventure">
                        </div>

                        <h4 style="margin-bottom:0;display: inline;font-size:1.2rem;" >  Share <b>{{ strtolower($activity->title)  }}</b> adventure
                        </h4>
                    </a>

                </div>
                <br>

                @if(isset($activity->options['intro_description_explore']) && $activity->options['intro_description_explore'] != '')
                    <p class="text-center text-white" style="margin-bottom:0;margin-top: 10px;">OR</p>
                    <br>
                    {!! $activity->options['intro_description_explore'] !!}
                @endif
                <br>
            @else 
            <div class="text-center" style="width:100%">
                <a  style="-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;display: inline-flex;" class="btn btn-success text-white" href="/share?category={{ $activity->slug  }}">
                    <div style="display: inline;width:45px;height:45px;margin-right: 10px;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; border:3px solid #FFFFFF; padding: 5px;">
                        <img width="45"  src="{{ $activity->icon_empty  }}" alt="Share {{ $activity->title  }} adventure">
                    </div>
    
                    <h4 style="margin-bottom:0;display: inline;font-size:1.2rem;" >
                        <b>
                            @if(isset($activity->options['share_btn'] ))
                                {{ $activity->options['share_btn'] }}
                            @else
                            Share <b>{{ strtolower($activity->title)  }}</b> adventure
                            @endif
                        </b>
                    </h4>
                </a>
            </div>
            
            @endif
        </div>
    </div>

    <div class="kt-portlet" style="border-radius:0px;margin-bottom: 0px;">

        <div class="kt-portlet__head text-center" style="z-index: 1;background:#FFFFFF;">
            <div class="kt-portlet__head-label text-center" style="width:100%">


                <div class="text-center" style="width:100%;padding: 10px;">
                    <div class="text-center" style="width:100%;">
                        <div class="badge-wrap" style="cursor:pointer;margin-left: auto;margin-right: auto; margin-top: 10px; margin-bottom: 10px; -webkit-box-shadow: 0px 0px 3px 0px rgb(102 102 102);-moz-box-shadow: 0px 0px 3px 0px rgb(102 102 102);box-shadow: 0px 0px 3px 0px rgb(102 102 102); border:3px solid {{ $activity['color'] }};background: #474747;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 60px; height: 60px;padding: 10px;">
                            <img  src="{{ $activity->icon_empty }}" style="width:60px;">
                        </div>
                        <h1 class="kt-portlet__head-title" style="font-size: 1.8rem;width:100%;border-radius:0px !important;margin-bottom: 10px;">
                            <span class="text-muted">Personal <b>{{ strtolower($activity->title) }}</b>  experiences & <b>{{ strtolower($activity->title) }}</b> spots near you</b>  </span>
                        </h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{--list--}}
    <div id="activity" data-key="{{ $activity->slug }}"></div>

    <div class="kt-portlet__body" style="padding-top:3px;background-color:#FFFFFF;">
        
        <div class="kt-container filter-toolbar-container" >
        @include('shared.lists.toolbar')
        
            <div class="row">
                <div class="col-sm-12 text-center" style="padding: 0;min-height:600px;" >
                    {{--<div style="width:100%;" class="text-center">--}}
                    {{--<div class="toolbar" style="margin-bottom:20px;">--}}
                    <div class="kt-container" style="padding: 0;" style="min-height:800px;">
                        <div id="adventures-grid" class="adventures-masonry-grid" style="cursor: pointer;">
                            <div class="adventure-grid-sizer"></div>

                        </div>

                        <div id="more-posts" style="min-height:100px;padding:15px;">
 
                        </div>
                        <br>
                        @if(!$hasPosts)
                        <div class="" style="font-size:0.8em;">
                             
                            <p>No adventures for this activity. <br> Be first to  <a href="/share?category={{ $activity->slug  }}"> share <b>{{ $activity->title }}</b> adventure</a>.</p>
                        </div>
                        @else
                        <div id="scrollForMore" class="" style="font-size:0.8em;">
                            <p class="text-center">
                                <i style="font-size:1.4em;" class="fa fa-angle-down"></i>
                            </p>
                            <p>Swipe down to see more adventures.</p>
                        </div>
                        @endif
                        
                    </div>

 
                </div>
            </div>
        </div>
        @if(isset($activity->options['about']))
            <div class="kt-container p25" style="border-top:1px solid #eee;">
                {!! $activity->options['about'] !!}
            </div>
        @endif
    </div>
    
    <div class="share-buttons text-center" style=" padding: 10px; background: rgba(0,0,0,0.35);">
                                                <div class="text-white">
                                                   <b> Share with {{ strtolower($activity->title) }} enthusiasts</b>
                                                </div>
        <!-- Sharingbutton Facebook -->
        <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https://avanturistic.com/outdoor-adventures/{{ $activity->slug}}" target="_blank" rel="noopener" aria-label="">
            <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                    <svg style="width:16px;height:16px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.5H14.5V5.6c0-.9.6-1.1 1-1.1h3V.54L14.17.53C10.24.54 9.5 3.48 9.5 5.37V7.5h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                </div>
            </div>
        </a>

        <!-- Sharingbutton Twitter -->
        <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{ isset($activity->options['intro_description_share1']) ? strip_tags($activity->options['intro_description_share1']) : '' }}&amp;url=https://avanturistic.com/outdoor-adventures/{{ $activity->slug}}" target="_blank" rel="noopener" aria-label="">
            <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                    <svg style="width:16px;height:16px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.4 4.83c-.8.37-1.5.38-2.22.02.94-.56.98-.96 1.32-2.02-.88.52-1.85.9-2.9 1.1-.8-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.04.7.12 1.04-3.78-.2-7.12-2-9.37-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.73-.03-1.43-.23-2.05-.57v.06c0 2.2 1.57 4.03 3.65 4.44-.67.18-1.37.2-2.05.08.57 1.8 2.25 3.12 4.24 3.16-1.95 1.52-4.36 2.16-6.74 1.88 2 1.3 4.4 2.04 6.97 2.04 8.36 0 12.93-6.92 12.93-12.93l-.02-.6c.9-.63 1.96-1.22 2.57-2.14z"/></svg>
                </div>
            </div>
        </a>


        <!-- Sharingbutton WhatsApp -->
        <a class="resp-sharing-button__link" href="whatsapp://send?text=https://avanturistic.com/outdoor-adventures/{{ $activity->slug}}" target="_blank" rel="noopener" aria-label="">
            <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                    <svg style="width:16px;height:16px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                </div>
            </div>
        </a>
        <a class="resp-sharing-button__link" href="viber://forward?text=https://avanturistic.com/outdoor-adventures/{{ $activity->slug}}"  target="_blank" rel="noopener">
            <div class="resp-sharing-button resp-sharing-button--viber resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                    <img src="/img/viber.svg" style="width:27px;margin-top:-2px;margin-left: 1px;" alt="Share on Viber">
                </div>
            </div>

        </a>
        
            
    </div>
        
    </div>
    
@endsection
