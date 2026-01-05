<?php
/* Template Name: PG Programme Cinema */
get_header();

$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
$catslug = get_post_meta($post_id, 'Category', true);
$title = get_the_title($post_id);
?>

<main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>');">
        <div class="page-banner">
            <h1 class="page-banner-title"><?php echo __($title, 'srft-theme'); ?></h1>
        </div>  
    </section>

    <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
    <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
            }
    ?>
   </div>
   </div>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="childnavs">
                <h2><?php echo __('Related Links', 'srft-theme'); ?> </h2>
                <?php
$menu_name = ($current_language === 'hi_IN') ? 'hindi_pg_menu' : 'english_pg_menu';
$current_page_title = get_the_title();

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="submenu">';
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
        $is_current = ($item->title === $GLOBALS['current_page_title']) ? 'active' : '';
        $output .= '<li class="childnav-list-item ' . $is_current . '">';
        $output .= '<a class="item" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= '</ul>';
    }
}

wp_nav_menu(array(
    'menu' => $menu_name,
    'container' => false,
    'menu_class' => 'childnav-lists',
    'walker' => new Custom_Walker_Nav_Menu(),
));
?>

            </div>

            <div class="widget" style="line-height: 1.5; margin-top: 3rem;">
                <?php 
                $catslg = ($current_language === 'en_US') ? 'document-en' : 'document-hi';

                $download_post = new WP_Query(array(
                    'post_type' => 'document',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => $catslg,
                        ),
                    ),
                    'posts_per_page' => -1,
                ));

                if ($download_post->have_posts()) {
                    while ($download_post->have_posts()) {
                        $download_post->the_post();
                        $document_file = get_field('document');
                        $document_category = get_field('document-category');
                        if ($document_category === 'Prospectus' && $document_file) {
                            $file_url = $document_file['url'];
                            $file_id = $document_file['ID'];
                            $file_size = @filesize(get_attached_file($file_id));
                            $file_type_info = wp_check_filetype($file_url);
                            $file_type = strtoupper($file_type_info['ext'] ?? 'Unknown');
                            $file_size_mb = $file_size ? size_format($file_size, 2) : 'Unknown';
                            ?>
                                <a href="<?php echo esc_url($file_url); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                    <!--(<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)-->
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="" style="vertical-align: middle;" />
                                    <?php echo __('Download', 'srft-theme'); ?> (<?php echo esc_html($file_size_mb); ?>)
                                </a>
                        <?php }
                    }
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }

                wp_reset_postdata();
                ?>
            </div>

            <div class="link-div" style="align-items: left; margin-top: 0;">
          <a class="link-text-big" id="expiring-button" href="https://applyadmission.net/srfti2026" aria-label="Apply for the course"><span> <?php echo __('Click here to apply', 'srft-theme'); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-4" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow" style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>      
    </div>
        </div>

        <div class="main-content">
            <?php 
            $intro = get_post_meta($post_id, 'Intro', true);
            $subintro = get_post_meta($post_id, 'SubIntro', true);
            $subintrodesc = get_post_meta($post_id, 'SubIntroDescription', true);
            ?>

            <section class="home"><p><?php echo wp_kses_post($intro); ?></p></section>
            
            <?php $youtube_url = get_post_meta($post_id, 'Video', true); ?>
            <!--<section class="sub-intro">
                <div class="sub-intro-images">
                    <div class="iframe-wrapper">
                        <iframe class="wrapped-iframe" src="<?php echo esc_url($youtube_url); ?>" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <div class="sub-intro-text">
                    <h2 class="sub-intro-text-head"><?php echo __('Take a tour of the Departments', 'srft-theme'); ?></h2>
                    <div class="sub-intro-text-description">
                        <?php echo esc_html($subintrodesc); ?>
                    </div>
                </div>
                <div>
                    <p class="page-header-text" style="margin-top: 2rem;"><?php echo esc_html(get_post_meta($post_id, 'Tagline', true)); ?></p>
                </div>
                <div><?php echo get_post_meta($post_id, 'AbtPGProgramme', true); ?></div>
            </section>-->

            
            <section>
            <div>
                <h4 class="page-header-text" style="margin-top: 0rem;"><?php echo __('Specializations', 'srft-theme'); ?></h4>
            </div> 
<ul class="box-container" style="list-style-type: none; padding: 0; margin: 0;">
    <?php
    $args = array(
        'post_type' => 'page',
        'category_name' => $catslug,
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
    ?>
        <li class="grid3cell" style="display: inline-block; vertical-align: top; margin: 0 10px 10px 0;">
            <a href="<?php the_permalink(); ?>" target="_blank">
                <?php
                $thumb_url = get_post_meta(get_the_ID(), 'Thumb_url', true);
                $thumb_url = str_replace('{site_url}', get_site_url(), $thumb_url);
                if (!empty($thumb_url)) {
                    echo '<img class="img-responsive" src="' . esc_url($thumb_url) . '" alt="">';
                }
                ?>
                <div class="txt" style="display: flex; align-items: center;">
                    <div class="caption"><?php echo esc_html(get_post_meta(get_the_ID(), 'Department', true)); ?></div>
                    <div style="width: 25px; margin-left:10px;">
                        <img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/arrow-angular.svg" alt="" style="filter: invert(1);">
                    </div>
                </div>
            </a>
        </li>
    <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</ul>

            </section>
        </div>
    </section>

<?php get_footer(); ?>
