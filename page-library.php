<?php
/*
Template Name: Library
 */
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>
<main>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <h1 class="page-banner-title"><?php echo __('Facilities', 'srft-theme' ); ?></h1>
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
        <div class="leftnav">
          <!--<div>
          <p class="office-header-text">Management</p>-->
          <!--<div class="ftest">Satyajit Ray Film & Television Institute</div>-
        </div>-->
        <div class="childnavs">
            
    <nav class="childnav-lists">
        <?php
        $current_language = get_locale(); // Get the current language/locale.

        $menu_name = ($current_language === 'hi_IN') ? 'hindi_facility_menu' : 'english_facility_menu'; // Define menu name based on language.

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
    </nav>
</div>
        
     <h4 style="margin-top: 2.5rem;"> <?php echo __('Related Links', 'srft-theme'); ?> </h4>
        <div class="childnav-lists">
            <ul class="submenu">
          <li class="childnav-list-item"><a class="item" href="https://opac.srfti.ac.in/" target="_blank"  title="<?php echo __('Online Public Access Catalogue', 'srft-theme' ); ?>" onclick="return check_url();"><?php echo __('Online Public Access Catalogue', 'srft-theme' ); ?></a></li>
          <li class="childnav-list-item"><a class="item" href="https://ndl.iitkgp.ac.in/" target="_blank"  title="<?php echo __('National Digital Library', 'srft-theme' ); ?>" onclick="return check_url();"><?php echo __('National Digital Library', 'srft-theme' ); ?></a></li>
          <li class="childnav-list-item"><a class="item" href="https://vimeo.com/channels/srftifilms" target="_blank"  title="<?php echo __('Vimeo', 'srft-theme' ); ?>" onclick="return check_url();"><?php echo __('Vimeo', 'srft-theme' ); ?></a></li>
        </ul>
        </div>       <!--<div class="widget" style="line-height: 1.5">
        <ul style="list-style-type: none ">
          <li><?php echo __('Memorandum of Association', 'srft-theme' ); ?>  <img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li> 
          <li><?php echo __('Academic Bye-Laws ', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Financial Bye-Laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
          <li><?php echo __('Service By-laws', 'srft-theme' ); ?><img src="<?php bloginfo('template_url'); ?>/images/icons8-download-25-color.png" style="vertical-align: middle;"/></li>
        </ul>   
        </div>-->
        </div>

  <div class="main-content">
    <div>
        <p class="page-header-text"><?php the_title(); ?></p>
    </div>  
    <div class="sub-intro" style="margin-bottom: 4rem;">
        <div class="sub-intro-text" style="max-width: 100%;">
            <div class="sub-intro-text-description">
                <?php
                // Retrieve and display the introduction of the page content
                $intro = get_post_meta(get_the_ID(), 'SubIntroDescription', true);
                echo $intro;
                ?>
            </div>
        </div>
    </div>

    <!--<div>
        <p class="page-header-text"><?php echo __('Library of SRFTI', 'srft-theme' ); ?></p>
    </div>-->
    <section style="margin-bottom: 4rem;">
    <?php echo str_replace(array('<p>', '</p>'), '', $page_content);
 ?>   
    </section>
</div>
    </section>        

 
    <?php
get_footer(); 
?>