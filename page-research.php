<?php
/*
Template Name: Film Research
 */
get_header(); 
$post_id = get_the_ID();
$catslug = get_the_category($post_id);

$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();

if ($current_language === 'en_US') {
  $catslug = 'takeone-en'; 
} else {
  $catslug = 'takeone-hi';
}

?>
<div data-scroll-container>
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
        
        <div class="widget" style="line-height: 1.5; margin-top:1rem;">
        <h4><?php echo __('Take One', 'srft-theme' ); ?></h4>
        <ul style="list-style-type: none ">
        <?php
              // Query the previous 4 convocation posts and exclude the latest post
              $takeones = new WP_Query(array(
                'category_name' => $catslug, // Replace with your custom category name
                'posts_per_page' => 6, // Number of previous convocations to display
              ));

              if ( $takeones->have_posts()) :
                while ( $takeones->have_posts()) :  $takeones->the_post();
              ?>
                  <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php
                endwhile;
                wp_reset_postdata();
              else :
                echo 'No previous take one post found.';
              endif;
              ?>
        </ul>   
        </div>
        </div>

  <div class="main-content">
  <div><?php if(function_exists('bcn_display'))
{
bcn_display();
}?></div>

<div>
        <p class="page-header-text"><?php the_title(); ?></p>
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

    <div>
            <p class="page-header-text"><?php echo __('Independent Research Fellowship Programme', 'srft-theme'); ?></p>
          </div>
 
    <section style="margin-bottom: 4rem;">
    <div><?php the_content(); ?></div>   
    </section>
</div>        
</main>


<?php
get_footer(); 
?>