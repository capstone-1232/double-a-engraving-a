<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package double-a-engraving-custom-theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php double_a_engraving_custom_theme_post_thumbnail(); ?>

	<div class="entry-content">

	<?php 
		$args = array(
			'post_type' => 'main-featured', 
			'posts_per_page' => -1,
			'order' => 'DESC',
		);

		
		$custom_query = new WP_Query( $args );

		if ( $custom_query->have_posts() ) {
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				?>
				<h2><?php the_title(); ?></h2>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php the_excerpt() ?>
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

<?php 
		$args = array(
			'post_type' => 'secondary-featured', 
			'posts_per_page' => 2,
			'order' => 'DESC',
		);

		
		$custom_query = new WP_Query( $args );

		if ( $custom_query->have_posts() ) {
			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				?>
				<h2><?php the_title(); ?></h2>
				<div class="entry-content">
					<?php the_content(); ?>
					<?php the_excerpt() ?>
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




		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'double-a-engraving-custom-theme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	
</article><!-- #post-<?php the_ID(); ?> -->
