@if(isset($post->options['badges']) && count($post->options['badges']))
    <div class="kt-portlet__head" style="width:100%;">
        <div class="kt-portlet__head-label" style="width:100%;margin-top:15px;">
        <div class="flex"  style="width:100%;overflow-x: auto;">
            @foreach($post->options['badges'] as $key => $val)

                @if(isset($badges[$key]) && isset($badges[$key]['icon']) && isset($badges[$key]['name']))
                    <div class=" col text-center">
                        <a href="/outdoor-adventures/{{ $key }}" style="margin-right: 10px;font-size:0.8em;">
                            <div class="badge-wrap" style="cursor:pointer;display: inline-block;margin-right: 10px;border:2px solid {{ $badges[$key]['color'] }}; -webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 36px; height: 36px;margin-left: auto; margin-right: auto;padding: 6px;">
                                <img  src="{{ $badges[$key]['icon_empty'] }}" style="width:45px;filter:invert(0.7);" alt="{{ $key }} adventure location ">
                            </div>

                            <br>
                            <div class="text-dark text-light mt-10" style="text-transform:; font-weight:normal;padding-top:5px;"><span class="text-success">&nbsp;</span>{{ $badges[$key]['name'] }}</div>
                        </a>
                    </div>
                @endif
            @endforeach
             
        </div>
        </div>
    </div>

@endif