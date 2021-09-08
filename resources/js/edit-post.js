//map
$(document).ready(function(){

    CKEDITOR.replace( 'cke-description' , {
        // autoGrow_maxHeight:100,
        height:100,
        width:'100%',
        allowedContent:true,
        resize_enabled:true,
        resize_dir:'vertical',
        extraPlugins: 'resize,emoji',
        skin: 'minimalist',
        removePlugins:'unlink,justify,oembed'
    } );
    var map;
    var lat = $('[name="lat"]').val();
    var lng = $('[name="lng"]').val();
    var routes = $('#post-info').data('routes');
    var routesLatLng = [];
    var baseUrl = window.pageHostname;
    // var lc = L.control.locate().addTo(map);
    var defaultIcon = L.icon({
        iconUrl: baseUrl + '/img/post_marker.svg',
        iconSize: [30, 30],
        iconAnchor: [15, 30],
        popupAnchor: [0, 0],

    });
    var wholink =
        'i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community';
    var sateliteLayer =  L.tileLayer(
        'httpsost://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
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

    var addedMarker = null;
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
        var center = {lat : lat , lng:lng};
        map = L.map('single-map', {
            center: center,
            zoom: 10,
            tap:false,
        });
        L.Draw.Polyline.prototype._onTouch = L.Util.falseFn;
        markerOptions =  {icon: defaultIcon, draggable:true};
        marker = new  L.marker(center, markerOptions).addTo(map);
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                draggable: 'true'
            }).bindPopup(position).update();
            updateLatLngInput(position.lat, position.lng)

        });
        var lc = L.control.locate({showPopup : false}).addTo(map);
       addedMarker = marker;
        OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });
        OpenStreetMap_Mapnik.addTo(map);

        var searchControl = L.esri.Geocoding.geosearch().addTo(map);
        searchControl.setPosition('topright');
        if(routes  && routes.length){
            $.each(routes[0], function (key,val) {
                routesLatLng.push([val.lat, val.lng]);
            })
        }


        var editableLayers = new L.FeatureGroup();
        if(routesLatLng.length ){
            var polyline = L.polyline(routesLatLng, {color: 'red', fill:true, fillColor:'#FFFFFF', weight:5}).addTo(editableLayers);

            // zoom the map to the polyline
            map.fitBounds(polyline.getBounds());
        }
        map.addLayer(editableLayers);
        var options = {
            position: 'topleft',
            draw: {
                polyline: {
                    shapeOptions: {
                        color: 'red',
                        weight: 4,
                        fill:true,
                        fillColor:'#FFFFFF',
                        opacity:1,
                    },
                    showLength: true,
                    clickable:true,
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
            $('#route-input-description').hide();
        });

        function onClick(e) {
            if(addedMarker){
                map.removeLayer(addedMarker);
            }
            markerOptions =  {icon: defaultIcon};

            var center = e.latlng;
            var marker = new  L.marker(center, markerOptions).addTo(map);
            addedMarker  = marker;
            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true'
                }).bindPopup(position).update();
                updateLatLngInput(position.lat, position.lng)

            });
            updateLatLngInput(marker.getLatLng().lat, marker.getLatLng().lng);

        }
        map.on('click', onClick);

    }
    function reverseGeocode(lat, lng) {
        L.esri.Geocoding.reverseGeocode()
            .latlng([lat, lng])
            .run(function (error, result, response) {

                if(response != undefined && response){

                    $('[name="country_code"]').val(response.address.CountryCode);
                }


            });
    }

    function updateLatLngInput(lat, lng) {
        $('[name="lat"]').val(lat);
        $('[name="lng"]').val(lng);
        reverseGeocode(lat, lng);
    }

    initMap();

    $('.remove-img').on('click', function (e) {
        e.preventDefault();
        $this = $(this);
        $this.parent().fadeOut(300, function() { $(this).remove(); });
        // todo: delete file ajax
        // swal.fire({
        //     title: 'Are you sure?',
        //     text: 'You wont be able to restore this image.',
        //     type: 'info',
        //     showCancelButton: true,
        //     confirmButtonText: 'Yes'
        // }).then(function (result) {
        //
        //     if(result.dismiss != 'cancel'){
        //         $this.parent().fadeOut(300, function() { $(this).remove(); });
        //         // todo: delete file ajax
        //     }
        // });

    })
    $(document).ready(function(){

        if(jQuery().sortable) {
            $( "#sortable" ).sortable({connectWith : '.sortable', cancel: ".fixed,input",});
        }
        $( "#sortable input").on('click', function() { $(this).focus(); });
        if($('.sweet-alert-delete').length > 0) {
            $('.sweet-alert-delete').on('click', function (e) {
                e.preventDefault();
                var comment_id = $(this).data('comment_id');
                var type = $(this).data('alert_type');
                var title = $(this).data('alert_title');
                var text = $(this).data('alert_text');
                swal.fire({
                    title: title,
                    text: text,
                    type: type,
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                }).then(function (result) {
    
                    if(result.dismiss != 'cancel'){
                     
                        $('form#post-delete-form').submit();
                    }
                });
            });
        }
    });
})
