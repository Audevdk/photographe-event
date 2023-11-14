
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

        <select name="category" id="category-filter">
            <option value=""  selected>Catégories</option>

            <?php
                        $categories = get_terms(array(
                            "taxonomy" => "categories",
                            "hide_empty" => false,
                        ));
                        foreach ($categories as $categorie) {
                            echo '<option value="' . $categorie->slug . '">' . $categorie->name . '</option>';
                        }
                        ?>
        </select>
   

    


        <select name="format" id="format-filter">
            <option value=""  selected>Formats</option>
<?php
            $formats = get_terms(array(
                            "taxonomy" => "formats",
                            "hide_empty" => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
                        }
                        ?>
        </select>
  

                
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
