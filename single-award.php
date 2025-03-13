<?php
/**
 * Template Name: Award
 * Template Post Type: post
 */
get_header();
?>

<?php
$post_id = get_the_ID();
$post_content = apply_filters('the_content', $post->post_content);

// Determine the post language based on categories
$categories = get_the_category($post_id);
$post_language = 'en'; // Default to English

foreach ($categories as $category) {
    if ($category->slug === 'award-hi') {
        $post_language = 'hi'; // Hindi
        break;
    } elseif ($category->slug === 'award-en') {
        $post_language = 'en'; // English
        break;
    }
}
?>

<div data-scroll-container>
<div style="margin: 15rem auto; max-width: 1250px; padding: 0 20px; box-sizing: border-box; display: flex; flex-wrap: wrap;">
<div>      
            <?php
            if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
            }
            ?>
        </div> 
<h1 class="faculty-title">
        <?php echo get_the_title($post_id); ?>
    </h1>

<section id="skip-to-content" class="sub-intro">
 
<div class="sub-intro-images">
          <div>
          <img src="<?php echo get_field('film_still');?>" style="width: 100%; height: auto; max-height: 500px; object-fit: contain; border-radius: 8px; margin-bottom: 2rem;" alt="<?php echo get_field('film_still_alt_text');?>" />
          </div>
          </div>
          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo __('Synopsis', 'srft-theme');?></div>
          
           <div class="sub-intro-text-description">
           <?php echo get_field('film_synposis');?>
          </div>
          </div>
</section>

    <div style="flex: 0 0 100%; max-width: 100%; margin-top: 2rem;">

    <div style="max-width: 100%; background-color: rgb(243, 243, 243); padding: 16px 24px; font-size: 16px; font-weight: 400; line-height: 28px; box-sizing: border-box;">
    <?php
    // Get all ACF fields for the current post
    $fields = get_fields();

    if ($fields) {
        echo '<ul style="list-style-type:none;">';

        // Set up Hindi translations for specific labels
        $translations = [
            'Film Name' => 'फिल्म का नाम',
            'Film Duration' => 'फिल्म की अवधि',
            'Film Language' => 'फिल्म की भाषा',
            'Film Director' => 'फिल्म निर्देशक',
            'Batch' => 'बैच',
            'Course' => 'कोर्स',
            'Award Received' => 'प्राप्त पुरस्कार',
            'Film Format' => 'फिल्म प्रारूप',
            'Film Production Year' => 'फिल्म उत्पादन वर्ष',
            'Production credits' => 'प्रोडक्शन क्रेडिट्स',
        ];

        foreach ($fields as $key => $value) {
            // Get the field object to access the label
            $field = get_field_object($key);

            // Exclude fields by label name (case-insensitive) and apply translation if needed
            if (!in_array($field['label'], ['Video',  'Film Synposis', 'Film Still', 'Film Still ALt Text'])) {
                // Translate the label if the post is in Hindi and the label is in the translation list
                $label = ($post_language === 'hi' && isset($translations[$field['label']])) ? $translations[$field['label']] : $field['label'];

                echo '<li><strong>' . esc_html($label) . ':</strong> ' . $value . '</li>';
            }
        }

        echo '</ul>';
    } else {
        echo '<p>No custom fields found for this post.</p>';
    }
    ?>

    </div>

    <!-- <?php
    $video_url = get_field('video');

    if ($video_url) {
        echo '<iframe src="' . esc_url($video_url) . '" title="' . esc_attr(get_the_title($post_id)) . '" width="100%" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>';
    } else {
        echo '<p>No video URL found.</p>';
    }
    ?> -->

    </div>

</div>

<?php get_footer(); ?>
