<?php


function register_my_menu() {
  register_nav_menus( array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
  ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );


add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_enqueue_styles()
{
  wp_enqueue_style('montheme-style', get_template_directory_uri() . '/style.css');
  wp_enqueue_script('script',get_template_directory_uri().'/script.js', array('jquery'),'1.0', true );
 
}

/** Fonction pour afficher les options de catégorie pour le filtrage **/
function filtreCategorie()
{
	if ($terms = get_terms(array(
		'taxonomy' => 'categorie',
		'field'    => 'slug',
		'terms'    => $_POST['category'],
	)))
		foreach ($terms as $term) {
			echo '<option  value="' . $term->slug . '">' . $term->name . '</option>';
		}
}
/** Fonction pour afficher les options de format pour le filtrage **/
function filtreFormat()
{
	if ($terms = get_terms(array(
		'taxonomy' => 'format',
		'field'    => 'slug',
		'terms'    => $_POST['post_format'],
	)))
		foreach ($terms as $term) {
			echo '<option  value="' . $term->slug . '">' . $term->name . '</option>';
		}
}
/** Fonction pour afficher les options de tri pour le filtrage **/
function filtreOrderDirection()
{
	if ($order_options = (array(
		'DESC' => 'Nouveautés',
		'ASC' => 'Les plus anciens',
	)))
		foreach ($order_options as $value => $label) {
			echo "<option " . selected($_POST['tri'], $value) . " value='$value'>$label</option>";
		}
}
