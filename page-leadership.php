<?php
/*
Template Name: Leadership
*/
get_header();
$current_language = get_locale();
?>

<main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h1 class="page-banner-title"><?php echo __('Leadership', 'srft-theme'); ?></h1>
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
            <nav class="childnavs" aria-label="<?php echo __('About Us', 'srft-theme'); ?>">
                <?php
                $current_language = get_locale();
                $menu_name = ($current_language === 'hi_IN') ? 'hindi_admin_menu' : 'english_admin_menu';
                $current_page_title = get_the_title();

                class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
                    public function start_lvl(&$output, $depth = 0, $args = null) {
                        $output .= '<ul class="submenu">';
                    }
                    public function start_el(&$output, $item, $depth = 0, $args = null, $current_object_id = 0) {
                        global $current_page_title;
                        $is_current = ($item->title === $current_page_title) ? 'active' : '';
                        $output .= '<li class="childnav-list-item ' . $is_current . '">';
                        $output .= '<a class="item" href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a>';
                    }
                    public function end_el(&$output, $item, $depth = 0, $args = null) {
                        $output .= '</li>';
                    }
                    public function end_lvl(&$output, $depth = 0, $args = null) {
                        $output .= '</ul>';
                    }
                }

                wp_nav_menu(array(
                    'menu' => $menu_name,
                    'container' => false,
                    'menu_class' => 'childnav-lists',
                    'walker' => new Custom_Walker_Nav_Menu(),
                ));
                ?>
            </nav>
        </div>

        <div class="main-content" role="main">
            <div class="page-title">
                <div>
                    <h2 class="page-header-text"><?php echo __('Under their leadership', 'srft-theme' ); ?></h2>
                </div>
            </div>
          
            <div class="profile">
                <div class="two-flex">
                    <div class="col-left">
                        <div class="profile-container">
            <img class="img-responsive" src="<?php echo esc_url(str_replace('{site_url}',get_site_url(),get_post_meta(get_the_ID(), 'ChairmanPhoto', true))); ?>" alt="<?php echo get_post_meta(get_the_ID(), 'Chairman', true) . ' profile'; ?>">
                            <div class="profile-text">
                                <h3 class="custom-profile-heading">
                                <span class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Chairman', true); ?></span>
                                <span class="profile-desg"><?php echo __('Chairman', 'srft-theme' ); ?></sp>
                                <h3>
                            </div>   
                        </div>        
                    </div>

                    <div class="col-right">
                        <div class="profile-desc">
                            <?php echo get_post_meta(get_the_ID(), 'ChairmanBio', true); ?>
                            <p style="color:#8b5b2b; margin-top: 1rem;">email: chairman@srfti.ac.in</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile">
                <div class="two-flex">
                    <div class="col-left">
                        <div class="profile-container">
                            <img class="img-responsive" src="<?php echo esc_url(str_replace('{site_url}',get_site_url(),get_post_meta(get_the_ID(), 'DirectorPhoto', true))); ?>" alt="<?php echo get_post_meta(get_the_ID(), 'Director', true) . ' profile'; ?>">
                            <div class="profile-text">
                                <h3 class="custom-profile-heading">
                                <span class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Director', true); ?></span>
                                <span class="profile-desg"><?php echo __('Vice-Chancellor', 'srft-theme' ); ?></span>
                                <h3>                           
                            </div>   
                        </div>
                    </div>

                    <div class="col-right">
                        <div class="profile-desc">
                            <?php echo get_post_meta(get_the_ID(), 'DirectorBio', true); ?>
                            <p style="color:#8b5b2b; margin-top: 1rem;">email: director@srfti.ac.in</p>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="profile"> 
                <div class="two-flex">
                    <div class="col-left">
                        <div class="profile-container">
                            <img class="img-responsive" src="<?php echo esc_url(str_replace('{site_url}',get_site_url(),get_post_meta(get_the_ID(), 'DeanPhoto', true))); ?>" alt="<?php echo get_post_meta(get_the_ID(), 'Dean', true) . ' profile'; ?>">
                            <div class="profile-text">
                                <h3 class="custom-profile-heading">
                                <span class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Dean', true); ?></span><br/>
                                <span class="profile-desg"><?php echo __('Dean', 'srft-theme' ); ?></span>
                                </h3>
                            </div>   
                        </div>
                    </div>

                    <div class="col-right">
                        <div class="profile-desc">
                            <?php echo get_post_meta(get_the_ID(), 'DeanBio', true); ?>
                            <p style="color:#8b5b2b; margin-top: 1rem;">email: dean@srfti.ac.in</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="profile">
                <div class="two-flex">
                    <div class="col-left">
                        <div class="profile-container">
                            <img class="img-responsive" src="<?php echo esc_url(str_replace('{site_url}',get_site_url(),get_post_meta(get_the_ID(), 'RegistrarPhoto', true))); ?>" alt="<?php echo get_post_meta(get_the_ID(), 'Registrar', true) . ' profile'; ?>">
                            <div class="profile-text">
                                <h3 class="custom-profile-heading">
                                <span class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Registrar', true); ?></span>
                                <br/>
                                <span class="profile-desg"><?php echo __('Registrar', 'srft-theme' ); ?></span>
                                </h3>
                            </div>   
                        </div>
                    </div>

                    <div class="col-right">
                        <div class="profile-desc">
                            <?php echo get_post_meta(get_the_ID(), 'RegistrarBio', true); ?>
                            <p style="color:#8b5b2b; margin-top: 1rem;">email: registrar@srfti.ac.in</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="one-flex" style="margin-top: 10rem; margin-bottom: 10rem;">
                <!--<div class="accordian">
                    <ul>
                        <li>
                            <input type="checkbox" >
                            <i></i>
                            <h2><?php echo __('Previous Chairmans', 'srft-theme' ); ?></h2>
                            <p>
                                <?php echo get_post_meta(get_the_ID(), 'PreviousChairmans', true); ?>
                            </p>
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <input type="checkbox" checked aria-label="<?php echo __('Show or hide previous directors', 'srft-theme'); ?>">
                            <i></i>
                            <h2><?php echo __('Previous Directors', 'srft-theme' ); ?></h2>
                            <p>
                                <?php echo get_post_meta(get_the_ID(), 'PreviousDirectors', true); ?>
                            </p>    
                        </li>
                    </ul>

                    <ul>
                        <li>
                            <input type="checkbox" checked aria-label="<?php echo __('Show or hide previous registrars', 'srft-theme'); ?>">
                            <i></i>
                            <h2><?php echo __('Previous Registrars', 'srft-theme' ); ?></h2>     
                            <p>
                                <?php echo get_post_meta(get_the_ID(), 'PreviousRegistrars', true); ?>
                            </p>             
                        </li>
                    </ul>
                </div>-->

<div id="accordionGroup" class="accordion">
  <h3>
    <button type="button" aria-expanded="true" class="accordion-trigger" aria-controls="sect1" id="accordion1id">
      <span class="accordion-title">
       <?php echo __('Previous Chairmans', 'srft-theme' ); ?>
        <span class="accordion-icon"></span>
      </span>
    </button>
  </h3>
  <div id="sect1" role="region" aria-labelledby="accordion1id" class="accordion-panel">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'PreviousChairmans', true); ?>  
      
    </div>
  </div>
  <h3>
    <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect2" id="accordion2id">
      <span class="accordion-title">
        <?php echo __('Previous Directors', 'srft-theme' ); ?>
        <span class="accordion-icon"></span>
      </span>
    </button>
  </h3>
  <div id="sect2" role="region" aria-labelledby="accordion2id" class="accordion-panel" hidden="">
    <div>
      <?php echo get_post_meta(get_the_ID(), 'PreviousDirectors', true); ?>
    </div>
  </div>
  <h3>
    <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect3" id="accordion3id">
      <span class="accordion-title">
        <?php echo __('Previous Registrar', 'srft-theme' ); ?>
        <span class="accordion-icon"></span>
      </span>
    </button>
  </h3>
  <div id="sect3" role="region" aria-labelledby="accordion3id" class="accordion-panel" hidden="">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'PreviousRegistrars', true); ?>  
    </div>
  </div>
</div>


            </div>
        </div>
    </section>
<?php
get_footer(); 
?>
