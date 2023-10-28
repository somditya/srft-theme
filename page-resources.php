<?php
/*
Template Name: Resources
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
          <div class="page-banner-title"><?php the_title(); ?></div>
      </section>

      <section class="cine-detail">
        <div class="leftnav">
          <!--<div>
          <p class="office-header-text">Management</p>-->
          <!--<div class="ftest">Satyajit Ray Film & Television Institute</div>-
        </div>-->
        
        <div class="widget" style="line-height: 1.5">
        <ul style="list-style-type: none ">
          <li><?php echo __('Memorandum of Association', 'srft-theme' ); ?>  <img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li> 
          <li><?php echo __('Academic Bye-Laws ', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Financial Bye-Laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Service By-laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Recruitment Rule', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
        </ul>   
        </div>
        </div>

  <div class="main-content">
  <section class="page-title">
          <div>
            <p class="page-header-text"><?php the_title(); ?></p>
          </div>
  </section>

    <section style="margin-bottom: 4rem;">
    <div><?php the_content(); ?></div>   
    </section>
</div>
        
</main>

<?php
get_footer(); 
?>