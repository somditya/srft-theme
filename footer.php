<?php 

$current_language = get_locale();
?>
<div class="footer_container">
  <div class="footer_inner_container">
    <div class="footer_sub">
      <ul>
        <li><img src="https://srfti.ac.in/wp-content/themes/SRFTI-responsivetheme/images/Srfti_logo.png" title="Logo of SRFTI" alt="Logo of SRFTI" style="padding: 10px"></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3><?php echo __('Satyajit Ray Film & Television Institute', 'srft-theme'); ?></h3>
      <ul>
        <li><?php echo __('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?></li>
        <li><?php echo __('Kolkata-700094', 'srft-theme'); ?></li>
        <li><?php echo __('West Bengal', 'srft-theme'); ?></li>
        <li><?php echo __('Phone:', 'srft-theme'); ?> 91-33-2432-8355, 2432-8356, 2432-9300</li>
        <li><?php echo __('Email:', 'srft-theme'); ?> contact@srfti.ac.in</li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3><?php echo __('Related Links:', 'srft-theme'); ?></h3>
      <ul>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/course-overview/' : '/सनम-म-सनतकततर-करयकरम/')); ?>" aria-label="<?php echo esc_attr(__('Admission', 'srft-theme')); ?>"><?php echo __('Admission', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/library/' : '/पुस्तकालय/')); ?>" aria-label="<?php echo esc_attr(__('Library', 'srft-theme')); ?>"><?php echo __('Library', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/important-committees/' : '/महत्वपूर्ण-समितियाँ/')); ?>" aria-label="<?php echo esc_attr(__('Important Committees', 'srft-theme')); ?>"><?php echo __('Important Committees', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/itec-programme/' : '/भारतीय-तकनीकी-और-आर्थिक-स-2/')); ?>" aria-label="<?php echo esc_attr(__('Itec Programme', 'srft-theme')); ?>"><?php echo __('Itec Programme', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/rti/' : '/सूचना-का-अधिकार/')); ?>" aria-label="<?php echo esc_attr(__('Right to Information', 'srft-theme')); ?>"><?php echo __('Right to Information', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/citizen-charter/' : '/नगरक-अधकर-पतर/')); ?>" aria-label="<?php echo esc_attr(__('Citizen Charter', 'srft-theme')); ?>"><?php echo __('Citizen Charter', 'srft-theme'); ?></a></li>
        <li><?php echo __('Telephone Directory', 'srft-theme'); ?></li>
        <li><?php echo __('Holiday List', 'srft-theme'); ?></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3><?php echo __('Useful Links', 'srft-theme'); ?></h3>
      <ul>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/site-map/' : '/साइट-मानचित्र/')); ?>" title="link to site map" role="link"><?php echo __('Sitemap', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/feedback/' : '/प्रतिक्रिया/')); ?>" title="link to feedback" role="link"><?php echo __('Feedback', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/frequently-asked-question/' : '/अक्सर-पूछे-जाने-वाले-प्रश/')); ?>" title="link to faq" role="link"><?php echo __('Frequently Asked Questions', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/help/' : '/सहयत/')); ?>" role="link" title="link to help"><?php echo __('Help', 'srft-theme'); ?></a></li>
        <li><a href="<?php echo esc_url(site_url($current_language === 'en_US' ? '/website-policies/' : '/वेबसाइट-नीतियाँ/')); ?>" role="link" title="link to website policy"><?php echo __('Website Policy', 'srft-theme'); ?></a></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h3><?php echo __('Follow Us', 'srft-theme'); ?></h3>
      <ul class="social">
        <li><a href="https://facebook.com/srftikol" target="_blank" role="link" title="<?php echo __('Follow Us on Facebook - This Link opens in a new window', 'srft-theme'); ?>" onclick="return check_url();"><i class="fa-brands fa-facebook footer_icon"></i></a></li>
        <li><a href="https://instagram.com/srfti_official/" target="_blank" role="link" aria-label="<?php echo __('Follow Us on Instagram - This Link opens in a new window', 'srft-theme'); ?>" onclick="return check_url();"><i class="fa-brands fa-instagram footer_icon"></i></a></li>
        <li><a href="https://www.twitter.com/srfti_official" target="_blank" role="link" aria-label="<?php echo __('Follow Us on Twitter - This Link opens in a new window', 'srft-theme'); ?>" onclick="return check_url();"><i class="fa-brands fa-twitter footer_icon"></i></a></li>
        <li><a href="https://vimeo.com/channels/srftifilms" target="_blank" role="link" aria-label="<?php echo __('Visit Vimeo channel of SRFTI', 'srft-theme'); ?>" onclick="return check_url();"><i class="fab fa-vimeo footer_icon"></i></a></li>
      </ul>
    </div>
    <div class="footer_sub">
      <a href="javascript:void(0);" id="backToTop" aria-label="Back to Top" class="back-to-top"></a>
    </div>
  </div>
</div>

<div class="footer_copyright_container">
<div style="margin: 0;background: #fff;box-shadow: 0px -2px 7px 4px #eee;">
    <div class="branspacer">
        <ul class="brand-list">
        <li><a href="https://www.india.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/india_gov.png" alt="India Government Portal"></a></li>
        <li><a href="https://www.digitalindia.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/digital-india-flogo.png" alt="Digital India"></a></li>
        <li><a href="https://mygov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/mygov.png" alt="MyGov Portal"></a></li>
        <li><a href="https://mib.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/mib-logo.png" alt="Ministry of Information and Broadcasting"></a></li>
        <li><a href="https://swachhbharatmission.ddws.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/swachhta.png" alt="Swachh Bharat Mission"></a></li>
        <li><a href="https://www.eci.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/eci-logo.jpg" alt="Election Commission of India"></a></li>       
          </ul>
    </div>
</div>

<div style="margin: 10px;"> 
<?php echo __('Designed, Developed & Maintained  by Satyajit Ray Film & Television Institute', 'srft-theme'); ?>
</div>
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
    onInitialized: function() {
      // Add aria-labels to navigation buttons after initialization
      $(".owl-prev").attr("aria-label", "Previous Slide");
      $(".owl-next").attr("aria-label", "Next Slide");
    },
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
    onInitialized: function() {
      // Add aria-labels to navigation buttons after initialization
      $(".owl-prev").attr("aria-label", "Previous Slide");
      $(".owl-next").attr("aria-label", "Next Slide");
    },
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
