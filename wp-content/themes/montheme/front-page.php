
<?php
/*
Template Name: Front-Page Template
*/

get_header();
?>
<!-- bannière -->

<section class="hero">
<h1 class="title">PHOTOGRAPHE EVENT</h1>
<?php query_posts(
    array(
        'post_type' => 'photo',
        'showposts' => 1,
        'orderby' => 'rand',
        'terms' => 'paysage',
    )
); ?>
<?php if (have_posts()) :
    while (have_posts()) :
      the_post(); ?>
        <img class="img-hero" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>"> 
<?php endwhile;endif; ?>
</section>

<!-- les filtres -->

<div class="filters-photos">
    
        <div class="filters">

    <?php
        // Récupérer les catégories de la taxonomie 'photo-categories'
        $photo_categories = get_terms( array(
            'taxonomy' => 'categorie',
            'hide_empty' => true,
        ) );
    ?>
    
    <?php if (!empty($photo_categories) && !is_wp_error($photo_categories)) : ?>
        <select name="category" id="category-filter">
            <option value=""  selected>Catégories</option>

            <?php foreach ($photo_categories as $category) : ?>
            <?php if ($category->slug !== 'categories') : ?>
                <option value="<?php echo esc_attr($category->slug); ?>">
                    <?php echo esc_html($category->name); ?>
                </option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>

    <?php
        // Récupérer les termes de la taxonomie 'formats'
        $formats = get_terms( array(
            'taxonomy' => 'format',
            'hide_empty' => true,
        ) );
    ?>

    <?php if (!empty($formats) && !is_wp_error($formats)) : ?>
        <select name="format" id="format-filter">
            <option value=""  selected>Formats</option>

            <?php foreach ($formats as $format) : ?>
            <?php if ($format->slug !== 'formats') : ?>
                <option value="<?php echo esc_attr($format->slug); ?>">
                    <?php echo esc_html($format->name); ?>
                </option>
            <?php endif; ?>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>

                
            </div>
             <!-- création du bouton trier -->
            <select name="annee" id="filter-date" >
            <option value=""  selected>trier par</option>
            <option value="DESC">Plus récent</option>
            <option value="ASC">Plus ancien</option>
        </select>
    </div>


    </div>

<!-- la galerie -->
<section class="galerie-photo">
    
<div class="galerie">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'post__not_in' => array(get_the_ID()),
        'paged' => 1
    );

            $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
        ?>
			<?php get_template_part('template-parts/photo-block', get_post_format()); ?>
		</div>
		<?php endwhile;
        endif;
        wp_reset_query();
        ?>
</div>

<!-- charger plus -->
<div class="load-more-btn">
    <button id="load-more-btn">Charger plus</button>
    </div>
    </section>
<?php
get_footer();
?>
