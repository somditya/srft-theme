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
?>

<div data-scroll-container>
<div style="margin: 15rem auto; max-width: 1250px; padding: 0 20px; box-sizing: border-box; display: flex; flex-wrap: wrap;">

<h1 style="
    font-size: 5.375rem;
    font-weight: 600;
    margin: 0 0 2rem;
    letter-spacing: -.0875rem;
    line-height: 1.1rem;
    color: #8b5b2b;
    margin-bottom: 1.25rem; /* Adjusted margin-bottom */
    padding-bottom: 2.75rem; /* Adjusted padding-bottom */
    border-bottom: 2px solid #d6d6ce;
    width: 100%;
">
        <?php echo get_the_title($post_id); ?>
    </h1>

<section id="skip-to-content" class="sub-intro">
          <div class="sub-intro-images">
          <div>
          <img src="<?php echo get_field('film_still');?>" style="width: 100%; height: auto; max-height: 500px; object-fit: contain; border-radius: 8px; margin-bottom: 2rem;" alt="<?php echo get_field('film_still_alt_text');?>" />
          </div>
          </div>
          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_field('Film-Name');?></div>
          
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

    foreach ($fields as $key => $value) {
        // Get the field object to access the label
        $field = get_field_object($key);

        // Exclude the "video", "synopsis", and "alt text" fields by label name (case-insensitive)
        if (!in_array($field['label'], ['Video', 'Film Synposis', 'Film Still', 'Film Still ALt Text'])) {
            echo '<li><strong>' . esc_html($field['label']) . ':</strong> ' . esc_html($value) . '</li>';
        }
    }

    echo '</ul>';
} else {
    echo '<p>No custom fields found for this post.</p>';
}
?>

        </div>

        <?php
$video_url = get_field('video');

if ($video_url) {
    echo '<iframe src="' . esc_url($video_url) . '" title="' . esc_attr(get_the_title($post_id)) . '" width="100%" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>';
} else {
    echo '<p>No video URL found.</p>';
}
?>

    </div>

</div>

<?php get_footer(); ?>