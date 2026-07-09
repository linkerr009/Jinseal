document.addEventListener("DOMContentLoaded", () => {
  const gallery = document.querySelector(".pd-gallery");
  const mainImage = document.querySelector("[data-gallery-main]");
  const thumbs = Array.from(document.querySelectorAll("[data-gallery-thumb]"));

  if (!mainImage || thumbs.length === 0) return;

  let activeIndex = Math.max(0, thumbs.findIndex((thumb) => thumb.classList.contains("is-active")));
  let autoplay = null;

  const showImage = (index) => {
    const thumb = thumbs[index];
    if (!thumb) return;

    const nextSrc = thumb.dataset.gallerySrc;
    if (!nextSrc) return;

    activeIndex = index;
    mainImage.src = nextSrc;
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
    autoplay = window.setInterval(() => {
      showImage((activeIndex + 1) % thumbs.length);
    }, 3600);
  };

  thumbs.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      showImage(thumbs.indexOf(thumb));
      startAutoplay();
    });
  });

  if (gallery) {
    gallery.addEventListener("mouseenter", stopAutoplay);
    gallery.addEventListener("mouseleave", startAutoplay);
  }

  showImage(activeIndex);
  startAutoplay();
});
