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
    images = JSON.parse(this.getAttribute("data-album-images"));

    // Set the title for proper dialog labeling
    //lightboxTitle.textContent = albumName + " Image Gallery";

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
    });

    // Show the modal and make it accessible
    lightboxModal.style.display = "flex";
    lightboxModal.removeAttribute("aria-hidden");
    lightboxModal.setAttribute("aria-labelledby", "lightbox-title");

    if (images.length > 1) {
      prevButton.style.display = "block";
      nextButton.style.display = "block";
    } else {
      prevButton.style.display = "none";
      nextButton.style.display = "none";
    }

    // Hide the gallery from screen readers to prevent multiple readings
    lightboxGallery.setAttribute("aria-hidden", "true");

    // Show the first image without announcer message initially
    updateLightboxImage(0, true);
    modalJustOpened = true;
    // Set focus to the close button
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
    lightboxModal.style.display = "none";

    // Properly hide the modal from screen readers
    lightboxModal.setAttribute("aria-hidden", "true");
    lightboxModal.removeAttribute("aria-labelledby");

    if (lastFocusedElement) {
      lastFocusedElement.focus();
    }

    // Clear the announcer
    if (announcer) {
      announcer.textContent = "";
    }
  }

  /**
   * Updates the displayed image in the lightbox.
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
      // In updateLightboxImage function, change the announcer logic:
      if (announcer && announce) {
        announcer.textContent = `Image ${newIndex + 1} of ${
          images.length
        }: ${newImageAlt}.`;
      }
    }

    currentImageIndex = newIndex;
  }

  /**
   * Displays the next image in the gallery.
   */
  function showNextImage() {
    if (currentImageIndex < images.length - 1) {
      updateLightboxImage(currentImageIndex + 1);
    }
  }

  /**
   * Displays the previous image in the gallery.
   */
  function showPrevImage() {
    if (currentImageIndex > 0) {
      updateLightboxImage(currentImageIndex - 1);
    }
  }

  // --- Event Listeners ---
  albumLinks.forEach((link) => {
    link.addEventListener("click", openLightbox);
  });

  closeButton.addEventListener("click", closeLightbox);
  prevButton.addEventListener("click", showPrevImage);
  nextButton.addEventListener("click", showNextImage);

  // Keyboard navigation for the entire document
  document.addEventListener("keydown", function (event) {
    if (lightboxModal.style.display === "flex") {
      if (event.key === "Escape") {
        closeLightbox();
      } else if (event.key === "ArrowLeft") {
        event.preventDefault();
        showPrevImage();
      } else if (event.key === "ArrowRight") {
        event.preventDefault();
        showNextImage();
      }
    }
  });

  // Simple focus trap within the modal
  lightboxModal.addEventListener("keydown", function (event) {
    if (event.key === "Tab") {
      const focusableElements = lightboxModal.querySelectorAll(
        'button:not([style*="display: none"]), a, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
      );
      if (focusableElements.length === 0) return;

      const firstElement = focusableElements[0];
      const lastElement = focusableElements[focusableElements.length - 1];

      if (event.shiftKey) {
        // Shift + Tab
        if (document.activeElement === firstElement) {
          lastElement.focus();
          event.preventDefault();
        }
      } else {
        // Tab
        if (document.activeElement === lastElement) {
          firstElement.focus();
          event.preventDefault();
        }
      }
    }
  });
});
