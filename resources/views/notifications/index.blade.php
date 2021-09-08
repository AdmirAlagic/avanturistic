@extends('layouts.app')
@section('content')
 <!-- begin:: Content -->
 <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="min-height:700px;padding:0;" id="all-notifications">
        <div class="kt-portlet kt-portlet--tabs">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="fa fa-bell"></i>
                        </span>
                    <h3 class="kt-portlet__head-title text-dark">
                       Notifications
                    </h3>
                </div>
                 
            </div>
            <div class="kt-portlet__body">
                
                
                <div class="kt-notification  kt-margin-t-10 kt-margin-b-10 " style="z-index:0;">
                @foreach($notifications as $notification)
                    @include($notification->getView())
                @endforeach
                </div>
            </div>
        </div>
    </div>
@stop