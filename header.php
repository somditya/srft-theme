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
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
	  <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap"
      rel="stylesheet"
    />
    
    <!--<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	  <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
    <link href="https://fonts.cdnfonts.com/css/helmet" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>     -->      
    <script src="https://kit.fontawesome.com/37e9fe1e7c.js" crossorigin="anonymous"></script>
    <link href="https://use.typekit.net/eyn5jyy.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://use.typekit.net/jbg0wxv.css">
    <link href="https://fonts.cdnfonts.com/css/gotham" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    
    <script src="<?php bloginfo('template_url'); ?>/script/jquery.counterup.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href="https://fonts.cdnfonts.com/css/trajan-pro" rel="stylesheet">             
    <link href="<?php bloginfo('template_url'); ?>/css/lightbox.css" rel="stylesheet" />
     <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.css" />
     <link
       rel="stylesheet"
       href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.theme.default.min.css"
     />
     <link href="https://fonts.googleapis.com/css2?family=Rozha+One&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
     <script
       src="https://kit.fontawesome.com/37e9fe1e7c.js"
       crossorigin="anonymous"
     ></script>
     <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
     <script src="<?php bloginfo('template_url'); ?>/script/jquery-3.7.0.min.js"></script>
     <script src="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.js"></script>
     <script src="<?php bloginfo('template_url'); ?>/script/lightbox.js"></script>
                
    <title>Satyajit Ray Film & Television Institute</title>
</head>

<body <?php body_class(); ?>>

<?php if (is_front_page()) : ?>
<div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper home-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide" >
          <div class="slider-bg">
             <picture>
             
             <img  src="<?php bloginfo('template_url'); ?>/images/5.2.jpg" >
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
            
            <img  src="<?php bloginfo('template_url'); ?>/images/GN7A6754.png"  style="object-fit: cover; ">
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
             <img  src="<?php bloginfo('template_url'); ?>/images/DOC03875_1 copy.jpg">
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
            
             <img  src="<?php bloginfo('template_url'); ?>/images/DSC01842 (1).png">
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
         <div>
             <ul style="display:flex;">
             <li><a><?php echo __('webmail', 'srft-theme' ); ?> &nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></a></li>
             <!--<li><a>govmail</a></li>-->
             <li><a><?php echo __('ehrms', 'srft-theme' ); ?></a></li>
             <li><a><i class="fa-solid fa-language" aria-hidden="true"></i><?php if (function_exists('pll_the_languages')) : ?></a></li>
    <div id="language-switcher">
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
<?php endif; ?></li>
             <li><a>+A</a>&nbsp;<a>A</a>&nbsp;<a>A-</a></li>
             <li><a><?php echo __('Screen Reader', 'srft-theme' ); ?></a></li>
             <li><a><?php echo __('Skip to main content', 'srft-theme' ); ?></a></li>
             <li><a><?php echo __('Contact Us', 'srft-theme' ); ?></a></li>
             </ul>         
         </div>
         
      
        
        <div class="form-item form-type-textfield form-item-search-block-form">
          
         <input title="Enter the terms you wish to search for." placeholder="Search..." type="text" id="edit-search-block-form--2" name="search_block_form" value="" size="15" maxlength="128" class="form-text form-autocomplete ui-autocomplete-processed ui-autocomplete-input" data-sa-theme="basic-green" autocomplete="off" role="textbox" aria-autocomplete="list" aria-haspopup="true">
        <ul class="ui-autocomplete ui-menu ui-widget ui-widget-content ui-corner-all" role="listbox" aria-activedescendant="ui-active-menuitem" data-sa-theme="basic-green" style="z-index: 1; top: 0px; left: 0px; display: none;"></ul>
      </div>

       </div>
       <div class="menu-container">
        <input type="checkbox" name="" id="check" />

        <div class="logo-container">
          <div> <a><img class="logo" src="<?php bloginfo('template_url'); ?>/images/srftilogotr.png"></a> </div>
          <h3 class="logo_frame"><?php echo __('SRFTI', 'srft-theme' ); ?></span></h3>
        </div>

        <div class="menu-btn">
          <div class="nav-links">
            <ul class="custom-menu">
              <li class="nav-link" style="--i: 0.6s">
                <a href="#"><i class="fa fa-home" aria-hidden="true"></i></a>
              </li>
              <li class="nav-link" style="--i: 1.1s">
                <a href="<a href="<?php echo esc_url(site_url('/about-the-institute/')); ?>"><?php echo __('About', 'srft-theme' ); ?><i class="fas fa-chevron-down" style="margin-left:10px;"></i></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/about-the-institute/')); ?>"><?php echo __('About', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/leadership/')); ?>"><?php echo __('Leadership', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/management/')); ?>"><?php echo __('Management', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/organization-chart/')); ?>"><?php echo __('Organization Structure', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/important-committees/')); ?>"><?php echo __('Important Committees', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/annual-reports//')); ?>"><?php echo __('Annual Reports', 'srft-theme' ); ?></a>
                    </li>
                    <div class="arrow"></div>
                  </ul>
                </div>
              </li>
              <li class="nav-link" style="--i: 1.1s">
                <a href="#"><?php echo __('Academics', 'srft-theme' ); ?><i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/post-graduate-programme-in-cinema/')); ?>"><?php echo __('Post Graduate Programme in Cinema', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php echo esc_url(site_url('/post-graduate-programme-in-edm/')); ?>"><?php echo __('Post Graduate Programme in EDM', 'srft-theme' ); ?></a>
                    </li>
                    <!--<li class="dropdown-link">
                      <a href="#"><?php echo __('Certficate Programmes', 'srft-theme' ); ?></a>
                    </li>-->
                   
                    <li class="dropdown-link">
                      <a href="<?php echo esc_url(site_url('/faculty/')); ?>"><?php echo __('Faculty', 'srft-theme' ); ?></a>
                    </li>
                    <div class="arrow"></div>
                  </ul>
                </div>
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#"><?php echo __('Admission', 'srft-theme' ); ?><i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="<?php echo esc_url(site_url('/course-overview/')); ?>"><?php echo __('Post graduate programmes', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="<?php echo esc_url(site_url('/short-prorammes/')); ?>"><?php echo __('Short programmes', 'srft-theme' ); ?></a>
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
                    <div class="arrow"></div>
                  </ul>
                </div>
              
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#"><?php echo __('Facilities', 'srft-theme' ); ?><i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/library/')); ?>"><?php echo __('Library', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/screening-facility/')); ?>"><?php echo __('Screening facilities', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/accomodation/')); ?>"><?php echo __('IT Infrastrure', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/admission-to-short-courses/')); ?>"><?php echo __('International students', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/short-courses/')); ?>"><?php echo __('Accomodation', 'srft-theme' ); ?></a>
                    </li>
                    <div class="arrow"></div>
                  </ul>
                </div>
              
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#"><?php echo __('Students', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
               
              
              </li>
             
              <li class="nav-link" style="--i: 1.35s">
                <a href="#"><?php echo __('Resources', 'srft-theme' ); ?><i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="<?php echo esc_url(site_url('/Vacancy/')); ?>"><?php echo __('vacancy', 'srft-theme' ); ?></a>
                    </li>
                   
                    <li class="dropdown-link">
                    <a href="<?php echo esc_url(site_url('/tender/')); ?>"><?php echo __('Tenders', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#"><?php echo __('RTI', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#"><?php echo __('Citizen Charter', 'srft-theme' ); ?></a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#"><?php echo __('Online Fee deposit', 'srft-theme' ); ?></a>
                    </li>
                    
                    <div class="arrow"></div>
                  </ul>
                </div>
              
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
