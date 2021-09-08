<div class="circle-posts my-post">
    <p class="text-center">
        @if($obj->user)

            <a class="text-muted" href="/{{ '@' .$obj->user->name_slug }}">
                <small>@if($obj->user->avatar && $obj->user->avatar != ' ' && $obj->user->avatar != '')
                        <span ><img src="{{ $obj->user->avatar }}"  alt="{{ $obj->user->name  }}" style="width:22px;border-radius:4px;"></span>
                    @else
                        <span class="kt-header__topbar-icon text-green default-user-avatar"><b>{{ ucfirst($obj->user->name[0]) }}</b></span>
                    @endif</small>
            </a>
        @endif
            <small class="text-muted t">{{ $obj->created_at->diffForHumans() }}</small>&nbsp;
    </p>
    <a href="/adventure/{{ $obj->id }}">
        <div class="country-img-frame" style="background-image: url('{{ $obj->image['thumb_path'] }}');">
            <img class="image-thumbnail" src="{{ $obj->image['thumb_path'] }}" alt="" style="width:100%;">
        </div>
    </a>
    <div class="circle-posts-toolbar">



        <small>
            <i class="fa fa-heart text-success "></i>  <span class="text-muted" id="likesCount">&nbsp;{{ $obj->likes }}</span>&nbsp;
            <i class="fa fa-shoe-prints text-success "></i><span class="text-muted" id="visitedsCount">&nbsp;{{ count($obj->visitedBy) }}</span>
                &nbsp;<i class="fa fa-comment-alt {{ count($obj->comments) ? 'text-success' : 'text-muted' }} "></i>  <span class="text-muted">{{ count($obj->comments) }}</span>
        </small>
        </a>

    </div>
</div>