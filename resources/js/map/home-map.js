//map
var isMobile = true; //initiate as false
var sortBy = 'latest_nearest';
var scrollTop, scrollLeft;

is_mobile = true;

var map;
var page = 2;
var center = {lat: 44.063545, lng: 17.936309}
var activeFilters = [];
var baseUrl = window.pageHostname;
var loading = false;
var loadedAll = false;

var markers;
var locationChanged = false;
var fullscreenEntered = false;
var interleaveOffset = 0.7;
var lastScrollY;
var scheduledAnimationFrame = false;
var addedMarkers;

var lastActiveFilter = null;
swiperOptions = {
    loop: false,
    speed: 963,

    grabCursor: true,
    watchSlidesProgress: true,
    mousewheelControl: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: true,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    keyboardControl: true,

    on: {
        progress: function() {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
                var slideProgress = swiper.slides[i].progress;
                var innerOffset = swiper.width * interleaveOffset;
                var innerTranslate = slideProgress * innerOffset;
                swiper.slides[i].querySelector(".slide-inner").style.transform =
                    "translate3d(" + innerTranslate + "px, 0, 0)";
            }
        },
        touchStart: function() {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = "";
            }
        },
        setTransition: function(speed) {
            var swiper = this;
            for (var i = 0; i < swiper.slides.length; i++) {
                swiper.slides[i].style.transition = speed + "ms";
                swiper.slides[i].querySelector(".slide-inner").style.transition =
                    speed + "ms";
            }
        }
    }
};
var DOMContentLoaded_event = document.createEvent("Event")
DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true)

function setMarkers(posts, badges, map) {

    if (markers !== undefined) {
        map.removeLayer(markers)
    }
    var badges =  badges;

    markers = L.markerClusterGroup({
        iconCreateFunction: function (cluster) {
            return L.divIcon({html: '<div class="markerGroup">' + cluster.getChildCount() + '</div>'});
        },
        spiderfyOnMaxZoom: true,
        chunkedLoading: true,
        maxClusterRadius: 30,
        polygonOptions: {
            fillColor: '#acc957',
            color: '#acc957',
            weight: 0.5,
            opacity: 1,
            fillOpacity: 0.5
        }
        ,
        spiderfyShapePositions: function (count, centerPt) {
            var distanceFromCenter = 35,
                markerDistance = 45,
                lineLength = markerDistance * (count - 1),
                lineStart = centerPt.y - lineLength / 2,
                res = [],
                i;

            res.length = count;

            for (i = count - 1; i >= 0; i--) {
                res[i] = new Point(centerPt.x + distanceFromCenter, lineStart + markerDistance * i);
            }

            return res;
        }
    });

    var markersArray = [];
    $.each(posts, function (index, val) {

        markerOptions = {};

        var iconUrl;
        var iconColor = '#FFFFFF';
        var options = JSON.parse(val.options);

        iconUrl = '/img/badges/empty/' + Object.keys(options.badges)[0] + '.svg';
        if(typeof badges[Object.keys(options.badges)[0]]['color'] !== "undefined")
        iconColor =  badges[Object.keys(options.badges)[0]]['color'];

        if(activeFilters.length > 0 ){
            for( var i = 0; i < activeFilters.length; i++){
                if ( options.badges.hasOwnProperty(activeFilters[i])) {
                    iconUrl = '/img/badges/empty/' + activeFilters[i] + '.svg';
                    iconColor =  badges[activeFilters[i]]['color'];
                    activeFilterIndex = i;
                    break;
                }
            }
        }
        var mIcon = L.divIcon({
            iconSize:null,
            html:' <div class="badge-wrap" style="-webkit-box-shadow: 0px 0px 3px 0px #000000;-moz-box-shadow: 0px 0px 3px 0px #000000;box-shadow: 0px 0px 3px 0px #000000;background: #474747;border:2px solid ' + iconColor + ';-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 32px; height: 32px;margin-left: auto; margin-right: auto;padding: 4px;"> <img  src="' + iconUrl+ ' " style="width:20px;"> </div>',


        });


        markerOptions = {icon: mIcon, url: baseUrl + '/adventure/' + val.id + '/' + val.slug, post_id: val.id};

        var center = L.latLng(val.lat, val.lng);
        marker = new L.marker(center, markerOptions);
        markers.addLayer(marker);

        markersArray.push(center);

        map.addLayer(markers);
        //markers.push(center);
        addedMarkers.addLayer(marker);
        marker.on("click", function (event) {
            var clickedMarker = event;

            // window.location.href = clickedMarker.target.options.url;
            openPost(clickedMarker.target.options.post_id)
            // do some stuff…
        });

        // map.setZoom(10);
    });
    markers.on('clusterclick', function (a) {
        a.layer.zoomToBounds({padding: [70, 70]});

    });
    if(markersArray.length == 1){
        map.fitBounds(markersArray, {padding: [65, 65]});
    }
    if(markersArray.length > 1){
        map.fitBounds(markersArray, {padding: [25, 25]});
    }

    // if (markersArray.length > 1) {
    //     map.fitBounds(markersArray, {padding: [60, 60]});
    // } else {
    //     map.fitBounds(markersArray, {padding: [60, 60]});
    //     map.setZoom(10);
    // }


}

function getMapPosts(radius, lat, lng) {
    var data = {filters: activeFilters};
    if (radius && lat && lng) {
        data = {radius: radius, lat: lat, lng: lng, filters: activeFilters};
    }
    $.ajax({
        url: '/getPosts',
        method: 'POST',
        dataType: 'json',
        data: data,
        success: function (response) {
            if (response.posts.length) {
                setMarkers(response.posts, response.badges, map);
            } else {
                if (markers !== undefined) {
                    map.removeLayer(markers)
                }
            }
        }
    })
}

function getLocation() {

    if (navigator.geolocation) {

        $('.refresh-loc-icon').hide();
        $('.loading-spinner-loc').show();

        navigator.geolocation.getCurrentPosition(
            // Success callback
            function (position) {

                var lat, lng;
                lat = position.coords.latitude;
                lng = position.coords.longitude;

                if (lat && lng) {
                    $.ajax({
                        url: '/setUserLocation',
                        method: 'POST',
                        dataType: 'json',
                        data: {lat: lat, lng: lng},
                        success: function (data) {
                            page = 1;

                            $('#more-posts').html('');

                            getMorePosts(lat, lng);
                        }
                    })
                }

            },

            // Optional error callback
            function (error) {
                var message;
                if (isMobile) {
                    message = 'To use precise location, <b>enable location services</b>, click "<b>Update Location</b>" and <b>turn off</b> location services to <b>save battery</b>.';
                } else {
                    message = 'To use precise location <b>enable location services</b> and click "<b>Update Location</b>".<br> After refreshing you can <b>turn off</b> location services ';
                }
                swal.fire({
                    title: 'Location services disabled',
                    html: message,
                    type: 'warning',

                    confirmButtonText: 'Got it.'
                });
                loading = false;
                $('.refresh-loc-icon').show();

                $('.loading-spinner').hide();
                $(window).resize();

            }
        );
    }

}

function getMorePosts(_lat, _lng) {
    loading = true;
    var morePostData = {radius: 53000, page: page, lat: _lat, lng: _lng, filters: activeFilters, sort: sortBy};

    // $('.loading-spinner-posts').show();
    $.ajax({
        url: '/getPostsByLocation',
        method: 'GET',
        dataType: 'html',
        data: morePostData,
        success: function (html) {
            page = page + 1;
            $('.refresh-loc-icon').show();
            $('.loading-spinner-loc').hide();
            if (html == 'false') {
                $('.loading-spinner-posts').hide();
                $('#scrollForMore').remove();
                loading = false;
                loadedAll = true;
                return;
            } else {

            }

            $('#more-posts').append(html);
            $('.loading-spinner-posts').hide();

            if($('#more-posts .my-post').length > 4 ||  $('#more-posts .my-post').length < 4)
                $('#scrollForMore').remove();

            $(window).resize();
            $('[data-toggle="kt-tooltip"]').tooltip();
            loading = false;
            scheduledAnimationFrame = false;


            //
            loadSwiper();

            DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true)
            window.document.dispatchEvent(DOMContentLoaded_event)

        }
    })
}
function disableScroll() {

    // Get the current page scroll position
    scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
        $('body').css('overflow-y', 'hidden');
    // if any scroll is attempted, set this to the previous value
    window.onscroll = function () {
        window.scrollTo(scrollLeft, scrollTop);
    };

}

function enableScroll() {

    $('body').css('overflow-y', 'auto');

    window.onscroll = function () {
    };
    window.scrollTo(scrollLeft, scrollTop);

}


function readAndUpdatePage(){

    if (lastScrollY + $(window).height() + 100 >= $('#more-posts').height()) {

        if (loading == false && loadedAll == false) {

            loading = true;
            $('.more-posts-loader').show();
            getMorePosts(page);
            scheduledAnimationFrame = true;
        }

    } else {
        scheduledAnimationFrame = false;
    }

}

function onScroll (evt) {

    // Store the scroll value for laterz.
    lastScrollY = window.scrollY;

    // Prevent multiple rAF callbacks.
    if (scheduledAnimationFrame)
        return;

    scheduledAnimationFrame = true;
    requestAnimationFrame(readAndUpdatePage);
}
var spinnerHtml = '<span class="kt-spinner kt-spinner--right kt-spinner--sm kt-spinner--primary"></span> ';

function openPost(post_id) {
    if (fullscreenEntered && map != null)
        map.toggleFullscreen();
    $('#overlay-loading').show();

    $.ajax({
        url: '/getPost',
        method: "POST",
        dataType: 'html',
        data: {'post_id': post_id},
        success: function (data) {
            //hide scroll to top button
            $('#kt_scrolltop').hide();
            $('#overlay-loading').hide();
            $('#home').css('opacity', 0);
            disableScroll();
            $('#overlay').html(data).show();

            $('#overlay').scrollTop(0);
            // appendMeta();
        },

    });
}
function  loadSwiper() {
    $('#more-posts .swiper-container.inactive').each(function(index){
        $this = $(this);
        $this.addClass('active');
        $this.removeClass('inactive');
        var swiper = new Swiper("#" + $this.attr('id'), swiperOptions);

    })
}
$(document).on('click', '.aquireLocation', function (e) {
    e.preventDefault();
    loadedAll = false;
    getLocation();
});


$(document).on('click', '.sortBy', function (e) {
    $this = $(this);
    sortBy = $(this).data('sort');
    $('.category-sort').html($(this).find('span').html());
    page = 1;
    loadedAll = false;
    $('.sortBy').removeClass('active');
    $this.addClass('active');
    $this.parent().parent().removeClass('show');

    $('#more-posts').html('<div class="text-center loading-spinner-posts">\n' +
        '                                <br>\n' +
        '                                <span class="kt-spinner kt-spinner--sm kt-spinner--primary"> </span>\n' +
        '                            </div>');
    page = 1;
    getMorePosts();
    getMapPosts();

});



$(document).on('click', '.openPost', function (e) {
    e.preventDefault();

    var post_id = $(this).data('post_id');
    openPost(post_id);
});
$(document).on('click', '.closePost', function (e) {

    e.preventDefault();
    var post_id = $(this).data('post_id');

    $('#overlay').fadeOut(300, function () {
        $(this).html('');
    });
    $('#home').css('opacity', 1);

    $('#home').fadeIn();
    enableScroll();
    //hide scroll to top button
    // $('#kt_scrolltop').show();


});


$(document).on('click', '.profile-badge', function (e) {
    e.preventDefault();
    $this = $(this);
    var key = $this.data('key');
    loadedAll = false;
    if (key == 'reset') {
        activeFilters = [];
        $('.profile-badge').removeClass('active');
        $('#reset-filters').hide();
        $('.tooltip-inner').hide();
        // $.each($('.profile-badge').not(':first-child'), function () {
        //     $(this).removeClass('active');
        //
        // });

    } else {
        if (!$this.hasClass('active')) {
            $this.addClass('active');
            $this.removeClass('inactive');

            activeFilters.push(key);

        } else {
            $this.removeClass('active');
            $('.tooltip-inner').hide();
            for( var i = 0; i < activeFilters.length; i++){ if ( activeFilters[i] === key) { activeFilters.splice(i, 1);  }}
            // activeFilters.pop(key);
        }
    }
    $('.profile-badge').not('.active').addClass('inactive');
    if($('.profile-badge').hasClass('active')){
        $('#reset-filters').show();
    } else{
        $('#reset-filters').hide();
        $('.inactive').removeClass('inactive');
    }

    page = 1;

    $('#more-posts').html('<div class="text-center loading-spinner-posts">\n' +
        '                                <br>\n' +
        '                                <span class="kt-spinner kt-spinner--sm kt-spinner--primary"> </span>\n' +
        '                            </div>');
    getMorePosts();
    getMapPosts();
});

window.addEventListener('scroll', onScroll, {passive: true});

// window.onload = function () {
//     if (typeof history.pushState === "function") {
//         history.pushState("backbutton", null, null);
//         window.onpopstate = function () {
//
//             // if ($('#overlay .closePost').is(":visible") && $('#spotlight').is(":hidden")) {
//             //     $('#overlay  .closePost').trigger('click');
//             //
//             // }
//             history.pushState('newbackbutton', null, null);
//
//
//         };
//     }
//     else {
//         var ignoreHashChange = true;
//         window.onhashchange = function () {
//             // $('#overlay  .closePost').trigger('click');
//             if (!ignoreHashChange) {
//                 ignoreHashChange = true;
//                 window.location.hash = Math.random();
//             }
//             else {
//                 ignoreHashChange = false;
//             }
//         };
//     }
// };

$(document).ready(function () {

    addedMarkers = L.layerGroup();

    $('#more-posts, #more-posts-activity').on('click', '.likeBtn', function (e) {

        e.preventDefault();
        var $this = $(this);

        var post_id = $(this).data('post_id');
        var icon = $(this).find('i');
        $.ajax({
            url: '/post/like',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
                if (data !== 'login') {
                    if (!icon.hasClass('text-success')) {
                        icon.removeClass('text-white');
                        icon.addClass('text-success');
                    } else {
                        icon.removeClass('text-success');
                        icon.addClass('text-white');
                    }

                    $this.find('.likesCount').html('&nbsp;' + data + '&nbsp;');
                    $this.attr('disable', true);
                } else {
                    swal.fire({
                        title: 'Only for members',
                        text: 'Log in to like adventures',
                        type: 'info',
                        showCancelButton:true,
                        confirmButtonText: 'OK'
                    }).then(function (result) {
                        if (result.dismiss != 'cancel')
                            window.location = 'https://avanturistic.com/login';
                    });
                }

            },

        });

    });

    $('#more-posts, #more-posts-activity').on('click', '.visitedBtn', function (e) {

        e.preventDefault();
        var $this = $(this);

        var post_id = $(this).data('post_id');
        $this.addClass('text-success');
        var icon = $(this).find('i');
        $.ajax({
            url: '/post/visited',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
                if (data !== 'login') {
                    if (!icon.hasClass('text-success')) {
                        icon.removeClass('text-white');
                        icon.addClass('text-success');
                    } else {
                        $this.tooltip('hide');
                        icon.removeClass('text-success');
                        icon.addClass('text-white');
                        icon.parent().parent().trigger('click');
                    }
                    $this.find('.visitedsCount').html('&nbsp;' + data + '&nbsp;');
                    $this.attr('disable', true);
                } else {
                    swal.fire({
                        title: 'Only for members',
                        text: 'Log in to set "I was here"',
                        type: 'info',
                        showCancelButton:true,
                        confirmButtonText: 'OK'
                    }).then(function (result) {
                        if (result.dismiss != 'cancel')
                            window.location = 'https://avanturistic.com/login';
                    });
                }

            }
        });

    });
    window.document.dispatchEvent(DOMContentLoaded_event);

    loadSwiper();










})
