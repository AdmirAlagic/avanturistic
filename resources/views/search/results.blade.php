@if(count($users) || count($posts) || count($countries))
    <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" style="z-index:1;">
        <div id="quick-search-list ">
           
            @foreach($posts as $post)

                <a href="/adventure/{{$post->id}}/{{ $post->slug }}#" class="kt-notification__item kt-nav__link--active" style="align-items:flex-start;">
                    <div class="kt-notification__item-icon kt-pulse kt-pulse--light"  style="margin-right:2rem;flex:0 50px;min-width: 50px;position:relative;" >
                        @if(isset($post->image[0]['thumb_path']))

                            <span ><img class="border-r4"  src="{{ $post->image[0]['thumb_path'] }}" style="width:60px;border:none;"></span>
                            
                        @endif
                        @if($post->country)
                            <div style="position:absolute;top:-10px;right:-10px;margin-left:-1px;display:inline-block;border:2px solid #FFFFFF;background-image:url('/img/countries/svg/{{ strtolower($post->country->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 25px; height: 25px;">
                        </div>
                        @endif
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title ">
                            @if($post->title)
                                <p style="margin-bottom:0px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:15px;height:15px;margin-right:5px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg> {{$post->title}}
                                </p>
                            @endif
                            
                           
                            
                            <div class="mt-5 mb-5 " style="margin-bottom:5px;">
                               {{--  [@if]($post->address)
                                    <div class=>{{ $post->address }}</div>
                                @endif --}}
                                 <div class="text-gray" >
                                    
                                    {{ $post->country ? $post->country->title  : '' }}
                                 </div>
                                 
                            </div>
                          
                            
                        </div>
                        <div class="kt-notification__item-time">
                                
                        </div>
                    </div>
                </a>

            @endforeach
            @foreach($users as $obj)

            <a href="/{{ '@' .$obj->name_slug }}" class="kt-notification__item kt-nav__link--active">
                <div class="kt-notification__item-icon kt-pulse kt-pulse--light"  style="flex:0 50px;" >
                    @if($obj->avatar && $obj->avatar != ' ' && $obj->avatar != '')

                        <span ><img src="{{ $obj->avatar }}" style="border-radius:50%;border:none;width:50px;"></span>
                    @else
                    <div class="items-center  kt-header__topbar-icon post-avatar text-gray" style="background-color:#eeeeee;display:inline-flex;;margin-top:0px;width:50px;height:50px;" ><b>{{ ucfirst($obj->name[0]) }}</b></div>
                    @endif
                    
                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:15px;height:15px;margin-right:10px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                          </svg>
                          <span>{{$obj->name}}</span>
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
                        <div  class="items-center  kt-header__topbar-icon post-avatar text-gray" style="display:inline-block;border:1px solid #999999;margin-left: auto;margin-right: auto;background-image:url('/img/countries/svg/{{ strtolower($obj->code2) }}.svg');background-repeat:no-repeat;background-size:cover; background-position: 50% 50%;-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 50px; height: 50px;">
                        </div>
                            
                        @endif
                            
                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title ">
                        <span>  
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:15px;height:15px;margin-right:10px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
                              </svg>
                            <b>{{ $obj->title }}</b></span>
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