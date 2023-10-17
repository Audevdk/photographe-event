<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital@0;1&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Space+Mono:ital@0;1&display=swap" rel="stylesheet">
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