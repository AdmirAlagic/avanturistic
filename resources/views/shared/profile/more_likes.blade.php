@foreach($activity as $obj)

    <div class="kt-notification__item kt-animate-fade-in">

        @php $image = json_decode($obj->image);@endphp
        @if((isset($hasPost) && !$hasPost) || (!isset($hasPost)))
        <a href="/adventure/{{ $obj->post_id}}/{{ $obj->slug }}" >
        <div class="kt-notification__item-icon" style="max-width:50px;min-width:50px;" >
            @if(isset($image[0]->thumb_path))
                <img src="{{ $image[0]->thumb_path }}" width="70" style="width:70px;" class="rounded-circle">
            @endif
        </div>
        </a>
        @endif
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title">

                <span><i class="fa fa-heart text-green"></i>&nbsp; </span> from <a class="text-muted" href="/{{ '@' .$obj->username_slug  }}">{{ $obj->username }}</a>


            </div>
            <div class="kt-notification__item-time">
                @php $created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $obj->created_at);@endphp
                {{ $created_at->diffForHumans() }}
            </div>
        </div>
        @if((isset($hasPost) && !$hasPost) || (!isset($hasPost)))
            <div style="margin:5px;">
            
                @if(isset($obj->seen) &&  $obj->seen == 0)
                    <span class="kt-badge kt-badge--dot kt-badge--success"></span>
                @endif
            </div>
        @endif
    </div>


@endforeach