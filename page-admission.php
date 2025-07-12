<?php 

/*
Template Name: Admisison PG
 */
get_header();
$post_id = get_the_ID();
$catslug = get_the_category($post_id);
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>
    <main>
      <section  class="cine-header" style="--bg-img: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <h2 class="page-banner-title"><?php echo __('Admission', 'srft-theme'); ?></h2>  
        </div>
      </section>

    <section  id="skip-to-content" class="cine-detail">
      
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
    
          </div>
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
          <div class="widget" style="line-height: 1.5">
          <h3><?php echo __('Admission Notification', 'srft-theme');?></h3>
          <?php
          $category_posts = new WP_Query(array(
          'category_name' => 'admissionshort-en', // Replace with your category slug
        'posts_per_page' => 5,
    ));

    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
        $post_link = get_permalink();
    ?>
    <h3><a href=<?php echo $post_link ?>><?php the_title(); ?></a></h3>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>
        <div class="link-span"><a  href="<?php echo esc_url(site_url('/vacancy/')); ?>"><?php echo __('More', 'srft-theme' ); ?></a></div>  
      </div>
  </div>

    <div class="main-content" >
        <div>     
           <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
      ?></div>
        <div  class="page-title">
          <div><p class="page-header-text"><?php echo __('Programme Overview', 'srft-theme'); ?></p></div>
        </div>
        <div class="sub-intro">
          <div class="sub-intro-images">
           <div>
            <img class="intro-images" src="<?php bloginfo('template_url'); ?>/images/srfti-front.jpg"
                 alt="SRFTI Entrance">
           </div>
          </div>
          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true); ?></div>
          
           <div class="sub-intro-text-description">
           <?php echo get_post_meta(get_the_ID(), 'SubIntroDescription', true); ?>
          </div>
          </div>
        </div>
        <section class="section-home">
  <div class="tabs">
    <div class="tab-2">
      <label for="tab2-1"><?php echo __('Master of Fine Arts in Cinema', 'srft-theme'); ?></label>
      <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
      <div>
        <p><?php echo __('The programme is a 1-Year Bridge Programme + 2-Year Master of Fine Arts(MFA) Programme', 'srft-theme'); ?></p>   
        <br/><br/>
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Duration for Cinema Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Duration', 'srft-theme'); ?></h2>
              <p><?php echo __(' 1-Year Bridge Programme + 2-Year MFA', 'srft-theme'); ?></p>
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Number of students for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('No. of students', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'StudentCinema', true); ?>     
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Specialization for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Specialization offered', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'SpecializationCinema', true); ?>
            </li>
          </ul>
          <!--<ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Course structure for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Course Structure', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'CourseCinema', true); ?>
            </li>
          </ul>-->
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Essential Qualification for Cinema Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Essential Qualifications', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'QualificationCinema', true); ?>
            </li>
          </ul>
        </div>
      </div>
    </div> <!-- Closing .tab-2 -->

    <div class="tab-2">
      <label for="tab2-2"><?php echo __('Master of Fine Arts in EDM', 'srft-theme'); ?></label>
      <input id="tab2-2" name="tabs-two" type="radio">
      <div>
        <p><?php echo __('The programme is a 2-Year Master of Fine Arts(MFA) Programme', 'srft-theme'); ?></p>
        <br/><br/>
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" aria-label="<?php echo __('Show or hide Duration for EDM Programme', 'srft-theme'); ?>" checked>
              <i></i>
              <h2><?php echo __('Duration', 'srft-theme'); ?></h2>
              <p><?php echo __('2-Year MFA', 'srft-theme'); ?></p>
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide No. of Student for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('No. of students', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'StudentEDM', true); ?>    
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Specialization for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Specialization offered', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'SpecializationEDM', true); ?>    
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Course structure for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Course Structure', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'CourseEDM', true); ?>   
            </li>
          </ul>
          <ul>
            <li>
              <input type="checkbox" checked aria-label="<?php echo __('Show or hide Essential Qualification for EDM Programme', 'srft-theme'); ?>">
              <i></i>
              <h2><?php echo __('Essential Qualifications', 'srft-theme'); ?></h2>
              <?php echo get_post_meta(get_the_ID(), 'QualificationEDM', true); ?> 
            </li>
          </ul>
        </div>
      </div>
    </div> <!-- Closing .tab-2 -->
  </div> <!-- Closing .tabs -->
</section>

      
      </div>
      
        
      </section>
    <?php get_footer();  ?>