<?php
/*
Template Name: Film Research
 */
get_header(); 
$post_id = get_the_ID();
$catslug = get_the_category($post_id);

$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();

if ($current_language === 'en_US') {
  $catslug = 'takeone-en'; 
} else {
  $catslug = 'takeone-hi';
}

?>

<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php the_title(); ?></div>
      </section>
      <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
        <!--<div>
          <p class="office-header-text">Management</p>-->
          <!--<div class="ftest">Satyajit Ray Film & Television Institute</div>-
        </div>-->
        
        <div class="widget" style="line-height: 1.5">
        <h4><?php echo __('Take One', 'srft-theme'); ?> </h4>
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
                        if ($document_category === 'Take One') {
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
                                    <?php echo __('Download', 'srft-theme');?> &nbsp; (<?php echo esc_html($file_size_mb); ?>)
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

  <div class="main-content">
   <div>      
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>
   <div>
        <p class="page-header-text"><?php the_title(); ?></p>
    </div> 
 
  <section class="sub-intro" style="margin-bottom: 4rem;">
        <div class="sub-intro-text" style="max-width: 100%;">
            <div class="sub-intro-text-description">
                <?php
                // Retrieve and display the introduction of the page content
                $intro = get_post_meta(get_the_ID(), 'SubIntroDescription', true);
                echo $intro;
                ?>
            </div>
        </div>
    </section>

    <div>
            <p class="page-header-text"><?php echo __('Independent Research Fellowship Programme', 'srft-theme'); ?></p>
          </div>
 
    <section style="margin-bottom: 4rem;">
    <div><?php the_content(); ?></div>   
    </section>
</div>        
</main>


<?php
get_footer(); 
?>