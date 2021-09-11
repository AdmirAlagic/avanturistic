@if(count($conversations))
    @foreach($conversations as $obj)
        @php $message = $obj->lastMessage;@endphp
        @if($message && $message->from && $message->to)
        @php $sender = $message->from->id != $user->id ? $message->from : $message->to;@endphp
        <a href="/message/{{$sender->id}}#" class="kt-notification__item kt-nav__link--active" style="z-index:2;">
            <div class="kt-notification__item-icon  kt-pulse kt-pulse--light"  style="flex:0 50px;z-index:2;margin-right:1rem;position:relative;" >
                @if($sender->avatar && $sender->avatar != ' ' && $sender->avatar != '')
                    <span ><img src="{{ $sender->avatar }}" class="kt-header__topbar-icon img-circle" style="box-shadow:none;border:1px solid #eee;  "></span>
                @else
                    <div style="display:inline-block; padding-top:14px;padding-left:1px;margin:0;width:50px;height:50px;" class=" kt-header__topbar-icon text-white post-avatar"><b>{{ ucfirst($sender->name[0]) }}</b></div>
                @endif
               
                @if($sender->isOnline())
                    <span class="kt-badge kt-badge--dot kt-badge--success" style="position:absolute;right:1px;bottom:0px;width:13px;height:13px;border:2px solid #FFF;"></span>&nbsp;
                @endif
            </div>
            <div class="kt-notification__item-details">
                <div class="kt-notification__item-title ">
                    <span>
                       
                        {{$sender->name}}
                    </span>
                </div>
                <div class="kt-notification__item-time">
                    <p class="">{{Str::words($message->body, 10)}}</p>

                    @if($message->to_user_id == $user->id && $message->seen == 0)
                        <span class="text-dark">
                        <b>
                            {{ $message->created_at->diffForHumans() }}
                        </b>
                        </span>
                    @else
                        {{ $message->created_at->diffForHumans() }}
                    @endif
                </div>
            </div>
        </a>
        @endif
    @endforeach
@else
    <div>You haven't chated with anyone.</div>
@endif
