<?php
/*
Template Name: Home

 */

 get_header();
 $excerpt = get_the_excerpt();  
 $current_language = get_locale();

?>


<main role="main">
<div id="smooth-wrapper">
    <div id="smooth-content">
        <section  class="section-home" style="background-color: #161a1d; padding: 10px;">
            <div id="skip-to-content" class="acme-news-ticker">
            <div class="acme-news-ticker-label">
            <?php echo __('Announcements', 'srft-theme' ); ?> &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" style="display: inline-block; vertical-align: middle;" aria-hidden="true">
                        <g fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12h22"></path>
                            <path d="M12 3l9 9-9 9"></path>
                        </g>
                    </svg>
                </div>
            <div class="acme-news-ticker-box">
    <div>
        <ul class="news-ticker">
            <?php

            if ($current_language === 'en_US') {
                $catslug = 'highlight-en';
            } else {
                $catslug = 'highlight-hi';
            }

            $today = date('Y-m-d');  // Correct date format for ACF compatibility

            $args = array(
                'post_type' => 'highlight',  // Ensure this is your custom post type
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'slug',
                        'terms' => $catslug
                    )
                ),
                'meta_query' => array(
                    array(
                        'key' => 'highlight_expiry_date',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'DATE'
                    )
                )
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post(); ?>
                    <li>
                    <a href="<?php echo esc_url(get_field('highlight_post_link')); ?>" target="_blank">
    <?php the_field('highlight_title'); ?>
</a>

                    </li>
                <?php endwhile;
            else : ?>
                <li></li>
            <?php endif;
            wp_reset_postdata();
            ?>
        </ul>
    </div>
</div>

<div class="acme-news-ticker-controls acme-news-ticker-horizontal-controls">
    <span class="acme-news-ticker-pause"></span>
</div>
        </section>
    </div>
</div>
        
        <!--<div class="secondary__header-arrow" style="margin-left: 0px; padding:0px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;">
                <defs>
                    <style>.cls-1-arrow{fill:none;stroke:white;stroke-miterlimit:10;}</style>
                </defs>
                <g id="Calque_1-2" data-name="Calque 1">
                    <path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path>
                    <line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line>
                    <polyline class="cls-1-arrow" style="stroke: white;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline>
                </g>
            </svg>
        </div>
        
        <div style="color: white; font-size: 18px; width: calc(90% - 40px); overflow: hidden; white-space: nowrap;">
          <span class="scrolling-text">JET 2022 result published, please follow the link to know your rank</span>
        </div>-->
        
    <!--</div>--> <!-- Closing the .container div -->


<h1 class="sr-only">Satyajit Ray Film & Television Institute </h1> 
<section class="section-news" style="background-color: #0b6b39;" id="section-1">
    <h2 class="section-intro-header-text" style="padding-top: 48px; padding-left: 0; color:#f3f3f3;">
        <?php echo __('Featured News', 'srft-theme' ); ?>
    </h2>
    <div class="frame">
        <div class="static owl-carousel">
            <?php
            $post_id = get_the_ID();
            $post_content = apply_filters('the_content', $post->post_content);

            if ($current_language === 'en_US') {
                $catslug='news-en'; 
            } else {
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
                        <a href="<?php the_permalink(); ?>" target="_blank">
                            <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo esc_url(get_field('News-Image')); ?>" alt="<?php echo esc_attr(get_field('News-Image-Alternativetext')); ?>" style="display: block;">
                            <div class="news-item-title">
                                <p><?php the_title(); ?></p>
                                <p><?php echo $post_content; ?></p>
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
        <div class="link-div" style="align-items: center; margin-top: 10px;">
            <a class="link-text-big" href="<?php if ($current_language === 'en_US'){ echo esc_url(site_url('/news-list/')); } else 
{ echo esc_url(site_url('/समाचार-सूची/'));}
?>"  aria-label="Read more here">
                <span class="lbl"><?php echo __('Read More Here', 'srft-theme' ); ?></span>
                <span class="primary__header-arrow"> 
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3;">
                        <defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs>
                        <g id="Calque_1-3" data-name="Calque 1">
                            <path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path>
                            <line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line>
                            <polyline class="cls-1-arrow" style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline>
                        </g>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>

 
<section class="section-home;" style="padding: 0;">
  <div  style="display:flex; flex-wrap: wrap; background-color:#5e5e5e;">
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
          <a class="link-text-big" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/about-the-institute/')); }
else 
{ echo esc_url(site_url('/संस्थान-के-बारे-में/'));}
?>"  aria-label="Read more about our Institute"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-4" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
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
          <a href="http://www.cilect.org/" target="_blank" >
            <img src="<?php bloginfo('template_url'); ?>/images/cilect.png"  alt="CILECT" >
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
      <h2 class="section-intro-header-text">
        <?php echo __('Study options', 'srft-theme'); ?>
      </h2>
    </div>
    <div class="course-text">
      <div class="course-highlight">
        <a class="button-link-course" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/mfa-in-cinema/')); }
else 
{ echo esc_url(site_url('/सनम-म-सनतकततर-करयकरम/'));}
?>" >
          <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;">
              <defs>
                <style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style>
              </defs>
              <g id="Calque_1-5" data-name="Calque 1">
                <line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line>
                <polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline>
              </g>
            </svg>
          </div>
          <?php echo __('Master of Fine Arts in Cinema', 'srft-theme'); ?> &nbsp;
        </a>
      </div>

      <div class="course-highlight">
        <a class="button-link-course" href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/mfa-in-edm/')); }
else 
{ echo esc_url(site_url('/ईडीएम-में-स्नातकोत्तर-का/'));}
?>" >
          <div class="primary__header-arrow" style="display: inline-block; margin-right: 20px;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;">
              <defs>
                <style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style>
              </defs>
              <g id="Calque_1-6" data-name="Calque 1">
                <line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line>
                <polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline>
              </g>
            </svg>
          </div>
          <?php echo __('Master of Fine Arts in EDM', 'srft-theme'); ?> &nbsp;
        </a>
      </div>
    </div>
  </div>
</section>



<section class="section-home" style="background-color: #f0e9e9;">
  <div style="margin-top: 3.2rem">
    <h2 class="section-intro-header-text" style="padding-left: 0;">
      <?php echo __('Notable Alumni', 'srft-theme'); ?>
    </h2>
    <div class="alumni">
      <div class="nonstatic owl-carousel">
        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Amal-Neerad.jpg" alt="Picture of Amal Neerad" />
          </a>
          <h5><?php echo __('Amal Neerad', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Kanu-Behl.jpg" alt="Picture of Kanu Behl" />
          </a>
          <h5><?php echo __('Kanu Behl', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/namrata=rao.webp" alt="Picture of Namrata Rao" />
          </a>
          <h5><?php echo __('Namrata Rao', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/paban-kumar.webp" alt="Picture of Hawam Paban Kumar" />
          </a>
          <h5><?php echo __('Haobam Paban Kumar', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/pritha-chakraborty.png" alt="Picture of Pritha Chakraborty" />
          </a>
          <h5><?php echo __('Pritha Chakraborty', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Modhura-Palit.png" alt="Picture of Madhura Palit" />
          </a>
          <h5><?php echo __('Madhura Palit', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/avijit-sen.png" alt="Picture of Avijit Sen" />
          </a>
          <h5><?php echo __('Abhijit Sen', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/sagar-ballari.png" alt="Picture of Sagar Ballary" />
          </a>
          <h5><?php echo __('Sagar Ballary', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Pritam-Das.png" alt="Picture of Pritam Das" />
          </a>
          <h5><?php echo __('Pritam Das', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Saurav-Rai.png" alt="Picture of Sourav Rai" />
          </a>
          <h5><?php echo __('Sourav Rai', 'srft-theme'); ?></h5>
        </div>

        <div class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Dominic-Sangma.png" alt="Picture of Dominic Sangma" />
          </a>
          <h5><?php echo __('Dominic Sangma', 'srft-theme'); ?></h5>
        </div>
      </div>
    </div>
  </div>
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
      <a href="<?php the_permalink(); ?>" target="_blank" >
        <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('film_still');?>" alt="<?php echo get_field('film_still_alt_text'); ?>"  style="display: block;">
      <div class="news-item-title">
        <h3><?php echo get_field('Film-Name');?></h3>
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

  <section class="section-home" style="background-color: #f0e9e9;">
    <div class="section-intro-header">
        <h2 class="section-intro-header-text" style="padding-left: 0;">
            <?php echo __('Media Gallery', 'srft-theme'); ?>
        </h2>
    </div>
    
    <div class="container" style="display: flex; padding: 24px; max-width: 1450px;">
        
        <div class="img_card">
        <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/photo-gallery/?tab=1')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=1'));}
?>">
                <img alt="Events & Festivals" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/convocation.jpg">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Events & Festivals', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/photo-gallery/?tab=2')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=2'));}
?>">
                <img alt="Master Classes & Workshops" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/workshop001.png">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Master Classes & Workshops', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/photo-gallery/?tab=3')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=3'));}
?>">
                <img alt="Still from Students' Films" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/studentsfilmstill.jpg">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Beyond the Frame', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/photo-gallery/?tab=4')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=4'));}
?>">
                <img alt="Campus Moments" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Gothar-Retro.JPG">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('Campus Moments', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

        <div class="img_card">
        <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/photo-gallery/?tab=5')); }
else 
{ echo esc_url(site_url('/फोटो-गैलरी/?tab=5'));}
?>">
                <img alt="SRFTI in News" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Alumni_News_KanuBehl.jpg">
                <div class="img_caption">
                    <p class="img-caption-text"><?php echo __('SRFTI in News', 'srft-theme'); ?></p>
                </div>
            </a>
        </div>

    </div>
</section>



<section class="section-home" style="background-color: #f5f5f5; ">
<div class="section-intro-header">
    <h2 class="section-intro-header-text" style="padding-left: 0;">
    <?php echo __('Updates', 'srft-theme' ); ?></h2>
  </div>  
<div class="updates-container">
  
<div class="box-container" style="display:flex;">
    <?php 
    $sections = [
        'announcement' => __('Circular & Notices', 'srft-theme'),
        'tender' => __('Tender', 'srft-theme'),
        'vacancy' => __('Vacancy', 'srft-theme')
    ];

    foreach ($sections as $post_type => $title) :
        $catslug = ($current_language === 'en_US') ? $post_type : $post_type . '-hi';
        $category_posts = new WP_Query([
          'post_type'      => $post_type,
          'posts_per_page' => 5,
      ]);
    ?>
    <div class="cell">
        <h3 class="update-title"><?php echo $title; ?></h3>
        <?php if ($category_posts->have_posts()) :
            while ($category_posts->have_posts()) : $category_posts->the_post();
                $doc_field = ucfirst($post_type) . '-Doc';
                $doc = get_field($doc_field);
                $link = $doc && isset($doc['url']) ? esc_url($doc['url']) : get_permalink();
                $file_size_mb = 'N/A';

                if ($doc && isset($doc['url'])) {
                     $file_path = urldecode(str_replace(site_url('/'), ABSPATH, $doc['url']));
                    if (file_exists($file_path)) {
                        $file_size = filesize($file_path);
                        $file_size_mb = round($file_size / (1024 * 1024), 2);
                    }
                }
                $date_field = ucfirst($post_type) . '-Publish-Date';
                $post_date = get_field($date_field);
                $formatted_date = !empty($post_date) ? DateTime::createFromFormat('d/m/Y', $post_date) : null;
        ?>
        <h3 style="margin-bottom: 6px;"><i class="fa-regular fa-calendar"></i>
        <?php echo $formatted_date ? esc_html($formatted_date->format('d M, Y')) : __('No date available', 'srft-theme'); ?></h3>
        <p><a href="<?php echo $link; ?>">
            <?php the_title(); ?>&nbsp;
            <?php if ($doc): ?>
                (<?php echo __('Download', 'srft-theme'); ?> - <?php echo $file_size_mb; ?> MB)
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="pdf" style="vertical-align: middle;" />
            <?php endif; ?>
        </a> </p><br/>
        <?php endwhile; wp_reset_postdata(); else : ?>
            <p><?php echo __('No posts found in this category.', 'srft-theme'); ?></p>
        <?php endif; ?>
        <div class="link-span">
           <?php
// Language-aware slug mapping
$slug_map = [
    'en_US' => [
        'announcement' => 'announcement',
        'tender'       => 'tender',
        'vacancy'      => 'vacancy',
    ],
    'hi_IN' => [
        'announcement' => 'घोषणा-सूची',
        'tender'       => 'निविदा',
        'vacancy'      => 'रिक्ति',
    ]
];

$slug = $slug_map[$current_language][$post_type] ?? $post_type;
$final_url = site_url("/$slug/");
?>
<a href="<?php echo esc_url($final_url); ?>" aria-label="Read more about latest <?php echo strtolower($title); ?>">
    <?php echo __('More', 'srft-theme'); ?>
</a>

        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>
</section>
<?php
get_footer(); 
?>
  <!--</div>
  </div>
  </main>

-->
