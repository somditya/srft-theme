/*$(window).on("load", function () {
  $(
    ".is-form-style.is-form-style-3 input.is-search-input, " +
      ".is-form-style.is-form-style-3 button.is-search-submit, " +
      ".is-form-style.is-form-style-3 button.is-search-submit .is-search-icon"
  ).css("display", "flex");
});*/

$(window).on("load", function () {
  $(".is-form-style.is-form-style-3").css("display", "flex");
});

$(document).ready(function () {
  // Hide all tab content initially
  $(".tab-content").hide();

  // Function to activate a specific tab
  function activateTab(tabIndex) {
    // Remove active class from all tabs
    $(".phototab label").removeClass("active");

    // Activate the specified tab
    $("#tab" + tabIndex)
      .prop("checked", true)
      .siblings("label")
      .addClass("active");

    // Show the content of the active tab
    $(".tab-content").hide();
    $(".tab-content" + tabIndex).show();
  }

  $(document).ready(function () {
    $(".is-search-submit").attr("title", "Search");
  });

  $(document).ready(function () {
    console.log("I am Hello");
    function removeTypeAttributes() {
      $('style[type="text/css"]').removeAttr("type");
    }

    // Run once on page load
    removeTypeAttributes();

    // Observe the DOM for dynamically added style elements
    new MutationObserver(function () {
      removeTypeAttributes();
    }).observe(document.body, { childList: true, subtree: true });
  });

  document.addEventListener("DOMContentLoaded", function () {
    let recaptchaTextarea = document.getElementById("g-recaptcha-response");
    if (recaptchaTextarea) {
      recaptchaTextarea.setAttribute("aria-label", "reCAPTCHA Response");
      console.log("Hello");
    }
  });

  // News ticker marquee

  $(document).ready(function () {
    $(".news-ticker").AcmeTicker({
      type: "marquee" /*horizontal/horizontal/Marquee/type*/,
      direction: "right" /*up/down/left/right*/,
      speed: 0.05 /*true/false/number*/ /*For vertical/horizontal 600*/ /*For marquee 0.05*/ /*For typewriter 50*/,
      controls: {
        toggle: $(
          ".acme-news-ticker-pause"
        ) /*Can be used for horizontal/horizontal/typewriter*/ /*not work for marquee*/,
      },
    });
  });

  jQuery(document).ready(function ($) {
    // Create an accessible label for the hidden textarea
    $(
      '<label id="recaptcha-label" for="g-recaptcha-response" style="position: absolute; width: 0; height: 0; margin: -1px; padding: 0; border: none; clip: rect(0, 0, 0, 0); overflow: hidden;">reCAPTCHA Response</label>'
    ).insertBefore("#g-recaptcha-response");

    // Associate the label with the hidden textarea using aria-labelledby
    $("#g-recaptcha-response").attr("aria-labelledby", "recaptcha-label");
  });

  // Check if the "tab" parameter exists in the URL
  const urlParams = new URLSearchParams(window.location.search);
  const tabIndex = urlParams.get("tab");

  if (tabIndex) {
    // Activate the tab specified in the URL
    activateTab(tabIndex);
  } else {
    // Default: Activate the tab that is checked
    const defaultTab = $('input[type="radio"]:checked')
      .attr("id")
      .replace("tab", "");
    activateTab(defaultTab);
  }

  // Change tab and content on tab selection
  $('input[type="radio"]').change(function () {
    const activeTab = $(this).attr("id").replace("tab", "");
    activateTab(activeTab);
  });
});

lightbox.option({
  resizeDuration: 200,
  wrapAround: true,
});

$(".static").owlCarousel({
  startPosition: 6,
  items: 6,
  loop: true,
  margin: 10,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: true,
    },
    600: {
      items: 3,
      nav: true,
    },
    1000: {
      items: 4,
      nav: true,
      loop: false,
    },
  },
  autoplay: false,
  autoplayTimeout: 1500,
  autoplayHoverPause: true,
  nav: true,
  navText: [
    "<div class='nav-btn prev-slide' aria-label='Previous slide'></div>",
    "<div class='nav-btn next-slide' aria-label='Next slide'></div>",
  ],
  dots: false,
});

// Add ARIA attributes for better accessibility
$(document).ready(function () {
  // Set ARIA attributes for prev and next buttons
  $(".owl-prev").attr("aria-label", "Previous slide");
  $(".owl-next").attr("aria-label", "Next slide");

  // Add aria-disabled to buttons when they're disabled
  $(".owl-prev.disabled").attr("aria-disabled", "true");
  $(".owl-next.disabled").attr("aria-disabled", "true");
});

$(".nonstatic").owlCarousel({
  items: 8,
  loop: true,
  rewind: true,
  autoplay: true,
  margin: 10,
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: false,
    },
    600: {
      items: 4,
      nav: false,
    },
    1000: {
      items: 8,
      nav: false,
      loop: false,
    },
  },
  autoplayTimeout: 1500,
  autoplayHoverPause: true,
  nav: false,
  /*navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],*/
  dots: true,
});

$(".student").owlCarousel({
  items: 1,
  loop: true,
  margin: 10,
  responsiveClass: true,
  responsive: {
    0: {
      items: 2,
      nav: true,
      loop: true,
    },
    600: {
      items: 2,
      nav: true,
      loop: true,
    },
    1000: {
      items: 2,
      nav: true,
      loop: true,
    },
  },
  autoplay: true,
  autoplayTimeout: 1500,
  autoplayHoverPause: true,
  nav: true,
  navText: [
    "<div class='nav-btn prev-slide'></div>",
    "<div class='nav-btn next-slide'></div>",
  ],
  dots: false,
});

//jQuery(document).ready(function ($) {
//$(".counter").counterUp({
//delay: 10,
//time: 1000,
//});
//});
//
$(document).ready(function () {
  var btn = $("#backToTop");
  $(window).on("scroll", function () {
    if ($(window).scrollTop() > 300) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });
  btn.on("click", function (e) {
    e.preventDefault();
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      "300"
    );
  });
});

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

$(document).ready(function () {
  console.log("Document is ready.");

  // Check for stored dark mode state
  if (localStorage.getItem("darkMode") === "enabled") {
    $("body").addClass("dark-mode");
    console.log("Dark mode is enabled.");
  }

  // Toggle Accessibility Menu
  $("#accessibility-icon").click(function () {
    $("#accessibility-menu").toggleClass("hidden");
    console.log("Menu toggled.");
  });

  // Dark Mode Toggle
  $("#dark-mode").click(function () {
    $("body").removeClass("high-contrast").addClass("dark-mode");
    localStorage.setItem("darkMode", "enabled"); // Store dark mode state
    console.log("Dark mode activated.");
  });

  // High Contrast Mode Toggle
  $("#high-contrast").click(function () {
    $("body").removeClass("dark-mode").addClass("high-contrast");
    localStorage.setItem("darkMode", "disabled"); // Disable dark mode in storage
    console.log("High contrast mode activated.");
  });

  // Reset Font Size
  $("#reset-text").click(function () {
    $("html").css("font-size", "16px"); // Reset to default font size
    console.log("Font size reset to default.");
  });

  // Modal functionality
  $(".single-image").click(function () {
    var t = $(this).attr("src");
    $(".modal-body").html("<img src='" + t + "' class='modal-img'>");
    $("#myModal").show();
  });

  $(".close").click(function () {
    $("#myModal").hide();
  });
});
// Font Size Adjustment

const defaultFontSize = parseFloat($("html").css("font-size")); // Capture the initial root font size
let currentFontSize = defaultFontSize;

$(".increaseFont, .decreaseFont, .normalFont").click(function () {
  var type = $(this).val();

  if (type === "Increase" && currentFontSize < 30) {
    // Maximum limit
    currentFontSize += 1;
  } else if (type === "Decrease" && currentFontSize > 10) {
    // Minimum limit
    currentFontSize -= 1;
  } else if (type === "Normal") {
    currentFontSize = defaultFontSize; // Reset to the original font size
  }

  $("html").css("font-size", currentFontSize + "px"); // Apply the new font size
  console.log("Font size adjusted to:", currentFontSize + "px");
  console.log("Default Font size :", defaultFontSize + "px");
});

// Function to show an alert when an external link is clicked
function check_url() {
  alert("External link that opens in a new window");
  return true; // Allow the link to open
}

// Optional: Ensure the script loads correctly by logging to the console
console.log("script.js loaded");
