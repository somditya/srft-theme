/*$(window).on("load", function () {
  $(
    ".is-form-style.is-form-style-3 input.is-search-input, " +
      ".is-form-style.is-form-style-3 button.is-search-submit, " +
      ".is-form-style.is-form-style-3 button.is-search-submit .is-search-icon"
  ).css("display", "flex");

const modal = document.getElementById("myModal");
const modalBody = modal.querySelector(".modal-body");
const closeButton = modal.querySelector(".close");
let lastFocusedElement = null;

// Trigger modal on image click
document.querySelectorAll(".single-image").forEach((img, index) => {
  img.addEventListener("click", () => {
    lastFocusedElement = document.activeElement;

    const src = img.getAttribute("src");
    const alt = img.getAttribute("alt") || `Image ${index + 1}`;
    modalBody.innerHTML = `<img src="${src}" alt="${alt}" class="modal-img">`;

    modal.hidden = false;
    modal.setAttribute("aria-hidden", "false");

    closeButton.focus();
    document.addEventListener("keydown", trapFocus);
  });
});

// Close modal on close button click
closeButton.addEventListener("click", closeModal);

// Close modal on ESC key
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    closeModal();
  }
});

function closeModal() {
  modal.hidden = true;
  modal.setAttribute("aria-hidden", "true");
  document.removeEventListener("keydown", trapFocus);
  if (lastFocusedElement) lastFocusedElement.focus();
}

// Trap keyboard focus inside modal
function trapFocus(e) {
  if (e.key === "Tab") {
    const focusableElements = modal.querySelectorAll(
      'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    const first = focusableElements[0];
    const last = focusableElements[focusableElements.length - 1];

    if (e.shiftKey) {
      if (document.activeElement === first) {
        e.preventDefault();
        last.focus();
      }
    } else {
      if (document.activeElement === last) {
        e.preventDefault();
        first.focus();
      }
    }
  }
}
*/

$(document).ready(function () {
  console.log("Hi");
  /*
   *   This content is licensed according to the W3C Software License at
   *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
   *
   *   Simple accordion pattern example
   */

  ("use strict");

  class Accordion {
    constructor(domNode) {
      this.rootEl = domNode;
      this.buttonEl = this.rootEl.querySelector("button[aria-expanded]");

      const controlsId = this.buttonEl.getAttribute("aria-controls");
      this.contentEl = document.getElementById(controlsId);

      this.open = this.buttonEl.getAttribute("aria-expanded") === "true";

      // add event listeners
      this.buttonEl.addEventListener("click", this.onButtonClick.bind(this));
    }

    onButtonClick() {
      this.toggle(!this.open);
    }

    toggle(open) {
      // don't do anything if the open state doesn't change
      if (open === this.open) {
        return;
      }

      // update the internal state
      this.open = open;

      // handle DOM updates
      this.buttonEl.setAttribute("aria-expanded", `${open}`);
      if (open) {
        this.contentEl.removeAttribute("hidden");
      } else {
        this.contentEl.setAttribute("hidden", "");
      }
    }

    // Add public open and close methods for convenience
    open() {
      this.toggle(true);
    }

    close() {
      this.toggle(false);
    }
  }

  // init accordions
  const accordions = document.querySelectorAll(".accordion h3");
  accordions.forEach((accordionEl) => {
    new Accordion(accordionEl);
  });
});

$(document).ready(function () {
  console.log("Hi");

  document.querySelectorAll(".slider").forEach((sliderEl) => {
    new A11YSlider(sliderEl, {
      slidesToShow: 1,
      arrows: true,
      dots: false,
      skipBtn: false,
      responsive: {
        992: { slidesToShow: 4 },
        768: { slidesToShow: 2 },
        480: { slidesToShow: 1 },
      },
    });
  });
});

$(window).on("load", function () {
  $(".is-form-style.is-form-style-3").css("display", "flex");
});

$(document).ready(function () {
  const select = document.getElementById("lang_choice_1");

  if (select) {
    // Remove lang from <select> so options can define their own
    select.removeAttribute("lang");

    // Add aria-labels to improve screen reader output
    select.querySelectorAll("option").forEach(function (opt) {
      const txt = opt.textContent.trim();

      if (opt.lang === "hi-IN") {
        opt.setAttribute("aria-label", "Hindi");
      } else if (opt.lang === "en-US") {
        opt.setAttribute("aria-label", "English");
      } else {
        // fallback: use text as aria-label
        opt.setAttribute("aria-label", txt);
      }
    });
  }
});

/* Menu navigation accessibility */
$(document).ready(function () {
  const $menu = $('[role="menubar"]');
  const $topItems = $menu.find('> li > [role="menuitem"]');
  let hoverTimeout;

  $menu.find('[role="menuitem"]').attr("tabindex", "-1");

  // Allow only first top-level to be tabbable
  $topItems.first().attr("tabindex", "0");

  // --- Open submenu instantly (keyboard / click) ---
  function openSubmenuInstant($item) {
    const $submenu = $item.next('[role="menu"]');
    if ($submenu.length && !$submenu.is(":visible")) {
      $submenu.show().attr("aria-hidden", "false");
      $submenu.find('[role="menuitem"]').attr("tabindex", "0");
      $item.attr("aria-expanded", "true");
    }
  }

  // --- Close submenu instantly (keyboard / click) ---
  function closeSubmenuInstant($item) {
    const $submenu = $item.next('[role="menu"]');
    if ($submenu.length && $submenu.is(":visible")) {
      $submenu.hide().attr("aria-hidden", "true");
      $submenu.find('[role="menuitem"]').attr("tabindex", "-1");
      $item.attr("aria-expanded", "false");
    }
  }

  // --- Open submenu with animation (mouse hover) ---
  function openSubmenuHover($item) {
    const $submenu = $item.next('[role="menu"]');
    if ($submenu.length && !$submenu.is(":visible")) {
      $submenu.stop(true, true).slideDown(200).attr("aria-hidden", "false");
      $submenu.find('[role="menuitem"]').attr("tabindex", "0");
      $item.attr("aria-expanded", "true");
    }
  }

  // --- Close submenu with animation (mouse hover) ---
  function closeSubmenuHover($item) {
    const $submenu = $item.next('[role="menu"]');
    if ($submenu.length && $submenu.is(":visible")) {
      $submenu.stop(true, true).slideUp(200).attr("aria-hidden", "true");
      $submenu.find('[role="menuitem"]').attr("tabindex", "-1");
      $item.attr("aria-expanded", "false");
    }
  }

  // --- Close all submenus ---
  function closeAllSubmenus() {
    $menu.find('[role="menu"]').hide().attr("aria-hidden", "true");
    $menu
      .find('[role="menuitem"][aria-haspopup="true"]')
      .attr("aria-expanded", "false");
    $menu.find('[role="menu"] [role="menuitem"]').attr("tabindex", "-1");
  }

  // --- Keyboard navigation ---
  $menu.on("keydown", '[role="menuitem"]', function (e) {
    const $current = $(this);
    const isTopLevel = $current.parent().parent().is($menu);

    if (e.key === "Tab") return;

    // Escape
    if (e.key === "Escape") {
      if (!isTopLevel) {
        const $parentItem = $current
          .closest('[role="menu"]')
          .prev('[role="menuitem"]');
        closeSubmenuInstant($parentItem);
        $parentItem.focus();
        e.preventDefault();
      } else {
        closeAllSubmenus();
      }
    }

    // Left/Right (top-level)
    if (isTopLevel && (e.key === "ArrowLeft" || e.key === "ArrowRight")) {
      let index = $topItems.index($current);
      index =
        e.key === "ArrowLeft"
          ? (index - 1 + $topItems.length) % $topItems.length
          : (index + 1) % $topItems.length;
      $topItems.eq(index).focus();
      e.preventDefault();
    }

    // Up/Down (top-level opens submenu)
    if (isTopLevel && (e.key === "ArrowDown" || e.key === "ArrowUp")) {
      const $submenu = $current.next('[role="menu"]');
      if ($submenu.length) {
        openSubmenuInstant($current);
        const $items = $submenu.find('[role="menuitem"]');
        $items.eq(e.key === "ArrowDown" ? 0 : $items.length - 1).focus();
        e.preventDefault();
      }
    }

    // Up/Down inside submenu
    if (!isTopLevel && (e.key === "ArrowDown" || e.key === "ArrowUp")) {
      const $submenuItems = $current
        .closest('[role="menu"]')
        .find('[role="menuitem"]');
      let idx = $submenuItems.index($current);
      idx =
        e.key === "ArrowUp"
          ? (idx - 1 + $submenuItems.length) % $submenuItems.length
          : (idx + 1) % $submenuItems.length;
      $submenuItems.eq(idx).focus();
      e.preventDefault();
    }

    // Enter/Space toggles submenu (top-level)
    if (isTopLevel && (e.key === "Enter" || e.key === " ")) {
      const $submenu = $current.next('[role="menu"]');
      if ($submenu.length) {
        const expanded = $current.attr("aria-expanded") === "true";
        expanded ? closeSubmenuInstant($current) : openSubmenuInstant($current);
        e.preventDefault();
      }
    }
  });

  // --- Click on top-level ---
  $topItems.on("click", function (e) {
    const $this = $(this);
    const $submenu = $this.next('[role="menu"]');
    if ($submenu.length) {
      e.preventDefault();
      const expanded = $this.attr("aria-expanded") === "true";
      expanded ? closeSubmenuInstant($this) : openSubmenuInstant($this);
    }
  });

  // --- Mouse hover on top-level and submenu ---
  $topItems.each(function () {
    const $item = $(this);
    const $submenu = $item.next('[role="menu"]');

    // Open on mouse enter only (no focus)
    $item.add($submenu).on("mouseenter", function () {
      clearTimeout(hoverTimeout);
      openSubmenuHover($item);
    });

    // Close after delay on mouse leave
    $item.add($submenu).on("mouseleave", function () {
      hoverTimeout = setTimeout(() => {
        if (!$submenu.find(":focus").length) {
          closeSubmenuHover($item);
        }
      }, 200);
    });
  });

  // --- Click outside closes all ---
  $(document).on("click", function (e) {
    if (!$(e.target).closest(".nav-links").length) {
      closeAllSubmenus();
    }
  });

  // --- Init ---
  closeAllSubmenus();
});

/*       */

$(document).ready(function () {
  console.log("Inside the accessibility div section.");

  // Check for stored dark mode state
  if (localStorage.getItem("darkMode") === "enabled") {
    $("body").addClass("dark-mode");
    console.log("Dark mode is enabled from storage.");
  }

  // Font Size Adjustment - Initialize variables
  const defaultFontSize = parseFloat($("html").css("font-size"));
  let currentFontSize = defaultFontSize;

  // Handle font size increase
  $(".increaseFont").on("click", function () {
    if (currentFontSize < 30) {
      currentFontSize += 2;
      $("html").css("font-size", currentFontSize + "px");
      console.log("Font size increased to:", currentFontSize + "px");
    }
  });

  // Handle font size decrease
  $(".decreaseFont").on("click", function () {
    if (currentFontSize > 10) {
      currentFontSize -= 2;
      $("html").css("font-size", currentFontSize + "px");
      console.log("Font size decreased to:", currentFontSize + "px");
    }
  });

  // Dark Mode Toggle
  $("#dark-mode").on("click", function () {
    $("body").removeClass("high-contrast").addClass("dark-mode");
    localStorage.setItem("darkMode", "enabled");
    console.log("Dark mode activated.");
  });

  // High Contrast Mode Toggle
  $("#high-contrast").on("click", function () {
    $("body").removeClass("dark-mode").addClass("high-contrast");
    localStorage.setItem("darkMode", "disabled");
    console.log("High contrast mode activated.");
  });

  // Reset Font Size
  $(".normalFont, #reset-text").on("click", function () {
    currentFontSize = defaultFontSize;
    $("html").css("font-size", currentFontSize + "px");
    console.log("Font size reset to default:", currentFontSize + "px");
  });

  // ---- Accessibility menu focus-trap ----
  const $menu = $("#accessibility-menu");
  const $opener = $("#accessibility-icon");

  // Check if elements exist
  if ($opener.length === 0) {
    console.error("Accessibility icon not found!");
    return;
  }
  if ($menu.length === 0) {
    console.error("Accessibility menu not found!");
    return;
  }

  console.log("Accessibility elements found successfully");

  // ARIA wiring
  $opener.attr({
    "aria-controls": "accessibility-menu",
    "aria-haspopup": "dialog",
    "aria-expanded": "false",
  });
  $menu.attr({
    role: "dialog",
    "aria-modal": "true",
    "aria-hidden": $menu.hasClass("hidden") ? "true" : "false",
    tabindex: "-1",
  });

  let lastFocused = null;

  // Toggle handler
  $opener.on("click", function (e) {
    console.log("Accessibility button clicked!");
    e.preventDefault();
    e.stopPropagation();

    if ($menu.hasClass("hidden")) {
      console.log("Menu is hidden, opening...");
      openMenu();
    } else {
      console.log("Menu is visible, closing...");
      closeMenu();
    }
  });

  function openMenu() {
    console.log("openMenu() called");
    lastFocused = document.activeElement;

    $menu.removeClass("hidden").attr("aria-hidden", "false");
    $opener.attr("aria-expanded", "true");

    console.log("Menu should now be visible");
    console.log("Menu has 'hidden' class:", $menu.hasClass("hidden"));

    // Focus first focusable element inside
    const focusableElements = focusables();
    console.log("Found " + focusableElements.length + " focusable elements");
    if (focusableElements.length > 0) {
      focusableElements.first().trigger("focus");
    }

    // Add event listeners
    $(document).on("keydown.accessMenu", onKeyDown);
    $(document).on("focusin.accessMenu", keepFocusInside);
  }

  function closeMenu() {
    console.log("closeMenu() called");
    $menu.addClass("hidden").attr("aria-hidden", "true");
    $opener.attr("aria-expanded", "false");

    // Remove event listeners
    $(document).off(".accessMenu");

    // Return focus
    if (lastFocused && $(lastFocused).length) {
      $(lastFocused).trigger("focus");
    } else {
      $opener.trigger("focus");
    }
  }

  function focusables() {
    return $menu
      .find(
        'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
      )
      .filter(":visible:not([disabled])");
  }

  function onKeyDown(e) {
    // Close on ESC
    if (e.key === "Escape") {
      e.preventDefault();
      closeMenu();
      return;
    }

    // Trap Tab

    // Arrow navigation across buttons
    if (e.key === "ArrowRight" || e.key === "ArrowDown") {
      e.preventDefault();
      moveBy(1);
    }
    if (e.key === "ArrowLeft" || e.key === "ArrowUp") {
      e.preventDefault();
      moveBy(-1);
    }
  }

  function keepFocusInside(e) {
    if (
      !$menu.hasClass("hidden") &&
      !$menu[0].contains(e.target) &&
      e.target !== $opener[0]
    ) {
      e.preventDefault();
      const focusableElements = focusables();
      if (focusableElements.length > 0) {
        focusableElements.first().trigger("focus");
      }
    }
  }

  function moveBy(delta) {
    const $buttons = $menu.find("button:visible:not([disabled])");
    if ($buttons.length === 0) return;

    const currentIndex = $buttons.index($(document.activeElement));
    let nextIndex;

    if (currentIndex === -1) {
      // If no button is focused, focus the first one
      nextIndex = 0;
    } else {
      nextIndex = (currentIndex + delta + $buttons.length) % $buttons.length;
    }

    $buttons.eq(nextIndex).trigger("focus");
  }

  // Close menu when clicking outside
  $(document).on("click", function (e) {
    if (
      !$menu.hasClass("hidden") &&
      !$menu[0].contains(e.target) &&
      !$opener[0].contains(e.target)
    ) {
      closeMenu();
    }
  });

  console.log("Accessibility menu setup complete!");
});

/*    */

/*
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

});*/
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

$(document).ready(function () {
  console.log("I am smiling");

  ("use strict");

  class Accordion {
    constructor(domNode) {
      this.rootEl = domNode;
      this.buttonEl = this.rootEl.querySelector("button[aria-expanded]");

      const controlsId = this.buttonEl.getAttribute("aria-controls");
      this.contentEl = document.getElementById(controlsId);

      this.open = this.buttonEl.getAttribute("aria-expanded") === "true";

      // add event listeners
      this.buttonEl.addEventListener("click", this.onButtonClick.bind(this));
    }

    onButtonClick() {
      this.toggle(!this.open);
    }

    toggle(open) {
      // don't do anything if the open state doesn't change
      if (open === this.open) {
        return;
      }

      // update the internal state
      this.open = open;

      // handle DOM updates
      this.buttonEl.setAttribute("aria-expanded", `${open}`);
      if (open) {
        this.contentEl.removeAttribute("hidden");
      } else {
        this.contentEl.setAttribute("hidden", "");
      }
    }

    // Add public open and close methods for convenience
    open() {
      this.toggle(true);
    }

    close() {
      this.toggle(false);
    }
  }

  // init accordions
  const accordions = document.querySelectorAll(
    ".accordion h3 , .accordion h4 "
  );
  accordions.forEach((accordionEl) => {
    new Accordion(accordionEl);
  });
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
    1000: {
      items: 6,
      nav: true,
      loop: false,
    },
  },
  autoplay: false,
  autoplayTimeout: 1500,
  autoplayHoverPause: true,
  nav: true,
  navText: [
    "<div class='nav-btn prev-slide' ></div>",
    "<div class='nav-btn next-slide' ></div>",
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

    $("html, body").animate({ scrollTop: 0 }, 300, function () {
      // Move focus to top anchor
      var topElement = $("#top-anchor");
      if (topElement.length) {
        topElement.focus();
      }

      // Announce to screen readers
      $("#live-region").text("You are back at the top of the page");
    });
  });
});

var swiper = new swiper(".home-slider", {
  autoplay: {
    delay: 500,
    disableOnInteraction: false,
    pauseOnMouseEnter: true,
  },
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

// Function to show an alert when an external link is clicked
function check_url() {
  alert("External link that opens in a new window");
  return true; // Allow the link to open
}

// Optional: Ensure the script loads correctly by logging to the console
console.log("script.js loaded");

/*
 *   This content is licensed according to the W3C Software License at
 *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
 *
 *   Simple accordion pattern example
 */
