<!-- begin:: Header -->
<div id="kt_header" class="kt-header kt-header--fixed">
    <div class="kt-container ">

        <!-- begin:: Brand -->
        <div class="kt-header__brand   kt-grid__item" id="kt_header_brand" style="padding:10px;">
          
            <a href="/" class="font-weight-bold"><img class="header-logo-img" src="{{ url('/img/logo.svg') }}" style="width:30px;position: absolute;left:0;top: 8px; " alt=""/> <span>Avanturistic</span></a>
        </div>

        <!-- end:: Brand -->

        <!-- begin: Header Menu -->
        <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
        <div class="kt-header-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_header_menu_wrapper">
            <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                @if(isset($user) && $user)
                    <div class="kt-visible-tablet-and-mobile" >
                        <!--begin: Head -->
                        <a href="/{{ '@' .$user->name_slug}}">
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="height:80px;">
                                <div class="kt-user-card__avatar">
                                    @if($user->avatar && $user->avatar != '' && $user->avatar != ' ')
                                        <img alt="Avatar" src="{{ $user->avatar }}" />
                                    @else
                                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ ucfirst($user->name[0]) }}</span>
                                    @endif
                                </div>
                                <div class="kt-user-card__name">
                                    {{ $user->name }}
                                </div>
                            </div>
                        </a>
                    </div>
            @endif
            <!--end: Head -->
                <ul class="kt-menu__nav " style="padding-top:0 !important;padding-bottom: 0;">

                    <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                        <a href="/my-experiences" class="kt-menu__link {{ isset($activePage) && $activePage == 'home' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                            <span class="kt-menu__link-text  "><i class="fa fa-list"></i>&nbsp;&nbsp; Blog</span>
                        </a>
                    </li>
                    @if($user->group == 'admin')
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="/admin/posts" class="kt-menu__link {{ isset($activePage) && $activePage == 'posts' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                                <span class="kt-menu__link-text  "><i class="fa fa-list"></i>&nbsp;&nbsp; Posts</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="/admin/notifications" class="kt-menu__link {{ isset($activePage) && $activePage == 'posts' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                                <span class="kt-menu__link-text  "><i class="fa fa-list"></i>&nbsp;&nbsp; Notifications</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="/admin/categories" class="kt-menu__link {{ isset($activePage) && $activePage == 'categories' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                                <span class="kt-menu__link-text  "><i class="fa fa-list"></i>&nbsp;&nbsp; Categories</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="/admin/newsletter" class="kt-menu__link {{ isset($activePage) && $activePage == 'categories' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                                <span class="kt-menu__link-text  "><i class="fa fa-list"></i>&nbsp;&nbsp; Newletter</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="/admin/quotes" class="kt-menu__link {{ isset($activePage) && $activePage == 'quotes' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                                <span class="kt-menu__link-text  "><i class="fa fa-list"></i>&nbsp;&nbsp; Quotes</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="/admin/comments" class="kt-menu__link {{ isset($activePage) && $activePage == 'comments' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                                <span class="kt-menu__link-text  "><i class="fa fa-list"></i>&nbsp;&nbsp; Guest Comments (@if($unaprovedComments > 0) <span class="text-success"> {{ $unaprovedComments }}</span> @else 0 @endif)</span>
                            </a>
                        </li>
                        <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel " data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                            <a href="/admin/users" class="kt-menu__link {{ isset($activePage) && $activePage == 'users' ?  'kt-menu__link--active btn-success' :  'btn-default' }}">
                                <span class="kt-menu__link-text  "><i class="fa fa-users "></i>&nbsp;&nbsp; Users</span>
                            </a>
                        </li>
                    @endif

                </ul>

            </div>
        </div>

        <!-- end: Header Menu -->

        <!-- begin:: Header Topbar -->



        <div class="kt-header__topbar kt-grid__item">


            @if(!isset($user) || !$user)

                <div class="kt-header__topbar-item">
                    <div class="kt-header__topbar-wrapper">
                        <a href="/login" class="kt-header__topbar-icon">
                        <span class="" style="padding: 10px;">
                            <i class="fa fa-user"></i>
                        </span>
                        </a>
                    </div>

                </div>

                <!--end: Login -->
            @else
                <div class="kt-header__topbar-item kt-header__topbar-item--user">

                    <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                     
                        <span class="kt-header__topbar-username" style="white-space: nowrap;"></span>

                        @if($user->avatar && $user->avatar != '' && $user->avatar != ' ')
                            <span class="kt-header__topbar-icon"><img src="{{ url($user->avatar) }}" /></span>
                        @else
                            <span class="kt-header__topbar-icon"><b class=" text-green">{{ ucfirst($user->name[0]) }}</b></span>
                        @endif

                    </div>
                    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-sm" >

                        <!--begin: Head -->
                        <a href="/{{ '@' .$user->name_slug}}">
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" >
                            <span style="background-color: #474747;padding: 50px;" class="text-center">
                                <div class="kt-user-card__avatar">
                                    @if($user->avatar && $user->avatar != '' && $user->avatar != ' ')
                                        <img alt="Avatar" src="{{ url($user->avatar) }}" />
                                    @else
                                        <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success">{{ ucfirst($user->name[0]) }}</span>
                                    @endif
                                </div>
                                <div class="kt-user-card__name" style="">
                                    <b>{{ $user->name }}</b>
                                </div>
                            </span>

                            </div>
                        </a>
                        <!--end: Head -->

                        <!--begin: Navigation -->
                        <div class="kt-notification">
                            @if($user->group == 'admin')
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

                            @endif
                            <div class="">
                                {!! Form::open(['route' => 'logout','method' => 'POST']) !!}
                                {!! Form::submit('Sign Out', ['class' => 'btn btn-sm btn-bold btn-danger']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <!--end: Navigation -->
                    </div>
                </div>
            @endif
        <!--end: User bar -->
        </div>


        <!-- end:: Header Topbar -->
    </div>
</div>

<!-- end:: Header -->
