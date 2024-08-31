<div class="footer_container">
  <div class="footer_inner_container">
    <div class="footer_sub">
      <ul>
        <li><img src="https://srfti.ac.in/wp-content/themes/SRFTI-responsivetheme/images/Srfti_logo.png" title="Logo of SRFTI" alt="Logo of SRFTI" style="padding: 10px"></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3>Satyajit Ray Film & Television Institute</h3>
      <ul>
        <li><?php echo __('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?></li>
        <li><?php echo __('Kolkata-700094', 'srft-theme'); ?></li>
        <li><?php echo __('West Bengal', 'srft-theme'); ?></li>
        <li><?php echo __('Phone:', 'srft-theme'); ?>91-33-2432-8355, 2432-8356, 2432-9300</li>
        <li><?php echo __('email:', 'srft-theme'); ?>contact@srfti.ac.in</li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3><?php echo __('Related Links:', 'srft-theme'); ?></h3>
      <ul>
        <li><?php echo __('Admission', 'srft-theme'); ?></li>
        <li><?php echo __('Library', 'srft-theme'); ?></li>
        <li><?php echo __('Important Committes', 'srft-theme'); ?></li>
        <li><?php echo __('Convocation', 'srft-theme'); ?></li>
        <li><?php echo __('Clapstick', 'srft-theme'); ?></li>
        <li><?php echo __('Right to Information', 'srft-theme'); ?></li>
        <li><?php echo __('Citizen Charter', 'srft-theme'); ?></li>
        <li><?php echo __('Telephone Directory', 'srft-theme'); ?></li>
        <li><?php echo __('Holiday List', 'srft-theme'); ?></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3>Useful Links</h3>
      <ul>
        <li><?php echo __('Sitemap', 'srft-theme'); ?></li>
        <li><?php echo __('Frequently Asked Qusetions', 'srft-theme'); ?></li>
        <li><?php echo __('Feedback', 'srft-theme'); ?></li>
        <li><?php echo __('Archives', 'srft-theme'); ?></li>
        <li><?php echo __('Gallery', 'srft-theme'); ?></li>
        <li><?php echo __('Grievance Redressal', 'srft-theme'); ?></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3><?php echo __('Follow us', 'srft-theme'); ?></h3>
      <ul class="social">
        <!--<li><a href="https://www.facebook.com/chicagoboothbusiness" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Facebook - This Link Opens in New Window"><img src="images/facebook.svg" alt="facebook"></a></li>
        <li><a href="https://www.instagram.com/chicagobooth/" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Instagram - This Link Opens in New Window"><img src="images/instagram.svg" alt="Instagram"></a></li>
        <li><a href="https://twitter.com/ChicagoBooth" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Twitter - This Link Opens in New Window"><img src="images/twitter.svg" alt="Twitter"></a></li>
        <li><a href="https://www.youtube.com/user/ChicagoBoothMBA" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on YouTube - This Link Opens in New Window"><img src="images/youTube.svg" alt="Youtube"></a></li>
        -->
        <li><a href="https://facebook.com/srftikol"><i class="fa-brands fa-facebook footer_icon"></i></a></li>
        <li><a href="https://instagram.com/srfti_official/"><i class="fa-brands fa-instagram footer_icon"></i></a></li>
        <li><a href="https://www.twitter.com/srfti_official" style="color: white;"><i class="fa-brands fa-x footer_icon"></i></a></li>
        <li><a href="https://youtube.com/channel/UCcyt3kW5zADnei6dDYyU98A/"><i class="fa-brands fa-youtube footer_icon"></i></a></li>
      </ul>
    </div>
    <div class="footer_sub">
      <a href="javascript:void(0);" id="backToTop" class="back-to-top"></a>
    </div>
  </div>

  <div class="brand-spacer" style=" justify-content: center; ">
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
  </div>
</div>
<div class="footer_copyright_container">
    <p class="copyright-text">©2024&nbsp;<?php echo __('Satyajit Ray Film & Television Institute', 'srft-theme'); ?></p>
    <p class="last-updated"><?php echo do_shortcode('[last_updated]'); ?></p>
</div>

</div>

<script src="<?php bloginfo('template_url'); ?>/script/jquery.counterup.js"></script>
<script src="<?php bloginfo('template_url'); ?>/script/jquery.waypoints.js"></script>
<script>
  lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
  })
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const scroll = new LocomotiveScroll({
      el: document.querySelector("[data-scroll-container]"),
      smooth: true
    });

    var btn = $('#backToTop');

    scroll.on('scroll', function(instance) {
      if (instance.scroll.y > 300) {
        btn.addClass('show');
      } else {
        btn.removeClass('show');
      }
    });

    btn.on('click', function (e) {
      e.preventDefault();
      scroll.scrollTo('top');
    });
  });
</script>

<script>
  $('.static').owlCarousel({
    items: 4,
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 3,
        nav: true
      },
      1000: {
        items: 4,
        nav: true,
        loop: false
      }
    },
    autoplay: false,
    autoplayTimeout: 1500,
    autoplayHoverPause: true,
    nav: true,
    navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
    dots: false,
  });

  $('.nonstatic').owlCarousel({
    items: 8,
    loop: true,
    rewind: true,
    autoplay: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        nav: false
      },
      600: {
        items: 4,
        nav: false
      },
      1000: {
        items: 8,
        nav: false,
        loop: false
      }
    },
    autoplayTimeout: 1500,
    autoplayHoverPause: true,
    nav: false,
    dots: true,
  });

  $('.student').owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
      0: {
        items: 2,
        nav: true,
        loop: true
      },
      600: {
        items: 2,
        nav: true,
        loop: true
      },
      1000: {
        items: 2,
        nav: true,
        loop: true
      }
    },
    autoplay: true,
    autoplayTimeout: 1500,
    autoplayHoverPause: true,
    nav: true,
    navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
    dots: false,
  });
</script>

<script>
  jQuery(document).ready(function ($) {
    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });
  });
</script>
<script>
  var swiper = new Swiper(".home-slider", {
    autoplay:{delay: 3500,
    speed: 100,
    loop: true,
    },
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
<script>
  $(document).ready(function () {
    $(".single-image").click(function () {
      var t = $(this).attr("src");
      $(".modal-body").html("<img src='" + t + "' class='modal-img'>");
      $("#myModal").show();
    });

    $(".close").click(function () {
      $("#myModal").hide();
    });
  });
</script>

<?php wp_footer(); ?>

<script src="<?php bloginfo('template_url'); ?>/script/script.js"></script>

</body>
</html>
