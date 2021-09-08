@foreach($activity as $obj)


   
<div class="kt-notification__item" >
    <a href="/adventure/{{ $obj->post_id}}/{{ $obj->slug }}">
        <div class="kt-notification__item-icon"  style="max-width:50px;min-width:50px;" >
        
                @php $image = json_decode($obj->image);@endphp
                @if(isset($image[0]->thumb_path))
                    <img src="{{ $image[0]->thumb_path }}" width="70" style="width:70px;" class="rounded-circle">
                @endif  
        
        </div>
    </a>
    <div class="kt-notification__item-details">
        <div class="kt-notification__item-title">

            <span>
                @if($obj->username)
                    <a href="/{{ '@' .$obj->username_slug }}" class="text-muted">
                        <b>{{ $obj->username }}</b>
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
       
        <div class="kt-notification__item-time">
            @php $created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $obj->created_at);@endphp
            {{ $created_at->diffForHumans() }}
        </div>
    </div>
    @if((isset($hasPost) && !$hasPost) || (!isset($hasPost)))
            <div style="margin:5px;">
            
                @if(isset($obj->seen) && $obj->seen == 0)
                    <span class="kt-badge kt-badge--dot kt-badge--success"></span>
                @endif
            </div>
        @endif
</div>
  

@endforeach