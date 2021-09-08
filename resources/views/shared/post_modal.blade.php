
    @include('shared.success_error')
    <div class="kt-portlet modalPost" id="post-{{ $post->id }}" data-title="{{ $post->title }}" data-img="{{ isset($post->image[0]['path']) ? url($post->image[0]['thumb_path']) : '' }}" style="background:none;background-color:transparent;margin-left:auto;margin-right:auto;margin-bottom:20px;box-shadow:none;padding-bottom:20px;">
        <div class="row">
            <div class="col-md-6">
                <!--begin::Portlet-->
                <div class="kt-portlet" style="background: none;">
                    <div class="kt-portlet__head post-head" style="padding: 0;width:100% !important;">
                        <div class="kt-portlet__head-label" style="width:100%; display: block; position: relative;">

                            <div class="spotlight-group"  style="cursor:pointer;">
                                @if(isset($post->image[0]))
                                    <div class="spotlight image" data-src="{{ $post->image[0]['path'] }}"  >
                                        <img style="width:100%;border-bottom: 1px solid #FFFFFF;" src="{{ $post->image[0]['path'] }}" alt="{{ $post->title }}">
                                    </div>
                                @endif


                                @php $countImages = 0;@endphp
                                @if(count($post->image) > 1)
                                    <ul class="image-flexbox">
                                        @foreach($post->image as $image)
                                            @if($countImages > 0)
                                                <li  class="spotlight image" data-src="{{ $image['path'] }}">
                                                    <img  style="border:1px solid #FFFFFF;"  src="{{ url($image['thumb_path']) }}" alt="{{ $post->title }}">
                                                </li>
                                            @endif


                                            @php $countImages++;@endphp
                                        @endforeach
                                    </ul>
                                @endif
                            </div>


                        </div>
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;">

                        @if($post)
                            <div class="row post lastPost" data-routes="{{ isset($post->map_options['route']) ? json_encode($post->map_options['route']) : null  }}"  data-title="{{ $post->title }}" data-lat="{{ $post->lat }}" data-lng="{{ $post->lng }}" data-img="{{ isset($post->image[0]['thumb_path']) ? $post->image[0]['thumb_path'] : 'default' }}">

                                @include('shared.post.post_toolbar')
                                <div class="col-sm-12">


                                    <div class="clearfix">

                                        @php
                                            function parseYtUrl($url){
                                                $videoId = null;
                                                if(strpos($url, 'watch')){
                                                     preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
                                                     $videoId = isset($matches[1]) ? $matches[1] : null;
                                                } else {
                                                    $urlSegments  = explode('/', $url);
                                                    $videoId = isset($urlSegments[2]) ? $urlSegments[2] : null;
                                                    $videoId = isset($urlSegments[3]) ? $urlSegments[3] : null;

                                                }

                                                return $videoId;
                                            }
                                        @endphp



                                        @if($post->video && $post->video != ' ')

                                            @php
                                                $videoId = parseYtUrl($post->video);

                                            @endphp
                                            @if($videoId)
                                                <iframe style="border:none; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;"  width="100%" height="315" allowfullscreen="allowfullscreen"
                                                        mozallowfullscreen="mozallowfullscreen"
                                                        msallowfullscreen="msallowfullscreen"
                                                        oallowfullscreen="oallowfullscreen"
                                                        webkitallowfullscreen="webkitallowfullscreen"
                                                        src="https://www.youtube.com/embed/<?php echo $videoId ?>?rel=0&showinfo=0&color=white&iv_load_policy=3">
                                                </iframe>
                                                <hr>
                                            @endif

                                        @endif

                                        @if($post->embeded_code)
                                            <p>
                                                {!! $post->embeded_code !!}
                                            </p>
                                            <hr>
                                        @endif
                                        @if($post->title)

                                            <div class="row">

                                                <div class="col-12">
                                                 <span class="blog-title">
                                                     <h1 style="font-size:1.3em;margin-top: 10px;">{{ $post->title }}</h1>
                                                </span>
                                                </div>
                                            </div>
                                            <hr>
                                        @endif
                                        @if($user && $post->user_id == $user->id)
                                            <a href="/adventure/{{ $post->id }}/edit"><i class="fa fa-cogs text-muted"></i>&nbsp; Edit</a>
                                            <br>
                                        @endif
                                        @if($post->description)

                                            {!! $post->description !!}
                                            <br>
                                            @if($translatableText && $translatableText != '')

                                                <a target="_blank" href="https://translate.google.com/#view=home&op=translate&sl=auto&tl=en&text={{ $translatableText }}">
                                                    <small><i class="fa fa-language text-muted"></i> <b>See translation</b></small>
                                                </a>
                                            @endif
                                            <hr>
                                        @endif
                                        <br>


                                        <br>
                                        <h3 class="text-muted"><small> <b>Have any info about location or want to a ask question?
                                                    <br><span style="font-style: italic;">Share your toughts in comments.</span></b></small></h3>
                                        <br>
                                        <div id="comments-list">
                                            @foreach($comments as $obj)
                                                @include('shared.single_comment')
                                            @endforeach
                                        </div>
                                       
                                        @include('shared.comment_form')
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-md-6" style="position:relative;">

                <span style="padding:17px;cursor:pointer;-webkit-box-shadow: 1px 1px 4px #111;-moz-box-shadow: 1px 1px 4px #111;box-shadow: 1px 1px 4px #111;border: 3px solid #FFFFFF !important;" data-post_id="{{ $post->id }}"  class="btn btn-circle btn-success  btn-icon closePost"><i class="fa fa-times text-white"></i></span>

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    @include('shared.post.badges')
                    @if($country)
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="width:100%;">
                        <span class="kt-portlet__head-icon">
                            <span style="padding-top:5px;">{{ $countryFlag }}</span>
                        </span>
                            <h4 class="text-left" style="width:100%;">

                                <a href="/country/{{ $countrySlug }}">
                                    <small style="font-size:0.7em;" class="text-muted">
                                        {{ $country }}
                                    </small><i class="fa fa-search-location"></i>
                                </a>

                            </h4>
                        </div>
                    </div>
                    @endif
                    @if($post->address)
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label" style="width:100%;">
                                <span class="kt-portlet__head-icon">
                                    <i class="fa fa-map-marker-alt text-muted"></i>
                                </span>
                                <h2 class="kt-portlet__head-title text-left" style="width: 100%;">
                                    <small>{{ $post->address }}</small>
                                </h2>

                            </div>
                        </div>
                    @endif
                    <div class="kt-portlet__body">
                        <div class="row">
                            <div class="col-sm-12" >
                                <div style="position:relative;">
                                 <span  style="position: absolute;padding:5px;left: 0;top:0px;z-index: 1;background-color: #333333c7; color:#FFFFFF;  border-top-left-radius: 4px; border-bottom-right-radius: 4px; ">
                                 <b>{{ UtilHelper::latLngtoDMS($post->lat,$post->lng) }}</b><br>
                                </span>

                                    <span  style="position: absolute;right: 0;top:0px;z-index: 1;background-color: #333333c7; border-bottom-left-radius: 4px; border-top-right-radius: 4px; ">

                                    <a style="padding:5px;"  class="btn showSatelite  text-white" href="#">Satellite Map</a>
                                </span>
                                    <div id="single-map"  style="width:100%;height:270px;z-index: 0;"></div>
                                </div>


                                @include('shared.post.map_options')
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">

                                <div class="kt-notification" style="margin-top:10px;">
                                    @if($user && $post->user_id == $user->id && $post->likes > 0)
                                        <hr>
                                        <div class="tab-pane " id="kt_widget6_tab5_content" aria-expanded="true">
                                            <div class="kt-notification">
                                                <p class="text-muted text-center"><small>Only you can see who liked your adventure</small></p>
                                                <div id="more-activity-likes"></div>
                                                @if($post->likes > 3)
                                                    <div class="col-12 text-center">
                                                        <br>
                                                        <a href="#" style="-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;" class="btn btn-success getMoreActivity" data-type="likes"><span class="text-white">Load more</span></a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                    @endif

                                    @if($user && $post->visiteds > 0)
                                            <hr>
                                        <div id="more-activity-others">

                                        </div>
                                        @if($post->visiteds > 3)
                                            <div class="col-12 text-center">
                                                <br>
                                                <a href="#" style="-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;" class="btn btn-success getMoreActivity" data-type="others"><span class="text-white">Load more</span></a>
                                            </div>
                                        @endif
                                            <hr>
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Portlet-->
                {{--<ins class="adsbygoogle"--}}
                     {{--style="display:block; text-align:center;"--}}
                     {{--data-ad-layout="in-article"--}}
                     {{--data-ad-format="fluid"--}}
                     {{--data-ad-client="ca-pub-5528772671541930"--}}
                     {{--data-ad-slot="5286756200"></ins>--}}
                {{--<br>--}}
                {{--<script>--}}
                    {{--$(document).ready(function () {--}}
                        {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                    {{--});--}}

                {{--</script>--}}
                {{--begin:portlet--}}
                @include('shared.post.nearby_posts')
                {{--end:portlet--}}

            </div>
        </div>

    </div>

    <script src="{{ mix('dist/js/post.js') }}"></script>