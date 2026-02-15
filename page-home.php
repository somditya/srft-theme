<?php
/*
Template Name: Home

 */

 get_header();
 $excerpt = get_the_excerpt();  
 $current_language = get_locale();

?>


<div id="smooth-wrapper">
    <div id="smooth-content">
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
$today = date('d/m/Y'); // Match ACF date format

// Determine language category slug
if ($current_language === 'en_US') {
    $lang_catslug = 'announcement-en'; // Adjust to your actual category slug
} else {
    $lang_catslug = 'announcement-hi'; // Adjust to your actual category slug
}

$args = array(
    'post_type' => 'announcement',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $lang_catslug
        )
    ),
);

$query = new WP_Query($args);
$filtered_posts = array();

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
        $highlight = get_field('highlight');
        $expiry = get_field('highlight_expiry_date');
        
        // Check if highlighted and not expired
        if ($highlight === 'Yes') {
            if (empty($expiry) || strtotime(str_replace('/', '-', $expiry)) >= strtotime($today)) {
                $filtered_posts[] = get_post();
            }
        }
    endwhile;
endif;
wp_reset_postdata();

$post_count = count($filtered_posts);

// Only use <ul> if multiple items
if ($post_count > 1) {
    echo '<ul class="news-ticker" style="display: flex; white-space: nowrap; margin: 0; padding: 0; list-style: none;">';
} else {
    echo '<div class="news-ticker" style="display: flex; white-space: nowrap; margin: 0; padding: 0;">';
}

if ($post_count > 0) :
    foreach ($filtered_posts as $post) :
        setup_postdata($post);
        $tag = ($post_count > 1) ? 'li' : 'span';
        echo '<' . $tag . ' style="padding: 0 80px; display: inline-block;">';
        ?>
            <a href="<?php echo esc_url(get_permalink($post)); ?>" 
               style="color: white; text-decoration: none; line-height: 40px;">
                <?php echo get_the_title($post); ?>
            </a>
        <?php
        echo '</' . $tag . '>';
    endforeach;
    wp_reset_postdata();
else :
    echo '<span style="padding: 0 80px; display: inline-block;">';
    echo '<span style="color: white; line-height: 40px;">' . __('No announcements at this time', 'srft-theme') . '</span>';
    echo '</span>';
endif;

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
                            <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo esc_url(get_field('News-Image')); ?>" alt="" style="display: block;">
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
      <p style="color:beige"><i><?php echo __('SRFTI is an active member of CILECT', 'srft-theme' ); ?>,<br>
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
   <div class="carousel-controls" role="group" aria-label="<?php echo esc_attr__('Slideshow controls', 'srft-theme'); ?>" style="text-align:left; margin-bottom:10px;">
      <button id="carouselToggle" type="button" aria-label="<?php echo esc_attr__('Pause slideshow', 'srft-theme'); ?>">
        ⏸
      </button>
    </div>   
   
   <!-- Add aria-label with total count -->
   <ul class="alumni-carousel owl-carousel" role="list" aria-label="<?php echo esc_attr__('Notable Alumni, 11 items', 'srft-theme'); ?>">
        <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Amal-Neerad.jpg" alt="<?php echo esc_attr__('Picture of Amal Neerad', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Amal Neerad', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Kanu-Behl.jpg" alt="<?php echo esc_attr__('Picture of Kanu Behl', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Kanu Behl', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/namrata=rao.webp" alt="<?php echo esc_attr__('Picture of Namrata Rao', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Namrata Rao', 'srft-theme'); ?></p>
        </li>

       <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/paban-kumar.webp" alt="<?php echo esc_attr__('Picture of Hawam Paban Kumar', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Haobam Paban Kumar', 'srft-theme'); ?></p>
      </li>
      
      <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/pritha-chakraborty.png" alt="<?php echo esc_attr__('Picture of Pritha Chakraborty', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Pritha Chakraborty', 'srft-theme'); ?></p>
      </li>
       <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Modhura-Palit.png" alt="<?php echo esc_attr__('Picture of Madhura Palit', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Madhura Palit', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/avijit-sen.png" alt="<?php echo esc_attr__('Picture of Avijit Sen', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Abhijit Sen', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/sagar-ballari.png" alt="<?php echo esc_attr__('Picture of Sagar Ballary', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Sagar Ballary', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Pritam-Das.png" alt="<?php echo esc_attr__('Picture of Pritam Das', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Pritam Das', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item">
          <a class="alumni-img" href="#" target="_blank">
            <img src="<?php bloginfo('template_url'); ?>/images/Saurav-Rai.png" alt="<?php echo esc_attr__('Picture of Sourav Rai', 'srft-theme'); ?>" />
          </a>
          <p><?php echo __('Sourav Rai', 'srft-theme'); ?></p>
        </li>

        <li class="alumni-item">
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
    <div class="frame" role="region" aria-label="Award Winnng Student Films" aria-roledescription="carousel">
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
<div class="updates-container" style="max-width: 1450px; margin: 40px auto; padding: 0 20px;">
  
<div class="box-container social-feeds" style="display:flex;">
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
    <div class="cell social-card">
        <h3 class="update-title"><?php echo $title; ?></h3>
         <div class="social-embed">
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
    <?php if ($post_type === 'announcement') : ?>
    <?php
    $announcement_cat = get_field('announcement_category');
    if ($announcement_cat) : ?>
        <span class="announcement-category">
            <?php echo esc_html($announcement_cat); ?>
        </span>
    <?php endif; ?>
<?php endif; ?>
  <?php if ($post_type === 'tender') : 
      $all_fields = get_fields();
    echo '<!-- All ACF fields: ';
    print_r(array_keys($all_fields));
    echo ' -->';?>
   <?php $is_tender = ($post_type === 'tender');
$tender_language = get_field('language'); // ACF field value: Hindi / Both / English
$tender_id = get_field('Tender-ID');
$is_gem = (stripos($tender_id, 'GEM') === 0);
?>
<?php if ($is_gem): ?>
      <span class="doc-lang">
        &nbsp; | &nbsp; (
        <abbr lang="en" title="English">EN</abbr>,
        <abbr lang="hi" title="Hindi">HI</abbr>)
        <span class="sr-only">
        <?php echo esc_attr__('Document available in English and Hindi', 'srft-theme'); ?>
       </span>
      </span>
    <?php elseif ($tender_language === 'Hindi'): ?>
      <span class="doc-lang">
        &nbsp;(
        <abbr lang="hi" title="Hindi">HI</abbr>
        )
        <span class="sr-only">
        <?php echo esc_attr__('Document available in Hindi', 'srft-theme'); ?>
       </span>
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

    <br>

<?php endwhile; wp_reset_postdata(); else : ?>
    <p><?php echo __('No posts found in this category.', 'srft-theme'); ?></p>
<?php endif; ?>
</div>
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
        <?php echo __('View More', 'srft-theme'); ?>
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
        <h2 class="section-intro-header-text" style="padding-left: 0;">
            <?php echo __('Trending Social Media', 'srft-theme'); ?>
        </h2>
        <p style="font-size: 16px; color: #666; margin-top: 10px;">
            <?php echo __('Join Our Social Hub to stay up to date', 'srft-theme'); ?>
        </p>
    </div>

    <div class="social-feed-container" style="max-width: 1450px; margin: 40px auto; padding: 0 20px;">
        <div class="box-container" style="display:flex; gap:1rem;">
            <?php
            // Language detection
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
                        $social_handle = get_field('social_handle'); // ACF field for social media URL
                        
                        // Normalize platform to lowercase for comparison
                        $platform_lower = strtolower($platform);
                        
                        // Default social media URLs if no custom handle provided
                        $platform_urls = [
                            'linkedin' => 'https://www.linkedin.com/school/satyajit-ray-film-and-television-institute-srfti/',
                            'facebook' => 'https://www.facebook.com/srftikol',
                            'youtube' => 'https://www.youtube.com/@your-channel',
                            'twitter' => 'https://x.com/srfti_official',
                            'instagram' => 'https://www.instagram.com/srfti_official/',
                            'vimeo' => 'https://vimeo.com/your-account'
                        ];
                        
                        // Use custom handle if provided, otherwise use default
                        $social_url = !empty($social_handle) ? $social_handle : ($platform_urls[$platform_lower] ?? '#');
                ?>

                    <article class="cell social-card social-<?php echo esc_attr($platform_lower); ?>" aria-label="<?php echo esc_attr(ucfirst($platform_lower)); ?> feed">

                        <h3 class="update-title" style="display: flex; align-items: center; gap: 10px;">
                            
                            <?php if ($platform_lower === 'linkedin'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 22" width="24" height="24" fill="#007AB9" style="flex-shrink: 0;">
                                    <path d="M20.9302 12.2503V19.99H16.443V12.7689C16.443 10.9553 15.7939 9.71725 14.171 9.71725C13.6626 9.72116 13.1679 9.88297 12.7555 10.1803C12.343 10.4776 12.0332 10.8958 11.8688 11.3769C11.7533 11.7285 11.7023 12.0981 11.7183 12.4678V19.99H7.23105C7.23105 19.99 7.29128 7.75975 7.23105 6.4949H11.7183V8.40555C11.7183 8.42229 11.6982 8.43567 11.6915 8.4524H11.7183V8.40555C12.1253 7.7005 12.7173 7.12018 13.4304 6.72738C14.1434 6.33457 14.9503 6.14426 15.7638 6.17701C18.7151 6.17701 20.9302 8.10775 20.9302 12.2503ZM2.53974 0C1.00385 0 0 1.00385 0 2.34231C0 3.68078 0.973733 4.68462 2.4795 4.68462H2.50962C4.07228 4.68462 5.04601 3.64731 5.04601 2.34231C5.04601 1.03731 4.07228 0 2.53974 0ZM0.264347 20H4.75155V6.4949H0.264347V20Z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'facebook'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#1877F2" style="flex-shrink: 0;">
                                    <path d="M10,0C4.5,0,0,4.5,0,10c0,5,3.7,9.1,8.4,9.9v-7H5.9v-2.9h2.5V7.8c0-2.5,1.5-3.9,3.8-3.9c1.1,0,2.2,0.2,2.2,0.2v2.5h-1.3 c-1.2,0-1.6,0.8-1.6,1.6v1.9h2.8L13.9,13h-2.3v7C16.3,19.1,20,15,20,10C20,4.5,15.5,0,10,0z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'youtube'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#FF0000" style="flex-shrink: 0;">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'twitter'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#000000" style="flex-shrink: 0;">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'instagram'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#E4405F" style="flex-shrink: 0;">
                                    <path d="M10 0C7.284 0 6.944.012 5.877.06 2.246.227.498 1.986.332 5.617.285 6.684.273 7.024.273 9.74c0 2.715.012 3.056.06 4.123.165 3.628 1.924 5.386 5.555 5.554 1.066.047 1.405.059 4.122.059 2.716 0 3.056-.012 4.122-.06 3.626-.167 5.39-1.925 5.555-5.555.047-1.066.06-1.406.06-4.122 0-2.717-.013-3.056-.06-4.123C19.521 1.987 17.762.228 14.133.06 13.067.013 12.727 0 10.01 0h-.01zm-.898 1.802h.898c2.671 0 2.987.01 4.041.058 2.71.123 3.793 1.224 3.916 3.916.048 1.054.058 1.37.058 4.041 0 2.672-.01 2.988-.058 4.042-.123 2.69-1.205 3.793-3.916 3.916-1.054.048-1.37.058-4.041.058-2.67 0-2.987-.01-4.04-.058-2.713-.123-3.794-1.227-3.917-3.916-.047-1.054-.057-1.37-.057-4.041 0-2.67.01-2.987.057-4.041.124-2.692 1.207-3.794 3.917-3.917 1.054-.047 1.37-.057 4.041-.057l.001-.001zm7.757 1.658a1.2 1.2 0 1 0 0 2.4 1.2 1.2 0 0 0 0-2.4zM10 4.865a5.135 5.135 0 1 0 0 10.27 5.135 5.135 0 0 0 0-10.27zm0 1.802a3.333 3.333 0 1 1 0 6.666 3.333 3.333 0 0 1 0-6.666z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'vimeo'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#1AB7EA" style="flex-shrink: 0;">
                                    <path d="M19.98 5.347c-.105 2.338-1.739 5.543-4.894 9.609-3.268 4.247-6.026 6.37-8.29 6.37-1.409 0-2.578-1.294-3.553-3.881L1.325 10.33C.603 7.747-.166 6.453-.99 6.453c-.179 0-.806.378-1.881 1.132L-4 6.128a315.065 315.065 0 0 0 3.501-3.128C1.08 1.632 2.266.915 3.055.84c1.867-.18 3.016 1.1 3.447 3.838.465 2.953.789 4.789.971 5.507.539 2.45 1.131 3.674 1.776 3.674.502 0 1.256-.796 2.265-2.385 1.004-1.589 1.54-2.797 1.612-3.628.144-1.371-.395-2.061-1.614-2.061-.574 0-1.167.121-1.777.391 1.186-3.868 3.434-5.757 6.762-5.637 2.473.06 3.628 1.664 3.493 4.797l-.013.01z"/>
                                </svg>
                                
                            <?php endif; ?>
                            
                            <span style="line-height: 1;"><?php echo esc_html(ucfirst($platform_lower)); ?></span>
                        </h3>

                        <div class="social-embed">
                            <?php echo $embed_code; ?>
                        </div>

                     <div class="link-span">
                        <a href="<?php echo esc_url($social_url); ?>" aria-label="Read more about latest <?php echo strtolower($title); ?>">
                            <?php echo __(' View More', 'srft-theme'); ?>
                       </a>
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

</main>
<?php
get_footer(); 
?>
  <!--</div>
  </div>
  </main>

-->
