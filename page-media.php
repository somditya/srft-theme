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
            <h2 class="page-banner-title"><?php _e('Media Gallery', 'srft-theme'); ?></h2>
        </div>
    </section>

    <section class="cine-detail">
        <div class="main-content" style="width: 100%;">

            <!-- Breadcrumb -->
            <div><?php if (function_exists('yoast_breadcrumb')) yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); ?></div>

            <!-- Title -->
            <div class="page-title">
                <h2 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h2>
            </div>

            <!-- Tabs -->
            <section class="section-home">
                <div class="phototabs">
                    <?php
                    $tabs = [
                        'tab1' => __('Events & Festivals', 'srft-theme'),
                        'tab2' => __('Workshops & Masterclasses', 'srft-theme'),
                        'tab3' => __('Beyond the Frame', 'srft-theme'),
                        'tab4' => __('Campus Moments', 'srft-theme'),
                        'tab5' => __('SRFTI in News', 'srft-theme'),
                    ];
                    $i = 0;
                    foreach ($tabs as $id => $label) {
                        echo '<div class="phototab">';
                        echo '<label for="' . esc_attr($id) . '">' . esc_html($label) . '</label>';
                        echo '<input id="' . esc_attr($id) . '" name="tabs" type="radio"' . ($i === 0 ? ' checked' : '') . '>';
                        echo '</div>';
                        $i++;
                    }
                    ?>
                </div>

                <?php
                $categories_map = [
                    'tab-content1' => ['Convocation', 'Event', 'Festival'],
                    'tab-content2' => ['Workshops', 'Masterclass', 'Seminars'],
                    'tab-content3' => ['Student Stills'],
                    'tab-content4' => ['Campus Life'],
                    'tab-content5' => ['News'],
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

                foreach ($categories_map as $tab_class => $categories) {
                    echo '<div class="tab-content ' . esc_attr($tab_class) . '">';
                    $empty_message = match ($tab_class) {
                        'tab-content1' => 'No albums available for Events & Festivals.',
                        'tab-content2' => 'No albums available for Workshops & Masterclasses.',
                        'tab-content3' => 'No albums available for Beyond the Frame.',
                        'tab-content4' => 'No albums available for Campus Moments.',
                        'tab-content5' => 'No albums available for News.',
                        default => 'No albums available.',
                    };
                    render_album_content($categories, $empty_message);
                    echo '</div>';
                }
                ?>
            </section>
        </div>
    </section>
</main>

<?php get_footer(); ?>
