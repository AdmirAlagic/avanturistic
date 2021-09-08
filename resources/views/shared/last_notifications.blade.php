<div class="kt-header__topbar-wrapper " data-toggle="dropdown" data-offset="0px,0px">
    <span class="kt-header__topbar-icon kt-pulse kt-pulse--success" style="position:relative">
        <i class="notification-icon fa fa-bell {{ $unreadNotifications > 0  ? 'text-green' : '' }}"></i>

        @if($unreadNotifications > 0 )
            <span class="kt-pulse__ring notification-pulse-ring" style="position: absolute;top: -3px;left: -3px;"></span>
        @endif
    </span>
</div>
<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl" style="z-index:999999;">
    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" style="background-color: #000000;padding:0px;padding-top:20px;padding-bottom:20px !important;">
        @if($unreadNotifications > 0 )
            <p class="text-center text-white notifications-count">
                <span class="text-success">
                {{ $unreadNotifications }}</span> new  @if($unreadNotifications > 1)notifications @else notification @endif
            
            </p>
            <div class="row" style="margin:0;">
                <div class="col-6">
                
                    <a href="#" class="nav-link text-center text-white btn btn-xs btn-default removeNotifications" ><b>Mark all as read</b></a>
                </div>
                <div class="col-6">
                    <a href="/notifications" class="nav-link text-center text-white btn btn-xs" ><b>All Notifications</b></a>
                </div>
            </div>
     
        @else
            <div style="font-align:text-center; ">
                <p class="kt-head__title text-white">
                    No new notifications.
                </p>  
            </div>
        @endif
       
    </div>

    <!--end: Head -->
    @if(count($notifications))
    <div class="kt-notification  kt-margin-t-10 kt-margin-b-10 " data-scroll="true" data-height="230" data-mobile-height="200" style="overflow:scroll !important;">
        @foreach($notifications as $notification)
            
            @include($notification->getView())
        @endforeach
    </div>
    @endif
        
</div>
