<div class="col-sm-12 post-toolbar"  >
    <div class="row" >
        <div class="col-6">
            @include('shared.post.post_share')
        </div>
        <div class="col-6">
            <div class=" text-right" style="margin-top:4px;">
                @if($post->user)
                    
                        <a class="text-dark text-right" href="/{{ '@' .$post->user->name_slug }}" >
                       
                            @if($post->user->avatar && $post->user->avatar != ' ' && $post->user->avatar != '')
                                <img class="img-circle img-fade-hover" src="{{ url($post->user->avatar) }}" style="width:37px;height:37px;margin-top:-3px;border:1px solid #474747;box-shadow:none;">
                            @else
                            <div style="display:inline-flex;margin:0;" class=" kt-header__topbar-icon  text-white post-avatar"><b>{{ ucfirst($post->user->name[0]) }}</b></div>
                            @endif
                           
                            <div class="text-right" style="font-size: 0.8em;margin-top:5px;">{{ $post->user->name }}&nbsp;</div>
                        </a>
                    
                @endif
            </div>
        </div>
    </div>
    <div class="row" style="padding-top:10px;border-top:1px solid #eeeeee;">
        <div class="col-4">
            <div class="text-muted" style="margin:5px;">
                <b>{{ $post->views > 1000  ? intval($post->views / 1000). 'K+' : $post->views }}</b>
               
                    @if($post->views % 10 == 1)
                        view
                    @else
                        views
                    @endif
            </div>
        </div>
        <div class="col-8 text-right">
            <a href="#" class="dropdown-toggle dots pull-right "data-toggle="dropdown">
                <div class="text-muted  img-fade-hover" >
                
                 <img src="{{ url('img/share.svg') }}" width="30" height="30" style="width:30px;height:30px;" alt="">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-center text-center" style="margin:0;padding:0">
                <ul class="kt-nav" style="padding-bottom:0;">
                    <li class="kt-nav__item">
                        <div class="share-buttons" style="padding-left:10px;padding-right:10px;margin-bottom:10px;">
                            <span class="text-gray">Share</span> <br>
                            <!-- Sharingbutton Facebook -->
                            <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=https://avanturistic.com/adventure/{{ $post->id}}" target="_blank" rel="noopener" aria-label="">
                                <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.5H14.5V5.6c0-.9.6-1.1 1-1.1h3V.54L14.17.53C10.24.54 9.5 3.48 9.5 5.37V7.5h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                                    </div>
                                </div>
                            </a>

                            <!-- Sharingbutton Twitter -->
                            <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text={{ $post->description }}&amp;url=https://avanturistic.com/adventure/{{ $post->id}}" target="_blank" rel="noopener" aria-label="">
                                <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.4 4.83c-.8.37-1.5.38-2.22.02.94-.56.98-.96 1.32-2.02-.88.52-1.85.9-2.9 1.1-.8-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.04.7.12 1.04-3.78-.2-7.12-2-9.37-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.73-.03-1.43-.23-2.05-.57v.06c0 2.2 1.57 4.03 3.65 4.44-.67.18-1.37.2-2.05.08.57 1.8 2.25 3.12 4.24 3.16-1.95 1.52-4.36 2.16-6.74 1.88 2 1.3 4.4 2.04 6.97 2.04 8.36 0 12.93-6.92 12.93-12.93l-.02-.6c.9-.63 1.96-1.22 2.57-2.14z"/></svg>
                                    </div>
                                </div>
                            </a>


                            <!-- Sharingbutton WhatsApp -->
                            <a class="resp-sharing-button__link" href="whatsapp://send?text=https://avanturistic.com/adventure/{{ $post->id}}" target="_blank" rel="noopener" aria-label="">
                                <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                                    </div>
                                </div>
                            </a>
                            <a class="resp-sharing-button__link" href="viber://forward?text=https://avanturistic.com/adventure/{{ $post->id}}"  target="_blank" rel="noopener">
                                <div class="resp-sharing-button resp-sharing-button--viber resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--normal">
                                        <img src="/img/viber.svg" style="width:27px;margin-top:-2px;margin-left: 1px;" alt="Share on Viber">
                                    </div>
                                </div>

                            </a>
                        </div>
                    </li>             
                    @if($user && $post->user_id == $user->id)

                        <li class="kt-nav__item" style="border-top:1px solid #eee;">
                            <a href="/adventure/{{ $post->id }}/edit" class="kt-nav__link"  style="padding:15px;">
                                <i class="fa fa-cogs text-gray"></i> 
                                <span class="kt-nav__link-text">Edit Adventure</span>
                            </a>
                        </li>
                        
                    @endif
                                
                    
                </ul>
                    
            </div>
        </div>
    </div>
   
</div>