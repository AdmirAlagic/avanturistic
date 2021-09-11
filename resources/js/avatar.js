$(document).ready(function () {
    Dropzone.autoDiscover = false;
    Dropzone.options.avatarImage = { acceptedFiles: 'image/*'};
    var minFiles = $('#old_avatar').length;
    function dataURItoBlob(dataURI) {
        var byteString = atob(dataURI.split(',')[1]);
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: 'image/jpeg' });
    }

// modal window template
    var modalTemplate = '<div class="modal"><!-- bootstrap modal here --></div>';
    var cropped = false;
    var dz = $("#avatarImage").dropzone({
        url: "/uploads",
        maxFiles: 1,
        addRemoveLinks: true,
        autoProcessQueue:false,
        init: function () {
            var _this = this;
            // _this.on("maxfilesexceeded", function (file) {
            //     alert("Only one image allowed.");
            //     this.removeFile(file);
            // });
            _this.on("removedfile", function (file) {
                if (file.status == 'success') {
                    var filename = JSON.parse($('[name=avatar]').val());

                    $.ajax({
                        url: '/uploads',
                        type: "delete",
                        data: {'path': filename.path},
                        success: function (data) {

                        }
                    });

                    minFiles = false;
                }
            });
        _this.on('addedfile', function (file) {
            var myDropZone = _this;
            if(cropped)
            {
                return;
            }
            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000000';

            // Create the confirm button
            var confirm = document.createElement('button');
            var confirm_wrapper = document.createElement('div');
            var helpText = document.createElement('p');
            var back = document.createElement('button');

            confirm_wrapper.style.textAlign = 'right';

            back.style.zIndex = 9999;
            back.textContent = 'Cancel';
            back.style.float = 'left';
            back.style.color = '#FFFFFF';
            back.style.backgroundColor = '#000000';
            back.style.padding = '10px';
            back.style.border = 'none';

            helpText.style.zIndex = 9999;
            helpText.textContent = 'Zoom in/out, drag black area or use rectangle to crop image';
            helpText.style.textAlign = 'center';
            helpText.style.color = '#FFFFFF';

            helpText.style.padding = '5px';
            helpText.style.marginTop = '10px';
            helpText.style.fontSize = '0.7em';
            helpText.style.border = 'none';


            confirm.style.zIndex = 9999;
            confirm.textContent = 'Next';
            confirm.style.color = '#FFFFFF';
            confirm.style.backgroundColor = '#acc957';
            confirm.style.padding = '10px';
            confirm.style.border = 'none';
            confirm_wrapper.appendChild(back);
            confirm_wrapper.appendChild(confirm);
            confirm_wrapper.appendChild(helpText);

            confirm.addEventListener('click', function() {
                var $image = $('#img-crop');
                var cropper = $image.data('cropper');
                // Get the canvas with image data from Cropper.js
                var canvas = cropper.getCroppedCanvas({
                    width: 600,
                    height: 600,
                }).toDataURL();
                var blob = $image.cropper('getCroppedCanvas').toDataURL();
                // // transform it to Blob object
                var newFile = dataURItoBlob(blob);
                editor.parentNode.removeChild(editor);
                cropped = true;
                _this.removeFile(file);
                // Return modified file to dropzone
                _this.addFile(newFile);
                // upload cropped file with dropzone
                // Remove the editor from view

                editor.remove();
                _this.processQueue();


            });

            back.addEventListener('click', function() {

                $('[name=avatar]').val('');
                myDropZone.removeAllFiles();
                // Remove the editor from view
                editor.parentNode.removeChild(editor);

            });

            editor.appendChild(confirm_wrapper);

            // Load the image
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);
            image.id = 'img-crop';

            // Append the editor to the page
            document.body.appendChild(editor);

            var $image = $('#img-crop');

            // Create Cropper.js and pass image
            $image.cropper({
                aspectRatio:1,
                responsive:true,
                movable: true,
                dragMode:'move',
                autoCrop:true,
                cropBoxMovable: true,
                cropBoxResizable:true,
                minCanvasWidth:'100%',
                maxCanvasHeight:'80%',
                minCropBoxHeight:300,
                minCropBoxWidth:300,
            });

            // add cropped file to dropzone


        })
        },

        sending: function (file, xhr, formData) {
            // todo: sweet alert
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append('destination_path', 'avatars');
            $('#avatarImage').before('<div class="kt-spinner kt-spinner--v2 kt-spinner--sm kt-spinner--success pull-right"></div>');
        },
        success: function (file, response) {


            minFiles = true;

            file.previewElement.classList.add("dz-success");
            // cropped = false;
            location.reload();

        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    });

    $('.kt-switch').on('click', function () {
        var checkbox = $(this).find('input');
        if(checkbox.is(":checked")){
            $(this).find('.badge-wrap').removeClass('inactive');

        } else{
            $(this).find('.badge-wrap').addClass('inactive');

        }

    });

});