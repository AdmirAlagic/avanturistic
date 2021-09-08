@foreach($activity as $obj)



    <div class="kt-notification__item kt-animate-fade-in">
        @php $image = json_decode($obj->image);@endphp
        @if((isset($hasPost) && !$hasPost) || (!isset($hasPost)))
            <a href="/adventure/{{ $obj->post_id}}/{{ $obj->slug }}" >
                <div class="kt-notification__item-icon" style="max-width:50px;min-width:50px;" >
            
                    @if(isset($image[0]->thumb_path))
                        <img src="{{ $image[0]->thumb_path }}"  width="70" style="width:70px;" class="rounded-circle">
                    @endif
                </div>
            </a>
        @endif

        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title">

                <a href="/{{ '@' .$obj->username_slug }}" class="text-muted">
                    @if($obj->avatar)
                        <span><img  class=" img-fade-hover"   src="{{ $obj->avatar }}" data-srcset="{{ $obj->avatar }}" width="37" height="37" style="width:37px;border:1px solid #999;border-radius:50%;" alt="{{ $obj->username }}"></span>&nbsp;
                    @else
                        <div style="display:inline-block; padding-top:8px;padding-left:1px;margin:0;" class=" kt-header__topbar-icon text-white post-avatar"><b>{{ ucfirst($obj->username[0]) }}</b></div>&nbsp;
                    @endif
                    {{ $obj->username }}

                </a> <span> &nbsp;<i class="fa  fa-shoe-prints text-gray" style="font-size:1.2rem;"></i>&nbsp; </span>
                    was here 

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
