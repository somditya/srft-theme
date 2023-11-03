<?php
/**
 * /*
 * Template Name: Convocation
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
