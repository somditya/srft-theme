<?php
/*
Template Name: Management
 */
get_header(); 
$post_id = get_the_ID();
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
        
        <div class="widget" style="line-height: 1.5">
        <ul style="list-style-type: none ">
          <li><?php echo __('Memorandum of Association', 'srft-theme' ); ?>  <img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li> 
          <li><?php echo __('Academic Bye-Laws ', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Financial Bye-Laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Service By-laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
        </ul>   
        </div>
        </div>

        <div class="main-content">
    <div>
        <p class="page-header-text"><?php echo __('Administrative Structure', 'srft-theme'); ?></p>
    </div>  
    <section class="sub-intro" style="margin-bottom: 4rem;">
        <div class="sub-intro-text" style="max-width: 100%;">
            <div class="sub-intro-text-description">
                <?php
                // Retrieve and display the introduction of the page content
                $intro = get_post_meta(get_the_ID(), 'Admin_Intro', true);
                echo $intro;
                ?>
            </div>
        </div>
    </section>

    <div>
        <p class="page-header-text"><?php echo __('Society', 'srft-theme' ); ?></p>
    </div>
    <section style="margin-bottom: 4rem;">
    <div><h3><?php echo __('Composition', 'srft-theme' ); ?></h3></div>
        <div>
            <?php
            // Retrieve and display the society part of the page content
            $society = get_post_meta(get_the_ID(), 'Society', true);
            echo $society;
            ?>
        </div>
        <div><h3><?php echo __('Present Member', 'srft-theme' ); ?></h3></div>
         <div class="wrapper">
              <div class="Rtable Rtable--5cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme' ); ?></div>
                </div>
                <?php
                
                if ($current_language === 'en_US') {
                  $catslug='societymember-en'; 
                 }
                  else
                  {
                    $catslug='societymember-hi';
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
                  <div class="Rtable-cell name-cell">
                    <div class="Rtable-cell--content "><?php the_title(); ?></div>
                  </div>
                  <div class="Rtable-cell designation-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
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
    </section>     

    <div>
        <p class="page-header-text"><?php echo __('Governing Council', 'srft-theme' ); ?></p>
    </div>
    <section style="margin-bottom: 4rem;">
    <div><h3><?php echo __('Composition', 'srft-theme' ); ?></h3></div>
        <div style="margin-bottom: 1.5rem;">
            <?php
            // Retrieve and display the Governing Council part of the page content
            $gc = get_post_meta(get_the_ID(), 'GC', true);
            echo $gc;
            ?>
        </div>
        <div><h3><?php echo __('Present Member', 'srft-theme' ); ?></h3></div>
         <div class="wrapper">
              <div class="Rtable Rtable--5cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme' ); ?></div>
                </div>
                <?php
                
                if ($current_language === 'en_US') {
                  $catslug='gcmember-en'; 
                 }
                  else
                  {
                    $catslug='gcmember-hi';
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
                  <div class="Rtable-cell name-cell">
                    <div class="Rtable-cell--content "><?php the_title(); ?></div>
                  </div>
                  <div class="Rtable-cell designation-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
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
    </section>
    <div>
        <p class="page-header-text"><?php echo __('Standing Finance Council', 'srft-theme' ); ?></p>
    </div>
    
    <section style="margin-bottom: 4rem;">
    <div><h3><?php echo __('Composition', 'srft-theme' ); ?></h3></div>
    <div style="margin-bottom: 1.5rem;">
            <?php
            // Retrieve and display the Governing Council part of the page content
            $sfc = get_post_meta(get_the_ID(), 'SFC', true);
            echo $sfc;
            ?>
        </div>
        <div><h3><?php echo __('Present Member', 'srft-theme' ); ?></h3></div>
         <div class="wrapper">
              <div class="Rtable Rtable--5cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme' ); ?></div>
                </div>
                <?php
                
                if ($current_language === 'en_US') {
                  $catslug='sfcmember-en'; 
                 }
                  else
                  {
                    $catslug='sfcmember-hi';
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
                  <div class="Rtable-cell name-cell">
                    <div class="Rtable-cell--content "><?php the_title(); ?></div>
                  </div>
                  <div class="Rtable-cell designation-cell">
                    <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
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
    </section>
    <div>
        <p class="page-header-text"><?php echo __('Academic Council', 'srft-theme' ); ?></p>
    </div>
    <section style="margin-bottom: 4rem;">
    <div><h3><?php echo __('Composition', 'srft-theme' ); ?></h3></div>
    <div style="margin-bottom: 1.5rem;">
            <?php
            // Retrieve and display the Governing Council part of the page content
            $ac = get_post_meta(get_the_ID(), 'AC', true);
            echo $ac;
            ?>
        </div>
        <div><h3><?php echo __('Present Member', 'srft-theme' ); ?></h3></div>
         <div class="wrapper">
              <div class="Rtable Rtable--5cols Rtable--collapse">
                <div class="Rtable-row Rtable-row--head">
                  <div class="Rtable-cell slno-cell column-heading"><?php echo __('SL.No.', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell name-cell column-heading"><?php echo __('Name', 'srft-theme' ); ?></div>
                  <div class="Rtable-cell designation-cell column-heading"><?php echo __('Designation', 'srft-theme' ); ?></div>
                </div>
                <?php
                
                if ($current_language === 'en_US') {
                  $catslug='acmember-en'; 
                 }
                  else
                  {
                    $catslug='acmember-hi';
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
                  <div class="Rtable-cell name-cell">
                    <div class="Rtable-cell--content "><?php the_title(); ?></div>
                  </div>
                  <div class="Rtable-cell designation-cell">
                  <div class="Rtable-cell--content "><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></div>
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
    </section>
</div>
        
</main>

 
    <?php
get_footer(); 
?>