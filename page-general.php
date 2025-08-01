<?php
/*
Template Name: General
*/
get_header(); 

$post_id = get_the_ID();
//$page_content = apply_filters('the_content', get_post_field('post_content', $post_id));
$page_content = do_shortcode(get_post_field('post_content', $post_id)); // Ensure shortcodes are processed


// Retrieve the featured image URL
//$featured_image_url = get_the_post_thumbnail_url($post_id, 'large');
?>
<main id="skip-to-content">
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
        
        <div class="page-title">
        <h1 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h1>
    </div> 
        <div>        
        <?php echo $page_content ?>

       </div>
</div>    

<?php get_footer();  ?>