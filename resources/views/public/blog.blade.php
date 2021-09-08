@extends('layouts.app')

@section('content')
    <div class="kt-container">
        <!--begin::Portlet-->
        @include('shared.success_error')
        <br>
        @if(count($blog))
            <div class="row">
                @foreach($blog as $obj)
                    <div class="col-sm-4">
                        <div class="kt-portlet  kt-portlet--height-fluid" >
                            <div class="kt-portlet__body" style="position:relative;">
                                <a href="/{{$obj->slug}}">
                                    <img class="image-thumbnail" src="{{ $obj->image[0]['thumb_path'] }}" alt="" style="-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;">

                                    <h2 style="font-weight: 900;font-size:1.7rem;margin-top:10px;" class="text-dark">
                                        {{ $obj->title }}
                                    </h2>
                                </a>
                                <p class="text-muted"> {!! $obj->description !!} </p>

                            </div>
                            <div class="kt-portlet__foot kt-portlet__foot--sm kt-align-right">
                                <span> <small class="text-muted">{!! $obj->created_at->format('jS F Y') !!} </small></span>
                                
                            </div>
                        </div>

                    </div>
                @endforeach
                <div class="col-sm-12">
                    {!! $blog->links() !!}
                </div>
            </div>
    @endif


    <!--end::Portlet-->
    </div>
@endsection
