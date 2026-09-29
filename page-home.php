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
    <h2 class="acme-news-ticker-label">
     <span class="announcement-text"> <?php echo __('Announcements', 'srft-theme'); ?>

    <svg xmlns="http://www.w3.org/2000/svg"
         width="32"
         height="32"
         viewBox="0 -960 960 960"
         aria-hidden="true"
         focusable="false">
        <path d="M850-450h-90q-12.75 0-21.37-8.68-8.63-8.67-8.63-21.5 0-12.82 8.63-21.32 8.62-8.5 21.37-8.5h90q12.75 0 21.38 8.68 8.62 8.67 8.62 21.5 0 12.82-8.62 21.32-8.63 8.5-21.38 8.5ZM677-274q8-10 19.83-12 11.82-2 22.17 6l73 54q10 8 12 19.83 2 11.82-6 22.17-8 10-19.83 12-11.82 2-22.17-6l-73-54q-10-8-12-19.83 2-11.82 6-22.17Zm115-460-70 53q-10.35 8-22.17 6Q688-677 680-687q-8-10-6-22t12-20l70-53q10.35-8 22.17-6Q790-786 798-776q8 10 6 22t-12 20ZM210-360h-70q-24.75 0-42.37-17.63Q80-395.25 80-420v-120q0-24.75 17.63-42.38Q115.25-600 140-600h180l155-93q15-9 30-.06 15 8.93 15 26.06v374q0 17.13-15 26.06-15 8.94-30-.06l-155-93h-50v130q0 12.75-8.68 21.37-8.67 8.63-21.5 8.63-12.82 0-21.32-8.63-8.5-8.62-8.5-21.37v-130Zm250 14v-268l-124 74H140v120h196l124 74Zm100 0v-268q27 24 43.5 58.5T620-480q0 41-16.5 75.5T560-346ZM300-480Z"
              fill="#ffffff"/>
    </svg>
</h2>
        
        <!-- Scrolling Container -->
        <div class="acme-news-ticker-box" style="flex: 1; overflow: hidden; position: relative; height: 40px;">
    <?php
$locale = get_locale();
$current_language = function_exists('pll_current_language') ? pll_current_language('slug') : 'en';

$today = date('Ymd');

$args = array(
    'post_type'      => array('announcement', 'vacancy'),
    'posts_per_page' => -1,
    'meta_query'     => array(
        array(
            'key'     => 'highlight',
            'value'   => 'Yes',
            'compare' => '='
        ),
        array(
            'relation' => 'OR',
            array(
                'key'     => 'highlight_expiry_date',
                'compare' => 'NOT EXISTS'
            ),
            array(
                'key'     => 'highlight_expiry_date',
                'value'   => $today,
                'compare' => '>=',
                'type'    => 'DATE'
            )
        )
    ),
    'orderby' => 'date',
    'order'   => 'DESC'
);

$query = new WP_Query($args);
$filtered_posts = array();

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();

        $highlight = get_field('highlight');
        $expiry    = get_field('highlight_expiry_date');

        if ($highlight == 'Yes') {
            if (empty($expiry) || $expiry >= $today) {
                $filtered_posts[] = get_post();
            }
        }

    endwhile;
endif;

wp_reset_postdata();

$post_count = count($filtered_posts);

// Wrapper
if ($post_count > 1) {
    echo '<ul class="news-ticker" style="display:flex; white-space:nowrap; margin:0; padding:0; list-style:none;">';
} else {
    echo '<div class="news-ticker" style="display:flex; white-space:nowrap; margin:0; padding:0;">';
}

if ($post_count > 0) :

    foreach ($filtered_posts as $post) :

        setup_postdata($post);

        $tag = ($post_count > 1) ? 'li' : 'span';

        echo '<' . $tag . ' style="padding:0 80px; display:inline-block;">';

        $post_type = get_post_type();

        $link   = get_permalink();
        $target = '_self';

        /**
         * Vacancy
         */
        if ($post_type === 'vacancy') {

            $doc = get_field('Vacancy-Doc', get_the_ID());

            if (!empty($doc) && !empty($doc['url'])) {
                $link   = esc_url($doc['url']);
                $target = '_blank';
            }

        }

        /**
         * Announcement
         */
        elseif ($post_type === 'announcement') {

            $doc   = get_field('Announcement-Doc', get_the_ID());
            $image = get_field('Announcement-Image', get_the_ID());
            $text  = get_field('Announcement-Text', get_the_ID());

            // Remove HTML to check whether text is actually empty
            $plain_text = trim(wp_strip_all_tags($text));

            // Open PDF only if:
            // 1. Document exists
            // 2. No image
            // 3. No text
            if (
                !empty($doc) &&
                !empty($doc['url']) &&
                empty($image) &&
                empty($plain_text)
            ) {
                $link   = esc_url($doc['url']);
                $target = '_blank';
            }

        }
        ?>

        <a href="<?php echo esc_url($link); ?>"
           target="<?php echo esc_attr($target); ?>"
           style="color:white; text-decoration:none; line-height:40px;">

            <?php the_title(); ?>

        </a>

        <?php

        echo '</' . $tag . '>';

    endforeach;

    wp_reset_postdata();

else :

    echo '<span style="padding:0 80px; display:inline-block;">';
    echo '<span style="color:white; line-height:40px;">';
    echo __('No announcements at this time', 'srft-theme');
    echo '</span>';
    echo '</span>';

endif;

// Close wrapper
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
        

<section class="section-news" style="background-color: #ffffff;" id="section-1">
    <h2 class="section-intro-header-text" style="padding-left: 0;">
        <?php echo __('Featured News', 'srft-theme' ); ?>
    </h2>

       <div class="frame"  role="region" aria-label="Feature News" aria-roledescription="carousel" >
       <ul class="slider" >
            <?php
if (pll_current_language() === 'en') {
    $catslug = 'news-en';
} else {
    $catslug = 'news-hi';
}
wp_reset_postdata();
$category_posts = new WP_Query(array(
    'post_type' => 'news',
    'posts_per_page' => 10,
    'tax_query' => array(
        array(
            'taxonomy' => 'category',
            'field' => 'slug',
            'terms' => $catslug,
        ),
    ),
));

if ($category_posts->have_posts()) :
    while ($category_posts->have_posts()) : $category_posts->the_post();
?>

<li role="group" aria-roledescription="slide">
    <div class="news-item">
            <img class="img-responsive lazyOwl"
                 src="<?php echo esc_url(get_field('News-Image')); ?>"
                 alt="<?php the_title_attribute(); ?>"
                 style="display:block;">

            <div class="news-item-title">

                <p><?php the_title(); ?></p>

            </div>
            <div class="view-more-button"><a href="<?php the_permalink(); ?>" target="_blank" class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" aria-label="View more recent news">View Details<span aria-hidden="true" class="material-symbols-outlined ">chevron_right</span></a>
           </div>
    </div>
</li>

<?php
    endwhile;
    wp_reset_postdata();
else :
    echo '<p>No posts found in this category.</p>';
endif;
?>  
        </ul>
        <!--<div class="link-div" style="align-items: center; margin-top: 10px;">
            <a class="link-text-big" href="<?php if ($current_language === 'en'){ echo esc_url(site_url('/news-list/')); } else 
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
        </div>-->
</section>
 
<section class="section-home;" style="padding: 0;">
  <div style="display:flex; flex-wrap: wrap; background-color:var(--sub-intro-background-color);" class="frame1"  >
    <div class="abtimg-box">
    </div>
    <div class="text-box">
      <h2 class="section-intro-header-text" style="padding-left: 0; color:#161a1d; " >
      <?php echo __('The Institute', 'srft-theme' ); ?>
      </h2>
      <p style="padding-top: 20px; padding-right: 20px; line-height: 1.5;" ><?php echo $excerpt ; ?>

      </p>
      <!--<div class="link-div">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
        <div class="link-div" style="align-items: center; margin-top: 0;">
          <a class="link-text-big" href="<?php if ($current_language === 'en') { echo esc_url(site_url('/about-the-institute/')); }
else 
{ echo esc_url(site_url('/संस्थान-के-बारे-में/'));}
?>"  aria-label="Read more about our Institute"><span> <?php echo __('Read More Here', 'srft-theme' ); ?></span><span class="primary__header-arrow"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.7 24.69" style="color:#f3f3f3; translate(0px, 0px); opacity: 1;"><defs><style>.cls-1-arrow{fill:none;stroke:#161a1d;stroke-miterlimit:10;}</style></defs><g id="Calque_1-4" data-name="Calque 1"><path class="cls-1-arrow" d="M24,12.34H0m12-12,12,12-12,12"></path><line class="cls-1-arrow" x1="23.99" y1="12.34" y2="12.34"></line><polyline class="cls-1-arrow"  style="stroke: #f5f5f5;" points="11.99 0.35 23.99 12.34 11.99 24.33"></polyline></g></svg>
          </span>
        </a>
          
        </div>-->
                <div class="view-more-button"><a href="<?php the_permalink(); ?>" target="_blank" class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" aria-label="View more recent news" href="/documents">View Details<span aria-hidden="true" class="material-symbols-outlined ">chevron_right</span></a></div>

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
        <a class="button-link-course" href="<?php if ($current_language === 'en') { echo esc_url(site_url('/mfa-in-cinema/')); }
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
        <a class="button-link-course" href="<?php if ($current_language === 'en') { echo esc_url(site_url('/mfa-in-edm/')); }
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


<section class="section-home notable-alumni-section" style="background-color: #f0e9e9;">
    <div style="margin-top: 3.2rem">

        <h2 class="section-intro-header-text" style="padding-left: 0;">
            <?php echo esc_html__('Notable Alumni', 'srft-theme'); ?>
        </h2>

        <div
            class="alumni-carousel-wrapper"
            role="region"
            aria-label="<?php echo esc_attr__('Notable Alumni Carousel', 'srft-theme'); ?>"
        >

            <!-- Carousel controls -->
            <div class="alumni-carousel-controls">

                <button
                    type="button"
                    id="alumniPrev"
                    class="alumni-carousel-button"
                    aria-label="<?php echo esc_attr__('Previous alumni', 'srft-theme'); ?>"
                >
                    <span aria-hidden="true">&#10094;</span>
                </button>

                <button
                    type="button"
                    id="alumniToggle"
                    class="alumni-carousel-button alumni-play-button"
                    aria-label="<?php echo esc_attr__('Pause slideshow', 'srft-theme'); ?>"
                    aria-pressed="false"
                >
                    <span aria-hidden="true">&#10074;&#10074;</span>
                </button>

                <button
                    type="button"
                    id="alumniNext"
                    class="alumni-carousel-button"
                    aria-label="<?php echo esc_attr__('Next alumni', 'srft-theme'); ?>"
                >
                    <span aria-hidden="true">&#10095;</span>
                </button>

            </div>


            <!-- Carousel viewport -->
            <div class="alumni-carousel-viewport">

                <ul
                    id="alumniCarousel"
                    class="alumni-carousel-list"
                    aria-label="<?php echo esc_attr__('Notable Alumni, 11 items', 'srft-theme'); ?>"
                >

                    <!-- Amal Neerad -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Amal Neerad', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Amal-Neerad.jpg'); ?>"
                                alt="<?php echo esc_attr__('Picture of Amal Neerad', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Amal Neerad', 'srft-theme'); ?></p>
                    </li>


                    <!-- Kanu Behl -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Kanu Behl', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Kanu-Behl.jpg'); ?>"
                                alt="<?php echo esc_attr__('Picture of Kanu Behl', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Kanu Behl', 'srft-theme'); ?></p>
                    </li>


                    <!-- Namrata Rao -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Namrata Rao', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/namrata=rao.webp'); ?>"
                                alt="<?php echo esc_attr__('Picture of Namrata Rao', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Namrata Rao', 'srft-theme'); ?></p>
                    </li>


                    <!-- Haobam Paban Kumar -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Haobam Paban Kumar', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/paban-kumar.webp'); ?>"
                                alt="<?php echo esc_attr__('Picture of Haobam Paban Kumar', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Haobam Paban Kumar', 'srft-theme'); ?></p>
                    </li>


                    <!-- Pritha Chakraborty -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Pritha Chakraborty', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/pritha-chakraborty.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Pritha Chakraborty', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Pritha Chakraborty', 'srft-theme'); ?></p>
                    </li>


                    <!-- Madhura Palit -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Madhura Palit', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Modhura-Palit.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Madhura Palit', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Madhura Palit', 'srft-theme'); ?></p>
                    </li>


                    <!-- Abhijit Sen -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Abhijit Sen', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/avijit-sen.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Abhijit Sen', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Abhijit Sen', 'srft-theme'); ?></p>
                    </li>


                    <!-- Sagar Ballary -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Sagar Ballary', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/sagar-ballari.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Sagar Ballary', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Sagar Ballary', 'srft-theme'); ?></p>
                    </li>


                    <!-- Pritam Das -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Pritam Das', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Pritam-Das.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Pritam Das', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Pritam Das', 'srft-theme'); ?></p>
                    </li>


                    <!-- Sourav Rai -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Sourav Rai', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Saurav-Rai.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Sourav Rai', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Sourav Rai', 'srft-theme'); ?></p>
                    </li>


                    <!-- Dominic Sangma -->
                    <li class="alumni-carousel-item">
                        <a
                            class="alumni-img"
                            href="#"
                            aria-label="<?php echo esc_attr__('Dominic Sangma', 'srft-theme'); ?>"
                        >
                            <img
                                src="<?php echo esc_url(get_template_directory_uri() . '/images/Dominic-Sangma.png'); ?>"
                                alt="<?php echo esc_attr__('Picture of Dominic Sangma', 'srft-theme'); ?>"
                                loading="lazy"
                            >
                        </a>
                        <p><?php echo esc_html__('Dominic Sangma', 'srft-theme'); ?></p>
                    </li>

                </ul>

            </div>


            <!-- Screen reader announcement -->
            <div
                id="alumniAriaLive"
                class="visually-hidden"
                aria-live="polite"
                aria-atomic="true"
            ></div>

        </div>

    </div>
</section>



  <!--<section class="section-home" style="background-color: rgb(228, 118, 15);
  background-image: url(<?php bloginfo('template_url'); ?>/images/Workshop002.png); background-blend-mode: multiply;">-->
    <!--<div class="section-intro-header-text" style="color: white;">News</div>-->
    <section class="section-home">
    <h2 class="section-intro-header-text" style="padding-left: 0;"><?php echo __('Award Winning Student Films', 'srft-theme' ); ?></h2>
    <!--<p id="carousel-instructions" class="sr-only">
    This is a carousel. Use the next and previous controls to navigate between award items.
  </p>-->
    <div class="frame" role="region" aria-label="Award Winnng Student Films" aria-roledescription="carousel">
      <ul class="slider" >
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
          <img typeof="foaf:Image" class="img-responsive lazyOwl" src="<?php echo get_field('film_still');?>" alt=""  style="display: block;">
          <div class="news-item-title">
          <h3><?php echo get_field('Film-Name');?></h3>
          <p><?php echo get_field('award_received');?></p>  
        </div>
        <div class="view-more-button"><a href="<?php the_permalink(); ?>" target="_blank" class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" aria-label="View more recent news" href="/documents">View Details<span aria-hidden="true" class="material-symbols-outlined ">chevron_right</span></a></div>

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
    <?php
echo '<!-- Current Language: ' . $current_language . ' -->';
?>
    <div class="section-intro-header">
        <h2 class="section-intro-header-text" style="padding-left: 0;">
            <?php echo __('Media Gallery', 'srft-theme'); ?>
        </h2>
    </div>
    
    <div class="container" style="display: flex; padding: 24px; max-width: 1450px;">
        
        <div class="img_card">
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=1')); }
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
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=2')); }
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
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=3')); }
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
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=4')); }
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
        <a href="<?php if ($current_language === 'en') { echo esc_url(site_url('/photo-gallery/?tab=5')); }
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



<section class="section-home">
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
    <h4 style="margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
    <!-- Removed flex styles from the SVG, they belong on the parent h4 -->
    <span style="display: flex;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 61 68" fill="none">
            <path d="M8.05255 66C6.36119 66 4.9296 65.4141 3.75776 64.2422C2.58592 63.0704 2 61.6388 2 59.9474V15.1346C2 13.4433 2.58592 12.0117 3.75776 10.8399C4.9296 9.66801 6.36119 9.08209 8.05255 9.08209H12.688V2H17.8391V9.08209H43.2077V2H48.2299V9.08209H52.8654C54.5567 9.08209 55.9883 9.66801 57.1601 10.8399C58.332 12.0117 58.9179 13.4433 58.9179 15.1346V59.9474C58.9179 61.6388 58.332 63.0704 57.1601 64.2422C55.9883 65.4141 54.5567 66 52.8654 66H8.05255ZM8.05255 60.9778H52.8654C53.1232 60.9778 53.3592 60.8704 53.5735 60.6556C53.7883 60.4413 53.8957 60.2053 53.8957 59.9474V28.5271H7.02217V59.9474C7.02217 60.2053 7.12959 60.4413 7.34442 60.6556C7.5587 60.8704 7.79474 60.9778 8.05255 60.9778ZM7.02217 23.5049H53.8957V15.1346C53.8957 14.8768 53.7883 14.6408 53.5735 14.4265C53.3592 14.2117 53.1232 14.1043 52.8654 14.1043H8.05255C7.79474 14.1043 7.5587 14.2117 7.34442 14.4265C7.12959 14.6408 7.02217 14.8768 7.02217 15.1346V23.5049Z" fill="#5D3E00"/>
        </svg>
    </span>
    <?php echo $formatted_date ? esc_html($formatted_date->format('d M, Y')) : __('No date available', 'srft-theme'); ?>
</h4>

    <p><a href="<?php echo $link; ?>">
        <?php the_title(); ?>&nbsp;
        <?php if ($doc): ?>
         <a
    href="<?php echo esc_url($file_url); ?>"
    target="_blank"
    rel="noopener"
    aria-label="<?php echo esc_attr( 'Download PDF, ' . $file_size_mb . ' MB' ); ?>"
>

    <!-- PDF Icon -->
    <span class="tooltip-box">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 68 68"
            fill="none"
            aria-hidden="true"
            focusable="false"
        >
            <path
                fill-rule="evenodd"
                clip-rule="evenodd"
                d="M15.13 47.8714C12.7254 46.6379 9.88617 46.145 7.0975 46.4771H0V67.9281H5.6525V59.741H8.075C10.5846 59.9579 13.1063 59.4402 15.215 58.2752C17.0049 56.9837 17.9917 55.0731 17.8925 53.0912C18.025 51.0785 16.9966 49.1354 15.13 47.8714ZM10.5825 55.701C9.51486 56.0964 8.34103 56.2445 7.1825 56.1301H5.525V50.0523H7.1825C8.38607 49.9447 9.6003 50.144 10.6675 50.6243C11.6614 51.2066 12.2246 52.1813 12.155 53.1984C12.2838 54.2239 11.6623 55.213 10.5825 55.701ZM30.0475 46.4771H22.9925V67.9281H29.75C33.1938 68.2116 36.6618 67.653 39.7375 66.3193C43.1218 64.1975 44.9299 60.7346 44.4975 57.2026C44.7508 54.1767 43.4692 51.2021 40.97 49.0155C37.8829 46.9686 33.9459 46.0537 30.0475 46.4771ZM35.6575 63.0659C33.8869 63.9031 31.8595 64.2766 29.835 64.1384H28.73V50.2668H29.75C33.32 50.2668 34.7225 50.5528 36.125 51.6254C37.8271 53.1161 38.7062 55.1399 38.5475 57.2026C38.7661 59.4349 37.6898 61.6187 35.6575 63.0659ZM50.7025 67.9281H56.44V58.9544H68V55.1648H56.44V50.2668H68V46.4771H50.7025V67.9281ZM46.75 0H0V39.3268H8.5V32.1765V28.4226V7.15033H43.2225L59.5 20.8432V28.4226V32.1765V39.3268H68V17.8758L46.75 0Z"
                fill="#5d3e00"
            />
        </svg>

        <span class="tooltip-text">
            <?php echo esc_html__( 'PDF', 'srft-theme' ); ?>
        </span>
    </span>


    <!-- File Size -->
    <span aria-hidden="true">
        <?php echo esc_html($file_size_mb); ?> MB
    </span>


    <!-- Download Icon -->
    <span class="tooltip-box">
        <svg
            width="24"
            height="24"
            viewBox="0 0 64 64"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
            aria-hidden="true"
            focusable="false"
        >
            <path
                d="M32.0003 41.5333C31.6448 41.5333 31.3114 41.4777 31.0003 41.3666C30.6892 41.2555 30.4003 41.0666 30.1337 40.8L20.5337 31.2C20.0003 30.6666 19.7448 30.0444 19.767 29.3333C19.7892 28.6222 20.0448 28 20.5337 27.4666C21.067 26.9333 21.7003 26.6555 22.4337 26.6333C23.167 26.6111 23.8003 26.8666 24.3337 27.4L29.3337 32.4V13.3333C29.3337 12.5777 29.5892 11.9444 30.1003 11.4333C30.6114 10.9222 31.2448 10.6666 32.0003 10.6666C32.7559 10.6666 33.3892 10.9222 33.9003 11.4333C34.4114 11.9444 34.667 12.5777 34.667 13.3333V32.4L39.667 27.4C40.2003 26.8666 40.8337 26.6111 41.567 26.6333C42.3003 26.6555 42.9337 26.9333 43.467 27.4666C43.9559 28 44.2114 28.6222 44.2337 29.3333C44.2559 30.0444 44.0003 30.6666 43.467 31.2L33.867 40.8C33.6003 41.0666 33.3114 41.2555 33.0003 41.3666C32.6892 41.4777 32.3559 41.5333 32.0003 41.5333ZM16.0003 53.3333C14.5337 53.3333 13.2781 52.8111 12.2337 51.7666C11.1892 50.7222 10.667 49.4666 10.667 48V42.6666C10.667 41.9111 10.9225 41.2777 11.4337 40.7666C11.9448 40.2555 12.5781 40 13.3337 40C14.0892 40 14.7225 40.2555 15.2337 40.7666C15.7448 41.2777 16.0003 41.9111 16.0003 42.6666V48H48.0003V42.6666C48.0003 41.9111 48.2559 41.2777 48.767 40.7666C49.2781 40.2555 49.9114 40 50.667 40C51.4226 40 52.0559 40.2555 52.567 40.7666C53.0781 41.2777 53.3337 41.9111 53.3337 42.6666V48C53.3337 49.4666 52.8114 50.7222 51.767 51.7666C50.7225 52.8111 49.467 53.3333 48.0003 53.3333H16.0003Z"
                fill="#5d3e00"
            />
        </svg>

        <span class="tooltip-text">
            <?php echo esc_html__( 'Download', 'srft-theme' ); ?>
        </span>
    </span>

</a>  
        <?php endif; ?>
    </a>
    <?php if ($post_type === 'announcement') : ?>
    <?php
    $announcement_cat = get_field('announcement_category');
    if ($announcement_cat) : ?>
        <span class="announcement-category">
            <!--<?php echo esc_html($announcement_cat); ?>-->
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
        <p class="event-meta" style="margin: 4px 0; display: flex; align-items: center; flex-wrap: wrap; gap: 8px;">
    
    <!-- Venue Group -->
    <span style="display: flex; align-items: center; gap: 4px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 55 68" fill="none">
            <path d="M27.418 33.5303C29.093 33.5303 30.525 32.9339 31.714 31.7409C32.9036 30.548 33.4984 29.114 33.4984 27.4391C33.4984 25.7641 32.9019 24.3319 31.7089 23.1423C30.516 21.9533 29.0818 21.3587 27.4062 21.3587C25.7313 21.3587 24.2993 21.9552 23.1103 23.1482C21.9207 24.3411 21.3259 25.7753 21.3259 27.4509C21.3259 29.1258 21.9224 30.5578 23.1153 31.7468C24.3083 32.9358 25.7425 33.5303 27.418 33.5303ZM27.4121 59.28C33.9986 53.3837 39.0389 47.7282 42.533 42.3133C46.0271 36.8985 47.7742 32.1559 47.7742 28.0855C47.7742 21.9479 45.8243 16.9023 41.9245 12.9486C38.0247 8.99496 33.1872 7.01812 27.4121 7.01812C21.6371 7.01812 16.7996 8.99496 12.8998 12.9486C9.00001 16.9023 7.05011 21.9479 7.05011 28.0855C7.05011 32.1559 8.79716 36.8985 12.2913 42.3133C15.7854 47.7282 20.8257 53.3837 27.4121 59.28ZM27.4121 66C18.9392 58.6583 12.5856 51.8258 8.35135 45.5025C4.11712 39.1786 2 33.3729 2 28.0855C2 20.3162 4.51299 14.0263 9.53897 9.21576C14.5655 4.40525 20.5232 2 27.4121 2C34.301 2 40.2588 4.40525 45.2853 9.21576C50.3113 14.0263 52.8243 20.3162 52.8243 28.0855C52.8243 33.3729 50.7072 39.1786 46.4729 45.5025C42.2387 51.8258 35.8851 58.6583 27.4121 66Z" fill="#5D3E00"/>
        </svg>
        <?php echo esc_html($event_venue); ?>
    </span>

    <?php if (!empty($event_time)): ?>
        
        <!-- Divider -->
        <span>|</span>
        
        <!-- Time Group -->
        <span style="display: flex; align-items: center; gap: 4px;">
            <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#2d2d2d">
                <path d="M513-492v-171q0-13-8.5-21.5T483-693q-13 0-21.5 8.5T453-663v183q0 6 2 11t6 10l144 149q9 10 22.5 9.5T650-310q9-9 9-22t-9-22L513-492ZM480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-82 31.5-155t86-127.5Q252-817 325-848.5T480-880q82 0 155 31.5t127.5 86Q817-708 848.5-635T880-480q0 82-31.5 155t-86 127.5Q708-143 635-111.5T480-80Zm0-400Zm0 340q140 0 240-100t100-240q0-140-100-240T480-820q-140 0-240 100T140-480q0 140 100 240t240 100Z" fill="#5D3E00"/>
            </svg> 
            <?php echo esc_html($event_time); ?>
        </span>
        
    <?php endif; ?>
</p>
    <?php endif; ?>

    <br>

<?php endwhile; wp_reset_postdata(); else : ?>
    <p><?php echo __('No posts found in this category.', 'srft-theme'); ?></p>
<?php endif; ?>
</div>
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
        <div class="view-more-button" style="margin-top: 3rem;">
    <a href="<?php echo esc_url($final_url); ?>" 
       class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" style="margin-top: 15px;"
       aria-label="Read more about latest <?php echo esc_attr(strtolower($title)); ?>">
       View All<span aria-hidden="true" class="material-symbols-outlined">chevron_right</span>
    </a>
</div>
    </a>
<?php endif; ?>

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
            //$category_slug = ($current_language === 'hi_IN') ? 'social-hi' : 'social-en';

            $social_query = new WP_Query([
                'post_type'      => 'social',
                'posts_per_page' => 4,
                'post_status'    => 'publish',
                'orderby'        => 'date',
                'order'          => 'DESC',
            ]);
            ?>

            <div class="box-container social-feeds">

                <?php if ($social_query->have_posts()) :
                    while ($social_query->have_posts()) : $social_query->the_post();

                       $platform = function_exists('pll_current_language') && pll_current_language() === 'hi' ? get_field('social_platform_hindi') : get_field('social_platform');
$raw_embed_code = get_field('embed_code');
$social_handle = get_field('social_handle'); 

$embed_code = $raw_embed_code;

// ACCESSIBILITY FIX: Use DOMDocument to safely parse and inject missing alt tags
if (!empty($embed_code)) {
    $dom = new DOMDocument();
    
    // Suppress warnings because Instagram's raw HTML often has minor validation errors
    libxml_use_internal_errors(true); 
    
    // Load the HTML safely with correct UTF-8 encoding
    $dom->loadHTML(mb_convert_encoding($embed_code, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
    // Find EVERY image tag in the Instagram embed
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $img) {
        // If it doesn't have an alt tag, or if the alt tag is empty, force one in.
        if (!$img->hasAttribute('alt') || trim($img->getAttribute('alt')) === '') {
            $img->setAttribute('alt', 'Instagram social feed image');
        }
    }
    
    // Save the corrected HTML back to our variable
    $embed_code = $dom->saveHTML();
    
    // Clear the memory
    libxml_clear_errors();
}
                        
                        // Normalize platform to lowercase for comparison
                        $platform_lower = strtolower($platform);
                        
                        // Default social media URLs if no custom handle provided
                        $platform_urls = [
                            'linkedin' => 'https://www.linkedin.com/school/satyajit-ray-film-and-television-institute-srfti/',
                            'facebook' => 'https://www.facebook.com/srftikol',
                            'youtube' => 'https://www.youtube.com/@your-channel',
                            'twitter' => 'https://x.com/srfti_official',
                            'instagram' => 'https://www.instagram.com/srfti_official/',
                            'vimeo' => 'https://vimeo.com/your-account',
                            'लिंक्डइन' => 'https://www.linkedin.com/school/satyajit-ray-film-and-television-institute-srfti/',
                            'फेसबुक' => 'https://www.facebook.com/srftikol',
                            'यूट्यूब' => 'https://www.youtube.com/@your-channel',
                            'ट्विटर' => 'https://x.com/srfti_official',
                            'इंस्टाग्राम' => 'https://www.instagram.com/srfti_official/',
                            'विमियो' => 'https://vimeo.com/your-account'

                        ];
                        
                        // Use custom handle if provided, otherwise use default
                        $social_url = $platform_urls[$platform_lower];
                ?>

                    <article class="cell social-card social-<?php echo esc_attr($platform_lower); ?>" aria-label="<?php echo esc_attr(ucfirst($platform_lower)); ?> feed">

                        <h3 class="update-title" style="display: flex; align-items: center; gap: 10px;">
                            
                          <?php if (in_array($platform_lower, ['linkedin', 'लिंक्डइन'], true)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 22" width="24" height="24" fill="#007AB9" style="flex-shrink: 0;">
                                    <path d="M20.9302 12.2503V19.99H16.443V12.7689C16.443 10.9553 15.7939 9.71725 14.171 9.71725C13.6626 9.72116 13.1679 9.88297 12.7555 10.1803C12.343 10.4776 12.0332 10.8958 11.8688 11.3769C11.7533 11.7285 11.7023 12.0981 11.7183 12.4678V19.99H7.23105C7.23105 19.99 7.29128 7.75975 7.23105 6.4949H11.7183V8.40555C11.7183 8.42229 11.6982 8.43567 11.6915 8.4524H11.7183V8.40555C12.1253 7.7005 12.7173 7.12018 13.4304 6.72738C14.1434 6.33457 14.9503 6.14426 15.7638 6.17701C18.7151 6.17701 20.9302 8.10775 20.9302 12.2503ZM2.53974 0C1.00385 0 0 1.00385 0 2.34231C0 3.68078 0.973733 4.68462 2.4795 4.68462H2.50962C4.07228 4.68462 5.04601 3.64731 5.04601 2.34231C5.04601 1.03731 4.07228 0 2.53974 0ZM0.264347 20H4.75155V6.4949H0.264347V20Z"/>
                                </svg>
                                
                           <?php elseif (in_array($platform_lower, ['facebook', 'फेसबुक'], true)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#1877F2" style="flex-shrink: 0;">
                                    <path d="M10,0C4.5,0,0,4.5,0,10c0,5,3.7,9.1,8.4,9.9v-7H5.9v-2.9h2.5V7.8c0-2.5,1.5-3.9,3.8-3.9c1.1,0,2.2,0.2,2.2,0.2v2.5h-1.3 c-1.2,0-1.6,0.8-1.6,1.6v1.9h2.8L13.9,13h-2.3v7C16.3,19.1,20,15,20,10C20,4.5,15.5,0,10,0z"/>
                                </svg>
                                
                            <?php elseif ($platform_lower === 'youtube'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="24" height="24" fill="#FF0000" style="flex-shrink: 0;">
                                    <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                </svg>
                                
                         <?php elseif (in_array($platform_lower, ['twitter', 'ट्विटर', 'x', 'एक्स'], true)): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#000000" style="flex-shrink: 0;">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                                
                            <?php elseif (in_array($platform_lower, ['instagram', 'इंस्टाग्राम'], true)): ?>
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

                        <div class="social-embed" tabindex="0"  role="region"
     aria-label="social media posts from SRFTI official page">
                            <?php echo $embed_code; ?>
                        </div>

                    <div class="view-more-button" style="margin-top: 3rem;">
    <a href="<?php echo esc_url($social_url); ?>" 
       class="d-flex view-more-link align-items-center text-decoration-none fw-semibold" 
       aria-label="Read more about latest <?php echo esc_attr(strtolower($title)); ?>">
       View more<span aria-hidden="true" class="material-symbols-outlined">chevron_right</span>
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
