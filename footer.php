<?php 

$current_language = get_locale();
?>
<div class="footer_container" role="contentinfo">
  <div class="footer_inner_container">
    <div class="footer_sub">
      <ul>
        <li><img src="<?php bloginfo('template_url'); ?>/images/Srfti_logo.png" title="Logo of SRFTI" alt="Logo of SRFTI" style="padding: 10px"></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h2><?php echo __('Satyajit Ray Film & Television Institute', 'srft-theme'); ?></h2>
        <p><?php echo __('E.M. Bypass Road, Panchasayar', 'srft-theme'); ?></p>
        <p><?php echo __('Kolkata-700094', 'srft-theme'); ?></p>
        <p><?php echo __('West Bengal', 'srft-theme'); ?></p>
        <p><?php echo __('Phone:', 'srft-theme'); ?> 91-33-2432-8355, 2432-8356, 2432-9300</p>
        <p><?php echo __('email:', 'srft-theme'); ?> contact[at]srfti[dot]ac[dot]in</p>
    </div>
    <div class="footer_sub">
      <h2><?php echo __('Related Links:', 'srft-theme'); ?></h2>
      <ul>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/course-overview/'));}
                    else  { echo esc_url(site_url('/सनम-म-सनतकततर-करयकरम/'));}
                    ?>"><?php echo __('Admission', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/library/'));}
                    else  { echo esc_url(site_url('/पुस्तकालय/'));}
                    ?>"><?php echo __('Library', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/important-committees/'));}
                    else  { echo esc_url(site_url('/महत्वपूर्ण-समितियाँ/'));}
                    ?>"><?php echo __('Important Committees', 'srft-theme'); ?></a></li>
        <li> <a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/itec-programme/'));}
                    else  { echo esc_url(site_url('/भारतीय-तकनीकी-और-आर्थिक-स-2/'));}
                    ?>"><?php echo __('Itec Programme', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/rti/'));}
                    else  { echo esc_url(site_url('/सूचना-का-अधिकार/'));}
                    ?>"><?php echo __('Right to Information', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/citizen-charter/'));}
                    else  { echo esc_url(site_url('/नगरक-अधकर-पतर//'));}
                    ?>"><?php echo __('Citizen Charter', 'srft-theme'); ?></a></li>
                    <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/contact-us/'));}
                    else  { echo esc_url(site_url('/हमसे-संपर्क-करें/'));}
                    ?>"><?php echo __('Contact Us', 'srft-theme'); ?></a></li>
                    <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/Vacancy/'));}
                    else  { echo esc_url(site_url('/रिक्ति/'));}
                    ?>"><?php echo __('Recruitment Notices', 'srft-theme'); ?></a></li>
        <!--<li><a href="#"><?php echo __('Telephone Directory', 'srft-theme'); ?></a></li>-->
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/photo-gallery/'));}
                    else  { echo esc_url(site_url('/फोटो-गैलरी/'));}
                    ?>"><?php echo __('Photo Gallery', 'srft-theme'); ?></a></li>
        <!--<li><a href="#"><?php echo __('Holiday List', 'srft-theme'); ?></a></li>-->
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/downloads/'));}
                    else  { echo esc_url(site_url('/डाउनलोड/'));}
                    ?>"><?php echo __('Download', 'srft-theme'); ?></a></li>
      </ul>
    </div>
    <div class="footer_sub">
      <h2><?php echo __('Useful Links', 'srft-theme'); ?></h2>
      <ul>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/site-map/'));}
                    else  { echo esc_url(site_url('/साइट-मानचित्र/'));}
                    ?>"><?php echo __('Sitemap', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/feedback//'));}
                    else  { echo esc_url(site_url('/प्रतिक्रिया/'));}
                    ?>"><?php echo __('Feedback', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/frequently-asked-question/'));}
                    else  { echo esc_url(site_url('/अक्सर-पूछे-जाने-वाले-प्रश/'));}
                    ?>"><?php echo __('Frequently Asked Qusetions', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/help/'));}
                    else  { echo esc_url(site_url('/सहयत/'));}
                    ?>"><?php echo __('Help', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/website-policies/'));}
                    else  { echo esc_url(site_url('/वेबसाइट-नीतियाँ/'));}
                    ?>"><?php echo __('Website Policy', 'srft-theme'); ?></a></li>
        <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/web-information-manager/'));}
                    else  { echo esc_url(site_url('/वेब-सूचना-प्रबंधक/'));}
                    ?>"><?php echo __('Web Information Manager', 'srft-theme'); ?></a></li>
                    <li><a href="<?php if ($current_language === 'en_US') {echo esc_url(site_url('/directory/'));}
                    else  { echo esc_url(site_url('/निर्देशिका/'));}
                    ?>"><?php echo __('Directory', 'srft-theme'); ?></a></li>
        <!--<li><?php echo __('Archives', 'srft-theme'); ?></li>-->
        <!--<li><?php echo __('Grievance Redressal', 'srft-theme'); ?></li>-->
      </ul>
    </div>
    <div class="footer_sub">
      <h2><?php echo __('Follow us', 'srft-theme'); ?></h2>
      <ul class="social">
        <!--<li><a href="https://www.facebook.com/chicagoboothbusiness" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Facebook - This Link Opens in New Window"><img src="images/facebook.svg" alt="facebook"></a></li>
        <li><a href="https://www.instagram.com/chicagobooth/" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Instagram - This Link Opens in New Window"><img src="images/instagram.svg" alt="Instagram"></a></li>
        <li><a href="https://twitter.com/ChicagoBooth" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on Twitter - This Link Opens in New Window"><img src="images/twitter.svg" alt="Twitter"></a></li>
        <li><a href="https://www.youtube.com/user/ChicagoBoothMBA" class="icon external" rel="noopener noreferrer" target="_blank" title="Follow Us on YouTube - This Link Opens in New Window"><img src="images/youTube.svg" alt="Youtube"></a></li>
        -->
        <li><a href="https://facebook.com/srftikol" target="_blank"  title="<?php echo __('Follow Us on Facebook - This Link is an external link', 'srft-theme'); ?>" onclick="return check_url();"><i class="fa-brands fa-facebook footer_icon"></i></a></li>
        <li><a href="https://instagram.com/srfti_official/" target="_blank"  aria-label="<?php echo __('Follow Us on Instagram - This Link is an external link', 'srft-theme'); ?>" onclick="return check_url();"><i class="fa-brands fa-instagram footer_icon"></i></a></li>
        <li><a href="https://www.twitter.com/srfti_official" target="_blank"  aria-label="<?php echo __('Follow Us on tweeter - This Link is an external link', 'srft-theme'); ?>" onclick="return check_url();" style="color: white;"><i class="fa-brands fa-x footer_icon"></i></a></li>
        <li><a href="https://vimeo.com/channels/srftifilms" target="_blank"  aria-label="<?php echo __('Visit vimeo channel of SRFTI', 'srft-theme'); ?>" onclick="return check_url();"><i class="fab fa-vimeo footer_icon"></i></a></li>
      </ul>
    </div>
    <div class="show-on-mobile">
      <ul>
        <li><a href="https://www.india.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/indiaportal-1.png" alt="India Government Portal"></a>
      </li>
      <li>
      <a href="https://mib.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/miblogo.png" alt="Ministry of Information and Broadcasting"></a>
    </li>
      </ul>
    </div>

    <div class="footer_sub">
      <a href="javascript:void(0);" id="backToTop" aria-label="Back to Top"  class="back-to-top"></a>
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
        <!--<li><a href="https://mib.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/mib-logo.png" alt="Ministry of Information and Broadcasting"></a></li>-->
        <li><a href="https://swachhbharatmission.ddws.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/swachhta.png" alt="Swachh Bharat Mission"></a></li>
        <li><a href="https://www.eci.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/eci-logo.jpg" alt="Election Commission of India"></a></li>       
        <li><a href="https://www.digilocker.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/digilocker_logo_new.png" alt="DigiLocker Wallet"></a></li>       
        <li><a href="https://uidai.gov.in/en/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/aadhaar_english_logo.svg" alt="Adhaasr Service"></a></li>       
        <li><a href="https://shebox.wcd.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/shebox.png" alt="Shebox portal"></a></li>           
        <li><a href="https://meripehchaan.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/mp_logo_ori.png" alt="National Single Sign-On Service"></a></li>           
        <li><a href="https://www.myscheme.gov.in/" target="_blank" title="External Link that opens in new window" onclick="return check_url();"><img src="<?php bloginfo('template_url'); ?>/images/myscheme-logo-black.jpg" alt="My Scheme National Platform"></a></li>           
      </ul>
    </div>
</div>

<div style="margin: 10px;"> 
<?php echo __('Designed, Developed & Maintained by @2025 Satyajit Ray Film & Television Institute. All rights reserved', 'srft-theme'); ?> <br>
<div>
    <?php echo do_shortcode('[global_latest_date]'); ?>
</div>

</div>
</div>

<!--<script src="<?php bloginfo('template_url'); ?>/script/jquery.counterup.js"></script>
<script src="<?php bloginfo('template_url'); ?>/script/jquery.waypoints.js"></script>-->
<script>
  lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
  })
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const scrollContainer = document.querySelector("[data-scroll-container]");
    const btn = document.getElementById("backToTop");

    // Ensure both elements exist before proceeding
    if (!scrollContainer || !btn) {
      console.error("Required elements not found: scrollContainer or btn.");
      return;
    }

    // Add scroll event listener to the container
    scrollContainer.addEventListener("scroll", function () {
      const scrollY = scrollContainer.scrollTop; // Get the vertical scroll position
      if (scrollY > 300) {
        btn.classList.add("show");
      } else {
        btn.classList.remove("show");
      }
    });

    // Scroll to top on button click
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      scrollContainer.scrollTo({
        top: 0,
        behavior: "smooth",
      });
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
    navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide' ></div>"],
    dots: false,
  }
);

$('.owl-next, .owl-prev').on('keypress', function(e) {
    if (e.which === 13 || e.which === 32) { // 13 is Enter, 32 is Space
      $(this).click(); // Simulate click
    }
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
    dots: false,
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

<!--<script>
  jQuery(document).ready(function ($) {
    $('.counter').counterUp({
      delay: 10,
      time: 1000
    });
  });
</script>-->
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
<!--<script>
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
</script>-->
<script>
   document.addEventListener("DOMContentLoaded", () => {
  function openPicModal(event) {
    const modal = document.getElementById("picModal");
    const modalBody = modal.querySelector(".modal-body");
    const closeBtn = modal.querySelector(".close");
    const liveRegion = document.getElementById("ariaLiveRegion");

    // The button that triggered the modal
    const triggerBtn = event.currentTarget;
    const img = triggerBtn.querySelector("img");

    // Fill modal content
    modalBody.innerHTML = `
      <img src="${img.src}" alt="${img.alt}" style="max-width:100%; height:auto;">
    `;

    // Announce opening
    liveRegion.textContent = `Image dialog opened. Showing ${img.alt}. Press Tab to navigate inside.`;

    // Show modal
    modal.classList.remove("hidden");
    modal.setAttribute("aria-hidden", "false");

    // Move focus to close button
    closeBtn.focus();

    // Collect all focusable elements inside modal
    const focusableSelectors =
      'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])';
    const focusableEls = modal.querySelectorAll(focusableSelectors);
    const firstEl = focusableEls[0];
    const lastEl = focusableEls[focusableEls.length - 1];

    // Focus trap (Tab / Shift+Tab only)
    function trapFocus(e) {
      if (e.key !== "Tab") return;

      if (e.shiftKey) {
        if (document.activeElement === firstEl) {
          e.preventDefault();
          lastEl.focus();
        }
      } else {
        if (document.activeElement === lastEl) {
          e.preventDefault();
          firstEl.focus();
        }
      }
    }

    // Close modal
    function closeModal() {
      modal.classList.add("hidden");
      modal.setAttribute("aria-hidden", "true");
      modalBody.innerHTML = "";

      // Announce closing
      liveRegion.textContent = "Dialog closed. Returning to main content.";

      // Restore focus to trigger button
      triggerBtn.focus();

      // Cleanup listeners
      closeBtn.removeEventListener("click", closeModal);
      document.removeEventListener("keydown", escHandler);
      document.removeEventListener("keydown", trapFocus);
      modal.removeEventListener("click", outsideHandler);
    }

    // Escape key closes
    function escHandler(e) {
      if (e.key === "Escape") {
        closeModal();
      }
    }

    // Clicking outside modal closes
    function outsideHandler(e) {
      if (e.target === modal) {
        closeModal();
      }
    }

    // Attach listeners
    closeBtn.addEventListener("click", closeModal);
    document.addEventListener("keydown", escHandler);
    document.addEventListener("keydown", trapFocus);
    modal.addEventListener("click", outsideHandler);
  }

  // Attach to all gallery buttons
  document.querySelectorAll(".gallery-btn").forEach(btn => {
    btn.addEventListener("click", openPicModal);
  });
});
</script>


<?php wp_footer(); ?>

<script src="<?php bloginfo('template_url'); ?>/script/script.js"></script>
<script src="<?php bloginfo('template_url'); ?>/script/accessibilityscript.js"></script>
</body>
</html>
