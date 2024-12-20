<?php

/*

Theme Name: SRFTI
Theme URI: https://srfti.ac.in
Author: Somaditya Majumder
Description: Custom SRFTI Theme
Version: 1.0
Text Domain: srfti 
*/

get_header(); 
?>

<main>
 <section class="section-home" style="background-color: #161a1d; padding:10px">
 <div class="container" style="display:flex; column-gap: 10px; align-items: center; justify-content: space-between;">
 <div style="color:white; font-size: 18px; width: calc(15% - 40px); padding:0px;">What's New</div>
 <div class="secondary__header-arrow" class="margin-left: 0px;  padding:0px; calc(15% - 40px); "> 
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:white;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: white;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
 </span>
 </div>
 <div style="color:white; font-size: 18px; width: calc(90% - 40px); "><marquee direction="right">JET 2022 result published please follow the link to know your rank</marquee></div>
 </section>
 <section id="#main-content" class="section-news" style="background-color: #0b6b39; ">
   <!--<div class="section-intro-header-text" style="color: white;">News</div>-->
   <h2 class="section-intro-header-text" style="padding-left: 0; color: white ">Featured News</h2>
   <div class="frame">
   <div class="static owl-carousel">
   <?php

    $post_id = get_the_ID();
    $post_content = wpautop($s->post_content);
    $category_posts = new WP_Query(array(
        'category_name' => 'news-en', // Replace with your category slug
    ));

    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
    ?>
    
      <div class="news-item">
      <a href="<?php the_permalink(); ?>" target="_blank">
        <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php the_post_thumbnail_url('thumbnail'); ?> ?>" style="display: block;">
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
     <a class="link-text-big" href="#"><span class="lbl"> Read More Here</span><span class="primary__header-arrow"> 
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
      <h2 class="section-intro-header-text" style="padding-left: 0; color:#f3f3f3; ">
        The Institute
      </h2>
      <p style="color:white; font-family: 'Open Sans', 'Helvetica Neue', sans-serif;
    font-size: 1.8rem; line-height: 1.5;">
SRFTI (Satyajit Ray Film & Television Institute)
based in Kolkata, West Bengal,
is an academic Institute in the field of cinema,
television,
oriented towards the students' development with the aim of improving their inclinations,
talents and skills.
Students are immersed in creative settings, where teamwork is valued, with an eminently practical planning guidance.
      </p>
      <div class="link-div">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        <div class="link-div" style="align-items: center; margin-top: 0;">
          <a class="link-text-big" href="#"><span> Read More Here</span><span class="primary__header-arrow"> 
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
      <h3 style="color:beige"><i>SRFTI, since 2014 is an active member of CILECT,<br>
      an association that gathers the best film school in the world.</i></h3>
      <div class="">
          <a href="http://www.cilect.org/" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/cilect.png" target="_blanK" alt="CILECT">
          </a>
      </div>
    </div>
  </div>
</div>
<section class="section-home" style="background-color: #f0e9e9; ">
  <div class="accolades" style="display:flex">
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">4 </span></h2>
  <div class="accolades-text">
    <p>Presence in Cannes</p>
  </div>
  </div>
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">36</span></h2>
  <div class="accolades-text">
    <p>National Awards</p>
  </div>
  </div>
  <div style="display:flex; flex-direction: column;">
    <h2><span class="counter">65</span>+</h2>
  <div class="accolades-text">
    <p>National & Internal Festival Selections</p>
  </div>
  </div>
  </div>
  <div class="link-div" style="align-items: center; margin-top: 0;">
    <a class="link-text-big" href="#"><span> Read More Here</span><span class="primary__header-arrow"> 
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
    </span> </a>
    
  </div>

</section>

<section id="courses">
  <div class="container grid grid--2-cols">
    <div class="course-head">
      <h2 class="section-intro-header-text" style= "color:white; font-size: 6.2rem; margin-top: 5%;"  >
        Study options  
      </h2>
    </div>
    <div class="course-text">
       <div class="course-highlight">
        <a class="button-link-course" href="pgcinema.html">
          <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;;">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg>
        </div>Post Graduate Programme in Cinema&nbsp;
      </a>
        </div>

        <div class="course-highlight">
          <a class="button-link-course" href="pgcinema.html">
            <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg>
          </div>Post Graduate Programme in EDM&nbsp;
        </a>
          </div>

          <div class="course-highlight">
            <a class="button-link-course" href="pgcinema.html">
              <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;;">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg>
            </div>Short Courses&nbsp;
          </a>
            </div>
        
          
          
  </div>
</section>



<section class="section-home" style="background-color: #f0e9e9;;  ">

  <div style="margin-top: 3.2rem">
    <h2 class="section-intro-header-text" style="padding-left: 0; ">
      Notable Alumni    </h2>
    <div class="alumni">
      <div class="nonstatic owl-carousel">
        <div class="alumni-item">
            <a class="alumni-img"
              href="https://philosophy.uchicago.edu/faculty/a-callard"
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
    <div class="link-div" style="align-items: center;>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
      <div class="link-div" style="align-items: center; margin-top: 0;">
        <a class="link-text-big" href="#"><span> Read Alumni News</span><span class="primary__header-arrow"> 
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
        </span>
      </a>
        
      </div>
  </div>

</section>

  <section class="section-home" style="background-color: rgb(228, 118, 15);
  background-image: url(<?php bloginfo('template_url'); ?>/images/Workshop002.png); background-blend-mode: multiply;">
    <!--<div class="section-intro-header-text" style="color: white;">News</div>-->
    <h2 class="section-intro-header-text" style="padding-left: 0; color: white ">Award Winnng Student Films</h2>
    <div class="frame">
    <div class="static owl-carousel">
    <?php
    $category_posts = new WP_Query(array(
        'category_name' => 'film', // Replace with your category slug
    ));

    if ($category_posts->have_posts()) :
        while ($category_posts->have_posts()) : $category_posts->the_post();
    ?>
    
      <div class="news-item">
      <a href="<?php the_permalink(); ?>" target="_blank">
        <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php the_post_thumbnail_url('thumbnail'); ?> ?>" style="display: block;">
      <div class="news-item-title">
        <h3 href="#"><?php the_title(); ?></h3>
        <p><?php echo get_post_meta(get_the_ID(), 'Award', true); ?></p>
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
          Media gallery  </h2>
      </div>
      <div class="container" style="display:flex; padding:24px; max-width: 1450px;">     
        <div class="img_card">
          <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="events">
            <img alt="Events & Festvals" width="302" height="416"  class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/convocation.jpg">
                      <div class="img_caption" >
                        <p class="img-caption-text">Events & Festivals</p>
                      </div></a>
                </div>

                <div class="img_card">
                  <a href="<?php bloginfo('template_url'); ?>/images/animation_cinema.png" data-lightbox="workshops">
                    <img alt="Master Classess & workshops" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/workshop001.png">
                  <div class="img_caption">
                    <p class="img-caption-text">Master Classess & workshops</p>
                  </div></a>
                </div>

            <div class="img_card">
              <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="stills"><img alt="Still from Students Film" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/still_sf.jpg">
              <div class="img_caption">
                <p class="img-caption-text">Still from Students Film</p>
              </div></a>
            </div>
        <div class="img_card">
          <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="moments"><img alt="Campus moments" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Gothar Retro.JPG">
          <div class="img_caption" >
            <p class="img-caption-text">Campus moments</p>
          </div></a>
      </div>
    <div class="img_card">
      <a href="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png" data-lightbox="news"><img alt="SRFTI in News" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Alumni_News_KanuBehl.jpg">
      <div class="img_caption">
        <p class="img-caption-text">SRFTI in News &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
      </div></a>
    </div>
    </div>
    <!-- Container for Category 1 Gallery Images -->
<div id="events" style="display: none;">
  <a href="<?php bloginfo('template_url'); ?>/images/5.2.jpg" data-lightbox="events">  
  </a>
  <a href="<?php bloginfo('template_url'); ?>/images/6.1.jpg" data-lightbox="events">
  </a>
    <!-- Add more images for Category 1 -->
</div>

<!-- Container for Category 2 Gallery Images -->
<div id="workshops" style="display: none;">
    <a href="<?php bloginfo('template_url'); ?>/images/_MG_0850.JPG" data-lightbox="workshops">  
    </a>
    <a href="/web2/images/about.jpg" data-lightbox="workshops">
    </a>
    <!-- Add more images for Category 2 -->
</div>
<!-- Container for Category 3 Gallery Images -->
<div id="stills" style="display: none;" >
  <a href="/web2/images/5.2.jpg" data-lightbox="stills">  
  </a>
  <a href="/web2/images/6.1.jpg" data-lightbox="stills">
  </a>
    <!-- Add more images for Category 3 -->
</div>

<!-- Container for Category 4 Gallery Images -->
<div id="moments" style="display: none;">
  <a href="<?php bloginfo('template_url'); ?>/images/5.2.jpg" data-lightbox="moments">  
  </a>
  <a href="<?php bloginfo('template_url'); ?>/images/6.1.jpg" data-lightbox="moments">
  </a>
    <!-- Add more images for Category 4 -->
</div>
<div id="news" style="display: none;">
  <a href="<?php bloginfo('template_url'); ?>/images/5.2.jpg" data-lightbox="news">  
  </a>
  <a href="<?php bloginfo('template_url'); ?>/images/6.1.jpg" data-lightbox="news">
  </a>
    <!-- Add more images for Category 4 -->
</div>
  </section>


<section class="section-home" style="background-color: #f5f5f5;  ;">
  <div class="updates-container">
  <div class="section-intro-header">
    <h2 class="section-intro-header-text" style="padding-left: 0;">
      Updates    </h2>
  </div>
<div class="box-container" style="display:flex;">  
<div class="cell">
<span class="update-title">Announcements</span>
<?php
    $category_posts = new WP_Query(array(
        'category_name' => 'announcement', // Replace with your category slug
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
  <div class="link-span"><a  href="#"">More</a></div>
</div>

  <div class="cell">
  <span class="update-title">Tender</span>
  <?php
    $category_posts = new WP_Query(array(
        'category_name' => 'tender', // Replace with your category slug
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
    <div class="link-span"><a  href="#"">More</a></div>
  </div>
  
      <div class="cell">
      <span class="update-title">Vacancy</span>
      <?php
    $category_posts = new WP_Query(array(
        'category_name' => 'vacancy', // Replace with your category slug
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
        <div class="link-span"><a  href="#">More</a></div>
      </div>
      
</div>

</div>
</section>


<?php get_footer(); ?>
