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
    function markerOnClick(e) {
        var popup = L.popup({offset:{x:0,y:100}}).setLatLng(e.latlng);
        
        if(e.target.img){
            var popupHtml = '<a href="' + e.target.options.url +'"> <img style="width:100%" src="' + baseUrl + e.target.img + '"> </a><a  class="btn text-white" style="position:absolute;margin:10px;bottom:0;left:0;right:0;border:2px solid #FFFFFF;font-weight:bold;background-color:#0000007d;border-radius:4px;" href="' + e.target.options.url +'"><i class="fa fa-map-marker-alt text-white" style="margin-top: -3px;"></i> Explore</a>';
            if(e.target.options.title){
                var popupHtml = popupHtml + '<a  class="btn text-white k-font top-border-radius" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;position:absolute;margin:1px;top:0;left:0;right:0;;font-weight:bold;background-color:#0000007d;border-radius:8px;border-bottom-left-radius:0px;border-bottom-right-radius:0px;" href="' + e.target.options.url +'"> ' + e.target.options.title+ '</a>';
            }
            popup.setContent(popupHtml)
            
        }
        popup.openOn(map);
        var px = map.project(popup._latlng);
        // find the height of the popup container, divide by 2 to centre, subtract from the Y axis of marker location
         px.y -= popup._container.clientHeight/2;
         // pan to new center
         map.panTo(map.unproject(px),{animate: true});
       
       /*  map.fitBounds([e.latlng], {  paddingTopLeft: [100, 0],
            paddingbottomRight: [0, 0]}); */
      
    
  
      }

    $.each(posts, function (index, val) {

        markerOptions = {};
       
        var iconUrl;
        var iconColor = '#FFFFFF';
        var options = JSON.parse(val.options);
        var imgUrl;
        if(val.image){
            val.image = JSON.parse(val.image);
            imgUrl =  val.image[0].thumb_path;
        }
      

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


        markerOptions = {icon: mIcon, url: baseUrl + '/adventure/' + val.id + '/' + val.slug, post_id: val.id, title:val.title};

        var center = L.latLng(val.lat, val.lng);
        marker = new L.marker(center, markerOptions);
        marker.img  =  imgUrl;
        markers.addLayer(marker);

        markersArray.push(center);

        map.addLayer(markers);
        //markers.push(center);
        addedMarkers.addLayer(marker);
       /*  marker.on("click", function (event) {
            var clickedMarker = event;

            window.location.href = clickedMarker.target.options.url;
            // openPost(clickedMarker.target.options.post_id)
            // do some stuff…
        }); */
        marker.on('click', markerOnClick);
    
        // map.setZoom(10);
    });
    markers.on('clusterclick', function (a) {
        a.layer.zoomToBounds({padding: [70, 70]});

    });
    if(markersArray.length > 0){
        map.fitBounds(markersArray, {padding:  [50, 50]});
    }
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
        map.setZoom(2);
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

    getMapPosts();
});


$(document).ready(function () {

    addedMarkers = L.layerGroup();

    function initHomeMap() {

        map = L.map('world-map', {
            center: center,
            zoom: 1,
            noWrap:true,
            minZoom: 1,
            maxZoom: 19,
            zoomControl:false,
             maxBounds: [[-100, -190], [100, 190]],
             fullscreenControl: true,
       /*      maxBoundsViscosity: 1.0, */
            fullscreenControlOptions: {
                position: 'bottomleft'
            }
        });

        L.control.zoom({
            position:'bottomleft'
       }).addTo(map);
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
    if ($('#world-map').length)
        initHomeMap();
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto',
            spaceBetween: 25,
            freeMode:true,
            freeModeMomentumRatio:0.8,
            freeModeSticky:true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
            scrollbar: {
                el: '.swiper-scrollbar',
                hide: false,
              },
          });
})
