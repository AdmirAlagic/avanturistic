@if(isset($favorites))
    <hr style="border-color:#595d6e;">
<h6 class="text-center text-green"><a href="/favorite-users" class="text-white">Favorites</a>
    (
    {{ count($favorites) }}
    )
    </h6>
    <hr style="border-color:#595d6e;">
    @if(count($favorites))
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach($favorites as $obj)
                        <li class="glide__slide" style="padding:20px; text-align:center; position:relative;" >
                            <span class="text-white" style="position:absolute; top:33%;left:20px;"><</span>
                            <a class="text-white" href="/{{ '@' .$obj->name_slug }}">
                                <div class="text-center  ">
                                    @if($obj->avatar && $obj->avatar != ' ' && $obj->avatar != '')
                                        <span><img class="avatar"  style="-webkit-border-radius: 8px;-moz-border-radius: 8px ;border-radius:  8px;width:66.66px;" src="{{ $obj->avatar }}"  alt="{{ $obj->name  }}"></span>
                                    @else
                                        <span class="kt-header__topbar-icon text-success "><p class="post-avatar" style="padding-top:13px;">{{ ucfirst($obj->name[0]) }}</p><b></b></span>
                                    @endif
                                </div>
                                <p><small>{{ $obj->name }}</small></p>

                            </a>
                            <span class="text-white" style="position:absolute; top:33%;right:20px;">></span>
                            <br>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @if(count($favorites) > 1)
        <div class="col-12 text-center" style="margin-top: -60px;">
            <a href="/search" class="btn text-white " style="-webkit-border-radius: 4px !important;-moz-border-radius: 4px !important;border-radius: 4px !important;">
                <span class="text-white">
                    View all
                </span>
            </a>
        </div>
        <hr style="border-color:#595d6e;margin-bottom: 0;">

        @endif

    @else
       <div>
           <p class="text-center">
               <small class="text-white">
                   You haven't added any favorite profiles
               </small>
           </p>
       </div>
    @endif
    <div class="col-12 text-center align-self-end"  >
        <br>
        <div style="min-height: 30px;"></div>
        <a href="/support" class="btn btn-dark text-white">Contact Support</a>
        <div style="min-height: 40px;"></div>
    </div>
@endif
