$(document).ready(function () {

    var input = document.getElementById("msg-body");
    input.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            $('#sendMessage').click();
        }
    });
    $('#sendMessage').on('click', function (e) {
        $this = $(this);

        e.preventDefault();
        var message = $('#msg-body');
        if(message.val() != '' && message.val() != ' '){
            $this.prop('disabled', true);
            $.ajax({
                'url': '/sendMessage',
                'method' :'POST',
                'data': {'to_user_id': message.data('to_user_id'),'conversation_id': message.data('conversation_id'),'body': message.val()},
                'success': function (data) {
                    message.val('');
                    $('.emoji-wysiwyg-editor').html('');

                    $.ajax({
                        'url': '/getSingleMessageView',
                        'method' :'POST',
                        'data': {'message_id': data.id, 'conversation_id' : data.conversation_id},
                        'success': function (view) {
                            $('.user-messages').append(view);
                            $this.prop('disabled', false);
                            var el = $('#scroll-message');
                            el.scrollTop(el[0].scrollHeight);
                        },
                        'error': function (data) {
                            $this.prop('disabled', false);
                        }
                    });
                }
            });

        }

    })

});