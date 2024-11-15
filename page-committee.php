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
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <div class="page-banner-title"><?php echo __('About SRFTI', 'srft-theme' ); ?></div>
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
            <div>
                <p class="page-header-text"><?php echo __('Committees', 'srft-theme'); ?></p>
            </div>  
            <section style="margin-bottom: 4rem;">    
                <div><?php the_content(); ?></div>   
            </section>     
        </div>
    </section>
</main>

<?php get_footer(); ?>
