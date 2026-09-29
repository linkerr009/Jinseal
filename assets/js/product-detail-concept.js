document.addEventListener("DOMContentLoaded", () => {
  const menuButton = document.querySelector(".xz-header__mobile-btn");
  const mobileMenu = document.querySelector("#pdx-mobile-menu");
  if (menuButton && mobileMenu) {
    menuButton.addEventListener("click", () => {
      const isOpen = menuButton.getAttribute("aria-expanded") === "true";
      menuButton.setAttribute("aria-expanded", String(!isOpen));
      menuButton.setAttribute("aria-label", isOpen ? "Open menu" : "Close menu");
      mobileMenu.hidden = isOpen;
    });
    mobileMenu.querySelectorAll("a").forEach((link) => link.addEventListener("click", () => {
      mobileMenu.hidden = true;
      menuButton.setAttribute("aria-expanded", "false");
      menuButton.setAttribute("aria-label", "Open menu");
    }));
  }

  const mainImage = document.querySelector("[data-pdx-main]");
  const thumbs = Array.from(document.querySelectorAll("[data-pdx-thumb]"));
  const current = document.querySelector("[data-gallery-current]");
  let activeIndex = 0;

  const showImage = (index) => {
    if (!mainImage || !thumbs.length) return;
    activeIndex = (index + thumbs.length) % thumbs.length;
    const thumb = thumbs[activeIndex];
    mainImage.style.opacity = "0";
    mainImage.style.transform = "scale(.985)";
    window.setTimeout(() => {
      mainImage.src = thumb.dataset.src;
      mainImage.alt = thumb.dataset.alt || mainImage.alt;
      mainImage.style.opacity = "1";
      mainImage.style.transform = "scale(1)";
    }, 150);
    thumbs.forEach((item, itemIndex) => item.classList.toggle("is-active", itemIndex === activeIndex));
    if (current) current.textContent = String(activeIndex + 1).padStart(2, "0");
  };

  thumbs.forEach((thumb, index) => thumb.addEventListener("click", () => showImage(index)));
  document.querySelector("[data-gallery-prev]")?.addEventListener("click", () => showImage(activeIndex - 1));
  document.querySelector("[data-gallery-next]")?.addEventListener("click", () => showImage(activeIndex + 1));

});
