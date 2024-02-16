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

<h3>About Me</h3>

<?php if (has_post_thumbnail()): ?>
    <div class="featured-image">
        <?php the_post_thumbnail(); ?>
    </div>
<?php endif; ?>

<p>Allan Anderson, the mastermind behind our one-of-a-kind wood engraving venture, brings a wealth of experience and
    enthusiasm to his craft. After an illustrious career as a respected instructor in the Digital Media and IT (DMIT)
    program at NAIT, spanning more than two decades, Allan retired in December 2022. Throughout his career, he has
    always been at the forefront of technology and education, making him a true visionary.</p>

<?php $page = get_page_by_path('gallery');
if ($page) {
    $page_id = $page->ID;
} ?>
<a href="<?php echo esc_url(get_permalink($page_id)); ?>" class="button">See My Work</a>

<p>Before delving into the world of craftsmanship and artistry, Allan had a distinguished tenure in the Canadian Armed Forces as an aircraft technician with the 408 Tactical Helicopter Squadron, primarily stationed in Edmonton. This background in the military has instilled in him a sense of discipline and dedication that he carries into his work today.</p>

<p>Beyond his professional achievements, Allan's personal interests are as diverse as his career. He has a passion for photography, although he humbly considers himself a novice in the field. Additionally, he embraces the physical challenge of running, having completed four half marathons and numerous shorter runs. Since relocating to Edmonton proper in July 2022, after residing in the Edmonton area since July 1991, Allan has discovered a new passion in laser engraving.</p>

<p>What initially began as a hobby shortly before retiring from NAIT has now flourished into a thriving business. Operating from his home, Allan's small enterprise has made a significant impact, selling custom engraved products at various farmers' markets throughout Edmonton. His journey is a testament to his unwavering commitment to learning, growth, and creativity, making his work not just a business, but a reflection of a life well-lived.</p>


<?php get_footer() ?>