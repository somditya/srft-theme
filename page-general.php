<?php
/*
Template Name: General
*/
get_header(); 

$post_id = get_the_ID();
$page_content = apply_filters('the_content', get_post_field('post_content', $post_id));

// Retrieve the featured image URL
//$featured_image_url = get_the_post_thumbnail_url($post_id, 'large');
?>
    <main>
        <!-- Add an image section with the featured image -->
       

        <!-- Content area -->
        <div class="static-container">
        <section class="page-title">
                <div>
                    <p class="page-header-text"><?php echo esc_html($post->post_title); ?></p>
                </div>
            </section>
        </section>

        <section>
         <?php echo $page_content; ?> 
        </section>
        </div>
    </main>
</div>

<?php get_footer();  ?>