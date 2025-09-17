<?php 

/*
Template Name: Short Courses Subpage
 */
get_header();
$post_id = get_the_ID();
/*$catslug = get_the_category($post_id);*/
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main id="skip-to-content">

  <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h1 class="page-banner-title"><?php echo __('Admission to short courses', 'srft-theme'); ?></h1>
        </div>
  </section>

 <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
      <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' ); } ?>
    </div>
  </div> 
 

  <section id="skip-to-content" class="section-home">
    <div class="container" style="padding: 0 3.2rem;"> 
        <div class="page-title" id="skip-to-content">
            <div>
                <h2 class="page-header-text"><?php the_title(); ?></h2>
            </div>
        </div>
       
        <div style="margin-bottom: 4rem;">
            
            <div><?php echo str_replace(array('<p>', '</p>'), '', $page_content);?> </div>   
    </div>     
  </section>

</main>  

<?php 
get_footer();
?>
