<?php
function theme_enqueue_style()
{
  wp_enqueue_style('montheme-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_style');