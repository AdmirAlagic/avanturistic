
<span  style="font-size:16px;">
        
    <a  href="#" data-post_id="{{ $post->id }}" id="likeBtn" class="btn post-toolbar-btn  ">
        <i style="width: 36px;height: 36px; -webkit-border-radius: 99999em;-moz-border-radius: 99999em;border-radius: 99999em; padding-top: 19px;padding-left: 6px;background: #474747; "  class="fa fa-heart {{ $alreadyLiked ? 'text-success' : 'text-white' }}"></i><br>
        &nbsp;<span style="margin-left: -3px;" class="text-muted" id="likesCount">{{ $post->likes }}</span>
    </a>
    <a  data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="I Was Here!" href="#" data-post_id="{{ $post->id }}" id="visitedBtn"  class="btn post-toolbar-btn  ">
        <i style="width: 36px;height: 36px; -webkit-border-radius: 99999em;-moz-border-radius: 99999em;border-radius: 99999em; padding-top: 19px;padding-left: 6px;background: #474747;" class="fa fa-shoe-prints {{ $alreadyVisited ? 'text-success' : 'text-white' }}"></i><br>
        &nbsp;<span style="margin-left: -3px;" class="text-muted" id="visitedsCount">{{ $post->visiteds }}
        </span>
    </a>
    @if($post->is_recommended)
                                        
        <span style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;">
                <img class="lazy" src="/img/placeholder.jpg" data-src="{{ url('/img/star.svg') }}" alt="Starred" data-srcset="{{ url('/img/star.svg') }}" width="45" style="width:40px;margin-top:-2px;">
            <h5 class="k-font text-gray text-center" style="white-space:wrap;">Avanturistic Pick</h4>
        </span>
        @else
            <div style="min-height:10px;">

            </div>
    @endif  
</span>

