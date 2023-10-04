<?php

/*Template Name: PG Programme Cinema*/
get_header();
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
$post_id = get_the_ID();
$catslug=get_post_meta(get_the_ID(), 'Category', true);

// Get the category IDs for the post

// Initialize the category slug variable

$title=get_the_title($post_id);
?>
<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __($title, 'srft-theme'); ?></div>
      </section>

      <section class="cine-detail">
        <div class="leftnav">
        <div class="childnavs">
          <ul class="childnav-lists">
            <li class="childnav-list-item">
              <a class="item"><?php echo __('Prospectus', 'srft-theme'); ?></a>
            </li>
            <li class="childnav-list-item">
              <a class="item"><?php echo __('Scholarship', 'srft-theme'); ?></a>
              </li>
              <li class="childnav-list-item">
                <a class="item"><?php echo __('Academic Calendar', 'srft-theme'); ?></a>
                </li>
                <li class="childnav-list-item">
                  <a class="item"><?php echo __('Academic By-law', 'srft-theme'); ?></a>
                </li>
          </ul>
        </div>
        </div>

        <div class="main-content">
        
        <?php 
        $intro = get_post_meta(get_the_ID(), '$Intro', true);
        $subintro= get_post_meta(get_the_ID(), '$SubIntro', true);
        $subintrodesc= get_post_meta(get_the_ID(), '$SubIntroDescription', true);
        ?>
                
        <div class="intro"><p><?php echo get_post_meta(get_the_ID(), 'Intro', true);?></p></div>
        
        <!--<section class="sub-intro">
          <div class="sub-intro-images">
            <div class="iframe-wrapper">
              <iframe class="wrapped-iframe" src="https://www.youtube.com/embed/XznE74RwM3E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          </div>

          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true);?></div>

           <div class="sub-intro-text-description">
           <?php echo get_post_meta(get_the_ID(), 'Intro', true);?> 
          </div>
          </div>
        </section>-->

        <section class="sub-intro">
          <div class="sub-intro-images">
            <!--<div>
              <iframe src="https://www.youtube.com/embed/XznE74RwM3E" title="SRFTI Film Wing" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>-->
            <div class="iframe-wrapper">
              <iframe class="wrapped-iframe" src="https://www.youtube.com/embed/XznE74RwM3E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          </div>
          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true);?></div>
          
           <div class="sub-intro-text-description">
           <?php echo get_post_meta(get_the_ID(), 'SubIntroDescription', true);?> 
          </div>
          </div>
           <div>
        <p class="page-header-text" style="margin-top: 2rem;"><?php echo __('The T of SRFTI', 'srft-theme'); ?></p>
    </div> 
          <div>
           
            <?php echo get_post_meta(get_the_ID(), 'AbtPGProgramme', true);?>
          </div>
        </section>
        
        <div>
        <p class="page-header-text" style="margin-top: 2rem;"><?php echo __('Specializations', 'srft-theme'); ?></p>
    </div> 
        
        <section style="margin-top: rem;">
        <div class="box-container">
        <?php
            /*if ($current_language === 'en_US') {
              $catslug='pgcinema-en'; 
             }
            else
            {
            $catslug='pgcinema-hi';
            }*/
            $args = array(
              'post_type' => 'page',
              'category_name' => $catslug, // Replace with your category slug
              'posts_per_page' => -1,
          );          
          $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
        ?>    
          <div class="cell">
          <a href="<?php the_permalink(); ?>" target="_blank">
          <img  class="img-responsive" src="<?php the_post_thumbnail_url('thumbnail'); ?>"></a>
            <div class="txt">
              <div class="caption">
                <?php echo get_post_meta(get_the_ID(), 'Department', true);?>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          
          <!--<div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 2">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Cinematography', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 08.jpg" class="img-responsive" alt="Image 3">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Direction & Screenplay Writing', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 4">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Editing', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 5">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Producing for Film & Television', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img  class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 6">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Sound Recording & Design', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>-->
          <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>
        </div>
      </section>  
    </main>
    <?php
get_footer();

?>