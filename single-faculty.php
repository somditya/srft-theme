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

<div style="margin: 15rem;  max-width: 1250px;">
<div class="faculty-bio" style="display: flex;">
<div class="faculty-bio-left">


<img src="<?php the_post_thumbnail_url('thumbnail'); ?>" width="220" height="100%" alt="" />

</div>
<div class="faculty-bio-right">
  <h1><?php echo get_the_title($post_id);?></h1>   
<?php echo $post_content; ?>
</div>

</div>
</div>
  
<?php get_footer(); ?>
