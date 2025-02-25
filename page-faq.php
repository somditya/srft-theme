<?php
/*
Template Name: FAQ
*/
?>

<?php get_header(); 
$post_id = get_the_ID();
 ?>

<main>
<div class="static-container">
<div>      
        <?php
            if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
        ?>
</div>
  <section class="page-title">
    <div>
      <h2 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h2>
    </div>
  </section>


  <section class="one-flex" style="margin-top: 5rem; margin-bottom: 10rem;">
    <div class="accordian">
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What programs and courses does SRFTI offer?', 'srft-theme'); ?></h2>
          <p><?php echo get_post_meta($post_id, 'Sections', true); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What are the admission requirements?', 'srft-theme'); ?></h2>
          <p><?php echo get_post_meta($post_id, 'Admission Eligibility', true); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What is the duration of the course?', 'srft-theme'); ?></h2>
          <p><?php echo get_post_meta($post_id, 'Duration', true); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What are the tuition fees and other costs associated?', 'srft-theme'); ?></h2>
          <p><?php echo get_post_meta($post_id, 'Tution Fee', true); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('Are there any scholarships or financial aid options available?', 'srft-theme'); ?></h2>
          <p><?php echo get_post_meta($post_id, 'Scholarship', true); ?></p>
        </li>
      </ul>
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('Does the school provide access to film festivals or competitions?', 'srft-theme'); ?></h2>
          <p><?php echo get_post_meta($post_id, 'Competitions', true); ?></p>
        </li>
      </ul>
    </div>
  </section>
</div>

<?php get_footer(); ?>


