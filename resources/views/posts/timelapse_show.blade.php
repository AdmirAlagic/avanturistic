@extends('layouts.app')

@section('content')

    <!-- begin:: Content -->

    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="padding:0;min-height:620px;" >

        <div class="kt-portlet">
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-container padding0">
                    <div class="row">
                        <div class="col-sm-4 offset-sm-4 text-right">
                            <div class="video-block">
                                <video style="width:100%;position:relative;" onclick="if(this.muted){
                                        this.muted = false;
                                    } else {
                                        this.muted = true;
                                    }
                                    " src="{{ url($timelapse)}}" playsinline autoplay loop muted  ></video>

                                <span class="volume">
                                    <i class="fa fa-volume-mute"></i>
                                </span>
                                
                            </div>
                           <!--  <a class="btn" href="/download-timelapse/{{ $timelapse }}">
                                Download Timelapse
                            </a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

