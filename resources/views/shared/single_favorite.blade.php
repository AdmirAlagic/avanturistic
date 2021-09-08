<div class="kt-portlet">
    <div class="kt-portlet__body">
        <div class="row ">
            <div class="col-3">
                <a class="text-white" href="/{{ '@' .$obj->name_slug }}">
                    @if($obj->avatar && $obj->avatar != ' ' && $obj->avatar != '')
                        <span><img class="avatar"
                                   style="-webkit-border-radius: 4px;-moz-border-radius: 4px ;border-radius:  4px; width:45px;margin-top: 6px;margin-bottom: 5px;"
                                   src="{{ $obj->avatar }}" alt="{{ $obj->name  }}"></span>
                    @else
                        <div class="kt-header__topbar-icon text-green post-avatar" style="padding-top:13px;">
                            <b>{{ ucfirst($obj->name[0]) }}</b></div>
                    @endif
                </a>
            </div>
            <div class="col-6 text-center" style="padding-top:10px;">
                <a class="text-white" href="/{{ '@' .$obj->name_slug }}">
                    <span class="text-dark"><b>{{ $obj->name }}</b></span>

                </a>
            </div>
            <div class="col-3" style="padding-top:10px;">
                <a href="/message/{{ $obj->id }}"  class="btn btn-circle btn-icon btn-green">
                    <i class="fa fa-envelope text-white"></i>
                </a>
            </div>
        </div>
    </div>
</div>
