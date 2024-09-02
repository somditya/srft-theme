<?php
/*
Template Name: Resources
 */
get_header(); 
$post_id = get_the_ID();
$post = get_post($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main>
    <section id="skip-to-content" class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <div class="page-banner-title"><?php the_title(); ?></div>
        </div>
    </section>

    <section class="cine-detail">
        <div class="leftnav">
            <div class="widget" style="line-height: 1.5; margin-top: 1rem;">
                <?php 
                if ($current_language === 'en_US') {
                    $catslug = 'download-en'; 
                } else {
                    $catslug = 'download-hi';
                }
                $download_post = new WP_Query(array(
                    'category_name' => $catslug, 
                    'posts_per_page' => 1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                ));

                if ($download_post->have_posts()) {
                    while ($download_post->have_posts()) {
                        $download_post->the_post();
                    }
                } else {
                    echo 'No posts found in the specified category.';
                }
                wp_reset_postdata(); // Reset after custom query
                ?>

                <ul style="list-style-type: none">
                    <li><a href="<?php echo esc_html(get_post_meta(get_the_ID(), 'MOA', true)); ?>"><?php echo __('Memorandum of Association', 'srft-theme'); ?> <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></a></li> 
                    <li><a href="<?php echo get_post_meta(get_the_ID(), 'ABL', true); ?>"><?php echo __('Academic Bye-Laws ', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></a></li>
                    <li><a href="<?php echo get_post_meta(get_the_ID(), 'FBL', true); ?>"><?php echo __('Financial Bye-Laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></a></li>
                    <li><a href="<?php echo get_post_meta(get_the_ID(), 'SBL', true); ?>"><?php echo __('Service By-laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></a></li>
                    <li><a href="<?php echo get_post_meta(get_the_ID(), 'RL', true); ?>"><?php echo __('Rules & Regulation', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></a></li>
                    <li><a href="<?php echo get_post_meta(get_the_ID(), 'RR', true); ?>"><?php echo __('Recruitment Rule', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></a></li>
                </ul>   
            </div>
        </div>

        <div class="main-content">
            <section class="page-title">
                <div>
                    <?php echo '<p class="page-header-text">' . esc_html($post->post_title) . '</p>';?>
                </div>
            </section>

            <section style="margin-bottom: 4rem;">
                <div><?php  echo wp_kses_post($post->post_content); ?></div>   
            </section>
        </div>
    </section>
</main>

<?php
get_footer(); 
?>
