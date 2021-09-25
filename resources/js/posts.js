$(document).ready(function () {
    Dropzone.autoDiscover = false;

    Dropzone.options.featuredImage = { acceptedFiles: 'image/*'};
    Dropzone.options.maxFileSize = 40;
    Dropzone.options.maxFiles = 15;
    Dropzone.options.parallelUploads = 15;
    Dropzone.options.uploadMultiple = true;

    console.log('dz')
    var minFiles = $('#old_featured_image').length;

    var dz = $("#featuredImage").dropzone({
        url: "/uploads",
        maxFiles: 15,
        acceptedFiles: 'image/*',
        uploadMultiple:false,
        parallelUploads:15,
        clickable: '.dz-clickable',
        addRemoveLinks: true,
        createImageThumbnails:true,
        init: function () {
            var _this = this;
            _this.on("maxfilesexceeded", function (file) {
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
                    console.log($("#featuredImage"))
                    console.log($("#image-files").find('#'+ name))
                    $("#image-files").find('#'+ name).remove();
                    // var path = $('#'+ file.name).data('path');

                    // $.ajax({
                    //     url: '/uploads',
                    //     type: "delete",
                    //     data: {'path': path},
                    //     success: function (data) {
                    //         $('[name=featured_image]').val('');
                    //     }
                    // });

                }
            });

        },

        sending: function (file, xhr, formData) {
            // todo: sweet alert
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        },
        success: function (file, response) {
            console.log(response.images)
            $.each(response.images, function(key, val){
                console.log('appending');
                var name = val.originalName.replace('.', '');
                name = name.replace('-', '_');
                $('<input>').attr('type', 'hidden').attr('name', 'image[]').attr('id', name).val(JSON.stringify(val)).appendTo('#image-files');
            })
            file.previewElement.classList.add("dz-success");

        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    });
    function showLocation(){
        $('.item-image').hide();
        $('#tab-image').hide();
        $('#tab-location').show();
        $('.item-location').show( "fast", function() {
            $('.item-location').trigger('click');

        });

        resizeWindow();
    }

    function showImage(){

        $('.item-location').hide();
        $('#tab-image').show();
        $('#tab-location').hide();
        $('.item-image').show( "fast", function() {
            $('.item-image').trigger('click');

        });

        resizeWindow();
    }
    $('.back-to-upload').on('click', function (e) {
        e.preventDefault();
        $('#tab-finish').hide();
        showImage();
    })
    $('.to-location').on('click', function (e) {
        e.preventDefault();
        showLocation();
    })
    $('.back-to-location').on('click', function (e) {
        e.preventDefault();
        $('.item-finish').hide();
        $('#tab-finish').hide();
        showLocation();
    })
    $('.finish-form').on('click', function(e){
        e.preventDefault();
      

        var  lat = $('[name="lat"]').val();
        var  lng = $('[name="lng"]').val();

        if(!lat ||  !lng){
            // $('.item-location').trigger('click');
            console.log(lat);
         /*    toastr.warning('Please add a map marker.', 'Location required', {timeOut: 1500}) */
            $('.location-msg').html('<div class="alert alert-danger text-center">Location is required.</div>');
            var loc = document.getElementById('location-msg');
            $('.item-finish').hide();
            $('.back-to-location').trigger('click');
            // $('html,body').scrollTop(loc.offsetTop );

            resizeWindow();
            return false;
        } else {
            $('.item-image').hide();
            $('.item-location').hide();
            $('#tab-image').hide();
            $('#tab-location').hide();
            $('.item-finish').show( "fast", function() {
    
                $('.item-finish').trigger('click');
    
                $('#tab-finish').show();
            });
    
        }


    });
    function resizeWindow(){
        setTimeout(300, function(){

            $(window).trigger('resize');
        })
        var resizeEvent = window.document.createEvent('UIEvents');
        resizeEvent.initUIEvent('resize', true, false, window, 0);
        window.dispatchEvent(resizeEvent);
    }


    function cke() {
        $('.cke').each(function () {
            id = $(this).attr('id');
            elem = document.getElementById(id);
            CKEDITOR.replace(elem);
        })
    }

    cke();

});