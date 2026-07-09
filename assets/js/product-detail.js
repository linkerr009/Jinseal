document.addEventListener("DOMContentLoaded", () => {
  const mainImage = document.querySelector("[data-gallery-main]");
  const thumbs = Array.from(document.querySelectorAll("[data-gallery-thumb]"));

  if (!mainImage || thumbs.length === 0) return;

  thumbs.forEach((thumb) => {
    thumb.addEventListener("click", () => {
      const nextSrc = thumb.dataset.gallerySrc;
      if (!nextSrc) return;

      mainImage.src = nextSrc;
      mainImage.alt = thumb.dataset.galleryAlt || mainImage.alt;

      thumbs.forEach((item) => item.classList.toggle("is-active", item === thumb));
    });
  });
});
