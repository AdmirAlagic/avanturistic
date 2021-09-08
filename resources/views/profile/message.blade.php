@extends('layouts.app')

@section('content')
    <div class="kt-container" style="padding:0;">
        <!-- begin:: Content -->
        <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">



            <div class="kt-chat">

                <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                    <div class="kt-portlet__head">
                        <div class="kt-chat__head ">
                            <div class="kt-chat__left">
                                <div class="kt-chat__label">
                                    <a href="/messages" class="kt-chat__title text-muted"><i class="fa fa-arrow-left"></i></a>

                                </div>

                            </div>
                            <div class="kt-chat__center">
                                <div class="kt-chat__label">
                                    

                                    <span class="kt-media kt-media--circle kt-media--sm">
                                        
                                        <div style="position:relative;display:inline-block;margin-right:10px;">
                                            @if($toUser->avatar && $toUser->avatar != ' ' && $toUser->avatar != '')
                                                <a class="text-muted" style="padding-top:10px;font-size:1rem;" href="/{{ '@' .$toUser->name_slug }}">
                                                    <span><img class="img-circle" src="{{ $toUser->avatar }}" style="width:35px;height:35px;box-shadow:none;border:1px solid #eeeeee;" alt="{{ $toUser->name  }}"></span>
                                                </a>
                                            @else
                                                <a class="text-muted" style="padding-top:10px;font-size:1rem;" href="/{{ '@' .$toUser->name_slug }}">
                                                    <div style="display:inline-block; padding-top:7px;padding-left:1px;margin:0;width:35px;height:35px;" class=" kt-header__topbar-icon text-white post-avatar"><b>{{ ucfirst($toUser->name[0]) }}</b></div>
                                                </a>
                                            @endif 
                                            @if($toUser->isOnline())
                                                <span class="kt-chat__status" style="position:absolute;right:1px;bottom:0px;">
                                                    <span class="kt-badge kt-badge--dot kt-badge--success" style="position:absolute;right:-2px;bottom:-2px;width:13px;height:13px;border:2px solid #FFF;"></span>&nbsp;
                                                </span>
                                            @endif
                                        </div>
                                        <a class="text-muted" style="padding-top:10px;font-size:1rem;" href="/{{ '@' .$toUser->name_slug }}">{{ $toUser->name }}</a>
                                    
                                </span>
                                
                                </div>

                            </div>
                            <div class="kt-chat__right">

                            </div>
                        </div>
                       <!--  <div class="kt-portlet__head-toolbar">
                            <a href="#" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown">
                                <i class="flaticon-more-1"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="kt-nav">

                                    <li class="kt-nav__item">
                                        <a  class="kt-nav__link" href="/block-user/{{$conversation_id}}">
                                            @if(!$is_blocked)
                                                <i class="fa fa-user-lock"></i> &nbsp;&nbsp;Block user
                                            @else
                                                @if($is_blocked == $user->id)
                                                    <i class="fa fa-unlock"></i> &nbsp;&nbsp;Unblock user
                                                @endif
                                            @endif
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div class="kt-portlet__body">
                        @if(!$is_blocked)
                            <div class="kt-scroll kt-scroll--pull" id="scroll-message" style="height: 400px;overflow-y: scroll;" data-height="600" data-mobile-height="520">
                                <div class="kt-chat__messages user-messages " id="private-messages-{{$conversation_id}}">
                                    @foreach($messages as $obj)
                                        @include('shared.single_message')
                                    @endforeach

                                </div>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <span><i class="fa fa-info-circle"></i> &nbsp;&nbsp;</span>
                                @if($is_blocked == $user->id)
                                    This user is blocked.
                                @else
                                    This user blocked you.
                                @endif
                                You can't see each others profiles or send messages.
                            </div>
                        @endif
                    </div>
                    @if(!$is_blocked)
                        <div class="kt-portlet__foot">
                            <div class="form-group row" style="">

                                <div class="col-10" style="padding:0;">
                                    <div class="form-group send-message" style="position:relative;">
                                        {!! Form::text('body', null, ['class' => 'form-control',  'placeholder' => 'Type message','data-emojiable' => 'true', 'data-to_user_id' => $toUser->id , 'data-conversation_id' => $conversation_id, 'id' => 'msg-body', 'style'=> 'height:40px;border-color: #b4d677;' ]) !!}

                                    </div>
                                </div>
                                <div class="col-2  text-right" style="padding:0;">
                                    <div class="form-group" style="position:relative;">
                                        <button style="height: 40px;-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;" type="submit" class=" btn btn-success btn-icon" id="sendMessage"><i class="fa fa-paper-plane"></i></button>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <small class="text-muted">Messages older than one month will be deleted automatically</small>
                                    <br><br><br>
                                </div>
                            </div>

                        </div>
                    @endif
                </div>
            </div>

        </div>
        <!-- end:: Content -->

    </div>
@endsection

