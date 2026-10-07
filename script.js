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

  document.querySelectorAll(".slider").forEach((sliderEl) => {
    new A11YSlider(sliderEl, {
      slidesToShow: 4,
      arrows: true,
      dots: false,
      responsive: {
        992: { slidesToShow: 4 },
        768: { slidesToShow: 2 },
        480: { slidesToShow: 1 },
      },
    });
  });
});

/* The modal function */

$(document).ready(function () {
  "use strict";
  /**
   * @namespace aria
   */

  var aria = aria || {};

  /**
   * @description
   *  Key code constants
   */

  console.log("Hello");

  aria.KeyCode = {
    BACKSPACE: 8,
    TAB: 9,
    RETURN: 13,
    SHIFT: 16,
    ESC: 27,
    SPACE: 32,
    PAGE_UP: 33,
    PAGE_DOWN: 34,
    END: 35,
    HOME: 36,
    LEFT: 37,
    UP: 38,
    RIGHT: 39,
    DOWN: 40,
    DELETE: 46,
  };

  aria.Utils = aria.Utils || {};

  // Polyfill src https://developer.mozilla.org/en-US/docs/Web/API/Element/matches
  aria.Utils.matches = function (element, selector) {
    if (!Element.prototype.matches) {
      Element.prototype.matches =
        Element.prototype.matchesSelector ||
        Element.prototype.mozMatchesSelector ||
        Element.prototype.msMatchesSelector ||
        Element.prototype.oMatchesSelector ||
        Element.prototype.webkitMatchesSelector ||
        function (s) {
          var matches = element.parentNode.querySelectorAll(s);
          var i = matches.length;
          while (--i >= 0 && matches.item(i) !== this) {
            // empty
          }
          return i > -1;
        };
    }

    return element.matches(selector);
  };

  aria.Utils.remove = function (item) {
    if (item.remove && typeof item.remove === "function") {
      return item.remove();
    }
    if (
      item.parentNode &&
      item.parentNode.removeChild &&
      typeof item.parentNode.removeChild === "function"
    ) {
      return item.parentNode.removeChild(item);
    }
    return false;
  };

  aria.Utils.isFocusable = function (element) {
    if (element.tabIndex < 0) {
      return false;
    }

    if (element.disabled) {
      return false;
    }

    switch (element.nodeName) {
      case "A":
        return !!element.href && element.rel != "ignore";
      case "INPUT":
        return element.type != "hidden";
      case "BUTTON":
      case "SELECT":
      case "TEXTAREA":
        return true;
      default:
        return false;
    }
  };

  aria.Utils.getAncestorBySelector = function (element, selector) {
    if (!aria.Utils.matches(element, selector + " " + element.tagName)) {
      // Element is not inside an element that matches selector
      return null;
    }

    // Move up the DOM tree until a parent matching the selector is found
    var currentNode = element;
    var ancestor = null;
    while (ancestor === null) {
      if (aria.Utils.matches(currentNode.parentNode, selector)) {
        ancestor = currentNode.parentNode;
      } else {
        currentNode = currentNode.parentNode;
      }
    }

    return ancestor;
  };

  aria.Utils.hasClass = function (element, className) {
    return new RegExp("(\\s|^)" + className + "(\\s|$)").test(
      element.className
    );
  };

  aria.Utils.addClass = function (element, className) {
    if (!aria.Utils.hasClass(element, className)) {
      element.className += " " + className;
    }
  };

  aria.Utils.removeClass = function (element, className) {
    var classRegex = new RegExp("(\\s|^)" + className + "(\\s|$)");
    element.className = element.className.replace(classRegex, " ").trim();
  };

  aria.Utils.bindMethods = function (object /* , ...methodNames */) {
    var methodNames = Array.prototype.slice.call(arguments, 1);
    methodNames.forEach(function (method) {
      object[method] = object[method].bind(object);
    });
  };
  /*
   *   This content is licensed according to the W3C Software License at
   *   https://www.w3.org/Consortium/Legal/2015/copyright-software-and-document
   */

  ("use strict");

  var aria = aria || {};

  aria.Utils = aria.Utils || {};

  (function () {
    /*
     * When util functions move focus around, set this true so the focus listener
     * can ignore the events.
     */
    aria.Utils.IgnoreUtilFocusChanges = false;

    aria.Utils.dialogOpenClass = "has-dialog";

    /**
     * @description Set focus on descendant nodes until the first focusable element is
     *       found.
     * @param element
     *          DOM node for which to find the first focusable descendant.
     * @returns {boolean}
     *  true if a focusable element is found and focus is set.
     */
    aria.Utils.focusFirstDescendant = function (element) {
      for (var i = 0; i < element.childNodes.length; i++) {
        var child = element.childNodes[i];
        if (
          aria.Utils.attemptFocus(child) ||
          aria.Utils.focusFirstDescendant(child)
        ) {
          return true;
        }
      }
      return false;
    }; // end focusFirstDescendant

    /**
     * @description Find the last descendant node that is focusable.
     * @param element
     *          DOM node for which to find the last focusable descendant.
     * @returns {boolean}
     *  true if a focusable element is found and focus is set.
     */
    aria.Utils.focusLastDescendant = function (element) {
      for (var i = element.childNodes.length - 1; i >= 0; i--) {
        var child = element.childNodes[i];
        if (
          aria.Utils.attemptFocus(child) ||
          aria.Utils.focusLastDescendant(child)
        ) {
          return true;
        }
      }
      return false;
    }; // end focusLastDescendant

    /**
     * @description Set Attempt to set focus on the current node.
     * @param element
     *          The node to attempt to focus on.
     * @returns {boolean}
     *  true if element is focused.
     */
    aria.Utils.attemptFocus = function (element) {
      if (!aria.Utils.isFocusable(element)) {
        return false;
      }

      aria.Utils.IgnoreUtilFocusChanges = true;
      try {
        element.focus();
      } catch (e) {
        // continue regardless of error
      }
      aria.Utils.IgnoreUtilFocusChanges = false;
      return document.activeElement === element;
    }; // end attemptFocus

    /* Modals can open modals. Keep track of them with this array. */
    aria.OpenDialogList = aria.OpenDialogList || new Array(0);

    /**
     * @returns {object|void} the last opened dialog (the current dialog)
     */
    aria.getCurrentDialog = function () {
      if (aria.OpenDialogList && aria.OpenDialogList.length) {
        return aria.OpenDialogList[aria.OpenDialogList.length - 1];
      }
    };

    aria.closeCurrentDialog = function () {
      var currentDialog = aria.getCurrentDialog();
      if (currentDialog) {
        currentDialog.close();
        return true;
      }

      return false;
    };

    aria.handleEscape = function (event) {
      var key = event.which || event.keyCode;

      if (key === aria.KeyCode.ESC && aria.closeCurrentDialog()) {
        event.stopPropagation();
      }
    };

    document.addEventListener("keyup", aria.handleEscape);

    /**
     * @class
     * @description Dialog object providing modal focus management.
     *
     * Assumptions: The element serving as the dialog container is present in the
     * DOM and hidden. The dialog container has role='dialog'.
     * @param dialogId
     *          The ID of the element serving as the dialog container.
     * @param focusAfterClosed
     *          Either the DOM node or the ID of the DOM node to focus when the
     *          dialog closes.
     * @param focusFirst
     *          Optional parameter containing either the DOM node or the ID of the
     *          DOM node to focus when the dialog opens. If not specified, the
     *          first focusable element in the dialog will receive focus.
     */
    aria.Dialog = function (dialogId, focusAfterClosed, focusFirst) {
      this.dialogNode = document.getElementById(dialogId);
      if (this.dialogNode === null) {
        throw new Error('No element found with id="' + dialogId + '".');
      }

      var validRoles = ["dialog", "alertdialog"];
      var isDialog = (this.dialogNode.getAttribute("role") || "")
        .trim()
        .split(/\s+/g)
        .some(function (token) {
          return validRoles.some(function (role) {
            return token === role;
          });
        });
      if (!isDialog) {
        throw new Error(
          "Dialog() requires a DOM element with ARIA role of dialog or alertdialog."
        );
      }

      // Wrap in an individual backdrop element if one doesn't exist
      // Native <dialog> elements use the ::backdrop pseudo-element, which
      // works similarly.
      var backdropClass = "dialog-backdrop";
      if (this.dialogNode.parentNode.classList.contains(backdropClass)) {
        this.backdropNode = this.dialogNode.parentNode;
      } else {
        this.backdropNode = document.createElement("div");
        this.backdropNode.className = backdropClass;
        this.dialogNode.parentNode.insertBefore(
          this.backdropNode,
          this.dialogNode
        );
        this.backdropNode.appendChild(this.dialogNode);
      }
      this.backdropNode.classList.add("active");

      // Disable scroll on the body element
      document.body.classList.add(aria.Utils.dialogOpenClass);

      if (typeof focusAfterClosed === "string") {
        this.focusAfterClosed = document.getElementById(focusAfterClosed);
      } else if (typeof focusAfterClosed === "object") {
        this.focusAfterClosed = focusAfterClosed;
      } else {
        throw new Error(
          "the focusAfterClosed parameter is required for the aria.Dialog constructor."
        );
      }

      if (typeof focusFirst === "string") {
        this.focusFirst = document.getElementById(focusFirst);
      } else if (typeof focusFirst === "object") {
        this.focusFirst = focusFirst;
      } else {
        this.focusFirst = null;
      }

      // Bracket the dialog node with two invisible, focusable nodes.
      // While this dialog is open, we use these to make sure that focus never
      // leaves the document even if dialogNode is the first or last node.
      var preDiv = document.createElement("div");
      this.preNode = this.dialogNode.parentNode.insertBefore(
        preDiv,
        this.dialogNode
      );
      this.preNode.tabIndex = 0;
      var postDiv = document.createElement("div");
      this.postNode = this.dialogNode.parentNode.insertBefore(
        postDiv,
        this.dialogNode.nextSibling
      );
      this.postNode.tabIndex = 0;

      // If this modal is opening on top of one that is already open,
      // get rid of the document focus listener of the open dialog.
      if (aria.OpenDialogList.length > 0) {
        aria.getCurrentDialog().removeListeners();
      }

      this.addListeners();
      aria.OpenDialogList.push(this);
      this.clearDialog();
      this.dialogNode.className = "default_dialog"; // make visible

      if (this.focusFirst) {
        this.focusFirst.focus();
      } else {
        aria.Utils.focusFirstDescendant(this.dialogNode);
      }

      this.lastFocus = document.activeElement;
    }; // end Dialog constructor

    aria.Dialog.prototype.clearDialog = function () {
      Array.prototype.map.call(
        this.dialogNode.querySelectorAll("input"),
        function (input) {
          input.value = "";
        }
      );
    };

    /**
     * @description
     *  Hides the current top dialog,
     *  removes listeners of the top dialog,
     *  restore listeners of a parent dialog if one was open under the one that just closed,
     *  and sets focus on the element specified for focusAfterClosed.
     */
    aria.Dialog.prototype.close = function () {
      aria.OpenDialogList.pop();
      this.removeListeners();
      aria.Utils.remove(this.preNode);
      aria.Utils.remove(this.postNode);
      this.dialogNode.className = "hidden";
      this.backdropNode.classList.remove("active");
      this.focusAfterClosed.focus();

      // If a dialog was open underneath this one, restore its listeners.
      if (aria.OpenDialogList.length > 0) {
        aria.getCurrentDialog().addListeners();
      } else {
        document.body.classList.remove(aria.Utils.dialogOpenClass);
      }
    }; // end close

    /**
     * @description
     *  Hides the current dialog and replaces it with another.
     * @param newDialogId
     *  ID of the dialog that will replace the currently open top dialog.
     * @param newFocusAfterClosed
     *  Optional ID or DOM node specifying where to place focus when the new dialog closes.
     *  If not specified, focus will be placed on the element specified by the dialog being replaced.
     * @param newFocusFirst
     *  Optional ID or DOM node specifying where to place focus in the new dialog when it opens.
     *  If not specified, the first focusable element will receive focus.
     */
    aria.Dialog.prototype.replace = function (
      newDialogId,
      newFocusAfterClosed,
      newFocusFirst
    ) {
      aria.OpenDialogList.pop();
      this.removeListeners();
      aria.Utils.remove(this.preNode);
      aria.Utils.remove(this.postNode);
      this.dialogNode.className = "hidden";
      this.backdropNode.classList.remove("active");

      var focusAfterClosed = newFocusAfterClosed || this.focusAfterClosed;
      new aria.Dialog(newDialogId, focusAfterClosed, newFocusFirst);
    }; // end replace

    aria.Dialog.prototype.addListeners = function () {
      document.addEventListener("focus", this.trapFocus, true);
    }; // end addListeners

    aria.Dialog.prototype.removeListeners = function () {
      document.removeEventListener("focus", this.trapFocus, true);
    }; // end removeListeners

    aria.Dialog.prototype.trapFocus = function (event) {
      if (aria.Utils.IgnoreUtilFocusChanges) {
        return;
      }
      var currentDialog = aria.getCurrentDialog();
      if (currentDialog.dialogNode.contains(event.target)) {
        currentDialog.lastFocus = event.target;
      } else {
        aria.Utils.focusFirstDescendant(currentDialog.dialogNode);
        if (currentDialog.lastFocus == document.activeElement) {
          aria.Utils.focusLastDescendant(currentDialog.dialogNode);
        }
        currentDialog.lastFocus = document.activeElement;
      }
    }; // end trapFocus

    window.openDialog = function (dialogId, focusAfterClosed, focusFirst) {
      new aria.Dialog(dialogId, focusAfterClosed, focusFirst);
    };

    window.closeDialog = function (closeButton) {
      var topDialog = aria.getCurrentDialog();
      if (topDialog.dialogNode.contains(closeButton)) {
        topDialog.close();
      }
    }; // end closeDialog

    window.replaceDialog = function (
      newDialogId,
      newFocusAfterClosed,
      newFocusFirst
    ) {
      var topDialog = aria.getCurrentDialog();
      if (topDialog.dialogNode.contains(document.activeElement)) {
        topDialog.replace(newDialogId, newFocusAfterClosed, newFocusFirst);
      }
    }; // end replaceDialog
  })();
});

/* modal dialogue function closes */

$(window).on("load", function () {
  $(".is-form-style.is-form-style-3").css("display", "flex");
});

/* Menu navigation accessibility */
$(document).ready(function () {
  const $menu = $('[role="menubar"]');
  const $topItems = $menu.find('> li > [role="menuitem"]');

  function openSubmenu($item) {
    const $submenu = $item.next('[role="menu"]');
    if ($submenu.length) {
      $submenu.show().attr("aria-hidden", "false");
    }
  }

  function closeSubmenu($item) {
    const $submenu = $item.next('[role="menu"]');
    if ($submenu.length) {
      $submenu.hide().attr("aria-hidden", "true");
    }
  }

  $menu.on("keydown", '[role="menuitem"]', function (e) {
    const $current = $(this);
    const isTopLevel =
      $current.closest('[role="menubar"]').length > 0 &&
      $current.parent().parent().is($menu);

    // TAB: allow default, skip menu handling
    if (e.key === "Tab") return;

    // ESC: close submenu
    if (e.key === "Escape") {
      if (!isTopLevel) {
        const $parentItem = $current
          .closest('[role="menu"]')
          .prev('[role="menuitem"]');
        closeSubmenu($parentItem);
        $parentItem.focus();
        e.preventDefault();
      }
    }

    // Left/Right for top-level only
    if (isTopLevel && (e.key === "ArrowLeft" || e.key === "ArrowRight")) {
      let index = $topItems.index($current);
      index =
        e.key === "ArrowLeft"
          ? (index - 1 + $topItems.length) % $topItems.length
          : (index + 1) % $topItems.length;
      $topItems.eq(index).focus();
      e.preventDefault();
    }

    // Up/Down for submenu only
    if (!isTopLevel && (e.key === "ArrowUp" || e.key === "ArrowDown")) {
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

    // Down on top-level opens submenu
    if (isTopLevel && e.key === "ArrowDown") {
      const $submenu = $current.next('[role="menu"]');
      if ($submenu.length) {
        openSubmenu($current);
        $submenu.find('[role="menuitem"]').first().focus();
        e.preventDefault();
      }
    }

    // Up on top-level opens submenu from last item
    if (isTopLevel && e.key === "ArrowUp") {
      const $submenu = $current.next('[role="menu"]');
      if ($submenu.length) {
        openSubmenu($current);
        $submenu.find('[role="menuitem"]').last().focus();
        e.preventDefault();
      }
    }
  });
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
  //$(".single-image").click(function () {
  //var t = $(this).attr("src");
  //$(".modal-body").html("<img src='" + t + "' class='modal-img'>");
  //$("#myModal").show();
  //});

  //$(".close").click(function () {
  //$("#myModal").hide();
  //});
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
    $("html, body").animate(
      {
        scrollTop: 0,
      },
      "300"
    );
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
