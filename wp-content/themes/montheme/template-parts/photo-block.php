<?php
        $current_category = get_the_terms(get_the_ID(), 'categorie'); // Obtenez la catégorie actuelle
        $args = array(
            'post_type' => 'photo',
            'post__not_in' => array(get_the_ID()),
            'posts_per_page' => 2,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'id',
                    'terms' => $current_category[0]->term_id, // Utilisez la catégorie actuelle
                ),
            ),
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
        ?>
                <div class="overlay-imageSingle">
                    <?php the_content(); ?>
                    <div class="hoverSingle">
                    <a href="#">
                        <img class="full_screen" data-category="<?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie')); ?>" data-reference="<?php echo get_field('reference', get_the_ID()); ?>" data-image="<?php echo get_the_post_thumbnail_url(); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/Icon_fullscreen.png" alt="full_screen">
                    </a>                        <a href="<?php the_permalink(); ?>">
                            <img class="eye" src="<?php echo get_template_directory_uri(); ?>/assets/Icon_eye.png" alt="eye">
                        </a>
                        <div class="texte">
                        <div class="ref-box"><?php echo get_field('reference', $post->ID); ?></div>
                        <div class="cat-box"><?php echo strip_tags(get_the_term_list($post->ID, 'categorie')); ?></div>
                        </div>
                    </div>
                </div>
        <?php endwhile;
        endif;
        wp_reset_query();
        ?>

