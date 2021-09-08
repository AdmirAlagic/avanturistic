@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
													<span class="kt-portlet__head-icon">
														<i class="flaticon2-graph"></i>
													</span>
                        <h3 class="kt-portlet__head-title">
                            Dashboard
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <p>Posts: <b>{{ count($posts) }}</b></p>
                    <p>Users: <b>{{ count($users) }}</b></p>
                    <p>New support messages: {{ $newMessagesForSupport }}</p>
                    <p><a href="/highlights">Highlights</a>
                    </p>
                    <p><a href="/download-timelapse/1">Download</a>
                    </p>
                </div>
                <div class="kt-portlet__foot">
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="kt-align-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end::Portlet-->

        </div>
    </div>
@endsection
