<?php
/*
Template Name: Contact
 */
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>
<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('Contact Us', 'srft-theme' ); ?></div>
      </section>

      <section class="cine-detail">
        <div class="leftnav">
                
          <div class="widget" style="line-height: 1.5">
              <h3><?php echo __('Important Links', 'srft-theme' ); ?></h3>
                <ul style="list-style-type: none ">
                </ul>   
          </div>
        </div>

  <div class="main-content">
    <div>
        <p class="page-header-text"><?php the_title(); ?></p>
    </div>  
   
    <!--<div>
        <p class="page-header-text"><?php echo __('Library of SRFTI', 'srft-theme' ); ?></p>
    </div>-->
    <section style="margin-bottom: 4rem;">
    <?php the_content(); ?>   
    </section>
</div>
        
</main>

 
    <?php
get_footer(); 
?>