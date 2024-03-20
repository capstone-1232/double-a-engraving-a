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

session_start();
$selectedImages = isset($_SESSION['selected_images']) ? $_SESSION['selected_images'] : array();

get_header();
?>
<div id="imageContainer"></div>

<script>
const selectedImagesJSON = sessionStorage.getItem('selected_images');
const selectedImages = JSON.parse(selectedImagesJSON);

const imageContainer = document.getElementById('imageContainer');

selectedImages.forEach(imageUrl => {
    if (imageUrl !== 'undefined') {
        const img = document.createElement('img');
        img.src = imageUrl;
        img.alt = 'Image';
        imageContainer.appendChild(img);
    }
});
</script>


<?php get_footer() ?>
