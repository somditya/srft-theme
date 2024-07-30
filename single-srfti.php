<?php
/*
Template Name: srfti-page
Template Post Type: post
*/
get_header(); 

$post_id = get_the_ID();
$page_content = apply_filters('the_content', get_post_field('post_content', $post_id));

// Retrieve the featured image URL
$featured_image_url = get_the_post_thumbnail_url($post_id, 'large');
?>
    <main>
        <!-- Add an image section with the featured image -->
       

        <!-- Content area -->
        <div class="static-container">
        <section class="header-image" style="background-image: url('<?php echo esc_url($featured_image_url); ?>');">
        </section>
            <?php echo $page_content; ?>
        </div>
    </main>
</div>

<?php get_template_part('footer-html'); ?>