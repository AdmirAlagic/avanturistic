{{--@if(isset($breadcrumbs) && count($breadcrumbs))--}}
    {{--<!-- begin:: Subheader -->--}}
    {{--<div class="kt-subheader   kt-grid__item" id="kt_subheader">--}}
        {{--<div class="kt-container ">--}}
            {{--<div class="kt-subheader__main">--}}
                {{--<h3 class="kt-subheader__title">{{isset($pageTitle) ? $pageTitle : config('app.name')}}</h3>--}}
                {{--<div class="kt-subheader__breadcrumbs">--}}
                    {{--<a href="/" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>--}}
                    {{--@foreach($breadcrumbs as $breadcrumb)--}}
                        {{--<span class="kt-subheader__breadcrumbs-separator"></span>--}}
                        {{--<a href="{{ isset($breadcrumb['link']) ? $breadcrumb['link'] : '#' }}" class="kt-subheader__breadcrumbs-link">--}}
                            {{--{{ $breadcrumb['text'] }} </a>--}}
                    {{--@endforeach--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="kt-subheader__toolbar">--}}
                {{--<div class="kt-subheader__wrapper">--}}
                    {{--<a href="#" class="btn kt-subheader__btn-secondary" onclick="return false;" data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="" data-original-title="Coming soon!" aria-describedby="tooltip184482">--}}
                        {{--My Referral Network--}}
                    {{--</a>--}}

                    {{--<a href="#" class="btn kt-subheader__btn-secondary" onclick="return false;" data-container="body" data-toggle="kt-tooltip" data-placement="bottom" title="" data-original-title="Coming soon!" aria-describedby="tooltip184482">--}}
                        {{--My Earnings--}}
                    {{--</a>--}}

                    {{--<div class="dropdown dropdown-inline" data-toggle="kt-tooltip" title="" data-placement="bottom" data-original-title="Coming soon!">--}}
                        {{--<a href="#" class="btn btn-danger kt-subheader__btn-options" onclick="return false;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                            {{--Shop--}}
                        {{--</a>--}}
                        {{--<div class="dropdown-menu dropdown-menu-right">--}}
                            {{--<a class="dropdown-item" href="#"><i class="la la-plus"></i> New Product</a>--}}
                            {{--<a class="dropdown-item" href="#"><i class="la la-user"></i> New Order</a>--}}
                            {{--<a class="dropdown-item" href="#"><i class="la la-cloud-download"></i> New Download</a>--}}
                            {{--<div class="dropdown-divider"></div>--}}
                            {{--<a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}
{{--@endif--}}
