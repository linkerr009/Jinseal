(function () {
  const carousel = document.querySelector("[data-facility-carousel]");
  if (!carousel) return;

  const slides = Array.from(carousel.querySelectorAll(".about-facility-carousel__track img"));
  const dots = Array.from(carousel.querySelectorAll(".about-facility-carousel__dots button"));
  const prevButton = carousel.querySelector("[data-facility-prev]");
  const nextButton = carousel.querySelector("[data-facility-next]");
  if (!slides.length) return;

  let current = 0;
  let timer = null;
  let pointerStartX = null;

  function showSlide(index) {
    current = (index + slides.length) % slides.length;
    slides.forEach((slide, slideIndex) => {
      slide.classList.toggle("is-active", slideIndex === current);
    });
    dots.forEach((dot, dotIndex) => {
      dot.classList.toggle("is-active", dotIndex === current);
    });
  }

  function nextSlide() {
    showSlide(current + 1);
  }

  function prevSlide() {
    showSlide(current - 1);
  }

  function start() {
    stop();
    timer = window.setInterval(nextSlide, 4200);
  }

  function stop() {
    if (timer) {
      window.clearInterval(timer);
      timer = null;
    }
  }

  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => {
      showSlide(index);
      start();
    });
  });

  prevButton?.addEventListener("click", () => {
    prevSlide();
    start();
  });

  nextButton?.addEventListener("click", () => {
    nextSlide();
    start();
  });

  carousel.addEventListener("pointerdown", (event) => {
    pointerStartX = event.clientX;
    stop();
  });

  carousel.addEventListener("pointerup", (event) => {
    if (pointerStartX !== null) {
      const delta = event.clientX - pointerStartX;
      if (Math.abs(delta) > 36) {
        delta < 0 ? nextSlide() : prevSlide();
      }
    }
    pointerStartX = null;
    start();
  });

  carousel.addEventListener("pointercancel", () => {
    pointerStartX = null;
    start();
  });

  carousel.addEventListener("mouseenter", stop);
  carousel.addEventListener("mouseleave", start);
  showSlide(0);
  start();
})();

(function () {
  const shell = document.querySelector("[data-timeline-carousel]");
  if (!shell) return;

  const track = shell.querySelector(".about-timeline");
  const prevButton = shell.querySelector("[data-timeline-prev]");
  const nextButton = shell.querySelector("[data-timeline-next]");
  const toggleButton = shell.querySelector("[data-timeline-toggle]");
  if (!track) return;

  let timer = null;
  let isPlaying = true;
  let dragStartX = 0;
  let dragStartScroll = 0;
  let isDragging = false;

  function stepSize() {
    const item = track.querySelector("article");
    if (!item) return 320;
    const rect = item.getBoundingClientRect();
    return rect.width + 56;
  }

  function scrollByStep(direction) {
    const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
    const atStart = track.scrollLeft <= 4;

    if (direction > 0 && atEnd) {
      track.scrollTo({ left: 0, behavior: "smooth" });
      return;
    }

    if (direction < 0 && atStart) {
      track.scrollTo({ left: track.scrollWidth, behavior: "smooth" });
      return;
    }

    track.scrollBy({ left: direction * stepSize(), behavior: "smooth" });
  }

  function start() {
    stop();
    if (!isPlaying) return;
    timer = window.setInterval(() => scrollByStep(1), 3600);
  }

  function stop() {
    if (timer) {
      window.clearInterval(timer);
      timer = null;
    }
  }

  function updateToggleIcon() {
    const icon = toggleButton?.querySelector(".material-symbols-outlined");
    if (!icon) return;
    icon.textContent = isPlaying ? "pause" : "play_arrow";
    toggleButton.classList.toggle("is-playing", isPlaying);
    toggleButton.setAttribute("aria-label", isPlaying ? "Pause milestone carousel" : "Play milestone carousel");
  }

  prevButton?.addEventListener("click", () => {
    scrollByStep(-1);
    start();
  });

  nextButton?.addEventListener("click", () => {
    scrollByStep(1);
    start();
  });

  toggleButton?.addEventListener("click", () => {
    isPlaying = !isPlaying;
    updateToggleIcon();
    start();
  });

  track.addEventListener("pointerdown", (event) => {
    isDragging = true;
    dragStartX = event.clientX;
    dragStartScroll = track.scrollLeft;
    track.classList.add("is-dragging");
    track.setPointerCapture?.(event.pointerId);
    stop();
  });

  track.addEventListener("pointermove", (event) => {
    if (!isDragging) return;
    track.scrollLeft = dragStartScroll - (event.clientX - dragStartX);
  });

  function endDrag(event) {
    if (!isDragging) return;
    isDragging = false;
    track.classList.remove("is-dragging");
    track.releasePointerCapture?.(event.pointerId);
    start();
  }

  track.addEventListener("pointerup", endDrag);
  track.addEventListener("pointercancel", endDrag);
  shell.addEventListener("mouseenter", stop);
  shell.addEventListener("mouseleave", start);

  updateToggleIcon();
  start();
})();
