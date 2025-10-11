document.addEventListener("DOMContentLoaded", function () {
  const albumLinks = document.querySelectorAll(".open-lightbox");
  const lightboxModal = document.getElementById("image-lightbox-modal");
  const lightboxTitle = document.getElementById("lightbox-title");
  const lightboxImageList = document.getElementById("lightbox-image-list");
  const closeButton = document.getElementById("lightbox-close-button");
  const prevButton = document.querySelector(".lightbox-prev");
  const nextButton = document.querySelector(".lightbox-next");
  const announcer = document.getElementById("lightbox-announcer");
  const lightboxGallery = document.querySelector(".lightbox-gallery");
  let modalJustOpened = false;

  let lastFocusedElement;
  let currentImageIndex = 0;
  let images = [];
  /**
   * Opens the lightbox modal, populating it with album images and setting focus.
   * @param {Event} event The click event object.
   */

  function openLightbox(event) {
    event.preventDefault();
    lastFocusedElement = document.activeElement;

    const albumName = this.getAttribute("data-album-name");
    images = JSON.parse(this.getAttribute("data-album-images")); // Set the title for proper dialog labeling //lightboxTitle.textContent = albumName + " Image Gallery";

    lightboxImageList.innerHTML = "";
    images.forEach((image, index) => {
      const li = document.createElement("li");
      li.innerHTML = `<img src="${image.url}" alt="${image.title}" class="lightbox-image">`;
      li.classList.add("lightbox-list-item");

      li.setAttribute("role", "group");
      li.setAttribute(
        "aria-label",
        `Image ${index + 1} of ${images.length}: ${image.title}`
      );
      li.setAttribute("tabindex", "-1");

      lightboxImageList.appendChild(li);
    }); // Show the modal and make it accessible

    lightboxModal.style.display = "flex";
    lightboxModal.removeAttribute("aria-hidden");
    lightboxModal.setAttribute("aria-labelledby", "lightbox-title");

    // Initial button display logic: only show if more than one image exists
    if (images.length <= 1) {
      prevButton.style.display = "none";
      nextButton.style.display = "none";
    } else {
      // Set initial visibility before calling updateLightboxImage(0)
      prevButton.style.display = "none"; // Hide Prev on image 0
      nextButton.style.display = "block"; // Show Next on image 0
    } // Hide the gallery from screen readers to prevent multiple readings

    lightboxGallery.setAttribute("aria-hidden", "true"); // Show the first image and manage button visibility

    updateLightboxImage(0, true);
    modalJustOpened = true; // Set focus to the close button
    requestAnimationFrame(() => {
      closeButton.focus();
      setTimeout(() => {
        modalJustOpened = false;
      }, 500);
    });
  }
  /**
   * Closes the lightbox modal and returns focus to the triggering element.
   */

  function closeLightbox() {
    lightboxModal.style.display = "none"; // Properly hide the modal from screen readers

    lightboxModal.setAttribute("aria-hidden", "true");
    lightboxModal.removeAttribute("aria-labelledby");

    if (lastFocusedElement) {
      lastFocusedElement.focus();
    } // Clear the announcer

    if (announcer) {
      announcer.textContent = "";
    }
  }
  /**
   * Updates the displayed image in the lightbox and manages button visibility.
   * @param {number} newIndex The index of the image to display.
   * @param {boolean} announce Whether to announce the change via aria-live
   */

  function updateLightboxImage(newIndex, announce = true) {
    const imageListItems = lightboxImageList.querySelectorAll(
      ".lightbox-list-item"
    );

    const oldActiveItem = lightboxImageList.querySelector(
      '[aria-current="true"]'
    );
    if (oldActiveItem) {
      oldActiveItem.removeAttribute("aria-current");
    }

    imageListItems.forEach((item) => {
      item.style.display = "none";
    });

    if (imageListItems[newIndex]) {
      imageListItems[newIndex].style.display = "block";
      imageListItems[newIndex].setAttribute("aria-current", "true");

      const newImageAlt = images[newIndex].title;
      if (announcer && announce) {
        announcer.textContent = `Image ${newIndex + 1} of ${
          images.length
        }: ${newImageAlt}.`;
      }
    }

    currentImageIndex = newIndex; // --- NEW: Visibility logic for Prev/Next buttons ---

    if (images.length > 1) {
      // Show/Hide Previous button
      if (currentImageIndex === 0) {
        prevButton.style.display = "none"; // Hide on first image
      } else {
        prevButton.style.display = "block"; // Show otherwise
      } // Show/Hide Next button

      if (currentImageIndex === images.length - 1) {
        nextButton.style.display = "none"; // Hide on last image
      } else {
        nextButton.style.display = "block"; // Show otherwise
      }
    } // -----------------------------------------------
  }
  /**
   * Displays the next image in the gallery.
   */

  function showNextImage() {
    if (currentImageIndex < images.length - 1) {
      updateLightboxImage(currentImageIndex + 1); // Focus logic after image update:

      if (nextButton.style.display !== "none") {
        // If Next button is still visible, keep focus on it.
        nextButton.focus();
      } else if (prevButton.style.display !== "none") {
        // *** When reaching the LAST image, the Next button hides. Focus moves to Prev button. ***
        prevButton.focus();
      } else {
        // Fallback for 1 or 2 image galleries
        closeButton.focus();
      }
    }
  }
  /**
   * Displays the previous image in the gallery.
   */

  function showPrevImage() {
    if (currentImageIndex > 0) {
      updateLightboxImage(currentImageIndex - 1);

      // Focus logic after image update:
      if (prevButton.style.display !== "none") {
        // If Prev button is still visible, keep focus on it.
        prevButton.focus();
      } else if (nextButton.style.display !== "none") {
        // When reaching the FIRST image, the Prev button hides. Focus moves to Next button.
        nextButton.focus();
      } else {
        // Fallback for 1 or 2 image galleries
        closeButton.focus();
      }
    }
  } // --- Event Listeners ---

  albumLinks.forEach((link) => {
    link.addEventListener("click", openLightbox);
  });

  closeButton.addEventListener("click", closeLightbox);
  prevButton.addEventListener("click", showPrevImage);
  nextButton.addEventListener("click", showNextImage); // Keyboard navigation for the entire document

  document.addEventListener("keydown", function (event) {
    if (lightboxModal.style.display === "flex") {
      if (event.key === "Escape") {
        closeLightbox();
      } else if (event.key === "ArrowLeft") {
        event.preventDefault();
        // Only navigate if the button is visible
        if (prevButton.style.display !== "none") {
          showPrevImage();
        }
      } else if (event.key === "ArrowRight") {
        event.preventDefault();
        // Only navigate if the current index is NOT the last image index.
        // The focus handling is done inside showNextImage.
        if (currentImageIndex < images.length - 1) {
          showNextImage();
        }
        // NEW: When at the last image, ArrowRight should move focus to the first visible button (Prev button).
        else if (currentImageIndex === images.length - 1 && images.length > 1) {
          event.preventDefault(); // Keep focus inside the modal
          prevButton.focus();
        }
      }
    }
  }); // Simple focus trap within the modal

  lightboxModal.addEventListener("keydown", function (event) {
    if (event.key === "Tab") {
      // Find ALL focusable elements and filter out hidden ones (using offsetWidth/Height)
      const focusableElements = Array.from(
        lightboxModal.querySelectorAll(
          'button, a[href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        )
      ).filter((el) => el.offsetWidth > 0 || el.offsetHeight > 0); // Filter based on visibility

      if (focusableElements.length === 0) return;

      const firstElement = focusableElements[0];
      const lastElement = focusableElements[focusableElements.length - 1];

      if (event.shiftKey) {
        // Shift + Tab (Backward)
        if (document.activeElement === firstElement) {
          lastElement.focus();
          event.preventDefault();
        }
      } else {
        // Tab (Forward)
        if (document.activeElement === lastElement) {
          firstElement.focus();
          event.preventDefault();
        }
      }
    }
  });
});
