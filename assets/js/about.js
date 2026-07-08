(function () {
  const carousel = document.querySelector("[data-facility-carousel]");
  if (!carousel) return;

  const slides = Array.from(carousel.querySelectorAll(".about-facility-carousel__track img"));
  const dots = Array.from(carousel.querySelectorAll(".about-facility-carousel__dots button"));
  if (!slides.length) return;

  let current = 0;
  let timer = null;

  function showSlide(index) {
    current = (index + slides.length) % slides.length;
    slides.forEach((slide, slideIndex) => {
      slide.classList.toggle("is-active", slideIndex === current);
    });
    dots.forEach((dot, dotIndex) => {
      dot.classList.toggle("is-active", dotIndex === current);
    });
  }

  function start() {
    stop();
    timer = window.setInterval(() => showSlide(current + 1), 4200);
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

  carousel.addEventListener("mouseenter", stop);
  carousel.addEventListener("mouseleave", start);
  showSlide(0);
  start();
})();
