<div class="flex justify-end">
    <a  href="#" data-post_id="{{ $post->id }}" id="likeBtn" class="btn post-toolbar-btn  flex flex-col items-center mr-10 ">
        <i style="width: 36px;height: 36px; -webkit-border-radius: 99999em;-moz-border-radius: 99999em;border-radius: 99999em; padding-top: 19px;padding-left: 6px;background: #474747;font-size: 1.5em !important; "  class="fa fa-heart {{ $alreadyLiked ? 'text-success' : 'text-white' }}"></i>
        <span style="margin-left: -3px;" class="text-muted" id="likesCount">{{ $post->likes }}</span>
    </a>
    <a  data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="I Was Here!" href="#" data-post_id="{{ $post->id }}" id="visitedBtn"  class="btn post-toolbar-btn flex flex-col items-center ">
        <i style="width: 36px;height: 36px; -webkit-border-radius: 99999em;-moz-border-radius: 99999em;border-radius: 99999em; padding-top: 19px;padding-left: 6px;background: #474747;" class="fa fa-shoe-prints {{ $alreadyVisited ? 'text-success' : 'text-white' }}"></i>
        <span style="margin-left: -3px;" class="text-muted" id="visitedsCount">{{ $post->visiteds }}
        </span>
    </a>
</div>
