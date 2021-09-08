@if($notification->fromUser)
<div class="kt-notification__item kt-animate-fade-in">
    <a href="{{ $notification->url }}" >
    <div class="kt-notification__item-icon" style="max-width:50px;min-width:50px;" >
        @if($notification->image_url)
            <img class="lazy" width="70" style="width:70px;"  src="/img/placeholder-trans.png" data-src="{{ $notification->image_url }}" data-srcset="{{ $notification->image_url }}">
        @endif
    </div>
    </a>
    <div class="kt-notification__item-details">
        <div class="kt-notification__item-title text-muted">
        <a class="text-muted" href="/{{ '@' .$notification->fromUser->name_slug }}">{{ $notification->fromUser->name }}</a>&nbsp;
            <span><i class="fa fa-heart text-green"></i>&nbsp;</span>
               <span>your timelapse</span>



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
@endif