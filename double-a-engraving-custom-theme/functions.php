<?php
/**
 * double-a-engraving-custom-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package double-a-engraving-custom-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function double_a_engraving_custom_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on double-a-engraving-custom-theme, use a find and replace
		* to change 'double-a-engraving-custom-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'double-a-engraving-custom-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'double-a-engraving-custom-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'double_a_engraving_custom_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'double_a_engraving_custom_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function double_a_engraving_custom_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'double_a_engraving_custom_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'double_a_engraving_custom_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function double_a_engraving_custom_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'double-a-engraving-custom-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'double-a-engraving-custom-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'double_a_engraving_custom_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function double_a_engraving_custom_theme_scripts() {
	wp_enqueue_style( 'double-a-engraving-custom-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'double-a-engraving-custom-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'double-a-engraving-custom-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'double_a_engraving_custom_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function enqueue_custom_styles() {
    // Enqueue the stylesheet
    wp_enqueue_style('custom-styles', get_template_directory_uri() . '/css/styles.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');





add_action('admin_post_custom_contact_form', 'handle_custom_contact_form');
add_action('admin_post_nopriv_custom_contact_form', 'handle_custom_contact_form');

function handle_custom_contact_form() {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $message = sanitize_textarea_field($_POST['message']);
    $materials = sanitize_text_field($_POST['materials']);
    $finish = sanitize_text_field($_POST['finish']);
    $deliver = sanitize_text_field($_POST['deliver']);

    $to = 'speedybatm12@gmail.com';
    $subject = 'New Custom Form Submission';
    $body = "Name: $name<br>Email: $email<br>Phone: $phone<br>Message: $message<br>Materials: $materials<br>Finish: $finish<br>Delivery Method: $deliver";

    $attachments = array();

    if (!empty($_FILES['reference']['tmp_name'])) {
        $reference = $_FILES['reference'];
        $upload_overrides = array('test_form' => false);
        $movefile = wp_handle_upload($reference, $upload_overrides);
        if ($movefile && !isset($movefile['error'])) {
            $attachment = $movefile['file'];
            $attachments[] = $attachment;
        }
    }

    if (isset($_POST['selectedImages']) && is_array($_POST['selectedImages'])) {
        $upload_dir = wp_upload_dir();
        $temp_dir = $upload_dir['basedir'] . '/custom_contact_temp/';

        if (!file_exists($temp_dir)) {
            mkdir($temp_dir, 0755, true);
        }

        foreach ($_POST['selectedImages'] as $imageUrl) {
            // Copy the image to the temporary directory
            $image_path = str_replace(home_url(), ABSPATH, $imageUrl);
            $image_name = basename($image_path);
            $copied_image_path = $temp_dir . $image_name;

            if (copy($image_path, $copied_image_path)) {
                $attachments[] = $copied_image_path;
            }
        }
    }

    $headers = array('Content-Type: text/html; charset=UTF-8');

    $result = wp_mail($to, $subject, $body, $headers, $attachments);

    // Cleanup temporary files
    foreach ($attachments as $attachment) {
        @unlink($attachment);
    }

    if ($result) {
        echo '<p>Message sent successfully!</p>';
    } else {
        echo '<p>Failed to send message. Please try again later.</p>';
    }
    exit;
}




