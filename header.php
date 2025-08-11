<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 **/
?>
<?php 
$current_language = get_locale();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>    
    <script src="<?php bloginfo('template_url'); ?>/script/jquery.counterup.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="<?php bloginfo('template_url'); ?>/css/lightbox.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.theme.default.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Rozha+One&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/jquery-3.7.0.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/acmeticker.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/lightbox.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>  
  </head>


<body <?php body_class(); ?>>

  <header class="sticky" >
         <!--<nav id="nav-wrapper">-->
       <div class="top_header" role="banner">
         <!--<div>
           <ul style="display:flex;">
           <li> <marquee style="color: white;"><?php echo __('Important Notice: The admission deadline for the Master\'s Course has been extended to 31st July, 2025.', 'srft-theme'); ?>
</marquee></li>
           </ul>         
          </div>-->
          <ul style="display:flex; align-items: center; margin:0; padding:0;">
          <li class="hide-on-mobile"><a href="https://mibmu-eoffice.railtel.in" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><?php echo __('e-office', 'srft-theme' ); ?>&nbsp; <i class="fas fa-briefcase" aria-hidden="true"></i></a></li>
          <li class="hide-on-mobile"><a href="http://campus.srfti.ac.in/leave/" target="_blank" title="External Intranet Link that opens in new window" onclick="return check_url();"><?php echo __('e-leave', 'srft-theme' ); ?>&nbsp; <i class="fas fa-calendar-check" aria-hidden="true"></i></a></li>
          <li class="hide-on-mobile"><a href="http://webmail.srfti.ac.in" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><?php echo __('webmail', 'srft-theme' ); ?> &nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></a></li>
             <!--<li><a>govmail</a></li>-->
            <li>
            <a href="#" title="Choose your language" aria-haspopup="true"  role="presentation" tabindex=-1>
            <!--<i class="fa-solid fa-language" aria-hidden="true"></i>-->
              <?php if (function_exists('pll_the_languages')) : ?>
            <span class="language-text"><svg viewBox="0 0 35 34" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.5753 3.24173H21.4103V1.11025H14.2739V3.24173H16.2291V8.98488C15.9945 9.06383 15.7599 9.12303 15.5448 9.18224C14.9387 9.32039 14.1957 9.39934 13.3159 9.39934C12.7098 9.39934 12.1428 9.35986 11.6149 9.30066C11.5367 9.28092 11.4389 9.28092 11.3607 9.26118C11.3412 9.24145 11.3216 9.22171 11.3021 9.20198C11.1065 8.96515 10.911 8.76779 10.7351 8.59016C11.2434 8.25465 11.654 7.85993 11.9668 7.38627C12.4361 6.71525 12.6511 5.90608 12.6511 4.99823C12.6511 3.7746 12.2601 2.7878 11.4585 1.99836C10.6569 1.20893 9.52285 0.814209 8.05647 0.814209C7.17664 0.814209 6.37501 0.912889 5.6907 1.12998C5.00639 1.34708 4.38073 1.58391 3.83328 1.87995L4.5958 3.95222C5.18236 3.63645 5.74936 3.37988 6.27726 3.20226C6.82471 3.02463 7.41126 2.94569 8.03692 2.94569C8.68213 2.94569 9.22958 3.10358 9.65972 3.43909C10.1094 3.7746 10.3245 4.28773 10.3245 4.99823C10.3245 5.72845 10.0508 6.32053 9.5033 6.77446C8.95585 7.22838 8.05647 7.46522 6.82471 7.54416L7.03978 9.63617C7.56767 9.61643 8.07602 9.53749 8.54526 9.43881C8.9754 9.81379 9.34689 10.2282 9.69882 10.6822C10.2854 11.4321 10.5982 12.3005 10.5982 13.2676C10.5982 13.9978 10.3831 14.5504 9.97254 14.9057C9.56196 15.2609 9.03406 15.4385 8.38885 15.4385C7.62633 15.4385 6.92246 15.1622 6.29681 14.6096C5.67115 14.057 5.06504 13.2478 4.51759 12.2216C3.97014 11.1953 3.42269 9.95194 2.8948 8.53096L0.783203 9.22171C1.54572 11.215 2.30824 12.8334 3.09031 14.057C3.87239 15.3004 4.69356 16.1885 5.59294 16.7608C6.49233 17.3134 7.46991 17.5897 8.56481 17.5897C9.40554 17.5897 10.1681 17.4516 10.8133 17.1556C11.4585 16.8595 11.9864 16.4056 12.3579 15.7938C12.7293 15.182 12.9249 14.432 12.9249 13.5636C12.9249 12.9913 12.8662 12.4781 12.7293 12.044C12.6707 11.8466 12.5925 11.6492 12.5143 11.4519C12.5729 11.4519 12.6316 11.4716 12.6902 11.4716C13.0422 11.5308 13.3746 11.5506 13.6678 11.5506C14.3717 11.5506 15.0365 11.4913 15.6621 11.3729C15.8576 11.3335 16.0336 11.294 16.2291 11.2348V20.0962H18.5753V3.24173Z" fill="#ffffff"></path>
                        <path d="M27.0413 12.0637H24.3822L17.148 33.8719H19.8853L22.0947 27.1025H29.3288L31.5577 33.8719H34.295L27.0413 12.0637ZM22.779 24.7144L24.8906 17.9253C24.9688 17.649 25.0665 17.3134 25.1643 16.9582C25.262 16.603 25.3598 16.228 25.4576 15.853C25.5553 15.4583 25.614 15.0833 25.6922 14.728C25.7508 14.9846 25.829 15.3398 25.9464 15.7543C26.0637 16.1688 26.1614 16.5832 26.2787 16.9779C26.396 17.3727 26.4743 17.6884 26.5329 17.945L28.6445 24.7341H22.779V24.7144Z" fill="#ffffff"></path>
                    </svg></span>
            <?php endif; ?>
          </a>
          <div id="language-switcher" class="language-switcher" aria-labelledby="language-switcher-label">
    <label id="language-switcher-label" for="lang_choice_1" class="visually-hidden">Language Selection</label>
    
    <?php
        pll_the_languages(
            array(
                'show_flags' => 1,
                'show_names' => 1,
                'display_names_as' => 'name',
                'hide_if_empty' => 0,
                'force_home' => 0,
                'hide_if_no_translation' => 0,
                'echo' => 1,
                'post_id' => null,
                'raw' => 0,
                'item_spacing' => 'preserve',
                'dropdown' => 1, // Use a dropdown for multiple languages
                'menu' => 'language-menu', // Set a unique CSS class for styling
            )
        );
    ?>
</div>

</li>

             <li style="padding: 0 5px; display: flex; align-items: center; line-height: 1; margin: 0;">
             <a href="#skip-to-content" title="Skip to Main Content" aria-label="Skip to main content">
  <span class="skp-to-main" aria-hidden="true">
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 64 64" fill="none" style="display: flex; justify-content: center;">
      <path d="M57 10H14.5C13.1739 10 11.9021 10.5268 10.9645 11.4645C10.0268 12.4021 9.5 13.6739 9.5 15V25H14.5V15H57V50H14.5V40H9.5V50C9.5 51.3261 10.0268 52.5979 10.9645 53.5355C11.9021 54.4732 13.1739 55 14.5 55H57C58.3261 55 59.5979 54.4732 60.5355 53.5355C61.4732 52.5979 62 51.3261 62 50V15C62 13.6739 61.4732 12.4021 60.5355 11.4645C59.5979 10.5268 58.3261 10 57 10ZM19.5 40V35H2V30H19.5V25L29.5 32.5L19.5 40ZM52 35H34.5V30H52V35ZM52 25H34.5V20H52V25ZM44.5 45H34.5V40H44.5V45Z" fill="#ffffff"></path>
    </svg>
  </span>
  <img class="mobile-icon" src="<?php bloginfo('template_url'); ?>/images/icon-skip-to-main.png" alt="Skip to main content">
</a>

          
             <!--<li class="hide-on-mobile"><a href="<?php echo esc_url(site_url('/contact-us//')); ?>"><?php echo __('Contact Us', 'srft-theme' ); ?></a></li>-->         
             <li><button title="Accessibility options" id="accessibility-icon" aria-label="<?php echo __('Accessibilty tool', 'srft-theme' ); ?>">
              <!--<i class="fas fa-universal-access"></i>-->
  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
    <path d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M6 5.5l-4.535-.442A.531.531 0 0 1 1.531 4H14.47a.531.531 0 0 1 .066 1.058L10 5.5V9l.452 6.42a.535.535 0 0 1-1.053.174L8.243 9.97c-.064-.252-.422-.252-.486 0l-1.156 5.624a.535.535 0 0 1-1.053-.174L6 9z"/>
  </svg>

            </button></li>
<li>
<div class="search-box"><?php echo do_shortcode('[ivory-search id="3166" title="Custom Search Form"]'); ?></div> </li>
      </ul>
</div>
<!-- Accessibility Menu -->
<div id="accessibility-menu" class="hidden">
    <div class="text-resize">
        <h4><?php echo __('Text Resize', 'srft-theme' ); ?></h4>
        <button type="button" title="Increase font size" value=<?php echo __('Increase', 'srft-theme' ); ?> aria-label="Increase Text Size" class="increaseFont">
            <i class="fas fa-search-plus"></i>
        </button>
        <button type="button" title="Decrerase font size" value=<?php echo __('Decrease', 'srft-theme' ); ?> aria-label="Decrease Text Size" class="decreaseFont">
            <i class="fas fa-search-minus"></i>
        </button>
        <button type="button" title="Normal font size" value=<?php echo __('Normal', 'srft-theme' ); ?> aria-label="Normal Text Size" class="normalFont">
        <i class="fas fa-sync-alt"></i>
        </button>
    </div>
    <div class="color-adjustment">
        <h4><?php echo __('Color Adjustment', 'srft-theme' ); ?></h4>
        <button type="button" title="Normal View" id="high-contrast" aria-label="Set high contrast">
            <i class="fas fa-adjust"></i>
        </button>
        <button type="button" title="High contrast view" id="dark-mode" aria-label="Set low contrast">
            <i class="fas fa-moon" ></i>
        </button>
    </div>
    <!--<div class="color-adjustment">
        <h4><?php echo __('Navigation Adjustment', 'srft-theme' ); ?></h4>
        <?php echo __('Screen Reader', 'srft-theme' ); ?>
    </div>-->
</div>

       <!--</div>-->
       <div class="menu-container">
       <input type="checkbox" id="check" aria-label="Open menu"/>
        <div class="logo-container">
          <div><a href="#" title="Logo of SRFTI"><img class="logo" src="<?php bloginfo('template_url'); ?>/images/SRFTI_Logo_DTBU.jpg" alt="<?php echo __('Logo of SRFTI', 'srft-theme' ); ?>"></a> </div>
					<!--<video  src="<?php bloginfo('template_url'); ?>/videos/test.mp4"  autoplay="" loop="" muted="muted" controlslist="nodownload" width="200" poster="https://arcurea.in/wp-content/uploads/2022/11/Frame-4.png"></video>-->
        </div>

        <div class="menu-btn">
        
          <div class="nav-links" >
            <nav class="nav-links" role="navigation" aria-label="SRFTI">
            <ul role="menubar" aria-label="Main Menu" style="display: flex; align-items: center; justify-content: center;">
              <li role="none" class="nav-link" style="--i: 0.6s" >
                <a role="menuitem" tabindex="-1" aria-label="Home" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/home/'));} 
                    else 
                    { echo esc_url(site_url('/घर/'));}
                    ?>" aria-label="Home" ><i class="fa fa-home" aria-hidden="true"></i><span class="sr-only">Home</span></a>
              </li>
              <li role="none" class="nav-link" style="--i: 1.1s">
                <a id="aboutMenuButton" tabindex="-1" href="#" id="aboutMenuButton" aria-haspopup="true" role="menuitem" aria-expanded="false"><?php echo __('About Us', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="About Us">
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/about-the-institute/'));} 
                    else 
                    { echo esc_url(site_url('/संस्थान के बारे में/'));}
                    ?>"><?php echo __('About the Institute', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/leadership/')); }
                    else  { echo esc_url(site_url('/नेतृत्व//'));}
                    ?>"><?php echo __('Leadership', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/management/'));}
                    else  { echo esc_url(site_url('/प्रबंध/'));}
                    ?>"><?php echo __('Management', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/organization-chart/'));} 
                     else { echo esc_url(site_url('/संगठन-संरचना/'));}
                      ?>">
                    <?php echo __('Organization Structure', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/important-committees/'));}
                    else { echo esc_url(site_url('/महत्वपूर्ण-समितियाँ/'));}
                    ?>"><?php echo __('Important Committees', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/annual-reports/'));}
                    else { echo esc_url(site_url('/वार्षिक-रिपोर्ट्स/'));}
                    ?>"><?php echo __('Annual Reports', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" tabindex="-1"  class="dropdown-link">
                    <a role="menuitem" href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/directory/'));}
                    else { echo esc_url(site_url('/निर्देशिका/'));}
                    ?>"><?php echo __('Directory', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.1s">
                <a role="menuitem" tabindex="-1" href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Academics', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul  role="menu" class="dropdown" aria-label="Academics">
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/mfa-in-cinema/'));}
                    else  { echo esc_url(site_url('/सनम-म-सनतकततर-करयकरम/'));}                   
                      ?>"><?php echo __('Master of Fine Arts in Cinema', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/mfa-in-edm/'));}
                      else  { echo esc_url(site_url('/ईडीएम-में-स्नातकोत्तर-का/'));} ?>"><?php echo __('Master of Fine Arts in EDM', 'srft-theme' ); ?></a>
                    </li>
                    <!--<li class="dropdown-link">
                      <a href="#"><?php echo __('Certficate Programmes', 'srft-theme' ); ?></a>
                    </li>-->
                   
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/faculty/'));} 
                    else 
                    { echo esc_url(site_url('/संकाय/'));}
                    ?>"><?php echo __('Faculty', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/research/'));}
                      else { echo esc_url(site_url('/गवेषणा/'));}?>"><?php echo __('Research', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/scholarship/'));}
                      else { echo esc_url(site_url('/छात्रवृत्ति/'));}?>"><?php echo __('Scholarship Schemes', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" tabindex="-1"  href="#" aria-haspopup="true"  aria-expanded="false"><?php echo __('Admission', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Admission">
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/course-overview/')); }
                      else { echo esc_url(site_url('/पाठ्यक्रम-का-अवलोकन/'));}
                      ?>"><?php echo __('Master of Fine Arts', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/post-graduate-programmes-at-fti-ar/')); } else  { echo esc_url(site_url('/फलम-और-टलवजन-ससथ-ए-आर/'));}?>"><?php echo __('Postgraduate programmes in IFTI AR', 'srft-theme' ); ?></a>
                    </li>
                  </ul>      
              </li>
              
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Facilities', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Facilities">
                    <li role="none" tabindex="-1" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/library/'));} 
                    else 
                    { echo esc_url(site_url('/पुस्तकालय/'));}
                    ?>"><?php echo __('Library', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/screening-room/'));}
                    else   { echo esc_url(site_url('/स्क्रीनिंग-सुविधाएँ/'));}?>"><?php echo __('Screening facilities', 'srft-theme' ); ?></a>
                    </li>
                   
                    <!--<li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/accommodation/')); ?>"><?php echo __('IT Infrastrure', 'srft-theme' ); ?></a>
                    </li>-->
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/accommodation/'));}
                    else  { echo esc_url(site_url('/निवास/'));} ?>"><?php echo __('Accomodation', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              
              </li>
              
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/students/')); }
                else  { echo esc_url(site_url('/छात्र/'));}?>"><?php echo __('Students', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
              </li>
             
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" tabindex="-1"  href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Resources', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Resources">
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/Vacancy/'));}
                      else  { echo esc_url(site_url('/रिक्ति/'));} ?>"><?php echo __('Recruitment Notices', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php 
if ($current_language === 'en_US') {
    echo esc_url(site_url('/tender/'));
} else {
    echo esc_url(site_url('/hi/निविदा/'));
}
?>"><?php echo __('Tenders', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/rti/')); }
                      else  { echo esc_url(site_url('/सूचना-का-अधिकार/'));} ?>"><?php echo __('RTI', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/citizen-charter/'));} else
                       { echo esc_url(site_url('/नगरक-अधकर-पतर/'));} ?>"><?php echo __('Citizen Charter', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/announcement/'));} else
                       { echo esc_url(site_url('/घोषणा-सूची/'));} ?>"><?php echo __('Circular & Notices', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/news/'));} else
                       { echo esc_url(site_url('/समाचार-सूची/'));} ?>"><?php echo __('News', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/contact-us/')); }
                else  { echo esc_url(site_url('/हमसे-संपर्क-करें/'));}?>"><?php echo __('Contact Us', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
              </li>
            </ul>
          </nav>  
          </div>

        </div>
        
        <div class="hamburger-menu-container"> 
          <div class="hamburger-menu">
            <div></div>
          </div>
        </div>
      </div>  
  </header>
  <?php if (is_page('home')) : ?> 
<section role="region" aria-label="Featured carousel" id="myCarousel" class="carousel-tablist" aria-roledescription="carousel" aria-label="Highlighted television shows">
  <div class="carousel-inner">
    <div class="controls">
      <button class="rotation" type="button">
        <svg width="42" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg" class="svg-play">
          <rect class="background" x="2" y="2" rx="5" ry="5" width="38" height="24"></rect>
          <rect class="border" x="4" y="4" rx="5" ry="5" width="34" height="20"></rect>

          <polygon class="pause" points="17 8 17 20"></polygon>

          <polygon class="pause" points="24 8 24 20"></polygon>

          <polygon class="play" points="15 8 15 20 27 14"></polygon>
        </svg>
      </button>

      <div class="tab-wrapper">
        <div role="tablist" aria-label="Slides">
          <button id="carousel-tab-1" type="button" role="tab" aria-label="Slide 1" aria-selected="true" aria-controls="carousel-item-1">
            <svg width="34" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="border" cx="16" cy="15" r="10"></circle>
              <circle class="tab-background" cx="16" cy="15" r="8"></circle>
              <circle class="tab" cx="16" cy="15" r="6"></circle>
            </svg>
          </button>
          <button id="carousel-tab-2" type="button" role="tab" tabindex="-1" aria-label="Slide 2" aria-selected="false" aria-controls="carousel-item-2">
            <svg width="34" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="border" cx="16" cy="15" r="10"></circle>
              <circle class="tab-background" cx="16" cy="15" r="8"></circle>
              <circle class="tab" cx="16" cy="15" r="6"></circle>
            </svg>
          </button>
          <button id="carousel-tab-3" type="button" role="tab" tabindex="-1" aria-label="Slide 3" aria-selected="false" aria-controls="carousel-item-3">
            <svg width="34" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="border" cx="16" cy="15" r="10"></circle>
              <circle class="tab-background" cx="16" cy="15" r="8"></circle>
              <circle class="tab" cx="16" cy="15" r="6"></circle>
            </svg>
          </button>
          <button id="carousel-tab-4" type="button" role="tab" tabindex="-1" aria-label="Slide 4" aria-selected="false" aria-controls="carousel-item-4">
            <svg width="34" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="border" cx="16" cy="15" r="10"></circle>
              <circle class="tab-background" cx="16" cy="15" r="8"></circle>
              <circle class="tab" cx="16" cy="15" r="6"></circle>
            </svg>
          </button>
          <button id="carousel-tab-5" type="button" role="tab" tabindex="-1" aria-label="Slide 5" aria-selected="false" aria-controls="carousel-item-5">
            <svg width="34" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="border" cx="16" cy="15" r="10"></circle>
              <circle class="tab-background" cx="16" cy="15" r="8"></circle>
              <circle class="tab" cx="16" cy="15" r="6"></circle>
            </svg>
          </button>
          <button id="carousel-tab-6" type="button" role="tab" tabindex="-1" aria-label="Slide 6" aria-selected="false" aria-controls="carousel-item-6">
            <svg width="34" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="border" cx="16" cy="15" r="10"></circle>
              <circle class="tab-background" cx="16" cy="15" r="8"></circle>
              <circle class="tab" cx="16" cy="15" r="6"></circle>
            </svg>
          </button>
          <button id="carousel-tab-7" type="button" role="tab" tabindex="-1" aria-label="Slide 7" aria-selected="false" aria-controls="carousel-item-7">
            <svg width="34" height="34" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="border" cx="16" cy="15" r="10"></circle>
              <circle class="tab-background" cx="16" cy="15" r="8"></circle>
              <circle class="tab" cx="16" cy="15" r="6"></circle>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div id="myCarousel-items" class="carousel-items playing" aria-live="off">
      
     <div class="carousel-item active" id="carousel-item-1" role="tabpanel" aria-roledescription="slide" aria-label="1 of 6">
        <div class="carousel-image">
          <a href="#" id="carousel-image-1">
            <img  src="<?php bloginfo('template_url'); ?>/images/Banner 2.png" alt="SRFTI deemed to be university courses" >
          </a>
        </div>

        <!--<div class="carousel-caption">
          <h3>
            <a href="#"> Dynamic Europe: Amsterdam, Prague, Berlin </a>
          </h3>

          <div class="hidden-xs hidden-sm">
            <p><span class="contrast">7 pm Tuesday, March 3, on TV</span></p>
          </div>
        </div>-->
        
      </div>

       <div class="carousel-item" id="carousel-item-2" role="tabpanel" aria-roledescription="slide" aria-label="1 of 6">
        <div class="carousel-image">
          <a href="#" id="carousel-image-2">
            <img  src="<?php bloginfo('template_url'); ?>/images/Banner 1.png" alt="SRFTI deemed to be university courses" >
          </a>
        </div>

        <!--<div class="carousel-caption">
          <h3>
            <a href="#"> Dynamic Europe: Amsterdam, Prague, Berlin </a>
          </h3>

          <div class="hidden-xs hidden-sm">
            <p><span class="contrast">7 pm Tuesday, March 3, on TV</span></p>
          </div>
        </div>-->
        
      </div>
      

      <div class="carousel-item" id="carousel-item-3" role="tabpanel" aria-roledescription="slide" aria-label="2 of 6">
        <div class="carousel-image">
          <a href="#" id="carousel-image-2">
            <img  src="<?php bloginfo('template_url'); ?>/images/5.1.jpg" alt="picture of satyajit ray in SRFTI" >
          </a>
        </div>

        <!--<div class="carousel-caption">
          <h3>
            <a href="#"> Travel to Southwest England and Paris </a>
          </h3>

          <div>
            <p><span class="contrast">Sept. 14 to Sept. 24 or 27</span></p>
          </div>
        </div>-->
        
      </div>
      

      <div class="carousel-item" id="carousel-item-4" role="tabpanel" aria-roledescription="slide" aria-label="3 of 6">
        <div class="carousel-image">
          <a href="#!" id="carousel-image-3">
            <img  src="<?php bloginfo('template_url'); ?>/images/5.2.jpg" alt="picture of student's production in set" >
          </a>
        </div>

        <!--<div class="carousel-caption">
          <h3>
            <a href="#"> Great Children's Programming on Public TV </a>
          </h3>

          <div></div>
        </div>-->
        
      </div>
      

      <div class="carousel-item" id="carousel-item-5" role="tabpanel" aria-roledescription="slide" aria-label="4 of 6">
        <div class="carousel-image">
          <a href="#" id="carousel-image-4">
            <img  src="<?php bloginfo('template_url'); ?>/images/GN7A6754.png"  alt="picture of animation masterclass">
          </a>
        </div>

        <!--<div class="carousel-caption">
          <h3>
            <a href="#"> Foyle’s War Revisited </a>
          </h3>

          <div>
            <p><span class="contrast">8 pm Sunday, March 8, on TV: Sneak peek at the final season.</span></p>
          </div>
        </div>-->
        
      </div>
      

      <div class="carousel-item" id="carousel-item-6" role="tabpanel" aria-roledescription="slide" aria-label="5 of 6">
        <div class="carousel-image">
          <a href="#" id="carousel-image-5">
             <img src="<?php bloginfo('template_url'); ?>/images/livemusicex.jpg" alt="picture of student's live music exercise">
          </a>
        </div>

        <!--<div class="carousel-caption">
          <h3>
            <a href="#"> Great Britain Vote: 7 pm Sat. </a>
          </h3>

          <div></div>
        </div>-->
        
      </div>
      

      <div class="carousel-item" id="carousel-item-7" role="tabpanel" aria-roledescription="slide" aria-label="6 of 6">
        <div class="carousel-image">
          <a href="#" id="carousel-image-6">
            <img  src="<?php bloginfo('template_url'); ?>/images/Mclilister.jpg" alt="pictures of students with camera">
          </a>
        </div>

        <!--<div class="carousel-caption">
          <h3>
            <a href="#"> Mid-American Gardener: Thursdays at 7 pm </a>
          </h3>

          <div class="hidden-xs hidden-sm">
            <p><span class="contrast">Watch the latest episodes.</span></p>
          </div>
        </div>
        
      </div>-->
      
    </div>
  </div>
  
</section>


<div class="col-sm-1"></div>
	<?php endif; ?>
     