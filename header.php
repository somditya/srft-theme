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
</head>


<body <?php body_class(); ?>>

<?php if (is_front_page()) : ?>
<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper home-slider">
      <div class="swiper-wrapper">
        
      <div class="swiper-slide" >
          <div class="slider-bg">
             <picture>
             <img  src="<?php bloginfo('template_url'); ?>/images/5.1.jpg" alt="picture of satyajit ray in SRFTI" >
           </picture>
         </div>
          <div class="swipper-title">
            <h3>सत्यजित रे फिल्म एवं टेलीविज़न संस्थान, कोलकाता</h3>
            <h1 >Satyajit Ray Film & Television Institute </h1>
            <div class="swipper-subtitle">
              <h2><?php echo __('An Academic Institute under Ministry of Information & Broadcasting, Govt of India', 'srft-theme' ); ?></h2>
            </div>
          </div>
         </div>
      
        <div class="swiper-slide" >
          <div class="slider-bg">
             <picture>
             
             <img  src="<?php bloginfo('template_url'); ?>/images/5.2.jpg" alt="picture of student's production in set" >
           </picture>
         </div>
           <div class="swipper-title">
            <h3>सत्यजित रे फिल्म एवं टेलीविज़न संस्थान, कोलकाता</h3>
            <h1>Satyajit Ray Film & Television Institute </h1>
            <div class="swipper-subtitle">
              <h2><?php echo __('An Academic Institute under Ministry of Information & Broadcasting, Govt of India', 'srft-theme' ); ?></h2>
            </div>
          </div>
          
         </div>
        <div class="swiper-slide" >
          <div class="slider-bg">
            <picture>
            <img  src="<?php bloginfo('template_url'); ?>/images/GN7A6754.png"  style="object-fit: cover; " alt="picture of animation masterclass">
          </picture>
        </div>
          <div class="swipper-title">
            <h3>सत्यजित रे फिल्म एवं टेलीविज़न संस्थान, कोलकाता</h3>
            <h1>Satyajit Ray Film & Television Institute</h1>
            <div class="swipper-subtitle"><h2><?php echo __('An Academic Institute under Ministry of Information & Broadcasting, Govt of India', 'srft-theme' ); ?></h2></div>
          </div>
          
         
        </div>
        
        <div class="swiper-slide" >
          <div class="slider-bg">
             <picture>
             <img src="<?php bloginfo('template_url'); ?>/images/livemusicex.jpg" alt="picture of student's live music exercise">
           </picture>
         </div>
         <div class="swipper-title">
          <h3>सत्यजित रे फिल्म एवं टेलीविज़न संस्थान, कोलकाता</h3>
          <h1>Satyajit Ray Film & Television Institute</h1>
          <div class="swipper-subtitle"><h2><?php echo __('An Academic Institute under Ministry of Information & Broadcasting, Govt of India', 'srft-theme' ); ?></h2></div>
        </div>
          
         </div>
         <div class="swiper-slide" >
          <div class="slider-bg">
             <picture>
            
             <img  src="<?php bloginfo('template_url'); ?>/images/practicecam.png" alt="pictures of students with camera">
           </picture>
         </div>
         <div class="swipper-title">
          <h3>सत्यजित रे फिल्म एवं टेलीविज़न संस्थान, कोलकाता</h3>
          <h1>Satyajit Ray Film & Television Institute</h1>
          <div class="swipper-subtitle"><h2><?php echo __('An Academic Institute under Ministry of Information & Broadcasting, Govt of India', 'srft-theme' ); ?></h2></div>
        </div>
          
         </div>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
		<?php endif; ?>
    <header class="sticky" >
   
      <!--<nav id="nav-wrapper">-->
       <div class="top_header">
         <div>
           <ul style="display:flex;">
           <li></li>
           </ul>         
          </div>
          <ul style="display:flex; align-items: center; ">
            <li class="hide-on-mobile"><a href="http://webmail.srfti.ac.in" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><?php echo __('webmail', 'srft-theme' ); ?> &nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></a></li>
             <!--<li><a>govmail</a></li>-->
             <!--<li class="hide-on-mobile"><a><?php echo __('ehrms', 'srft-theme' ); ?></a></li>-->
            <li>
            <a href="#" aria-haspopup="true" aria-expanded="false">
            <i class="fa-solid fa-language" aria-hidden="true"></i>
              <?php if (function_exists('pll_the_languages')) : ?>
            <span class="language-text"><?php echo __('Language', 'srft-theme' ); ?></span>
            <?php endif; ?>
          </a>
    <div id="language-switcher" class="language-switcher" aria-label="Language Selection">
    <label for="lang_choice_1" class="visually-hidden">Language Selection</label>
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


             <li><a href="#skip-to-content"><span class="skp-to-main"><?php echo __('Skip to main content', 'srft-theme' ); ?></span>
             <img class="mobile-icon" src="<?php bloginfo('template_url'); ?>/images/icon-skip-to-main.png" alt="Skip to main content icon"></a>
          
             <!--<li class="hide-on-mobile"><a href="<?php echo esc_url(site_url('/contact-us//')); ?>"><?php echo __('Contact Us', 'srft-theme' ); ?></a></li>-->         
             <li><button id="accessibility-icon" aria-label="<?php echo __('Accessibilty tool', 'srft-theme' ); ?>">
              <i class="fas fa-universal-access"></i>
            </button></li>
<li>
<div class="search-box"><?php echo do_shortcode('[ivory-search id="3166" title="Custom Search Form"]'); ?></div> </li>
      </ul>
</div>
<!-- Accessibility Menu -->
<div id="accessibility-menu" class="hidden">
    <div class="text-resize">
        <h4><?php echo __('Text Resize', 'srft-theme' ); ?></h4>
        <button type="button" value=<?php echo __('Increase', 'srft-theme' ); ?> aria-label="Increase Text Size" class="increaseFont">
            <i class="fas fa-search-plus"></i>
        </button>
        <button type="button" value=<?php echo __('Decrease', 'srft-theme' ); ?> aria-label="Decrease Text Size" class="decreaseFont">
            <i class="fas fa-search-minus"></i>
        </button>
        <button type="button" value=<?php echo __('Normal', 'srft-theme' ); ?> aria-label="Normal Text Size" class="normalFont">
        <i class="fas fa-sync-alt"></i>
        </button>
    </div>
    <div class="color-adjustment">
        <h4><?php echo __('Color Adjustment', 'srft-theme' ); ?></h4>
        <button type="button" id="high-contrast" aria-label="Set high contrast">
            <i class="fas fa-adjust"></i>
        </button>
        <button type="button" id="dark-mode" aria-label="Set low contrast">
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
          <div><a><img class="logo" src="<?php bloginfo('template_url'); ?>/images/SRFTI_Logo.png" alt="<?php echo __('Logo of SRFTI', 'srft-theme' ); ?>"></a> </div>
					<!--<video  src="<?php bloginfo('template_url'); ?>/videos/test.mp4"  autoplay="" loop="" muted="muted" controlslist="nodownload" width="200" poster="https://arcurea.in/wp-content/uploads/2022/11/Frame-4.png"></video>-->
				
          <!--<h3 class="logo_frame"><?php echo __('SRFTI', 'srft-theme' ); ?></span></h3>-->
        </div>

        <div class="menu-btn">
          <div class="nav-links">
            <ul class="custom-menu" style="display: flex; align-items: center; justify-content: center;">
              <li class="nav-link" style="--i: 0.6s">
                <a href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/home/'));} 
                    else 
                    { echo esc_url(site_url('/घर/'));}
                    ?>" aria-label="Home" ><i class="fa fa-home" aria-hidden="true"></i><span class="sr-only">Home</span></a>
              </li>
              <li class="nav-link" style="--i: 1.1s">
                <a href="#"><?php echo __('About Us', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                    <a href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/about-the-institute/'));} 
                    else 
                    { echo esc_url(site_url('/संस्थान के बारे में/'));}
                    ?>"><?php echo __('About the Institute', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/leadership/')); }
                    else  { echo esc_url(site_url('/नेतृत्व//'));}
                    ?>"><?php echo __('Leadership', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/management/'));}
                    else  { echo esc_url(site_url('/प्रबंध/'));}
                    ?>"><?php echo __('Management', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/organization-chart/'));} 
                     else { echo esc_url(site_url('/संगठन-संरचना/'));}
                      ?>">
                    <?php echo __('Organization Structure', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/important-committees/'));}
                    else { echo esc_url(site_url('/महत्वपूर्ण-समितियाँ/'));}
                    ?>"><?php echo __('Important Committees', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/annual-reports/'));}
                    else { echo esc_url(site_url('/वार्षिक-रिपोर्ट्स/'));}
                    ?>"><?php echo __('Annual Reports', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
                </div>
              </li>
              <li class="nav-link" style="--i: 1.1s">
                <a href="#"><?php echo __('Academics', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/post-graduate-programme-in-cinema/'));}
                    else  { echo esc_url(site_url('/सनम-म-सनतकततर-करयकरम/'));}                   
                      ?>"><?php echo __('Post Graduate Programme in Cinema', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/post-graduate-programme-in-edm/'));}
                      else  { echo esc_url(site_url('/ईडीएम-में-स्नातकोत्तर-का/'));} ?>"><?php echo __('Post Graduate Programme in EDM', 'srft-theme' ); ?></a>
                    </li>
                    <!--<li class="dropdown-link">
                      <a href="#"><?php echo __('Certficate Programmes', 'srft-theme' ); ?></a>
                    </li>-->
                   
                    <li class="dropdown-link">
                      <a href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/faculty/'));} 
                    else 
                    { echo esc_url(site_url('/संकाय/'));}
                    ?>"><?php echo __('Faculty', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/research/'));}
                      else { echo esc_url(site_url('/गवेषणा/'));}?>"><?php echo __('Research', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/scholarship/'));}
                      else { echo esc_url(site_url('/छात्रवृत्ति/'));}?>"><?php echo __('Scholarship Schemes', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
                </div>
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#"><?php echo __('Admission', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/course-overview/')); }
                      else { echo esc_url(site_url('/पाठ्यक्रम-का-अवलोकन/'));}
                      ?>"><?php echo __('Post graduate programmes', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/post-graduate-programmes-at-fti-ar/')); } else  { echo esc_url(site_url('/फलम-और-टलवजन-ससथ-ए-आर/'));}?>"><?php echo __('Post graduate programmes in FTI AR', 'srft-theme' ); ?></a>
                    </li>
                   
                    <!--<li class="dropdown-link">
                      <a href="#"><?php echo __('Admission Process', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#"><?php echo __('International students', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#"><?php echo __('Fee Structure', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#"><?php echo __('Previous Year Papers', 'srft-theme' ); ?></a>
                    </li>-->
                    <!--<div class="arrow"></div>-->
                  </ul>
                </div>
              
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#"><?php echo __('Facilities', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                    <a href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/library/'));} 
                    else 
                    { echo esc_url(site_url('/पुस्तकालय/'));}
                    ?>"><?php echo __('Library', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/screening-room/'));}
                    else   { echo esc_url(site_url('/स्क्रीनिंग-सुविधाएँ/'));}?>"><?php echo __('Screening facilities', 'srft-theme' ); ?></a>
                    </li>
                   
                    <!--<li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/accommodation/')); ?>"><?php echo __('IT Infrastrure', 'srft-theme' ); ?></a>
                    </li>-->
                    <li class="dropdown-link">
                    <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/accommodation/'));}
                    else  { echo esc_url(site_url('/निवास/'));} ?>"><?php echo __('Accomodation', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
                </div>
              
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/students/')); }
                else  { echo esc_url(site_url('/छात्र/'));}?>"><?php echo __('Students', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
              
              </li>
             
              <li class="nav-link" style="--i: 1.35s">
                <a href="#"><?php echo __('Resources', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/Vacancy/'));}
                      else  { echo esc_url(site_url('/रिक्ति/'));} ?>"><?php echo __('Recruitment Notices', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li class="dropdown-link">
                    <a href="<?php 
if ($current_language === 'en_US') {
    echo esc_url(site_url('/tender/'));
} else {
    echo esc_url(site_url('/hi/निविदा/'));
}
?>"><?php echo __('Tenders', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/rti/')); }
                      else  { echo esc_url(site_url('/सूचना-का-अधिकार/'));} ?>"><?php echo __('RTI', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/citizen-charter/'));} else
                       { echo esc_url(site_url('/नगरक-अधकर-पतर/'));} ?>"><?php echo __('Citizen Charter', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/announcement/'));} else
                       { echo esc_url(site_url('/घोषणा-सूची/'));} ?>"><?php echo __('Circular & Notices', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/news/'));} else
                       { echo esc_url(site_url('/समाचार-सूची/'));} ?>"><?php echo __('News', 'srft-theme' ); ?></a>
                    </li>
                    
                    <!--<div class="arrow"></div>-->
                  </ul>
                </div>
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/contact-us/')); }
                else  { echo esc_url(site_url('/हमसे-संपर्क-करें/'));}?>"><?php echo __('Contact Us', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
              </li>         
            </ul>
          </div>

        </div>
        
        <div class="hamburger-menu-container"> 
          <div class="hamburger-menu">
            <div></div>
          </div>
        </div>
      </div>
       
     </header>