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
    <article class="narticle">
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
    font-family: 'Noto Sans', sans-serif;
    font-size: 3.375rem;
    letter-spacing: -.0875rem;line-height: 1.1;
    margin: 0;
    font-weight: 600;">
  <?php echo get_the_title($post_id);?>
</h1> 
<p style="margin: 1rem 0 0; font-family: GthD; font-family: 'Noto Sans', sans-serif; font-weight: 400;">
    <time><?php echo __('Tender Issue Date:', 'srft-theme' ); ?> <?php
$post_date = get_the_date('F j, Y');
echo $post_date;
?></time>
</p>
</div> 


<div style="grid-column: 1/2;">
    <div>
    <?php echo __('Tender ID:', 'srft-theme' ); ?>
</div>
<div>
    <?php echo get_post_meta(get_the_ID(), 'Tender-ID', true); ?>
</div>
</div>
<div style="grid-column: 2/3; ">
    <div>
    <?php echo __('NIT Document:', 'srft-theme' ); ?>
</div>
<div style="grid-column: 2/3; ">
    <div>
    <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'Tender-Doc', true)); ?>">Download</a>
</div>
</div>
</div>

<div style="grid-column: 3/4;"  >
    
    <div><?php echo __('Tender Description:', 'srft-theme' ); ?> </div>
    <div style="grid-column: 3/4;  
    
    line-height: 28px; text-align: left;">
<?php echo $post_content; ?>
</div>
</div>

<div style="grid-column: 4/5; ">
    <div>
    <?php echo __('Submission Date:', 'srft-theme' ); ?>
</div>
<div>
    <?php echo get_post_meta(get_the_ID(), 'Tender-Submission-Date', true); ?>
</div>
</div>

<div style="grid-column: 5/6; ">
<div>
    <?php echo __('Corrigendum:', 'srft-theme' ); ?>
</div>
<div>
    <?php
    if (!empty(get_post_meta(get_the_ID(), 'Tender-Corriengendum', true))) {
        echo '<a href="' . esc_url(get_post_meta(get_the_ID(), 'Tender-Corriengendum', true)) . '">Download</a>';
    }
    ?>
</div>
</div>
<div style="grid-column: 6/7; ">
    <div>
    <?php echo __('Extension:', 'srft-theme' ); ?>
</div>
<div>
    <?php
    if (!empty(get_post_meta(get_the_ID(), 'Tender-Extension', true))) {
        echo '<a href="' . esc_url(get_post_meta(get_the_ID(), 'Tender-Extension', true)) . '">Download</a>';
    }
    ?>
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
