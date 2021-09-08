$(document).ready(function() {
    $('.more-posts').on('click', '.likeBtn', function (e) {

        e.preventDefault();
        var $this = $(this);

        var post_id = $(this).data('post_id');
        $this.addClass('text-success');
        $.ajax({
            url: '/post/like',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
                if (data !== 'login') {
                    $this.removeClass('text-muted');
                    $this.addClass('text-success');
                    $this.find('.likesCount').html('&nbsp;' + data + '&nbsp;');
                    $this.attr('disable', true);
                } else {
                    swal.fire({
                        title: 'Sign In',
                        text: 'Sign in to see full preview',
                        type: 'info',
                        confirmButtonText: 'OK'
                    }).then(function (result) {
                        if(result.dismiss != 'cancel')
                            window.location = 'https://avanturistic.com/login';
                    });
                }

            },

        });

    });
    $('.more-posts').on('click', '.visitedBtn', function (e) {

        e.preventDefault();
        var $this = $(this);

        var post_id = $(this).data('post_id');
        $this.addClass('text-success');
        $.ajax({
            url: '/post/visited',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
                if (data !== 'login') {
                    $this.removeClass('text-muted');
                    $this.addClass('text-success');
                    $this.find('.visitedsCount').html('&nbsp;' + data + '&nbsp;');
                    $this.attr('disable', true);
                } else {
                    swal.fire({
                        title: 'Sign In',
                        text: 'Sign in to see full preview',
                        type: 'info',
                        confirmButtonText: 'OK'
                    }).then(function (result) {
                        if(result.dismiss != 'cancel')
                            window.location = 'https://avanturistic.com/login';
                    });
                }

            }
        });

    });
    function openPost(post_id){
        $.ajax({
            url: '/getPost',
            method: "POST",
            dataType:'html',
            data: {'post_id': post_id},
            success: function (data) {
                //hide scroll to top button
                $('#kt_scrolltop').hide();
                $('#home').css('opacity', 0);
                disableScroll();
                $('#overlay').html(data).show();
                $('meta[property="og:description"]').remove();
                $('meta[property="og:image"]').remove();
                $('meta[property="og:title"]').remove();
                $('head').append( '<meta property="og:description" content="'  + $('#overlay').find('.metaDescription').html() + '">' );
                $('head').append( '<meta property="og:image" content="' +  $('#overlay').find('.modalPost').data('img') + ' ">' );
                $('head').append( '<meta property="og:title" content="' +  $('#overlay').find('.modalPost').data('title') + ' ">' );
            },

        });
    }
    $(document).on('click', '.openPost', function(e){
        e.preventDefault();
        lastScrollPosition = $(window).scrollTop();
        if(window.auth_check === 'false'){
            swal.fire({
                title: 'Sign In',
                text: 'Sign in to see full preview',
                type: 'info',
                confirmButtonText: 'OK'
            }).then(function (result) {
                if(result.dismiss != 'cancel')
                    window.location = 'https://avanturistic.com/login';
            });
            return;
        }
        var post_id = $(this).data('post_id');
        openPost(post_id);
    });
    $(document).on('click', '.closePost', function(e){
        e.preventDefault();
        var post_id = $(this).data('post_id');

        $('#overlay').fadeOut(300, function() { $(this).html(); });
        $('#home').css('opacity', 1);

        $('#home').fadeIn();
        enableScroll();
        //hide scroll to top button
        $('#kt_scrolltop').show();



    });

    window.onload = function () {
        if (typeof history.pushState === "function") {
            history.pushState("backbutton", null, null);
            window.onpopstate = function (){

                if ($('#overlay .closePost').is(":visible"))
                {
                    console.log('triger click')

                    $('#overlay').fadeOut(300, function() { $(this).html(); });
                    $('#home').css('opacity', 1);
                    $('#home').fadeIn(300, function() { $('body').css('overflow-y', 'auto');
                        window.onscroll = function() {

                        };
                        $(window).scrollTop(lastScrollPosition);});

                }

                history.pushState('newbackbutton', null, null);
            };
        }
        else {
            var ignoreHashChange = true;
            window.onhashchange = function () {
                // $('#overlay  .closePost').trigger('click');
                console.log('triger click 2')
                if (!ignoreHashChange) {
                    ignoreHashChange = true;
                    window.location.hash = Math.random();
                }
                else {
                    ignoreHashChange = false;
                }
            };
        }
    };

    function disableScroll() {

        // Get the current page scroll position
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
            $('body').css('overflow-y', 'hidden');
        // if any scroll is attempted, set this to the previous value
        window.onscroll = function() {
            window.scrollTo(scrollLeft, scrollTop);
        };

    }

    function enableScroll() {

        $('body').css('overflow-y', 'auto');

        window.onscroll = function() {};
        window.scrollTo(scrollLeft, scrollTop);

    }

});