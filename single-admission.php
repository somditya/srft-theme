<?php
/**
 * /*
 * Template Name: Admission
 * Template Post Type: post
 * 
 */
get_header();
$current_language = pll_current_language(); 
$post_id = get_the_ID();
//$post_content = apply_filters('the_content', $post->post_content);
?>

<div style="margin: 15rem;  max-width: 1250px;">
<div style="display: flex;">
<div style="flex: 30% 1; max-width: 30%; padding-right: 10px;">


<img src="<?php the_post_thumbnail_url('thumbnail'); ?>" max-width="100%" height="220" alt="" />

<div style="margin-top: 4rem;">
<?php
// Get all custom fields for the current post
echo "hi";
?>

</div>

</div> 

<div style="padding: 0 1.25rem;   flex: 1 1 70%;
    max-width: 70%;">
    <article style="display: grid; grid-gap: 1.875rem;
    grid-template-columns: 1fr 6.7% 56.67% 6.7% 1fr;">
        <div role="article" style="text-align: center;
    padding-top: 1.25rem; grid-column: 3;">
            <a href="#" alt="News" class="c-headline__topic t-heading--topic"><label><?php echo __('Admission', 'srft-theme' ); ?>
</label>
  </a> 
  <h1 style="
    font-family: GthD;
    font-family: 'Noto Sans', sans-serif;
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
    <img src="<?php the_post_thumbnail_url('thumbnail'); ?>"  class="img-responsive"/>
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
    <div style="padding: 1rem; text-align: center;">
    <?php echo do_shortcode('[addtoany buttons]'); ?>
</div>
<?php echo $post_content; ?>
</div>
</div>

</div>

</article>       
</div> 
</div>
<?php get_footer(); ?>