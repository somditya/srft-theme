<?php 

/*
Template Name: Admisison PG FTI AR
 */
get_header();
$post_id = get_the_ID();
$catslug = get_the_category($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>
    <main>
      <section  class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <h1 class="page-banner-title"><?php echo __('Admission in FTII Itanagar', 'srft-theme'); ?></h1>  
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
      <section  id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <nav class="childnavs" aria-label="<?php echo __('Admission in FTII', 'srft-theme'); ?>">
                    <?php
                    $current_language = get_locale(); // Get the current language/locale.

                    $menu_name = ($current_language === 'hi_IN') ? 'hindi_ftiaradmission_menu' : 'english_ftiaradmission_menu'; // Define menu name based on language.

                    // Get the current page title
                    $current_page_title = get_the_title();

                    // Define a custom menu walker to modify the menu output.
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

                    // Display the menu based on the language and custom walker.
                    wp_nav_menu(array(
                        'menu' => $menu_name,
                        'container' => false, // No container element.
                        'menu_class' => 'childnav-lists', // You can customize this class as needed.
                        'walker' => new Custom_Walker_Nav_Menu(),
                    ));
                    ?>
            </nav>

            <div class="widget" style="line-height: 1.5">
                <?php 
                if ($current_language === 'en_US') {
                    $catslug = 'document-en'; 
                } else {
                    $catslug = 'document-hi';
                }

                $download_post = new WP_Query(array(
                    'post_type' => 'document',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'category',
                            'field'    => 'slug',
                            'terms'    => $catslug,
                        ),
                    ),
                    'posts_per_page' => -1,       
                ));

                if ($download_post->have_posts()) {
    echo '<ul style="list-style-type: none; padding-left: 0;">';
    while ($download_post->have_posts()) {
        $download_post->the_post(); 
        
        // Use get_post_meta instead of get_field
        $file_id = get_post_meta(get_the_ID(), 'document', true);
        $document_category = get_post_meta(get_the_ID(), 'document-category', true);
        $document_description = get_field('document_description');
        
        // Handle array format for document-category
        if (is_array($document_category)) {
            $document_category = $document_category['value'] ?? '';
        }
        
        // Check if category is Prospectus AR and file exists
        if ($document_category === 'Prospectus AR' && $file_id) {
            $file_url = wp_get_attachment_url((int)$file_id);
            
            if ($file_url) {
                $file_size = @filesize(get_attached_file($file_id));
                $file_type_info = wp_check_filetype($file_url);
                $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                ?>
                <li style="margin-bottom: 1rem;">
                    <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener" title="opens in a new tab">
                        <?php echo esc_html(get_the_title()); ?> 
                        (<?php echo esc_html($file_size_mb); ?>)
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 68 68" fill="none" title="PDF icon"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z" fill="#5d3e00"></path></svg>
                    </a>
                </li>
                <?php
            }
        }
    }
    echo '</ul>';
} else {
    echo '<p>' . __('No posts found in the specified category.', 'srft-theme') . '</p>';
}

wp_reset_postdata();
?>   
            </div>

   <!--<div class="link-div" style="align-items: left; margin-top: 0;">
          <a class="link-text-big" href="https://applyadmission.net/srfti2026" aria-label="Apply for the course"><span> <?php echo __('Click here to apply', 'srft-theme'); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-4" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow" style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>      
    </div>-->


    <!-- Sample Question Papers -->
    <div class="widget">
        <h2><?php echo __('Sample Question Papers', 'srft-theme'); ?></h2>
        <?php
        $download_post = new WP_Query([
            'post_type' => 'document',
            'tax_query' => [[
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $catslug,
            ]],
            'posts_per_page' => -1,
        ]);

        if ($download_post->have_posts()) {
            echo '<ul style="list-style: none; padding-left: 0;">';
            while ($download_post->have_posts()) {
                $download_post->the_post(); 
                $document_file = get_field('document');
                $document_category = get_field('document-category');
                if (in_array($document_category, ['Question Paper FTIII', 'Question Paper Both'], true)
                 && !empty($document_file)) {
                    //$file_url = $document_file['url'];
                    //$file_id = $document_file['ID'];
                     $file_id = get_post_meta(get_the_ID(), 'document', true);
                            if ($file_id) {
                             $file_url = wp_get_attachment_url((int)$file_id);
                            }
                    $file_size = @filesize(get_attached_file($file_id));
                    $file_type_info = wp_check_filetype($file_url);
                    $file_type = strtoupper($file_type_info['ext'] ?? 'Unknown');
                    $file_size_mb = $file_size ? size_format($file_size, 2) : 'Unknown';
                    ?>
                    <li style="margin-bottom: 10px;">
                        <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener" title="pdf opens in a new window">
                            <?php echo esc_html(get_the_title()); ?>
                            (<?php echo esc_html($file_size_mb); ?>)
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 68 68" fill="none" title="PDF icon"><path fill-rule="evenodd" clip-rule="evenodd" d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z" fill="#5d3e00"></path></svg>
                        </a>
                    </li>
                <?php }
            }
            echo '</ul>';
        } else {
            echo '<p>' . __('No question papers found.', 'srft-theme') . '</p>';
        }
        wp_reset_postdata();
        ?>
    </div> 


            <!--<div class="widget" style="line-height: 1.5">
                <h2><?php echo __('Admission Notification', 'srft-theme');?></h2>
                <?php
                $category_posts = new WP_Query(array(
                    'category_name' => 'admissionshort-en',  'posts_per_page' => 5,
                ));

                if ($category_posts->have_posts()) :
                    while ($category_posts->have_posts()) : $category_posts->the_post();
                        $post_link = get_permalink();
                    ?>
                    <h3><a href="<?php echo esc_url($post_link); ?>"><?php the_title(); ?></a></h3>
                    <?php
                    endwhile;
                    wp_reset_postdata(); 
                else :
                    echo '<p>No posts found in this category.</p>';
                endif;
                ?>
                            </div>-->
        </div> <!-- Closing div for leftnav -->

        <div class="main-content" >
        <section  class="page-title"><div><h2 class="page-header-text"><?php the_title(); ?></h2></div></section>
        <section class="sub-intro">
          <div class="sub-intro-images">
          <div>
            <img class="intro-images" src="<?php bloginfo('template_url'); ?>/images/FTI ARP.jpg"
                 alt="">
          </div>
          </div>
          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true); ?></div>
          
           <div class="sub-intro-text-description">
           <?php echo get_post_meta(get_the_ID(), 'SubIntroDescription', true); ?>
          </div>
          </div>
        </section>
        <section>
          <div style="margin-bottom: 2.5rem;">
          <?php echo $page_content; ?>
          </div>
        </section>
    </main>
    <?php get_footer();  ?>