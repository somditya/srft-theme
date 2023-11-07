<?php
/*
Template Name: Convocation
*/
get_header();

// Get the current post ID and category slug
$post_id = get_the_ID();
$catslug = get_the_category($post_id);

// Get the post content and the current language
$page_content = apply_filters('the_content', $post->post_content);
$current_language = get_locale();

if ($current_language === 'en_US') {
  $catslug = 'convocation-en'; 
} else {
  $catslug = 'convocation-hi';
}

// Initialize variables to store the latest post title and content
$latest_post_title = '';
$latest_post_content = '';

// Query the latest convocation post
$latest_convocation_post = new WP_Query(array(
  'category_name' => $catslug, // Replace with your custom category name
  'posts_per_page' => 1,
  'orderby' => 'date',
  'order' => 'DESC',
));

if ($latest_convocation_post->have_posts()) :
  while ($latest_convocation_post->have_posts()) : $latest_convocation_post->the_post();
    $latest_post_id = get_the_ID(); // Get the ID of the latest post
    $latest_post_thumbnail_url = esc_url(get_the_post_thumbnail_url($latest_post_id, 'large')); // Get the thumbnail URL of the latest post

    // Store the title and content in variables
    $latest_post_title = get_the_title();
    $latest_post_content = get_the_content();
?>
    <main>
      <section class="cine-header" style="background-image: url('<?php echo $latest_post_thumbnail_url; ?>');">
        <div class="page-banner">
          <div class="page-banner-title"><?php echo __('Convocation', 'srft-theme'); ?></div>
        </div>
      </section>

      <section class="cine-detail">
        <div class="leftnav">
          <div class="widget" style="line-height: 1.5;">
            <h3><?php echo __('Previous Convocations', 'srft-theme'); ?></h3>
            <ul style="list-style-type: none;">
              <?php
              // Query the previous 4 convocation posts and exclude the latest post
              $previous_convocations = new WP_Query(array(
                'category_name' => $catslug, // Replace with your custom category name
                'posts_per_page' => 4, // Number of previous convocations to display
                'post__not_in' => array($latest_post_id), // Exclude the latest post
              ));

              if ($previous_convocations->have_posts()) :
                while ($previous_convocations->have_posts()) : $previous_convocations->the_post();
              ?>
                  <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
              <?php
                endwhile;
                wp_reset_postdata();
              else :
                echo 'No previous convocation posts found.';
              endif;
              ?>
            </ul>
          </div>
        </div>

        <div class="main-content">
        <div><?php if(function_exists('bcn_display'))
{
bcn_display();
}?></div>
          <section class="page-title">
            <div>
              <p class="page-header-text"><?php echo $latest_post_title; // Display the title of the latest convocation post ?></p>
            </div>
          </section>

          <section style="margin-bottom: 4rem;">
            <div>
              <?php echo $latest_post_content; // Display the content of the latest convocation post ?>
            </div>
          </section>
        </div>
      </section>
    </main>
<?php
  endwhile;
  wp_reset_postdata();
else :
  echo 'No convocation posts found.';
endif;

get_footer();
?>
