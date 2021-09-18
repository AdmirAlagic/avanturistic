//map
$(document).ready(function(){
    CKEDITOR.replace( 'cke-description' , {
        // autoGrow_maxHeight:100,
        height:100,
        width:'100%',
        allowedContent:true,
        resize_enabled:true,
        resize_dir:'vertical',
        extraPlugins: 'resize',
        skin: 'minimalist',
        removePlugins:'unlink,justify,oembed'
    } );
    var map;
    latEl = $('[name="lat"]');
    lngEl = $('[name="lng"]');
    var baseUrl = window.pageHostname;
    var defaultIcon = L.icon({
        iconUrl: baseUrl + '/img/post_marker.svg',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, 0],

    });
    var wholink =
        'i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community';
    var sateliteLayer =  L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; '+wholink,
            maxZoom: 18,
        });
    $(document).on('click', '.showSatelite', function (e) {
        e.preventDefault();
        if($(this).hasClass('active')) {
            map.removeLayer(sateliteLayer);
            $(this).removeClass('active');
            $(this).removeClass('text-success');
        }
        else {
            sateliteLayer.addTo(map);
            $(this).addClass('active');
            $(this).addClass('text-success');
        }

    });
    $(document).on('click', '#badges .removeBadge', function (e) {
        e.preventDefault();
        $(this).remove();
    })

    $('.kt-switch').on('click', function () {
       var checkbox = $(this).find('input');
       if(checkbox.is(":checked")){
           $(this).find('.badge-wrap').removeClass('inactive');

       } else{
           $(this).find('.badge-wrap').addClass('inactive');

       }

    });
    function calculateRouteLength(layer){
        var totalDistance = 0.00000;
        var tempLatLng = null;
        $.each(layer._latlngs, function(i, latlng){

            if(tempLatLng == null){

                tempLatLng = latlng;

            } else {

                totalDistance += tempLatLng.distanceTo(latlng);
                tempLatLng = latlng;
            }

        });
        return parseFloat(totalDistance / 1000).toFixed(2);
    }
    function initMap() {
        map = L.map('single-map', {
            center: [51.505, -0.09],
            zoom: 1,
            tap:false,
        });
        L.Draw.Polyline.prototype._onTouch = L.Util.falseFn;
        function onLocationFound(e) {
            var radius = e.accuracy;
            markerOptions =  {icon: defaultIcon, draggable:true};
            var marker = L.marker(e.latlng, markerOptions).addTo(map);
            addedMarker  = marker;
            if(addedMarker){
                map.removeLayer(addedMarker);
            }
            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();

                $('[name="lat"]').val(position.lat);
                $('[name="lng"]').val(position.lng);

            });
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            $('[name="lat"]').val(lat);
            $('[name="lng"]').val(lng);
        }

        map.on('locationfound', onLocationFound);
        var lc = L.control.locate({showPopup : false,position: 'bottomright',}).addTo(map);
        var addedMarker = null;
        OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        OpenStreetMap_Mapnik.addTo(map);

        var searchControl = L.esri.Geocoding.geosearch({
            providers: [
                L.esri.Geocoding.arcgisOnlineProvider({
                    maxResults: 15
                })
            ]
        }).addTo(map);

        var results = L.layerGroup().addTo(map);
        locationChanged = false;
        searchControl.setPosition('topright');
        searchControl.on('results', function (data) {
            if(addedMarker){
                map.removeLayer(addedMarker);
            }
            results.clearLayers();
            console.log(data)
            locationChanged = true;


        });

        var editableLayers = new L.FeatureGroup();
        map.addLayer(editableLayers);
        var options = {
            position: 'topleft',
            draw: {
                polyline: {
                    shapeOptions: {
                        color: 'red',
                        weight: 6,
                        fill:true,
                        fillColor:'#FFFFFF',
                        opacity:1,
                    },
                    showLength: true,
                    clickable:false,
                },
                polygon: false,
                circle: false, // Turns off this drawing tool
                rectangle: false,
                marker: false,
                circlemarker:false
            },
            edit: {
                featureGroup: editableLayers, //REQUIRED!!
                remove: true
            }

        };

        var drawControl = new L.Control.Draw(options);
        map.addControl(drawControl);
        L.drawLocal.draw.toolbar.buttons.polyline = 'Draw route.';
        map.on(L.Draw.Event.CREATED, function (e) {
            var type = e.layerType,
                layer = e.layer;
            console.log(layer);

            editableLayers.addLayer(layer);
            $('#route-input').val(JSON.stringify(layer.editing.latlngs));
            $('#route-input-description').show();
            $('#route-input-length').val(calculateRouteLength(layer));
        });

        map.on(L.Draw.Event.EDITED, function (e) {

            var layers = e.layers;
            layers.eachLayer(function (layer) {
                $('#route-input').val(JSON.stringify(layer.editing.latlngs));
                $('#route-input-description').show();
                $('#route-input-length').val(calculateRouteLength(layer));
            });


        });

        map.on('draw:deleted', function (e) {

            $('#route-input').val('{}');
            $('#route-input-length').val('');
            $('#route-input-description').hide();
        });

        map.on('moveend', function(e) {
            console.log('moveend'); resizeWindow();
            if(locationChanged){
                markerOptions =  {icon: defaultIcon, draggable:true};
                var lat,lng;
                lat = map.getCenter().lat;
                lng = map.getCenter().lng;
                var center = {lat :  lat, lng :  lng}
                updateLatLngInput(lat, lng);

                if(addedMarker){
                    map.removeLayer(addedMarker);
                }
                setTimeout(function() {
                    map.setZoom(13);
                }, 0);

                var marker = new  L.marker(center, markerOptions).addTo(map);
                addedMarker  = marker;
                marker.on('dragend', function(event) {
                    var position = marker.getLatLng();
                    marker.setLatLng(position, {
                        draggable: 'true'
                    }).bindPopup(position).update();

                    updateLatLngInput(position.lat, position.lng)

                });

                // reverseGeocode(lat, lng);
                resizeWindow();
                locationChanged = false;
            }


        });

        function updateLatLngInput(lat, lng) {
            $('[name="lat"]').val(lat);
            $('[name="lng"]').val(lng);
            reverseGeocode(lat, lng);
        }

        function reverseGeocode(lat, lng) {
            L.esri.Geocoding.reverseGeocode()
                .latlng([lat, lng])
                .run(function (error, result, response) {

                    if(response != undefined && response){
                        console.log(response);
                        $('[name="country_code"]').val(response.address.CountryCode);
                    }


                });
        }

        function onClick(e) {
            if(addedMarker){
                map.removeLayer(addedMarker);
            }

            markerOptions =  {icon: defaultIcon ,draggable:true};
            var center = e.latlng;

            var marker = new  L.marker(center, markerOptions).addTo(map);
            addedMarker  = marker;
            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();

                updateLatLngInput(position.lat, position.lng)
                // reverseGeocode(position.lat, position.lng);
            });
            var lat = marker.getLatLng().lat;
            var lng = marker.getLatLng().lng;

            updateLatLngInput(lat, lng)
            // reverseGeocode(lat, lng);
            $('.location-msg').html('');
        }
        map.on('click', onClick);
        setTimeout(function(){ map.invalidateSize()}, 400);
        $('.geocoder-control-input').on('click touchstart', function () {

            setTimeout(function() {
                map.setZoom(2); // works
            }, 0);


        })
    }


    function resizeWindow(){
        setTimeout(300, function(){
            $(window).trigger('resize');
        })
        var resizeEvent = window.document.createEvent('UIEvents');
        resizeEvent.initUIEvent('resize', true, false, window, 0);
        window.dispatchEvent(resizeEvent);
    }
    $(document).on('click', '.submitPost', function (e) {
        e.preventDefault();
        var  lat = $('[name="lat"]').val();
        var  lng = $('[name="lng"]').val();
        var  featuredImage = $('[name=image]').val();

        if($('#image-files [name="image[]"]').length == 0){

            $('.item-finish').hide();
            $('.back-to-upload').trigger('click');
            toastr.warning('Upload at least one photo.','Upload photos', {timeOut: 1500})
/*             $('.image-msg').html('<div class="alert alert-danger text-center">At least one photo is required.</div>');
 */
            resizeWindow();
            return false;
        }
        $('#kt_form').submit();
        $('.submitPost').prop('disabled', 'true');

    })
    initMap();
    
})
window.onload = function () {
     if (typeof history.pushState === "function") {
         history.pushState("backbutton", null, null);
         window.onpopstate = function () {

           
             history.pushState('newbackbutton', null, null);
            if($('#tab-location').is(':visible')){
                $('.back-to-upload').trigger('click');

            } else {
                if($('#tab-finish').is(':visible')){
                    $('.back-to-location').trigger('click');

                }
            }
            
            

         };
     }
     else {
         var ignoreHashChange = true;
         window.onhashchange = function () {
             // $('#overlay  .closePost').trigger('click');
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