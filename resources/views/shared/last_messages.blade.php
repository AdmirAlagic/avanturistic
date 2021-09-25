<div class="kt-header__topbar-wrapper">
    <span class="kt-header__topbar-icon kt-pulse kt-pulse--success" style="position:relative;">
        <a href="/messages">
        <i class="message-notification-icon fa fa-envelope {{ count($user->unreadMessages) ? 'text-success' : '' }}"></i>
        </a>

   {{--      @if(count($user->unreadMessages))
            <span class="kt-pulse__ring" style="position: absolute;top:-3px;left:-3px;"></span>
        @endif --}}
    </span>

    <!--<span class="kt-badge kt-badge--light"></span>-->
</div>
  