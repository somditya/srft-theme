<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>

<h2>Tell us, what's on your mind? Questions, comments, hellos- share them below.</h2>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?> 


<?php get_footer(); ?>