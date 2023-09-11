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
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	  <link href='http://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
    <link href="https://fonts.cdnfonts.com/css/helmet" rel="stylesheet">
                
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
              <h2>An autonomous body under ministry of information & broadcasting Govt of India</h2>
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
            <div class="swipper-subtitle"><h2>An autonomous body under ministry of information & broadcasting Govt of India</h2></div>
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
          <div class="swipper-subtitle"><h2>An autonomous body under ministry of information & broadcasting Govt of India</h2></div>
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
          <div class="swipper-subtitle"><h2>An autonomous body under ministry of information & broadcasting Govt of India</h2></div>
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
             <li><a>webmail &nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></a></li>
             <!--<li><a>govmail</a></li>-->
             <li><a>ehrms</a></li>
             <li><a>हिन्दी &nbsp;<i class="fa-solid fa-language" aria-hidden="true"></i></a></li>
             <li><a>+A</a>&nbsp;<a>A</a>&nbsp;<a>A-</a></li>
             <li><a>Screen Reader</a></li>
             <li><a>Skip to main content</a></li>
             <li><a>Contact Us</a></li>
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
          <h3 class="logo_frame">SRFTI</span></h3>
        </div>

        <div class="menu-btn">
          <div class="nav-links">
            <ul>
              <li class="nav-link" style="--i: 0.6s">
                <a href="#"><i class="fa fa-home" aria-hidden="true"></i></a>
              </li>
              <li class="nav-link" style="--i: 1.1s">
                <a href="#">About <i class="fas fa-chevron-down" style="margin-left:10px;"></i></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="#">History</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Leadership</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Management</a>
                    </li>
                   
                    <li class="dropdown-link">
                      <a href="#">Campus</a>
                    </li>
                    <div class="arrow"></div>
                  </ul>
                </div>
              </li>
              <li class="nav-link" style="--i: 1.1s">
                <a href="#">Academics<i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="#">Post Graduate Programmes</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Certficate Programmes</a>
                    </li>
                   
                    <li class="dropdown-link">
                      <a href="#">Faculty</a>
                    </li>
                    <div class="arrow"></div>
                  </ul>
                </div>
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#">Admission<i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="#">Course Overview</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Essental Qualification</a>
                    </li>
                   
                    <li class="dropdown-link">
                      <a href="#">Admission Process</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">International students</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Fee Structure</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Previous Year Papers</a>
                    </li>
                    <div class="arrow"></div>
                  </ul>
                </div>
              
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#">Facilities<i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="#">Library</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Screening facilities</a>
                    </li>
                   
                    <li class="dropdown-link">
                      <a href="#">IT Infrastrure</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">International students</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Accomodation</a>
                    </li>
                    <div class="arrow"></div>
                  </ul>
                </div>
              
              </li>
              <li class="nav-link" style="--i: 1.35s">
                <a href="#">Students<!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
               
              
              </li>
             
              <li class="nav-link" style="--i: 1.35s">
                <a href="#">Resources<i class="fas fa-chevron-down" style="margin-left:10px;"></i></a>
                <div class="dropdown">
                  <ul>
                    <li class="dropdown-link">
                      <a href="#">Committees</a>
                    </li>
                   
                    <li class="dropdown-link">
                      <a href="#">Tenders</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">RTI</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Citizen Charter</a>
                    </li>
                    <li class="dropdown-link">
                      <a href="#">Online Fee deposit</a>
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
