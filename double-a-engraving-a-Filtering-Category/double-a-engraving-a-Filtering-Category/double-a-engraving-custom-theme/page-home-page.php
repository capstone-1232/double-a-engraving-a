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
<div class="banner bg-image">
    <div class="banner-logo">
        <?php the_custom_logo(); ?>

        <p>Timeless art for you and your special ones</p>

        <?php
        $page = get_page_by_path('gallery');
        if ($page) {
            $page_id = $page->ID;
        } else {
        }
        ?>
        <a href="<?php echo esc_url(get_permalink($page_id)); ?>" class="button shadow">Explore Gallery</a>
    </div>

    <div class="banner-aboutme">
        <p>Hello friends, it's <span>Allan Anderson</span></p>
        <p>I wanted to share some exciting news with you. After spending two decades as an instructor at NAIT, teaching IT courses, I've decided to retire and pursue my passion of custom laser wood engravings. Began as a simple hobby, crafting gifts, plaques, and keepsakes for my loved ones. Now, I'm thrilled to say that I am the proud owner of Double A Engraving. I can't wait to collaborate with you and create something truly special together!</p>

        <?php
        $page = get_page_by_path('about-me');
        if ($page) {
            $page_id = $page->ID;
        } else {
        }
        ?>
        <div>
            <a href="<?php echo esc_url(get_permalink($page_id)); ?>" class="button shadow">Learn More</a>
        </div>
    </div>
</div>


<h2>Gallery</h2>
<p>So, feel free to explore and discover the wonders of my craft.</p>

<?php
$args = array(
    'post_type' => 'main-featured',
    'posts_per_page' => -1,
    'order' => 'DESC',
);


$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) {
    while ($custom_query->have_posts()) {
        $custom_query->the_post();
        ?>
        <h2><?php the_title(); ?></h2>
        <div class="entry-content">
            <h3><?php the_content(); ?></h3>
            <div class="flex">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <p><?php the_excerpt() ?></p>
                    <?php
                    $category = get_the_category();
                    if ($category) {
                        $category_slug = $category[0]->slug;
                    } else {
                        $category_slug = '';
                    }
                    $page = get_page_by_path('gallery');
                    if ($page) {
                        $page_id = $page->ID;
                    } else {
                    }
                    ?>
                    <div>
                        <a href="<?php echo esc_url(get_permalink($page_id) . '?category=' . $category_slug); ?>"
                           class="button shadow">Gallery</a>
                    </div>
                </div>
            </div>
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


$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) {
    while ($custom_query->have_posts()) {
        $custom_query->the_post();
        ?>
        <h2><?php the_title(); ?></h2>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image">
                    <?php the_post_thumbnail(); ?>
                </div>
            <?php endif; ?>
            <div>
                <p><?php the_excerpt() ?></p>
                <?php
                $category = get_the_category();
                if ($category) {
                    $category_slug = $category[0]->slug;
                } else {
                    $category_slug = '';
                }
                $page = get_page_by_path('gallery');
                if ($page) {
                    $page_id = $page->ID;
                } else {
                }
                ?>
                <div>
                    <a href="<?php echo esc_url(get_permalink($page_id) . '?category=' . $category_slug); ?>"
                       class="button shadow">Gallery</a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    echo 'No posts found';
}

wp_reset_postdata();
?>


<div>
    <h2>Come Find Me !</h2>
    <p>At these AFMA approved markets</p>
</div>


<?php
$args = array(
    'post_type' => 'location',
    'posts_per_page' => -1,
);


$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) {
    while ($custom_query->have_posts()) {
        $custom_query->the_post();
        ?>
        <h2><?php the_title(); ?></h2>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php the_excerpt() ?>
        </div>
        <?php
    }
} else {
    echo 'No posts found';
}

wp_reset_postdata();
?>

<?php
get_footer();
?>
