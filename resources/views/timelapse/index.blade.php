@extends('layouts.app')

@section('content')

    <!-- begin:: Content -->

    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="padding:0;min-height:620px;" >

        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-container padding0">
                    <div class="text-center" style="width:100%;" >
                    <br>
                            <a style="margin-bottom:10px;margin-top:15px; padding-left:10px;padding-right:10px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding:10px;margin-top: 10px;display: inline-flex;align-items:center;background: #acc957;" href="/create-timelapse"  >
                                <div class=" kt-header__topbar-wrapper img-fade-hover">
                                        <img  style="display:inline;height:20px;" height="20"  src="{{ url('/img/reel-white.svg') }}" alt="Share adventure">
                                    <div style="white-space: nowrap;margin-left:10px;display:inline;"><b><span style="font-size:1.1rem;color:white;">Create Timelapse</span></b></div>

                                </div>
                            </a>
                        
                    </div>
                    <br>
                    <div style="border-top:1px solid #eee;">
                        @foreach($timelapses as $obj)
                            <div style="border-bottom:1px solid #eee;">
                                <div class="row" >
                                    <div class="col-sm-4 offset-sm-4 text-right">
                                        <div class="video-block">
                                                <video style="width:100%;position:relative;"    poster="{{ url('/img/placeholder-trans.png') }}"  playsinline autoplay loop muted class="lazy" >
                                                        <source src="" data-src="{{ url($obj->path) }}" type="video/mp4">
<!--                                                         <source src="" data-src="{{ url($obj->path_webm) }}" type="video/webm">
 -->                                                    </video>

                                            <span class="volume">
                                                <i class="fa fa-volume-mute"></i>
                                            </span>
                                            <a href="#" class="btn btn-icon deleteTimelapse text-white" style="position:absolute;right:5px;top:5px;padding:0;background:#00000017;width:1.5rem;height:1.5rem;" data-timelapse_id="{{ $obj->id }}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                        </div>
                                        <div class="row">
                                             <div class="col-3 text-left">
                                                <div class="btn">
                                                    <i class="fa fa-heart {{ count($obj->likes) > 0 ? 'text-success' : 'text-gray' }}" style="font-size:16px !important;"></i>  <span class="text-muted" id="likesCount"></span> 
                                                    <span class="text-muted">{{ count($obj->likes) }}</span>
                                                </div>
                                            </div>
                                           
                                            <div class="col-9 text-right">
                                                @if(!$obj->is_public)
                                                    <a class="btn" href="/timelapse/{{ $obj->id }}/visibility">
                                                        Publish
                                                    </a>
                                                @endif
                                                <a class="btn " href="/download-timelapse/{{ $obj->id }}">
                                                    Download Timelapse
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <br>
                            </div> 
                        @endforeach
                    </div>
                    <br>
                    {!! $timelapses->links() !!}
                    <br>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

