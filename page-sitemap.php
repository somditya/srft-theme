<?php
/*
Template Name: Sitemap
*/
get_header(); 

$post_id = get_the_ID();
$page_content = apply_filters('the_content', get_post_field('post_content', $post_id));

// Retrieve the featured image URL
//$featured_image_url = get_the_post_thumbnail_url($post_id, 'large');
?>
<main>
    <!-- Content area -->
    <div class="static-container">
    <div>      
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
    </div>
        <section class="page-title">
            <div>
                <p class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></p>
            </div>
        </section>

        <section>
        <?php
        // Function to get the menu structure by location or ID
        function get_menu_structure($menu_location) {
            $menu_items = wp_get_nav_menu_items($menu_location);
            $menu_structure = [];

            if ($menu_items) {
                foreach ($menu_items as $item) {
                    if (!$item->menu_item_parent) {
                        $menu_structure[$item->ID] = [
                            'title' => $item->title,
                            'url' => $item->url,
                            'children' => []
                        ];
                    } else {
                        $menu_structure[$item->menu_item_parent]['children'][] = $item;
                    }
                }
            }
            
            return $menu_structure;
        }

        // Get the menu structures for both primary and footer menus
        $locale = get_locale(); // You can also set $locale manually if needed
        if ($locale === 'hi_IN') { // Define menu name based on language
            $primary_menu_structure = get_menu_structure('primary_hindi');
            $footer_menu_structure = get_menu_structure('footer_hindi');
        } else {
            $primary_menu_structure = get_menu_structure('primary');
            $footer_menu_structure = get_menu_structure('footer');
        }
        ?>

        <div class="sitemap-container">
            <!-- Display Primary Menu Items -->
            <?php foreach ($primary_menu_structure as $item): ?>
                <div class="sitemap-item">
                    <span class="sitemap-main-item"><?php echo esc_html($item['title']); ?></span>
                    <?php if (!empty($item['children'])): ?>
                        <div class="sitemap-submenu">
                            <?php foreach ($item['children'] as $child): ?>
                                <a href="<?php echo esc_url($child->url); ?>"><?php echo esc_html($child->title); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

            <!-- Display Footer Menu Items -->
            <?php foreach ($footer_menu_structure as $item): ?>
                <div class="sitemap-item">
                    <span class="sitemap-main-item"><?php echo esc_html($item['title']); ?></span>
                    <?php if (!empty($item['children'])): ?>
                        <div class="sitemap-submenu">
                            <?php foreach ($item['children'] as $child): ?>
                                <a href="<?php echo esc_url($child->url); ?>"><?php echo esc_html($child->title); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        </div>
        </section>
    </div>
</main>

<?php get_footer(); ?>
