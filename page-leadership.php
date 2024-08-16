<?php

/*
Template Name: Leadership

 */
get_header();
$current_language = get_locale();
?>
 <!--<div data-scroll-container>-->
<main>
      <body>
      <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('About SRFTI', 'srft-theme'); ?></div>
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
        <!--<div class="widget">
         
        </div> --->
        </div>

        <div class="main-content">
          <section class="page-title">
            <div>
              <p class="page-header-text"><?php echo __('Under their leadership', 'srft-theme' ); ?></p>
            </div>
          </section>
          
    <section class="profile">
        <div class="two-flex">
          <div class="col-left">
            <div class="profile-container">
            <img class="imgg-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'ChairmanPhoto', true)); ?>">
              <div class="profile-text">
                <div class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Chairman', true); ?></div>
                <div class="profile-desg"><?php echo __('Chairman', 'srft-theme' ); ?></div>
              </div>   
            </div>
          
          </div>

          <div class="col-right"><div class="profile-desc">
          <?php echo get_post_meta(get_the_ID(), 'ChairmanBio', true); ?>

<p style="color:#8b5b2b; margin-top: 1rem;">email: chairman@srfti.ac.in</p></div>
        </div>
          </div>
          </section>

          <section class="profile">
        <div class="two-flex">
          <div class="col-left">
            <div class="profile-container">
            <img class="img-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'DirectorPhoto', true)); ?>">
              <div class="profile-text">
                <div class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Director', true); ?></div>
                <div class="profile-desg"><?php echo __('Director', 'srft-theme' ); ?></div>
              </div>   
            </div>
          
          </div>

          <div class="col-right"><div class="profile-desc">
          <?php echo get_post_meta(get_the_ID(), 'DirectorBio', true); ?>

<p style="color:#8b5b2b; margin-top: 1rem;">email: director@srfti.ac.in</p></div>
        </div>
          </div>
          </section>
          
<section class="profile"> 
          <div class="two-flex">
            <div class="col-left">
              <div class="profile-container">
              <img class="img-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'DeanPhoto', true)); ?>">
                <div class="profile-text">
                  <div class="profile-name"> <?php echo get_post_meta(get_the_ID(), 'Dean', true); ?></div>
                  <div class="profile-desg"><?php echo __('Dean', 'srft-theme' ); ?></div>
                </div>   </div>
            
            </div>
  
            <div class="col-right">
              <div class="profile-desc">
              <?php echo get_post_meta(get_the_ID(), 'DeanBio', true); ?>

<p style="color:#8b5b2b; margin-top: 1rem;">email: dean@srfti.ac.in</p></div>
          </div>
            </div>
</section>

<section class="profile">
        <div class="two-flex">
          <div class="col-left">
            <div class="profile-container">
            <img class="img-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'RegistrarPhoto', true)); ?>">
              <div class="profile-text">
                <div class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Registrar', true); ?></div>
                <div class="profile-desg"><?php echo __('Registrar', 'srft-theme' ); ?></div>
              </div>   
            </div>
          
          </div>

          <div class="col-right"><div class="profile-desc">
          <?php echo get_post_meta(get_the_ID(), 'RegistrarBio', true); ?>

<p style="color:#8b5b2b; margin-top: 1rem;">email: registrar@srfti.ac.in</p></div>
        </div>
          </div>
          </section>

        <section class="one-flex" style="margin-top: 10rem; margin-bottom: 10rem;">
        <div class="accordian">
          <ul>
            <li>
              <input type="checkbox" checked>
              <i></i>
              <h2><?php echo __('Previous Chairmans', 'srft-theme' ); ?></h2>
              
            </li>
          </ul>
            <ul>
              <li>
                <input type="checkbox" checked>
                <i></i>
                <h2><?php echo __('Previous Directors', 'srft-theme' ); ?></h2>
                <p>
                <?php echo get_post_meta(get_the_ID(), 'PreviousDirectors', true); ?>
            </p>
                </table>
              </li>
              <ul>
                <li>
                  <input type="checkbox" checked>
                  <i></i>
                  <h2><?php echo __('Previous Registrars', 'srft-theme' ); ?></h2>
                  <p>
                    <tbody>
                      <th>Name</th>
                      <th>Tenure</th>
                    </tbody> </p>
                  </table>
                </li>
              </ul>
            </ul>
          </div>
          </section>
    </main>

    <?php
get_footer(); 
?>

