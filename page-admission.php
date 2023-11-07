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
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('Admission to post graduate courses', 'srft-theme'); ?></div>
      </section>
      <section class="cine-detail">
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
        <div class="widget" style="line-height: 1.5">
        <ul style="list-style-type: none ">
          <li><?php echo __('Prsopectus', 'srft-theme' ); ?> <img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li> 
        </ul>   
        </div>
        <div class="widget" style="line-height: 1.5">
        <h3>Admission Notification</h3>
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

        <div class="main-content">
        <div><?php if(function_exists('bcn_display'))
{
bcn_display();
}?></div>
        <section class="page-title"><div><p class="page-header-text"><?php echo __('Course Overview', 'srft-theme'); ?></p></div></section>
        <section class="sub-intro">
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
        </section>

        <section class="section-home">
          <div class="tabs">
            <div class="tab-2">
              <label for="tab2-1"><?php echo __('Post Graduate Programme in Cinema', 'srft-theme'); ?></label>
              <input id="tab2-1" name="tabs-two" type="radio" checked="checked">
              <div>
                  <p><?php echo __('The programme is a 3-year full time programme divided into 6 semester.', 'srfti-theme')?></p>
                  <br/><br/>
                  <div class="accordian">
                    <ul>
                      <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h2><?php echo __('Duration', 'srft-theme'); ?></h2>
                        <p><?php echo __('3 years (full time)', 'srfti-theme') ?></p>
                      </li>
                    </ul>
                    <ul>
                      <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h2><?php echo __('No. of students', 'srft-theme'); ?></h2>
                        <?php echo get_post_meta(get_the_ID(), 'StudentCinema', true); ?>     
                      </li>
                    </ul>
                  
                    <ul>
                      <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h2><?php echo __('Specialization offered', 'srft-theme'); ?></h2>
                        <?php echo get_post_meta(get_the_ID(), 'SpecializationCinema', true); ?>
                       
                  </li>
                    </ul>
                    <ul>
                      <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h2><?php echo __('Course Structure', 'srft-theme'); ?></h2>
                        <?php echo get_post_meta(get_the_ID(), 'CourseCinema', true); ?>
                      </li>
                    </ul>
                      <ul>
                        <li>
                          <input type="checkbox" checked>
                          <i></i>
                          <h2><?php echo __('Essential Qualifications', 'srft-theme'); ?></h2>
                          <?php echo get_post_meta(get_the_ID(), 'QualificationCinema', true); ?>
                        </li>
                      </ul>
                     
                    </ul>
                    </div>
              </div>
            </div>
            <div class="tab-2">
              <label for="tab2-2"><?php echo __('Post Graduate Programme in EDM', 'srft-theme'); ?></label>
              <input id="tab2-2" name="tabs-two" type="radio">
              <div>
              <?php echo __('The programme is a 2-year full time programme divided into 4 semester', 'srft-theme'); ?>
                <br/><br/>
                <div class="accordian">
                  <ul>
                    <li>
                      <input type="checkbox" checked>
                      <i></i>
                      <h2><?php echo __('Duration', 'srft-theme'); ?></h2>
                      <p><?php echo __('2 years (full time)', 'srfti-theme') ?></p>

                    </li>
                  </ul>
                  <ul>
                    <li>
                      <input type="checkbox" checked>
                      <i></i>
                      <h2><?php echo __('No. of students', 'srft-theme'); ?></h2>
                      <?php echo get_post_meta(get_the_ID(), 'StudentEDM', true); ?>    
                    </li>
                  </ul>
                
                  <ul>
                    <li>
                      <input type="checkbox" checked>
                      <i></i>
                      <h2><?php echo __('Specialization offered', 'srft-theme'); ?></h2>
                      <?php echo get_post_meta(get_the_ID(), 'SpecializationEDM', true); ?>    
                    </li>
                  </ul>
                  <ul>
                    <li>
                      <input type="checkbox" checked>
                      <i></i>
                      <h2><?php echo __('Course Structure', 'srft-theme'); ?></h2>
                      <?php echo get_post_meta(get_the_ID(), 'CourseEDM', true); ?>   
                    </li>
                  </ul>
                    <ul>
                      <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h2><?php echo __('Essential Qualifications', 'srft-theme'); ?></h2>
                        <?php echo get_post_meta(get_the_ID(), 'QualificationEDM', true); ?> 
                      </li>
                    </ul>
                   
                  </ul>
                  </div>
            </div>
            </div>
          </div>
        </section>
    </main>
    <?php get_footer();  ?>