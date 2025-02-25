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

// Retrieve and filter the post content
$post_content = apply_filters('the_content', $post->post_content);
?>

<main id="skip-to-content">    
    <div class="static-container" style="padding-left: 80px;">
        <div>      
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
        </div>          

        <div class="faculty-content-info">
            <div class="faculty-profile-info">
            <h1 class="faculty-title">
            <?php echo get_the_title(); ?>
        </h1> 
                <div class="faculty-post-summary">
                    <div class="faculty-circle-image">
                        <?php if (get_field('Faculty-Image')) : ?>
                            <img src="<?php echo esc_url(get_field('Faculty-Image')); ?>" width="600" height="600" alt="<?php echo get_the_title(); ?>" typeof="foaf:Image">
                        <?php endif; ?>
                    </div>

                    <?php if (get_field('Faculty-Designation')) : ?>
                        <div><?php echo esc_html(get_field('Faculty-Designation')); ?></div>
                    <?php endif; ?>

                    <?php if (get_field('Faculty-Department')) : ?>
                        <div><cite>—<?php echo esc_html(get_field('Faculty-Department')); ?></cite></div>
                    <?php endif; ?>

                    <?php if (get_field('Faculty-Email')) : ?>
                        <div>
                            <a href="mailto:<?php echo esc_attr(get_field('Faculty-Email')); ?>">
                                <?php echo esc_html(get_field('Faculty-Email')); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="teaching-at"></div>
                </div>
                <div class="faculty-biodata">  
                <?php echo wp_kses_post(get_field('Faculty-Bio')); ?>
            </div>
            </div>

        </div>
    </div>            

<?php get_footer(); ?>
