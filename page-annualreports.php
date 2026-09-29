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
                    <div class="table-container">
                        <table>
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
                                    //$file_url = $document_file['url'];
                                    //$file_id = $document_file['ID'];
                                    $file_id = get_post_meta(get_the_ID(), 'document', true);
                            if ($file_id) {
                             $file_url = wp_get_attachment_url((int)$file_id);
                            }
                                    $file_size = @filesize(get_attached_file($file_id)); // Suppress errors with @
                                    $file_type_info = wp_check_filetype($file_url);
                                    $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                                    $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                                    ?>
                                    <tr class="Rtable-row">
                                        <td class="Rtable-cell slno-cell">
                                            <div class="Rtable-cell--content "><?php echo $count; ?></div>
                                        </td>

                                        <th class="Rtable-cell committee-cell" scope="row">
                                            <div class="Rtable-cell--content "><?php echo esc_html(get_the_title()); ?></div>
                                        </th>
                                        <td class="Rtable-cell composition-cell ">
                                            <div class="Rtable-cell--content access-link-content ">
                                                <a
    href="<?php echo esc_url($file_url); ?>"
    target="_blank"
    rel="noopener"
    aria-label="<?php echo esc_attr( 'Download PDF, ' . $file_size_mb . ' MB' ); ?>"
>

    <!-- PDF Icon -->
    <span class="tooltip-box">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 68 68"
            fill="none"
            aria-hidden="true"
            focusable="false"
        >
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z"
                fill="#5d3e00"
            />
        </svg>

        <span class="tooltip-text">
            <?php echo esc_html__( 'PDF', 'srft-theme' ); ?>
        </span>
    </span>


    <!-- File Size -->
    <span aria-hidden="true">
        <?php echo esc_html($file_size_mb); ?> MB
    </span>


    <!-- Download Icon -->
    <span class="tooltip-box">
        <svg
            width="24"
            height="24"
            viewBox="0 0 64 64"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
            focusable="false"
        >
            <path
                d="M32.0003 41.5333C31.6448 41.5333 31.3114 41.4777 31.0003 41.3666C30.6892 41.2555 30.4003 41.0666 30.1337 40.8L20.5337 31.2C20.0003 30.6666 19.7448 30.0444 19.767 29.3333C19.7892 28.6222 20.0448 28 20.5337 27.4666C21.067 26.9333 21.7003 26.6555 22.4337 26.6333C23.167 26.6111 23.8003 26.8666 24.3337 27.4L29.3337 32.4V13.3333C29.3337 12.5777 29.5892 11.9444 30.1003 11.4333C30.6114 10.9222 31.2448 10.6666 32.0003 10.6666C32.7559 10.6666 33.3892 10.9222 33.9003 11.4333C34.4114 11.9444 34.667 12.5777 34.667 13.3333V32.4L39.667 27.4C40.2003 26.8666 40.8337 26.6111 41.567 26.6333C42.3003 26.6555 42.9337 26.9333 43.467 27.4666C43.9559 28 44.2114 28.6222 44.2337 29.3333C44.2559 30.0444 44.0003 30.6666 43.467 31.2L33.867 40.8C33.6003 41.0666 33.3114 41.2555 33.0003 41.3666C32.6892 41.4777 32.3559 41.5333 32.0003 41.5333ZM16.0003 53.3333C14.5337 53.3333 13.2781 52.8111 12.2337 51.7666C11.1892 50.7222 10.667 49.4666 10.667 48V42.6666C10.667 41.9111 10.9225 41.2777 11.4337 40.7666C11.9448 40.2555 12.5781 40 13.3337 40C14.0892 40 14.7225 40.2555 15.2337 40.7666C15.7448 41.2777 16.0003 41.9111 16.0003 42.6666V48H48.0003V42.6666C48.0003 41.9111 48.2559 41.2777 48.767 40.7666C49.2781 40.2555 49.9114 40 50.667 40C51.4226 40 52.0559 40.2555 52.567 40.7666C53.0781 41.2777 53.3337 41.9111 53.3337 42.6666V48C53.3337 49.4666 52.8114 50.7222 51.767 51.7666C50.7225 52.8111 49.467 53.3333 48.0003 53.3333H16.0003Z"
                fill="#5d3e00"
            />
        </svg>

        <span class="tooltip-text">
            <?php echo esc_html__( 'Download', 'srft-theme' ); ?>
        </span>
    </span>

</a> | (<span lang="en">EN</span>, <span lang="hi">HI</span>)
</span>
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
    </section>
</main>

<?php 
get_footer();
?>
