@extends('layouts.app')

@section('content')
    <div class="kt-container">
        <div class="row">
            <div class="col-md-4">
                <!--begin::Portlet-->
                <div class="kt-grid__item kt-app__toggle " id="">

                    <!--Begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid-">
                        <div class="kt-portlet__head kt-portlet__head--noborder">
                            <div class="kt-portlet__head-label">
                                <h3 class="kt-portlet__head-title">
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                {{--<a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md pull-right" data-toggle="dropdown">--}}
                                {{--<i class="flaticon-more-1"></i>--}}
                                {{--</a>--}}
                                {{--<div class="dropdown-menu dropdown-menu-right">--}}
                                {{--<ul class="kt-nav">--}}

                                {{--<li class="kt-nav__item">--}}
                                {{--<a href="/message/{{$model->id}}" class="kt-nav__link">--}}
                                {{--<i class="kt-nav__link-icon flaticon2-send"></i>--}}
                                {{--<span class="kt-nav__link-text">Messages</span>--}}
                                {{--</a>--}}
                                {{--</li>--}}


                                {{--</ul>--}}

                                {{--</div>--}}
                            </div>
                        </div>
                        <div class="kt-portlet__body" style="margin-top:-50px;">
                            <div class="kt-widget kt-widget--user-profile-1">

                                <div class="kt-widget__head">
                                    <div class="kt-widget__media">

                                        @if($model->avatar && $model->avatar != ' ' && $model->avatar != '')
                                            <a class=" spotlight"  data-control="fullscreen,zoom" alt="avatar" href="{{ $model->avatar }}"><img src="{{ $model->avatar }}"  ></a>
                                        @else
                                            <span class="kt-header__topbar-icon text-success default-user-avatar"><b>Support</b></span>
                                        @endif
                                        <p>{{ $model->email }}</p>
                                    </div>

                                    <div class="kt-widget__content">
                                        <div class="kt-widget__section">


                                        </div>
                                        <div class="kt-widget__action">
                                            <small>Contact us for all support requests <br> or share your ideas with us</small>

                                        </div>
                                    </div>
                                </div>
                                <div class="kt-widget__body">
                                    <div class="kt-widget__content"  style="padding-top: 0;">

                                        <div class="clearfix text-center">
                                            @if(isset($model->options['badges']) && count($model->options['badges']))
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <hr>
                                                        @foreach($model->options['badges'] as $key => $val)

                                                            @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                                                                <button  style="margin:1px;background-color:#041734;" class="btn btn-default"  data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="{{ $badges[$key]['name'] }}" >
                                                                    <img  style="width:23px;" src="{{ $badges[$key]['icon'] }}" alt="{{ $badges[$key]['name'] }}" >
                                                                </button>

                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>

                                            @endif
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <div class="col-sm-8">


                <!--end::Portlet-->

                <!--begin:: Widgets/Notifications-->

                <div class="kt-portlet" id="userActivity">

                    <div class="kt-portlet__body">
                        <!-- begin:: Content -->
                        <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">

                            <div class="kt-chat">

                                <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                                    <div class="kt-portlet__head">
                                        <div class="kt-chat__head ">
                                            <div class="kt-chat__left">


                                            </div>
                                            <div class="kt-chat__center">
                                                <div class="kt-chat__label">
                                                    <p>Support</p>

                                                    <span class="kt-chat__status">
                                                        <span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
                                                    </span>

                                                </div>

                                            </div>
                                            <div class="kt-chat__right">

                                            </div>
                                        </div>
                                        {{--<div class="kt-portlet__head-toolbar">--}}
                                        {{--<a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">--}}
                                        {{--<i class="flaticon-more-1"></i>--}}
                                        {{--</a>--}}
                                        {{--<div class="dropdown-menu dropdown-menu-right">--}}

                                        {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div class="kt-portlet__body">
                                        <div class="kt-scroll kt-scroll--pull" id="scroll-message"  data-height="400" data-mobile-height="320">
                                            <div class="kt-chat__messages user-messages " id="private-messages-{{$conversation_id}}">
                                                @foreach($messages as $obj)
                                                    @include('shared.single_message')
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>

                                    <div class="kt-portlet__foot">
                                        <div class="form-group row">

                                            <div class="col-11">
                                                <div class="form-group send-message" style="position:relative;">
                                                    {!! Form::text('body', null, ['class' => 'form-control',  'placeholder' => 'Type message','data-emojiable' => 'true', 'data-to_user_id' => $toUser->id , 'data-conversation_id' => $conversation_id, 'id' => 'msg-body']) !!}

                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <div class="form-group pull-right" style="position:relative;">
                                                    <button type="submit" class=" btn btn-primary btn-icon" id="sendMessage"><i class="fa fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <small class="text-muted">Messages older than one month will be deleted automatically</small>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end:: Content -->
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
