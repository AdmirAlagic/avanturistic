"use strict";

// Class Definition
var KTRegisterV1 = function () {
    var register = $('#kt_register');

    // Private Functions
    var handleSignInFormSubmit = function () {

        /* //display placeholder on field focus, to improve usability
        $('input.dynamic-label').on('focus', function(){
           $('input:focus').before('<label class="focus-label">'+$(this).attr('placeholder')+'</label>');
        });

        $('input').on('focusout', function(){
            $('label.focus-label').remove();
        }); */

        $('#kt_register_signin_submit').click(function (e) {
            e.preventDefault();

            var btn = $(this);
            var form = $('#kt_register_form');

            form.validate({
                /*rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    password: {
                        required: true,

                    },
                    password_confirmation: {
                        required: true,

                    },
                    email: {
                        required: true,
                        email:true,
                    },

                }*/
            });

            if (form.valid()) {
                form.submit();
            }
        });
    }

    // Public Functions
    return {
        // public functions
        init: function () {
            handleSignInFormSubmit();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function () {
    KTRegisterV1.init();



});
