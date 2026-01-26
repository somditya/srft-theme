<?php
/**
 * Template Name: Social Hub (Live Feeds)
 * Description: Accessible Social Media Hub with live API feeds (Instagram, Facebook, YouTube)
 */
get_header();
?>

<main>
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>');">
        <div class="page-banner">
            <h1 class="page-banner-title"><?php _e('Social Hub', 'srft-theme'); ?></h1>
            <p class="page-banner-subtitle"><?php _e('Your brand\'s social presence', 'srft-theme'); ?></p>
        </div>
    </section>

    <div class="container-aligned">
        <div class="breadcrumbs-wrapper">
            <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' ); } ?>
        </div>
    </div>

    <section class="cine-detail social-feed-section">
        <div class="main-content" style="width: 100%;">
            <div class="page-title">
                <h2 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h2>
            </div>

            <section class="section-home">
                <div class="social-tabs-container">
                    <!-- Search Bar -->
                    <div class="social-search-bar">
                        <input type="text" id="social-search" placeholder="<?php _e('Search posts...', 'srft-theme'); ?>" aria-label="Search posts">
                        <button class="view-toggle grid-view active" aria-label="Grid view" data-view="grid">
                            <span class="dashicons dashicons-grid-view"></span>
                        </button>
                        <button class="view-toggle list-view" aria-label="List view" data-view="list">
                            <span class="dashicons dashicons-list-view"></span>
                        </button>
                    </div>

                    <!-- Social Media Tabs -->
                    <div class="tabs social-tabs">
                        <div role="tablist" aria-labelledby="tablist-social" class="manual social-tablist">
                            <?php
                            $social_tabs = [
                                'all' => [
                                    'label' => __('All', 'srft-theme'),
                                    'icon' => '🌐'
                                ],
                                'twitter' => [
                                    'label' => __('Twitter', 'srft-theme'),
                                    'icon' => '𝕏'
                                ],
                                'instagram' => [
                                    'label' => __('Instagram', 'srft-theme'),
                                    'icon' => '📷'
                                ],
                                'facebook' => [
                                    'label' => __('Facebook', 'srft-theme'),
                                    'icon' => 'f'
                                ],
                                'vimeo' => [
                                    'label' => __('Vimeo', 'srft-theme'),
                                    'icon' => '▶'
                                ],
                            ];
                            
                            $i = 0;
                            foreach ($social_tabs as $id => $tab_data) {
                                $is_first = $i === 0;
                                $tab_id = 'social-tab-' . ($i + 1);
                                $tabpanel_id = 'social-tabpanel-' . ($i + 1);
                                
                                echo '<button id="' . esc_attr($tab_id) . '" type="button" role="tab"';
                                echo ' aria-selected="' . ($is_first ? 'true' : 'false') . '"';
                                echo ' aria-controls="' . esc_attr($tabpanel_id) . '"';
                                echo ($is_first ? '' : ' tabindex="-1"') . ' class="social-tab" data-platform="' . esc_attr($id) . '">';
                                echo '<span class="tab-icon">' . $tab_data['icon'] . '</span>';
                                echo '<span class="tab-label">' . esc_html($tab_data['label']) . '</span>';
                                echo '</button>';
                                $i++;
                            }
                            ?>
                        </div>

                        <?php
                        // Platform mapping for custom post type
                        $platforms_map = [
                            'social-tabpanel-1' => 'all',
                            'social-tabpanel-2' => 'twitter',
                            'social-tabpanel-3' => 'instagram',
                            'social-tabpanel-4' => 'facebook',
                            'social-tabpanel-5' => 'vimeo',
                        ];

                        function render_social_posts($platform) {
                            $args = [
                                'post_type' => 'social_post',
                                'posts_per_page' => 50, // Limit to 50 most recent posts
                                'orderby' => 'date',
                                'order' => 'DESC',
                            ];

                            if ($platform !== 'all') {
                                $args['meta_query'] = [
                                    [
                                        'key' => 'social_platform',
                                        'value' => $platform,
                                        'compare' => '='
                                    ]
                                ];
                            }

                            $query = new WP_Query($args);

                            if ($query->have_posts()) {
                                echo '<div class="social-posts-grid">';
                                while ($query->have_posts()) {
                                    $query->the_post();
                                    $post_id = get_the_ID();
                                    $platform_type = get_post_meta($post_id, 'social_platform', true);
                                    $post_url = get_post_meta($post_id, 'social_post_url', true);
                                    $post_image = get_post_meta($post_id, 'social_post_image', true);
                                    $post_text = get_post_meta($post_id, 'social_post_text', true);
                                    $post_date = get_the_date('M d, Y');
                                    $brand_name = get_post_meta($post_id, 'social_brand_name', true) ?: 'Your Brand';
                                    $brand_handle = get_post_meta($post_id, 'social_brand_handle', true) ?: '@yourbrand';
                                    $likes = get_post_meta($post_id, 'social_likes', true) ?: '0';
                                    $comments = get_post_meta($post_id, 'social_comments', true) ?: '0';
                                    $shares = get_post_meta($post_id, 'social_shares', true) ?: '0';

                                    // Platform color coding
                                    $platform_colors = [
                                        'twitter' => '#1DA1F2',
                                        'instagram' => 'linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%)',
                                        'facebook' => '#1877F2',
                                        'vimeo' => '#1ab7ea',
                                    ];

                                    $border_style = isset($platform_colors[$platform_type]) 
                                        ? (strpos($platform_colors[$platform_type], 'linear-gradient') !== false 
                                            ? 'border-top: 3px solid; border-image: ' . $platform_colors[$platform_type] . '; border-image-slice: 1;'
                                            : 'border-top: 3px solid ' . $platform_colors[$platform_type] . ';')
                                        : 'border-top: 3px solid #ccc;';

                                    echo '<article class="social-post-card" data-platform="' . esc_attr($platform_type) . '" style="' . $border_style . '">';
                                    
                                    // Post Header
                                    echo '<div class="post-header">';
                                    echo '<div class="brand-info">';
                                    echo '<div class="brand-avatar">YB</div>';
                                    echo '<div class="brand-details">';
                                    echo '<h3 class="brand-name">' . esc_html($brand_name) . '</h3>';
                                    echo '<p class="brand-handle">' . esc_html($brand_handle) . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    
                                    // Platform badge
                                    $platform_icons = [
                                        'twitter' => '𝕏',
                                        'instagram' => '📷',
                                        'facebook' => 'f',
                                        'vimeo' => '▶',
                                    ];
                                    $icon = $platform_icons[$platform_type] ?? '•';
                                    echo '<span class="platform-badge platform-' . esc_attr($platform_type) . '">' . $icon . '</span>';
                                    echo '</div>';

                                    // Post Content
                                    if ($post_text) {
                                        echo '<div class="post-text">' . esc_html($post_text) . '</div>';
                                    }

                                    // Post Media
                                    if ($post_image) {
                                        echo '<div class="post-media">';
                                        echo '<a href="' . esc_url($post_url) . '" target="_blank" rel="noopener noreferrer">';
                                        echo '<img src="' . esc_url($post_image) . '" alt="' . esc_attr(get_the_title()) . '" loading="lazy">';
                                        echo '</a>';
                                        echo '</div>';
                                    }

                                    // Post Footer
                                    echo '<div class="post-footer">';
                                    echo '<div class="post-stats">';
                                    echo '<span class="stat"><span class="dashicons dashicons-heart"></span> ' . esc_html(number_format($likes)) . '</span>';
                                    echo '<span class="stat"><span class="dashicons dashicons-admin-comments"></span> ' . esc_html(number_format($comments)) . '</span>';
                                    echo '<span class="stat"><span class="dashicons dashicons-share"></span> ' . esc_html(number_format($shares)) . '</span>';
                                    echo '</div>';
                                    echo '<div class="post-actions">';
                                    if ($post_url) {
                                        echo '<a href="' . esc_url($post_url) . '" target="_blank" rel="noopener noreferrer" class="view-post-btn">';
                                        echo '<span class="dashicons dashicons-external"></span> ' . __('View', 'srft-theme');
                                        echo '</a>';
                                    }
                                    echo '</div>';
                                    echo '</div>';

                                    echo '<div class="post-date">' . esc_html($post_date) . '</div>';

                                    echo '</article>';
                                }
                                echo '</div>';
                                wp_reset_postdata();
                            } else {
                                echo '<div class="no-posts-message">';
                                echo '<p>' . __('No posts available for this platform.', 'srft-theme') . '</p>';
                                echo '</div>';
                            }
                        }

                        $i = 1;
                        foreach ($platforms_map as $tab_class => $platform) {
                            $is_first = $i === 1;
                            $tab_id = 'social-tab-' . $i;
                            
                            echo '<div id="' . esc_attr($tab_class) . '" role="tabpanel" aria-labelledby="' . esc_attr($tab_id) . '"';
                            echo ($is_first ? '' : ' class="is-hidden"') . '>';
                            
                            render_social_posts($platform);
                            
                            echo '</div>';
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </section>
</main>

<script>
jQuery(document).ready(function($) {
    // Tab switching functionality
    const tabs = document.querySelectorAll('[role="tab"]');
    const tabPanels = document.querySelectorAll('[role="tabpanel"]');

    tabs.forEach(tab => {
        tab.addEventListener('click', changeTabs);
    });

    function changeTabs(e) {
        const target = e.currentTarget;
        const parent = target.parentNode;
        const grandparent = parent.parentNode;

        parent.querySelectorAll('[aria-selected="true"]').forEach(t => {
            t.setAttribute('aria-selected', false);
            t.setAttribute('tabindex', '-1');
        });

        target.setAttribute('aria-selected', true);
        target.removeAttribute('tabindex');

        grandparent.querySelectorAll('[role="tabpanel"]').forEach(p => {
            p.classList.add('is-hidden');
        });

        const controls = target.getAttribute('aria-controls');
        document.getElementById(controls).classList.remove('is-hidden');
    }

    // Search functionality
    $('#social-search').on('keyup', function() {
        const searchTerm = $(this).val().toLowerCase();
        $('.social-post-card').each(function() {
            const postText = $(this).find('.post-text').text().toLowerCase();
            const brandName = $(this).find('.brand-name').text().toLowerCase();
            
            if (postText.includes(searchTerm) || brandName.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // View toggle
    $('.view-toggle').on('click', function() {
        const view = $(this).data('view');
        $('.view-toggle').removeClass('active');
        $(this).addClass('active');
        
        if (view === 'list') {
            $('.social-posts-grid').addClass('list-view');
        } else {
            $('.social-posts-grid').removeClass('list-view');
        }
    });
});
</script>

<?php get_footer(); ?>