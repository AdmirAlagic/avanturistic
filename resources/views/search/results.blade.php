@if(count($users) || count($posts) || count($countries))
    <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" style="z-index:1;">
        <div id="quick-search-list">
            @foreach($users as $obj)

                <a href="/{{ '@' .$obj->name_slug }}" class="kt-notification__item kt-nav__link--active">
                    <div class="kt-notification__item-icon kt-pulse kt-pulse--light"  style="margin-right:2rem;flex:0 50px;" >
                        @if($obj->avatar && $obj->avatar != ' ' && $obj->avatar != '')

                            <span ><img src="{{ $obj->avatar }}" style="border-radius:50%;border:none;"></span>
                        @else
                        <div class="items-center  kt-header__topbar-icon post-avatar text-gray" style="background-color:#eeeeee;display:inline-flex;;margin-top:0px;width:50px;height:50px;" ><b>{{ ucfirst($obj->name[0]) }}</b></div>
                        @endif
                        
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title ">
                        <i class="fa fa-user "></i> &nbsp;<span>{{$obj->name}}</span>
                        </div>
                        <div class="kt-notification__item-time">
                            
                        </div>
                    </div>
                </a>

            @endforeach
            @foreach($posts as $post)

                <a href="/adventure/{{$post->id}}/{{ $post->slug }}#" class="kt-notification__item kt-nav__link--active">
                    <div class="kt-notification__item-icon kt-pulse kt-pulse--light"  style="margin-right:2rem;flex:0 50px;position:relative;" >
                        @if(isset($post->image[0]['thumb_path']))

                            <span ><img class="border-r4"  src="{{ $post->image[0]['thumb_path'] }}" style="width:60px;border:none;"></span>
                            
                        @endif
                        @if($post->country)
                            <div style="position:absolute;bottom:-10px;right:-10px;margin-left:-1px;display:inline-block;border:2px solid #FFFFFF;background-image:url('/img/countries/svg/{{ strtolower($post->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 25px; height: 25px;">
                        </div>
                        @endif
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title ">
                            <p style="margin-bottom:0px;">
                                <i class="fa fa-map-marker-alt "></i>  {{$post->title}}
                            </p>
                            
                           
                            
                            <div class="mt-5 mb-5 " style="margin-bottom:5px;">
                               {{--  @if($post->address)
                                    <div class=>{{ $post->address }}</div>
                                @endif --}}
                                 <div class="text-gray">
                                    {{ $post->country ? $post->country->title  : '' }}
                                 </div>
                                 
                            </div>
                          
                            
                        </div>
                        <div class="kt-notification__item-time">
                                
                        </div>
                    </div>
                </a>

            @endforeach
            @foreach($countries as $obj)

                <a href="/country/{{ $obj->slug }}#" class="kt-notification__item kt-nav__link--active">
                    <div class="kt-notification__item-icon kt-pulse kt-pulse--light text-center"  style="margin-right:2rem;flex:0 50px;" >
                        @if($obj->code2)
                        <div style="display:inline-block;border:1px solid #999999;margin-left: auto;margin-right: auto;background-image:url('/img/countries/svg/{{ strtolower($obj->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 34px; height: 34px;">
                        </div>
                            
                        @endif
                            
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title ">
                        <span>  <i class="fa fa-flag"></i> <b>{{ $obj->title }}</b></span>
                        <span></span>
                        </div>
                        <div class="kt-notification__item-time">
                            
                        </div>
                    </div>
                </a>

            @endforeach
            <br>
        </div>
    </div>
@else
<p style="margin-top:10px;">No results</p>
@endif