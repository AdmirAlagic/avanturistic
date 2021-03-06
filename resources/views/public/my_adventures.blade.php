@extends('layouts.app')

@section('content')
   <div class="kt-container padding0">
       <!--begin::Portlet-->
       @include('shared.success_error')
       <div class="kt-portlet">
           <div class="text-center" style="width:100%;" >
           <br>
                <a style="margin-bottom:10px;margin-top:15px; padding-left:10px;padding-right:10px; -webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;padding:10px;margin-top: 10px;display: inline-flex;align-items:center;background: #b4d677;" href="/share"  >
                       <div class=" kt-header__topbar-wrapper img-fade-hover">
                            <img  style="display:inline;height:22px;" height="22"  src="{{ url('/img/pinplus_white.svg') }}" alt="Share adventure">
                           <div style="white-space: nowrap;margin-left:10px;display:inline;"><b><span style="font-size:1.1rem;color:white;">Share adventure</span></b></div>

                       </div>
                   </a>
              
           </div>
           <hr>
           <div class="kt-portlet__body" style="padding:0;min-height:650px;border-top:1px solid #eee;">
               @if(count($posts))
                   <div class="row">
                       @foreach($posts as $obj)
                           @if(isset($obj->image[0]['thumb_path']))
                               <div class="col-12 col-sm-4 col-lg-3 ">
                                   <div class="my-post-edit" >
                                       
                                       <div style="position:relative" class="postImg overflowH">
                                            <a href="/adventure/{{ $obj->id }}/{{ $obj->slug}}">
                                                <img class="image-thumbnail lazy" src="{{url(isset($obj->image[0]['placeholder']) ? $obj->image[0]['placeholder'] : '/img/placeholder-trans.png') }}" data-src="{{ $obj->image[0]['thumb_path'] }}" data-srcset="{{ $obj->image[0]['thumb_path'] }}" style="width:100%;border-top:1px solid #eee;border-bottom:1px solid #eee;">
                                                
                                            </a>
                                            <a href="#" class="btn btn-icon deleteAdventure text-white" style="position:absolute;right:5px;top:5px;padding:0;background:#00000017;width:1.5rem;height:1.5rem;" data-post_id="{{ $obj->id }}">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div>
                                      
                                       <div class="post-edit-toolbar" style="">
                                            <div class="row">
                                                <div class="col-9">
                                                    <div style="margin-top:5px;margin-bottom:5px;padding-left:10px;" class="clearfix" >
                                                        <b>
                                                            @if($obj->title)
                                                                {{ Str::words($obj->title , 4)}}
                                                            @else
                                                                <span class="text-gray">Untitled</span>
                                                            @endif
                                                        </b>
                                                        <div style="" class="text-gray">
                                                            <small>{!! $obj->created_at->format('d F') !!} at {!! $obj->created_at->format('H:i') !!} </small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3" style="padding-top:5px;">
                                                    <a href="#" class="dropdown-toggle dots text-muted pull-right" style="margin-right:5px;"   data-toggle="dropdown">
                                                        <div class="text-muted btn-dots" style="font-size:2em; ">
                                                        ...
                                                        </div>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center text-center" style="">
                                                        <ul class="kt-nav" style="padding:0;">
                                                            @if(count($obj->image) > 2)
                                                                <li class="kt-nav__item">
                                                                    <a href="/adventure/{{ $obj->id }}/timelapse" class="kt-nav__link">
                                                                        <i class="fa fa-download text-muted"></i> 
                                                                        <span class="kt-nav__link-text">Download Timelapse </span>
                                                                    </a>
                                                                </li>
                                                            @endif
                                                            <li class="kt-nav__item">
                                                                <a href="/adventure/{{ $obj->id }}/edit" class="kt-nav__link">
                                                                    <i class="fa fa-cogs text-muted"></i> 
                                                                    <span class="kt-nav__link-text">Edit </span>
                                                                </a>
                                                            </li>
                                                        
                                                            
                                                        </ul>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="clearfix" style="font-size:1.1rem;border-top:1px solid #eee;padding-left:10px;padding-right:10px;">
                                                
                                                <div class="row" style="margin-top:10px; padding:10px;">
                                                    <div class="col-2 text-center">
                                                        <i class="fa fa-heart {{ $obj->likes > 0 ? 'text-success' : 'text-gray' }}"></i> <br>  
                                                        <span class="text-muted">{{ $obj->likes }}</span>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <i class="fa fa-shoe-prints  {{ count($obj->visitedBy) ? 'text-muted' : 'text-gray' }} "></i><br> 
                                                         {{ count($obj->visitedBy) }}
                                                    </div>
                                                    <div class="col-2 text-center">
                                                        <i class="fa fa-comment-dots {{ count($obj->comments) ? 'text-muted' : 'text-gray' }} "></i> <br>
                                                         {{ count($obj->comments) }}
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <b> {{ $obj->views}}</b> @if($obj->views == 1) view @else views @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                               </div>
                           @endif
                       @endforeach
                       <div class="col-sm-12 text-center">
                           <hr>
                           {!! $posts->links() !!}
                       </div>

                   </div>
               @else
                   <a class="btn  text-dark" href="/share"><h5>Share your first adventure</h5></a>
               @endif
           </div>
       </div>

       <!--end::Portlet-->
   </div>
@endsection
