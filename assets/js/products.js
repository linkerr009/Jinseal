document.addEventListener("DOMContentLoaded", () => {
  const grid = document.querySelector("[data-products-grid]");
  if (!grid) return;

  const cards = Array.from(grid.querySelectorAll(".products-card"));
  const buttons = Array.from(document.querySelectorAll("[data-category]"));
  const search = document.querySelector("[data-product-search]");
  const empty = document.querySelector("[data-products-empty]");
  let activeCategory = "all";

  const normalize = (value) => (value || "").toLowerCase().trim();

  const applyFilters = () => {
    const query = normalize(search && search.value);
    let visibleCount = 0;

    cards.forEach((card) => {
      const categories = normalize(card.dataset.category).split(/\s+/);
      const text = normalize(`${card.textContent} ${card.dataset.keywords || ""}`);
      const categoryMatch = activeCategory === "all" || categories.includes(activeCategory);
      const searchMatch = !query || text.includes(query);
      const visible = categoryMatch && searchMatch;
      card.hidden = !visible;
      if (visible) visibleCount += 1;
    });

    if (empty) empty.hidden = visibleCount > 0;
  };

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      activeCategory = button.dataset.category || "all";
      buttons.forEach((item) => item.classList.toggle("is-active", item === button));
      applyFilters();
    });
  });

  if (search) {
    search.addEventListener("input", applyFilters);
  }
});
