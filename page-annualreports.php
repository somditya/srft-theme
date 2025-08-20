<?php
/*
Template Name: Annual Report
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
            <h1 class="page-banner-title"><?php echo __('Annual Reports', 'srft-theme'); ?></h1>
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
        <div class="leftnav" >
        <nav class="childnavs" aria-label="<?php echo __('About Us', 'srft-theme'); ?>">
                <?php
                $current_language = get_locale();
                $menu_name = ($current_language === 'hi_IN') ? 'hindi_admin_menu' : 'english_admin_menu';
                $current_page_title = get_the_title();

                
        class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
            public function start_lvl(&$output, $depth = 0, $args = null) {
                $output .= '<ul class="submenu">';
            }
            public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
    global $current_page_title;
    $is_current = ($item->title === $current_page_title);
    $active_class = $is_current ? 'active' : '';
    $aria_current = $is_current ? ' aria-current="page"' : '';

    $output .= '<li class="childnav-list-item ' . $active_class . '">';
    $output .= '<a class="item" href="' . esc_url($item->url) . '"' . $aria_current . '>' . esc_html($item->title) . '</a>';
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
            </nav>
        </div>

        <div class="main-content" role="main">
            <div>
                <h2 class="page-header-text"><?php echo __('SRFTI Annual Reports & Institutional Performance Records', 'srft-theme'); ?></h2>
            </div>

            <div style="margin-top: 4rem;">
                <div class="wrapper" style="text-align: left;">
                    <div class="Rtable Rtable--5cols Rtable--collapse">
                        <table style="width: 100%;">
                        <caption class="sr-only">table showing yearwise downloadable annual reports</caption>    
                        <thead>
                        <tr class="Rtable-row Rtable-row--head">
                            <th class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme'); ?></th>
                            <th class="Rtable-cell committee-cell column-heading"><?php echo __('Title', 'srft-theme'); ?></th>
                            <th class="Rtable-cell composition-cell column-heading"><?php echo __('Details', 'srft-theme'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
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
                        $count = 1;

                        if ($download_post->have_posts()) {
                            while ($download_post->have_posts()) {
                                $download_post->the_post();

                                // ACF Fields
                                $document_file = get_field('document');
                                $document_category = get_field('document-category');
                                $document_description = get_field('document_description');

                                if ($document_category === 'Annual Report' && $document_file) {
                                    $file_url = $document_file['url'];
                                    $file_id = $document_file['ID'];
                                    $file_size = @filesize(get_attached_file($file_id)); // Suppress errors with @
                                    $file_type_info = wp_check_filetype($file_url);
                                    $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                                    $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                                    ?>
                                    <tr class="Rtable-row">
                                        <td class="Rtable-cell slno-cell">
                                            <div class="Rtable-cell--content "><?php echo $count; ?></div>
                                        </td>

                                        <td class="Rtable-cell committee-cell">
                                            <div class="Rtable-cell--content "><?php echo esc_html(get_the_title()); ?></div>
                                        </td>
                                        <td class="Rtable-cell composition-cell">
                                            <div class="Rtable-cell--content ">
                                                <a href="<?php echo esc_url($file_url); ?>" title="Download PDF">
                                                    <?php echo __('Download', 'srft-theme'); ?>
                                                    (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="" style="vertical-align: middle;" />
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $count++;
                                }
                            }
                        } else {
                            echo __('No posts found in the specified category.', 'srft-theme');
                        }

                        wp_reset_postdata();
                        ?>
                    </tbody>
                    </table>
            </div>
        </div>
    </section>
</main>

<?php 
get_footer();
?>
