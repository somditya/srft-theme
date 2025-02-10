<?php
/*
Template Name: General
*/
get_header(); 

$post_id = get_the_ID();
$page_content = apply_filters('the_content', get_post_field('post_content', $post_id));

// Retrieve the featured image URL
//$featured_image_url = get_the_post_thumbnail_url($post_id, 'large');
?>
<main>
        <!-- Add an image section with the featured image -->
       

        <!-- Content area -->
<div class="static-container">
        <div>      
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>
        <section class="page-title">
            <div>
                <p class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></p>
            </div>
        </section>

        <section>
            <?php echo $page_content; ?> 
        </section>
</div>

<?php get_footer();  ?>