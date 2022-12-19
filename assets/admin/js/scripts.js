/**
 * Admin Scripts
 */

(function ($, window, document, pluginObject) {
    "use strict";


    $(document).on('submit', '#facebook-contact-form', function () {
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            context: this,
            url: "facebook.ajax_url",
            data: {
                action: 'facebook-from-action',
                formData,
            },
            success: function (response) {
                console.log(response);
            }
        });
    });

})(jQuery, window, document, facebook);