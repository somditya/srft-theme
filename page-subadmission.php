<?php  
/*
Template Name: Admission  Subpage
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
            <h2 class="page-banner-title"><?php echo __('Admission', 'srft-theme'); ?></h2>  
        </div>
    </section>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="childnavs">
                <div class="childnavs">
                    <?php
                    $current_language = get_locale(); // Get the current language/locale.

                    $menu_name = ($current_language === 'hi_IN') ? 'hindi_admission_menu' : 'english_admission_menu'; // Define menu name based on language.

                    // Get the current page title
                    $current_page_title = get_the_title();

                    // Define a custom menu walker to modify the menu output.
                    class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
                        public function start_lvl(&$output, $depth = 0, $args = null) {
                            $output .= '<ul class="submenu">';
                        }
                        public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
                            global $current_page_title;
                            $is_current = ($item->title === $current_page_title) ? 'active' : '';
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

                    // Display the menu based on the language and custom walker.
                    wp_nav_menu(array(
                        'menu' => $menu_name,
                        'container' => false, // No container element.
                        'menu_class' => 'childnav-lists', // You can customize this class as needed.
                        'walker' => new Custom_Walker_Nav_Menu(),
                    ));
                    ?>
                </div>
            </div>

            <div class="widget" style="line-height: 1.5">
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

            <div class="widget" style="line-height: 1.5">
                <h3><?php echo __('Admission Notification', 'srft-theme');?></h3>
<?php 
$current_language = get_locale();
$catslug = ($current_language === 'hi_IN') ? 'admission-hi' : 'admission-en';

$admission_post = new WP_Query(array(
    'post_type' => 'admission',
    'tax_query' => array(
        array(
            'taxonomy' => 'category',  // WordPress default category taxonomy
            'field'    => 'slug',
            'terms'    => $catslug,
        ),
    ),
    'posts_per_page' => -1,
));

if ($admission_post->have_posts()) {
    echo '<ul style="list-style-type: none">';
    while ($admission_post->have_posts()) {
        $admission_post->the_post(); 
        ?>
        <li>
            <a href="<?php the_permalink(); ?>" target="_blank">
                <?php the_title(); ?>
            </a>
        </li>
        <?php
    }
    echo '</ul>';
} else {
    echo '<p>No admission posts found for this language.</p>';
}

wp_reset_postdata();
?>



                <!--<div class="link-span"><a href="<?php echo esc_url(site_url('/vacancy/')); ?>"><?php echo __('More', 'srft-theme' ); ?></a></div> --> 
            </div>
<div class="widget" style="line-height: 1.5">
                <h4><?php echo __('Sample Question Papers', 'srft-theme'); ?></h4>
                <?php 
                // Set document category slug based on language
                $catslug = ($current_language === 'en_US') ? 'document-en' : 'document-hi';

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
                        $document_category = get_field('document-category'); 
                        $document_description = get_field('document_description');

                        if ($document_category === 'Question Paper') {
                            if ($document_file) :
                                // Get the file details
                                $file_url = $document_file['url'];
                                $file_id = $document_file['ID'];
                                $file_size = @filesize(get_attached_file($file_id)); // Suppress errors with @
                                $file_type_info = wp_check_filetype($file_url);
                                $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                                $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                                ?>

                                <li>
                                    <a href="<?php echo esc_url($file_url); ?>">
                                        <?php echo esc_html(get_the_title()); ?> 
                                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="Download" style="vertical-align: middle;" />
                                        <?php echo __('Download', 'srft-theme');?> &nbsp; (<?php echo esc_html($file_size_mb); ?>)
                                    </a>
                                </li>

                            <?php endif; 
                        } 
                    }
                    echo '</ul>';
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }

                wp_reset_postdata(); // Reset query
                ?>   
            </div>                
        </div> <!-- Closing div for leftnav -->

        <div class="main-content">
        <div>
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
        </div>
        <div class="page-title">
            <div><p class="page-header-text"><?php the_title(); ?></p></div>
        </div>

        <div>
            <div style="margin-bottom: 2.5rem;">
            <?php echo str_replace(array('<p>', '</p>'), '', $page_content);
 ?>  
            </div>
        </div>
    </div> <!-- Closing div for main-content -->
 <!-- Closing main tag -->
    </section>
     <!-- Closing section for cine-detail -->

<?php get_footer(); ?>
