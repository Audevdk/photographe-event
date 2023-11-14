<?php

function montheme_register_menus() {
  register_nav_menus( array(
    'main'   => 'Menu Principal',
    'footer' => 'Bas de page',
  ) );
}
add_action( 'after_setup_theme', 'montheme_register_menus' );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_image_size( 'photo-size', 500, 500, true );

function montheme_enqueue_styles_and_scripts() {
  // Enqueue styles
  wp_enqueue_style( 'montheme-style', get_template_directory_uri() . '/style.css' );

  // Enqueue scripts
  wp_enqueue_script( 'script', get_template_directory_uri() . '/script.js', array( 'jquery' ), '1.0', true );

  // Enqueue Ajax Filters script
  wp_enqueue_script( 'ajax-filters', get_template_directory_uri() . '/ajax-filters.js', array( 'jquery' ), '1.0', true );
  wp_localize_script( 'ajax-filters', 'ajax_filters', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'montheme_enqueue_styles_and_scripts' );
// enqueue Ajax load-more
wp_enqueue_script('load-more', get_template_directory_uri() . '/load-more.js', array('jquery'), null, true);
wp_localize_script('load-more', 'frontendajax', array('ajaxurl' => admin_url('admin-ajax.php')));

wp_enqueue_script('lightbox', get_template_directory_uri() . '/lightbox.js', array('jquery'), true);




function photo_filter() {
  
 
  // Récupérez les valeurs des filtres à partir de $_POST
  $selected_category = isset($_POST['categories']) ? $_POST['categories'] : '';
  $selected_format = isset($_POST['formats']) ? $_POST['formats'] : '';
  $selected_annee = isset($_POST['annee']) ? $_POST['annee'] : '';


  // Construisez votre requête WP_Query en fonction des valeurs des filtres
  $args = array(
      'post_type' => 'photo',
      'posts_per_page' => -1, 
      'tax_query' => array(
          'relation' => 'AND',
          array(
              'taxonomy' => 'categories',
              'field'    => 'slug',
              'terms'    => ($selected_category == '' ? get_terms('categories', array('fields' => 'slugs')) : $selected_category),
          ),
          array(
              'taxonomy' => 'formats',
              'field'    => 'slug',
              'terms'    => $selected_format,
          ),
      ),
  ); 

  // Exécutez la requête
  $query = new WP_Query($args);

    if($query->have_posts()){
        while($query->have_posts()){
            $query->the_post();

            get_template_part('template-parts/photo-block');
        }
        wp_reset_postdata();
    } else {
        echo 'Aucune photo correspondant aux critères de filtrage.';
    }

    die();
}


add_action('wp_ajax_nopriv_photo_filter', 'photo_filter');
add_action('wp_ajax_photo_filter', 'photo_filter');

// bouton charger plus
function load_more_photos() {
   $paged = $_POST['page'];

   $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 12, // Nombre de photos à charger par page
      'paged' => $paged,
   );

   $query = new WP_Query($args);

   if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
      get_template_part('template-parts/photo-block'); 
      endwhile;
   endif;

   wp_reset_postdata();

   die();
}

add_action('wp_ajax_load_more_photos', 'load_more_photos');
add_action('wp_ajax_nopriv_load_more_photos', 'load_more_photos');