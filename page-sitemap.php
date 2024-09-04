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
        <section class="page-title">
                <div>
                    <p class="page-header-text"><?php echo esc_html($post->post_title); ?></p>
                </div>
            </section>
        </section>
        <section>
        <?php
// Replace 'primary' with your menu's location or the menu name/ID
$menu_items = wp_get_nav_menu_items('primary');

$menu_structure = [];
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
?>
<div class="sitemap-container">
    <?php foreach ($menu_structure as $item): ?>
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
</div>

<?php get_footer();  ?>