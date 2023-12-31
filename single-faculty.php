<?php
/**
 * /*
 * Template Name: Faculty
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

<div style="margin: 15rem;  max-width: 1250px; align: center;">
<div class="faculty-bio" style="display: flex;">
<div class="faculty-bio-left">
<img src="<?php the_post_thumbnail_url('thumbnail'); ?>" style="width: 300px; height: auto; max-height: 500px; object-fit: contain; border-radius: 8px; margin-bottom: 2rem;" alt="" />

</div>
<div class="faculty-bio-right">
  <h1><?php echo get_the_title($post_id);?></h1>   
<?php echo $post_content; ?>
</div>

</div>
</div>
  
<?php get_footer(); ?>
