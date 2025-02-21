<?php
/*
Template Name: Facilities
*/

get_header();
global $post;  // Declare global $post
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();  // Get the current language/locale
$current_page_title = get_the_title(); // Get current page title
?>

<main>
    <!-- Page Header Section -->
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>');">
        <div class="page-banner">
            <h2 class="page-banner-title"><?php echo __('Facilities', 'srft-theme'); ?></h2>
        </div>
    </section>

    <section id="skip-to-content" class="cine-detail">
        <div class="leftnav">
            <div class="childnavs">
                <div class="childnavs">
                    <?php
                    // Define menu name based on language.
                    $menu_name = ($current_language === 'hi_IN') ? 'hindi_facility_menu' : 'english_facility_menu';

                    // Define a custom menu walker to modify the menu output.
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

                    // Display the menu based on the language and custom walker.
                    wp_nav_menu(array(
                        'menu' => $menu_name,
                        'container' => false,
                        'menu_class' => 'childnav-lists',
                        'walker' => new Custom_Walker_Nav_Menu(),
                    ));
                    ?>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div>
                <?php if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                } ?>
            </div>

            <div>
                <h2 class="page-header-text"><?php echo esc_html(get_the_title()); ?></h2>
            </div>  

            <div style="margin-bottom: 4rem;">
                <?php the_content(); ?>   
            </div>
        </div>
    </section>


<?php get_footer(); ?>
