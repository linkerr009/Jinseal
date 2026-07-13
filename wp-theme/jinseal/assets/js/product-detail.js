document.addEventListener("DOMContentLoaded", () => {
  const gallery = document.querySelector(".pd-gallery");
  const mainImage = document.querySelector("[data-gallery-main]");
  const thumbs = Array.from(document.querySelectorAll("[data-gallery-thumb]"));

  if (mainImage && thumbs.length > 0) {
    let activeIndex = Math.max(0, thumbs.findIndex((thumb) => thumb.classList.contains("is-active")));
    let autoplay = null;

    const showImage = (index) => {
      const thumb = thumbs[index];
      if (!thumb?.dataset.gallerySrc) return;

      activeIndex = index;
      mainImage.src = thumb.dataset.gallerySrc;
      mainImage.alt = thumb.dataset.galleryAlt || mainImage.alt;
      thumbs.forEach((item, itemIndex) => item.classList.toggle("is-active", itemIndex === activeIndex));
    };

    const stopAutoplay = () => {
      if (!autoplay) return;
      window.clearInterval(autoplay);
      autoplay = null;
    };

    const startAutoplay = () => {
      stopAutoplay();
      if (thumbs.length < 2) return;
      autoplay = window.setInterval(() => showImage((activeIndex + 1) % thumbs.length), 3600);
    };

    thumbs.forEach((thumb, index) => {
      thumb.addEventListener("click", () => {
        showImage(index);
        startAutoplay();
      });
    });

    if (gallery) {
      gallery.addEventListener("mouseenter", stopAutoplay);
      gallery.addEventListener("mouseleave", startAutoplay);
    }

    showImage(activeIndex);
    startAutoplay();
  }

  const related = document.querySelector("[data-related-carousel]");
  const viewport = related?.querySelector("[data-related-viewport].is-carousel");
  const previous = related?.querySelector("[data-related-prev]");
  const next = related?.querySelector("[data-related-next]");

  if (!viewport || !previous || !next) return;

  const updateControls = () => {
    const maxScroll = Math.max(0, viewport.scrollWidth - viewport.clientWidth);
    previous.disabled = viewport.scrollLeft <= 2;
    next.disabled = viewport.scrollLeft >= maxScroll - 2;
  };

  const move = (direction) => {
    viewport.scrollBy({
      left: direction * viewport.clientWidth,
      behavior: "smooth",
    });
  };

  previous.addEventListener("click", () => move(-1));
  next.addEventListener("click", () => move(1));
  viewport.addEventListener("scroll", updateControls, { passive: true });
  window.addEventListener("resize", updateControls);
  updateControls();
});
