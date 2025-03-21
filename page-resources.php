<?php
/*
Template Name: Resources
*/
get_header(); 
$post_id = get_the_ID();
$post = get_post($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main>
    <section  class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>');">
        <div class="page-banner">
            <h2 class="page-banner-title"><?php the_title(); ?></h2>
        </div>
    </section>

    <section  id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="widget" style="line-height: 1.5; margin-top: 1rem;">
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
                        if ($document_category === 'Statutory') {
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
                                <a href="<?php echo esc_url($file_url); ?>">
                                    <?php echo esc_html(get_the_title()); ?> 
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="Download" style="vertical-align: middle;" />
                                    (<?php echo __('Download', 'srft-theme');?> &nbsp; - <?php echo esc_html($file_size_mb); ?>)
                                </a>
                            </li>

                        <?php endif; 
                    } }
                    echo '</ul>';
                } else {
                    echo __('No posts found in the specified category.', 'srft-theme');
                }

                wp_reset_postdata(); // Reset after custom query
                ?>
            </div>
        </div>

        <div  class="main-content">
        <div>      
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
        </div> 
           
           <div>
                <h2 class="page-header-text"><?php echo esc_html(get_the_title()); ?></h2>
            </div>  
            

            <section style="margin-bottom: 4rem;">
               <div>
                <?php echo do_shortcode(wp_kses_post($post->post_content)); ?>
              </div>   
            </section>


        </div>
    </section>              


<?php
get_footer(); 
?>
