<?php
/*
Template Name: Media
*/
get_header();

$post_id = get_the_ID();
?>

<main>
    <!-- Banner -->
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'large')); ?>');">
        <div class="page-banner">
            <h1 class="page-banner-title"><?php _e('Media Gallery', 'srft-theme'); ?></h1>
        </div>
    </section>

    <div class="container-aligned">
        <div class="breadcrumbs-wrapper">
            <?php if ( function_exists( 'yoast_breadcrumb' ) ) { yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' ); } ?>
        </div>
    </div>

    <section class="cine-detail">
        <div class="main-content" style="width: 100%;">
            <!-- Title -->
            <div class="page-title">
                <h2 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h2>
            </div>

            <!-- Accessible Tabs -->
            <section class="section-home">
                <div class="tabs">
                    <h3 id="tablist-media"><?php _e('Media Categories', 'srft-theme'); ?></h3>
                    <div role="tablist" aria-labelledby="tablist-media" class="manual phototabs">
                        <?php
                        $tabs = [
                            'events-festivals' => __('Events & Festivals', 'srft-theme'),
                            'master-classes' => __('Master Classes & Workshops', 'srft-theme'),
                            'beyond-frame' => __('Beyond the Frame', 'srft-theme'),
                            'campus-moments' => __('Campus Moments', 'srft-theme'),
                            'srfti-news' => __('SRFTI in News', 'srft-theme'),
                        ];
                        
                        $i = 0;
                        foreach ($tabs as $id => $label) {
                            $is_first = $i === 0;
                            $tab_id = 'tab-' . ($i + 1);
                            $tabpanel_id = 'tabpanel-' . ($i + 1);
                            
                            echo '<button id="' . esc_attr($tab_id) . '" type="button" role="tab"';
                            echo ' aria-selected="' . ($is_first ? 'true' : 'false') . '"';
                            echo ' aria-controls="' . esc_attr($tabpanel_id) . '"';
                            echo ($is_first ? '' : ' tabindex="-1"') . ' class="phototab">';
                            echo  esc_html($label);
                            echo '</button>';
                            $i++;
                        }
                        ?>
                    </div>

                    <?php
                    $categories_map = [
                        'tabpanel-1' => ['Convocation', 'Event', 'Festival'],
                        'tabpanel-2' => ['Workshops', 'Masterclass', 'Seminars'],
                        'tabpanel-3' => ['Student Stills'],
                        'tabpanel-4' => ['Campus Life'],
                        'tabpanel-5' => ['News'],
                    ];

                    function render_album_content($categories, $empty_msg) {
                        // Step 1: Get all relevant pictures
                        $query = new WP_Query([
                            'post_type' => 'picture',
                            'posts_per_page' => -1,
                            'meta_query' => [
                                [
                                    'key' => 'Picture_Category',
                                    'value' => $categories,
                                    'compare' => is_array($categories) ? 'IN' : '='
                                ]
                            ],
                        ]);

                        // Step 2: Group by Album_Name
                        $grouped = [];
                        foreach ($query->posts as $post) {
                            $album_name = get_post_meta($post->ID, 'Album_Name', true);
                            $picture_order = intval(get_post_meta($post->ID, 'Picture_Order', true));
                            if ($album_name) {
                                $grouped[$album_name][] = [
                                    'post' => $post,
                                    'order' => $picture_order
                                ];
                            }
                        }

                        if (!empty($grouped)) {
                            // Step 3: Sort images within each album by Picture_Order ASC
                            foreach ($grouped as $album => &$items) {
                                usort($items, fn($a, $b) => $a['order'] <=> $b['order']);
                            }
                            unset($items);

                            // Step 4: Sort albums by latest post date DESC
                            uasort($grouped, function ($a, $b) {
                                return strtotime($b[0]['post']->post_date) - strtotime($a[0]['post']->post_date);
                            });

                            // Step 5: Output albums
                            foreach ($grouped as $album_name => $images) {
                                $cover = $images[0]['post'];
                                $cover_url = get_field('Picture_File', $cover->ID);

                                echo "<div class='album-container'>";
                                echo "<h3 class='album-title'>" . esc_html($album_name) . "</h3>";
                                echo '<a href="' . esc_url($cover_url) . '" data-lightbox="' . esc_attr(sanitize_title($album_name)) . '" data-title="' . esc_attr($cover->post_title) . '">';
                                echo '<img src="' . esc_url($cover_url) . '" alt="' . esc_attr($album_name) . '" class="gallery-image">';
                                echo '</a>';

                                foreach ($images as $item) {
                                    $img = $item['post'];
                                    if ($img->ID !== $cover->ID) {
                                        $img_url = get_field('Picture_File', $img->ID);
                                        echo '<a href="' . esc_url($img_url) . '" data-lightbox="' . esc_attr(sanitize_title($album_name)) . '" data-title="' . esc_attr($img->post_title) . '"></a>';
                                    }
                                }

                                echo "</div>";
                            }
                        } else {
                            echo '<p>' . esc_html($empty_msg) . '</p>';
                        }
                    }

                    $i = 1;
                    foreach ($categories_map as $tab_class => $categories) {
                        $is_first = $i === 1;
                        $tab_id = 'tab-' . $i;
                        
                        echo '<div id="' . esc_attr($tab_class) . '" role="tabpanel" aria-labelledby="' . esc_attr($tab_id) . '"';
                        echo ($is_first ? '' : ' class="is-hidden"') . '>';
                        
                        $empty_message = match ($tab_class) {
                            'tabpanel-1' => 'No albums available for Events & Festivals.',
                            'tabpanel-2' => 'No albums available for Workshops & Masterclasses.',
                            'tabpanel-3' => 'No albums available for Beyond the Frame.',
                            'tabpanel-4' => 'No albums available for Campus Moments.',
                            'tabpanel-5' => 'No albums available for News.',
                            default => 'No albums available.',
                        };
                        
                        render_album_content($categories, $empty_message);
                        echo '</div>';
                        $i++;
                    }
                    ?>
                </div>
            </section>
        </div>
    </section>
</main>


<?php get_footer(); ?>