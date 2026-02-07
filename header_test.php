<?php
/*
Template Name: Headertest
*/
?>

<!doctype html>

<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="The Satyajit Ray Film & Television Institute is an autonomous educational institution under the Ministry of Information and Broadcasting, Government of India. It offers postgraduate programs in film and television studies.">
    <meta name="keywords" content="Home, Contact Us, Courses, Admission, Post Graduate Programme in Cinema, Post Graduate Programme in EDM, FAQ">
    <meta name="language" content="English">

    <?php wp_head(); ?>
    
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Noto+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/37e9fe1e7c.js" crossorigin="anonymous"></script>
    <link href="https://use.typekit.net/eyn5jyy.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.typekit.net/jbg0wxv.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>    
    <script src="<?php bloginfo('template_url'); ?>/script/jquery.counterup.js"></script>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />-->
    <link href="<?php bloginfo('template_url'); ?>/css/lightbox.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.theme.default.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Rozha+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/a11y-slider@latest/dist/a11y-slider.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/jquery-3.7.0.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/acmeticker.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/lightbox.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a11y-slider@latest/dist/a11y-slider.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>  
  </head>

<body <?php body_class(); ?>>

<?php
/**
 * HEADER CAROUSEL – CLEAN & FIXED
 * Single query, no nesting, no redeclaration
 * Shows ALL Banner pictures (max 7)
 */
?>

<main role="main">
  <h1 class="sr-only">Satyajit Ray Film & Television Institute</h1>

<?php
$carousel_args = [
    'post_type'      => 'picture',
    'posts_per_page' => 7,
    'post_status'    => 'publish',
    'meta_query'     => [
        [
            'key'     => 'Picture_Category',
            'value'   => 'Banner', // stored value (case-sensitive)
            'compare' => '='
        ]
    ],
];

$carousel_query = new WP_Query($carousel_args);

if ($carousel_query->have_posts()) :
    $total = $carousel_query->post_count;
    $i = 0;
?>

<section role="region"
         aria-label="Featured"
         id="myCarousel"
         class="carousel-tablist"
         aria-roledescription="carousel">

<div class="carousel-inner" id="skip-to-content">

<!-- CONTROLS -->
<div class="controls">
  <button class="rotation" type="button" aria-label="Pause / Play">
     <svg width="42" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg" class="svg-play">
          <rect class="background" x="2" y="2" rx="5" ry="5" width="38" height="24"></rect>
          <rect class="border" x="4" y="4" rx="5" ry="5" width="34" height="20"></rect>

          <polygon class="pause" points="17 8 17 20"></polygon>

          <polygon class="pause" points="24 8 24 20"></polygon>

          <polygon class="play" points="15 8 15 20 27 14"></polygon>
        </svg>
  </button>

  <!-- TABS -->
  <div class="tab-wrapper">
    <div role="tablist" aria-label="Slides">
      <?php while ($carousel_query->have_posts()) : $carousel_query->the_post(); $i++; ?>
        <button
          id="carousel-tab-<?php echo $i; ?>"
          type="button"
          role="tab"
          aria-label="Slide <?php echo $i; ?>"
          aria-selected="<?php echo ($i === 1) ? 'true' : 'false'; ?>"
          aria-controls="carousel-item-<?php echo $i; ?>">
          <svg width="34" height="34" xmlns="http://www.w3.org/2000/svg">
            <circle class="border" cx="16" cy="15" r="10"></circle>
            <circle class="tab-background" cx="16" cy="15" r="8"></circle>
            <circle class="tab" cx="16" cy="15" r="6"></circle>
          </svg>
        </button>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<!-- SLIDES -->
<div id="myCarousel-items" class="carousel-items playing" aria-live="off">
  <?php
  wp_reset_postdata();
  $i = 0;
  while ($carousel_query->have_posts()) : $carousel_query->the_post(); $i++;
    $image = get_field('Picture_File'); // URL
    $link  = get_field('picture_link');
    $alt   = get_field('picture_description') ?: get_the_title();
  ?>

  <div class="carousel-item <?php echo ($i === 1) ? 'active' : ''; ?>"
       id="carousel-item-<?php echo $i; ?>"
       role="tabpanel"
       aria-roledescription="slide"
       aria-label="<?php echo $i . ' of ' . $total; ?>">

    <div class="carousel-image">
      <?php if ($image) : ?>
        <a href="<?php echo esc_url($link ?: '#'); ?>" tabindex="-1">
          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt); ?>">
        </a>
      <?php endif; ?>
    </div>
  </div>

  <?php endwhile; wp_reset_postdata(); ?>
</div>
  </div>
</section>

<?php else : ?>

  <p>No carousel items to display.</p>
<?php endif; ?>

</main>


<?php wp_footer(); ?>

</body>
</html>
