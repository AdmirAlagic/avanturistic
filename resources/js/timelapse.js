$(document).on('click touch', '.play-audio', function(e) {
    playerControls = $(this);
    var playerID = $(this).data('key');
    var checkbox = $('#' + $(this).data('check'));
    var   audiostatus = 'off';
   
    var getaudio =  $('#' + playerID )[0];
    checkbox.prop("checked", true);
   
   
    
    if (!playerControls.hasClass("playing")) {
        stopAllAudio();
        if (audiostatus == 'off') {
            
            playerControls.addClass('playing');
            getaudio.load();
            getaudio.play();
        
            audiostatus = 'on';
            playerControls.find('.bars').show();
            playerControls.find('.fa-play').css('opacity', 0);
            
            return false;
            
        } else if (audiostatus == 'on') {
            playerControls.find('.bars').hide();
            playerControls.find('.fa-play').css('opacity', 1);
            playerControls.removeClass('playing');
            getaudio.pause();
            audiostatus = off;
        }
 
    } else if (playerControls.hasClass("playing")) {
    
        getaudio.pause();
        playerControls.removeClass('playing');
        playerControls.find('.bars').hide();
        playerControls.find('.fa-play').css('opacity', 1);
        audiostatus = 'on';
    
    }

   
    $('#' + $(this).data('key') + '-audio').on('ended', function() {

        playerControls.removeClass('playing');
        audiostatus = 'off';
        playerControls.find('.fa-play').css('opacity', 1);
        playerControls.find('.bars').hide();
        });
   
    return false;
});
 
function stopAllAudio(){
    $('.bars').hide();
    $('.fa-play').css('opacity', 1);
    $('audio').each(function(){
       
        $(this)[0].pause();
        $('.play-audio').removeClass('playing');
    })
}

$(document).on('click', 'input:checkbox', function() {
    var max = $("input:checkbox:checked").length >= 21;     
     
    if(max){
        return false;
    }
   
    });


$('#kt_form').on('submit',function(){
     
    $('#submit-form').hide();
    $('.generating').show();
    $('#submit-form').prop('disabled', true);
});


$(document).ready(function () {
    Dropzone.autoDiscover = false;

    Dropzone.options.uploadImages = { acceptedFiles: 'image/*'};
    Dropzone.options.maxFileSize = 40;
    Dropzone.options.maxFiles = 15;
    Dropzone.options.parallelUploads = 15;
    Dropzone.options.uploadMultiple = true;

    console.log('dz')
    var minFiles = $('#old_featured_image').length;

    var dz = $("#uploadImages").dropzone({
        url: "/uploads",
        maxFiles: 15,
        acceptedFiles: 'image/*',
        uploadMultiple:false,
        parallelUploads:15,
        clickable: '.dz-clickable',
        createImageThumbnails: false,
        thumbnailHeight:80,
        thumbnailWidth:80,
        previewsContainer:'.dz-preview',
        addRemoveLinks: false,
        init: function () {
            var _this = this;
           /*  _this.on("maxfilesexceeded", function (file) {
                alert("Maximum 15 photos are allowed.");
                this.removeFile(file);
            });
            _this.on("removedfile", function (file) {
                console.log(file);
                if (file.status == 'success') {

                    console.log(file.name);
                    var name = file.name.replace('-', '_');
                    name = name.replace('.', '')
                    // var fileInput = $('#'+ file.name);
                    console.log($("#uploadImages"))
                    console.log($("#image-files").find('#'+ name))
                    $("#image-files").find('#'+ name).remove();
                    

                }
            }); */

        },
        addedFiles: function(){
            console.log('added');
           
        },
        queuecomplete: function(){
            console.log('queuecomplete');
            $('.uploading').hide();
            $('.upload-text').show();
        },
        sending: function (file, xhr, formData) {
            // todo: sweet alert
            $('.uploading').show();
            $('.upload-text').hide();
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (file, response) {
           
            $.each(response.images, function(key, val){
              
                var imgContainer = $('#photosContainer');
                var count = imgContainer.find('.uploaded-img').length + 1;
                var inputHtml = '<div class="col-4 col-sm-3" style="padding:10px;"><input type="checkbox" id="check-'+ count +'"  checked name="paths[]" value="' + val.path +'"/><label for="check-' + count +'" class="border-radius4"><img src="' + val.thumb_path +'"  alt="" class="border-radius4 uploaded-img"  style="cursor:pointer;"></label></div>'
              /*   $('<input>').attr('type', 'hidden').attr('name', 'image[]').attr('id', name).val(JSON.stringify(val)).appendTo('#image-files'); */
              imgContainer.prepend(inputHtml);
            })
            file.previewElement.classList.add("dz-success");

        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    });
});