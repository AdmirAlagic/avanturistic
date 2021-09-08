$(document).ready(function() {

    $('.blog-show #likeBtn').on('click', function (e) {

        e.preventDefault();
        var $this = $(this);

        var blog_id = $(this).data('blog_id');
        $this.addClass('text-success');
        $.ajax({
            url: '/blog/like',
            method: "POST",
            data: {'blog_id': blog_id},
            success: function (data) {
                //uvecaj broj superova :D
                $this.removeClass('text-muted');
                $this.addClass('text-red');
                $('#likesCount').html(data);
                $this.attr('disable', true);
            }
        });

    });
    var commentSubmiting = false;

    $(document).on('submit', "#comment-form", function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        if(!commentSubmiting){
            commentSubmiting = true;
            var form = $(this);
            var url = form.attr('action');
            var type = form.attr('method');
            $('.comment-error').html('');
            $('.submitComment').prop('disabled', true);
            $.ajax({
                type: type,
                url: url,
                data: form.serialize(), // serializes the form's elements.
                success: function (payload) {
                    commentSubmiting = false;
                    if(window.auth_check === 'true'){
                        $('#comments-list').prepend(payload);
    
                    } else{
                        $('.guest-comment-msg').html(payload);
    
                    }
                    $("#comment-form").find('[name="body"]').val('');
                    $('.submitComment').prop('disabled', false);
                },
                error: function (request, status, error) {
                    commentSubmiting = false;
                    var errorsStr = '';
                    console.log(request);
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

    
});

$(function(){
    if ($('.sweet-alert-').length > 0) {
        $('#comments-list').on('click', ".sweet-alert-", function (e) {
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