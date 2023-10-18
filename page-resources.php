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
          <div class="page-banner-title"><?php echo __('RTI', 'srft-theme' ); ?></div>
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
    <div>
        <p class="page-header-text"><?php echo __('Right to Information Act (RTI)2005', 'srft-theme' ); ?></p>
    </div>  
    <section class="sub-intro" style="margin-bottom: 4rem;">
        <div class="sub-intro-text" style="max-width: 100%;">
            <div class="sub-intro-text-description">
                <?php
                // Retrieve and display the introduction of the page content
                $intro = get_post_meta(get_the_ID(), 'SubIntroDescription', true);
                echo $intro;
                ?>
            </div>
        </div>
    </section>

    <section style="margin-bottom: 4rem;">
    <?php the_content(); ?>   
    </section>
</div>
        
</main>

<?php
get_footer(); 
?>