<?php
/*
Template Name: Test

 */

 get_header();
 $excerpt = get_the_excerpt();  
 $current_language = get_locale();

?>


<div id="smooth-wrapper">
    <div id="smooth-content">
        <section class="section-home" style="background-color: #161a1d; padding: 10px;">
    <section class="section-home" style="background-color: #161a1d; padding: 10px;">
    <div class="acme-news-ticker" style="display: flex; align-items: center; gap: 15px;">
        
        <!-- Label -->
        <h2 class="acme-news-ticker-label" style="flex-shrink: 0; margin: 0;">
            <?php echo __('Announcements', 'srft-theme'); ?> &nbsp;
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" 
                 style="display: inline-block; vertical-align: middle;" aria-hidden="true">
                <g fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12h22"></path>
                    <path d="M12 3l9 9-9 9"></path>
                </g>
            </svg>
        </h2>
        
        <!-- Scrolling Container -->
        <div class="acme-news-ticker-box" style="flex: 1; overflow: hidden; position: relative; height: 40px;">
    <?php
    if ($current_language === 'en_US') {
        $catslug = 'highlight-en';
    } else {
        $catslug = 'highlight-hi';
    }

    $today = date('Y-m-d');
    $args = array(
        'post_type' => 'highlight',
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
    $post_count = $query->post_count;

    // Only use <ul> if multiple items
    if ($post_count > 1) {
        echo '<ul class="news-ticker" style="display: flex; white-space: nowrap; margin: 0; padding: 0; list-style: none;">';
    } else {
        echo '<div class="news-ticker" style="display: flex; white-space: nowrap; margin: 0; padding: 0;">';
    }

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $tag = ($post_count > 1) ? 'li' : 'span';
            echo '<' . $tag . ' style="padding: 0 80px; display: inline-block;">';
            ?>
                <a href="<?php echo esc_url(get_field('highlight_post_link')); ?>" 
                   target="_blank"
                   style="color: white; text-decoration: none; line-height: 40px;">
                    <?php the_field('highlight_title'); ?>
                </a>
            <?php
            echo '</' . $tag . '>';
        endwhile;
    else :
        echo '<span style="padding: 0 80px; display: inline-block;">';
        echo '<span style="color: white; line-height: 40px;">' . __('No announcements at this time', 'srft-theme') . '</span>';
        echo '</span>';
    endif;
    wp_reset_postdata();

    // Close with matching tag
    if ($post_count > 1) {
        echo '</ul>';
    } else {
        echo '</div>';
    }
    ?>
</div>
        
        <!-- Play/Pause Button at the end -->
        <button id="ticker-toggle" 
                type="button" 
                aria-label="Pause scrolling announcements"
                style="background: transparent; border: 1px solid white; color: white; 
                       padding: 8px 15px; cursor: pointer; border-radius: 4px; flex-shrink: 0;">
            <i class="fas fa-pause" aria-hidden="true"></i>
        </button>
        
        <!-- ARIA Live Region -->
        <div id="ticker-announcement" class="sr-only" role="status" aria-live="polite" aria-atomic="true"></div>
        
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


<section class="section-news" style="background-color: #0b6b39;" id="section-1">
    <h2 class="section-intro-header-text" style="padding-left: 0; color:#f3f3f3;">
        <?php echo __('Featured News', 'srft-theme' ); ?>
    </h2>

       <div class="frame"  role="region" aria-label="Feature News" aria-roledescription="carousel" >
       <ul class="slider"  style="height: 370px;">
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
                'posts_per_page' => 10,
            ));

            if ($category_posts->have_posts()) :
                while ($category_posts->have_posts()) : $category_posts->the_post();
            ?>
                    <li role="group" aria-roledescription="slide">
                      <div class="news-item">
                       <a href="<?php the_permalink(); ?>" target="_blank">
                            <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo esc_url(get_field('News-Image')); ?>" alt="<?php echo esc_attr(get_field('News-Image-Alt'));?>" style="display: block;">
                            <div class="news-item-title">
                                <p><?php the_title(); ?></p>
                                <p><?php echo $post_content; ?></p>
                        </div>
                        </a>
            </div> 
                    </li>
            <?php
                endwhile;
                wp_reset_postdata(); // Reset the post data
            else :
                echo '<p>No posts found in this category.</p>';
            endif;
            ?>  
        </ul>
        <div class="link-div" style="align-items: center; margin-top: 10px;">
            <a class="link-text-big" href="<?php if ($current_language === 'en_US'){ echo esc_url(site_url('/news-list/')); } else 
{ echo esc_url(site_url('/समाचार-सूची/'));}
?>"  aria-label="Read more featured news">
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
      <p style="color:beige"><i><?php echo __('SRFTI is an active member of CILECT', 'srft-theme' ); ?>,<br role="presentaion">
      <?php echo __('an association that gathers the best film school in the world.', 'srft-theme' ); ?></i></p>
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
    
<div class="alumni" role="region" aria-label="<?php echo esc_attr__('Notable Alumni Carousel', 'srft-theme'); ?>"> 
   <div class="carousel-controls" aria-label="<?php echo esc_attr__('Slideshow controls', 'srft-theme'); ?>" style="text-align:left; margin-bottom:10px;">
      <button id="carouselToggle" type="button" aria-label="<?php echo esc_attr__('Pause slideshow', 'srft-theme'); ?>">
        ⏸
      </button>
    </div>   
   
   <!-- Add aria-label with total count -->
   <ul class="alumni-carousel owl-carousel" role="list" aria-label="<?php echo esc_attr__('Notable Alumni, 11 items', 'srft-theme'); ?>">
        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Amal-Neerad.jpg" alt="<?php echo esc_attr__('Picture of Amal Neerad', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Amal Neerad', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Kanu-Behl.jpg" alt="<?php echo esc_attr__('Picture of Kanu Behl', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Kanu Behl', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/namrata=rao.webp" alt="<?php echo esc_attr__('Picture of Namrata Rao', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Namrata Rao', 'srft-theme'); ?></p>
        </li>

       <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/paban-kumar.webp" alt="<?php echo esc_attr__('Picture of Hawam Paban Kumar', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Haobam Paban Kumar', 'srft-theme'); ?></p>
      </li>
      
      <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/pritha-chakraborty.png" alt="<?php echo esc_attr__('Picture of Pritha Chakraborty', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Pritha Chakraborty', 'srft-theme'); ?></p>
      </li>
       <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Modhura-Palit.png" alt="<?php echo esc_attr__('Picture of Madhura Palit', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Madhura Palit', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/avijit-sen.png" alt="<?php echo esc_attr__('Picture of Avijit Sen', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Abhijit Sen', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/sagar-ballari.png" alt="<?php echo esc_attr__('Picture of Sagar Ballary', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Sagar Ballary', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Pritam-Das.png" alt="<?php echo esc_attr__('Picture of Pritam Das', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Pritam Das', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Saurav-Rai.png" alt="<?php echo esc_attr__('Picture of Sourav Rai', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Sourav Rai', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item" role="listitem">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Dominic-Sangma.png" alt="<?php echo esc_attr__('Picture of Dominic Sangma', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Dominic Sangma', 'srft-theme'); ?></p>
        </li>
      </ul>
      
      <div id="ariaLiveRegion" class="visually-hidden" aria-live="polite" aria-atomic="true"></div>
    </div>
  </div>
</section>

  <section class="section-home" style="background-color: rgb(228, 118, 15);
  background-image: url(<?php bloginfo('template_url'); ?>/images/Workshop002.png); background-blend-mode: multiply;">
    <!--<div class="section-intro-header-text" style="color: white;">News</div>-->
    <h2 class="section-intro-header-text" style="padding-left: 0; color: white "><?php echo __('Award Winning Student Films', 'srft-theme' ); ?></h2>
    <!--<p id="carousel-instructions" class="sr-only">
    This is a carousel. Use the next and previous controls to navigate between award items.
  </p>-->
    <div class="frame" aria-label="Award Winnng Student Films" aria-roledescription="carousel">
      <ul class="slider"  style="height: 370px;">
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
        <li  role="group" aria-roledescription="slide">
          <div class="news-item">
          <a href="<?php the_permalink(); ?>" target="_blank" >
          <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('film_still');?>" alt=""  style="display: block;">
          <div class="news-item-title">
          <h3><?php echo get_field('Film-Name');?></h3>
          <p><?php echo get_field('award_received');?></p>
        <!--<i class="fa-solid fa-play fa-xl" style="color: #161718;"></i>-->
        <!--<div class="primary__header-arrow">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.85 24.85" style="transform: translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow-external{fill:none;stroke:#000;stroke-miterlimit:10;}</style></defs><g id="Calque_1-2" data-name="Calque 1"><line class="cls-1-arrow-external" x1="0.35" y1="24.5" x2="24.35" y2="0.5"></line><polyline class="cls-1-arrow-external" points="24.35 24.4 24.35 0.5 0.46 0.5"></polyline></g></svg></div>-->
          </div>
          </a>
          </div>
        </li>  
      <?php
        endwhile;
        wp_reset_postdata(); // Reset the post data
    else :
        echo '<p>No posts found in this category.</p>';
    endif;
    ?>    
  </ul>
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
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/convocation.jpg">
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
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/workshop001.png">
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
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/studentsfilmstill.jpg">
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
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Gothar-Retro.JPG">
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
                <img alt="" width="302" height="416" class="img-responsive" src="<?php bloginfo('template_url'); ?>/images/Alumni_News_KanuBehl.jpg">
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
        'event' => __('Event', 'srft-theme'),
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

        // ----- DOC FIELD (old + new support) -----
        $doc_field_old = ucfirst($post_type) . '-Doc';
        $doc_field_new = strtolower($post_type) . '-doc';
        $doc = get_field($doc_field_old) ?: get_field($doc_field_new);

        $link = $doc && isset($doc['url']) ? esc_url($doc['url']) : get_permalink();
        $file_size_mb = 'N/A';

        if ($doc && isset($doc['url'])) {
            $file_path = urldecode(str_replace(site_url('/'), ABSPATH, $doc['url']));
            if (file_exists($file_path)) {
                $file_size = filesize($file_path);
                $file_size_mb = round($file_size / (1024 * 1024), 2);
            }
        }

        // ----- DATE FIELD (old + new support) -----
        $date_field_old = ucfirst($post_type) . '-Publish-Date';
        $date_field_new = strtolower($post_type) . '-publish-date';
        $post_date = get_field($date_field_old) ?: get_field($date_field_new);

        $formatted_date = !empty($post_date) ? DateTime::createFromFormat('d/m/Y', $post_date) : null;
?>
    <h4 style="margin-bottom: 6px;"><i class="fa-regular fa-calendar"></i>
        <?php echo $formatted_date ? esc_html($formatted_date->format('d M, Y')) : __('No date available', 'srft-theme'); ?>
    </h4>

    <p><a href="<?php echo $link; ?>">
        <?php the_title(); ?>&nbsp;
        <?php if ($doc): ?>
            (<?php echo __('Download', 'srft-theme'); ?> - <?php echo $file_size_mb; ?> MB)
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/pdf_icon_resized.png" alt="" style="vertical-align: middle;" />
        <?php endif; ?>
    </a>
  <?php if ($post_type === 'tender') : ?>
   <?php $is_tender = ($post_type === 'tender');
$tender_language = get_field('language'); // ACF field value: Hindi / Both / English
$tender_id = get_field('Tender-ID');
$is_gem = (stripos($tender_id, 'GEM') === 0);
?>
<?php if ($is_gem): ?>
      <span class="doc-lang"
        aria-label="<?php echo esc_attr__('Document available in English and Hindi', 'srft-theme'); ?>">
        &nbsp; | &nbsp; (
        <abbr lang="en" title="English">EN</abbr>,
        <abbr lang="hi" title="Hindi">HI</abbr>)
      </span>
    <?php elseif ($tender_language === 'Hindi'): ?>
      <span class="doc-lang"
        aria-label="<?php echo esc_attr__('Document available in Hindi', 'srft-theme'); ?>">
        &nbsp;(
        <abbr lang="hi" title="Hindi">HI</abbr>
        )
      </span>
    <?php endif; ?>
  <?php endif; ?>
     
  </p>

     <?php if ($post_type === 'event') : 
     $event_date = get_field('event_date');
     $event_time = get_field('event_time');
     $event_venue = get_field('event_venue');
       if (!empty($event_date)){
         $event_date = DateTime::createFromFormat('d/m/Y', $event_date);
       }
      ?>
        <p class="event-meta" style="margin: 4px 0;">
            <?php if ($event_date): ?>
                <?php echo __('Date', 'srft-theme'); ?>: <?php echo esc_html($event_date->format('d M, Y')); ?>
            <?php endif; ?>

            <?php if (!empty($event_time)): ?>
                &nbsp;|&nbsp;
                <span><i class="fa-regular fa-clock"></i> <?php echo esc_html($event_time); ?></span>

            <?php endif; ?>
        </p>
        <p style="margin-bottom: 6px;">
        <i class="fa-solid fa-location-dot"></i>
       <?php echo esc_html($event_venue); ?>
        </p>
    <?php endif; ?>

    <br role="presenttaion">

<?php endwhile; wp_reset_postdata(); else : ?>
    <p><?php echo __('No posts found in this category.', 'srft-theme'); ?></p>
<?php endif; ?>

        <div class="link-span">
           <?php
// Language-aware slug mapping
$slug_map = [
    'en_US' => [
        'event' => 'event',
        'announcement' => 'announcement',
        'tender'       => 'tender',
        'vacancy'      => 'vacancy',
    ],
    'hi_IN' => [
        'event' => 'कार्यक्रम',
        'announcement' => 'घोषणा-सूची',
        'tender'       => 'निविदा',
        'vacancy'      => 'रिक्ति',
    ]
];

$slug = $slug_map[$current_language][$post_type] ?? $post_type;
$final_url = site_url("/$slug/");
?>
 <?php if ($post_type != 'event') : ?>
    <a href="<?php echo esc_url($final_url); ?>" aria-label="Read more about latest <?php echo strtolower($title); ?>">
        <?php echo __('More', 'srft-theme'); ?>
    </a>
<?php endif; ?>

        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>
</section>

<section class="section-home" style="background-color: #f0e9e9; padding: 60px 0;">
    <div class="section-intro-header">
        <h2 class="section-intro-header-text" style="padding-left: 0; color: #4a90a4;">
            <?php echo __('Trending Social Media', 'srft-theme'); ?>
        </h2>
        <p style="font-size: 16px; color: #666; margin-top: 10px;">
            <?php echo __('Join Our Social Hub to stay up to date', 'srft-theme'); ?>
        </p>
    </div>

<div class="social-feed-container" style="max-width: 1450px; margin: 40px auto; padding: 0 20px;">
  <div class="box-container" style="display:flex; gap:1rem;">
  <?php
  // Language detection (your existing variable assumed)
  $category_slug = ($current_language === 'hi_IN') ? 'social-hi' : 'social-en';

  $social_query = new WP_Query([
    'post_type'      => 'social',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'category_name'  => $category_slug,
    'orderby'        => 'date',
    'order'          => 'DESC',
  ]);
 ?>

 <div class="box-container social-feeds">

 <?php if ($social_query->have_posts()) :
    while ($social_query->have_posts()) : $social_query->the_post();

        $platform   = get_field('social_platform');
        $embed_code = get_field('embed_code');
  ?>

    <article class="cell social-card social-<?php echo esc_attr($platform); ?>" aria-label="<?php echo esc_attr(ucfirst($platform)); ?> feed">

        <h3 class="update-title">
            <?php echo esc_html(ucfirst($platform)); ?>
        </h3>

        <div class="social-embed">
            <?php echo $embed_code; ?>
        </div>

    </article>

<?php
    endwhile;
    wp_reset_postdata();
else : ?>
    <p><?php _e('No social feeds available', 'srft-theme'); ?></p>
<?php endif; ?>

</div>


</div>

    </div>
</section>


<section class="section-home" style="background-color: #f0e9e9; padding: 60px 0;">
    <div class="section-intro-header">
        <h2 class="section-intro-header-text" style="padding-left: 0; color: #4a90a4;">
            <?php echo __('Trending Social Media', 'srft-theme'); ?>
        </h2>
        <p style="font-size: 16px; color: #666; margin-top: 10px;">
            <?php echo __('Join Our Social Hub to stay up to date', 'srft-theme'); ?>
        </p>
    </div>

    <div class="social-feed-container" style="max-width: 1400px; margin: 40px auto; padding: 0 20px;">
        
        <!-- Tab Navigation -->
        <div class="social-tabs" style="display: flex; gap: 20px; margin-bottom: 30px; border-bottom: 2px solid #ddd; flex-wrap: wrap;">
            <button class="social-tab active" data-tab="facebook" style="background: none; border: none; padding: 15px 25px; font-size: 18px; cursor: pointer; border-bottom: 3px solid #1877F2; color: #1877F2; font-weight: 600; transition: all 0.3s;">
                <i class="fab fa-facebook" style="margin-right: 8px;"></i><?php echo __('Facebook', 'srft-theme'); ?>
            </button>
            <button class="social-tab" data-tab="twitter" style="background: none; border: none; padding: 15px 25px; font-size: 18px; cursor: pointer; color: #666; font-weight: 600; transition: all 0.3s;">
                <i class="fab fa-x-twitter" style="margin-right: 8px;"></i><?php echo __('Twitter', 'srft-theme'); ?>
            </button>
            <button class="social-tab" data-tab="instagram" style="background: none; border: none; padding: 15px 25px; font-size: 18px; cursor: pointer; color: #666; font-weight: 600; transition: all 0.3s;">
                <i class="fab fa-instagram" style="margin-right: 8px;"></i><?php echo __('Instagram', 'srft-theme'); ?>
            </button>
            <button class="social-tab" data-tab="vimeo" style="background: none; border: none; padding: 15px 25px; font-size: 18px; cursor: pointer; color: #666; font-weight: 600; transition: all 0.3s;">
                <i class="fab fa-vimeo-v" style="margin-right: 8px;"></i><?php echo __('Vimeo', 'srft-theme'); ?>
            </button>
        </div>

        <!-- Social Feed Content -->
        <div class="social-feed-content">

            <!-- Facebook Feed -->
            <div class="social-feed-panel active" id="facebook-panel" style="display: block;">
                <iframe
  src="https://www.facebook.com/plugins/page.php?
  href=
  &tabs=timeline
  &width=500
  &height=450"
  width="100%"
  height="450"
  style="border:none;overflow:hidden"
  scrolling="yes"
  allowfullscreen="true">
</iframe>

            </div>

            <!-- Twitter Feed -->
            <div class="social-feed-panel" id="twitter-panel" style="display: none;">
                
            <a class="twitter-timeline" data-width="500" data-height="319" href="https://twitter.com/srfti_official?ref_src=twsrc%5Etfw">Tweets by srfti_official</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            
            <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 600px; margin: 0 auto;">
                    <!-- Twitter Timeline Embed -->
                    <a class="twitter-timeline" data-width="500" data-height="379" href="https://twitter.com/srfti_official?ref_src=twsrc%5Etfw">Tweets by srfti_official</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    <div style="text-align: center; margin-top: 20px;">
                        <a class="twitter-timeline" href="https://twitter.com/srfti_official?ref_src=twsrc%5Etfw">Tweets by srfti_official</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                    </div>
                </div>
            </div>

            <!-- Instagram Feed -->
            <div class="social-feed-panel" id="instagram-panel" style="display: none;">
                <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 600px; margin: 0 auto;">
                    <!-- Instagram Embed - You'll need to get the embed code from an actual Instagram post -->
                    <blockquote class="instagram-media" 
                                data-instgrm-captioned 
                                data-instgrm-permalink="https://www.instagram.com/srfti_official/?utm_source=ig_embed&amp;utm_campaign=loading" 
                                data-instgrm-version="14" 
                                style="background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
                        <div style="padding:16px;">
                            <a href="https://www.instagram.com/srfti_official/?utm_source=ig_embed&amp;utm_campaign=loading" 
                               style="background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" 
                               target="_blank">
                                <div style="display: flex; flex-direction: row; align-items: center;">
                                    <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
                                    <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
                                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
                                        <div style="background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
                                    </div>
                                </div>
                                <div style="padding: 19% 0;"></div>
                                <div style="height:50px; margin:0 auto 12px; width:50px;">
                                    <svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g transform="translate(-511.000000, -20.000000)" fill="#000000">
                                                <g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div style="padding-top: 8px;">
                                    <div style="color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">
                                        <?php echo __('View this post on Instagram', 'srft-theme'); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </blockquote>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="https://www.instagram.com/YOUR_INSTAGRAM_HANDLE/" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           style="display: inline-block; background-color: #e47620; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: 600;">
                            <?php echo __('View More', 'srft-theme'); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Vimeo Feed -->
            <div class="social-feed-panel" id="vimeo-panel" style="display: none;">
                <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); max-width: 800px; margin: 0 auto;">
                    <!-- Vimeo Embed - Replace with your latest video ID -->
                    <div style="padding:56.25% 0 0 0;position:relative;">
                        <iframe src="https://player.vimeo.com/video/YOUR_VIDEO_ID?h=YOUR_HASH&title=0&byline=0&portrait=0" 
                                style="position:absolute;top:0;left:0;width:100%;height:100%;" 
                                frameborder="0" 
                                allow="autoplay; fullscreen; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                    <script src="https://player.vimeo.com/api/player.js"></script>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="https://vimeo.com/YOUR_VIMEO_CHANNEL" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           style="display: inline-block; background-color: #e47620; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; font-weight: 600;">
                            <?php echo __('View More', 'srft-theme'); ?>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- JavaScript for Tab Switching -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.social-tab');
    const panels = document.querySelectorAll('.social-feed-panel');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            // Remove active class from all tabs
            tabs.forEach(t => {
                t.style.borderBottom = 'none';
                t.style.color = '#666';
                t.classList.remove('active');
            });
            
            // Add active class to clicked tab
            this.classList.add('active');
            this.style.color = getTabColor(targetTab);
            this.style.borderBottom = `3px solid ${getTabColor(targetTab)}`;
            
            // Hide all panels
            panels.forEach(panel => {
                panel.style.display = 'none';
            });
            
            // Show target panel
            document.getElementById(`${targetTab}-panel`).style.display = 'block';
        });
    });
    
    function getTabColor(tab) {
        const colors = {
            'facebook': '#1877F2',
            'twitter': '#000000',
            'instagram': '#E4405F',
            'vimeo': '#1AB7EA'
        };
        return colors[tab] || '#666';
    }
});
</script>

<!-- Social Media SDK Scripts -->
<!-- Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v18.0"></script>

<!-- Twitter SDK -->
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

<!-- Instagram SDK -->
<script async src="//www.instagram.com/embed.js"></script>

<style>
.social-tab:hover {
    opacity: 0.8;
}

.social-feed-panel {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@media (max-width: 768px) {
    .social-tabs {
        justify-content: center;
    }
    
    .social-tab {
        padding: 12px 15px !important;
        font-size: 14px !important;
    }
    
    .social-feed-panel > div {
        padding: 15px !important;
    }
}
</style>


</main>
<?php
get_footer(); 
?>
  <!--</div>
  </div>
  </main>

-->
