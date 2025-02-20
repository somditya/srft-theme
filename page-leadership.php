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
            <h2 class="page-banner-title"><?php echo __('Leadership', 'srft-theme'); ?></h2>
        </div>  
    </section>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="childnavs">
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
            <div class="page-title">
                <div>
                    <h2 class="page-header-text"><?php echo __('Under their leadership', 'srft-theme' ); ?></h2>
                </div>
            </div>
          
            <div class="profile">
                <div class="two-flex">
                    <div class="col-left">
                        <div class="profile-container">
                            <img class="img-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'ChairmanPhoto', true)); ?>" alt="Photo of the chairman">
                            <div class="profile-text">
                                <div class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Chairman', true); ?></div>
                                <div class="profile-desg"><?php echo __('Chairman', 'srft-theme' ); ?></div>
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
                            <img class="img-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'DirectorPhoto', true)); ?>" alt="Photo of the director">
                            <div class="profile-text">
                                <div class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Director', true); ?></div>
                                <div class="profile-desg"><?php echo __('Director', 'srft-theme' ); ?></div>
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
                            <img class="img-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'DeanPhoto', true)); ?>" alt="Photo of the dean">
                            <div class="profile-text">
                                <div class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Dean', true); ?></div>
                                <div class="profile-desg"><?php echo __('Dean', 'srft-theme' ); ?></div>
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
                            <img class="img-responsive" src="<?php echo esc_url(get_post_meta(get_the_ID(), 'RegistrarPhoto', true)); ?>" alt="Photo of the registrar">
                            <div class="profile-text">
                                <div class="profile-name"><?php echo get_post_meta(get_the_ID(), 'Registrar', true); ?></div>
                                <div class="profile-desg"><?php echo __('Registrar', 'srft-theme' ); ?></div>
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
                <div class="accordian">
                    <ul>
                        <li>
                            <input type="checkbox" checked aria-label="<?php echo __('Show or hide previous chairman', 'srft-theme'); ?>">
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
                </div>
            </div>
        </div>
    </section>
<?php
get_footer(); 
?>
