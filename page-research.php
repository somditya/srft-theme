<?php
/*
Template Name: Film Research
*/
get_header(); 

// Get post ID
$post_id = get_the_ID();
global $post;

// Get current language
$current_language = get_locale();
$catslug = ($current_language === 'en_US') ? 'takeone-en' : 'takeone-hi';

// Get content
$page_content = apply_filters('the_content', $post->post_content);
?>

<main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>');">
        <div class="page-banner">
            <h1 class="page-banner-title"><?php the_title(); ?></h1>
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
        <aside class="leftnav" role="complementary" aria-labelledby="sidebar-heading">
        <h2 id="sidebar-heading" class="sr-only">Downloadable Take-One Volumes</h2>    
        <div class="widget" style="line-height: 1.5">
                <h2><?php echo __('Take One', 'srft-theme'); ?></h2>
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
        
        // Check if category is Take One and file exists
        if ($document_category === 'Take One' && $file_id) {
            $file_url = wp_get_attachment_url((int)$file_id);
            
            if ($file_url) {
                $file_size = @filesize(get_attached_file($file_id));
                $file_type_info = wp_check_filetype($file_url);
                $file_type = isset($file_type_info['ext']) ? strtoupper($file_type_info['ext']) : 'Unknown';
                $file_size_mb = ($file_size !== false) ? size_format($file_size, 2) : 'Unknown';
                ?>
                <li style="margin-bottom: 1rem;">
                    <a href="<?php echo esc_url($file_url); ?>" target="_blank" rel="noopener">
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
        </aside>

        <div class="main-content" role="main">

            <div>
                <h2 class="page-header-text"><?php echo __('Research at SRFTI', 'srft-theme'); ?></h2>
            </div> 

            <div class="sub-intro" style="margin-bottom: 4rem;">
                <div class="sub-intro-text" style="max-width: 100%;">
                    <div class="sub-intro-text-description">
                        <?php
                        // Retrieve and display the introduction of the page content
                        $intro = get_post_meta($post_id, 'SubIntroDescription', true);
                        echo esc_html($intro);
                        ?>
                    </div>
                </div>
            </div>

            <div>
                <h2 class="page-header-text"><?php echo __('Independent Research Fellowship Programme', 'srft-theme'); ?></h2>
            </div>

            <section style="margin-bottom: 4rem;">
                <div><?php echo wp_kses_post($page_content); ?>
</div>   
            </section>
        </div> <!-- Close main-content -->
    </section> <!-- Close cine-detail -->

            </main>
<?php get_footer(); ?>