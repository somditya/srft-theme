<?php
/*
Template Name: Media
*/
get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();
?>

<main>
    <!-- Add an image section with the featured image -->
    <section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
        <div class="page-banner">
            <h2 class="page-banner-title"><?php echo __('Media Gallery', 'srft-theme'); ?></h2>
        </div>  
    </section>
<section class="cine-detail">
    <div class="main-content" style="width: 100%;">
    <!-- Content area -->
        <div>      
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
        </div>
        <div class="page-title">
            <div>
                <h2 class="page-header-text"><?php echo esc_html($post->post_title); ?></h2>
            </div>
        </div>

        <section class="section-home">
           <!-- Tab Navigation -->
  <div class="phototabs">
    <div class="phototab">
                    <label for="tab1"><?php echo __('Events & Festivals', 'srft-theme'); ?></label>
                    <input class="tab1" id="tab1" name="tabs" type="radio" checked>
    </div>
                <!-- Tab: Events & Festivals -->
                <div class="phototab">
                    <label for="tab2"><?php echo __('Workshops & Masterclasses', 'srft-theme'); ?></label>
                    <input class="tab2" id="tab2" name="tabs" type="radio" >
               </div>
                <div class="phototab">
                    <label for="tab3"><?php echo __('Still from students film', 'srft-theme'); ?></label>
                    <input class="tab3" id="tab3" name="tabs" type="radio" >
                </div>
            
                <!-- Tab: Events & Festivals -->
                <div class="phototab">
                    <label for="tab4"><?php echo __('Campus Moments', 'srft-theme'); ?></label>
                    <input id="tab4"  name="tabs" type="radio" >
                </div>
                <div class="phototab">
                    <label for="tab5"><?php echo __(' SRFTI in News', 'srft-theme'); ?></label>
                    <input id="tab5" name="tabs" type="radio">
                </div>
             </div>
<div class="tab-content tab-content1">
                    <?php
// Query all workshop albums
$events_albums = new WP_Query([
    'post_type' => 'picture',
    'posts_per_page' => -1,
    'meta_key' => 'Picture_Order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
        [

            'key' => 'Picture_Category', // ACF field name
            'value' => array('Convocation', 'Event', 'Festival'),
            'compare' => 'IN', // Match posts with 'workshop' in Picture_Category
        ],
        [
            'key' => 'Picture_Order',
            'compare' => 'EXISTS'
        ],

    ],
]);

// Group the posts by Album_Name
// Group the posts by Album_Name
$events_grouped = [];
foreach ($events_albums->posts as $album) {
    $album_name = get_post_meta($album->ID, 'Album_Name', true); // Fetch Album_Name
    if (!empty($album_name)) {
        $events_grouped[$album_name][] = $album;
    }
}


// Check if there are any albums to display
if (!empty($events_grouped)) {
    foreach ($events_grouped as $album_name => $images) {
        // Use the first image of the album as the representative image
        $representative_image = $images[0];
        $representative_image_url = get_field('Picture_File', $representative_image->ID); // Assuming picture_file returns the URL

        
        echo "<div class='album-container'>";
        echo "<h3 class='album-title'>" . esc_html($album_name) . "</h3>";
        // Display the representative image
        ?>
        <a href="<?php echo esc_url($representative_image_url); ?>" 
           data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
           data-title="<?php echo esc_attr($representative_image->post_title); ?>">
            <img src="<?php echo esc_url($representative_image_url); ?>" 
                 alt="<?php echo esc_attr($album_name); ?>" 
                class="gallery-image">
        </a>
        <?php

        // Add all images in the album to the Lightbox group (hidden links)
        foreach ($images as $image) {
          if ($image->ID !== $representative_image->ID) {
              // Get the file URL from ACF's 'picture_file' field for each image
              $image_url = get_field('Picture_File', $image->ID);
              // Get the thumbnail URL for other images
              //$image_thumbnail_url = wp_get_attachment_image_url(get_field('picture_file', $image->ID), 'thumbnail');
              ?>
              <a href="<?php echo esc_url($image_url); ?>" 
                 data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
                 data-title="<?php echo esc_attr($image->post_title); ?>" 
                 ></a>
              <?php
          }
      }

        echo "</div>";
    }
} else {
    // If no albums are found
    echo "<p>No albums available for workshops.</p>";
}
?>
                    </div>

<div class="tab-content tab-content2">
                    <?php
// Query all workshop albums
$events_albums = new WP_Query([
    'post_type' => 'picture',
    'posts_per_page' => -1,
    'meta_key' => 'Picture_Order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
        [
            'key' => 'Picture_Category',
            'value' => ['Workshops', 'Masterclass', 'Seminars'],
            'compare' => 'IN',
        ],
        [
            'key' => 'Picture_Order',
            'compare' => 'EXISTS'
        ],
    ],
]);

// Group the posts by Album_Name
// Group the posts by Album_Name
$events_grouped = [];
foreach ($events_albums->posts as $album) {
    $album_name = get_post_meta($album->ID, 'Album_Name', true); // Fetch Album_Name
    if (!empty($album_name)) {
        $events_grouped[$album_name][] = $album;
    }
}
// Check if there are any albums to display
if (!empty($events_grouped)) {
    foreach ($events_grouped as $album_name => $images) {
        // Use the first image of the album as the representative image
        $representative_image = $images[0];
        $representative_image_url = get_field('Picture_File', $representative_image->ID); // Assuming picture_file returns the URL

        
        echo "<div class='album-container'>";
        echo "<h3 class='album-title'>" . esc_html($album_name) . "</h3>";
        // Display the representative image
        ?>
        <a href="<?php echo esc_url($representative_image_url); ?>" 
           data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
           data-title="<?php echo esc_attr($representative_image->post_title); ?>">
            <img src="<?php echo esc_url($representative_image_url); ?>" 
                 alt="<?php echo esc_attr($album_name); ?>" 
                class="gallery-image">
        </a>
        <?php

        // Add all images in the album to the Lightbox group (hidden links)
        foreach ($images as $image) {
          if ($image->ID !== $representative_image->ID) {
              // Get the file URL from ACF's 'picture_file' field for each image
              $image_url = get_field('Picture_File', $image->ID);
              // Get the thumbnail URL for other images
              //$image_thumbnail_url = wp_get_attachment_image_url(get_field('picture_file', $image->ID), 'thumbnail');
              ?>
              <a href="<?php echo esc_url($image_url); ?>" 
                 data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
                 data-title="<?php echo esc_attr($image->post_title); ?>" 
                 ></a>
              <?php
          }
      }

        echo "</div>";
    }
} else {
    // If no albums are found
    echo "<p>No albums available for workshops.</p>";
}
?>
 </div>

<div class="tab-content tab-content3">
                    <?php
// Query all workshop albums
$events_albums = new WP_Query([
    'post_type' => 'picture',
    'posts_per_page' => -1,
    'meta_key' => 'Picture_Order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
        [

            'key' => 'Picture_Category', // ACF field name
            'value'   => 'Student Stills', // Category value to match
            'compare' => 'IN',
        ],
        [
            'key' => 'Picture_Order',
            'compare' => 'EXISTS'
        ],
    ],
]);

// Group the posts by Album_Name
// Group the posts by Album_Name
$events_grouped = [];
foreach ($events_albums->posts as $album) {
    $album_name = get_post_meta($album->ID, 'Album_Name', true); // Fetch Album_Name
    if (!empty($album_name)) {
        $events_grouped[$album_name][] = $album;
    }
}



// Check if there are any albums to display
if (!empty($events_grouped)) {
    foreach ($events_grouped as $album_name => $images) {
        // Use the first image of the album as the representative image
        $representative_image = $images[0];
        $representative_image_url = get_field('Picture_File', $representative_image->ID); // Assuming picture_file returns the URL

        
        echo "<div class='album-container'>";
        echo "<h3 class='album-title'>" . esc_html($album_name) . "</h3>";
        // Display the representative image
        ?>
        <a href="<?php echo esc_url($representative_image_url); ?>" 
           data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
           data-title="<?php echo esc_attr($representative_image->post_title); ?>">
            <img src="<?php echo esc_url($representative_image_url); ?>" 
                 alt="<?php echo esc_attr($album_name); ?>" 
                class="gallery-image">
        </a>
        <?php

        // Add all images in the album to the Lightbox group (hidden links)
        foreach ($images as $image) {
          if ($image->ID !== $representative_image->ID) {
              // Get the file URL from ACF's 'picture_file' field for each image
              $image_url = get_field('Picture_File', $image->ID);
              // Get the thumbnail URL for other images
              //$image_thumbnail_url = wp_get_attachment_image_url(get_field('picture_file', $image->ID), 'thumbnail');
              ?>
              <a href="<?php echo esc_url($image_url); ?>" 
                 data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
                 data-title="<?php echo esc_attr($image->post_title); ?>" 
                 ></a>
              <?php
          }
      }

        echo "</div>";
    }
} else {
    // If no albums are found
    echo "<p>No albums available for workshops.</p>";
}
?>
 </div>

 <div class="tab-content tab-content4">
                    <?php
// Query all workshop albums
$events_albums = new WP_Query([
    'post_type' => 'picture',
    'posts_per_page' => -1,
    'meta_key' => 'Picture_Order',
    'orderby' => 'meta_value_num',
    'order' => 'ASC',
    'meta_query' => [
        [

            'key' => 'Picture_Category', // ACF field name
            'value'   => 'Campus Life', // Category value to match
            'compare' => 'IN',
        ],
        [
            'key' => 'Picture_Order',
            'compare' => 'EXISTS'
        ],
    ],
]);

// Group the posts by Album_Name
// Group the posts by Album_Name
$events_grouped = [];
foreach ($events_albums->posts as $album) {
    $album_name = get_post_meta($album->ID, 'Album_Name', true); // Fetch Album_Name
    if (!empty($album_name)) {
        $events_grouped[$album_name][] = $album;
    }
}

// Check if there are any albums to display
if (!empty($events_grouped)) {
    foreach ($events_grouped as $album_name => $images) {
        // Use the first image of the album as the representative image
        $representative_image = $images[0];
        $representative_image_url = get_field('Picture_File', $representative_image->ID); // Assuming picture_file returns the URL

        
        echo "<div class='album-container'>";
        echo "<h3 class='album-title'>" . esc_html($album_name) . "</h3>";
        // Display the representative image
        ?>
        <a href="<?php echo esc_url($representative_image_url); ?>" 
           data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
           data-title="<?php echo esc_attr($representative_image->post_title); ?>">
            <img src="<?php echo esc_url($representative_image_url); ?>" 
                 alt="<?php echo esc_attr($album_name); ?>" 
                class="gallery-image">
        </a>
        <?php

        // Add all images in the album to the Lightbox group (hidden links)
        foreach ($images as $image) {
          if ($image->ID !== $representative_image->ID) {
              // Get the file URL from ACF's 'picture_file' field for each image
              $image_url = get_field('Picture_File', $image->ID);
              // Get the thumbnail URL for other images
              //$image_thumbnail_url = wp_get_attachment_image_url(get_field('picture_file', $image->ID), 'thumbnail');
              ?>
              <a href="<?php echo esc_url($image_url); ?>" 
                 data-lightbox="<?php echo esc_attr(sanitize_title($album_name)); ?>" 
                 data-title="<?php echo esc_attr($image->post_title); ?>" 
                 ></a>
              <?php
          }
      }

        echo "</div>";
    }
} else {
    // If no albums are found
    echo "<p>No albums available for workshops.</p>";
}
?>
 </div>


        </section>
</div>
</section>

<?php get_footer(); ?>
