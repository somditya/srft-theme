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
                    echo '<ul style="list-style-type: none">';
                    while ($download_post->have_posts()) {
                        $download_post->the_post(); 
                        
                        // ACF Fields
                        $document_file = get_field('document');
                        $document_category = get_field('document-category'); // Returns an array with URL and other data
                        $document_description = get_field('document_description');
                        if ($document_category === 'Prospectus AR') {
                            if ($document_file) :
                                // Get the file URL, file size, and file type (mime type)
                                $file_url = $document_file['url'];
                                $file_id = $document_file['ID'];
                                $file_size = @filesize(get_attached_file($file_id)); // Suppress errors with @
                                $file_type_info = wp_check_filetype($file_url);
                                $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                                $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown'; // Convert file size to MB with 2 decimal points
                                ?>
                                <li>
                                    <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener" title="opens in a new tab">
                                        <?php echo esc_html(get_the_title()); ?> 
                                        (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="" style="vertical-align: middle;" />
                                    </a>
                                </li>
                            <?php endif; 
                        }
                    }
                    echo '</ul>';
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }

                wp_reset_postdata(); // Reset after custom query
                ?>   
            </div>

            <div class="widget" style="line-height: 1.5">
                <h2><?php echo __('Admission Notification', 'srft-theme');?></h2>
                <?php
                $category_posts = new WP_Query(array(
                    'category_name' => 'admissionshort-en', // Replace with your category slug
                    'posts_per_page' => 5,
                ));

                if ($category_posts->have_posts()) :
                    while ($category_posts->have_posts()) : $category_posts->the_post();
                        $post_link = get_permalink();
                    ?>
                    <h3><a href="<?php echo esc_url($post_link); ?>"><?php the_title(); ?></a></h3>
                    <?php
                    endwhile;
                    wp_reset_postdata(); // Reset the post data
                else :
                    echo '<p>No posts found in this category.</p>';
                endif;
                ?>
                            </div>
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