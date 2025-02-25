<?php 

/*
Template Name: Short Courses Subpage
 */
get_header();
$post_id = get_the_ID();
$catslug = get_the_category($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main id="skip-to-content">

  <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h2 class="page-banner-title"><?php echo __('Admission to short courses', 'srft-theme'); ?></h2>
        </div>
  </section>

 

  <section class="cine-detail" style="flex-direction: column; margin-top: 32px; margin-left: 32px; margin-right: 32px;">
  <div>      
            <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
            }
            ?>
        </div>       
  
  <div class="page-title" id="skip-to-content">
            <div>
                <h2 class="page-header-text" style="margin-left: 32px;"><?php the_title(); ?></h2>
            </div>
        </div>
        <div style="margin-bottom: 4rem;">
            <div class="main-content-col1">
            <div><?php echo str_replace(array('<p>', '</p>'), '', $page_content);
 ?>  </div>   
            </div>
        </div>
  </section>


<?php 
get_footer();
?>
