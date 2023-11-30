<?php
/*
Template Name: committee

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
          <div class="page-banner-title"><?php echo __('About SRFTI', 'srft-theme' ); ?></div>
      </section>

      <section class="cine-detail">
        <div class="leftnav">
          <!--<div>
          <p class="office-header-text">Management</p>-->
          <!--<div class="ftest">Satyajit Ray Film & Television Institute</div>-
        </div>-->
        <div class="childnavs">
    <ul class="childnav-lists">
        <?php
        $current_language = get_locale(); // Get the current language/locale.

        $menu_name = ($current_language === 'hi_IN') ? 'hindi_admin_menu' : 'english_admin_menu'; // Define menu name based on language.

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
        
<div class="widget" style="line-height: 1.5; margin-top: 2.5rem;">
        <?php 
        if ($current_language === 'en_US') {
          $catslug = 'download-en'; 
        } else {
          $catslug = 'download-hi';
        }
        $download_post = new WP_Query(array(
          'category_name' => $catslug, // Replace with your custom category name
          'posts_per_page' => 1,
          'orderby' => 'date',
          'order' => 'DESC',
        ));

        // Debugging: Output the contents of $download_post
       if ($download_post->have_posts()) {
        while ($download_post->have_posts()) {
          $download_post->the_post();
         }
           } else {
    echo 'No posts found in the specified category.';
        }
        ?>

        <ul style="list-style-type: none ">
          <li><a href="<?php echo esc_html(get_post_meta(get_the_ID(), 'MOA', true)); ?>"><?php echo __('Memorandum of Association', 'srft-theme'); ?> <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/><a></li> 
          <li><a href="<?php echo get_post_meta(get_the_ID(), 'ABL', true); ?>"><?php echo __('Academic Bye-Laws ', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></a></li>
          <li><a href="<?php echo get_post_meta(get_the_ID(), 'FBL', true); ?>"><?php echo __('Financial Bye-Laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/><a></li>
          <li><a href="<?php echo get_post_meta(get_the_ID(), 'SBL', true); ?>"><?php echo __('Service By-laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/><a></li>
          <li><a href="<?php echo get_post_meta(get_the_ID(), 'RL', true); ?>"><?php echo __('Rules & Regulation', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/><a></li>
          <li><a href="<?php echo get_post_meta(get_the_ID(), 'RR', true); ?>"><?php echo __('Recruitment Rule', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/><a></li>
        </ul>   
        </div>
        </div>

        <div class="main-content">
        <div><?php if(function_exists('bcn_display'))
{
bcn_display();
}?></div>
    <div>
        <p class="page-header-text"><?php echo __('Committees', 'srft-theme'); ?></p>
    </div>  
<section style="margin-bottom: 4rem;">    
      <div class="wrapper">
              <div class="Rtable Rtable--6cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell committee-cell column-heading"><?php echo __('Committee', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell composition-cell column-heading"><?php echo __('Composition', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell tenure-cell column-heading"><?php echo __('Tenure', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell openmeeting-cell column-heading"><?php echo __('Whether Meeting of these committees open to public', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell openminutes-cell column-heading"><?php echo __('Whether minutes of the meetings accessible for public', 'srft-theme' ); ?></div>
                </div>
                <?php
                

                  if ($current_language === 'en_US') {
                    $catslug='committee-en'; 
                   }
                    else
                    {
                      $catslug='committee-hi';
                    }
                    $category_posts = new WP_Query(array(
                        'category_name' => $catslug, // Replace with your category slug
                    ));
                  
                $count = 1; // Initialize the serial number/
             if ($category_posts->have_posts()) :
              while ($category_posts->have_posts()) :$category_posts->the_post();
            ?>
            
                 
                <div class="Rtable-row">
                  <div class="Rtable-cell slno-cell">
                    <div class="Rtable-cell--content "><?php echo $count; ?></div>
                  </div>
                  
                  <div class="Rtable-cell committee-cell">
                    <div class="Rtable-cell--content "><a href="<?php the_permalink(); ?>" ><?php echo get_the_title(); ?> </a></div>
                  </div>
                
                  <div class="Rtable-cell composition-cell">
                    <div class="Rtable-cell--content "><a href="<?php echo get_post_meta(get_the_ID(), 'Composition', true); ?>" ><?php echo __('Download', 'srft-theme' ); ?></a></div>
                  </div>
                  <div class="Rtable-cell tenure-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Tenure', true); ?></div>
                  </div>
                  <div class="Rtable-cell openmeeting-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'OpenMeeting', true); ?></div>
                  </div>
                  <div class="Rtable-cell openminutes-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'OpenMinutes', true); ?></div>
                  </div>
                </div>
                <?php
              $count++;
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>  
              </div>
              <!-- Use a CSS grid for layout -->
            </div>
  </div>
    </section>     

    <?php 
get_footer();
    ?>