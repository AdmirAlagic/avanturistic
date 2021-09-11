@extends('layouts.app')

@section('content')
    <!-- begin:: Content -->
    <div class="kt-container  kt-grid__item kt-grid__item--fluid" style="min-height:680px;padding:0;">
        <div class="kt-portlet kt-portlet--tabs ">
            <div class="kt-portlet__head kt-hidden-tablet-and-mobile">
                <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon">
                            <i class="fa fa-envelope"></i>
                        </span>
                    <h3 class="kt-portlet__head-title text-dark">
                       Messages
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                @include('shared.success_error')
                <!--begin: Head -->


                <!--end: Head -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="topbar_notifications_notifications" role="tabpanel">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" data-height="300"  style="overflow-x:hidden !important;z-index:0;">
                            <div id="all-messages">
                                @include('shared.all_messages')
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <!-- end:: Content -->
@endsection

