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
$_SESSION['selected_images'] = isset($_SESSION['selected_images']) ? $_SESSION['selected_images'] : array();

get_header();
?>

<style>
.modal {
  display: none;
  position: fixed; 
  z-index: 1000;
  padding-top: 50px; 
  left: 0;
  top: 0;
  width: 100%; 
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0); 
  background-color: rgba(0,0,0,0.3);
}

.modal-content {
  margin: auto;
  display: block;
  text-align: center;
  width: 80%;
  max-width: 700px;
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.modal-content button {
  margin-top: 20px;
}

button:hover {
    cursor: pointer;
}
</style>

<h2>Gallery</h2>
<p>*We work on a commission system. Explore the gallery and use them as a reference.</p>

<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <div class="modal-content">
    <img class="modal-content" id="modalImage">
    <button>Add To Cart</button>
  </div>
</div>

<div id="category-filter">
  <h3>Filter by Category</h3>
  <div>
    <?php
    $categories = get_categories();
    foreach ($categories as $category) {
      echo '<input type="checkbox" id="' . $category->slug . '" name="' . $category->slug . '" value="' . $category->slug . '"> <label for="' . $category->slug . '">' . $category->name . '</label>';
    }
    ?>
  </div>
</div>

<?php
$category_slug = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

$args = array(
    'post_type' => 'product-gallery',
    'posts_per_page' => -1,
    'order' => 'DESC',
);

if (!empty($category_slug)) {
  $args['tax_query'] = array(
      array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => explode(',', $category_slug), 
      ),
  );
}

$custom_query = new WP_Query( $args );

if ($custom_query->have_posts()) {
  while ($custom_query->have_posts()) {
      $custom_query->the_post();
      $post_categories = get_the_category();
      $category_classes = '';
      foreach ($post_categories as $category) {
          $category_classes .= ' category-' . $category->slug;
      }
      
      ?>
      <div class="entry-content<?php echo $category_classes; ?>"> 
          <?php the_content(); ?>
          <?php if (has_post_thumbnail()) : ?>
              <div class="featured-image">
                  <img class="gallery-image" src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
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

<script>
var modal = document.getElementById("myModal");
var img = document.getElementsByClassName("gallery-image");
var modalImg = document.getElementById("modalImage");
var addToCartButton = document.querySelector(".modal-content button");
var checkboxes = document.querySelectorAll("#category-filter input[type='checkbox']");

document.addEventListener("DOMContentLoaded", function() {
    const checkboxes = document.querySelectorAll("#category-filter input[type='checkbox']");
    
    // Update checkboxes based on the category parameter in the URL
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    if (categoryParam) {
        const selectedCategories = categoryParam.split(',');
        selectedCategories.forEach(category => {
            const checkbox = document.getElementById(category);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }
    
    // Add event listener to each checkbox
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function(event) {
            filterPosts(); // Call filterPosts when checkbox state changes
            updateURL(); // Update URL based on selected categories
        });
    });

    // Call filterPosts initially to apply filtering based on category parameter
    filterPosts();

    function filterPosts() {
        var selectedCategories = [];
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedCategories.push(checkbox.value);
            }
        });

        var posts = document.querySelectorAll('.entry-content');
        posts.forEach(function(post) {
            var postCategories = post.classList;
            var display = 'none';
            if (selectedCategories.length === 0) {
                display = 'block';
            } else {
                selectedCategories.forEach(function(category) {
                    if (postCategories.contains('category-' + category)) {
                        display = 'block'; 
                    }
                });
            }
            post.style.display = display;
        });
    }

    function updateURL() {
        var selectedCategories = [];
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedCategories.push(checkbox.value);
            }
        });
        var url = window.location.href.split('?')[0];
        if (selectedCategories.length > 0) {
            url += '?category=' + selectedCategories.join(',');
        } else {
            // If no categories are selected, remove the category parameter from the URL
            url = window.location.pathname;
        }
        window.history.replaceState(null, null, url);
    }

});






// ********************* Modal + Add to Cart ******************************** \\
for (var i = 0; i < img.length; i++) {
  img[i].onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
  }
}

addToCartButton.onclick = function() {
  var imageUrl = modalImg.src;
  var selectedImages = JSON.parse(sessionStorage.getItem('selected_images')) || [];
  selectedImages.push(imageUrl);
  sessionStorage.setItem('selected_images', JSON.stringify(selectedImages));
  alert("Image added to references.");
};

var span = document.getElementsByClassName("close")[0];
span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


<?php get_footer(); ?>
