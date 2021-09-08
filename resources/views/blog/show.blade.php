@extends('layouts.app')

@section('content')
    @include('shared.success_error')

    <div class="kt-container" id="blog-show">
        <div class="row">


            <div class="col-sm-8">


                {{--<a  href="#" data-blog_id="{{ $blog->id }}" id="likeBtn" class="btn  {{ $alreadyLiked ? 'text-red' : 'text-muted' }}"> <i class="fa fa-heart "></i>  <span class="text-muted" id="likesCount">{{ count($blog->likesModel) }}</span></a>--}}


                <div class="kt-portlet" style="min-height: 620px;" >

                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;padding:0;">
                       

                        @if(isset($blog->image[0]['path']))
                            <div class="text-center" style="width:100%;">
                                <a href="{{ $blog->image[0]['path'] }}" class="spotlight" data-control="page,fullscreen,zoom" >
                                    <div style="position: relative;">
                                        <img src="{{ $blog->image[0]['path'] }}" alt="" style="width:100%;">

                                    </div>
                                </a>
                            </div>

                        @endif
                    </div>
                    <div class="kt-portlet__body" style="background: #FFFFFF; border-radius:0;">
                        <br>
                        <small class="text-gray">{!! $blog->created_at->format('jS F Y') !!} <br></small>
                        <h1 style="font-size:2rem; font-weight:900;">{{ $blog->title }}</h1>
                        <hr>
                        @if($user && $user->id == $blog->user_id)
                            <a href="/blog/{{ $blog->id }}/edit">
                                <i class="fa fa-cogs text-muted"></i> Edit
                            </a>
                        @endif

                        <div style="line-height: 1.6em;">{!! $blog->body !!}</div>
                        <br>
                        <div class="share-buttons text-right" style="font-size:1.2em;" >
                            <span class="text-gray">
                                Share
                            </span>
                            <!-- Sharingbutton Facebook -->
                            <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https://avanturistic.com/{{ $blog->slug}}" target="_blank" rel="noopener" aria-label="">
                                <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <svg style="width:16px;height:16px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.5H14.5V5.6c0-.9.6-1.1 1-1.1h3V.54L14.17.53C10.24.54 9.5 3.48 9.5 5.37V7.5h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                                    </div>
                                </div>
                            </a>

                            <!-- Sharingbutton Twitter -->
                            <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{ $blog->description }}&amp;url=https://avanturistic.com/{{ $blog->slug}}" target="_blank" rel="noopener" aria-label="">
                                <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <svg style="width:16px;height:16px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.4 4.83c-.8.37-1.5.38-2.22.02.94-.56.98-.96 1.32-2.02-.88.52-1.85.9-2.9 1.1-.8-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.04.7.12 1.04-3.78-.2-7.12-2-9.37-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.73-.03-1.43-.23-2.05-.57v.06c0 2.2 1.57 4.03 3.65 4.44-.67.18-1.37.2-2.05.08.57 1.8 2.25 3.12 4.24 3.16-1.95 1.52-4.36 2.16-6.74 1.88 2 1.3 4.4 2.04 6.97 2.04 8.36 0 12.93-6.92 12.93-12.93l-.02-.6c.9-.63 1.96-1.22 2.57-2.14z"/></svg>
                                    </div>
                                </div>
                            </a>


                            <!-- Sharingbutton WhatsApp -->
                            <a class="resp-sharing-button__link" href="whatsapp://send?text=https://avanturistic.com/{{ $blog->slug}}" target="_blank" rel="noopener" aria-label="">
                                <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <svg style="width:16px;height:16px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                                    </div>
                                </div>
                            </a>
                            <a class="resp-sharing-button__link" href="viber://forward?text=https://avanturistic.com/{{ $blog->slug}}"  target="_blank" rel="noopener">
                                <div class="resp-sharing-button resp-sharing-button--viber resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <img src="/img/viber.svg" style="width:27px;margin-top:-2px;margin-left: 1px;" alt="Share on Viber">
                                    </div>
                                </div>

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
                            {!! Form::open(['url' => 'blog/comment', 'method' => 'POST', 'id' => 'comment-form']) !!}
                            <div class="form-group row">
                                @if(!$user)

                                    <div class="col col-12">
                                        <small><span class="text-muted">Your email address will not be published. Required fields are marked *</span></small>
                                        
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
                                        <i class="fa fa-comment-dots text-dark"></i> Post Comment
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
                            <img src="{{ url('/img/blog.svg') }}" style="height:20px;" alt="Recent News & Stories"> Recent News & Stories

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
                                        <h5 class="text-muted"><b>{{ $obj->title }}</b></h5>

                                        <div class="text-muted text-light" style="line-height:1.4rem;font-weight:normal;">
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
                            
                                <img src="{{ url('/img/map_pin.svg') }}" style="height:20px;" alt="The world map of outdoor adventures">   The world map of outdoor adventures

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
                                <img src="{{ url('/img/backpacking-gray.svg') }}" style="height:20px;" alt="Latest outdoor adventures">   Latest Outdoor Adventures

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
                                        <h6 class="text-muted"><b>{{ $obj->title }}</b></h5>
                                        @if($obj->country || $obj->address)
                                            <p>
                                                <i class="fa fa-map-marker-alt text-muted"></i>
                                                @if($obj->country)
                                                    <span class="text-gray">{{  $obj->country->title }}   @if($obj->address)
                                                            <br><span class="text-muted">{{ Str::words($obj->address, 10) }}</span>
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
