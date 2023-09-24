<?php
/**
 * /*
 * Template Name: Tender
 * Template Post Type: post
 * 
 */
get_header();
$current_language = pll_current_language(); 
?>

<?php

$post_id = get_the_ID();
$post_content = apply_filters('the_content', $post->post_content);

// You can now echo or manipulate $post_content as needed.

?>

<section style="margin: 15rem; padding: 0 1.25rem; display: block;">
    <article style="display: grid; grid-gap: 1.875rem;
    grid-template-columns: 1fr 16.7% 26.67% 16.7% 1fr 1fr; border: 1px solid #000;">
        <div role="article" style="text-align: center;
    padding-top: 1.25rem; grid-column: 2/5;">
            <a href="#" alt="Tender" class="c-headline__topic t-heading--topic">
              <label><?php if ($current_language === 'hi') {
    // Display Hindi label text here
    echo __('Tender', 'srfti');
} else {
    // Display English label text here
    echo __('Tender', 'srfti');
}
?>
</label>
  </a> 
  <h1 style="
    font-family: GthD;
    font-size: 3.375rem;
    letter-spacing: -.0875rem;line-height: 1.1;
    margin: 0;
    font-weight: 600;">
  <?php echo get_the_title($post_id);?>
</h1> 
<p style="margin: 1rem 0 0; font-family: GthD; font-weight: 600;">
    <time>Tender Issue Date: <?php
$post_date = get_the_date('F j, Y');
echo $post_date;
?></time></p>
</div> 
<div style="grid-column: 1/2;">
    <div>
    Tender ID:
</div>
</div>
<div style="grid-column: 2/3; ">
    <div>
    NIT Document:
</div>
</div>

<div style="grid-column: 3/4;"  >
    
    <div>Tender Description: </div>
</div>

<div style="grid-column: 4/5; ">
    <div>
    Submission Date:
</div>
</div>

<div style="grid-column: 5/6; ">
    <div>
    Corrigendum:
</div>
</div>
<div style="grid-column: 6/7; ">
    <div>
    Extension:
</div>
</div>
<div style="grid-column: 1/2;">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'Tender-ID', true); ?>
</div>
</div>
<div style="grid-column: 2/3; ">
    <div>
    <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'Tender-Doc', true)); ?>">Download</a>
</div>
</div>
<div style="grid-column: 3/4;  
    
    line-height: 28px; text-align: left;">
<?php echo $post_content; ?>
</div>

<div style="grid-column: 4/5; ">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'Tender-Submission-Date', true); ?>
</div>
</div>

<div style="grid-column: 5/6; ">
    <div>
    <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'Tender-Corriengendum', true)); ?>">Download</a>
</div>
</div>
<div style="grid-column: 6/7; ">
    <div>
    <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'Tender-Extension', true)); ?>">Download</a>
</div>
</div>

<div style="grid-column: 3/4;  line-height: 28px; text-align: left;">
<div>Satyajit Ray Film & Televsion Institute</div>
<div>Kolkata -700094 </div>
<div>email: po@srfti.ac.in</div>
<div>Telephone:+91 3324321040 </div>

</div>

</article>    
<?php echo do_shortcode('[addtoany buttons]'); ?>   
</section> 
  
<?php get_footer(); ?>
