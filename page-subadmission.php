<?php 

/*
Template Name: Admisison Subpages
 */
get_header();
$post_id = get_the_ID();
$catslug = get_the_category($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('Admission to post graduate courses', 'srft-theme'); ?></div>
      </section>
      <section id="skip-to-content" class="cine-detail">
      <div class="leftnav">
      <div class="childnavs">
    <ul class="childnav-lists">
        <?php
        $current_language = get_locale(); // Get the current language/locale.

        $menu_name = ($current_language === 'hi_IN') ? 'hindi_admission_menu' : 'english_admission_menu'; // Define menu name based on language.

        // Get the current page title
        $current_page_title = get_the_title();

        // Define a custom menu walker to modify the menu output.
        class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
            public function start_lvl(&$output, $depth = 0, $args = null) {
                // Customize the submenu opening tag as needed.
                $output .= '<ul class="submenu">';
            }

            public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
                // Check if the current page title matches the menu item title.
                $is_current = ($item->title === $GLOBALS['current_page_title']) ? 'active' : '';

                // Customize the menu item HTML structure as needed.
                $output .= '<li class="childnav-list-item ' . $is_current . '">';
                $output .= '<a class="item" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
            }

            public function end_el(&$output, $item, $depth = 0, $args = null) {
                // Close the menu item tag.
                $output .= '</li>';
            }

            public function end_lvl(&$output, $depth = 0, $args = null) {
                // Customize the submenu closing tag as needed.
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
    </ul>
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
                            $file_type = strtoupper($file_type_info['ext'] ?? 'Unknown');
                            $file_size_mb = $file_size ? size_format($file_size, 2) : 'Unknown';
                            ?>
                            <li>
                                <a href="<?php echo esc_url($file_url); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                    (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="Download" style="vertical-align: middle;" />
                                </a>
                            </li>
                        <?php }
                    }
                    echo '</ul>';
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }

                wp_reset_postdata();
                ?>
            </div>
        </div>
        <div class="main-content">
        <div>      <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
      ?></div>
        <section class="page-title">
          <div><p class="page-header-text"><?php the_title(); ?></p></div>
        </section>
        <div>
        <?php the_content(); ?>
        <div>
        <div class="spacer"> </div>
      <section>  
  </main>


  <?php 

/*
Template Name: Admisison Subpages
 */
get_footer();
?>






















<?php 
get_footer();
?>