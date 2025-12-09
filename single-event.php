<?php
/**
 * Template Name: Event
 * Template Post Type: post
 */
get_header();
?>

<?php
$post_id = get_the_ID();
$post_content = apply_filters('the_content', get_the_content());
?>

<section id="skip-to-content" class="article-container">
    <article class="narticle" role="main">
        <div role="article" style="grid-column: 3; margin:0">
            <span class="c-headline__topic t-heading--topic">
                <label><?php echo __('Event', 'srft-theme'); ?></label>
            </span>
            <h1 class="nheadline">
                <?php echo get_the_title($post_id); ?>
            </h1>
            <p style="margin: 1rem 0 0; font-weight: 600;">
                <time><?php echo get_the_date('F j, Y'); ?></time>
            </p>
        </div> 
        <div style="grid-column: 2/5;">
            <div style="text-align: center;">
                <img src="<?php echo get_field('event_poster'); ?>" class="img-responsive"  alt="<?php echo esc_attr(get_field('event_poster_alt_text')); ?>" />
                         
            </div>
        </div>
        <div style="border-top: 3px solid #000; grid-column: 3/4; margin: 0; padding: 0; text-align: center;">
            <div style="display: flex; align-items: flex-end; justify-content: center; line-height: 32px;">
                <!-- Add any additional content here if needed -->
            </div>
            <div style="grid-column: 3/4; line-height: 28px; text-align: left;">
                <div style="padding: 1rem; text-align: center;">
                    <?php echo get_field('event_detail'); ?>
                </div>
            </div>
        </div>
    </article>       
</section>

<?php get_footer(); ?>
