tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        "secondary-fixed-dim": "#ffb59c",
        "outline-variant": "#c5c5d4",
        "inverse-primary": "#b7c4ff",
        "on-tertiary-fixed-variant": "#7b2f07",
        "inverse-surface": "#2e3132",
        "primary-fixed": "#dce1ff",
        "on-primary": "#ffffff",
        "on-primary-fixed-variant": "#253f97",
        "on-background": "#191c1d",
        "on-surface-variant": "#444652",
        "steel-gray": "#334155",
        "error-container": "#ffdad6",
        "tertiary-fixed-dim": "#ffb598",
        "surface-bright": "#f8f9fa",
        "on-secondary-container": "#5c1a00",
        "surface-variant": "#e1e3e4",
        "deep-navy": "#0F172A",
        "silver-bg": "#F1F5F9",
        "primary-container": "#5fa021",
        "on-error": "#ffffff",
        "surface-tint": "#7DC431",
        "on-primary-fixed": "#001552",
        "surface-container-lowest": "#ffffff",
        "inverse-on-surface": "#f0f1f2",
        "surface-container-high": "#e7e8e9",
        "surface": "#f8f9fa",
        "on-secondary-fixed": "#380c00",
        "primary": "#5fa021",
        "on-surface": "#191c1d",
        "tertiary": "#4b1700",
        "on-error-container": "#93000a",
        "surface-container": "#edeeef",
        "on-secondary": "#ffffff",
        "surface-container-highest": "#e1e3e4",
        "on-tertiary-fixed": "#360f00",
        "secondary-fixed": "#ffdbcf",
        "slate-border": "#E2E8F0",
        "on-tertiary-container": "#f78d5f",
        "secondary": "#5fa021",
        "energy-red": "#7DC431",
        "on-primary-container": "#8ea4ff",
        "tertiary-container": "#6f2600",
        "secondary-container": "#7DC431",
        "surface-container-low": "#f3f4f5",
        "tertiary-fixed": "#ffdbcd",
        "on-tertiary": "#ffffff",
        "error": "#ba1a1a",
        "primary-fixed-dim": "#b7c4ff",
        "on-secondary-fixed-variant": "#822800",
        "surface-dim": "#d9dadb",
        "background": "#f8f9fa",
        "outline": "#757683"
      },
      borderRadius: {
        DEFAULT: "0.125rem",
        lg: "0.25rem",
        xl: "0.5rem",
        full: "0.75rem"
      },
      spacing: {
        "margin-mobile": "16px",
        "section-gap-md": "80px",
        "section-gap-lg": "120px",
        "container-max": "1280px",
        "stack-md": "16px",
        "stack-sm": "8px",
        "stack-lg": "32px",
        "gutter": "24px"
      },
      fontFamily: {
        "headline-lg": ["Hanken Grotesk"],
        "mono-data": ["Inter"],
        "label-sm": ["Inter"],
        "headline-lg-mobile": ["Hanken Grotesk"],
        "headline-xl": ["Hanken Grotesk"],
        "display-lg": ["Hanken Grotesk"],
        "body-md": ["Inter"],
        "body-lg": ["Inter"]
      },
      fontSize: {
        "headline-lg": ["32px", { lineHeight: "1.3", fontWeight: "700" }],
        "mono-data": ["14px", { lineHeight: "1.5", fontWeight: "500" }],
        "label-sm": ["14px", { lineHeight: "1", letterSpacing: "0.05em", fontWeight: "600" }],
        "headline-lg-mobile": ["28px", { lineHeight: "1.3", fontWeight: "700" }],
        "headline-xl": ["48px", { lineHeight: "1.2", fontWeight: "700" }],
        "display-lg": ["64px", { lineHeight: "1.1", letterSpacing: "0", fontWeight: "800" }],
        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
        "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }]
      }
    }
  }
};

document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.querySelector(".xz-header__mobile-btn");
  const menu = document.querySelector("#xz-mobile-menu");

  if (!toggle || !menu) return;

  const icon = toggle.querySelector(".material-symbols-outlined");
  const setMenuState = (open) => {
    toggle.setAttribute("aria-expanded", String(open));
    toggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
    menu.setAttribute("aria-hidden", String(!open));
    menu.classList.toggle("is-open", open);
    document.body.classList.toggle("xz-menu-open", open);
    if (icon) icon.textContent = open ? "close" : "menu";
  };

  toggle.addEventListener("click", () => {
    setMenuState(toggle.getAttribute("aria-expanded") !== "true");
  });

  menu.querySelectorAll(".xz-mobile-menu__group > button").forEach((button) => {
    button.addEventListener("click", () => {
      const open = button.getAttribute("aria-expanded") !== "true";
      button.setAttribute("aria-expanded", String(open));
      button.nextElementSibling?.classList.toggle("is-open", open);
    });
  });

  menu.querySelectorAll("a").forEach((link) => {
    link.addEventListener("click", () => setMenuState(false));
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") setMenuState(false);
  });

  window.matchMedia("(min-width: 861px)").addEventListener("change", (event) => {
    if (event.matches) setMenuState(false);
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const modal = document.querySelector("[data-inquiry-modal]");
  const mount = modal?.querySelector("[data-inquiry-modal-mount]");
  const formCard = document.querySelector("[data-inquiry-form-card]");
  const triggers = document.querySelectorAll("[data-inquiry-popup]");

  if (!modal || !mount || !formCard || triggers.length === 0) return;

  let placeholder = null;
  let previousFocus = null;
  let closeTimer = null;

  const closeButton = modal.querySelector(".xz-inquiry-modal__close");
  const focusableSelector = "a[href], button:not([disabled]), input:not([disabled]), textarea:not([disabled]), select:not([disabled]), [tabindex]:not([tabindex='-1'])";

  const openModal = (trigger) => {
    if (closeTimer) {
      window.clearTimeout(closeTimer);
      closeTimer = null;
    }

    previousFocus = trigger;
    placeholder = document.createElement("div");
    placeholder.className = "xz-inquiry-placeholder";
    placeholder.style.height = `${formCard.getBoundingClientRect().height}px`;
    formCard.before(placeholder);
    mount.append(formCard);

    modal.hidden = false;
    document.body.classList.add("xz-modal-open");
    window.requestAnimationFrame(() => {
      modal.classList.add("is-open");
      closeButton?.focus();
    });
  };

  const closeModal = () => {
    if (modal.hidden) return;

    modal.classList.remove("is-open");
    document.body.classList.remove("xz-modal-open");
    closeTimer = window.setTimeout(() => {
      if (placeholder?.isConnected) placeholder.replaceWith(formCard);
      placeholder = null;
      modal.hidden = true;
      previousFocus?.focus();
      closeTimer = null;
    }, 220);
  };

  triggers.forEach((trigger) => {
    trigger.addEventListener("click", (event) => {
      event.preventDefault();
      openModal(trigger);
    });
  });

  modal.querySelectorAll("[data-inquiry-close]").forEach((button) => {
    button.addEventListener("click", closeModal);
  });

  modal.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeModal();
      return;
    }

    if (event.key !== "Tab") return;
    const focusable = Array.from(modal.querySelectorAll(focusableSelector)).filter((element) => element.offsetParent !== null);
    if (focusable.length === 0) return;

    const first = focusable[0];
    const last = focusable[focusable.length - 1];
    if (event.shiftKey && document.activeElement === first) {
      event.preventDefault();
      last.focus();
    } else if (!event.shiftKey && document.activeElement === last) {
      event.preventDefault();
      first.focus();
    }
  });
});
