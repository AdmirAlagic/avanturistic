//map
$(document).ready(function(){
    var page = 1;
    var loading = false;
    function getMorePosts(){
        loading = true;
        $.ajax({
            url: '/getFavoritesPosts',
            method: 'GET',
            dataType:'html',
            data: {page: page},
            success:function(html){
                if(html == 'false'){
                    // $('#more-posts').append('<p>Nothing to show</p>');
                    loading = false;
                    return;
                }

                $('#more-posts').append(html);
                $(window).resize();
                $('[data-toggle="kt-tooltip"]').tooltip();
                loading = false;

            }
        })
    }
    getMorePosts();
    $(window).scroll(function () {

        if ($(window).scrollTop() + $(window).height() + 40 >= $('#more-posts').height()) {
            if(loading == false){
                page = page + 1;

                $('.more-posts-loader').show();
                getMorePosts(page);
            }

        }
    });

})
