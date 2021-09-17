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
                            <a href="/my-adventures" class="kt-menu__link {{ isset($activePage) && $activePage == 'my-adventures' ?  'kt-menu__link--active' :  '' }}">
                               <!--  <div class="img-circle" style="display:inline-block;width:30px;height:30px;border-width:2px;padding:4px;border-color:#4D4D4D;background: #101010;margin-right:2px;"> -->
                                    <img class="" src="/img/triangles-black.svg" style="width:30px;height:30px;margin-top:4px;padding-left:2px;margin-right:5px;padding-bottom:5px;" alt="My adventures">
                              <!--    </div>  -->
                                <span style="padding-top: 10px; padding-bottom: 10px;font-size:0.9rem;" class="kt-menu__link-text  ">Adventures</span>
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
            
            @if(isset($user) && $user)
                <div class="kt-header__topbar-item  " id="last-messages" style=" padding-left:5px; padding-right:5px;" >
                    <div class=" kt-header__topbar-item  " >
                        <a class="loading img-fade-hover " style="display: inline-flex;align-items:center; padding-left: 10px;padding-right: 10px;font-size:1.5rem;color:#3C3C3C;width:max-content;" href="/messages"  >
                            <img src="{{ url('/img/chat.svg')}}" style="height:22px;"  class="{{ Request::segment(1) == 'messages' ? 'active' : '' }}" alt="">
                            
                        </a>
                    </div>
                </div>
                <div class="kt-header__topbar-item  " id="last-messages" style=" padding-left:5px; padding-right:5px;" >
                    <div class=" kt-header__topbar-item  " style="">
                        <a class="loading img-fade-hover " style="display: inline-flex;align-items:center; padding-left: 10px;padding-right: 10px;font-size:1.5rem;color:#3C3C3C;" href="/notifications"  >
                            <div style="position: relative; width:max-content;">
                               
                                <img src="{{ url('/img/bell.svg')}}" style="height:22px;" class="{{ Request::segment(1) == 'notifications' ? 'active' : '' }}" alt="">
                                @if($unreadNotifications  > 0)
                                    <div class="circle notification-mobile ">
                                        {{ $unreadNotifications }}
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
              
                    <div class="kt-header__topbar-item  " >
                  
                    <a href="/share" class="dots text-muted   " style="display: inline-flex;align-items:center;padding-left: 12px;padding-right: 12px;font-size:1.1rem;"  >
                        <div style="width:22px;">
                            <img src="{{ url('img/pinplus.svg')}}" style="height:22px;"  class="{{ Request::segment(1) == 'share' ? 'active' : '' }}"  alt="Avanturistic Homepage">
                        </div>
                        </a>
                        {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center text-center" style="">
                            <ul class="kt-nav" style="padding:0;">
                                
                                <li class="kt-nav__item">
                                    <a href="/create-timelapse" class="kt-nav__link">
                                         <img src="{{ url('/img/reel.svg') }}" style="width:20px;" alt="Avanturistic Highlights">
                           
                                        <span class="kt-nav__link-text"> Create timelapse </span>
                                    </a>
                                </li>
                                <li class="kt-nav__item">
                                    <a href="/share" class="kt-nav__link">
                                    <img src="{{ url('img/pinplus.svg')}}" style="width:20px;" alt="Avanturistic Homepage">
                                        <span class="kt-nav__link-text">Share adventure </span>
                                    </a>
                                </li>
                                
                            </ul>
                            
                        </div> --}}
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
                                <img class="img-circle"  alt="{{ $user->name }}" style="border-width:2px;border-color:#474747;" src="{{ $user->avatar }}" />
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
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-settings kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Admin
                                        </div>

                                    </div>
                                </a>
                                <a href="/blog" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="fa fa-cogs text-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Blog</b>
                                        </div>

                                    </div>
                                </a>
                                <a href="/admin/categories" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="fa fa-cogs text-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Categories</b>
                                        </div>

                                    </div>
                                </a>
                                <a href="/admin/posts" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="fa fa-cogs text-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Posts</b>
                                        </div>

                                    </div>
                                </a>
                                <a href="/admin/users" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
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
                                    <div class="kt-notification__item-icon" style="">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30px" height="30px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon" style="margin:0;margin-top:0.6em;">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.5"/>
                                                <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            Profile
                                        </div>

                                    </div>
                                </a>
                                <a href="/profile" class="kt-notification__item">
                                    <div class="kt-notification__item-icon" style="padding-left:5px;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect opacity="0.200000003" x="0" y="0" width="24" height="24"/>
                                                    <path d="M4.5,7 L9.5,7 C10.3284271,7 11,7.67157288 11,8.5 C11,9.32842712 10.3284271,10 9.5,10 L4.5,10 C3.67157288,10 3,9.32842712 3,8.5 C3,7.67157288 3.67157288,7 4.5,7 Z M13.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L13.5,18 C12.6715729,18 12,17.3284271 12,16.5 C12,15.6715729 12.6715729,15 13.5,15 Z" fill="#000000" opacity="0.3"/>
                                                    <path d="M17,11 C15.3431458,11 14,9.65685425 14,8 C14,6.34314575 15.3431458,5 17,5 C18.6568542,5 20,6.34314575 20,8 C20,9.65685425 18.6568542,11 17,11 Z M6,19 C4.34314575,19 3,17.6568542 3,16 C3,14.3431458 4.34314575,13 6,13 C7.65685425,13 9,14.3431458 9,16 C9,17.6568542 7.65685425,19 6,19 Z" fill="#000000"/>
                                                </g>
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
                                    <div class="kt-notification__item-icon" style="">
                                        <img src="/img/triangles-black.svg" alt="My Adventures" style="width:24px;">
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">
                                            <b>Adventures</b>
                                        </div>
                                        <div class="kt-notification__item-time">
                                            Manage your adventures
                                        </div>
                                    </div>
                                </a>
                               {{--  <a href="/my-timelapses" class="kt-notification__item">
                                    <div class="kt-notification__item-icon" style="padding-left:2px;">
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
                                <div class="kt-notification__item-icon" style="padding-left:8px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M14.0069431,7.00607258 C13.4546584,7.00607258 13.0069431,6.55855153 13.0069431,6.00650634 C13.0069431,5.45446114 13.4546584,5.00694009 14.0069431,5.00694009 L15.0069431,5.00694009 C17.2160821,5.00694009 19.0069431,6.7970243 19.0069431,9.00520507 L19.0069431,15.001735 C19.0069431,17.2099158 17.2160821,19 15.0069431,19 L3.00694311,19 C0.797804106,19 -0.993056895,17.2099158 -0.993056895,15.001735 L-0.993056895,8.99826498 C-0.993056895,6.7900842 0.797804106,5 3.00694311,5 L4.00694793,5 C4.55923268,5 5.00694793,5.44752105 5.00694793,5.99956624 C5.00694793,6.55161144 4.55923268,6.99913249 4.00694793,6.99913249 L3.00694311,6.99913249 C1.90237361,6.99913249 1.00694311,7.89417459 1.00694311,8.99826498 L1.00694311,15.001735 C1.00694311,16.1058254 1.90237361,17.0008675 3.00694311,17.0008675 L15.0069431,17.0008675 C16.1115126,17.0008675 17.0069431,16.1058254 17.0069431,15.001735 L17.0069431,9.00520507 C17.0069431,7.90111468 16.1115126,7.00607258 15.0069431,7.00607258 L14.0069431,7.00607258 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.006943, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-9.006943, -12.000000) "/>
                                            <rect fill="#000000" opacity="0.3" transform="translate(14.000000, 12.000000) rotate(-270.000000) translate(-14.000000, -12.000000) " x="13" y="6" width="2" height="12" rx="1"/>
                                            <path d="M21.7928932,9.79289322 C22.1834175,9.40236893 22.8165825,9.40236893 23.2071068,9.79289322 C23.5976311,10.1834175 23.5976311,10.8165825 23.2071068,11.2071068 L20.2071068,14.2071068 C19.8165825,14.5976311 19.1834175,14.5976311 18.7928932,14.2071068 L15.7928932,11.2071068 C15.4023689,10.8165825 15.4023689,10.1834175 15.7928932,9.79289322 C16.1834175,9.40236893 16.8165825,9.40236893 17.2071068,9.79289322 L19.5,12.0857864 L21.7928932,9.79289322 Z" fill="#000000" fill-rule="nonzero" transform="translate(19.500000, 12.000000) rotate(-90.000000) translate(-19.500000, -12.000000) "/>
                                        </g>
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
                   
                        <div class="kt-hidden-tablet-and-mobile font-light">
                           LOGIN
                        </div>
                    </a>
                </div>
                <div class=" kt-header__topbar-item  ">
                    <a class="loading img-fade-hover topbar-search" style="display: inline-flex;align-items:center; padding-left: 15px;padding-right: 15px;" href="/" data-toggle="modal" data-target="#signUpModal" >
                   
                        <div class="kt-hidden-tablet-and-mobile text-success" style="white-space: nowrap;">
                           SIGN UP
                        </div>
                    </a>
                </div>
                
                 
        @endif
        </div>


        <!-- end:: Header Topbar -->
    </div>
</div>

<!-- end:: Header -->
