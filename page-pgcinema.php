<?php

/*Template Name: PG Programme Cinema*/
get_header();
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
$post_id = get_the_ID();
$catslug=get_post_meta(get_the_ID(), 'Category', true);

// Get the category IDs for the post

// Initialize the category slug variable

$title=get_the_title($post_id);
?>
<main>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __($title, 'srft-theme'); ?></div>
      </section>

      <section id="skip-to-content"class="cine-detail">
        <div class="leftnav">
          
        <div class="childnavs">
       
    <ul class="childnav-lists">
    <h4> <?php echo __('Related Links', 'srft-theme'); ?> </h4>
        <?php
        $current_language = get_locale(); // Get the current language/locale.

        $menu_name = ($current_language === 'hi_IN') ? 'hindi_pg_menu' : 'english_pg_menu'; // Define menu name based on language.

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
                if ($current_language === 'en_US') {
                    $catslg = 'document-en'; 
                } else {
                    $catslg = 'document-hi';
                }

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
                        
                        // ACF Fields
                        $document_file = get_field('document');
                        $document_category = get_field('document-category'); // Returns an array with URL and other data
                        $document_description = get_field('document_description');
                        if ($document_category === 'Prospectus') {
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
                                    (<?php echo esc_html($file_type); ?> - <?php echo esc_html($file_size_mb); ?>)
                                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="Download" style="vertical-align: middle;" />
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
        
        <?php 
        $intro = get_post_meta(get_the_ID(), '$Intro', true);
        $subintro= get_post_meta(get_the_ID(), '$SubIntro', true);
        $subintrodesc= get_post_meta(get_the_ID(), '$SubIntroDescription', true);
        ?>
                
        <div class="intro"><p><?php echo get_post_meta(get_the_ID(), 'Intro', true);?></p></div>
        
        <!--<section class="sub-intro">
          <div class="sub-intro-images">
            <div class="iframe-wrapper">
              <iframe class="wrapped-iframe" src="https://www.youtube.com/embed/XznE74RwM3E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          </div>

          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true);?></div>

           <div class="sub-intro-text-description">
           <?php echo get_post_meta(get_the_ID(), 'Intro', true);?> 
          </div>
          </div>
        </section>-->
        <?php
          $youtube_url = get_post_meta(get_the_ID(), 'Video', true);
        ?>
        <section class="sub-intro">
          <div class="sub-intro-images">
            <div class="iframe-wrapper">
              <iframe class="wrapped-iframe" src="<?php echo esc_url($youtube_url); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
          </div>
          <div class="sub-intro-text">
           <!--<div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true);?></div>-->
           <div class="sub-intro-text-head"><?php echo __('Take a tour of the Departments', 'srft-theme'); ?></div>
          
           <div class="sub-intro-text-description">
           <?php echo get_post_meta(get_the_ID(), 'SubIntroDescription', true);?> 
          </div>
          </div>
           <div>
        <p class="page-header-text" style="margin-top: 2rem;"><?php echo get_post_meta(get_the_ID(), 'Tagline', true);?></p>
    </div> 
          <div>
           
            <?php echo get_post_meta(get_the_ID(), 'AbtPGProgramme', true);?>
          </div>
        </section>
        
        <div>
        <p class="page-header-text" style="margin-top: 2rem;"><?php echo __('Specializations', 'srft-theme'); ?></p>
    </div> 
        
        <section style="margin-top: rem;">
        <div class="box-container">
        <?php
            /*if ($current_language === 'en_US') {
              $catslug='pgcinema-en'; 
             }
            else
            {
            $catslug='pgcinema-hi';
            }*/
            $args = array(
              'post_type' => 'page',
              'category_name' => $catslug, // Replace with your category slug
              'posts_per_page' => -1,
          );          
          $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
        ?>    
          <div class="cell">
          <a href="<?php the_permalink(); ?>" target="_blank">
          <?php
           $thumb_url=get_post_meta(get_the_ID(), 'Thumb_url', true);
            if (!empty($thumb_url)) {
              echo '<img class="img-responsive" src="' . esc_url($thumb_url) . '" alt="feature image of the department">';
               }
           ?>
            <div class="txt">
              <div class="caption">
                <?php echo get_post_meta(get_the_ID(), 'Department', true);?>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/arrow-angular.svg" alt="arrow icon to indicate link" style="filter: invert(1);"></div>
              </div></a>
          </div>
          
          <!--<div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 2">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Cinematography', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 08.jpg" class="img-responsive" alt="Image 3">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Direction & Screenplay Writing', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 4">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Editing', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 5">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Producing for Film & Television', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img  class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>
          <div class="cell">
            <img src="/web2/images/Pg 09_b.jpg" class="img-responsive" alt="Image 6">
            <div class="txt">
              <div class="caption">
                <h1><?php echo __('Sound Recording & Design', 'srft-theme'); ?></h1>
              </div>
              <div style="width: 25px;  margin-left:10px;"><img class="img-responsive" src="<?php bloginfo('template_url'); ?>/web2/images/arrow-angular.svg" style="filter: invert(1);"></div>
              </div>
          </div>-->
          <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>
        </div>
      </section>  
    </main>
    <?php
get_footer();

?> 