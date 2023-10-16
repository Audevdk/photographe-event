<?php
add_action('wp_enqueue_scripts', 'theme_enqueue_style');

function theme_enqueue_style()
{
  wp_enqueue_style('montheme-style', get_template_directory_uri() . '/style.css');
  
}

function register_my_menu() {
  register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );