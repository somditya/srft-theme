<?php
/*
Template Name: FAQ
*/
?>

<?php get_header(); 
$post_id = get_the_ID();
$page_content = apply_filters('the_content', get_post_field('post_content', $post_id));
?>

<div class="static-container">
  <section class="page-title">
    <div>
      <p class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></p>
    </div>
  </section>

  <section style="margin-bottom: 2rem;">
    <div><?php echo wp_kses_post($page_content); ?></div>
  </section>

  <section class="one-flex" style="margin-top: 5rem; margin-bottom: 10rem;">
    <div class="accordian">
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What programs and courses does SRFTI offer?', 'srft-theme'); ?></h2>
          <p><?php echo esc_html(get_post_meta($post_id, 'Sections', true)); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What are the admission requirements?', 'srft-theme'); ?></h2>
          <p><?php echo esc_html(get_post_meta($post_id, 'Eligibilty', true)); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What is the duration of the course?', 'srft-theme'); ?></h2>
          <p><?php echo esc_html(get_post_meta($post_id, 'Duration', true)); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What are the tuition fees and other costs associated?', 'srft-theme'); ?></h2>
          <p><?php echo esc_html(get_post_meta($post_id, 'Tution Fee', true)); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('Are there any scholarships or financial aid options available?', 'srft-theme'); ?></h2>
          <p><?php echo esc_html(get_post_meta($post_id, 'Scholarship', true)); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('Does the school provide access to film festivals or competitions?', 'srft-theme'); ?></h2>
          <p><?php echo esc_html(get_post_meta($post_id, 'Competitions', true)); ?></p>
        </li>
      </ul>
    </div>
  </section>
</div>

<?php get_footer(); ?>

