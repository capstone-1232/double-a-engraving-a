<?php
/**
 * Template Name: Custom Form Template
 *
 * This template is used to display a custom form.
 *
 * @package double-a-engraving-custom-theme
 */

 session_start();
 $selectedImages = isset ($_SESSION['selected_images']) ? $_SESSION['selected_images'] : array();
 

get_header();
?>

<form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data">
    <input type="hidden" name="action" value="custom_contact_form">
    <div>
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="phone">Phone Number:</label>
        <input type="tel" name="phone" id="phone">
    </div>
    <div>
        <label for="reference">Upload Image</label>
        <input type="file" name="reference" id="reference">
    </div>
    <div>
        <p>Select image(s):</p>
        <div class="imageContainer">
            <?php foreach ($selectedImages as $imageUrl) { ?>
                <label class="imageCheckbox">
                    <input type="checkbox" name="selectedImages[]" value="<?php echo $imageUrl; ?>">
                    <img src="<?php echo $imageUrl; ?>" alt="Image">
                </label>
            <?php } ?>
        </div>
    </div>
    <div>
        <label for="message">Message:</label>
        <textarea name="message" id="message" rows="5"></textarea>
    </div>
    <div>
        <label for="materials">Materials</label>
        <select name="materials" id="materials">
            <option value="oak-Wood">Oak Wood</option>
            <option value="metal">Metal</option>
            <option value="glass">Glass</option>
            <option value="mirror">Mirror</option>
        </select>
    </div>
    <div>
        <label for="finish">Finishes</label>
        <select name="finish" id="finish">
            <option value="wax">Wax</option>
            <option value="oil">Oil</option>
            <option value="stain">Stain</option>
            <option value="dye">Dye</option>
        </select>
    </div>
    <div>
        <label for="deliver">Delivery Method</label>
        <select name="deliver" id="deliver">
            <option value="delivery">Delivery</option>
            <option value="pickup">Pickup</option>
            <option value="mail">Mail</option>
        </select>
    </div>
    <div>
        <input type="submit" id="submit" name="submit" value="Submit">
    </div>
</form>

<div id="contact-form-message"></div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectedImagesJSON = sessionStorage.getItem('selected_images');
        const selectedImages = JSON.parse(selectedImagesJSON);

        const imageContainer = document.querySelector('.imageContainer');

        selectedImages.forEach(imageUrl => {
            if (imageUrl !== 'undefined') {
                const label = document.createElement('label');
                label.classList.add('imageCheckbox');
                label.innerHTML = `
                    <input type="checkbox" name="selectedImages[]" value="${imageUrl}">
                    <img src="${imageUrl}" alt="Image">
                `;
                imageContainer.appendChild(label);
            }
        });
    });
</script>

<?php get_footer(); ?>