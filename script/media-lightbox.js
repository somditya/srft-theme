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

  let lastFocusedElement;
  let currentImageIndex = 0;
  let images = [];

  // W3C focus utilities - exactly as in their example
  function focusFirstDescendant(element) {
    for (let i = 0; i < element.childNodes.length; i++) {
      const child = element.childNodes[i];
      if (attemptFocus(child) || focusFirstDescendant(child)) {
        return true;
      }
    }
    return false;
  }

  function attemptFocus(element) {
    if (!isFocusable(element)) {
      return false;
    }
    try {
      element.focus();
    } catch (e) {
      // continue regardless of error
    }
    return document.activeElement === element;
  }

  function isFocusable(element) {
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
  }

  /**
   * Opens the lightbox modal - following W3C pattern exactly
   */
  function openLightbox(event) {
    event.preventDefault();
    lastFocusedElement = document.activeElement;

    const albumName = this.getAttribute("data-album-name");
    images = JSON.parse(this.getAttribute("data-album-images"));

    lightboxTitle.textContent = albumName + " Image Gallery";

    lightboxImageList.innerHTML = "";
    images.forEach((image, index) => {
      const li = document.createElement("li");
      li.innerHTML = `<img src="${image.url}" alt="${image.title}" class="lightbox-image">`;
      li.classList.add("lightbox-list-item");
      li.setAttribute("tabindex", "-1");
      lightboxImageList.appendChild(li);
    });

    // Show modal - exactly like W3C
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

    updateLightboxImage(0, false);

    // W3C approach: focus first descendant automatically
    focusFirstDescendant(lightboxModal);
  }

  function closeLightbox() {
    lightboxModal.style.display = "none";
    lightboxModal.setAttribute("aria-hidden", "true");
    lightboxModal.removeAttribute("aria-labelledby");

    if (lastFocusedElement) {
      lastFocusedElement.focus();
    }

    if (announcer) {
      announcer.textContent = "";
    }
  }

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

    currentImageIndex = newIndex;
  }

  function showNextImage() {
    if (currentImageIndex < images.length - 1) {
      updateLightboxImage(currentImageIndex + 1);
    }
  }

  function showPrevImage() {
    if (currentImageIndex > 0) {
      updateLightboxImage(currentImageIndex - 1);
    }
  }

  // Event listeners
  albumLinks.forEach((link) => {
    link.addEventListener("click", openLightbox);
  });

  closeButton.addEventListener("click", closeLightbox);
  prevButton.addEventListener("click", showPrevImage);
  nextButton.addEventListener("click", showNextImage);

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

  // W3C style focus trap
  lightboxModal.addEventListener("keydown", function (event) {
    if (event.key === "Tab") {
      const focusableElements = lightboxModal.querySelectorAll(
        'button:not([style*="display: none"]), a, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
      );
      if (focusableElements.length === 0) return;

      const firstElement = focusableElements[0];
      const lastElement = focusableElements[focusableElements.length - 1];

      if (event.shiftKey) {
        if (document.activeElement === firstElement) {
          lastElement.focus();
          event.preventDefault();
        }
      } else {
        if (document.activeElement === lastElement) {
          firstElement.focus();
          event.preventDefault();
        }
      }
    }
  });
});
