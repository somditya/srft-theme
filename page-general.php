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
<main>

<section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
              <h1 class="page-banner-title"><?php the_title(); ?></h1>
        </div>
</section>
  
  <div class="container-aligned">
  <div class="breadcrumbs-wrapper">
    <?php if ( function_exists( 'yoast_breadcrumb' ) ) { 
      yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' ); 
    } ?>
  </div>
</div>

    <section class="cine-detail">

    <div class="leftnav">
    </div>
    <div class="main-content">

    <div>
      <h2 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h2>
    </div>
    <div style="margin-top: 2rem; margin-bottom: 10rem;">
        <?php echo $page_content ?>          
       </div>
</div>    
</section>
        </main>
<?php get_footer();  ?>