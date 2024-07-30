<?php
/*
Template Name: Students Productions
 */
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>
<div data-scroll-container>
<main>

<section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <div class="page-banner-title"><?php echo __('About SRFTI', 'srft-theme'); ?></div>
        </div>
</section>

<section style="margin-top: rem;">
        <div class="box-container">    
          <div class="cell" ng-repeat="film in filteredFaculty">
          <a href="<?php the_permalink(); ?>" target="_blank">
          <?php
           $thumb_url=get_post_meta(get_the_ID(), 'Thumb_url', true);
            if (!empty($thumb_url)) {
              echo '<img class="img-responsive" src="' . esc_url($thumb_url) . '">';
               }
           ?>
            <div class="txt">
              <div class="caption">
                <?php echo get_post_meta(get_the_ID(), 'Department', true);?>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div></a>
          </div>          
          <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>
        </div>
</section>  