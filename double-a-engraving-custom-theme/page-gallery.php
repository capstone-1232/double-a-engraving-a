<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package double-a-engraving-custom-theme
 */

get_header();
?>

<h2>Gallery</h2>
<p>*We work on a commission system. Explore the gallery and use them as an refernce.</p>

<?php 
		$args = array(
			'post_type' => 'product-gallery',
			'posts_per_page' => -1,
			'order' => 'DESC',
		);

		
		$custom_query = new WP_Query( $args );

		if ( $custom_query->have_posts() ) {
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				?>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="featured-image">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>
				</div>
				<?php
			}
		} else {
			echo 'No posts found';
		}

		wp_reset_postdata();
?>

<?php get_footer() ?>