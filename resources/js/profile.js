//map
$(document).ready(function(){
    
    function resizeWindow(){
        setTimeout(300, function(){
            $(window).trigger('resize');
        })
        var resizeEvent = window.document.createEvent('UIEvents');
        resizeEvent.initUIEvent('resize', true, false, window, 0);
        window.dispatchEvent(resizeEvent);
    }
    
    function getFavoritesView(){
        $.ajax({
            url: '/getFavoritesView',
            method: 'POST',
            dataType:'html',

            success:function(data){
                $('.favorites-view').html(data);
                var glide = new Glide('.glide', {
                    type: 'carousel',
                    perView: 1,
                    focusAt: 'center',
                    breakpoints: {
                        800: {
                            perView: 1
                        },
                        480: {
                            perView: 1
                        }
                    }
                })

                glide.mount();

            }
        })
    }
    $(document).on('click', '#nav-item-adventures', function (e) { 
        resizeWindow();
     });

    $(document).on('click', '.addToFavorites', function (e) {
        e.preventDefault();
        $this = $(this);
        var user_id = $(this).data('user_id');
        $.ajax({
            url: '/addToFavorites',
            method: 'POST',
            dataType:'json',
            data: { user_id: user_id},
            success:function(data){
                if(data == 'add'){
                    $this.addClass('text-pink');
                } else {
                    $this.removeClass('text-pink');
                }
                getFavoritesView();

            }
        })
    })

    var $grid = $('.profile-masonry-grid').masonry({
        itemSelector: '.grid-item',
        percentPosition: true,
        columnWidth: '.grid-sizer'
    });
// layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry();
    });

// layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });
    var page = 1;
    var pageActivityUser = 0;
    var pageActivityBlog = 0;
    var pageActivityOthers = 0;
    var pageActivityLikes = 0;
    var loading = false;
    var user_id = $('#hidden-user_id').val();
    function getMorePosts(){
        loading = true;
        $.ajax({
            url: '/getProfilePosts',
            method: 'POST',
            dataType:'json',
            data: { page: page, user_id: user_id},
            success:function(data){
                var $items = getItems(data.posts);
                $grid.masonryImagesReveal( $items );

                loading = false;

            }
        })
    }

    // function getBlogPosts(){
    //     blogLoading = true;
    //     pageActivityBlog = pageActivityBlog + 1;
    //     $.ajax({
    //         url: '/getProfileBlog',
    //         method: 'POST',
    //         dataType:'html',
    //         data: { page: pageActivityBlog, user_id: user_id},
    //         success:function(data){
    //             if(data !== 'false'){
    //                 $('#more-blog-posts').append(data);
    //                 $('.getBlogPosts').prop('disabled', false);
    //
    //             } else {
    //                 $('.getBlogPosts').hide();
    //                 if(pageActivityBlog == 1){
    //                     $('#more-blog-posts').append('<p class="text-center"><small>No experiences yet.</small></p>');
    //                 }
    //             }
    //             blogLoading = false;
    //
    //         }
    //     })
    // }
    function getActivity(type, btn){
        activityLoading = true;
        var _page;
        if(type == 'user'){
            pageActivityUser = pageActivityUser + 1;
            _page = pageActivityUser;
        }
        if(type == 'others'){
            pageActivityOthers = pageActivityOthers + 1;
            _page = pageActivityOthers;
        }
        if(type == 'likes'){
            pageActivityLikes = pageActivityLikes + 1;
            _page = pageActivityLikes;
        }
        $.ajax({
            url: '/getProfileActivity',
            method: 'POST',
            dataType:'html',
            data: { page: _page, user_id: user_id , 'type' : type},
            success:function(data){
                if(data !== 'false'){
                    $('#more-activity-'+type).append(data);
                    $('.getMoreActivity[data-type="' + type + '"]').prop('disabled', false);

                } else {
                    $('.getMoreActivity[data-type="' + type + '"]').hide();
                    if(_page == 1){
                        $('#more-activity-'+type).append('<p class="text-center"><small>No activity.</small></p>');
                     }
                }
                activityLoading = false;
            }
        })
    }
    getActivity('user');
    getActivity('others');
    getActivity('likes');
    // // getBlogPosts();
    // $(document).on('click', '.getBlogPosts', function (e) {
    //     e.preventDefault();
    //     $this = $(this);
    //
    //     var type = $(this).data('type');
    //     if(!blogLoading){
    //
    //         getBlogPosts();
    //         $this.prop('disabled', true);
    //     }
    //
    // })
    $(document).on('click', '.getMoreActivity', function (e) {
        e.preventDefault();
        $this = $(this);

        var type = $(this).data('type');
        if(!activityLoading){

            getActivity(type, $this);
            $this.prop('disabled', true);
        }

    })
    $(window).scroll(function () {

        if ($(window).scrollTop() + $(window).height()   >= $('.profile-masonry-grid').height()) {
            if(loading == false){
                page = page + 1;

                $('.profile-posts-loader').show();
                getMorePosts(page);
            }

        }
    });
    getMorePosts(page);
})


$.fn.masonryImagesReveal = function( $items ) {
    var msnry = this.data('masonry');
    var itemSelector = msnry.options.itemSelector;
    // hide by default
    $items.hide();
    // append to container
    this.append( $items );
    $items.imagesLoaded().progress( function( imgLoad, image ) {
        // get item
        // image is imagesLoaded class, not <img>, <img> is image.img
        var $item = $( image.img ).parents( itemSelector );
        // un-hide item
        $item.show();
        // masonry does its thing
        msnry.appended( $item );
    });

    return this;
};

function getItem(id,slug, src, video) {
    if(video && video != '' && video != ' '){
        var item = '<div class="grid-item">'+
        '<a class="img-fade-hover" href="/adventure/' + id + '/' + slug + '?s=u"><img style="border:1px solid #ffffff;" src="' + src + '" /><span style="position:absolute;left:10px;top:10px;color:#FFFFFF;"><i class="fa fa-play" style=";font-size:1.3rem;"></i></span></a></div>';
    } else {
        var item = '<div class="grid-item">'+
        '<a class="img-fade-hover" href="/adventure/' + id + '/' + slug + '?s=u"><img style="border:1px solid #ffffff;" src="' + src + '" /></a></div>';
    }
   
    return item;
}

function getItems(posts) {
    var items = '';
    $.each(posts, function (key,val) {
        val.image = JSON.parse(val.image);
        if(val.image){
            if(val.image[0].thumb_path){

                items += getItem(val.id,val.slug, val.image[0].thumb_path, val.video);
            }

        }

    })

    return $( items );
}