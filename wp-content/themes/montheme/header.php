<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>

</head>
<body <?php body_class(); ?>>
    
   
  <header class="header">
  <img class="logo" src="<?php echo get_template_directory_uri();?>/assets/Logo.png" alt="logo">
  <?php 
wp_nav_menu(
  array(
    'theme_location' => 'main',
    'container'=> 'ul', //evite la div
    'menu_class'=> 'header-menu', //ajout d'une classe personnalisée
));?>

</header>
<?php wp_body_open(); ?>