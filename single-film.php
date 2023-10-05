<?php
/**
 * /*
 * Template Name: Students-film
 * Template Post Type: post
 * 
 */
get_header();

?>

<?php
$post_id = get_the_ID();
$post_content = apply_filters('the_content', $post->post_content);

// You can now echo or manipulate $post_content as needed.

?>

<div style="margin: 15rem;  max-width: 1250px;">
<div style="display: flex;">
<div style="flex: 30% 1; max-width: 30%;">


<img src="<?php the_post_thumbnail_url('thumbnail'); ?>" width="220" height="220" alt="" />

<div style="margin-top: 4rem;">
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

</div>
<div style="background-color: rgb(243, 243, 243);
    flex: 1 1 70%;
    max-width: 70%;
    padding: 16px 24px;
    font-size: 16px;
    font-weight: 400;
    line-height: 28px; flex-direction: column;">
   <h1 style="
    font-weight: 400;
    margin: 0 0 4rem;
    font-size: 4rem;
    line-height: 5rem;
    color: #8b5b2b;
    text-transform: uppercase;
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #d6d6ce;
    ">
<?php echo get_the_title($post_id);?></h1>   
<?php echo $post_content; ?>

<!--<div style="margin-top: 4rem;">


</div>-->
<div style="margin-top: 4rem;">
    <iframe src="<?php echo get_post_meta(get_the_ID(), 'Video', true); ?>" title=<?php echo get_the_title($post_id);?>" width="560" height="315" frameborder="0" scrolling="no" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>
</div> 
</div>
   
</div>
</div>
  
<?php get_footer(); ?>
