<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package double-a-engraving-custom-theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<div>
			<h3>Contact Me</h3>
			<p>Phone : (587)-999-777</p>
			<p>Email : info@doubleaengraving.com</p>
			<h3>Fellow Us</h3>
			<a href="https://example.com/facebook" target="_blank"><img src="https://cdn3.iconfinder.com/data/icons/picons-social/57/46-facebook-512.png" alt="Facebook" style="width: 4rem;"></a>
			<a href="https://example.com/instagram" target="_blank"><img src="https://cdn4.iconfinder.com/data/icons/picons-social/57/38-instagram-2-256.png" alt="instagram" style="width: 4rem;"></a>
			</div>
			<div>
				<h3>Menu</h3>
				<?php $page = get_page_by_path('home-page');
					if ($page) { $page_id = $page->ID; } ?>
				<a href="<?php echo esc_url( get_permalink( $page_id ) ); ?>" class="button">Home</a>

				<?php $page = get_page_by_path('about-me');
					if ($page) { $page_id = $page->ID; } ?>
				<a href="<?php echo esc_url( get_permalink( $page_id ) ); ?>" class="button">About Me</a>

				<?php $page = get_page_by_path('gallery');
					if ($page) { $page_id = $page->ID; } ?>
				<a href="<?php echo esc_url( get_permalink( $page_id ) ); ?>" class="button">Gallery</a>

				<?php $page = get_page_by_path('commission-info');
					if ($page) { $page_id = $page->ID; } ?>
				<a href="<?php echo esc_url( get_permalink( $page_id ) ); ?>" class="button">Commission</a>

				<?php $page = get_page_by_path('my-references');
					if ($page) { $page_id = $page->ID; } ?>
				<a href="<?php echo esc_url( get_permalink( $page_id ) ); ?>" class="button">My References</a>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
