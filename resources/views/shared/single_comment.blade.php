<div class="row comment-row"  style="border-bottom:1px solid #eee;padding-bottom:10px;margin-top:20px;">
    <div class="col-2 text-center">
        @if($obj->user)
            @if($obj->user->group == 'admin')
            <span ><img class=" " src="{{ url('img/logo.svg')}}" style="width:40px;"></span>

            @else
                <a href="/{{ '@' .$obj->user->name_slug }}">
                    @if($obj->user->avatar && $obj->user->avatar != ' ' && $obj->user->avatar != '')
                        <span ><img class="img-circle" src="{{ $obj->user->avatar }}" style="width:50px;"></span>
                    @else
                        <span><div style="width:50px;height:50px;padding-top:14px;margin-left:auto;margin-right:auto;background:#d8d8d8;" class="img-circle  text-white  "><b>{{ ucfirst($obj->user->name[0]) }}</b></div></span>
                    @endif
                </a>
            @endif
        @else
            @if($obj->website)
                <a target="_blank" href="{{ $obj->website }}">
                    <span ><img class="img-circle" src="/img/avatar-guest.jpg" style="width:50px;"></span>
                </a>
            @else
                <span><img class="img-circle" src="/img/avatar-guest.jpg" style="width:50px;"></span>
            @endif

        @endif

    </div>
    <div class="col-10">
        <h6 class="text-muted">
            @if($obj->user)
                <b>{{ $obj->user->name }}</b>
            @else
                <b>{{ $obj->name }}</b>
            @endif

        </h6>
        <p>{{ $obj->body }}</p>
        <span>
                    <small class="text-muted">
                        {{ $obj->created_at->diffForHumans() }}
                    </small>
                </span>
        @if($user && ($user->id == $obj->user_id || $user->group == 'admin'))

            <span class="pull-right">
                       

                    <button type="button" name="button" class="btn text-muted sweet-alert-"  data-comment_id="{{ $obj->id }}"data-alert_title="Are you sure?" data-alert_type="warning" data-alert_text="You wont be able to revert this.">
                        Remove Comment
                    </button>
                 
                   </span>
        @endif
    </div>

</div>
