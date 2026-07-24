<?php
/*
Template Name: Media
*/
get_header();

$post_id = get_the_ID();
?>

<main>
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
            <div class="page-title">
                <h2 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h2>
            </div>

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
                            echo esc_html($label);
                            echo '</button>';
                            $i++;
                        }
                        ?>
                    </div>

                    <?php
                    // Map each tab to the matching Album_Type select values
                    $categories_map = [
                        'tabpanel-1' => ['Convocation', 'Event', 'Festival'],
                        'tabpanel-2' => ['Workshop', 'Masterclass', 'Seminar'],
                        'tabpanel-3' => ['Student Still'],
                        'tabpanel-4' => ['Campus Life'],
                        'tabpanel-5' => ['News'],
                    ];

                    /**
                     * Normalizes an ACF image field value to a plain URL + alt text pair,
                     * regardless of whether the field returns an Array, an attachment ID,
                     * or (as with the mistyped picture_8 field) a plain Text/URL string.
                     */
                    function srft_get_picture_data($value) {
                        if (empty($value)) {
                            return ['url' => '', 'alt' => ''];
                        }

                        if (is_array($value) && isset($value['url'])) {
                            // ACF Image field set to "Array" return format
                            $alt = !empty($value['alt']) ? $value['alt'] : (!empty($value['title']) ? $value['title'] : '');
                            return ['url' => $value['url'], 'alt' => $alt];
                        }

                        if (is_numeric($value)) {
                            // ACF Image field set to "ID" return format
                            $url = wp_get_attachment_image_url($value, 'large');
                            $alt = get_post_meta($value, '_wp_attachment_image_alt', true);
                            if (empty($alt)) {
                                $attachment = get_post($value);
                                $alt = $attachment ? $attachment->post_title : '';
                            }
                            return ['url' => $url ? $url : '', 'alt' => $alt];
                        }

                        if (is_string($value)) {
                            // Fallback for the mistyped picture_8 Text field
                            return ['url' => $value, 'alt' => ''];
                        }

                        return ['url' => '', 'alt' => ''];
                    }

                    function render_album_content($categories, $empty_msg) {
                        $query = new WP_Query([
                            'post_type' => 'album',
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                            'order' => 'DESC',
                            'meta_query' => [
                                [
                                    'key' => 'album_type',
                                    'value' => $categories,
                                    'compare' => is_array($categories) ? 'IN' : '='
                                ]
                            ],
                        ]);

                        // Get current language (Polylang)
                        $current_language = function_exists('pll_current_language')
                            ? pll_current_language('slug')
                            : 'en';

                        $albums = [];

                        foreach ($query->posts as $post) {

                            // Album name: Hindi field with fallback to post title
                            if ($current_language === 'hi') {
                                $album_name = get_field('album_name_in_hindi', $post->ID);
                                if (empty($album_name)) {
                                    $album_name = get_the_title($post->ID);
                                }
                            } else {
                                $album_name = get_the_title($post->ID);
                            }

                            // Gather picture_1 ... picture_10
                            $images = [];
                            for ($n = 1; $n <= 15; $n++) {
                                $raw_value = get_field('picture_' . $n, $post->ID);
                                $picture_data = srft_get_picture_data($raw_value);

                                if (!empty($picture_data['url'])) {
                                    // Use the image's own alt text if set, otherwise
                                    // fall back to "Album Name - n" so it's never blank
                                    $alt = !empty($picture_data['alt'])
                                        ? $picture_data['alt']
                                        : $album_name . ' - ' . $n;

                                    $images[] = [
                                        'url'   => $picture_data['url'],
                                        'title' => $alt,
                                    ];
                                }
                            }

                            if (!empty($images)) {
                                $albums[] = [
                                    'name'   => $album_name,
                                    'images' => $images,
                                ];
                            }
                        }

                        if (!empty($albums)) {
                            echo '<ul class="gallery-album-list">';
                            foreach ($albums as $album) {
                                $album_name = $album['name'];
                                $images = $album['images'];
                                $cover_url = $images[0]['url'];

                                echo "<li class='album-list-item'>";
                                echo "<div class='album-container'>";
                                echo "<h3 class='album-title'>" . esc_html($album_name) . "</h3>";

                                // Album link opens the lightbox
                                echo '<a href="#" role="button" aria-haspopup="dialog" class="open-lightbox" data-album-name="' . esc_attr($album_name) . '" data-album-images="' . htmlspecialchars(json_encode($images), ENT_QUOTES, 'UTF-8') . '">';
                                echo '<img src="' . esc_url($cover_url) . '" alt="' . esc_attr($album_name) . '" class="gallery-image">';
                                echo '</a>';

                                echo "</div>";
                                echo "</li>";
                            }
                            echo '</ul>';
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

    <div id="image-lightbox-modal" class="lightbox-modal" role="dialog" aria-modal="true" aria-hidden="true">
        <div class="lightbox-content">
            <h2 id="lightbox-title" class="sr-only">Image Gallery</h2>
            <button id="lightbox-close-button" class="lightbox-close-btn" aria-label="Close">
                <span aria-hidden="true">✕</span>
            </button>

            <div id="lightbox-announcer" aria-live="polite" class="sr-only"></div>

            <div class="lightbox-gallery">
                <ul id="lightbox-image-list" class="lightbox-ul">
                </ul>
            </div>
            <button class="lightbox-nav-btn lightbox-prev" aria-label="Previous image">‹</button>
            <button class="lightbox-nav-btn lightbox-next" aria-label="Next image">›</button>
        </div>
    </div>
</main>

<?php get_footer(); ?>