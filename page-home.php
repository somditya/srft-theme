<?php
/*
Template Name: Home

 */

 get_header();
 $excerpt = get_the_excerpt();  
 $current_language = get_locale();
?>


<main>

<div id="smooth-wrapper">
    <div id="smooth-content">
 <section id="skip-to-content" class="section-home" style="background-color: #161a1d; padding:10px;" id=skip-link>
 <div class="container" style="display:flex; column-gap: 10px; align-items: center; justify-content: space-between;">
 <div style="color:white; font-size: 18px; width: calc(15% - 40px); padding:0px;"><?php echo __('Whats New', 'srft-theme' ); ?></div>
 <div class="secondary__header-arrow" class="margin-left: 0px;  padding:0px; calc(15% - 40px); "> 
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:white;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: white;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
 </span>
 </div>
 <div style="color:white; font-size: 18px; width: calc(90% - 40px); "><marquee direction="right">JET 2022 result published please follow the link to know your rank</marquee></div>
 </section>
 
 <section  class="section-news" style="background-color: #0b6b39;" id="section-1">
 <h2  class="section-intro-header-text" style="padding-top: 48px; padding-left: 0; color:#f3f3f3;" >
      <?php echo __('Featured News', 'srft-theme' ); ?>
      </h2>
   <div class="frame">
   <div class="static owl-carousel">
   <?php

    $post_id = get_the_ID();
    $post_content = apply_filters('the_content', $post->post_content);
    
    if ($current_language === 'en_US') {
      $catslug='news-en'; 
     }
      else
      {
        $catslug='news-hi';
      }
      $category_posts = new WP_Query(array(
        'post_type' => 'news',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $catslug,
            ),
        ),
        'posts_per_page' => -1,
    ));
  

    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
    ?>
    
      <div class="news-item">
      <a href="<?php the_permalink(); ?>" target="_blank" role="link">
        <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('News-Image');?> ?>" alt="<?php echo get_field('News-Image-Alternativetext'); ?>"  style="display: block;">
      <div class="news-item-title">
        <h3 href="#"><?php the_title(); ?></h3>
        <p><?php echo $post_content; ?></p>
        <!--<i class="fa-solid fa-play fa-xl" style="color: #161718;"></i>-->
        <!--<div class="primary__header-arrow">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg></div>-->
      </div>
      </a>
      </div>
      <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>  
 </div>
 <div class="link-div" style="align-items: center;"">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
   <div class="link-div" style="align-items: center; margin-top: 0;">
     <a class="link-text-big" href="<?php echo esc_url(site_url('/news-list/')); ?>" role="link"><span class="lbl"><?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
       <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow" style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
     </span>
   </a>
  </div> 
   </div>
 </div>
 
 </div>
 </div>
 </section>
 
<section class="section-home"; style="padding: 0;">
  <div  style="display:flex; flex-wrap: wrap; background-color: #777777">
    <div class="abtimg-box">
    </div>
    <div class="text-box">
      <h2 class="section-intro-header-text" style="padding-left: 0; color:#f3f3f3; " >
      <?php echo __('The Institute', 'srft-theme' ); ?>
      </h2>
      <p style="padding-top: 20px; color:white; font-family: 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 1.8rem; line-height: 1.5;" ><?php echo $excerpt ; ?>

      </p>
      <div class="link-div">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        <div class="link-div" style="align-items: center; margin-top: 0;">
          <a class="link-text-big" href="<?php echo esc_url(site_url('/about-the-institute/')); ?>" role="link"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>
          
        </div>
      </div>
    </div>
   
  </div>
</section>

<div class="section-home" style="background-color: black; margin:0; padding:0;">
  <div class="section-intro-header">
    <div class="section-into-text" style="padding:25px;">
      <h3 style="color:beige"><i><?php echo __('SRFTI is an active member of CILECT', 'srft-theme' ); ?>,<br>
      <?php echo __('an association that gathers the best film school in the world.', 'srft-theme' ); ?></i></h3>
      <div class="">
          <a href="http://www.cilect.org/" target="_blank" role="link">
            <img src="<?php bloginfo('template_url'); ?>/images/cilect.png" target="_blanK" alt="CILECT" >
          </a>
      </div>
    </div>
  </div>
</div>

<!--<section class="section-home"; style="padding: 0;">
  <div  style="display:flex; flex-wrap: wrap; background-color: #777777">
    <div class="text-box">
      <h2 class="section-intro-header-text" style="padding-left: 0; color:#f3f3f3; ">
      <?php echo __('The Institute', 'srft-theme' ); ?>
      </h2>
      <p style="color:white; font-family: 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 1.8rem; line-height: 1.5;"><?php echo $excerpt ; ?>
      </p>
      <div class="link-div">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        <div class="link-div" style="align-items: center; margin-top: 0;">
          <a class="link-text-big" href="<?php echo esc_url(site_url('/about-the-institute/')); ?>"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>
          
        </div>
      </div>
    </div>
    <div class="abtimg-box">
    </div>
  </div>
</section>-->
<!--<section class="section-home" style="background-color: #f0e9e9; ">
  <div class="accolades" style="display:flex">
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">4 </span></h2>
  <div class="accolades-text">
    <p><?php echo __('Presence in Cannes', 'srft-theme' ); ?></p>
  </div>
  </div>
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">36</span></h2>
  <div class="accolades-text">
    <p><?php echo __('National Awards', 'srft-theme' ); ?></p>
  </div>
  </div>
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">65</span>+</h2>
  <div class="accolades-text">
    <p><?php echo __('National & Internal Festival Selections', 'srft-theme' ); ?></p>
  </div>
  </div>
  </div>
  <div class="link-div" style="align-items: center; margin-top: 0;">
    <a class="link-text-big" href="#"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
    </span> </a>
    
  </div>

</section>-->

<section id="courses">
  <div class="container grid grid--2-cols">
    <div class="course-head">
      <h2  class="section-intro-header-text" >
      <?php echo __('Study options', 'srft-theme' ); ?>  
      </h2>
    </div>
    <div class="course-text">
       <div class="course-highlight">
        <a class="button-link-course" href="<?php echo esc_url(site_url('/post-graduate-programme-in-cinema/')); ?>" role="link">
          <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg>
        </div><?php echo __('Post Graduate Programme in Cinema', 'srft-theme' ); ?> &nbsp;
      </a>
        </div>

        <div class="course-highlight" >
          <a class="button-link-course" href="<?php echo esc_url(site_url('//post-graduate-programme-in-edm//')); ?>" role="link">
            <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg>
          </div><?php echo __('Post Graduate Programme in EDM', 'srft-theme' ); ?> &nbsp;
        </a>
          </div>

          <div class="course-highlight">
            <a class="button-link-course" href="<?php echo esc_url(site_url('/short-prorammes/')); ?>" role="link">
              <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;;">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg>
            </div><?php echo __('Short Courses', 'srft-theme' ); ?>&nbsp;
          </a>
            </div>
          
  </div>
</section>


<section class="section-home" style="background-color: #f0e9e9;;  ">

  <div style="margin-top: 3.2rem">
    <h2  class="section-intro-header-text" style="padding-left: 0; ">
    <?php echo __('Notable Alumni', 'srft-theme' ); ?>    </h2>
    <div class="alumni">
      <div class="nonstatic owl-carousel">
        <div class="alumni-item">
            <a class="alumni-img"
              href="#"
              target="_blank"
              ><img 
                src="<?php bloginfo('template_url'); ?>/images/Amal-Neerad.jpg"
                alt="Picture of Amal Neerad"
              /></a>
              <h5><?php echo __('Amal Neerad', 'srft-theme' ); ?></h5>
           </div>

           <div class="alumni-item">   
            <a class="alumni-img"
              href="#"
              target="_blank"
              ><img
                src="<?php bloginfo('template_url'); ?>/images/Kanu-Behl.jpg"
                alt="Picture of Kanu Behl"
              /></a>
              <h5><?php echo __('Kanu Behl', 'srft-theme' ); ?></h5>
              </div>

            <!--<div class="alumni-item">  
            <a class="alumni-img"
              href="#"
              ><img
                src="<?php bloginfo('template_url'); ?>/images/Vipin-Vijay-small.jpg"
                alt="Picture of Vipin Vijay"
              /></a>
              <h5><?php echo __('Vipin Vijay', 'srft-theme' ); ?></h5>
              </div>-->

              <div class="alumni-item">  
                <a class="alumni-img"
                  href="#"
                  ><img
                    src="<?php bloginfo('template_url'); ?>/images/namrata=rao.webp"
                    alt="Picture of Namrata Rao"
                  /></a>
                  <h5><?php echo __('Namrata Rao', 'srft-theme' ); ?></h5>
                  </div>

                  <div class="alumni-item">  
                    <a class="alumni-img"
                      href="#"
                      ><img
                        src="<?php bloginfo('template_url'); ?>/images/paban-kumar.webp"
                        alt="Picture of Hawam Paban Kumar"
                      /></a>
                      <h5><?php echo __('Hawam Pabam Kumar', 'srft-theme' ); ?></h5>       
                      </div>
    

          <div class="alumni-item">
            <a class="alumni-img"
              href="#"
              target="_blank"
              ><img
                src="<?php bloginfo('template_url'); ?>/images/pritha-chakraborty.png"
                alt="Picture of Pritha Chakraborty"
              /></a>
              <h5><?php echo __('Pritha Chakraborty', 'srft-theme' ); ?></h5>
              </div>

          <div class="alumni-item">
            <a class="alumni-img"
              href="#"
              target="_blank"
              ><img
                src="<?php bloginfo('template_url'); ?>/images/Modhura-Palit.png"
                alt="Picture of Madhura Palit"
              /></a>
              <h5><?php echo __('Madhura Palit', 'srft-theme' ); ?></h5>
              
              </div>

            <div class="alumni-item">  
            <a class="alumni-img"
              href="#"
              target="_blank"
              ><img
                src="<?php bloginfo('template_url'); ?>/images/avijit-sen.png"
                alt="Picture of Avijit Sen"
              /></a>
              <h5><?php echo __('Abhijit Sen', 'srft-theme' ); ?></h5>
              </div>

              <div class="alumni-item">
            <a class="alumni-img
              href="#"
              target="_blank"
              ><img
                src="<?php bloginfo('template_url'); ?>/images/sagar-ballari.png"
                alt="Picture of Sagar Ballary"
              /></a>
              <h5><?php echo __('Sagar Ballary', 'srft-theme' ); ?></h5>
              </div>
            <div class="alumni-item">  
            <a class="alumni-img"
              href="#"
              target="_blank"
              ><img
                src="<?php bloginfo('template_url'); ?>/images/Pritam Das.png"
                alt="Picture of Pritam Das"
              /></a>
              <h5><?php echo __('Pritam Das', 'srft-theme' ); ?></h5>
              </div>
              <div class="alumni-item">  
                <a class="alumni-img"
                  href="#"
                  target="_blank"
                  ><img
                    src="<?php bloginfo('template_url'); ?>/images/Saurav-Rai.png"
                    alt="Picture of Sourav Rai"
                  /></a>
                  <h5><?php echo __('Sourav Rai', 'srft-theme' ); ?></h5>
                  </div>
                  <div class="alumni-item">  
                    <a class="alumni-img"
                      href="#"
                      target="_blank"
                      ><img
                        src="<?php bloginfo('template_url'); ?>/images/Dominic-Sangma.png"
                        alt="Picture of Domin Sangma"
                      /></a>
                      <h5><?php echo __('Dominic Sangma', 'srft-theme' ); ?></h5>
                      </div>
      </div>
  
    </div>
    <!--<div class="link-div" style="align-items: center;>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
      <div class="link-div" style="align-items: center; margin-top: 0;">
        <a class="link-text-big" href="news-list/">
          <span><?php echo __('Read Alumni News', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>
      </div>
  </div>-->

</section>

  <section class="section-home" style="background-color: rgb(228, 118, 15);
  background-image: url(<?php bloginfo('template_url'); ?>/images/Workshop002.png); background-blend-mode: multiply;">
    <!--<div class="section-intro-header-text" style="color: white;">News</div>-->
    <h2 class="section-intro-header-text" style="padding-left: 0; color: white "><?php echo __('Award Winnng Student Films', 'srft-theme' ); ?></h2>
    <div class="frame">
    <div class="static owl-carousel">
    <?php
    $post_id = get_the_ID();
    $post_content = apply_filters('the_content', $post->post_content);
    
    if ($current_language === 'en_US') {
      $catslug='award-en'; 
     }
      else
      {
        $catslug='award-hi';
      }
      $category_posts = new WP_Query(array(
        'post_type' => 'award',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $catslug,
            ),
        ),
        'posts_per_page' => -1,
    ));
  

    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
    ?>
    
      <div class="news-item">
      <a href="<?php the_permalink(); ?>" target="_blank" role="link">
        <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('film_still');?>" alt="<?php echo get_field('film_still_alt_text'); ?>"  style="display: block;">
      <div class="news-item-title">
        <h3 href="#"><?php echo get_field('Film-Name');?></h3>
        <p><?php echo get_field('award_received');?></p>
        <!--<i class="fa-solid fa-play fa-xl" style="color: #161718;"></i>-->
        <!--<div class="primary__header-arrow">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg></div>-->
      </div>
      </a>
      </div>
      <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>  
      
  </div>
  <!--<div class="link-div" style="align-items: center; margin-top:0;">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
    <a class="link-text-big" href="#" >Read More Here</a>
    </div>-->
  </div>
  </section>

    <section class="section-home" style="background-color: #f0e9e9;"  >
      <div class="section-intro-header">
        <h2 class="section-intro-header-text" style="padding-left: 0; ">
        <?php echo __('Media gallery', 'srft-theme' ); ?>  </h2>
      </div>
      <div class="container" style="display:flex; padding:24px; max-width: 1450px;">     
        <div class="img_card">
          <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="events">
            <img alt="Events & Festvals" width="302" height="416"  class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/convocation.jpg">
                      <div class="img_caption" >
                        <p class="img-caption-text"><?php echo __('Events & Festivals', 'srft-theme' ); ?></p>
                      </div></a>
                </div>

                <div class="img_card">
                  <a href="<?php bloginfo('template_url'); ?>/images/animation_cinema.png" data-lightbox="workshops" >
                    <img alt="Master Classess & workshops" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/workshop001.png">
                  <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Master Classess & workshops', 'srft-theme' ); ?></p>
                  </div></a>
                </div>

            <div class="img_card">
              <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="stills"><img alt="Still from Students Film" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/still_sf.jpg">
              <div class="img_caption">
                <p class="img-caption-text"><?php echo __('Still from Students Film', 'srft-theme' ); ?></p>
              </div></a>
            </div>
        <div class="img_card">
          <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="moments"><img alt="Campus moments" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Gothar Retro.JPG">
          <div class="img_caption" >
            <p class="img-caption-text"><?php echo __('Campus moments', 'srft-theme' ); ?></p>
          </div></a>
      </div>
    <div class="img_card">
      <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="news"><img alt="SRFTI in News" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Alumni_News_KanuBehl.jpg">
      <div class="img_caption">
        <p class="img-caption-text"><?php echo __('SRFTI in News', 'srft-theme' ); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
      </div></a>
    </div>
    </div>
    <!-- Container for Category 1 Gallery Images -->
    <div id="events" style="display: none;">
<?php
    // Determine the category slug based on the current language
    $catslug = ($current_language === 'en_US') ? 'picture' : 'picture-hi';

    // Query posts in the specified category with Picture_Category set to "Event"
    $category_posts = new WP_Query(array(
        'post_type' => 'picture', // Assuming 'picture' is your custom post type
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $catslug,
            ),
        ),
        'meta_query' => array(
            array(
                'key'     => 'Picture_Category', // ACF field name
               'value'   => array('Convocation', 'Event', 'Festival'), // Array of values to match
            'compare' => 'IN' // Match any of the values
            ),
        ),
        'posts_per_page' => 5, // Adjust the number of posts per page as needed
    ));

    if ($category_posts->have_posts()) :
      while ($category_posts->have_posts()) : $category_posts->the_post();
          // Get the image file from ACF
          $image = get_field('Picture_File');
          if ($image) : ?>
            <a href="<?php echo esc_url($image); ?>" data-lightbox="events">
              <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" class="img-responsive lazyOwl">
            </a>
          <?php
          endif;
      endwhile;
      wp_reset_postdata(); // Reset the post data
  else :
      echo '<p>No posts found in this category.</p>';
  endif;
?>   
</div>


<!-- Container for Category 2 Gallery Images -->
<div id="workshops" style="display: none;">
<?php
    // Determine the category slug based on the current language
    $catslug = ($current_language === 'en_US') ? 'picture' : 'picture-hi';

    // Query posts in the specified category with Picture_Category set to "Event"
    $category_posts = new WP_Query(array(
        'post_type' => 'picture', // Assuming 'picture' is your custom post type
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $catslug,
            ),
        ),
        'meta_query' => array(
            array(
                'key'     => 'Picture_Category', // ACF field name
                'value'   => 'Workshops', // Value to match
                'compare' => '='
            ),
        ),
        'posts_per_page' => 5, // Adjust the number of posts per page as needed
    ));

    if ($category_posts->have_posts()) :
      while ($category_posts->have_posts()) : $category_posts->the_post();
          // Get the image file from ACF
          $image = get_field('Picture_File');
          if ($image) : ?>
            <a href="<?php echo esc_url($image); ?>" data-lightbox="workshops">
              <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" class="img-responsive lazyOwl">
            </a>
          <?php
          endif;
      endwhile;
      wp_reset_postdata(); // Reset the post data
  else :
      echo '<p>No posts found in this category.</p>';
  endif;
?>   
</div>
<!-- Container for Category 3 Gallery Images -->
<div id="stills" style="display: none;">
<?php
    // Determine the category slug based on the current language
    $catslug = ($current_language === 'en_US') ? 'picture' : 'picture-hi';

    // Query posts in the specified category with Picture_Category set to "Event"
    $category_posts = new WP_Query(array(
        'post_type' => 'picture', // Assuming 'picture' is your custom post type
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $catslug,
            ),
        ),
        'meta_query' => array(
            array(
                'key'     => 'Picture_Category', // ACF field name
                'value'   => 'Student Stills', // Value to match
                'compare' => '='
            ),
        ),
        'posts_per_page' => 5, // Adjust the number of posts per page as needed
    ));

    if ($category_posts->have_posts()) :
      while ($category_posts->have_posts()) : $category_posts->the_post();
          // Get the image file from ACF
          $image = get_field('Picture_File');
          if ($image) : ?>
            <a href="<?php echo esc_url($image); ?>" data-lightbox="stills">
              <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" class="img-responsive lazyOwl">
            </a>
          <?php
          endif;
      endwhile;
      wp_reset_postdata(); // Reset the post data
  else :
      echo '<p>No posts found in this category.</p>';
  endif;
?>   
</div>

<!-- Container for Category 4 Gallery Images -->
<div id="moments" style="display: none;">
<?php
    // Determine the category slug based on the current language
    $catslug = ($current_language === 'en_US') ? 'picture' : 'picture-hi';

    // Query posts in the specified category with Picture_Category set to "Event"
    $category_posts = new WP_Query(array(
        'post_type' => 'picture', // Assuming 'picture' is your custom post type
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $catslug,
            ),
        ),
        'meta_query' => array(
            array(
                'key'     => 'Picture_Category', // ACF field name
                'value'   => 'Campus Life', // Value to match
                'compare' => '='
            ),
        ),
        'posts_per_page' => 5, // Adjust the number of posts per page as needed
    ));

    if ($category_posts->have_posts()) :
      while ($category_posts->have_posts()) : $category_posts->the_post();
          // Get the image file from ACF
          $image = get_field('Picture_File');
          if ($image) : ?>
            <a href="<?php echo esc_url($image); ?>" data-lightbox="moments">
              <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" class="img-responsive lazyOwl">
            </a>
          <?php
          endif;
      endwhile;
      wp_reset_postdata(); // Reset the post data
  else :
      echo '<p>No posts found in this category.</p>';
  endif;
?>   
</div>

<!-- Container for Category 4 Gallery Images -->
<div id="news" style="display: none;">
<?php
    // Determine the category slug based on the current language
    $catslug = ($current_language === 'en_US') ? 'picture' : 'picture-hi';

    // Query posts in the specified category with Picture_Category set to "Event"
    $category_posts = new WP_Query(array(
        'post_type' => 'picture', // Assuming 'picture' is your custom post type
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $catslug,
            ),
        ),
        'meta_query' => array(
            array(
                'key'     => 'Picture_Category', // ACF field name
                'value'   => 'Media Publication', // Value to match
                'compare' => '='
            ),
        ),
        'posts_per_page' => 5, // Adjust the number of posts per page as needed
    ));

    if ($category_posts->have_posts()) :
      while ($category_posts->have_posts()) : $category_posts->the_post();
          // Get the image file from ACF
          $image = get_field('Picture_File');
          if ($image) : ?>
            <a href="<?php echo esc_url($image); ?>" data-lightbox="news">
              <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" class="img-responsive lazyOwl">
            </a>
          <?php
          endif;
      endwhile;
      wp_reset_postdata(); // Reset the post data
  else :
      echo '<p>No posts found in this category.</p>';
  endif;
?>   
</div>
  </section>


<section class="section-home" style="background-color: #f5f5f5; ">
<div class="section-intro-header">
    <h2 class="section-intro-header-text" style="padding-left: 0;">
    <?php echo __('Updates', 'srft-theme' ); ?>    </h2>
  </div>  
<div class="updates-container">
  
<div class="box-container" style="display:flex;">  
<div class="cell">
<span class="update-title"><?php echo __('Announcements', 'srft-theme' ); ?></span>
<?php
    $category_posts = new WP_Query(array(
        'category_name' => 'announcement-en', // Replace with your category slug
        'posts_per_page' => 5,
    ));

    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
        $post_link = get_permalink();
    ?>
    <h3><a href="<?php echo esc_url($post_link); ?>" role="link"><?php the_title(); ?></a>
    </h3>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>
  <div class="link-span"><a  href="<a  href="<?php echo esc_url(site_url('/course-overview/')); ?>""><?php echo __('More', 'srft-theme' ); ?></a></div>
</div>

<div class="cell">
    <span class="update-title" ><?php echo __('Tender', 'srft-theme' ); ?></span>
    <?php
    if ($current_language === 'en_US') {
      $catslug='tender'; 
     }
      else
      {
        $catslug='tender-hi';
      }
    $category_posts = new WP_Query(array(
      'post_type' => 'tender',
      'tax_query' => array(
          array(
              'taxonomy' => 'category',
              'field'    => 'slug',
              'terms'    => $catslug,
          ),
      ),
      'posts_per_page' => 5,
  ));


    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
            $post_link = get_permalink();
    ?>
            <h3>
                <a href="<?php echo esc_url($post_link); ?>"><?php the_title(); ?></a>
            </h3>
            <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>
    <div class="link-span"><a  href="<?php echo esc_url(site_url('/tender/')); ?>" role="link"><?php echo __('More', 'srft-theme' ); ?></a></div>
</div>

  
<div class="cell">
      <span class="update-title" ><?php echo __('Vacancy', 'srft-theme' ); ?></span>
      <?php
       if ($current_language === 'en_US') {
        $catslug='vacancy'; 
       }
        else
        {
          $catslug='vacancy-hi';
        }
    $category_posts = new WP_Query(array(
      'post_type' => 'vacancy',
      'tax_query' => array(
          array(
              'taxonomy' => 'category',
              'field'    => 'slug',
              'terms'    => $catslug,
          ),
      ),
      'posts_per_page' => 5,
  ));



    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
        $post_link = get_permalink();
    ?>
    <h3><a href=<?php echo $post_link ?>><?php the_title(); ?></a></h3>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>
        <div class="link-span"><a  href="<?php echo esc_url(site_url('/vacancy/')); ?>"><?php echo __('More', 'srft-theme' ); ?></a></div>
      </div>
      
</div>

</div>
</section>
<?php
get_footer(); 
?>
  </div>
  </div>
  </main>


