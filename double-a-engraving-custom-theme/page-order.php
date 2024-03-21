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

<form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data"
    id="myForm">
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
    <div id="field">
        <fieldset>
            <legend>Order 1</legend>
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
                    <?php
                    $args = array(
                        'post_type' => 'material',
                        'posts_per_page' => -1,
                    );


                    $custom_query = new WP_Query($args);

                    if ($custom_query->have_posts()) {
                        while ($custom_query->have_posts()) {
                            $custom_query->the_post();
                            ?>
                            <option value="<?php the_title() ?>">
                                <?php the_title(); ?>
                            </option>
                            <?php
                        }
                    } else {
                        echo 'No posts found';
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="finish">Finishes</label>
                <select name="finish" id="finish">
                    <?php
                    $args = array(
                        'post_type' => 'finish',
                        'posts_per_page' => -1,
                    );


                    $custom_query = new WP_Query($args);

                    if ($custom_query->have_posts()) {
                        while ($custom_query->have_posts()) {
                            $custom_query->the_post();
                            ?>
                            <option value="<?php the_title() ?>">
                                <?php the_title(); ?>
                            </option>
                            <?php
                        }
                    } else {
                        echo 'No posts found';
                    }
                    ?>
                </select>
            </div>
        </fieldset>
    </div>
    <button type="button" id="addOrder" onclick="cloneFieldset()">Add Another Order</button>
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
    var x = 1;
    function cloneFieldset() {
        var fieldsets = document.querySelectorAll('fieldset');

        if (fieldsets.length > 0) {
            var clonedFieldset = fieldsets[0].cloneNode(true);

            clonedFieldset.querySelectorAll('input[type="file"], input[type="text"], textarea, select, input[type="checkbox"]').forEach(function (element) {
                if (element.type === 'checkbox') {
                    element.checked = false;
                } else if (element.tagName === 'SELECT') {
                    element.selectedIndex = 0;
                } else {
                    element.value = '';
                }
            });

            clonedFieldset.querySelector('legend').textContent = 'Order ' + (fieldsets.length + 1);

            clonedFieldset.querySelectorAll('[id], [for], [name]').forEach(function (element) {
                var originalId = element.getAttribute('id');
                var originalFor = element.getAttribute('for');
                var originalName = element.getAttribute('name');

                if (originalId) {
                    element.setAttribute('id', originalId + '_' + x);
                }
                if (originalFor) {
                    element.setAttribute('for', originalFor + '_' + x);
                }
                if (originalName) {
                    element.setAttribute('name', originalName + '_' + x);
                }
            });

            document.getElementById('field').appendChild(clonedFieldset);

            x++;

            if (fieldsets.length > 0) {
                var removeButton = document.createElement('button');
                removeButton.textContent = 'Remove Order';
                removeButton.type = 'button';
                removeButton.onclick = function () {
                    this.parentNode.remove();
                };
                clonedFieldset.appendChild(removeButton);
            }
        }
    }






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