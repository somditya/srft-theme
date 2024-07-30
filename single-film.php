<?php
/**
 * Template Name: Students-film
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
    font-family: GthD;
    font-family: 'Noto Sans', sans-serif;
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
<section class="sub-intro">
          <div class="sub-intro-images">
          <div>
          <img src="<?php the_post_thumbnail_url('large'); ?>" style="width: 100%; height: auto; max-height: 500px; object-fit: contain; border-radius: 8px; margin-bottom: 2rem;" alt="" />
          </div>
          </div>
          <div class="sub-intro-text">
           <div class="sub-intro-text-head"><?php echo get_post_meta(get_the_ID(), 'SubIntro', true); ?></div>
          
           <div class="sub-intro-text-description">
           <?php echo $post_content; ?>
          </div>
          </div>
</section>

       

    <div style="flex: 0 0 100%; max-width: 100%; margin-top: 2rem;">

    <div style="max-width: 100%; background-color: rgb(243, 243, 243); padding: 16px 24px; font-size: 16px; font-weight: 400; line-height: 28px; box-sizing: border-box;">
    <?php
        // Get all custom fields for the current post
        $custom_fields = get_post_custom();

        // Check if there are custom fields
        if ($custom_fields) {
            echo '<ul style="list-style-type:none;">';

            foreach ($custom_fields as $key => $values) {
                // Skip WordPress internal fields, which start with an underscore
                if (strpos($key, '_') !== 0) {
                    // Exclude the "video" custom field by name (case-insensitive)
                    if (strcasecmp(trim($key), 'video') !== 0) {
                        echo '<li><strong>' . esc_html($key) . ':</strong>';
                        foreach ($values as $value) {
                            echo ' ' . esc_html($value);
                        }
                        echo '</li>';
                    }
                }
            }

            echo '</ul>';
        } else {
            echo '<p>No custom fields found for this post.</p>';
        }
        ?>
        </div>

        <iframe src="<?php echo get_post_meta(get_the_ID(), 'Video', true); ?>" title="<?php echo get_the_title($post_id); ?>" width="100%" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>

    </div>

</div>

<?php get_footer(); ?>
