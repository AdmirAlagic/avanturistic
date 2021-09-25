<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-header--fixed kt-header-mobile--fixed "  >
    <div class="kt-container ">

        <!-- begin:: Brand -->
       

        <!-- end:: Brand -->

        <!-- begin: Header Menu -->

        <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper"  >
            
            
            <div id="kt_header_menu" class="kt-header-menu  " >
                <a href="/" class="  font-weight-bold flex justify-center" style="margin-right:15px;">
                    <img class="header-logo-img" src="/img/logo.svg" style="width:35px;" width="35" alt="avanturistic.com"/>  
                </a>
            <!--end: Head -->

                <ul class="kt-menu__nav " style="padding-top:0 !important;padding-bottom: 0;">
                    
                    <li style="padding-left:0;" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel   " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                        <a href="/outdoor-adventures" class="kt-menu__link {{ isset($activePage) && $activePage == 'adventures' ?  'kt-menu__link--active' :  '' }} ">
                            Explore adventures
                        </a>
                    </li>

                    <li style="" class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel  " data-ktmenu-submenu-toggle="click" aria-haspopup="true" >
                        <a href="/the-world-map-of-outdoor-adventures" class="kt-menu__link {{ isset($activePage) && $activePage == 'map' ?  'kt-menu__link--active' :  '' }}">
                            
                             Interactive map
                          
                        </a>
                    </li>

                    <li  class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel  " data-ktmenu-submenu-toggle="click" aria-haspopup="true" >
                        <a href="/watch" class="kt-menu__link {{ isset($activePage) && $activePage == 'videos' ?  'kt-menu__link--active' :  '' }}">
                           
                                Watch
 
                        </a>
                    </li>
                    {{-- @if(isset($stories) && count($stories) > 4)
                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true" >
                        <a href="/stories" class="kt-menu__link {{ isset($activePage) && $activePage == 'stories' ?  'kt-menu__link--active' :  '' }}">
                            <span class="kt-menu__link-text"> 
                            <div class="img-circle" style="display:inline-block;width:30px;height:30px;border-width:2px;padding:4px;border-color:#4D4D4D;background: #101010;margin-right:2px;">
                                    <img class="" src="/img/stories_white.svg" style="width:24px;" alt="Adventure Stories">
                                 </div> <span style="font-size:0.9rem;padding-left:0.5rem;margin-right:1px;"> <b>STORIES</b></span>
                        </a>
                    </li>
                    @endif --}}
                    
                    @if(isset($user) && $user)

                        <li  class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true" >
                            <a href="/my-adventures" class="kt-menu__link {{ isset($activePage) && $activePage == 'my-adventures' ?  'kt-menu__link--active' :  '' }}" style="white-space: nowrap;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363" style="width:20px;margin-right:5px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                  </svg>
                                <span style="padding-top: 10px; padding-bottom: 10px;font-size:0.9rem;" class="kt-menu__link-text  ">My Adventures</span>
                            </a>
                        </li>
                        
                    @endif
                    </ul>
                       
                        {{-- <div class="text-center kt-visible-tablet-and-mobile" style="height: 150px; margin-top:200px;">
                            @if(isset($user) && !$user)
                            <a href="/login" class="btn btn-default text-white" style="background:transparent !important;">LOGIN</a>
                            <a href="/F-up" data-toggle="modal" data-target="#signUpModal" class="btn btn-green"><span class="text-white">SIGN UP</span></a>
                            <hr>
                            @endif
                            
                            <a  target="_blank" href="https://www.facebook.com/avanturistic">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ url('/img/social/fb-white.svg') }}"  data-srcset="{{ url('/img/social/fb-white.svg') }}" alt="Avanturistic on Facebook" style="width: 30px; height: 30px;">
                            </a>
                            <a target="_blank" href="https://www.instagram.com/avanturistic.com.app">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ url('/img/social/instagram-white.svg') }}" data-srcset="{{ url('/img/social/instagram-white.svg') }}" alt="Avanturistic on Instagram"  style="width: 30px; height: 30px;margin-left:1px;margin-right: 2px;">
                            </a>

                            <a target="_blank" href="https://play.google.com/store/apps/details?id=com.omnitask.avanturistic">
                                <img class="lazy" src="/img/placeholder-trans.png" data-src="{{ url('/img/social/google-play-white.svg') }}" data-srcset="{{ url('/img/social/google-play-white.svg') }}" alt="Avanturistic on Instagram"  style="width: 25px; height: 25px;">
                            </a>

                        </div>
                    --}}

            </div>
        </div>

        <!-- end: Header Menu -->

        <!-- begin:: Header Topbar -->



        <div class="kt-header__topbar justify-between" style="z-index:99999;">


            <div class=" kt-header__topbar-item  ">
                <a class="text-muted img-fade-hover loading" style="display: inline-flex;align-items:center; padding-left: 15px;padding-right: 15px;" href="/"  >
                    
                   <div style="width:21px;"> 
                    <img src="{{ url('/img/home.svg')}}" style="height:22px;"  class="{{ Request::segment(1) == '' ? 'active' : '' }}" alt="">
                   </div>
                </a>
            </div>

            <div class=" kt-header__topbar-item  " style="">
                <a class="loading img-fade-hover topbar-search" style="display: inline-flex;align-items:center; padding-left: 15px;padding-right: 15px;font-size:1.4rem;width:max-content;" href="/search"  >
                    
                    <img src="{{ url('/img/search.svg')}}" style="height:22px;"  class="{{ Request::segment(1) == 'search' ? 'active' : '' }}"alt="">
 
                </a>
            </div>
            <div class="kt-header__topbar-item  " >
                <a href="/share" class="dots text-muted   " style="display: inline-flex;align-items:center;padding-left: 12px;padding-right: 12px;font-size:1.1rem;"  >
                    <div style="width:23px;">
                        <img src="{{ url('img/pinplus.svg')}}" style="height:23px;"  class="{{ Request::segment(1) == 'share' ? 'active' : '' }}"  alt="Avanturistic Homepage">
                    </div>
                </a>
            </div>
            @if(isset($user) && $user)
                <div class="kt-header__topbar-item  " id="last-messages" style=" padding-left:5px; padding-right:5px;" >
                    <div class=" kt-header__topbar-item  " >
                        <a class="loading img-fade-hover " style="display: inline-flex;align-items:center; padding-left: 10px;padding-right: 10px;font-size:1.5rem;color:#3C3C3C;width:max-content;" href="/messages"  >
                            <div style="position: relative; width:max-content;">
                               
                                <img src="{{ url('/img/chat.svg')}}" style="height:22px;"  class="{{ Request::segment(1) == 'messages' ? 'active' : '' }}" alt="">
                                @if(count($user->unreadMessages)  > 0)
                                    <div class="circle notification-mobile  font-boldest" >
                                        {{ count($user->unreadMessages) }}
                                    </div>
                                @endif
                            </div>
                           
                        </a>
                    </div>
                </div>
                <div class="kt-header__topbar-item  " id="last-messages" style=" padding-left:5px; padding-right:5px;" >
                    <div class=" kt-header__topbar-item  " style="">
                        <a class="loading img-fade-hover " style="display: inline-flex;align-items:center; padding-left: 10px;padding-right: 10px;font-size:1.5rem;color:#3C3C3C;" href="/notifications"  >
                            <div style="position: relative; width:max-content;">
                               
                                <img src="{{ url('/img/bell.svg')}}" style="height:22px;" class="{{ Request::segment(1) == 'notifications' ? 'active' : '' }}" alt="">
                                @if($unreadNotifications  > 0)
                                    <div class="circle notification-mobile font-boldest ">
                                        {{ $unreadNotifications }}
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
              
                
               
            @else
                
            @endif
 
            @if(isset($user))
                
                <!--begin: User bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user kt-hidden-tablet-and-mobile">

                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" style="padding-left: 12px;" data-offset="10px,0px">
                       
                      {{--   <span class="kt-header__topbar-username" style="white-space: nowrap;"></span>
 --}}
                        @if($user->avatar && $user->avatar != '' && $user->avatar != ' ')
                            <span class="kt-header__topbar-icon ">
                                <img class="img-circle"  alt="{{ $user->name }}" style="border-width:1px;border-color:#474747;" src="{{ $user->avatar }}" />
                            </span>
                        @else
                            <span class="post-avatar " style=" align-self:center;"><b class=" text-white">{{ ucfirst($user->name[0]) }}</b></span>
                        @endif

                    </div>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl" style="z-index:99999;">

                       

                        <!--begin: Navigation -->
                        <div class="kt-notification" style="z-index: 999;">
                            @if($user->group == 'admin' || $user->group == 'moderator')
                                <a href="/admin" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center">
                                        <i class="flaticon2-settings kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Admin
                                        </div>

                                    </div>
                                </a>
                                <a href="/blog" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center">
                                        <i class="fa fa-cogs text-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Blog</b>
                                        </div>

                                    </div>
                                </a>
                                <a href="/admin/categories" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center">
                                        <i class="fa fa-cogs text-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Categories</b>
                                        </div>

                                    </div>
                                </a>
                                <a href="/admin/posts" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center">
                                        <i class="fa fa-cogs text-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Posts</b>
                                        </div>

                                    </div>
                                </a>
                                <a href="/admin/users" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center">
                                        <i class="fa fa-cogs text-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Users</b>
                                        </div>

                                    </div>
                                </a>
                            @else

                                <a href="/{{ '@' . $user->name_slug}}" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center" style="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                          </svg>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Profile
                                        </div>

                                    </div>
                                </a>
                                <a href="/profile" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center" >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                          </svg>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Settings
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Edit profile preferences
                                        </div>
                                    </div>
                                </a>
                                <a href="/my-adventures" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center" style="">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                          </svg>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>My Adventures</b>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Manage your adventures
                                        </div>
                                    </div>
                                </a>
                               {{--  <a href="/my-timelapses" class="kt-notification__item">
                                    <div class="kt-notification__item-icon items-center justify-center items-center" style="padding-left:2px;">
                                        <img src="/img/reel.svg" alt="My Timelapses" style="height:22px;">
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>My Timelapses</b>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Manage your timelapses
                                        </div>
                                    </div>
                                </a> --}}
                            
                            @endif
                            <a href="/logout" class="kt-notification__item">
                                <div class="kt-notification__item-icon items-center justify-center items-center" style="padding-left:8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="#636363">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                      </svg>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title kt-font-bold">
                                        {!! Form::open(['route' => 'logout','method' => 'POST']) !!}
                                        <button class="btn  btn-xs" style="padding-left:0;">
                                    
                                        Sign Out
                                        </button>
                                        {!! Form::close() !!}
                                    </div>
                                    
                                </div>
                            </a>
                            <div class="kt-space-between">
                               
                            </div>
                        </div>

                        <!--end: Navigation -->
                    </div>
                </div>
            @else
                <div class=" kt-header__topbar-item  ">
                    <a class="loading img-fade-hover topbar-search" style="display: inline-flex;align-items:center; padding-left: 15px;padding-right: 15px;" href="/login"  >
                   
                        <div class="kt-hidden-tablet-and-mobile ">
                           LOGIN
                        </div>
                    </a>
                </div>
                <div class=" kt-header__topbar-item  ">
                    <a class="loading img-fade-hover topbar-search" style="display: inline-flex;align-items:center; padding-left: 15px;padding-right: 15px;" href="/" data-toggle="modal" data-target="#signUpModal" >
                   
                        <div class="kt-hidden-tablet-and-mobile" style="white-space: nowrap;">
                           <b>SIGN UP</b>
                        </div>
                    </a>
                </div>
                
                 
        @endif
        </div>


        <!-- end:: Header Topbar -->
    </div>
</div>

<!-- end:: Header -->
