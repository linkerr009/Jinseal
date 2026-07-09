document.addEventListener("DOMContentLoaded", () => {
  const grid = document.querySelector("[data-products-grid]");
  if (!grid) return;

  const cards = Array.from(grid.querySelectorAll(".products-card"));
  const buttons = Array.from(document.querySelectorAll("[data-category-list] [data-category]"));
  const search = document.querySelector("[data-product-search]");
  const empty = document.querySelector("[data-products-empty]");
  const hashToCategory = {
    "metallic-gasket": "metallic",
    "non-metallic-gasket": "non-metallic",
    "gasket-sheet": "sheet",
    "gland-packing": "packing",
    "gasket-materials": "materials"
  };
  let activeCategory = "metallic";

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

  const activateCategory = (category, shouldUpdateHash = true) => {
    activeCategory = category || "metallic";

    buttons.forEach((item) => {
      const isActive = item.dataset.category === activeCategory;
      item.classList.toggle("is-active", isActive);

      if (isActive && shouldUpdateHash && item.dataset.categoryHash) {
        history.replaceState(null, "", `#${item.dataset.categoryHash}`);
      }
    });

    applyFilters();
  };

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      activateCategory(button.dataset.category || "metallic");
    });
  });

  if (search) {
    search.addEventListener("input", applyFilters);
  }

  window.addEventListener("hashchange", () => {
    activateCategory(hashToCategory[window.location.hash.replace("#", "")] || "metallic", false);
  });

  cards.forEach((card) => {
    const link = card.querySelector("a[href]");
    if (!link) return;

    card.setAttribute("tabindex", "0");
    card.setAttribute("role", "link");
    const title = card.querySelector("h3");
    card.setAttribute("aria-label", `${title ? title.textContent.trim() : "Product"} details`);

    card.addEventListener("click", (event) => {
      if (event.target.closest("a, button, input, textarea, select")) return;
      window.location.href = link.href;
    });

    card.addEventListener("keydown", (event) => {
      if (event.key !== "Enter" && event.key !== " ") return;
      event.preventDefault();
      window.location.href = link.href;
    });
  });

  activateCategory(hashToCategory[window.location.hash.replace("#", "")] || "metallic", false);
});
