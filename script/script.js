lightbox.option({
  resizeDuration: 200,
  wrapAround: true,
});

$(".static").owlCarousel({
  items: 4,
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
    "<div class='nav-btn prev-slide'></div>",
    "<div class='nav-btn next-slide'></div>",
  ],
  dots: false,
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

jQuery(document).ready(function ($) {
  $(".counter").counterUp({
    delay: 10,
    time: 1000,
  });
});

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
  $(".single-image").click(function () {
    var t = $(this).attr("src");
    $(".modal-body").html("<img src='" + t + "' class='modal-img'>");
    $("#myModal").show();
  });

  $(".close").click(function () {
    $("#myModal").hide();
  });
});

// Toggle Accessibility Menu
document
  .getElementById("accessibility-icon")
  .addEventListener("click", function () {
    const menu = document.getElementById("accessibility-menu");
    menu.classList.toggle("hidden");
  });

// Text Resize Functions
// Initial scaling factor
let scaleFactor = 1;

// Apply scaling factor to the body
function applyScale() {
  document.body.style.transform = `scale(${scaleFactor})`;
  document.body.style.transformOrigin = "0 0"; // Ensures scaling from the top-left corner
}

// Increase text size
document.getElementById("increase-text").addEventListener("click", function () {
  if (scaleFactor < 1.5) {
    // Adjust maximum scale as needed
    scaleFactor += 0.1;
    applyScale();
  }
});

// Decrease text size
document.getElementById("decrease-text").addEventListener("click", function () {
  if (scaleFactor > 0.5) {
    // Adjust minimum scale as needed
    scaleFactor -= 0.1;
    applyScale();
  }
});

// Reset text size
document.getElementById("reset-text").addEventListener("click", function () {
  scaleFactor = 1; // Reset scale factor to 1
  applyScale();
});

// Color Adjustment Functions
document.getElementById("high-contrast").addEventListener("click", function () {
  document.body.classList.remove("dark-mode");
  document.body.classList.add("high-contrast");
});

document.getElementById("dark-mode").addEventListener("click", function () {
  document.body.classList.remove("high-contrast");
  document.body.classList.add("dark-mode");
});
