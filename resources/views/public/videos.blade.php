@extends('layouts.app')

@section('content')
    <!--begin::Portlet-->
    @include('shared.success_error')

    <div class="kt-container padding0" >
        <h1 class=" text-center" style="font-size: 1.3em;width:100%;border-radius:0px !important;padding:15px;">
            <i class="text-green fa fa-play-circle " style="font-size: 1.2em;"></i>
            Watch Adventure Videos
        </h1>
        <div style="min-height:800px;">

            @foreach($posts as $post)
                @php
                    $videoId = UtilHelper::parseYtUrl($post->video);
                @endphp

                <div class="row">
                    <div class="col col-12 col-sm-7" >
                        <div class="kt-portlet kt-portlet--height-fluid">
                            <div class="kt-portlet__head">
                                <div class="kt-portlet__head-label" style="width:100%;">

                                    @if($post->user->group == 'user')
                                        <a class="text-muted text-left" href="/{{ '@' .$post->user->name_slug }}" >
                                            @if($post->user->avatar && $post->user->avatar != ' ' && $post->user->avatar != '')
                                                <small style="margin-top:5px">
                                                    <img class="img-circle" src="{{ $post->user->avatar }}" style="width:31px;height:31px;">
                                                </small>
                                            @else
                                            <div style="margin-left:8px;display:inline-block; padding-top:8px;padding-left:1px;margin-top:5px;" class=" kt-header__topbar-icon text-white post-avatar">
                                                <b>{{ ucfirst($post->user->name[0]) }}</b>
                                            </div>
                                            @endif
                                            &nbsp;
                                            <span class="text-right" style="font-size: 0.9em;">{{ $post->user->name }}&nbsp;</span>

                                        </a>
                                        <br><br>
                                    @else
                                        <div class="text-left"><img class="avatar" src="/img/logo.svg" style="width:40px;"  alt="Avanturistic"> <b>Avanturistic</b></div>

                                    @endif
                                </div>
                            </div>
                            <div class="kt-portlet__body padding0">
                                @if($post->video && $post->video != ' ' && $videoId)
                                    @if($videoId)
   
                                        <iframe style="border:none;"   width="100%" height="320" allowfullscreen="allowfullscreen"
                                                mozallowfullscreen="mozallowfullscreen"
                                                msallowfullscreen="msallowfullscreen"
                                                oallowfullscreen="oallowfullscreen"
                                                webkitallowfullscreen="webkitallowfullscreen"
                                             
                                                allow="autoplay; encrypted-media"
                                                src="https://www.youtube.com/embed/<?php echo $videoId ?>?autoplay=1&mute=1&enablejsapi=1&showinfo=0&color=white&modestbranding=1&iv_load_policy=3&theme=light&playsinline=1">
                                        </iframe>
                                    @endif
                                     
                                    <div class="share-buttons text-right"  style="margin:10px;">
                                                <span class="text-muted">
                                                    Share
                                                </span>
                                        <!-- Sharingbutton Facebook -->
                                        <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https://avanturistic.com/adventure/{{ $post->id}}/{{ $post->slug}}" target="_blank" rel="noopener" aria-label="">
                                            <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                                    <svg style="width:16px;height:16px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.5H14.5V5.6c0-.9.6-1.1 1-1.1h3V.54L14.17.53C10.24.54 9.5 3.48 9.5 5.37V7.5h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Sharingbutton Twitter -->
                                        <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{ $post->description }}&amp;url=https://avanturistic.com/adventure/{{ $post->id}}/{{ $post->slug}}" target="_blank" rel="noopener" aria-label="">
                                            <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                                    <svg style="width:16px;height:16px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.4 4.83c-.8.37-1.5.38-2.22.02.94-.56.98-.96 1.32-2.02-.88.52-1.85.9-2.9 1.1-.8-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.04.7.12 1.04-3.78-.2-7.12-2-9.37-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.73-.03-1.43-.23-2.05-.57v.06c0 2.2 1.57 4.03 3.65 4.44-.67.18-1.37.2-2.05.08.57 1.8 2.25 3.12 4.24 3.16-1.95 1.52-4.36 2.16-6.74 1.88 2 1.3 4.4 2.04 6.97 2.04 8.36 0 12.93-6.92 12.93-12.93l-.02-.6c.9-.63 1.96-1.22 2.57-2.14z"/></svg>
                                                </div>
                                            </div>
                                        </a>


                                        <!-- Sharingbutton WhatsApp -->
                                        <a class="resp-sharing-button__link" href="whatsapp://send?text=https://avanturistic.com/adventure/{{ $post->id}}/{{ $post->slug}}" target="_blank" rel="noopener" aria-label="">
                                            <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                                    <svg style="width:16px;height:16px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                                                </div>
                                            </div>
                                        </a>
                                        <a class="resp-sharing-button__link" href="viber://forward?text=https://avanturistic.com/adventure/{{ $post->id}}/{{ $post->slug}}"  target="_blank" rel="noopener">
                                            <div class="resp-sharing-button resp-sharing-button--viber resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                                    <img src="/img/viber.svg" style="width:27px;margin-top:-2px;margin-left: 1px;" alt="Share on Viber">
                                                </div>
                                            </div>

                                        </a>
                                    </div>
                                @else
                                    <p>Video not available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col col-12  col-sm-5">
                        <div class="kt-portlet kt-portlet--height-fluid" style="position:relative;">
                            @if($post->title)
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label" style="width:100%;">

                                        <h2 class="text-left" style="width:100%;font-size:1.5rem;margin-top: 10px;">

                                            <a class="text-muted k-font" href="/adventure/{{ $post->id }}/{{ $post->slug }}">
                                                {!! $post->title !!}
                                            </a>

                                        </h2>
                                    </div>
                                </div>
                            @endif
                           
                            @if($post->address)
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label" style="width:100%;">
                                            <span class="kt-portlet__head-icon">
                                                <i class="fa fa-map-marker-alt"></i>
                                            </span>
                                        <h3 class="kt-portlet__head-title text-left" style="width: 100%;">
                                            <small>{{ $post->address }}</small>
                                        </h3>
                                    </div>
                                </div>
                            @endif
                            @if($post->country)
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label" style="width:100%;">
                                            <span class="kt-portlet__head-icon">
                                            <div style="margin-left:-5px;display:inline-block;border:1px solid #fbfbfb;background-image:url('/img/countries/svg/{{ strtolower($post->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 35px; height: 35px;">
                                            </div>
                                        </span>
                                        <h4 class="text-left" style="width:100%;">

                                            <small style="font-size:0.7em;" class="text-muted">
                                                {{ $post->country->title }}
                                            </small>

                                        </h4>
                                    </div>
                                </div>
                            @endif
                            @if(isset($post->options['badges']) && count($post->options['badges']))
                                <div class="kt-portlet__head">
                                    <div class="kt-portlet__head-label" style="width:100%;">
                                        <div class="row ">
                                            <div class="col-sm-12" style="padding-left:16px;padding-top:10px;" >
                                                <div class="row">
                                                    @foreach($post->options['badges'] as $key => $val)

                                                        @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                            <div class="col-xs-3" style="margin-bottom: 10px;">
                                                                <a href="/outdoor-adventures/{{ $key }}" style="margin-right: 10px;font-size:0.8em;">
                                                                <div class="badge-wrap" style="cursor:pointer;display: inline-block;margin-right: 10px;border:2px solid {{ $badges[$key]['color'] }}; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 40px; height: 40px;margin-left: auto; margin-right: auto;padding: 6px;">
                                                                                            <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;filter:invert(0.5);" alt="{{ $key }} adventure location ">
                                                                                        </div>
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

                            <div class="kt-portlet__body ">
                                <a href="/adventure/{{ $post->id }}/{{ $post->slug }}" class="btn-more btn--with-icon pull-right loading"><i class="btn-icon fa fa-angle-right"></i> 
                                    <div class="text-center" style="font-size:1.1rem;padding-bottom:1px;">Discover More</div>
                                </a>
                               
                            </div>

                        </div>
                        @if($nextPost)
                                
                                    <a class="btn  btn-default text-center" style="width:100%;" href="/watch?page={{ request()->has('page') ? request()->input('page') + 1 : 1 }}">
                                        <span class="text-gray"><b> NEXT</b>   <i style="margin-top:-2px;margin-left:5px;" class="fa fa-angle-right text-dark"></i>  
                                       
                                         </span> <br><br>
                                        @if($nextPost && $nextPost->title)
                                      
                                        <h4 class=" k-font" style=" font-size: 1.2rem; font-weight:normal;"><b>{{ Str::limit($nextPost->title, 56) }}</b></h4>  
                                        @endif &nbsp;

                                        @if(isset($nextPost->options['badges']) && count($nextPost->options['badges']))
                                            <br> 
                                            @php $countNextBadges = 0;@endphp
                                                &nbsp;&nbsp;
                                                @foreach($nextPost->options['badges'] as $key => $val)
                                                    @if($countNextBadges < 3)
                                                        @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                            <div class="badge-wrap" style="cursor:pointer;display: inline-block;margin-right: 10px;border:3px solid {{ $badges[$key]['color'] }};background: #666;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 40px; height: 40px;margin-right: 5px;padding: 6px;">
                                                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;">
                                                            </div>

                                                        @endif
                                                        @php $countNextBadges++;@endphp
                                                    @endif
                                                @endforeach
                                        </span>
                                        @endif
                                        <br>               
                                    </a>
                                    <br>
                                @endif
                    </div>
                </div>
            @endforeach

             
        </div>
    </div>
@endsection
