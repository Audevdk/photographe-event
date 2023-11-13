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
  wp_enqueue_script( 'jquery' ); // jQuery is included by default
  wp_enqueue_script( 'script', get_template_directory_uri() . '/script.js', array( 'jquery' ), '1.0', true );

  // Enqueue Ajax Filters script
  wp_enqueue_script( 'ajax-filters', get_template_directory_uri() . '/ajax-filters.js', array( 'jquery' ), '1.0', true );
  wp_localize_script( 'ajax-filters', 'ajax_filters', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'montheme_enqueue_styles_and_scripts' );

function photo_filter() {
  error_log('Fonction appelée');

  // Récupérez les valeurs des filtres à partir de $_POST
  $selected_category = $_POST['category'] ?? '';
  $selected_format = $_POST['format'] ?? '';
  $selected_annee = $_POST['annee'] ?? '';
  error_log('catégorie : ' . $selected_category);
  error_log('format : ' . $selected_format);
  error_log('année : ' . $selected_annee);

  // Construisez votre requête WP_Query en fonction des valeurs des filtres
  $args = array(
      'post_type' => 'photo', 
      'tax_query' => array(
          'relation' => 'AND',
          array( 
              'taxonomy' => 'categorie',
              'field'    => 'slug',
              'terms'    => ($selected_category == '' ? get_terms('category', array('fields' => 'slugs')) : $selected_category),
          ),
          array( 
              'taxonomy' => 'annee_taxonomy',  // Assurez-vous que c'est le bon nom de la taxonomie
              'field'    => 'slug',
              'terms'    => $selected_annee,
          ),
      ),
  );

  // Exécutez la requête
  $query = new WP_Query($args);
  ob_start();  
  if ($query->have_posts()) :
      while ($query->have_posts()) :
          $query->the_post();
          ?>
        <?php get_template_part('template-parts/photo-block'); ?>
          <?php
      endwhile;
  endif;

  // Retournez le contenu en cache
  $response = array(
      'images' => ob_get_clean(),
  );

  // Envoyez la réponse JSON
  header('Content-Type: application/json');
  echo json_encode($response);

  // Terminez le processus WordPress
  wp_die();
}

add_action('wp_ajax_nopriv_photo_filter', 'photo_filter');
add_action('wp_ajax_photo_filter', 'photo_filter');
