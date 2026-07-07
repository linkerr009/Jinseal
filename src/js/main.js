  (function () {
    const tabsRoot = document.querySelector('[data-product-tabs]');
    if (!tabsRoot) return;

    const tabs = Array.from(tabsRoot.querySelectorAll('[data-tab-target]'));
    const panels = Array.from(document.querySelectorAll('[data-tab-panel]'));

    function activateTab(target) {
      tabs.forEach((tab) => {
        const isActive = tab.dataset.tabTarget === target;
        tab.classList.toggle('is-active', isActive);
        tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
      });

      panels.forEach((panel) => {
        panel.hidden = panel.dataset.tabPanel !== target;
      });
    }

    tabs.forEach((tab) => {
      tab.setAttribute('aria-selected', tab.classList.contains('is-active') ? 'true' : 'false');
      tab.addEventListener('click', () => activateTab(tab.dataset.tabTarget));
    });

    activateTab('all');
  })();
