<?php
/*
Template Name: Header-Demo
*/
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
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> -->   
    <script src="<?php bloginfo('template_url'); ?>/script/jquery.counterup.js"></script>
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />-->
    <link href="<?php bloginfo('template_url'); ?>/css/lightbox.css" rel="stylesheet" />
    <!--<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.theme.default.min.css" />-->
    <link href="https://fonts.googleapis.com/css2?family=Rozha+One&display=swap" rel="stylesheet">
    <!--<link href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css" rel="stylesheet">-->
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/a11y-slider@latest/dist/a11y-slider.css"/>
    <!--<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>-->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>-->
    <script src="<?php bloginfo('template_url'); ?>/script/jquery-3.7.0.min.js"></script>
    <!--<script src="<?php bloginfo('template_url'); ?>/script/jquery-4.0.0.min.js"></script>-->
    <script src="<?php bloginfo('template_url'); ?>/script/acmeticker.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/lightbox.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a11y-slider@latest/dist/a11y-slider.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>  
    <!--<script src="https://code.jquery.com/jquery-4.0.0.min.js" integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao=" crossorigin="anonymous"></script>-->  
  </head>


<body <?php body_class(); ?> id="top-anchor" tabindex="-1">
  <div id="live-region" aria-live="polite" class="sr-only"></div>
  <header class="sticky" >
         <!--<nav id="nav-wrapper">-->
       <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; padding: 10px 20px; background-color: white;">
        <div style="display: flex; align-items: center; flex-shrink: 0;">
          <div><a href="https://srfti.ac.in" title="Logo of SRFTI"><img class="logo1"  style="height: 8rem;" src="<?php bloginfo('template_url'); ?>/images/SRFTI_Logo_DTBU.jpg" alt="<?php echo __('Logo of SRFTI', 'srft-theme' ); ?>"></a> </div>
					
        </div>
    <div class="top-item">
    <div class="search-box" style="flex-grow: 1; max-width: 500px; margin: 0 20px;">
        <?php echo do_shortcode('[ivory-search id="3166" title="Custom Search Form"]'); ?>
    </div> 
  </div>

  <div class="top-item">
    <a target="_blank" title="3c456855b01bd15e42e99b93982b5c18" class="d-none d-lg-block" href="https://digitalindia.gov.in/"><span class=" lazy-load-image-background blur lazy-load-image-loaded" role="presentation" style="color: transparent; display: inline-block;"><img src="https://www.meity.gov.in/static/uploads/2023/12/3c456855b01bd15e42e99b93982b5c18.svg" alt="3c456855b01bd15e42e99b93982b5c18" class="skillimg img-fluid"></span></a> 
  </div>

 <div class="utility-container" style="display: flex; align-items: center; gap: 15px; flex-shrink: 0;">    
    <div class="top-item" style="padding: 0 5px; display: flex;  line-height: 1; margin: 0;">
             <a href="#skip-to-content" title="Skip to Main Content" aria-label="Skip to main content">
  <span class="skp-to-main" aria-hidden="true">
  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32 " viewBox="0 0 64 64" fill="none" style="display: flex; justify-content: center;">
<path d="M57 10H14.5C13.1739 10 11.9021 10.5268 10.9645 11.4645C10.0268 12.4021 9.5 13.6739 9.5 15V25H14.5V15H57V50H14.5V40H9.5V50C9.5 51.3261 10.0268 52.5979 10.9645 53.5355C11.9021 54.4732 13.1739 55 14.5 55H57C58.3261 55 59.5979 54.4732 60.5355 53.5355C61.4732 52.5979 62 51.3261 62 50V15C62 13.6739 61.4732 12.4021 60.5355 11.4645C59.5979 10.5268 58.3261 10 57 10ZM19.5 40V35H2V30H19.5V25L29.5 32.5L19.5 40ZM52 35H34.5V30H52V35ZM52 25H34.5V20H52V25ZM44.5 45H34.5V40H44.5V45Z" fill="#5D3E00"/>
</svg>
  </span>
  <img class="mobile-icon" src="<?php bloginfo('template_url'); ?>/images/icon-skip-to-main.png" alt="Skip to main content">
</a>
      </div>
          <!--<div class="top-item hide-on-mobile"><a href="https://mibmu-eoffice.railtel.in" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><span class="linktext"><?php echo __('e-office', 'srft-theme' ); ?></span>&nbsp; <i class="fas fa-briefcase" aria-hidden="true"></i></a></div>
          <div class="top-item hide-on-mobile"><a href="http://192.168.1.19/leave/" target="_blank" title="External Intranet Link that opens in new window" onclick="return check_url();"><span class="linktext"><?php echo __('e-leave', 'srft-theme' ); ?></span>&nbsp; <i class="fas fa-calendar-check" aria-hidden="true"></i></a></div>
          <div class="top-item hide-on-mobile"><a href="http://14.139.206.21/roundcube/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><span class="linktext"><?php echo __('webmail', 'srft-theme' ); ?></span> &nbsp;<i class="fa fa-envelope" aria-hidden="true"></i></a></div>-->
             <!--<li><a>govmail</a></li>-->
    <!-- Added flexbox styling to the parent top-item -->
<div class="top-item" style="display: flex; align-items: center; gap: 8px; flex-wrap: nowrap;">
    
    <!-- SVG Icon -->
    <a href="#" title="Choose your language" aria-haspopup="true" tabindex="-1" style="display: flex; align-items: center; text-decoration: none;">
        <span class="language-text">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 64 64" fill="none" style="display: block;">
                <path d="M37.6672 9.95973V31.9997H34.4272V9.95973H31.5071V7.11973H41.8271V9.95973H37.6672ZM22.5871 6.71973C24.6671 6.71973 26.2538 7.23973 27.3471 8.27973C28.4671 9.31973 29.0271 10.6264 29.0271 12.1997C29.0271 13.3464 28.7205 14.3864 28.1071 15.3197C27.5205 16.2264 26.6405 16.9464 25.4671 17.4797C24.2938 18.0131 22.8271 18.3064 21.0671 18.3597L20.8671 15.5597C22.6805 15.5064 23.9605 15.1864 24.7071 14.5997C25.4805 14.0131 25.8671 13.2264 25.8671 12.2397C25.8671 11.2797 25.5471 10.5864 24.9071 10.1597C24.2938 9.73306 23.5738 9.51973 22.7471 9.51973C21.7605 9.51973 20.8671 9.65306 20.0671 9.91973C19.2671 10.1864 18.4138 10.5464 17.5071 10.9997L16.5071 8.23973C17.2005 7.86639 18.0538 7.51973 19.0671 7.19973C20.1071 6.87973 21.2805 6.71973 22.5871 6.71973ZM29.4671 23.2797C29.4671 24.5064 29.1871 25.5331 28.6271 26.3597C28.0671 27.1864 27.3071 27.7997 26.3471 28.1997C25.4138 28.5997 24.3471 28.7997 23.1471 28.7997C21.6271 28.7997 20.2138 28.4264 18.9071 27.6797C17.6271 26.9331 16.4005 25.7464 15.2271 24.1197C14.0805 22.4931 12.9471 20.3731 11.8271 17.7597L14.6671 16.7197C15.4405 18.6131 16.2405 20.2531 17.0671 21.6397C17.9205 22.9997 18.8271 24.0531 19.7871 24.7997C20.7471 25.5197 21.7738 25.8797 22.8671 25.8797C23.8805 25.8797 24.7071 25.6531 25.3471 25.1997C25.9871 24.7197 26.3071 23.9597 26.3071 22.9197C26.3071 21.6397 25.8671 20.5331 24.9871 19.5997C24.1071 18.6664 23.0405 17.8131 21.7871 17.0397L24.1471 16.9197L25.8671 16.5597C26.2405 16.8797 26.6538 17.2664 27.1071 17.7197C27.5605 18.1731 27.9205 18.6264 28.1871 19.0797L28.3872 19.8397C28.7338 20.3464 29.0005 20.8797 29.1871 21.4397C29.3738 21.9997 29.4671 22.6131 29.4671 23.2797ZM30.1071 17.9997C31.3871 17.9997 32.4938 17.9064 33.4272 17.7197C34.3605 17.5064 35.4538 17.1731 36.7071 16.7197V19.5997C35.5605 20.1064 34.5205 20.4397 33.5871 20.5997C32.6805 20.7597 31.6805 20.8397 30.5871 20.8397C30.1871 20.8397 29.7205 20.8131 29.1871 20.7597C28.6538 20.6797 28.1471 20.5997 27.6671 20.5197C27.2138 20.4131 26.8805 20.3197 26.6671 20.2397L24.7871 17.9997L25.0271 17.3997C25.8005 17.5864 26.6138 17.7331 27.4671 17.8397C28.3205 17.9464 29.2005 17.9997 30.1071 17.9997Z" fill="#5D3E00"></path>
                <path d="M52.3467 58.6664L49.136 50.4158H38.5707L35.3973 58.6664H32L42.416 31.8984H45.44L55.8187 58.6664H52.3467ZM48.128 47.4291L45.1413 39.3651C45.0667 39.1659 44.9421 38.8051 44.768 38.2824C44.5939 37.7598 44.4195 37.2246 44.2453 36.6771C44.096 36.1046 43.9715 35.6691 43.872 35.3704C43.6728 36.1419 43.4613 36.9011 43.2373 37.6478C43.0381 38.3696 42.864 38.9419 42.7147 39.3651L39.6907 47.4291H48.128Z" fill="#5D3E00"></path>
            </svg>
        </span>
    </a>
    
    <!-- Combo Box Wrapper -->
    <!-- Removed line breaks inside this container that might interfere with flexbox -->
    <div id="language-switcher" role="region" class="language-switcher" aria-labelledby="language-switcher-label">
        <label id="language-switcher-label" for="lang_choice_1" class="visually-hidden">Language Selection</label>
        <select name="lang_choice_1" id="lang_choice_1" class="pll-switcher-select" style="padding: 4px; font-size: 1rem; border: 1px solid #ccc; border-radius: 4px;">
            <option value="https://srfti.ac.in/header-demo/" lang="en-US" selected="selected" data-lang="{&quot;id&quot;:0,&quot;name&quot;:&quot;English&quot;,&quot;slug&quot;:&quot;en&quot;,&quot;dir&quot;:0}">English</option>
            <option value="https://srfti.ac.in/hi/%e0%a4%98%e0%a4%b0/" lang="hi-IN" data-lang="{&quot;id&quot;:0,&quot;name&quot;:&quot;\u0939\u093f\u0928\u094d\u0926\u0940&quot;,&quot;slug&quot;:&quot;hi&quot;,&quot;dir&quot;:0}">हिन्दी</option>
        </select>
        <script>
            document.getElementById("lang_choice_1").addEventListener("change", function(event) { location.href = event.currentTarget.value; });
        </script>
    </div>

</div>
          
             <!--<li class="hide-on-mobile"><a href="<?php echo esc_url(site_url('/contact-us//')); ?>"><?php echo __('Contact Us', 'srft-theme' ); ?></a></li>-->         
  <div class="top-item">
  <button title="Accessibility options" id="accessibility-icon" aria-label="<?php echo __('Accessibility tool', 'srft-theme' ); ?>">
              <!--<i class="fas fa-universal-access"></i>-->
  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32 " viewBox="0 0 64 64" fill="none" style="display: flex; justify-content: center;">
<path d="M24.2921 29.7656C21.4604 29.7656 18.7402 29.7704 16.0199 29.7608C15.4887 29.7608 14.9503 29.7419 14.4286 29.6565C12.2182 29.296 10.6482 27.4043 10.6672 25.1638C10.6861 22.9779 12.3652 21.041 14.5305 20.7305C14.9977 20.6641 15.4744 20.6451 15.9488 20.6451C26.6163 20.6403 37.2838 20.6356 47.9515 20.6522C48.6534 20.6522 49.3862 20.7091 50.0505 20.9154C52.0307 21.5294 53.2593 23.4166 53.1265 25.491C52.9982 27.4968 51.4521 29.2771 49.4526 29.6256C48.7294 29.7512 47.9798 29.7536 47.2425 29.7584C44.7025 29.7725 42.1601 29.7632 39.3638 29.7632C39.5203 32.2075 39.3779 34.6163 39.8785 36.8827C41.0523 42.1933 42.5465 47.4328 43.8817 52.7077C44.5102 55.1947 43.1987 57.6104 40.8555 58.4072C38.2041 59.308 35.4126 57.7765 34.7414 54.9837C33.8307 51.188 32.9817 47.3757 32.1043 43.5731C32.0686 43.4165 32.0166 43.2648 31.7985 43.1059C31.3595 45.0168 30.9185 46.9301 30.4774 48.8408C30.0126 50.8584 29.5785 52.8832 29.0758 54.8912C28.4046 57.5632 25.9072 59.0613 23.3008 58.4141C20.7893 57.7883 19.2785 55.2325 19.9402 52.6128C21.1403 47.8523 22.2834 43.0752 23.6376 38.3573C24.4439 35.548 24.24 32.7384 24.2921 29.7656ZM31.9929 23.6868C26.6875 23.6868 21.3822 23.6868 16.0745 23.6868C15.7187 23.6868 15.3582 23.6797 15.012 23.7366C14.2341 23.8599 13.7218 24.4573 13.7147 25.1946C13.7076 25.9462 14.1914 26.5318 14.9788 26.6717C15.2966 26.7285 15.6286 26.7237 15.9535 26.7237C18.7093 26.7285 21.4675 26.7096 24.2234 26.7333C25.8219 26.7475 27.195 27.7456 27.2473 29.1704C27.335 31.6219 27.5222 34.1349 27.0977 36.52C26.429 40.2659 25.2906 43.9285 24.3467 47.6272C23.8629 49.5189 23.3483 51.4013 22.881 53.2981C22.613 54.3837 23.1443 55.2563 24.138 55.4885C25.0582 55.7043 25.8859 55.1379 26.1728 54.0923C26.1966 54.0069 26.2037 53.9168 26.2227 53.8315C27.2899 49.1587 28.3523 44.4859 29.4385 39.8176C29.5643 39.2795 29.7374 38.7128 30.0433 38.2672C30.5699 37.5037 31.3761 37.1933 32.3035 37.3664C33.3779 37.5677 34.0062 38.2435 34.2505 39.3032C35.3534 44.1184 36.4633 48.9333 37.571 53.7485C37.5899 53.8339 37.5945 53.9264 37.6158 54.0117C37.8958 55.1211 38.7259 55.7187 39.6697 55.4957C40.6942 55.2539 41.1947 54.3624 40.9054 53.2173C40.1987 50.4365 39.4777 47.6579 38.7521 44.8816C37.4878 40.0477 36.0009 35.2659 36.4419 30.1448C36.6363 27.8712 37.623 26.7285 39.9307 26.7213C42.5678 26.7144 45.2075 26.7213 47.8449 26.7192C48.1411 26.7192 48.4401 26.7237 48.7294 26.6741C49.5974 26.527 50.1334 25.8798 50.0859 25.0785C50.0385 24.2985 49.4907 23.7722 48.6227 23.6963C48.3286 23.6702 48.0297 23.6797 47.7334 23.6797C42.4873 23.6797 37.2411 23.6797 31.9929 23.6797V23.6868Z" fill="#5D3E00"/>
<path d="M31.6523 17.6787C28.1841 17.6715 25.4626 14.9253 25.4796 11.4504C25.4965 8.07201 28.3001 5.3138 31.6982 5.33311C35.0867 5.35482 37.8323 8.13473 37.8251 11.5397C37.8179 14.9519 35.0699 17.6859 31.6523 17.6787ZM34.7339 11.4938C34.7219 9.7974 33.2958 8.4002 31.6041 8.42433C29.9435 8.44844 28.5731 9.83841 28.5707 11.4962C28.5659 13.2313 29.9195 14.5826 31.6547 14.5802C33.395 14.5778 34.7483 13.2216 34.7339 11.4938Z" fill="#5D3E00"/>
</svg>
  </button></div>
      </div>
</div>
              </div>
<!-- Accessibility Menu -->
  <div id="accessibility-menu" class="hidden" role="dialog"
      aria-modal="true" aria-hidden="true"
      tabindex="-1" aria-label="Accessibility Option">
      <fieldset>
          <legend><?php echo __('Text Resize', 'srft-theme' ); ?></legend>
      <div id="font-size-announcement" class="sr-only" role="status" aria-live="polite" aria-atomic="true"></div>
      <div role="group" class="text-resize">
          <button class="increaseFont" type="button" aria-label="Increase Text Size">
    <i class="fas fa-search-plus"></i>
</button>
          <button class="decreaseFont" type="button"   aria-label="Decrease Text Size">
              <i class="fas fa-search-minus"></i>
          </button>
          <button class="normalFont" type="button"   aria-label="Reset">
          <i class="fas fa-sync-alt"></i>
          </button>
      </div>
      </fieldset>  
       <fieldset>
          <legend><?php echo __('Color Adjustment', 'srft-theme' ); ?></legend>
      <div role="group" class="color-adjustment">
          <button type="button" title="Normal View" id="high-contrast" aria-label="Set high contrast">
              <i class="fas fa-adjust"></i>
          </button>
          <button type="button" title="High contrast view" id="dark-mode" aria-label="Set low contrast">
              <i class="fas fa-moon" ></i>F
          </button>
      </div>
    </fieldset> 
      <!--<div class="color-adjustment">
          <h4><?php echo __('Navigation Adjustment', 'srft-theme' ); ?></h4>
          <?php echo __('Screen Reader', 'srft-theme' ); ?>
      </div>-->
  </div>
<style>
    /* This tests the 20px font size only on the main menu items */
    .menu-bar > .nav-link > a {
        font-size: 20px !important; /* !important ensures it overrides any existing theme rules during testing */
    }

   .dropdown-link > a {
        font-size: 18px !important; 
    }
</style>
       <!--</div>-->
       <div class="menu-container">
       <input type="checkbox" id="check" aria-label="Open menu"/>
        <!--<div class="logo-container">
          <div><a href="https://srfti.ac.in" title="Logo of SRFTI"><img class="logo" src="<?php bloginfo('template_url'); ?>/images/SRFTI_Logo_DTBU.jpg" alt="<?php echo __('Logo of SRFTI', 'srft-theme' ); ?>"></a> </div>
					
        </div>-->

        <div class="menu-btn">
        
          <div class="nav-links" >
            <nav class="nav-links" role="navigation" aria-label="SRFTI">
            <ul role="menubar" aria-label="Main Menu" class="menu-bar" >
              <li role="none" class="nav-link" style="--i: 0.6s" >
                <a role="menuitem" tabindex="0" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/home/'));} 
                    else 
                    { echo esc_url(site_url('/घर/'));}
                    ?>" aria-label="Home" >Home</a>
              </li>
              <li role="none" class="nav-link" style="--i: 1.1s">
                <a id="aboutMenuButton"  href="#" aria-haspopup="true" role="menuitem" aria-expanded="false"><?php echo __('Institute', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Institute">
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1" href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/about-the-institute/'));} 
                    else 
                    { echo esc_url(site_url('/संस्थान के बारे में/'));}
                    ?>"><?php echo __('About the Institute', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/leadership/')); }
                    else  { echo esc_url(site_url('/नेतृत्व//'));}
                    ?>"><?php echo __('Our Team', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/management/'));}
                    else  { echo esc_url(site_url('/प्रबंध/'));}
                    ?>"><?php echo __('Our Management', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/organization-chart/'));} 
                     else { echo esc_url(site_url('/संगठन-संरचना/'));}
                      ?>">
                    <?php echo __('Organization Structure', 'srft-theme' ); ?></a>
                    </li>
                    <!--<li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/important-committees/'));}
                    else { echo esc_url(site_url('/महत्वपूर्ण-समितियाँ/'));}
                    ?>"><?php echo __('Important Committees', 'srft-theme' ); ?></a>
                    </li>-->
                   
                    <!--<li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/annual-reports/'));}
                    else { echo esc_url(site_url('/वार्षिक-रिपोर्ट्स/'));}
                    ?>"><?php echo __('Annual Reports', 'srft-theme' ); ?></a>
                    </li>-->
                    <li role="none"  class="dropdown-link">
                    <a role="menuitem"  tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/directory/'));}
                    else { echo esc_url(site_url('/निर्देशिका/'));}
                    ?>"><?php echo __('Directory', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.1s">
                <a role="menuitem" tabindex="0" href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Offerings', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
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
                   
                    <!--<li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php  if ($current_language === 'en_US') { echo esc_url(site_url('/faculty/'));} 
                    else 
                    { echo esc_url(site_url('/संकाय/'));}
                    ?>"><?php echo __('Faculty', 'srft-theme' ); ?></a>
                    </li>-->
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/research/'));}
                      else { echo esc_url(site_url('/गवेषणा/'));}?>"><?php echo __('Research', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/scholarship/'));}
                      else { echo esc_url(site_url('/छात्रवृत्ति/'));}?>"><?php echo __('Scholarship Schemes', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/outreach/'));}
                      else { echo esc_url(site_url('/आउटरीच/'));}?>"><?php echo __('Outreach', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                    <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/tender/'));
                    } else {echo esc_url(site_url('/hi/निविदा/'));
                    } ?>"><?php echo __('Tenders', 'srft-theme' ); ?></a>
                    </li>
                     <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/Vacancy/'));}
                      else  { echo esc_url(site_url('/रिक्ति/'));} ?>"><?php echo __('Recruitment Notices', 'srft-theme' ); ?></a>
                    </li>
                    <!--<div class="arrow"></div>-->
                  </ul>
              </li>
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" tabindex="0"  href="#" aria-haspopup="true"  aria-expanded="false"><?php echo __('Admission', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Admission">
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/course-overview/')); }
                      else { echo esc_url(site_url('/पाठ्यक्रम-का-अवलोकन/'));}
                      ?>"><?php echo __('Master of Fine Arts in SRFTI Kolkata', 'srft-theme' ); ?></a>
                    </li>
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/post-graduate-programmes-at-fti-ar/')); } else  { echo esc_url(site_url('/फलम-और-टलवजन-ससथ-ए-आर/'));}?>"><?php echo __('Master of Fine Arts in FTII Itanagar', 'srft-theme' ); ?></a>
                    </li>
                  </ul>      
              </li>
              
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Facilities', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Facilities">
                    <li role="none" class="dropdown-link">
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
                <a role="menuitem" tabindex="0"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/students/')); }
                else  { echo esc_url(site_url('/छात्र/'));}?>"><?php echo __('Students', 'srft-theme' ); ?><!--<i class="fas fa-chevron-down" style="margin-left:10px;"></i>--></a>
              </li>
             
              <li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" tabindex="0"  href="#" aria-haspopup="true" aria-expanded="false"><?php echo __('Connect', 'srft-theme' ); ?><i class="fa fa-chevron-down" style="margin-left:10px;"></i></a>
                  <ul role="menu" class="dropdown" aria-label="Connect">
                    <li role="none" class="dropdown-link">
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/contact-us/')); }
                else  { echo esc_url(site_url('/हमसे-संपर्क-करें/'));}?>"><?php echo __('Contact Us', 'srft-theme' ); ?></a>
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
                      <a role="menuitem" tabindex="-1"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/student-grievance-redressal-committee/'));} else
                       { echo esc_url(site_url('/छात्र-शिकायत-निवारण-समित/'));} ?>"><?php echo __('Grievance Redressal', 'srft-theme' ); ?></a>
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
              <!--<li role="none" class="nav-link" style="--i: 1.35s">
                <a role="menuitem" tabindex="0"  href="<?php if ($current_language === 'en_US') { echo esc_url(site_url('/contact-us/')); }
                else  { echo esc_url(site_url('/हमसे-संपर्क-करें/'));}?>"><?php echo __('Contact Us', 'srft-theme' ); ?></a>
              </li>-->
            </ul>
          </nav>  
          </div>
        </div>
        <!--<div class="logo-container" style="justify-content: flex-end;">
          <div><a href="https://srfti.ac.in/post-graduate-programmes-at-fti-ar/" title="Logo of FTIII"><img style="height: 6rem;" class="right-logo" src="<?php bloginfo('template_url'); ?>/images/ftiii-logo.jpg" alt="<?php echo __('Logo of FTIII', 'srft-theme' ); ?>"></a> </div>
        </div>-->
        <div class="hamburger-menu-container"> 
          <div class="hamburger-menu">
            <div></div>
          </div>
        </div>
      </div>  
  </header>
  <?php if ( is_page( array(119, 122) ) ) : ?>
<main role="main">    
<h1 class="sr-only">Satyajit Ray Film & Television Institute</h1>

<?php
$carousel_args = [
    'post_type'      => 'banner',
    'posts_per_page' => -1, // or 7 if you want a limit
    'post_status'    => 'publish',
    'meta_key'       => 'banner_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
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
              tabindex="<?php echo ($i === 1) ? '0' : '-1'; ?>"
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
      $carousel_query->rewind_posts(); // REWIND the query instead of reset
      $i = 0;
      while ($carousel_query->have_posts()) : $carousel_query->the_post(); $i++;
        $image = get_field('banner_image');
        $link = function_exists('pll_current_language') && pll_current_language() === 'hi'? get_field('banner_post_link_hindi') : get_field('banner_post_link');
        $alt   = get_field('banner_alt') ?: get_the_title();
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


<div class="col-sm-1"></div>
	<?php endif; ?>
     
