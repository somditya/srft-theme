<?php
/**
 * Template Name: Faculty
 * Template Post Type: post
 */

get_header();

// Ensure the post object is properly retrieved
$post_id = get_the_ID();
$post = get_post($post_id);

// Get categories of the post
$categories = get_the_category($post_id);

// Optionally get background image from the query string if set
//$bg_image_url = isset($_GET['bg_image']) ? esc_url($_GET['bg_image']) : '';

// Retrieve and filter the post content
$post_content = apply_filters('the_content', $post->post_content);
?>

<div data-scroll-container>
<div style="margin: 15rem auto; max-width: 1250px; padding: 0 20px; box-sizing: border-box; display: flex; flex-wrap: wrap;">
<h1 class="posttitle">
    <?php echo get_the_title(); ?>
</h1>
        <section id="skip-to-content" class="sub-intro">
            <div class="sub-intro-images">
                <div>
                    <img src="<?php echo esc_url(get_field('Faculty-Image')); ?>" 
                         style="width: 100%; height: auto; max-height: 500px; object-fit: contain; border-radius: 8px; margin-bottom: 2rem;" 
                         alt="<?php echo get_the_title(); ?>" />
                </div>
                
            </div>
            <div class="sub-intro-text">
                <div class="sub-intro-text-description">
                    <?php echo wp_kses_post(get_field('Faculty-Bio')); ?>
                </div>
            </div>
        </section>

    </div>
</div>

<?php get_footer(); ?>
