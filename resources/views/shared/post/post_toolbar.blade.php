<div class="col-sm-12 post-toolbar"  >
    <div class="row  mb-10" >
       
        <div class="col-8">
            <div class="" style="margin-top:4px;">
                @if($post->user)
                    
                        <a class="text-dark text-right flex items-center" href="/{{ '@' .$post->user->name_slug }}" >
                       
                            @if($post->user->avatar && $post->user->avatar != ' ' && $post->user->avatar != '')
                                <img class="img-circle img-fade-hover" src="{{ url($post->user->avatar) }}" style="width:37px;height:37px;border:1px solid #474747;box-shadow:none;">
                            @else
                            <div style="display:inline-flex;margin:0;" class=" kt-header__topbar-icon  text-white post-avatar"><b>{{ ucfirst($post->user->name[0]) }}</b></div>
                            @endif
                           
                            <div class="text-right" style="font-size: 0.8em;margin-left:10px;">{{ $post->user->name }}</div>
                        </a>
                    
                @endif
            </div>
        </div>
        <div class="col-4 text-right">
            @include('shared.post.post_share')
        </div>
    </div>
    <div class="row items-center" style="padding-top:10px;border-top:1px solid #eeeeee;">
        <div class="col-6">
            <div class="text-muted" style="margin:5px;">
                <b>{{ $post->views > 1000  ? intval($post->views / 1000). 'K+' : $post->views }}</b>
               
                    @if($post->views % 10 == 1)
                        view
                    @else
                        views
                    @endif
                   
            </div>
            
             
            
        </div>
       
        <div class="col-6 text-right">
            
            <a href="#" class=" dots pull-right "  data-toggle="modal" data-target="#shareModal">
                <div class="text-muted  img-fade-hover" >
                
                 <img src="{{ url('img/share.svg') }}" width="30" height="30" style="width:30px;height:30px;" alt="">
                </div>
            </a>
            
                    
                    <!-- Modal -->
                    <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title text-center" id="exampleModalLabel">Share</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body" style="padding:2em;">
                                <p class="text-center">Copy URL</p>
                                <input type="text" class="form-control mb-10" value="{{ url('adventure/'.$post->id . '/' .$post->slug) }}">
                                 
                                <div class="share-buttons text-center mt-20" style="padding-left:10px;padding-right:10px;margin-bottom:10px;">
                                    <p class="k-font">Share the adventure</p>
                                    <!-- Sharingbutton Facebook -->
                                    <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https://avanturistic.com/adventure/{{ $post->id}}" target="_blank" rel="noopener" aria-label="">
                                       <img src="{{ url('/img/social/fb.svg') }}" style="width:30px;" alt="">
                                    </a>
        
                                    <!-- Sharingbutton Twitter -->
                                    <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{ $post->description }}&amp;url=https://avanturistic.com/adventure/{{ $post->id}}" target="_blank" rel="noopener" aria-label="">
                                        <img src="{{ url('/img/social/twitter.svg') }}" style="width:30px;" alt="">
                                    </a>
        
        
                                    <!-- Sharingbutton WhatsApp -->
                                    <a class="resp-sharing-button__link" href="whatsapp://send?text=https://avanturistic.com/adventure/{{ $post->id}}" target="_blank" rel="noopener" aria-label="">
                                        <img src="{{ url('/img/social/whatsapp.svg') }}" style="width:30px;" alt="">
                                    </a>
                                    <a class="resp-sharing-button__link" href="viber://forward?text=https://avanturistic.com/adventure/{{ $post->id}}"  target="_blank" rel="noopener">
                                        <img src="{{ url('/img/social/viber.svg') }}" style="width:30px;" alt="">
        
                                    </a>
                                </div>
                            </div>
                           {{--  <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           
                            </div> --}}
                        </div>
                        </div>
                    </div>
          
        </div>
    </div>
   
</div>