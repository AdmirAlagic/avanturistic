
$(document).ready(function(){
    if($('.gallery-thumbs').length){
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 2,
            slidesPerView: 4,
            freeMode: true,
            lazy: true,
           autoHeight:true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
          });
          var galleryTop = new Swiper('.gallery-top', {
            spaceBetween: 2,
            autoHeight:true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop:true,
            thumbs: {
              swiper: galleryThumbs
            }
          });

          var nearbyPostsSwiper = new Swiper('.nearby-swiper', {
            autoHeight:true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
              },
            loop:true,
          
          })
       
    }
    var map;
    var baseUrl = window.pageHostname;
    var defaultIcon = L.icon({
        iconUrl: baseUrl + '/img/post_marker.svg',
        iconSize: [40, 40],
        iconAnchor: [20, 40],
        popupAnchor: [0, 0],

    });
    function initMap() {

        if($('.lastPost').length){
            var lat = $('.lastPost').data('lat');
            var lng = $('.lastPost').data('lng');
            var img = $('.lastPost').data('img');
            var title = $('.lastPost').data('title');
            var routes = $('.lastPost').data('routes');
            var routesLatLng = [];
            
            if(lat && lng){
                center = {lat : lat , lng:lng};
            } else {
                center = {lat: -15.397, lng: 12.644}
            }

            map = L.map('single-map', {
                center: center,
                zoom: 12,
                maxZoom:19,

            });

            markerOptions =  {icon: defaultIcon};
            marker = new  L.marker(center, markerOptions).addTo(map);
            
            marker.on('click', function(e){
                map.setView(e.latlng,16, {animate: true});
            });
            if(title && title != '')
                marker.bindPopup("<p>" + title + "</p>");
            OpenStreetMap_Mapnik = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });
            OpenStreetMap_Mapnik.addTo(map);

            if(routes  && routes.length){
                $.each(routes[0], function (key,val) {
                    routesLatLng.push([val.lat, val.lng]);
                })
            }
 
            if(routesLatLng.length ){
                var polyline = L.polyline(routesLatLng, {color: 'red', fill:true, fillColor:'#FFFFFF', weight:3}).addTo(map);

                // zoom the map to the polyline
                map.fitBounds(polyline.getBounds());
            }

            if(polyline){
                polyline.on('click', function () {
                    //mymap.fitBounds(polygon.getBounds());
                    map.fitBounds(polyline.getBounds());

                });
                // polyline.bindPopup((totalDistance / 1000).toFixed(2) + ' km');
                // polyline.openPopup();
            }


        }

    }
    $('[data-toggle="kt-tooltip"]').tooltip();
    initMap();
    var wholink =
        'i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community';
    var sateliteLayer =  L.tileLayer(
        'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: '&copy; '+wholink,
            maxZoom: 18,
        });
    $('.showSatelite').on('click', function (e) {
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
    $('.post #likeBtn').on('click', function(e){

        e.preventDefault();
        var $this = $(this);

        var post_id = $(this).data('post_id');
        var icon = $(this).find('i');
        if(!icon.hasClass('text-success')){
            icon.removeClass('text-white');
            icon.addClass('text-success');
        } else {
            icon.addClass('text-white');
            icon.removeClass('text-success');
        }
        $.ajax({
            url: '/post/like',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
               if(data !== 'login'){
                   
                   $('#likesCount').html(data);
                   $this.attr('disable', true);
               } else {
                    $('.tooltip').hide();
                    $('#signUpModal').modal('show').modal('focus');
               }

            },

        });

    });

    if($('.sweet-alert-').length > 0) {
        $('#comment-form ').on('click', '.sweet-alert-', function (e) {
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

                    if($('#comment-delete-'+comment_id).length > 0){
                        $('form#comment-delete-'+comment_id).submit();
                    }

                    if($('#post-delete-'+comment_id).length > 0){

                        $('form#post-delete-'+comment_id).submit();
                    }
                }
            });
        });
    }
    var commentSubmiting = false;
 
    $(document).on('submit', "#comment-form", function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        if(!commentSubmiting){
            commentSubmiting = true;
            $('.submitComment').prop('disabled', true);
            var form = $(this);
            var url = form.attr('action');
            var type = form.attr('method');
            $('.comment-error').html('');
            $.ajax({
                type: type,
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (payload) {
                    if(window.auth_check === 'true'){
                        $('#comments-list').append(payload);
    
                    } else{
                        $('.guest-comment-msg').html(payload);
    
                    }
                    commentSubmiting = false;
                    $("#comment-form").find('[name="body"]').val('');
                    $('.submitComment').prop('disabled', false);
                },
                error: function (request, status, error) {
                    var errorsStr = '';
                   
                    commentSubmiting = false;
                    Object.keys(request.responseJSON.errors).forEach(function (key) {
                        var val = request.responseJSON.errors[key];
                        errorsStr = val + ' <br>';
    
                    });

                    $('.submitComment').prop('disabled', false);
                    $('.comment-error').html('<div class="alert alert-danger">' + errorsStr + '</div>');
                }
            });
        }
        
    });
     
    $('.post #visitedBtn').on('click', function(e){

        e.preventDefault();
        var $this = $(this);

        var post_id = $(this).data('post_id');
        var icon = $(this).find('i');
        if(!icon.hasClass('text-success')){
            icon.removeClass('text-white');
            icon.addClass('text-success');
        } else {
            icon.addClass('text-white');
            icon.removeClass('text-success');
        }
      
        $.ajax({
            url: '/post/visited',
            method: "POST",
            data: {'post_id': post_id},
            success: function (data) {
                if(data !== 'login'){
                    
                    $('#visitedsCount').html(data);
                    $this.attr('disable', true);
                } else {
                    $('.tooltip').hide();
                    $('#signUpModal').modal('show').modal('focus');
                }

            }
        });

    });
    var pageActivityLikes = 0;
    var pageActivityOthers = 0;
    activityLoading = false;
    function getActivity(type, btn){
       var post_id = $('#post_id').val();
        activityLoading = true;
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
            data: { page: _page, post_id: post_id , 'type' : type},
            success:function(data){
                if(data !== 'false'){
                    $('#more-activity-'+type).append(data);
                    $('.getMoreActivity[data-type="' + type + '"]').prop('disabled', false);

                } else {
                    $('.getMoreActivity[data-type="' + type + '"]').hide();
                    // if(_page == 1){
                    //     $('#more-activity-'+type).append('<p class="text-center"><small>No activity.</small></p>');
                    // }
                }
                activityLoading = false;
            }
        })
    }

    getActivity('likes');
    getActivity('others');

    $(document).on('click', '.getMoreActivity', function (e) {
        e.preventDefault();
        $this = $(this);

        var type = $(this).data('type');
        if(!activityLoading){

            getActivity(type, $this);
            $this.prop('disabled', true);
        }

    })
})
$(function(){

    if ($('.sweet-alert-').length > 0) {
        $($('#comments-list')).on('click', ".sweet-alert-", function (e) {
            e.preventDefault();
            $this = $(this);
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
                if (result.dismiss != 'cancel') {
                    $.ajax({
                        url: '/deleteComment',
                        method: "POST",
                        data: {'comment_id': comment_id},
                        success: function (data) {
                             $this.closest('.comment-row').fadeOut(300);
                        }
                    });
                }
            });
        });
    }

    
})

var initialMouse = 0;
var slideMovementTotal = 0;
var mouseIsDown = false;
var slider = $('#nextpostswipe');

$('#button-background').on('mousedown touchstart', function(event){
	mouseIsDown = true;
	slideMovementTotal = $('#button-background').width() - $(this).width() + 100;
	initialMouse = event.clientX || event.originalEvent.touches[0].pageX;
});

$(document.body, '#button-background').on('mouseup touchend', function (event) {
	if (!mouseIsDown)
		return;
	mouseIsDown = false;
	var currentMouse = event.clientX || event.changedTouches[0].pageX;
	var relativeMouse = Math.abs(currentMouse) - initialMouse;
      relativeMouse = Math.abs(relativeMouse);
	if (relativeMouse  < slideMovementTotal / 2) {
        
		$('.slide-text').fadeTo(300, 1);
		/* slider.animate({
			left: "10px"
		}, 300); */
		return;
	}
	slider.addClass('unlocked');
    $('.slide-text').fadeOut('fast');
	
    
    $('#button-background').html('<span class="loading-spinner"><span class="kt-spinner kt-spinner--center kt-spinner--sm kt-spinner--dark"></span></span>');
   window.location.href = $('#button-background').data('next-url');
	 
});

$(document.body).on('mousemove touchmove', function(event){
	if (!mouseIsDown)
		return;

	var currentMouse = event.clientX || event.originalEvent.touches[0].pageX;
	var relativeMouse = Math.abs(currentMouse) - initialMouse;
	var slidePercent = 1 - (relativeMouse / slideMovementTotal);
    relativeMouse = Math.abs(relativeMouse);
	$('.slide-text').fadeTo(0, slidePercent);
   
    $('#nextpostswipe').fadeTo(1, slidePercent);
	 
	if (relativeMouse >= slideMovementTotal + 10) {
		slider.css({'left': slideMovementTotal + 'px'});
		return;
	}
	slider.css({'left': relativeMouse - 10});
});
document.addEventListener("DOMContentLoaded", function() {
    var lazyIframes = [].slice.call(document.querySelectorAll("iframe.video-iframe"));

    if ("IntersectionObserver" in window) {
        let lazyIframeObserver = new IntersectionObserver(function(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    let lazyIframe = entry.target;
                    lazyIframe.src = lazyIframe.dataset.src;
                    lazyIframe.classList.remove("lazy");
                    lazyIframe.classList.add("lazyloaded");
                    lazyIframeObserver.unobserve(lazyIframe);
                }
            });
        });

        lazyIframes.forEach(function(lazyIframe) {
            lazyIframeObserver.observe(lazyIframe);
        });
    } else {
        // Possibly fall back to event handlers here
    }
});