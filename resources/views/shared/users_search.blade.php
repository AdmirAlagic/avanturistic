@if(count($users))
    <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll" >
        <div id="quick-search-list">
            @foreach($users as $obj)

                <a href="/{{ '@' .$obj->name_slug }}#" class="kt-notification__item kt-nav__link--active">
                    <div class="kt-notification__item-icon kt-pulse kt-pulse--light"  style="margin-right:2em;" >
                        @if($obj->avatar && $obj->avatar != ' ' && $obj->avatar != '')

                            <span ><img src="{{ $obj->avatar }}" style="width:22px;border-radius:4px;"></span>
                        @else
                            <span class="kt-header__topbar-icon text-green default-user-avatar"><b>{{ ucfirst($obj->name[0]) }}</b></span>
                        @endif

                    </div>
                    <div class="kt-notification__item-details">
                        <div class="kt-notification__item-title ">
                            <span>{{$obj->name}}</span>
                        </div>
                        <div class="kt-notification__item-time">
                            @if($obj->country_code && country($obj->country_code))
                                {!!  country($obj->country_code)->getEmoji() !!}
                            @endif
                        </div>
                    </div>
                </a>

            @endforeach
            <a href="/search?q={{$query}}" class="kt-notification__item kt-nav__link--active">
                <div class="kt-notification__item-icon kt-pulse kt-pulse--light"  style="margin-right:2em;" >
                    <i class="fa fa-search-plus text-success"></i>

                </div>
                <div class="kt-notification__item-details">
                    <div class="kt-notification__item-title ">
                        <span>See All Results</span>
                    </div>

                </div>
            </a>
        </div>
    </div>
@else
    <p>No results</p>
@endif