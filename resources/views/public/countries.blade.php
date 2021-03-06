@extends('layouts.app')

@section('content')
    <div class="kt-container">
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__head text-center">
                <div class="kt-portlet__head-label" style="width:100%">
                    <h1 class="kt-portlet__head-title text-center" style="font-family: 'Kaushan Script', cursive;font-size: 1.5em;width:100%;border-radius:0px !important;">
                        <i class="fa fa-flag text-green"></i>

                        &nbsp;Explore adventures by country
                    </h1>
                </div>
            </div>
            <div class="kt-portlet__body" style="padding-top: 0px;">
                <div class="row">
                    @foreach($countries as $obj)
                        @php $countPosts = count($obj->posts()->public()->get());@endphp
                        @php $latestPost = $obj->posts()->latest()->public()->first();@endphp
                        <div class="country col-12 col-sm-4 text-center" style="padding:0px;">

                            <a href="/country/{{ $obj->slug }}">
                                <div style="position:relative;min-height: 300px;" class="adventure-category">
                                    <img class="bg lazy "  data-src="{{ $latestPost->image[0]['thumb_path'] }}" data-srcset="{{ $latestPost->image[0]['thumb_path'] }}" alt="{{ $latestPost->image[0]['thumb_path'] }}"  >
                                    <div class="adventure-category-wrapper" >
                                        <p style="margin-bottom:0;padding: 5px;" class="text-center">
                                        <div style="border:3px solid #FFFFFF;font-size:2.7em;background: #33333359;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 60px; height: 60px;margin-left: auto; margin-right: auto;padding: 0px;">
                                            {!! $obj->emoji !!}
                                        </div>

                                        &nbsp;&nbsp;</p>

                                        <h2 class="text-center   text-white" style="font-weight: 900; text-transform:uppercase;font-size:1.3em;">{{ $obj->title }}</h2>
                                        <span  class="adventureCount" style="font-size:1.5em;">
                                            {{ $countPosts }}
                                    </span>

                                        <span class="adventureDesc text-white" style="font-size:1em;"> {{ $countPosts > 1 ? 'adventures' : ' adventure' }}</span>
                                    </div>
                                </div>

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
    </div>
@endsection
