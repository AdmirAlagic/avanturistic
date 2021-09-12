function resizeWindow(){
    setTimeout(300, function(){
        $(window).trigger('resize');
    })
    var resizeEvent = window.document.createEvent('UIEvents');
    resizeEvent.initUIEvent('resize', true, false, window, 0);
    window.dispatchEvent(resizeEvent);
}
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){


    $('[data-toggle="kt-tooltip"]').tooltip();
    $('link[type*=icon]').detach().appendTo('head');
    if($('#scroll-message').length > 0){
        var el = $('#scroll-message');

        el.scrollTop(el[0].scrollHeight);

    }
    $(document).on('click', '.removeNotifications', function (e) {
        $('.kt-header__topbar-item').find('.notification-pulse-ring').remove();

        $('.kt-header__topbar-item').find('.notification-icon').removeClass('text-green');
        $('.notifications-count').fadeOut();
        $('.seen-badge').fadeOut();
        
        $.ajax({
            url: '/removeNotifications',
            method: 'POST',
            dataType:'json',
            success:function(response){
                   // location.reload();
            }
        })
    }) ;
});
/* $(document).on('click', 'a.loading', function (e) { 
       $('#overlay-loading').show();
    }) ;
 */
if($('.create-post-next').length > 0){

    $(document).on('click', '.create-post-next', function (e) {$(window).trigger('resize');
        resizeWindow();
    }) ;
    $(document).on('click', '.create-post-prev', function (e) {$(window).trigger('resize');
        resizeWindow();
    }) ;
    $(document).on('click', '.kt-wizard-v1__nav-icon', function (e) {$(window).trigger('resize');
        resizeWindow();
    }) ;
}

$(function() {
 
    if($('.sweet-alert-report').length > 0) {
        $('.sweet-alert-report').click(function (e) {

            e.preventDefault();
            var $this = $(this);
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
                if(result.dismiss != 'cancel')
               window.location = $this.attr('href');
            });
        });
    }

    $(document).on('submit', '#signup-form', function (e) {
        e.preventDefault();
        $('#signup-errors').html('');
        $('.signupLoading').show();
        $('#signupSubmit').prop('disabled', true);
        $.ajax({
            url: '/asyncRegister',
            method: 'POST',
            dataType:'json',
            data:$(this).serialize(),
            success:function(response){
                $('.signupLoading').hide();
                $('#signupSubmit').prop('disabled', false);
                   if(response.error){
                        $('#signup-errors').html(response.error);
                   } else {
                       
                       window.location = '/';
                   }
            },
            error: function error(xhr, errorType, errorStatusText) {
                $('.signupLoading').hide();
                $('#signupSubmit').prop('disabled', false);
                if (errorType == "error") {
                    console.log(xhr.responseText);
                    var jsonResponse = $.parseJSON(xhr.responseText);
        
                    showErrors(jsonResponse.errors);
                    return false;
                }
            }
        })
    }) ;
 
function showErrors(errors) {
    var errorsString = '';
    $.each(errors, function (key, error) {
        errorsString = error + '<br>';
    });
    $('#signup-errors').html('<div class="alert alert-danger">' + '' + errorsString + '</div>');
    }
});

$(document).ready(function(){var spans = $(".popEffect span"); //get all the "span" inside "popEffect"
var spansWidth = [];

spans.each(function(){
	spansWidth.splice(0,0,$(this).width());
});
//
  var largest = Math.max.apply(Math, spansWidth);//get the largest number
 /*  $(".stuff").width($("h1").width() + largest); */
});
