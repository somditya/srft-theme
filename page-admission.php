<?php
/*
Template Name: Admission PG
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
            <div class="page-banner-title">
                <?php echo __('Admission to postgraduate courses', 'srft-theme'); ?>
            </div>  
        </div>
    </section>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="childnavs">
                <?php
                $menu_name = ($current_language === 'hi_IN') ? 'hindi_admission_menu' : 'english_admission_menu';
                $current_page_title = get_the_title();

                class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
                    public function start_lvl(&$output, $depth = 0, $args = null) {
                        $output .= '<ul class="submenu">';
                    }
                    public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
                        $is_current = ($item->title === $GLOBALS['current_page_title']) ? 'active' : '';
                        $output .= '<li class="childnav-list-item ' . $is_current . '"><a class="item" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                    }
                    public function end_el(&$output, $item, $depth = 0, $args = null) {
                        $output .= '</li>';
                    }
                    public function end_lvl(&$output, $depth = 0, $args = null) {
                        $output .= '</ul>';
                    }
                }
                
                wp_nav_menu([
                    'menu' => $menu_name,
                    'container' => false,
                    'menu_class' => 'childnav-lists',
                    'walker' => new Custom_Walker_Nav_Menu(),
                ]);
                ?>
            </div>

            <div class="widget" style="line-height: 1.5">
                <?php
                $catslug = ($current_language === 'en_US') ? 'document-en' : 'document-hi';
                $download_post = new WP_Query([
                    'post_type' => 'document',
                    'tax_query' => [['taxonomy' => 'category', 'field' => 'slug', 'terms' => $catslug]],
                    'posts_per_page' => -1,
                ]);
                
                if ($download_post->have_posts()) {
                    echo '<ul style="list-style-type: none">';
                    while ($download_post->have_posts()) {
                        $download_post->the_post(); 
                        $document_file = get_field('document');
                        $document_category = get_field('document-category');
                        if ($document_category === 'Prospectus' && $document_file) {
                            $file_url = $document_file['url'];
                            $file_id = $document_file['ID'];
                            $file_size = @filesize(get_attached_file($file_id));
                            $file_type_info = wp_check_filetype($file_url);
                            $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                            $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                            ?>
                            <li>
                                <a href="<?php echo esc_url($file_url); ?>">
                                    <?php echo esc_html(get_the_title()); ?> (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="pdf" style="vertical-align: middle;" />
                                </a>
                            </li>
                            <?php
                        }
                    }
                    echo '</ul>';
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }
                wp_reset_postdata();
                ?>   
            </div>
        </div>
    </section>

    <div class="main-content">
        <?php if (function_exists('yoast_breadcrumb')) yoast_breadcrumb('<p id="breadcrumbs">','</p>'); ?>

        <section class="page-title">
            <div>
                <p class="page-header-text"> <?php echo __('Course Overview', 'srft-theme'); ?> </p>
            </div>
        </section>

        <section class="sub-intro">
            <div class="sub-intro-images">
                <img class="intro-images" src="<?php bloginfo('template_url'); ?>/images/srfti-front.jpg" alt="SRFTI Entrance">
            </div>
            <div class="sub-intro-text">
                <div class="sub-intro-text-head"> <?php echo get_post_meta(get_the_ID(), 'SubIntro', true); ?> </div>
                <div class="sub-intro-text-description"> <?php echo get_post_meta(get_the_ID(), 'SubIntroDescription', true); ?> </div>
            </div>
        </section>

        <section class="section-home">
            <div class="tabs">
                <div class="tab-2">
                    <label for="tab2-1"> <?php echo __('Postgraduate Programmes in Cinema', 'srft-theme'); ?> </label>
                    <input id="tab2-1" name="tabs-two" type="radio" checked>
                    <div>
                        <p> <?php echo __('The programme is a 3-year full-time programme divided into 6 semesters', 'srft-theme'); ?> </p>
                        <div class="accordian">
                            <ul>
                                <li>
                                    <input type="checkbox" checked>
                                    <i></i>
                                    <h2> <?php echo __('Duration', 'srft-theme'); ?> </h2>
                                    <p> <?php echo __('3 years-full time', 'srfti-theme'); ?> </p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<?php get_footer(); ?>
