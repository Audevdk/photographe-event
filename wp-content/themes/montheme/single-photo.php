<?php
/* 
Template Name: CPT perso photos
*/
?>

<?php get_header(); ?>
<main class="main_single">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="photo">
				<div class="info-photo">

					<h1 class="photo-title"><?php the_title(); ?></h1>
					<p>Référence : <span id="ref-photo"> <?php echo get_field('reference_photo'); ?></span></p>
					<p>Categorie : <?php echo strip_tags(get_the_term_list($post->ID, 'categorie')); ?></p>
					<p>Format : <?php echo strip_tags(get_the_term_list($post->ID, 'format')); ?></p>
					<p>Type : <?php echo get_field('type'); ?></p>
					<p>Année :<?php the_date(' Y'); ?></p>

				</div>
				<div class="photo-content">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="partie_2">

				<p><h3>Cette photo vous intéresse ?</h3>
					<input type="button" value="Contact" id="modaleContactSingle">

				</p>

				<div class="site-navigation ">

					<div class="site-navigation-prev">
						<?php
						$prev_post = get_previous_post();
						if ($prev_post) {
							$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
							$prev_post_id = $prev_post->ID;
							echo '<a rel="prev" href="' . get_permalink($prev_post_id) . '" title="' . $prev_title . '" class="previous_post">';

						?>
							<div><?php echo get_the_post_thumbnail($prev_post_id); ?></div>
						<?php

						echo '<img class="flecheGauche" src="' . get_stylesheet_directory_uri() . '/assets/Line7.png" alt="fleche_gauche" ></a>';
						}
						?>
					</div>
					<div class="img-card dynamic-image"><?php the_post_thumbnail(); ?></div>
					<div class="site-navigation-next">

						<?php
						$next_post = get_next_post();
						if ($next_post) {
							$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
							$next_post_id = $next_post->ID;
							echo  '<a rel="next" href="' . get_permalink($next_post_id) . '" title="' . $next_title . '" class="next_post">';

						?>
							<div><?php echo get_the_post_thumbnail($next_post_id); ?></div>
						<?php

						echo '<img  src="' . get_stylesheet_directory_uri() . '/assets/Line6.png" alt="fleche_droit" ></a>';
						}
						?>

					</div>
				</div>
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
	<div class="partie_3">
		<h2>VOUS AIMEREZ AUSSI</h2>
		<div id="photosapp">
			<?php get_template_part('template-parts/photo-block', get_post_format()); ?>
		</div>
		<a href="<?php echo home_url() ?>"><button id="lienAcc">Toutes les photos </button></a>
	</div>

</main>

<?php get_footer(); ?>