@extends('layouts.admin')

@section('content')
    <!--begin::Portlet-->
    <div class="kt-portlet kt-portlet--mobile">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Newsletter
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <a href="{{route('admin.newsletter.create')}}" class="btn btn-success btn-sm text-white">New email</a>
            @include('shared.success_error')
        </div>
    </div>

@endsection
