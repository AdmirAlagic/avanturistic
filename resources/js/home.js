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
var mapInitialized = false;
var markers;
var locationChanged = false;
var fullscreenEntered = false;
var interleaveOffset = 0.7;
var lastScrollY;
var scheduledAnimationFrame = false;
var addedMarkers;

var lastActiveFilter = null;
swiperOptions = {
    loop: true,
    speed: 500,
   /*  effect: 'fade', */
    grabCursor: false,
    watchSlidesVisibility: true,
    preloadImages:false,
  /*   preloadImages: false, */
    lazy: true,
    lazy: {   loadOnTransitionStart:true,
        loadPrevNextAmount:2,
        loadPrevNext: true},
    watchVisibility: true,
    on: {
        lazyImageReady: function () {
            if (!this.autoplay.running) {
                this.params.autoplay = {
                    delay: 5000,
                    disableOnInteraction: true
                };
                this.autoplay.start();
            }
        }
    },
    /* autoplay: {
        delay: 5000,
        disableOnInteraction: true,
    }, */
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    
    
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
            html:' <div class="badge-wrap" style="-webkit-box-shadow: 0px 0px 3px 0px #000000;-moz-box-shadow: 0px 0px 3px 0px #000000;box-shadow: 0px 0px 3px 0px #000000;background: #666;border:2px solid ' + iconColor + ';-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%; width: 32px; height: 32px;margin-left: auto; margin-right: auto;padding: 4px;"> <img  src="' + iconUrl+ ' " style="width:20px;"> </div>',


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
            window.location = (clickedMarker.target.options.url);

        });

        // map.setZoom(10);
    });
   /*  markers.on('clusterclick', function (a) {
        a.layer.zoomToBounds({padding: [70, 70]});

    }); */
    if(markersArray.length){
        map.fitBounds(markersArray,{padding: [5, 5]});
        map.zoomToBounds(markersArray,{padding: [2, 2]});
    }
   /*  map.fitBounds(markersArray,{padding: [5, 5]}); */
   

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


function  loadSwiper() {
    $('.swiper-container.inactive').each(function(index){
        $this = $(this);
        $this.addClass('active');
        $this.removeClass('inactive');
        var swiper = new Swiper("#" + $this.attr('id'), swiperOptions);

    })
}

$(document).ready(function () {

    addedMarkers = L.layerGroup();

    function initHomeMap() {
        mapInitialized = true;
        map = L.map('home-map', {
            center: center,
            zoom: 2,
            maxZoom: 19,
            maxBounds: [[-90, -180], [90, 180]],
            fullscreenControl: true,
            maxBoundsViscosity: 1.0,
            fullscreenControlOptions: {
                position: 'topleft'
            }
        });

        map.on('enterFullscreen', function () {
            fullscreenEntered = true;
        });

        map.on('exitFullscreen', function () {
            fullscreenEntered = false;
        });

        OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        OpenStreetMap_Mapnik.addTo(map);

        var searchControl = L.esri.Geocoding.geosearch().addTo(map);
        var results = L.layerGroup().addTo(map);

        searchControl.setPosition('topright');
        searchControl.on('results', function (data) {
            results.clearLayers();
            locationChanged = true;
        });

        $('.geocoder-control-input').on('click touchstart', function () {

            setTimeout(function () {
                map.setZoom(1);
            }, 0);


        })
        map.on('moveend', function (e) {
            if (locationChanged) {
                getMapPosts(150, map.getCenter().lat, map.getCenter().lng);
                locationChanged = false;
            }


        });

        getMapPosts();
        // getMorePosts(1);
    }

    $(document).on('click', '.nav-map', function (e) {
        e.preventDefault();
        if ($('#home-map').length && !mapInitialized)
            initHomeMap();
        resizeWindow();
    });
    $(document).on('click', '.nav-watch' , function(e){
    
        if($('iframe').length){
        
            var frame = $('iframe');
            if(frame.get(0).hasAttribute('data-src')){
                vidSource = $(frame).attr('data-src');
                $(frame).attr('src', vidSource);
                $(frame).removeAttr('data-src');
            }
        } 
    });
     
    loadSwiper();
    
function resizeWindow(){
    setTimeout(300, function(){
        $(window).trigger('resize');
    })
    var resizeEvent = window.document.createEvent('UIEvents');
    resizeEvent.initUIEvent('resize', true, false, window, 0);
    window.dispatchEvent(resizeEvent);
}

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
                    $('.tooltip').hide();
                    $('#signUpModal').modal('show');
                }

            },

        });

    });
    $(".go-to-menu").on('click', function() {
        const id = 'menu';
const yOffset = -30; 
const element = document.getElementById(id);
const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

window.scrollTo({top: y, behavior: 'smooth'});
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
                    $('.tooltip').hide();
                    $('#signUpModal').modal('show').modal('focus');
                }

            }
        });

    });
    window.document.dispatchEvent(DOMContentLoaded_event);
})
