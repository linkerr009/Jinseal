document.addEventListener("DOMContentLoaded", () => {
  const grid = document.querySelector("[data-products-grid]");
  if (!grid) return;

  const cards = Array.from(grid.querySelectorAll(".products-card"));
  const search = document.querySelector("[data-product-search]");
  const empty = document.querySelector("[data-products-empty]");

  const normalize = (value) => (value || "").toLowerCase().trim();

  const applyFilters = () => {
    const query = normalize(search && search.value);
    let visibleCount = 0;

    cards.forEach((card) => {
      const text = normalize(`${card.textContent} ${card.dataset.keywords || ""}`);
      const searchMatch = !query || text.includes(query);
      const visible = searchMatch;
      card.hidden = !visible;
      if (visible) visibleCount += 1;
    });

    if (empty) empty.hidden = visibleCount > 0;
  };

  if (search) {
    search.addEventListener("input", applyFilters);
  }

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

  applyFilters();
});
