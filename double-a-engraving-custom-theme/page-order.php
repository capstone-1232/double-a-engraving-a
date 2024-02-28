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

<div>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
    
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php
                    acf_form(array(
                        'post_id'       => 'new_post',
                        'new_post'      => array(
                            'post_type'   => 'post',
                            'post_status' => 'publish'
                        ),
                        'submit_value'  => false,
                        'field_groups'  => array('group_65df948748c23')
                    ));
                    ?>
                    <div class="order">
                        <?php
                        acf_form(array(
                            'post_id'       => 'new_post',
                            'new_post'      => array(
                                'post_type'   => 'post',
                                'post_status' => 'publish'
                            ),
                            'submit_value'  => false,
                            'field_groups'  => array('group_65df95adbdaa1')
                        ));
                        ?>
                        <button id="addFieldGroupButton">Add Field Group</button>
                    </div>
                </div>
            </article>
    
        </main>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var addFieldGroupButton = document.getElementById("addFieldGroupButton");
            var entryContent = document.querySelector(".order");
            var counter = 0;
    
            addFieldGroupButton.addEventListener("click", function() {
                counter++;
    
                if (counter === 1) {
                    var clonedFieldGroup = entryContent.querySelector(".acf-form").cloneNode(true);
                    entryContent.insertBefore(clonedFieldGroup, addFieldGroupButton);
                }
            });
        });
    </script>
</div>

<?php get_footer() ?>