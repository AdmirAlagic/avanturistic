@extends('layouts.app')

@section('content')
    @include('shared.success_error')

    <div class="kt-container" id="blog-show">
        <div class="row">


            <div class="col-sm-8">


 
                <div class="kt-portlet" style="min-height: 620px;" >

                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;padding:0;">
                       

                        @if(isset($blog->image[0]['path']))
                            <div class="text-center" style="width:100%;">
                                <a href="{{ $blog->image[0]['path'] }}" class="spotlight" data-control="page,fullscreen,zoom" >
                                    <div style="position: relative;">
                                        <img src="{{ $blog->image[0]['path'] }}" alt="" style="width:100%;">

                                    </div>
                                </a>
                                <br>
                                <small class="text-gray">{!! $blog->created_at->format('jS F Y') !!} <br></small>
                            </div>

                        @endif
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;">
                       
                        <h1 style="font-size:2rem; font-weight:900;">{{ $blog->title }}</h1>
                        <hr>
                        @if($user && $user->id == $blog->user_id)
                            <a href="/blog/{{ $blog->id }}/edit">
                                <i class="fa fa-cogs "></i> Edit
                            </a>
                        @endif

                        <div style="line-height: 1.6em;">{!! $blog->body !!}</div>
                        <br>
                        <div class="share-buttons text-center mt-20" style="padding-left:10px;padding-right:10px;margin-bottom:10px;">
                            <p class="k-font">Share </p>
                            <!-- Sharingbutton Facebook -->
                            <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https://avanturistic.com/adventure/{{ $blog->id}}" target="_blank" rel="noopener" aria-label="">
                               <img src="{{ url('/img/social/fb.svg') }}" style="width:30px;" alt="">
                            </a>

                            <!-- Sharingbutton Twitter -->
                            <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{ $blog->description }}&amp;url=https://avanturistic.com/adventure/{{ $blog->id}}" target="_blank" rel="noopener" aria-label="">
                                <img src="{{ url('/img/social/twitter.svg') }}" style="width:30px;" alt="">
                            </a>


                            <!-- Sharingbutton WhatsApp -->
                            <a class="resp-sharing-button__link" href="whatsapp://send?text=https://avanturistic.com/adventure/{{ $blog->id}}" target="_blank" rel="noopener" aria-label="">
                                <img src="{{ url('/img/social/whatsapp.svg') }}" style="width:30px;" alt="">
                            </a>
                            <a class="resp-sharing-button__link" href="viber://forward?text=https://avanturistic.com/adventure/{{ $blog->id}}"  target="_blank" rel="noopener">
                                <img src="{{ url('/img/social/viber.svg') }}" style="width:30px;" alt="">

                            </a>
                        </div>
                        <br>
                        @if($blog->show_comments)
                            <hr style="width:100%;">
                            <h5><b>Share your toughts</b></h5><br>
                            <div id="comments-list">
                                @foreach($comments as $obj)
                                    @include('shared.single_comment')
                                @endforeach
                            </div>
                            
                            <div class="comment-error"></div>
                            {!! Form::open(['url' => 'blog/comment', 'method' => 'blog', 'id' => 'comment-form']) !!}
                            <div class="form-group row">
                                @if(!$user)

                                    <div class="col col-12">
                                        <small><span class="">Your email address will not be published. Required fields are marked *</span></small>
                                        
                                        <div class="row">
                                            <div class="col-4">
                                                {!! Form::label('Name * ') !!}
                                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder', 'style' => 'background:#fbfbfb;']) !!}
                                            </div>
                                            <div class="col-4">
                                                {!! Form::label('Email * ') !!}
                                                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' , 'style' => 'background:#fbfbfb;']) !!}
                                            </div>

                                            <div class="col-4">
                                                {!! Form::label('Website ') !!}
                                                {!! Form::text('website', null, ['class' => 'form-control', 'placeholder', 'style' => 'background:#fbfbfb;']) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12"><br>

                                    <div class="description-emoji">
                                        {!! Form::label('comment') !!}
                                        {!! Form::textarea('body', null, ['class' => 'form-control','data-emojiable' => 'true','maxlength' => '100', 'rows' => '4', 'placeholder' => 'Type comment', 'style' => 'background:#fbfbfb;']) !!}

                                    </div>
                                    {!! Form::hidden('blog_id', $blog->id, ['id' => 'blog_id']) !!}
                                    <br>
                                    <button type="submit" class="btn btn-default  submitComment" style="border-radius:8px !important;">
                                        <i class="fa fa-comment-dots text-dark"></i> blog Comment
                                    </button>
                                    <div class="guest-comment-msg">

                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @endif
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-sm-4">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="width: 100%;">
                            <h3 class="kt-portlet__head-title" style="width: 100%;">
                             Recent News & Stories

                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;">
                        @foreach($otherBlog as $obj)
                            <a href="/{{ $obj->slug }}">
                                <div class="row img-fade-hover" style="margin-bottom: 10px;">
                                    <div class="col-4 ">
                                        @if(isset($obj->image[0]['thumb_path']))
                                            <div style="position: relative;" >
                                                <img src="{{ $obj->image[0]['thumb_path'] }}" alt="{{ $obj->title }}" style="-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;width:100%;">

                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-8">
                                        <h5 class=""><b>{{ $obj->title }}</b></h5>

                                        <div class=" text-light" style="line-height:1.4rem;font-weight:normal;">
                                            {!! Str::words($obj->description, 20) !!}
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="width: 100%;">
                            <h3 class="kt-portlet__head-title" style="width: 100%;">
                            
                                The world map of outdoor adventures

                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;">
                    <p class="text-gray">Join Avanturistic community today and share your favorite outdoor locations on world map of adventure.</p>
                        <a href="/the-world-map-of-outdoor-adventures" class="btn-more btn--with-icon pull-right loading"><i class="btn-icon fa fa-globe"></i> 
                
                            <div>GO TO MAP</div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label" style="width: 100%;">
                            <h3 class="kt-portlet__head-title" style="width: 100%;">
                             Latest Outdoor Adventures

                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;">
                        @foreach($latestAdventures as $obj)


                            <div class="row img-fade-hover" style="margin-bottom: 10px;">
                                <div class="col-4">
                                    <a href="/adventure/{{ $obj->id }}/{{ $obj->slug }}">
                                        @if(isset($obj->image[0]['thumb_path']))
                                            <div style="position: relative;">
                                                <img src="{{ $obj->image[0]['thumb_path']}}" alt="{{ $obj->title }}" style="-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;width:100%;">

                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <div class="col-8" style="font-weight: 400;">
                                    @if(isset($$obj->options['badges']) && count($obj->options['badges']))
                                        <div class="row" style="margin:0;margin-top: -5px;">
                                            @php $countBadges = 0;@endphp
                                        
                                            @foreach($obj->options['badges'] as $key => $val)

                                                @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                    @if($countBadges < 3)
                                                        <div class="col-xs-3" style="margin-bottom: 10px;">
                                                            <a href="/outdoor-adventures/{{ $key }}" style="margin-right: 10px;font-size:0.8em;">

                                                                <span class="text-gray" style="text-transform: lowercase;"><span class="text-success">&nbsp;#</span>{{ $badges[$key]['name'] }}</span>
                                                            </a>
                                                        </div>
                                                        @php $countBadges++;@endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    <a href="/adventure/{{ $obj->id }}/{{ $obj->slug }}" style="font-weight: 400;">
                                        <h6 class=""><b>{{ $obj->title }}</b></h5>
                                        @if($obj->country || $obj->address)
                                            <p>
                                                <i class="fa fa-map-marker-alt "></i>
                                                @if($obj->country)
                                                    <span class="text-gray">{{  $obj->country->title }}   @if($obj->address)
                                                            <br><span class="">{{ Str::words($obj->address, 10) }}</span>
                                                        @endif</span>
                                                @endif

                                            </p>
                                        @endif
                                    </a>



                                </div>
                            </div>

                        @endforeach
                        <a href="/outdoor-adventures" class="btn-more btn--with-icon loading">
                            <i class="btn-icon fa fa-angle-right"></i> 
                          
                            <div>EXPLORE ADVENTURES</div>
                        </a>
                    </div>
                     
                </div>
                
                
                
            </div>

        </div>
    </div>

@endsection
