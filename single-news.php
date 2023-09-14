<?php
/**
 * /*
 * Template Name: News
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

<section style="padding: 0 1.25rem;">
    <article style="display: grid; grid-gap: 1.875rem;
    grid-template-columns: 1fr 6.7% 56.67% 6.7% 1fr;">
        <header role="article" style="text-align: center;max-width: 56.25rem;
    padding-top: 1.25rem; grid-column: 3;">
            <a href="#" alt="News" class="c-headline__topic t-heading--topic">
  News</a> 
  <h1 style="font-size: 4.375rem;
    letter-spacing: -.0875rem;line-height: 1.1;
    margin: 0;
    font-style: normal;
    font-weight: 500;">
  <?php echo get_the_title($post_id);?>
</h1> 
<p class="c-headline__date">
    <time datetime="2023-08-08T12:00:00Z"><?php ?></time></p>
</header> 
<div stle="grid-column: 2/5;">
    <div class="c-photo">
    <img src="<?php the_post_thumbnail_url('thumbnail'); ?>" width="220" height="220" alt="" />
</div>
</div>
<div style="">
</div>
<div style="">
</div>
</article>       
</section> 
  
<?php get_footer(); ?>
