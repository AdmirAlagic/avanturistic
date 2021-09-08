@extends('layouts.app')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-container">
        @include('shared.success_error')

        <div class="kt-portlet" style="border-radius:0px">
            <div class="kt-portlet__head text-center">
                <div class="kt-portlet__head-label" style="width:100%">
                    <h1 class="kt-portlet__head-title text-center" style="font-family: 'Kaushan Script', cursive;font-size: 1.1em;width:100%;border-radius:0px !important;">
                        <i class="fa fa-mountain text-green"></i>

                        &nbsp;Explore Adventures By Activity
                    </h1>
                </div>
            </div>
            <div class="kt-portlet__body" style="padding-top: 0;">
                <div class="row">
                    @foreach($badgesPost as $key => $postObj)
                        <div class="col col-12 col-sm-4" style="padding: 0;" >
                            <a href="/outdoor-adventures/{{ $key }}">
                                @php $image = json_decode($postObj->image);@endphp

                                @if(isset($image[0]->thumb_path))
                                    <div style="position:relative;min-height: 300px;" class="adventure-category">
                                        <img class="bg lazy "  data-src="{{ $image[0]->thumb_path }}" data-srcset="{{ $image[0]->thumb_path }}" alt="{{ $postObj->title }}"  >
                                        <div class="adventure-category-wrapper" >
                                            <p style="margin-bottom:0;padding: 5px;" class="text-center">
                                            <div style="border:3px solid #FFFFFF;background: #33333329;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 60px; height: 60px;margin-left: auto; margin-right: auto;padding: 10px;">
                                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;">
                                            </div>

                                            &nbsp;&nbsp;</p>

                                            <h2 class="text-center   text-white" style="font-weight: 900; text-transform:uppercase;font-size:1.3em;">{{ $badges[$key]['name'] }}</h2>
                                        </div>
                                    </div>

                                @endif
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
