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
  <div class="breadcrumbs-wrapper">
    <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
            }
    ?>
   </div>
  <section class="page-title">
    <div>
      <h1 class="page-header-text"><?php echo esc_html(get_the_title($post_id)); ?></h1>
    </div>
  </section>

  <section class="one-flex" style="margin-top: 5rem; margin-bottom: 10rem;">
    <div id="accordionGroup" class="accordion">
      <!--<ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What programs and courses does SRFTI offer?', 'srft-theme'); ?></h2>
          <?php echo get_post_meta($post_id, 'Sections', true); ?>
        </li>
      </ul>-->
      
      <h3>
         <button type="button" aria-expanded="true" class="accordion-trigger" aria-controls="sect1" id="accordion1id">
           <span class="accordion-title">
           <?php echo __('What programs and courses does SRFTI offer?', 'srft-theme'); ?>
          <span class="accordion-icon"></span>
          </span>
         </button>
      </h3>
        
      <div id="sect1" role="region" aria-labelledby="accordion1id" class="accordion-panel" >
        <div>
         <?php echo get_post_meta($post_id, 'Sections', true); ?>  
        </div>
      </div>
     <!--
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What are the admission requirements?', 'srft-theme'); ?></h2>
          <?php echo get_post_meta($post_id, 'Admission Eligibility', true); ?>
        </li>
      </ul> -->
    <h3>
         <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect2" id="accordion2id">
           <span class="accordion-title">
           <?php echo __('What are the admission requirements?', 'srft-theme'); ?>
          <span class="accordion-icon"></span>
          </span>
         </button>
    </h3>
        
      <div id="sect2" role="region" aria-labelledby="accordion2id" class="accordion-panel" hidden="">
        <div>
        <?php echo get_post_meta($post_id, 'Admission Eligibility', true); ?>
        </div>
      </div>

      <!--<ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What is the duration of the course?', 'srft-theme'); ?></h2>
          <?php echo get_post_meta($post_id, 'Duration', true); ?>
        </li>
      </ul>-->

    <h3>
         <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect3" id="accordion3id">
           <span class="accordion-title">
           <?php echo __('What is the duration of the course?', 'srft-theme'); ?>
          <span class="accordion-icon"></span>
          </span>
         </button>
    </h3>
        
      <div id="sect3" role="region" aria-labelledby="accordion3id" class="accordion-panel" hidden="">
        <div>
        <?php echo get_post_meta($post_id, 'Duration', true); ?> 
        </div>
      </div>

      <!--<ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('What are the tuition fees and other costs associated?', 'srft-theme'); ?></h2>
          <?php echo get_post_meta($post_id, 'Tution Fee', true); ?>
        </li>
      </ul>-->
      
     <h3>
         <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect4" id="accordion4id">
           <span class="accordion-title">
           <?php echo __('What are the tuition fees and other costs associated?', 'srft-theme'); ?>
          <span class="accordion-icon"></span>
          </span>
         </button>
    </h3>
        
      <div id="sect4" role="region" aria-labelledby="accordion4id" class="accordion-panel" hidden="">
        <div>
       <?php echo get_post_meta($post_id, 'Tution Fee', true); ?>
        </div>
      </div> 
      
    <!--  
      <ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('Are there any scholarships or financial aid options available?', 'srft-theme'); ?></h2>
          <?php echo get_post_meta($post_id, 'Scholarship', true); ?>
        </li>
      </ul>-->

      <h3>
         <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect5" id="accordion5id">
           <span class="accordion-title">
           <?php echo __('Are there any scholarships or financial aid options available?', 'srft-theme'); ?>
          <span class="accordion-icon"></span>
          </span>
         </button>
    </h3>
        
      <div id="sect5" role="region" aria-labelledby="accordion5id" class="accordion-panel" hidden="">
        <div>
       <?php echo get_post_meta($post_id, 'Scholarship', true); ?>
        </div>
      </div> 

      <!--<ul>
        <li>
          <input type="checkbox" checked>
          <i></i>
          <h2><?php echo __('Does the school provide access to film festivals or competitions?', 'srft-theme'); ?></h2>
          <?php echo get_post_meta($post_id, 'Competitions', true); ?>
        </li>
      </ul>-->
    
      <h3>
         <button type="button" aria-expanded="false" class="accordion-trigger" aria-controls="sect6" id="accordion6id">
           <span class="accordion-title">
           <?php echo __('Does the school provide access to film festivals or competitions?', 'srft-theme'); ?>
          <span class="accordion-icon"></span>
          </span>
         </button>
      </h3>
        
      <div id="sect6" role="region" aria-labelledby="accordion6id" class="accordion-panel" hidden="">
       <div>
        <?php echo get_post_meta($post_id, 'Competitions', true); ?>
       </div>  
      </div>   
    </div>
  </section>
</div>

<?php get_footer(); ?>


