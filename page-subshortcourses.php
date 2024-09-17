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

<main>

  <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <div class="page-banner-title"><?php echo __('Admission to short courses', 'srft-theme'); ?></div>
        </div>
  </section>

  <section class="cine-detail" style="flex-direction: column; margin-top: 32px; margin-left: 32px; margin-right: 32px;">
        <section class="page-title">
            <div>
                <p class="page-header-text" style="margin-left: 32px;"><?php the_title(); ?></p>
            </div>
        </section>
        <section style="margin-bottom: 4rem;">
            <div class="main-content-col1">
            <div><?php echo $page_content; ?></div>   
            </div>
        </section>
  </section>
</main>

<?php 
get_footer();
?>
