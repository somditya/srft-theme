<?php
/**
 * /*
 * Template Name: Vacancy
 * Template Post Type: post
 * 
 */
get_header();
$current_language = pll_current_language(); 
?>

<?php

$post_id = get_the_ID();
$bg_image_url = isset($_GET['bg_image']) ? $_GET['bg_image'] : '';
//$post_content = apply_filters('the_content', $post->post_content);

// You can now echo or manipulate $post_content as needed.
?>

<section class="cine-header" style="background-image: url('<?php echo esc_url($bg_image_url); ?>');">
    <div class="page-banner">
        <div class="page-banner-title" style="margin-top: 10px;"><?php echo __('Tender', 'srft-theme'); ?></div>
    </div>
</section>
<section style="margin: 10rem; padding: 0 1.25rem; display: block;">
    <article style="display: grid; grid-gap: 1.875rem;
    grid-template-columns: 1fr 16.7% 26.67% 16.7% 1fr 1fr; border: 1px solid #000;">
        <div role="article" style="text-align: center;
    padding-top: 1.25rem; grid-column: 2/5;">
            <a href="#" alt="vacancy" class="c-headline__topic t-heading--topic">
              <label><?php if ($current_language === 'hi') {
    // Display Hindi label text here
    echo __('Vacancy', 'srfti');
} else {
    // Display English label text here
    echo __('Vacancy', 'srfti');
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
<p style="margin: 1rem 0 0; font-family: GthD; font-weight: 600;">
    <time>Application publish Date: <?php
echo get_field('Vacancy-Publish-Date'); 
?></time></p>
</div> 
<div style="grid-column: 1/2;">
    <div>
    <?php echo __('Vacancy ID:', 'srft-theme' ); ?>
    
</div>
</div>
<div style="grid-column: 2/3; ">
    <div>
    <?php echo __('Advertisement::', 'srft-theme' ); ?>
</div>
</div>

<div style="grid-column: 3/4;"  >
    
    <div> <?php echo __('Recruitment title:', 'srft-theme' ); ?> </div>
</div>

<div style="grid-column: 4/5; ">
    <div>
    <?php echo __('Last Date of  Application:', 'srft-theme' ); ?> 
</div>
</div>

<div style="grid-column: 5/6; ">
    <div>
     <?php echo __('Corrigendum:', 'srft-theme' ); ?> 
</div>
</div>
<div style="grid-column: 6/7; ">
    <div>
    <?php echo __('Apply Online:', 'srft-theme' ); ?> 
</div>
</div>
<div style="grid-column: 1/2;">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'Vacancy-ID', true); ?>
</div>
</div>
<div style="grid-column: 2/3; ">
    <div>
    <a href="<?php echo esc_url(get_field('Vacancy-Doc')); ?>">Download</a>
</div>
</div>
<div style="grid-column: 3/4;  
    
    line-height: 28px; text-align: left;">

<?php echo get_post_meta(get_the_ID(), 'Vacancy-Description', true); ?>

</div>

<div style="grid-column: 4/5; ">
    <div>
    <?php echo get_field('Vacancy-LastDate'); ?>
</div>
</div>

<div style="grid-column: 5/6; ">
    <div>
    <?php
$pdf_url = get_post_meta(get_the_ID(), 'Vacancy-Corriengendum', true);

if (!empty($pdf_url)) {
    echo '<a href="' . esc_url($pdf_url) . '" download>Download</a>';
}
?>
</div>
</div>
<div style="grid-column: 6/7; ">
    <div>
    <?php
$online_url = get_post_meta(get_the_ID(), 'Apply-Online-URL', true);

if (!empty($online_url)) {
    echo '<a href="' . esc_url($online_url) . '" download>Click to Apply</a>';
}
else 

echo "Not Applicable for this recruitment"; 

?>

</div>
</div>

<div style="grid-column: 3/4;  line-height: 28px; text-align: left;">
<div> <?php echo __('Satyajit Ray Film & Televsion Institute', 'srft-theme' ); ?> </div>
<div><?php echo __('Kolkata -700094 ', 'srft-theme' ); ?></div>
<div><?php echo __('email: po@srfti.ac.in', 'srft-theme' ); ?></div>
<div><?php echo __('Telephone:+91 3324321040 ', 'srft-theme' ); ?></div>

</div>

</article>    
<div style="padding: 1rem; text-align: center;">
    <?php echo do_shortcode('[addtoany buttons]'); ?>
</div>
</section> 
  
<?php get_footer(); ?>
