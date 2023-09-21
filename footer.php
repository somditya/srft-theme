

<div class="footer_container">
      <div class="footer_inner_container">
        <div class="footer_sub">
          <ul><li><img src="https://srfti.ac.in/wp-content/themes/SRFTI-responsivetheme/images/Srfti_logo.png" title="Logo of SRFTI" alt="Logo of SRFTI" style="padding: 10px"></li></ul> 
        </div>
        <div class="footer_sub"><h3>Satyajit Ray Film & Television Institute</h3>
          <ul>  
          <li>E.M. Bypass Road, Panchasayar</li>
          <li>Kolkata-700094</li>
          <li>West Bengal</li>carausal          <li>Phone: 91-33-2432-8355, 2432-8356, 2432-9300</li>
          <li>email: contact@srfti.ac.in</li>
        </ul>
        </div>
        <div class="footer_sub"><h3>Quick Links</h3>
        <ul>
        <li>Departments</li>
        <li>Admission</li>
        <li>Library</li>
        <li>Important Committes</li>
        <li>Right to Information</li>
        <li>Citizen Charter</li>
        <li>Telephone Directory</li>
      </ul>
      </div>
      <div class="footer_sub"><h3>Site map</h3>
        <ul> 
        <li>E.M. Bypass Road, Panchasayar</li>
        <li>Kolkata-700094</li>
        <li>West Bengal</li>
      </ul>
      </div>
     
      <div class="footer_sub">
        <h3>Follow us</h3>
        <ul class="social">
        <!--<li><a href="https://www.facebook.com/chicagoboothbusiness" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Facebook - This Link Opens in New Window"><img src="images/facebook.svg" alt="facebook"></a></li>
        <li><a href="https://www.instagram.com/chicagobooth/" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Instagram - This Link Opens in New Window"><img src="images/instagram.svg" alt="Instagram"></a></li>
        <li><a href="https://twitter.com/ChicagoBooth" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Twitter - This Link Opens in New Window"><img src="images/twitter.svg" alt="Twitter"></a></li>
        <li><a href="https://www.youtube.com/user/ChicagoBoothMBA" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on YouTube - This Link Opens in New Window"><img src="images/youTube.svg" alt="Youtube"></a></li>
        -->  
        <li><a href="https://www.facebook.com/chicagoboothbusiness" ><i class="fa fa-facebook footer_icon"></i></a></li>
        <li><a href="https://www.instagram.com/chicagobooth/" ><i class="fa fa-instagram footer_icon"></i></a></li>
        <li><a href="https://twitter.com/ChicagoBooth" ><i class="fa fa-twitter footer_icon"></i></a></li>
        <li><a href="https://www.youtube.com/user/ChicagoBoothMBA" ><i class="fa fa-youtube footer_icon"></i></a></li>
        
      </ul>
      </div>
      <div class="footer_sub">
        
        <a href="javascript:void(0);" id="backToTop" class="back-to-top"></a>
          <!--<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100.66 100.71" style="transform: rotate(-90deg);"><defs><style>.cls-1-arrow-big{fill:none;stroke:white;stroke-miterlimit:10}</style></defs><g id="Calque_2" data-name="Calque 2"><g id="Calque_1-2" data-name="Calque 1"><path class="cls-1-arrow-big" d="M100 50.35H0m50-50l49.91 50-50 50M99.94 50.35H0"></path><path class="cls-1-arrow-big" d="M49.97.35l49.97 50-49.97 50"></path></g></g></svg></a></li>-->

             
      </div>
      </div>
      
        <!--<div class="brand-spacer" style=" justify-content: center; ">
          <div class="logo-wrapper">
            <a><img class="logo-gov" src="images/g20-logo.png"/></a>
          </div>
          <div class="logo-wrapper">
            <a><img class="logo-gov" src="images/logo-azadi.png"/></a>
          </div>
          <div class="logo-wrapper">
            <a><img class="logo-gov" src="images/digitalindia.webp"/></a>
          </div>
          <div class="logo-wrapper">
            <a><img class="logo-gov" src="images/india-gov-logo.png"/></a>
          </div>
        </div>-->
    </div>
    <div class="footer_copyright_container">©2023 Satyajit Ray Film & Television Institute</div>
		<script src="<?php bloginfo('template_url'); ?>/script/jquery.counterup.js"></script>
    <script src="<?php bloginfo('template_url'); ?>/script/jquery.waypoints.js"></script>
    <script>
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
   </script>
  

  <script type="text/javascript">
    $('.static').owlCarousel({
    items:4,
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:4,
            nav:true,
            loop:false
        }
    },
    autoplay:false,
    autoplayTimeout:1500,
    autoplayHoverPause:true,
    nav:true,
    navText : ["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
    dots:false,
    });

    $('.nonstatic').owlCarousel({
    items:8,
    loop:true,
    rewind: true,
    autoplay: true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false
        },
        600:{
            items:4,
            nav:false
        },
        1000:{
            items:8,
            nav:false,
            loop:false
        }
    },
    autoplayTimeout:1500,
    autoplayHoverPause:true,
    nav:false,
    /*navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],*/
    dots:true,
    });

  </script>

<script>
  jQuery(document).ready(function($) {
      $('.counter').counterUp({
          delay: 10,
          time: 1000
      });
  });
</script>
<script>
$(document).ready(function(){
    var btn = $('#backToTop');
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 300) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '300');
    });
});
</script>

<script>
  var swiper = new Swiper(".home-slider", {
    autoplay: 500,
    speed: 600,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      type: "bullets",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },


    keyboard: true,
  });
</script>



</body>


</html>
