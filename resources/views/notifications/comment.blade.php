 
<div class="kt-notification__item kt-animate-fade-in">
    <a href="{{ $notification->url }}" >
    <div class="kt-notification__item-icon" style="max-width:50px;min-width:50px;" >
        @if($notification->image_url)
            <img class="lazy" width="70" style="width:70px;"  src="/img/placeholder-trans.png" data-src="{{ $notification->image_url }}" data-srcset="{{ $notification->image_url }}">
        @endif
    </div>
    </a>
    <div class="kt-notification__item-details">
        <div class="kt-notification__item-title">

            <span class="text-muted">
                    @if($notification->fromUser)
                        <a href="/{{ '@' .$notification->fromUser->name_slug }}" class="text-muted">
                            <b>{{ $notification->fromUser->name }}</b>
                        </a>
                        @else
                            Guest
                        @endif
                    </small>
                &nbsp;
                <small>
                    <i class="fa fa-comment-alt text-muted"></i>
                </small>
                    &nbsp;commented your adventure
            </span> 

        </div>
        <div class="kt-notification__item-time text-gray">
            
            {{ $notification->created_at->diffForHumans() }}
        </div>
    </div>
    <div style="margin:5px;">
        
            @if(isset($notification->seen) &&  $notification->seen == 0)
                <span class="kt-badge kt-badge--dot kt-badge--success seen-badge"></span>
            @endif
        </div>
</div>
 