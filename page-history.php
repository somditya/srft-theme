<?php
/*
Template Name: About

 */
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
?>

<main>
<section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title">About SRFTI</div>
</section>
<section  id="skip-to-content" class="cine-detail">
        <div class="leftnav">
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
        <!--<div class="widget">
         
        </div> --->
        </div>

        <div class="main-content">
       
           
              <p class="page-header-text"><?php echo __('A brief history', 'srft-theme'); ?></p>
          <section class="sub-intro">
            <div class="sub-intro-images" >
            <div>
              <img class="intro-images" src="<?php bloginfo('template_url'); ?>/images/Ray-by-Nemai-Ghosh-1024x677.jpg" width="100%" alt="Black and white photo of Satyajit Ray holding a film camera" >
            </div>
            </div>
            <div class="sub-intro-text" >
             <!--<div class="sub-intro-text-head"><?php echo __('History', 'srft-theme'); ?></div>-->
            
             <div class="sub-intro-text-description" >
             <?php echo $page_content; ?>

            </div>
            </div>
          </section>

          <div>
              <p class="page-header-text" style="margin-top: 1.2rem;"><?php echo __('History Snapshots', 'srft-theme' ); ?></p>
            </div>
        <!--<scction class="one-flex" >
        <div class="container">
	<div class="gallery">
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-01.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-02.jpg" target="_blanK" class="single-image" />	
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-03.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-04.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-05.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-06.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-07.jpg" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-08.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-09.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-10.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-11.jpg" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-12.jpg" target="_blanK" class="single-image" />
 
	</div> 
</div>
 

        </scction>-->
<div class="container">
  <div class="grid-gallery">
  <img src="<?php bloginfo('template_url'); ?>/images/foundation-01.jpg" alt="Picture 1 of construction of SRFTI" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-02.jpg" alt="Picture 2 of construction of SRFTI" target="_blanK" class="single-image" />	
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-03.jpg" alt="Picture 3 of construction of SRFTI" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-04.jpg" alt="Picture 4 of construction of SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-05.jpg" alt="Picture 5 of construction of SRFTI" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-06.jpg" alt="Picture 6 of construction of SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-07.jpg" alt="Picture 7 of construction of SRFTI" target="_blanK" class="single-image" />
		<img src="<?php bloginfo('template_url'); ?>/images/foundation-08.jpg" alt="Picture 8 of construction of SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-09.jpg" alt="Picture 9 of construction of SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-10.jpg" alt="Picture of 1st GC Meeting of SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-11.jpg" alt="Picture of Buddhadeb Dasgupta visiting SRFTI construction site" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-12.jpg" alt="Picture of 1st GC Meeting of SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-13.JPG" alt="Picture Adoor Gopalakrishnan visiting SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-17.jpg" alt="Picture Shakti Samanta inaugurating Clapstick 2004" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-15.jpg" alt="Picture Said Mirza & Mrinal Sen in SRFTI" target="_blanK" class="single-image" />
    <img src="<?php bloginfo('template_url'); ?>/images/foundation-16.jpg" alt="Picture Basu Chatterjee & Shaji N Karun in SRFTI" target="_blanK" class="single-image" />
    
  </div>
</div>
        <div><p class="page-header-text" style="margin-top: 1.2rem;"><?php echo __('Explore Our Story', 'srft-theme' ); ?></p></div>
        <scction class="one-flex" style="margin: 10px;" >
          <video autoplay="false" class="homepage-masthead__video" id="homepage-masthead__video" loop="true" muted="true" playsinline="true" poster="#" width="100%">
            <source src="<?php bloginfo('template_url'); ?>/videos/intro.mp4" type="video/mp4">
          </video>
        </scction>
        <section>

        </section>
    </main>
    <div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="modal-body">
     
    </div>
  </div>
</div>
    <?php
get_footer(); 
?>