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
        <h1 class="page-banner-title"><?php echo __('About the Institute', 'srft-theme'); ?></h1>
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
        <h2 class="page-header-text"><?php echo __('A brief history', 'srft-theme'); ?></h2>
        <div class="sub-intro">
            <div class="sub-intro-images">
                <div>
                    <img class="intro-images" src="<?php bloginfo('template_url'); ?>/images/Ray-by-Nemai-Ghosh-1024x677.jpg" style="width: 100%;" alt="Black and white photo of Satyajit Ray holding a film camera">
                </div>
            </div>
            <div class="sub-intro-text">
                <div class="sub-intro-text-description">
                    <?php echo $page_content; ?>
                </div>
            </div>
        </div>

        <div>
            <h3 class="page-header-text" style="margin-top: 1.2rem;"><?php echo __('Our Journey', 'srft-theme'); ?></h3>
        </div>
       <?php wp_reset_postdata(); ?> 
            <div class="sub-intro" style="margin-bottom: 4rem;">
                <div class="sub-intro-text" style="max-width: 100%; padding: 0; background-color: #fff;">
                    <div class="sub-intro-text-description">
                        <?php
                        // Retrieve and display the introduction of the page content
                        $intro = get_post_meta(get_the_ID(), 'journey', true);
                        echo $intro;
                        ?>
                    </div>
                </div>
            </div>

        <div>
            <h3 class="page-header-text" style="margin-top: 1.2rem;"><?php echo __('History Snapshots', 'srft-theme'); ?></h3>
        </div>

        <div class="container">
            <div class="grid-gallery">
                <?php
                $image_paths = [
                    'foundation-01.jpg', 'foundation-02.jpg', 'foundation-03.jpg', 'foundation-04.jpg', 
                    'foundation-05.jpg', 'foundation-06.jpg', 'foundation-07.jpg', 'foundation-08.jpg', 
                    'foundation-09.jpg', 'foundation-10.jpg', 'foundation-11.jpg', 'foundation-12.jpg', 
                    'foundation-13.JPG', 'foundation-17.jpg', 'foundation-15.jpg', 'foundation-16.jpg'
                ];
                foreach ($image_paths as $index => $filename) {
                    $alt_text = "Picture " . ($index + 1) . " of construction of SRFTI";
                    echo '<img src="' . get_bloginfo('template_url') . '/images/' . $filename . '" alt="' . esc_attr($alt_text) . '" class="single-image" />';
                }
                ?>
            </div>
        </div>

        <!--<div>
            <p class="page-header-text" style="margin-top: 1.2rem;"><?php echo __('Explore Our Story', 'srft-theme'); ?></p>
        </div>-->

        <!--<div class="one-flex" style="margin: 10px;">
            <video class="homepage-masthead__video" id="homepage-masthead__video" poster="<?php bloginfo('template_url'); ?>/images/intro-still.jpg" 
       style="width: 100%;" style="width: 100%;" controls loop muted aria-label="Introductory video showcasing our Institute.">
                <source src="<?php bloginfo('template_url'); ?>/videos/intro.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>-->
    </div>
</section>

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
