@extends('layouts.app')

@section('content')
    @include('shared.success_error')
    <div id="home">
        <div class="kt-portlet">

            <div class="kt-portlet__body">
                <h4 class="text-muted text-center"><i class="fa fa-chart-area text-green"></i>&nbsp;Top 50 </h4>

                <div class="tab-content">
                    <hr>
                    {{--<div class="tab-pane " id="kt_widget6_tab0_content" aria-expanded="true">--}}
                    {{----}}
                    {{--</div>--}}
                    <div class="kt-notification">
                        @if(count($top100))

                            <div class="row">
                                @php $count = 1;@endphp
                                @foreach($top100 as $obj)
                                    @if($obj->user)
                                        <div class="more-posts my-post" style="margin-left: auto;margin-right: auto;margin:10px;">
                                            <div class="post-heading">
                                                <div class="row">
                                                    <div class="col-3">
                                                        @if($obj->user->group == 'user')
                                                        <a href="/{{ '@' .$obj->user->name_slug }}">
                                                            @if($obj->user->avatar)
                                                                <span style="margin-left:5px;" class="pull-left kt-header__topbar-icon text-pink ">
                                                                    <img class="post-avatar" src="{{ $obj->user->avatar }}" alt="">
                                                                </span>
                                                                @else
                                                                <span style="margin-left:5px;padding-top:11px;" class="pull-left kt-header__topbar-icon text-green post-avatar"><b>{{  ucfirst($obj->user->name[0] ) }}</b></span>
                                                            @endif
                                                            <span class="text-white pull-left" style="margin-top:15px;"><small class="text-left"></small></span>
                                                        </a>
                                                        @else
                                                            <span><img class="avatar" src="/img/logo.png" style="width:40px;"  alt="Avanturistic"></span>
                                                        @endif

                                                    </div>
                                                    <div class="col-9" style="padding-top:15px;margin-left:-6%;">
                                                        @if($obj->user->group != 'admin')

                                                            <small>
                                                                <b>{{ $obj->user->name }}</b>
                                                            </small>
                                                        @endif

                                                        <span class="popular-count">
                                                                <b>{{ $count++ }}</b>
                                                            </span>
                                                    </div>

                                                </div>
                                            </div>


                                            <a href="/adventure/{{ $obj->id }}" class="openPost" data-post_id="{{ $obj->id }}">
                                                <div class="kt-animate-fade-in">
                                                    <div class="img-shadow" style="position: relative;">
                                                        @php $countBadge = 0;@endphp
                                                        <div style="position:relative;">
                                                            <img src="{{ $obj->image[0]['thumb_path'] }}" alt="{{ $obj->title }}" style="width:100%;">

                                                        </div>
                                                        @if(isset($obj->options['badges']) && count($obj->options['badges']))
                                                            <div class="row" style="position:absolute;left: 0;bottom:-3px;">
                                                                <div class="col-sm-12" >
                                                                    <div class="pull-left">

                                                                        @php $countBadge = 0;@endphp
                                                                        @foreach($obj->options['badges'] as $key => $val)
                                                                            @if($countBadge < 3)
                                                                                @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                                                    <button   class="btn btn-default single-badge"  data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="{{ $badges[$key]['name'] }}" >
                                                                                        <img style="width:40px;" src="{{ $badges[$key]['icon'] }}" alt="{{ $badges[$key]['name'] }}" >
                                                                                    </button>

                                                                                @endif
                                                                                @php $countBadge++;@endphp
                                                                            @endif
                                                                        @endforeach
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endif

                                                        {{--@if($obj->video && $obj->video != ' ')--}}
                                                            {{--<span style="position:absolute; right:10px;top:10px;"><i class="fa fa-video text-white"></i></span>--}}
                                                        {{--@endif--}}
                                                    </div>
                                                </div>

                                                <div class="circle-posts-toolbar" style="padding-left:10px;padding-bottom:10px;">
                                                    <br>
                                                    <small style="font-size:0.9em;">
                                                        <a  href="#" data-post_id="{{ $obj->id }}" class="likeBtn  {{ $obj->likes > 0 ? 'text-red' : 'text-muted' }}" class="btn">
                                                            <i class="fa fa-heart "></i>  <span class="text-white likesCount" >&nbsp;{{ $obj->likes }}&nbsp;</span>
                                                        </a>
                                                        <a  data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="I Was Here!" href="#" data-post_id="{{ $obj->id }}" class="visitedBtn {{ $obj->visiteds > 0 ? 'text-white' : 'text-muted' }} ">
                                                            <i class="fa fa-shoe-prints  "></i> <span class="text-white visitedsCount">&nbsp;{{ $obj->visiteds }}&nbsp;</span>
                                                        </a>
                                                        <a href="/adventure/{{ $obj->id }}"><i class="fa fa-comment-dots  {{  $obj->comments_count > 0 ? 'text-success' : 'text-muted' }} "></i>  <span class="text-white">&nbsp;{{ $obj->comments_count }}</span></a>
                                                    </small>

                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <hr>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="overlay" class="kt-container"></div>

@endsection
