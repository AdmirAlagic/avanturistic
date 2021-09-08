@if($obj->from && $obj->to)
<div class="kt-chat__message {{  $obj->from_user_id != $user->id ? 'kt-chat__message--success' : 'kt-chat__message--brand kt-chat__message--right'}}">

    <div class="kt-chat__user">
        
        @if($obj->from_user_id != $user->id)
       
       
          
          
                @if($obj->from->avatar &&  $obj->from->avatar != ' ' &&  $obj->from->avatar != '')
                    <a href="/{{ '@' .$obj->from->name_slug }}" class="kt-chat__username">
                        <span><img class="img-circle"  src="{{  $obj->from->avatar }}" style="width:35px;height:35px;margin-left:-4px;margin-right:10px;box-shadow:none;" alt="{{  $obj->from->name  }}"></span>
                    </a> 
                @else
                    <a href="/{{ '@' .$obj->from->name_slug }}" class="kt-chat__username">
                        <div style="display:inline-block; padding-top:8px;padding-left:1px;margin:0;width:35px;height:35px;" class=" kt-header__topbar-icon text-white post-avatar"><b>{{ ucfirst($obj->from->name[0]) }}</b></div>
                    </a> 
                @endif
           
       
        @endif
       
    </div>
    <div class="kt-chat__text">
        {!! $obj->body !!}

    </div>
    
</div>
@endif
