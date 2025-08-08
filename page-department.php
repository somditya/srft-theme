<?php
/*
Template Name: Department

 */


?>

<?php
// Enqueue the style.css file

get_header(); 
?>

<?php
// Get the ID of the current page
$page_id = get_the_ID();

// Replace 'custom_field_name' with the actual name (key) of your custom field
$about = get_post_meta($page_id, 'About', true);
$objective = get_post_meta($page_id, 'Objective', true);
$programme = get_post_meta($page_id, 'Programme', true);
$programmename = get_post_meta($page_id, 'ProgrammeName', true);
$department_name=get_post_meta($page_id, 'Department', true);
$duration=get_post_meta($page_id, 'Duration', true);
$eligibilty=get_post_meta($page_id, 'Eligibility', true);
$seats=get_post_meta($page_id, 'Seats', true);
$facilities=get_post_meta($page_id, 'Facilities', true);
$facilities_img=get_post_meta($page_id, 'Facility_url', true);
$facilities_img=str_replace('{site_url}', get_site_url(), $facilities_img);
$current_language = get_locale();

if ($current_language === 'en_US') {
  $catslug='faculty-en'; 
 }
  else
  {
    $catslug='faculty-hi';
  }


// Check if the custom field has a value

?>
<div data-scroll-container>
<section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
   <div class="page-banner">
      <h1 class="page-banner-title"><?php the_title(); ?>
     </h1> 
   </div>
  </section>

 <div class="container-aligned">
    <div class="breadcrumbs-wrapper">
    <?php
            if ( function_exists('yoast_breadcrumb') ) {
                yoast_breadcrumb( '<nav aria-label="breadcrumbs" id="breadcrumbs">','</nav>' );
            }
    ?>
   </div>
   </div>

<section id="skip-to-content" class="cine-detail">
 <aside role="complementary" aria-labelledby="sidebar-heading" class="leftnav">

  <h2 id="sidebar-heading" class="sr-only">Programme Information</h2>

  <div class="widget" style="background: #b38840; color: white;">
    <div class="widget-content">
      <h2 id="programme-heading" style="color: white;"><?php echo __('Programme Offered', 'srft-theme'); ?></h2>
      <hr role="presentation" />
      <p style="font-weight: 400; font-size: 24px; color: white; line-height: 2.8rem;"><?php echo $programmename; ?></p>
    </div>
  </div>

  <div class="widget">
    <div class="widget-content">
      <h2 id="duration-heading"><?php echo __('Programme Duration', 'srft-theme'); ?></h2>
      <hr role="presentation" />
      <p><?php if (!empty($duration)) echo $duration; ?></p>
    </div>
  </div>

  <div class="widget">
    <div class="widget-content">
      <h2 id="seats-heading"><?php echo __('Total No. of Seats', 'srft-theme'); ?></h2>
      <hr role="presentation" />
      <p><?php if (!empty($seats)) echo $seats; ?></p>
    </div>
  </div>

  <div class="widget">
    <div class="widget-content">
      <h2 id="eligibility-heading"><?php echo __('Eligibility Criteria', 'srft-theme'); ?></h2>
      <hr role="presentation" />
      <div><?php echo $eligibilty; ?></div>
    </div>
  </div>

</aside>


 <div class="main-content container-aligned" role="main">
   <div style="margin-top: 0rem">
     <h2 class="page-header-text" style="padding-left: 0; ">
     <?php echo __('About the department', 'srft-theme' ); ?>
     </h2>
     <?php if (!empty($about)) {
    echo wp_kses_post($about);
    }?>
   <div>
     
   </div>
   </div>

   <div style="margin-top: 3.2rem">
     <h2 class="page-header-text" style="padding-left: 0; ">
     <?php if (!empty($programme)) echo __('Overview of the Programme', 'srft-theme' ); ?>
     </h2>

     <?php if (!empty($programme)) {
    echo wp_kses_post($programme);
    }?>
    
   </div>

   <div style="margin-top: 3.2rem">
     <h2 class="page-header-text" style="padding-left: 0; ">
     <?php if (!empty($objective)) echo __('Programme Specific Objectives', 'srft-theme' ); ?>
     </h2>

     <?php if (!empty($objective)) {
    echo wp_kses_post($objective);
    }?>
    
   </div>


<div style="margin-top: 3.2rem;">
    <section class="faculty">
    <h2 class="page-header-text" style="padding-left: 0; letter-spacing: 0.5rem;">
    <?php echo __('Faculty & Academic Support Staff', 'srft-theme' ); ?></h2>
        <div class="faculty-img">
            <ul>
              <?php
  // Define the department name you want to display
  //$department_name = 'cinematography'; // Replace with the actual department name

  // Custom query to retrieve faculty posts in the specified department
  $faculty_query = new WP_Query(array(
    'post_type' => 'faculty',          // Change to your post type if needed
    'tax_query' => array(
        array(
            'taxonomy' => 'category',  // Taxonomy name
            'field' => 'slug',
            'terms' => $catslug,       // Term slug (replace with your actual variable)
        ),
    ),
    'meta_key' => 'Faculty-Category',   // ACF field name for category
    'orderby' => 'meta_value_num',      // Order by meta value as number
    'order' => 'ASC',                   // Order direction (ASC or DESC)
    'meta_query' => array(
        'relation' => 'AND',            // Ensures both conditions must be met
        array(
            'key' => 'Faculty-Department',     // ACF field name for department
            'value' => $department_name,       // Replace with the actual value you want to query
            'compare' => '=',                  // Comparison operator
        ),
        array(
            'key' => 'Faculty-Category',       // ACF field name for category
            'compare' => 'EXISTS',             // Check if the field exists
            'type' => 'NUMERIC'                // Ensure numeric comparison
        ),
    ),
));

  
  // Loop through faculty posts
  if ($faculty_query->have_posts()) :
      while ($faculty_query->have_posts()) : 
        $faculty_query->the_post();
        $post_link = get_permalink();
  ?>
                  <li>
                      <a href="<?php echo esc_url($post_link); ?>" target="_blank">
                      <img style="max-width: 140px;" src="<?php echo esc_url(get_field('Faculty-Image')); ?>" alt="" />
                          <h3><?php the_title(); ?></h3>
                          <span style="white-space: nowrap;"><?php echo esc_html(get_field('Faculty-Designation')); ?></span>
                      </a>
                  </li><?php
      endwhile;
      wp_reset_postdata(); // Restore the global post data
  else :
      echo 'No faculty members found.';
  endif;
  ?>
                <!-- Add more faculty members here if needed -->
            </ul>
        </div>
        <div class="link-span" style="margin-top: 0;">
        <?php 
if ($current_language === 'en_US') {
    $facurl = esc_url(site_url('/faculty'));  
} else {
    $facurl = esc_url(site_url('/hi/संकाय/'));
}
?>
<a href="<?php echo esc_url($facurl); ?>"><?php echo esc_html__('Learn More About The Faculty & Academic Support staff', 'srft-theme'); ?></a>

        </div>
    </section>
</div>

   
   <div style="margin-top: 3.2rem">
     <div class="box-container" style="width: 100%">
       <div class="facility-text-box">
         <h2
           class="page-header-text"
           style="padding-left: 0;"
         >
         <?php echo __('Facilities', 'srft-theme' ); ?>
         </h2>
         <div>
           <?php echo $facilities ?>
         </div>
       </div>

       <div class="facility-img-box">
       <img src="<?php echo $facilities_img ?>" class="container-image" / alt="">
       </div>
       
     </div>
   </div>
 
<!--
<div style="margin-top: 3.2rem">
<h2 class="page-header-text" style="padding-left: 0; text-align:center;">
<?php echo __('Visiting Faculty', 'srft-theme' ); ?> </h2>
<div class="visitingprof">
<div class="visiting owl-carousel">
<div class="alumni-item">
   <a class="alumni-img"
     href="#"
     target="_blank"
     ><img 
       src="<?php bloginfo('template_url'); ?>/images/Amal-Neerad.jpg"
       alt=""
     /></a>
     <h4>Amal Neerad</h4>
  </div>

  <div class="alumni-item">   
   <a class="alumni-img"
     href="#"
     target="_blank"
     ><img
       src="<?php bloginfo('template_url'); ?>/images/Kanu-Behl.jpg"
       alt=""
     /></a>
     <h4>Kanu Behl</h4>
     </div>

   <div class="alumni-item">  
   <a class="alumni-img"
     href="#"
     ><img
       src="<?php bloginfo('template_url'); ?>/images/Vipin-Vijay-small.jpg"
       alt=""
     /></a>
     <h4>Vipin Vijay</h4>
     </div>

     <div class="alumni-item">  
       <a class="alumni-img"
         href="#"
         ><img
           src="<?php bloginfo('template_url'); ?>/images/namrata=rao.webp"
           alt=""
         /></a>
         <h4>Namrata Rao</h4>
         </div>

         <div class="alumni-item">  
           <a class="alumni-img"
             href="#"
             ><img
               src="<?php bloginfo('template_url'); ?>/images/paban-kumar.webp"
               alt=""
             /></a>
             <h4>Hawam Pabam Kumar</h4>       
             </div>


 <div class="alumni-item">
   <a class="alumni-img"
     href="#"
     target="_blank"
     ><img
       src="<?php bloginfo('template_url'); ?>/images/pritha-chakraborty.png"
       alt=""
     /></a>
     <h4>Pritha Chakraborty</h4>
     </div>

 <div class="alumni-item">
   <a class="alumni-img"
     href="#"
     target="_blank"
     ><img
       src="<?php bloginfo('template_url'); ?>/images/Modhura-Palit.png"
       alt=""
     /></a>
     <h4>Madhura Palit</h4>
     
     </div>

   <div class="alumni-item">  
   <a class="alumni-img"
     href="#"
     target="_blank"
     ><img
       src="<?php bloginfo('template_url'); ?>/images/avijit-sen.png"
       alt=""
     /></a>
     <h4>Abhijit Sen</h4>
     </div>

     <div class="alumni-item">
   <a class="alumni-img
     href="#"
     target="_blank"
     ><img
       src="<?php bloginfo('template_url'); ?>/images/sagar-ballari.png"
       alt=""
     /></a>
     <h4>Sagar Ballary</h4>
     </div>
   <div class="alumni-item">  
   <a class="alumni-img"
     href="#"
     target="_blank"
     ><img
       src="<?php bloginfo('template_url'); ?>/images/Pritam Das.png"
       alt=""
     /></a>
     <h4>Pritam Das</h4>
     </div>
     <div class="alumni-item">  
       <a class="alumni-img"
         href="#"
         target="_blank"
         ><img
           src="<?php bloginfo('template_url'); ?>/images/Saurav-Rai.png"
           alt=""
         /></a>
         <h4>Sourav Rai</h4>
         </div>
         <div class="alumni-item">  
           <a class="alumni-img"
             href="#"
             target="_blank"
             ><img
               src="<?php bloginfo('template_url'); ?>/images/Dominic-Sangma.png"
               alt=""
             /></a>
             <h4>Dominic Sangma</h4>
             </div>
</div>

</div>

</div>-->

</section>

<script type="text/javascript">
          $('.visiting').owlCarousel({
    items:8,
    loop:true,
    rewind: true,
    autoplay: true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:4,
            nav:false
        },
        1000:{
            items:5,
            nav:false,
            loop:false
        }
    },
    autoplayTimeout:1500,
    autoplayHoverPause:true,
    nav:false,
    /*navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],*/
    dots:true,
    });
        </script>
<?php

get_footer();

?>
