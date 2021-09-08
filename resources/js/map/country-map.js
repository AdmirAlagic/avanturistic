var sortBy = 'date';
var scrollTop, scrollLeft;


var isMobile = true; //initiate as false

var map;
var page = 1;
var center = {lat: 44.063545, lng: 17.936309}
var activeFilters = null;
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
 
var $grid;

var lastActiveFilter = null;
var layoutStyle = 'details';
swiperOptions = {
    loop: true,
    speed: 500,
    effect: 'fade',
    preloadImages:false,
    
    lazy: {   loadOnTransitionStart:true,
        loadPrevNextAmount:2,
        loadPrevNext: true},
    grabCursor: false,
    
    mousewheelControl: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: true,
    },
    pagination: {
        el: '.swiper-pagination',
        
    },
    keyboardControl: true,
   
};
var _country;
var DOMContentLoaded_event = document.createEvent("Event")
DOMContentLoaded_event.initEvent("DOMContentLoaded", true, true)

var swiperInitialized = false;

function getMorePosts(_lat, _lng) {
    if(!activeFilters){
        activeFilters = [];
        $('.profile-badge').each(function (index, el){
            if($(this).hasClass('active')){
                swiper.slideTo(index);
                 
                activeFilters.push($(this).data('key'));
            }
          })
    }
    loading = true;
    
    var morePostData = {page: page, lat: _lat, lng: _lng, country: _country, sort: sortBy, filters: activeFilters};

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
                $('#scrollForMore').hide();
                loading = false;
                loadedAll = true;
                return;
            }  loading = false;

            $('#more-posts').append(html);
            $('.loading-spinner-posts').hide();

            if($('#more-posts .my-post').length > 4 ||  $('#more-posts .my-post').length < 4)
                $('#scrollForMore').hide();

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
function getItems(posts) {
    var items = '';
    $.each(posts, function (key,val) {
        val.image = JSON.parse(val.image);
        if(val.image){
            if(val.image[0].thumb_path){

                items += getItem(val.id,val.slug, val.image[0].thumb_path, val.distance, val.video);
            }

        }

    })

    return $( items );
}
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

var videoHtml = '<span style="position:absolute;left:10px;top:10px;color:#FFFFFF;"><i class="fa fa-play" style=";font-size:1.3rem;"></i></span>'
function getItem(id,slug, src, distance,video) {
    videoIcon = '';
    if(video && video != ' ' && video != ''){
        videoIcon = videoHtml;
    }
    var item = '<div class="adventure-grid-item" style="position: relative;">'+
    '<a class="loading" href="/adventure/' + id + '/' + slug + '?s=c"><img style="border:1px solid #ffffff;" src="' + src + '" /><div  style="padding:3px;font-size:0.9rem;background: rgba(0,0,0,0.4);color:#FFFFFF;position:absolute;bottom: 1px;left:1px;right:1px;"> <i  class="fa fa-location-arrow text-white"></i><br>' + parseFloat(distance).toFixed(2) +' km</div>'+ videoIcon +'</a></div>';
    return item;
}

function  loadSwiper() {
    $('#more-posts .swiper-container.inactive').each(function(index){
        $this = $(this);
        $this.addClass('active');
        $this.removeClass('inactive');
        var swiper = new Swiper("#" + $this.attr('id'), swiperOptions);

    })
}

$(document).ready(function () {
    _country = $('#countryCode').val();
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

                                resetLayoutStyle(layoutStyle);
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
                    $('.loading-spinner-loc').hide();
                    $(window).resize();

                }
            );
        }

    }

    addedMarkers = L.layerGroup();

    $('#more-posts, #more-posts-activity').on('click', '.likeBtn', function (e) {

        e.preventDefault();
        var $this = $(this);

        var post_id = $(this).data('post_id');
        var icon = $(this).find('i');
        if (!icon.hasClass('text-success')) {
            icon.removeClass('text-white');
            icon.addClass('text-success');
        } else {
            icon.removeClass('text-success');
            icon.addClass('text-white');
        }
        $.ajax({
            url: '/post/like',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
                if (data !== 'login') {
                    

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
        if (!icon.hasClass('text-success')) {
            icon.removeClass('text-white');
            icon.addClass('text-success');
        } else {
            $this.tooltip('hide');
            icon.removeClass('text-success');
            icon.addClass('text-white');
            icon.parent().parent().trigger('click');
        }
        $.ajax({
            url: '/post/visited',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
                if (data !== 'login') {
                   
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

    $(document).on('click', '.aquireLocation', function (e) {
        e.preventDefault();
        loadedAll = false;
        getLocation();

    });
    $(document).on('click', '.show-filters', function (e) {
        e.preventDefault();
        $this = $(this);
        if (!$this.hasClass('active')) {
            $this.find('img').attr('src', '/img/filter-active.svg');
            $this.addClass('active');
            $this.removeClass('inactive');
        } else {
            $this.removeClass('active');
            $this.addClass('inactive');
            $this.find('img').attr('src', '/img/filter.svg');
           
        }
        $('.swiper-categories-container').slideToggle(300, function(){
            if(!swiperInitialized){
                initCategoriesSwiper();
            }
        });
       

    });
    $(document).on('click', '.profile-badge', function (e) {
        e.preventDefault();
        $this = $(this);
        var key = $this.data('key');
        loadedAll = false;
        if (key == 'reset') {
            activeFilters = [];
            $('.profile-badge').removeClass('active');
            $('.profile-badge').addClass('inactive');
            $('#reset-filters').fadeOut();
            
            // $.each($('.profile-badge').not(':first-child'), function () {
            //     $(this).removeClass('active');
            //
            // });
    
        } else {
            if (!$this.hasClass('active')) {
                $('.profile-badge').removeClass('active');
                $('.profile-badge').addClass('inactive');
                $this.addClass('active');
                $this.removeClass('inactive');
                activeFilters = [];
                activeFilters.push(key);
    
            } else {
                activeFilters = [];
                $('.profile-badge').removeClass('active');
                $('.profile-badge').addClass('inactive');
                /* $('.tooltip-inner').hide(); */
              /*   for( var i = 0; i < activeFilters.length; i++){ if ( activeFilters[i] === key) { activeFilters.splice(i, 1);  }} */
                // activeFilters.pop(key);
            }
        }
        $('.profile-badge').not('.active').addClass('inactive');
        if($('.profile-badge').hasClass('active')){
            $('#reset-filters').show();
        } else{
            $('#reset-filters').hide();
            $('.inactive').removeClass('inactive');
            $('.profile-badge').removeClass('active');
            $('.profile-badge').addClass('inactive');
        }
    
        page = 1;
    
        $('#more-posts').html('<div class="text-center loading-spinner-posts">\n' +
            '                                <br>\n' +
            '                                <span class="kt-spinner kt-spinner--sm kt-spinner--primary"> </span>\n' +
            '                            </div>');
        page = 1;
        if($grid){
            $grid.masonry('remove', $grid.masonry('getItemElements'));
            $grid.masonry('layout');
            reloadMasonry();
            getMorePostsMasonry();
        } else {
            getMorePosts();
        }
    });

    $(document).on('click', '.sortBy', function (e) {
        e.preventDefault();
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
        if($grid){
            $grid.masonry('remove', $grid.masonry('getItemElements'));
            $grid.masonry('layout');
            reloadMasonry();
            getMorePostsMasonry();
        } else {
            getMorePosts();
        }


    });

    $(document).on('click', '.layoutStyle', function (e) {
        e.preventDefault();
        $this = $(this);
        layoutStyle = $(this).data('sort');
        $('.category-style').html($(this).find('span').html());
        page = 1;
        loadedAll = false;
        $('.layoutStyle').removeClass('active');
        $this.addClass('active');
        page = 1;
        resetLayoutStyle(layoutStyle)
        $this.parent().parent().removeClass('show');




    });

    function resetLayoutStyle(layoutStyle){
        $('#scrollForMore').show();
        if(layoutStyle === 'simple'){
            if(!$grid){
                initMasonry();
            }
            // reloadMasonry();
        } else {
            if($grid){
                $grid.masonry('remove', $grid.masonry('getItemElements'));
                $grid.masonry('layout');
                $grid = null;
            }

            $('#more-posts').html('<div class="text-center loading-spinner-posts">\n' +
                '                                <br>\n' +
                '                                <span class="kt-spinner kt-spinner--sm kt-spinner--primary"> </span>\n' +
                '                            </div>');
            getMorePosts();

        }
    }

    window.document.dispatchEvent(DOMContentLoaded_event);

    loadSwiper();

    function reloadMasonry(){
        $grid = $('.adventures-masonry-grid').masonry({
            itemSelector: '.adventure-grid-item',
            percentPosition: true,
            columnWidth: '.adventure-grid-sizer'
        });
        return $grid;
    }
    function initMasonry() {
        $('#more-posts').html('');
        $grid = reloadMasonry();

// layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.masonry();
        });

// layout Masonry after each image loads
        $grid.imagesLoaded().progress( function() {
            $grid.masonry('layout');
        });
        getMorePostsMasonry();
    }

    function getMorePostsMasonry(_lat, _lng) {
        loading = true;
        var morePostData = {radius: 53000, page: page, country: _country, sort: sortBy, filters: activeFilters};
        if(_lat && _lng){
            morePostData.lat = _lat;
            morePostData.lng =_lng;
        }
        // $('.loading-spinner-posts').show();
        $.ajax({
            url: '/getPostsByLocationData',
            method: 'GET',
            data: morePostData,
            success: function (data) {
                page = page + 1;
                $('.refresh-loc-icon').show();
                $('.loading-spinner-loc').hide();
                //Masonry
                var $items = getItems(data.posts);
               
                $grid.masonryImagesReveal( $items );

                $('.loading-spinner-posts').hide();

                if($('#more-posts .my-post').length > 4 ||  $('#more-posts .my-post').length < 4)
                    $('#scrollForMore').hide();

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

    function readAndUpdatePage(){
        var element;
        var offset = 100;
        if(layoutStyle == 'simple'){
            element =  $('#adventures-grid');
            offset = 180;
        } else {
            element = $('#more-posts');
        }

        if (lastScrollY + $(window).height() + offset   >= element.height() ) {

            if (loading == false && loadedAll == false) {

                loading = true;
                $('.more-posts-loader').show();
                if(layoutStyle === 'simple'){
                    getMorePostsMasonry();
                } else {
                    getMorePosts(page);
                }

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
    window.addEventListener('scroll', onScroll, {passive: true});
    setActiveFilters();
    getMorePosts();
    // getMorePostsMasonry();
})

function setActiveFilters(){
    if(!activeFilters){
        activeFilters = [];
        $('.profile-badge').each(function (index, el){
            if($(this).hasClass('active')){
                 
                activeFilters.push($(this).data('key'));
            }
          })
    }
}

function setMarkers(posts, badges, map) {

    if (markers !== undefined) {
        map.removeLayer(markers)
    }


    markers = L.markerClusterGroup({
        iconCreateFunction: function (cluster) {
            return L.divIcon({html: '<div class="markerGroup">' + cluster.getChildCount() + '</div>'});
        },
        spiderfyOnMaxZoom: true,
        chunkedLoading: true,
        maxClusterRadius: 30,
        polygonOptions: {
            fillColor: '#b4d677',
            color: '#b4d677',
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
        if(options)
            iconUrl = '/img/badges/empty/' + Object.keys(options.badges)[0] + '.svg';
        if(options && typeof badges[Object.keys(options.badges)[0]]['color'] !== "undefined")
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
        if(iconUrl){
            var mIcon = L.divIcon({
                iconSize:null,
                html:' <div class="badge-wrap" style="-webkit-box-shadow: 0px 0px 3px 0px #000000;-moz-box-shadow: 0px 0px 3px 0px #000000;box-shadow: 0px 0px 3px 0px #000000;background: #666;border:2px solid ' + iconColor + ';-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 32px; height: 32px;margin-left: auto; margin-right: auto;padding: 4px;"> <img  src="' + iconUrl+ ' " style="width:20px;"> </div>',
    
    
            });
    
            markerOptions = {icon: mIcon, url: baseUrl + '/adventure/' + val.id + '/' + val.slug + '?s=c', post_id: val.id};
    
            var center = L.latLng(val.lat, val.lng);
            marker = new L.marker(center, markerOptions);
            markers.addLayer(marker);
    
            markersArray.push(center);
    
            map.addLayer(markers);
            //markers.push(center);
            addedMarkers.addLayer(marker);
            marker.on("click", function (event) {
                var clickedMarker = event;
    
                window.location.href = clickedMarker.target.options.url;
                // openPost(clickedMarker.target.options.post_id)
                // do some stuff…
            });
        }
        

        // map.setZoom(10);
    });
    markers.on('clusterclick', function (a) {
        a.layer.zoomToBounds({padding: [60, 60]});

    });
    if(markersArray.length > 1)
        map.fitBounds(markersArray, {padding: [50, 50]});
    // if (markersArray.length > 1) {
    //     map.fitBounds(markersArray, {padding: [60, 60]});
    // } else {
    //     map.fitBounds(markersArray, {padding: [60, 60]});
    //     map.setZoom(10);
    // }


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
 

function onEachFeature(feature, layer) {
    //bind click

    layer.setStyle({
        weight: 1,
        color: '#fff',
        dashArray: '',
        fillOpacity: 0.6,
        fillColor: '#b4d677',

    });

}

function getGeometry(){
    $.ajax({
        url: '/getCountryGeometry',
        method: 'GET',
        dataType: 'json',
        data: { country_code : $('#countryCode').val()},
        success: function (response) {
            
            if (response.length) {
                L.geoJSON(response, {
                    style: function(feature) {
                        return {
                            fillColor: "#D3D3D3", // Default color of countries.
                            fillOpacity: 0.01,
                            stroke: false,
                            color: "#eeeeee", // Lines in between countries.
                            weight: 1
                        };
                    },
                    onEachFeature: onEachFeature
                }).bindPopup(function(layer) {
                    return layer.feature.properties.name;
                }).addTo(map);
            }
        }

    })
}
function initCategoriesSwiper(){
    var swiper = new Swiper('.swiper-categories', {
        slidesPerView: 'auto',
        spaceBetween: 40,
        freeMode:true,
        freeModeMomentumRatio:0.8,
        freeModeSticky:true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
      
      });
      swiperInitialized = true;
      if($('.profile-badge.active').length){
          
          $('.profile-badge').each(function (index, el){
            if($(this).hasClass('active')){
                swiper.slideTo(index);
                  activeFilters = [];
                activeFilters.push($(this).data('key'));
            }
          })
         
         
      }
}
$(document).ready(function(){
    if($('.swiper-categories-container').is(":visible")){
      
        initCategoriesSwiper();
        
    }
    addedMarkers = L.layerGroup();
    
   /*  initCountryMap();
    getMapPosts(); */
})
