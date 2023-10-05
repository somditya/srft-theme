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
$post_content = apply_filters('the_content', $post->post_content);

// You can now echo or manipulate $post_content as needed.

?>

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
    font-size: 3.375rem;
    letter-spacing: -.0875rem;line-height: 1.1;
    margin: 0;
    font-weight: 600;">
  <?php echo get_the_title($post_id);?>
</h1> 
<p style="margin: 1rem 0 0; font-family: GthD; font-weight: 600;">
    <time>Application publish Date: <?php
$post_date = get_the_date('F j, Y');
echo $post_date;
?></time></p>
</div> 
<div style="grid-column: 1/2;">
    <div>
    Vacancy ID:
</div>
</div>
<div style="grid-column: 2/3; ">
    <div>
    Advertisement:
</div>
</div>

<div style="grid-column: 3/4;"  >
    
    <div>Recruitment title: </div>
</div>

<div style="grid-column: 4/5; ">
    <div>
    Last Date of  Application:
</div>
</div>

<div style="grid-column: 5/6; ">
    <div>
    Corrigendum:
</div>
</div>
<div style="grid-column: 6/7; ">
    <div>
   Apply Online:
</div>
</div>
<div style="grid-column: 1/2;">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'Vacancy-ID', true); ?>
</div>
</div>
<div style="grid-column: 2/3; ">
    <div>
    <a href="<?php echo esc_url(get_post_meta(get_the_ID(), 'Vacancy-Doc', true)); ?>">Download</a>
</div>
</div>
<div style="grid-column: 3/4;  
    
    line-height: 28px; text-align: left;">
<?php echo $post_content; ?>
</div>

<div style="grid-column: 4/5; ">
    <div>
    <?php echo get_post_meta(get_the_ID(), 'Vacancy-Submission-Date', true); ?>
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
<div>Satyajit Ray Film & Televsion Institute</div>
<div>Kolkata -700094 </div>
<div>email: po@srfti.ac.in</div>
<div>Telephone:+91 3324321040 </div>

</div>

</article>    
<div style="padding: 1rem; text-align: center;">
    <?php echo do_shortcode('[addtoany buttons]'); ?>
</div>
</section> 
  
<?php get_footer(); ?>
