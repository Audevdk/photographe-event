<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
  wp_enqueue_style('montheme-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_script('script',get_template_directory_uri().'/script.js', array('jquery'),'1.0', true );
}


function register_my_menu() {
  register_nav_menus( array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
  ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );
