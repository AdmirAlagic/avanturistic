$(document).ready(function () {
    Dropzone.autoDiscover = false;
    Dropzone.options.featuredImage = { acceptedFiles: 'image/*'};
    Dropzone.options.maxFileSize =20;

    console.log('dz')

    var dz = $("#featuredImage").dropzone({
        url: "/uploads",
        maxFiles: 5,
        acceptedFiles: 'image/*',
        uploadMultiple:false,
        parallelUploads:5,
        clickable: '.dz-clickable',
        addRemoveLinks: true,
        init: function () {
            var _this = this;
            _this.on("maxfilesexceeded", function (file) {
                alert("Maximum 5 photos are allowed.");
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
    if($('.sweet-alert-blog').length > 0) {
        $('.sweet-alert-blog').click(function (e) {
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
                    console.log('a')
                    $('form#delete-blog-form').submit();
                }
            });
        });
    }

    $('.ajax-delete-attachment').on('click', function (data) {

        if (!confirm('Are you sure? File will be deleted from the server.')) return;

        var path = $(this).data('path');
        var id = $(this).data('id');
        var image = $(this).data('image');
        var _this = this;

        $.ajax({
            url: 'delete-attachment',
            type: "delete",
            data: {'path': path},
            success: function (data) {
                if (!image) {
                    $(_this).closest('li').remove();
                } else {
                    $(_this).closest('div.col-md-4').remove();
                }
            }
        });
    });

    function cke() {
        $('.cke').each(function () {
            id = $(this).attr('id');
            elem = document.getElementById(id);

            CKEDITOR.replace( id , {
                // autoGrow_maxHeight:100,
                height:500,
                width:'100%',
                allowedContent:true,
                resize_enabled:true,

                removePlugins:'about',

            } );
        })
    }

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

    cke();

});