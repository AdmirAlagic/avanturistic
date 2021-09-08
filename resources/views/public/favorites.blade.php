@extends('layouts.app')

@section('content')
    <!--begin::Portlet-->
    @include('shared.success_error')


    <div id="overlay"></div>
    <div id="home">
        <div class="kt-portlet" >

            <div class="kt-portlet__body">

                <div class="kt-visible-desktop">
                    <div class="row ">
                        <div class="col-12">
                            <h6 class="text-center text-muted">Favorites <small>({{ count($last_favorites) }})</small></h6>
                        </div>
                        @foreach($last_favorites as $obj)
                            @include('shared.single_favorite')
                        @endforeach
                        <div class="col-sm-12 text-center">
                            @if(count($favorites) > 12)
                                <br>
                                <a href="/favorite-users" class="btn btn-success">View all</a>
                            @endif
                            <hr>
                        </div>
                    </div>
                </div>
                @if(count($favorites))
                    <p class="text-center">Latest from your favorites</p>
                    <br>
                    <div class="row">
                        <div id="more-posts" style="min-height:400px;">

                        </div>
                    </div>
                @else
                    <p>You haven't added any favorite profiles</p>
                @endif

            </div>
        </div>
    </div>



@endsection
