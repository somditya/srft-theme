<?php
/**
 * /*
 * Template Name: Announement
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

<section style="margin: 15rem; padding: 0 1.25rem; display: block;">
    <article style="display: grid; grid-gap: 1.875rem;
    grid-template-columns: 1fr 6.7% 56.67% 6.7% 1fr;">
        <div role="article" style="text-align: center;
    padding-top: 1.25rem; grid-column: 3;">
            <a href="#" alt="News" class="c-headline__topic t-heading--topic">
  </a> 
  <h1 style="
    font-family: GthD;
    font-size: 5.375rem;
    letter-spacing: -.0875rem;line-height: 1.1;
    margin: 0;
    font-weight: 600;">
  <?php echo get_the_title($post_id);?>
</h1> 
<p style="margin: 1rem 0 0; font-family: GthD; font-weight: 600;">
    <time><?php
$post_date = get_the_date('F j, Y');
echo $post_date;
?></time></p>
</div> 
<div style="grid-column: 2/5; ">
    <div class="c-photo">
    <img src="<?php echo get_post_meta(get_the_ID(), 'Post-Image1', true); ?>"  alt="" class="img-responsive"/>
</div>
</div>
<div style="border-top: 3px solid #000; grid-column: 3/4;
    margin: 0;
    padding: 0;
    text-align: center;">
    <div style="display: flex;
    align-items: flex-end;
    justify-content: center; line-height: 32px;">
</div>
<div style="grid-column: 3/4;  
    
    line-height: 28px; text-align: left;">
<?php echo $post_content; ?>
</div>
</div>

</div>

</article>       
</section> 
  
<?php get_footer(); ?>
