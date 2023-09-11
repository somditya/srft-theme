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
<div style="display: flex;">
<div style="flex: 30% 1; max-width: 30%;">


<img src="<?php the_post_thumbnail_url('thumbnail'); ?>" width="220" height="220" alt="" />

</div>
<div style="background-color: rgb(243, 243, 243);
    flex: 1 1 70%;
    max-width: 70%;
    padding: 16px 24px;
    font-size: 16px;
    font-weight: 400;
    line-height: 28px;">
   <h1 style="
    font-weight: 400;
    margin: 0 0 4rem;
    font-size: 4rem;
    line-height: 5rem;
    color: #8b5b2b;
    text-transform: uppercase;
    margin-bottom: 2.5rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #d6d6ce;">Samiran Datta</h1>   
<?php echo $post_content; ?>
</div>
</div>
</div>
  
<?php get_footer(); ?>
