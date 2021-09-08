@extends('layouts.app')
@section('content')
    <div class="kt-container">
        <!--begin::Portlet-->
        @include('shared.success_error')
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="fa-pencil-alt fa"></i>
                        </span>
                    <h4 class="kt-portlet__head-title">
                        Stories
                    </h4>
                </div>
            </div>
            <div class="kt-portlet__body">
            <div class="col-sm-12 text-center">
                <a class="btn btn-success text-white" href="/new-experience"><i class="fa fa-pencil-alt"></i>Write new story</a>
            </div>

                <div class="row">

                @if(count($blog))
                        <div class="col-sm-12">
                            <h5>Stories</h5>
                            <hr>
                        </div>
                    @foreach($blog as $obj)
                            @if(isset($obj->image[0]['path']))
                                <div class="col-sm-3">

                                    <div class="my-post-edit">
                                        <a href="/my-experiences/{{ $obj->id }}/edit">
                                        <h4 style="padding:10px;font-size:1.1em; font-weight: 900;" class="">{{ $obj->title }}</h4>
                                        <hr>
                                        <div class="clearfix">

                                            <div class="pull-left" style="padding:10px; padding-right:0;">
                                                <small> {{$obj->created_at->diffForHumans()}}</small>
                                            </div>
                                            <div class="pull-right">
                                                <a  class="btn btn-icon" href="/my-experiences/{{ $obj->id }}/edit"><i class="fa fa-cog text-white"></i></a>
                                            </div>
                                        </div>
                                      
                                            <img class="image-thumbnail" src="{{ $obj->image[0]['thumb_path'] }}" alt="" style="width:100%;">
                                        </a>
                                        <div class="circle-blog-toolbar clearix" style=" padding-left: 10px;">


                                            <a  class="btn btn-icon pull-right" href="/{{ $obj->slug }}"><i class="fa fa-eye text-white"></i></a>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endforeach


                        <div class="col-sm-12 text-center">
                            <hr>
                            {!! $blog->links() !!}
                        </div>

                    </div>


                @endif
            </div>
        </div>

        <!--end::Portlet-->
    </div>
@endsection
