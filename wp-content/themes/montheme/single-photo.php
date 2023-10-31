<?php
/* 
Template Name: CPT perso photos
*/
?>
<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        while (have_posts()):
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
                <header class="entry-header ">
                    <h2>
                        <?php the_title(); ?> <!-- Affiche le titre de l'article -->
                    </h2>
                </header>
                <div class="description-photo">
                <div class="photo-container">
                            <?php the_post_thumbnail('full'); ?> <!-- Affiche l'image à la taille "medium" -->
                            </div>
                    <div class="entry-content">
                        
                        <p><strong>Référence :</strong>
                            <?php echo get_field('reference_photo'); ?> <!-- Affiche le champ "reference" du CPT -->
                        </p>
                        <?php
                        $categories = get_the_terms(get_the_ID(), 'categorie');
                        if ($categories && !is_wp_error($categories)) {
                            echo '<p><strong>Categories :</strong> ';
                            foreach ($categories as $category) {
                                echo $category->name . ' '; // Affiche les catégories du CPT
                            }
                            echo '</p>';
                        }
                        ?>

                        <?php
                        $formats = get_the_terms(get_the_ID(), 'format');
                        if ($formats && !is_wp_error($formats)) {
                            echo '<p><strong>Formats :</strong> ';
                            foreach ($formats as $format) {
                                echo $format->name . ' '; // Affiche les formats du CPT
                            }
                            echo '</p>';
                        }
                        ?>
                        <p><strong>Type :</strong>
                            <?php echo get_field('type'); ?> <!-- Affiche le champ "type" du CPT -->
                        </p>
                        <p><strong>Année :</strong>
                            <?php echo get_the_date('Y'); ?> <!-- Affiche le champ "annee" du CPT -->
                        </p>
</div>

                      

                        <?php the_content(); ?> <!-- Affiche le contenu de l'article -->
                        </div>
                        <section class="section_post_contact_nav">
                <div class="post_contact_text">
                    <p>Cette photo vous intéresse ?</p>
                        <button class="open-popup"
                            data-reference="<?php echo esc_attr(get_field('reference')); ?>">Contact</button>
                    

                    <!-- Ajout des miniatures et boutons de pagination -->
                    <div class="pagination-container">
                        
                        <?php
                        $previous_photo = get_previous_post(); 
                        $next_photo = get_next_post(); 
                        ?>

                        <?php if ($previous_photo): ?>

                            <a href="<?php echo get_permalink($previous_photo->ID); ?>"
                                class="previous-photo thumbnail-preview">
                               
                                <span class="pagination-label">&larr;</span>
                           
                                <?php echo get_the_post_thumbnail($previous_photo->ID, 'thumbnail'); ?>
                                
                            </a>
                        <?php endif; ?>

                        <?php if ($next_photo): ?> <!--  vérifie si un article suivant existe -->
                            <a href="<?php echo get_permalink($next_photo->ID); ?>" class="next-photo thumbnail-preview">
                                <!--  lien vers l'article suivant  -->
                                <span class="pagination-label">&rarr;</span>
                                <!-- Affiche une fleche pointant vers la droite -->
                                <?php echo get_the_post_thumbnail($next_photo->ID, 'thumbnail'); ?>
                                <!-- Affiche la miniature de l'article suivant avec la taille "thumbnail" -->
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php get_template_part('templates_parts/photo_block'); ?>
                    <!-- Inclut le template pour les photos apparentées -->
            </article>
            <section class="section_post_other_imgs">
                <div class="post_other_text">
                    <h3>Vous aimerez aussi</h3>
                </div>
                <article class="post_other_imgs_container">
                    <?php
                    // Category recovery 
                    $current_category = get_field('categories');
                    // definition of arguments
                    $args = array(
                        'post_type' => 'photo',
                        'posts_per_page' => 2,
                        'post__not_in' => [get_the_ID()],
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'categorie',
                                'field'    => 'slug',
                                'terms' => $current_category,
                            ),
                        ),
                    );
                    // Définition / Execution of wp query
                    $query = new WP_Query($args);
                    // Wp query execution loop
                    while ($query->have_posts()) : $query->the_post();
                        $post_url = get_permalink();
                    ?>
                        <!-- Template Post Card -->
                        <?php get_template_part('template-parts/photo_block'); ?>
                    <?php endwhile;
                    wp_reset_postdata() ?>
                </article>
            </section><!-- .section_post_other_imgs -->
            <section class="section_btn_load_all_imgs">
                <div class="btn_load_all_imgs">
                    <span>Toutes les Photos</span>
                </div>
            </section><!-- section_btn_load_all_imgs -->
        </main><!-- #main_single_photo_page -->
<?php endwhile;
 ?>

<?php get_footer(); ?> <!-- Inclut le footer -->

</body>

</html> <!-- Fin du document HTML -->             

                     

                  

  