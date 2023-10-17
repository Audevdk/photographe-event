<footer id="footer" class="footer">
<?php 
wp_nav_menu(
  array(
    'theme_location' => 'footer',
    'container'=> 'ul', //evite la div
    'menu_class'=> 'footer-menu', //ajout d'une classe personnalisée
));?>
<p>TOUS DROITS RESERVES</p>


<?php get_template_part('<template-parts/modale');?>
<?php wp_footer() ?>
</footer>
</body>
</html>