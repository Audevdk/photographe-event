
var ajax_filters = ajax_filters || {};

document.addEventListener("DOMContentLoaded", function() {
    jQuery(document).ready(function($) {
        jQuery('.photo-filters select').change(function() {
            var categories = jQuery('#category-filter').val();
            var formats = jQuery('#format-filter').val();
            var annee = jQuery('#filter-date').val();

            console.log('categories:', categories);
            console.log('formats:', formats);
            console.log('annee:', annee);

            jQuery.ajax({
                url: ajax_filters.ajaxurl,
                data: {
                    'action': 'photo_filter',
                    'categories': categories,
                    'formats': formats,
                    'annee': annee,
                },
                success: function(result) {
                    console.log('Réponse:', result);
                    jQuery('.galerie-photo').html(result.images);
                },
            });
        });
    });
});