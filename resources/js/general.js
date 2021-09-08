
function videoVolumeOnOff(volumeControl, video){
    var i = volumeControl.find('i');
    if(!i.hasClass('fa-volume-mute')){
        i.addClass('fa-volume-mute');
        i.removeClass('fa-volume-up');
        video.prop('muted', true)
    } else{
        i.removeClass('fa-volume-mute');
        i.addClass('fa-volume-up');
        video.prop('muted', false)

    }
}
function muteAllVideos(){
    $('video').each(function(){
        $this = $(this);
        $this.prop('muted', true);
        var i = $this.parent().find('i');
      
        i.addClass('fa-volume-mute');
        i.removeClass('fa-volume-up');
    })
}
$(document).on('click', '.video-block', function(e){
    e.preventDefault();
    $this = $(this);
    var volumeControl = $this.find('.volume');
    var video = $this.find('video');

    var i = volumeControl.find('i');
   
    if(!i.hasClass('fa-volume-up')){
        muteAllVideos(); 
        i.removeClass('fa-volume-mute');
        i.addClass('fa-volume-up');
        video.prop('muted', false)

    }  else {
        muteAllVideos(); 
    }
   /*  videoVolumeOnOff(volumeControl, video); */
    
});

$('#highlights').on('click', '.like', function (e) {

    e.preventDefault();
    var $this = $(this);

    var timelapse_id = $(this).data('timelapse_id');
    var icon = $(this).find('i');
    if (!icon.hasClass('text-success')) {
        icon.removeClass('text-white');
        icon.addClass('text-success');
    } else {
        icon.removeClass('text-success');
        icon.addClass('text-white');
    }
    $.ajax({
        url: '/timelapse/like',
        method: "POST",
        data: {'timelapse_id': timelapse_id},
        success: function (data) {
            if (data !== 'login') {
               

                $this.find('.likesCount').html('&nbsp;' + data + '&nbsp;');
                $this.attr('disable', true);
            } else {
                swal.fire({
                    title: 'Only for members',
                    text: 'Create a free account now',
                    type: 'info',
                    showCancelButton:true,
                    confirmButtonText: 'Sign Up'
                }).then(function (result) {
                    if (result.dismiss != 'cancel')
                        window.location = 'https://avanturistic.com/login';
                });
            }

        },

    });

});
/* $(document).on('click', '.volume', function(e){
    e.preventDefault();
    $this = $(this);
    var volumeControl = $this;
    var video = $this.parent().find('video');
  
    videoVolumeOnOff(volumeControl, video);
}); */