<div class="kt-notification__item kt-animate-fade-in">
    @if($notification->url)
        <a href="{{ $notification->url }}" >
    @endif
        <div class="kt-notification__item-icon" style="max-width:50px;min-width:50px;" >
            @if($notification->image_url)
<!--                 <img src="{{ $notification->image_url }}" width="70" style="width:70px;" class="rounded-circle">
 -->                <img class="lazy" width="50" style="width:50px;"  src="/img/placeholder-trans.png" data-src="{{ $notification->image_url }}" data-srcset="{{ $notification->image_url }}">

            @endif
        </div>
    @if($notification->url )
        </a>
    @endif
    <div class="kt-notification__item-details" style="width:90%;">
        <div class="kt-notification__item-title">
            <span class="text-muted">
                 {!! $notification->content !!}
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