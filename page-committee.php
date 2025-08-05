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
            <h1 class="page-banner-title"><?php echo __('Committees', 'srft-theme' ); ?></h1>
        </div>
    </section>

    <section id="skip-to-content" class="cine-detail">

    <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
    <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
            }
    ?>
   </div>
    </div>
        <aside class="leftnav">
        <aside class="leftnav" role="complementary" aria-labelledby="sidebar-heading">
        <h2 id="sidebar-heading" class="sr-only">Side-bar navigation</h2>
        <nav class="childnavs" aria-label="<?php echo __('About Us Sub-Menu Section', 'srft-theme'); ?>">
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
        </aside>

        <div class="main-content" role="main">
        <div>      
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
         </div>
            <div>
                <h2 class="page-header-text"><?php echo __('Important Committees', 'srft-theme'); ?></h2>
            </div>  
            <div style="margin-bottom: 4rem;">    
                <div><?php the_content(); ?></div>   
            </div>     
        </div>
    </section>


<?php get_footer(); ?>
