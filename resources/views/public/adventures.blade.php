@extends('layouts.app')

@section('content')
    <!--begin::Portlet-->
    @include('shared.success_error')

    <style>.full-width-bg:before {

            background: url('/img/explore_outdoor_adventures_bg.jpg') no-repeat center center;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            will-change: transform; // creates a new paint layer
        z-index: -1;
        }</style>
    <div class="full-width-bg" style="position:relative;overflow: hidden;">
        @if(!$user)
        <div class="kt" style=" padding: 50px 10px 50px 10px;background:rgba(0,0,0,0.5);color:white;">
            <div class="kt-portlet__head text-center" style="width:100%;">
                <h1 style="width:100%;margin-top: 10px;"><b>Outdoor Adventures</b></h1>
                <p>Personal impressions of best outdoor locations <br> & adventure activities worldwide</p>
            </div>
            <div class="kt-portlet_body">
                <div class="kt-container text-center">

                        <div style="padding:10px;border:1px solid #FFFFFF;-webkit-border-radius: 10px;-moz-border-radius: 10px;border-radius: 10px;background:#00000045;">
                            <p style="margin:0;">
                            <a class="text-success" href="/sign-up"><em>Create an account</em></a> and <b>promote</b> your adventure <b>stories</b>, <b>photos</b> & <b>videos</b>, <b>social network pages</b> or <b>adventure tourism services</b> for free!
                            </p>
                    
                        </div>
                        
                        <br>
                   

                    <p class="text-center"><br> Explore <b>latest</b> outdoor trips or find outdoor activities <em><b>near you</b></em>.</p>
                    <p class="text-center kt-font-xl">
                        <i class="fa fa-angle-down text-white"></i>
                    </p>
                </div>
            </div>
        </div>
        @endif

    </div>

  
   <div class="kt-portlet__body" style="padding-top:50px;background-color:#FFFFFF;">
    @include('shared.lists.toolbar')
           <div class="kt-container" style="padding:0px;">

           
               <!-- <div class="row">
                   <div class="col-sm-12 text-center" style="padding:0px;"> -->
                    
                       <div class="kt-container" style="min-height:600px;" id="posts-container" data-page="{{ request()->filled('page') ? request()->page : 1 }}" >
                           <div id="adventures-grid" class="adventures-masonry-grid" style="cursor: pointer;">
                               <div class="adventure-grid-sizer"></div>

                           </div>
                        
                           <div id="more-posts" style="min-height:700px;">
                                @if(isset($more_posts) && $more_posts)
                                 {!! $more_posts !!}
                                @endif

                               <div class="text-center loading-spinner-posts" style="display: none;">
                                   <br>

                               </div>
                           </div>
                           <br>
                           <div id="scrollForMore" class="" style="font-size:0.8em;padding-bottom:20px;">
                               <p class="text-center">
                                   <i style="font-size:1.4em;" class="fa fa-angle-down"></i>
                               </p>
                               <p class="text-center text-gray">Swipe down for more adventures. <br></p>
                           </div>
                       </div>
               <!--     </div>
               </div> -->
           </div>


       </div>
       
   
    {{--<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>--}}
    <!-- Home -->
   {{--  <div class="kt-container text-center">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-5528772671541930"
             data-ad-slot="9621818541"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

   </div>
 --}}

@endsection
