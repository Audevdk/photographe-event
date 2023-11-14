jQuery(function($) {
    var page = 1;
 
    jQuery('#load-more-btn').on('click', function() {
       page++;
 
       $.ajax({
          url: frontendajax.ajaxurl,
          type: 'post',
          data: {
             action: 'load_more_photos',
             page: page,
          },
          success: function(response) {
            $('.galerie-photo').append(response);
          },
       });
    });
 });