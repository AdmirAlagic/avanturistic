
@extends('layouts.app')

@section('content')
     
    <div class="kt-container" style="padding:0;" >
        <!--begin::Portlet-->
        <div id="home">
            <div class="kt-portlet kt-portlet--height-fluid" style="margin-top: 0px;padding:0;">
                <div class="kt-portlet__head text-center" style="width: 100%;">
                    <div class="kt-portlet__head-label text-left" style="width: 100%;">
                    <span style="margin-right:10px;"> <img src="{{ url('/img/countries/svg/'.strtolower($country->code2).'.svg') }}" alt="{{ $country->title}}" class="spotlight" style="height:22px; "> </span> 

                        <h1 class="kt-portlet__head-title" style="width: 100%;font-size:1.4rem;">
                              <b>{{ $country->title }}</b> <br>
                        </h1>

                    </div>

                </div>
                <div class="kt-portlet__body text-center" style="padding:0;padding-top: 10px;">
                   
                    <div class="row">
                        <div class="col-12 text-center">
                            <div style="padding:10px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px; ">
                            <h4> <i class="fa fa-info-circle text-muted"></i> Country Facts</h4>

                                <div class="text-gray">
                                    Original Name: <b>{{ $country->origin_title }}</b><br>

                                    Region: <b>{{ $country->subregion }}</b> <br>
                                    Language: <b>{{ $country->language }}</b> <br>
                                    Phone Code: <b>+{{ $country->phone_code }}</b> <br>
                                    Capital City: <b>{{ $country->capital }}</b> <br>
                                </div>
                            
                             </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <input type="hidden" id="countryCode" value="{{ $country->code3  }}">
    
    <div class="kt-portlet" style="border-radius:0px;margin-bottom: 0px;">

        <div class="kt-portlet__head text-center" style="z-index: 1;background:#FFFFFF;">
            <div class="kt-portlet__head-label text-center" style="width:100%">
                <div class="text-center" style="width:100%;padding: 10px;">
                    <h2 class="text-muted" style="font-size:1.4rem;"> <b>Outdoor adventures in {{ $country->title }}</b> <br></h2>
                    <p class="text-center">Explore impressions from best adventure locations and find outdoor activities in {{ $country->title }}</p>
                    
                </div>
            </div>
        </div>
        <div class="kt-portlet__body ">
           
            @include('shared.lists.toolbar')
            <div class="kt-container"  style="min-height:800px;">
                <div id="adventures-grid" class="adventures-masonry-grid" style="cursor: pointer;">
                    <div class="adventure-grid-sizer"></div>
                </div>

                <div id="more-posts" style="min-height:100px;">
                </div>

                <br>
                <div id="scrollForMore" class="" style="font-size:0.8em;">
                    <p class="text-center">
                        <i style="font-size:1.4em;" class="fa fa-angle-down"></i>
                    </p>
                    <p>Swipe down to see more adventures.</p>
                </div>
            </div>
        </div>
    </div>
     
   
    
    
@endsection
