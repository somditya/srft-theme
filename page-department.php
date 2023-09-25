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
$department_name=get_post_meta($page_id, 'Department', true);
$duration=get_post_meta($page_id, 'Duration', true);
$eligibilty=get_post_meta($page_id, 'Eligibilty', true);
$seats=get_post_meta($page_id, 'Seats', true);


// Check if the custom field has a value

?>

<section class="cine-header" style="background-image: url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>');">
   <div class="page-banner">
      <div class="page-banner-title"><?php the_title(); ?></div>
   </div>
</section>

<section class="cine-detail">
 <div class="leftnav">
   <div class="childnavs">
     <ul class="childnav-lists">
       <li class="childnav-list-item">
         <a class="item"><?php echo __('Prospectus', 'srft-theme' ); ?></a>
       </li>
       <li class="childnav-list-item">
         <a class="item"><span class=""><?php echo __('Scholarship', 'srft-theme' ); ?></span></a>
       </li>
       <li class="childnav-list-item">
         <a class="item"><?php echo __('Academic Calendar', 'srft-theme' ); ?></a>
       </li>
       <li class="childnav-list-item">
         <a class="item"><?php echo __('Academic By-law', 'srft-theme' ); ?></a>
       </li>
     </ul>
   </div>

   <div class="widget">
     <div class="widget-content">
       <h2><?php echo __('Course Duration', 'srft-theme' ); ?></h2>
       <hr />
       <div>
         <p> <?php if (!empty($duration)) {
    echo $duration;
    }?></p>
       </div>
     </div>
   </div>
   <div class="widget">
     <div class="widget-content">
       <h2><?php echo __('Total No. of Seats', 'srft-theme' ); ?></h2>
       <hr />
       <div>
         <p> <?php if (!empty($seats)) {
    echo $seats;
    }?></p>
       </div>
     </div>
   </div>
   <div class="widget">
     <div class="widget-content">
       <h2><?php echo __('Elibility Criteria', 'srft-theme' ); ?></h2>
       <hr />
       <div>
         <p>Bachelor’s Degree in any discipline.</p>
         <br />
         <p>
           Candidates successful in the Joint Entrance Test (JET) will
           be called for Orientation and Interview. Final merit list
           will be prepared on the basis of written examination(JET),
           orientation and interview.
         </p>
       </div>
     </div>
   </div>
 </div>

 <div class="main-content">
   <div style="margin-top: 0rem">
     <h2 class="page-header-text" style="padding-left: 0; ">
     <?php echo __('About the department', 'srft-theme' ); ?>
     </h2>
     <?php if (!empty($about)) {
    echo $about;
    }?>
   <div>
     
   </div>
   </div>

   <div style="margin-top: 3.2rem">
     <h2 class="page-header-text" style="padding-left: 0; ">
     <?php echo __('Course objective', 'srft-theme' ); ?>
     </h2>

     <?php if (!empty($objective)) {
    echo $objective;
    }?>
    
   </div>

  

<div style="margin-top: 3.2rem;">
    <h2 class="page-header-text" style="padding-left: 0;">
    <?php echo __('Faculty & Academic Support Staff', 'srft-theme' ); ?></h2>
    <section class="faculty">
        <div class="faculty-img">
            <ul>
              <?php
  // Define the department name you want to display
  $department_name = 'cinematography'; // Replace with the actual department name

  // Custom query to retrieve faculty posts in the specified department
  $faculty_query = new WP_Query(array(
      'post_type' => 'post',         // Change to your post type if needed
      'category_name' => 'faculty-en', // Name of the "Faculty" category
      'meta_query' => array(
          array(
              'key' => 'Department', // Custom field name for department
              'value' => $department_name,
              'compare' => '=',
          ),
      ),
  ));

  // Loop through faculty posts
  if ($faculty_query->have_posts()) :
      while ($faculty_query->have_posts()) : 
        $faculty_query->the_post();
  ?>
                  <li>
                      <a href="<?php the_permalink(); ?>" target="_blank">
                      <img src="<?php the_post_thumbnail_url('thumbnail'); ?>"  alt="" />

                          <h4><?php the_title(); ?></h4>
                          <span><?php echo get_post_meta(get_the_ID(), 'Designation', true); ?></span>
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
            <a href="#"> <?php echo __('Learn More About Them', 'srft-theme' ); ?></a>
        </div>
    </section>
</div>



   
   <div style="margin-top: 3.2rem">
     <div class="box-container" style="width: 100%">
       <div class="facility-text-box">
         <div
           class="page-header-text"
           style="padding-left: 0;"
         >
         <?php echo __('Facilities', 'srft-theme' ); ?>
         </div>
         <div>
           <ul>
             <li>Film studio 70’x50’ dimension</li>
             <li>Television studio 40’x40’ dimension</li>
             <li>Practice studio 60’x45’dimension</li>
             <li>Film studio 70’x50’ dimension</li>
             <li>Television studio 40’x40’ dimension</li>
             <li>Practice studio 60’x45’dimension</li>
           </ul>
         </div>
       </div>

       <div class="facility-img-box">
         <img src="<?php bloginfo('template_url'); ?>/images/osrf_cores.png" class="container-image"" />
       </div>
       
     </div>
   </div>
  


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
     href="https://philosophy.uchicago.edu/faculty/a-callard"
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

</div>

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