<?php
/*
Template Name: Resources
*/
get_header(); 
$post_id = get_the_ID();
$post = get_post($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
$page_header = get_post_meta(get_the_ID(), 'Intro', true);
                        
?>

<main role="main">
    <section  class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>');">
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

    <section  id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <aside role="complementary">
            <div class="widget" style="line-height: 1.5; margin-top: 1rem;" role="complementary">
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
        
        // Check if category is Statutory and file exists
        if ($document_category === 'Statutory' && $file_id) {
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
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="PDF, opens in a new tab" style="vertical-align: middle;" />
                        (<?php echo __('Download', 'srft-theme'); ?> - <?php echo esc_html($file_size_mb); ?>)
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
        </div>

        <div  class="main-content" role="main">        
           <div>
                <h2 class="page-header-text"><?php echo esc_html($page_header); ?></h2>
            </div>  
            

            <section style="margin-bottom: 4rem;">
               <div>
                <?php echo do_shortcode(wp_kses_post($post->post_content)); ?>
              </div>   
            </section>


        </div>
    </section>              

            </main>
<?php
get_footer(); 
?>
