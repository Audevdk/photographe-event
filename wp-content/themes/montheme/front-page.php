<?php
/*
Template Name: Front-Page Template
*/

get_header();
?>
<div class="filtres">
    <div>
        <select name="cat" id="categFiltre">
            <option value="all">Catégorie</option>
            <?php echo filtreCategorie(); ?>
        </select>
    </div>
    <div>
        <select name="form" id="formFiltre">
            <option value="all">Formats</option>
            <?php echo filtreFormat(); ?>
        </select>
    </div>
    <div>
        <select name="tri" id="triFiltre">
            <option value="">Trier par</option>
            <?php echo filtreOrderDirection(); ?>
            <option value=""></option>
        </select>
    </div>
</div>
<div class="photos-acc container">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'post__not_in' => array(get_the_ID()),
        'paged' => 1
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();

    ?>
            <div class="overlay-image">

                <?php the_content(); ?>
                <div class="hover">

                    <a href="#">
                        <img class="full_screen" data-category="<?php echo strip_tags(get_the_term_list(get_the_ID(), 'categorie')); ?>" data-reference="<?php echo get_field('reference', get_the_ID()); ?>
                        "data-image="<?php echo get_the_post_thumbnail_url(); ?>" src="<?php echo get_template_directory_uri(); ?>/assets/Icon_fullscreen.png" alt="full_screen">
                    </a>



                    <a href="<?php echo get_the_permalink(get_the_ID()); ?>">
                        <img class="eye" src="<?php echo get_template_directory_uri(); ?>/assets/Icon_eye.png" alt="eye">
                    </a>
                    <div class="texte">
                        <div class="ref-box"><?php echo get_field('reference', $post->ID); ?></div>
                        <div class="cat-box"><?php echo strip_tags(get_the_term_list($post->ID, 'categorie')); ?></div>
                    </div>
                </div>
            </div>
    <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>


<div class="btn__wrapper">
    <input type="button" Value="Charger plus" class="btn btn_loadMore" id="load-more">
</div>
<?php
get_footer();
?>