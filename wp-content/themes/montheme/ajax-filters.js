
var ajax_filters = ajax_filters || {};

document.addEventListener("DOMContentLoaded", function() {

    jQuery(document).ready(function($) {
    jQuery('#category-filter, #format-filter, #filter-date').change(function() {
        var category = jQuery('#category-filter').val();
        var format = jQuery('#format-filter').val();
        var annee = jQuery('#filter-date').val();
        console.log('category:', category);
        console.log('format:', format);
        console.log('annee:', annee);

        jQuery.ajax({
            url: ajax_filters.ajaxurl,
            data: {
                'action': 'photo_filter',
                'category': category,
                'format': format,
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