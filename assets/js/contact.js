document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("[data-contact-form]");
  if (!form) return;

  const status = form.querySelector("[data-contact-status]");

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    if (!form.reportValidity()) return;

    const data = new FormData(form);
    const subject = `JinSeal inquiry from ${data.get("name") || "website visitor"}`;
    const body = [
      `Name: ${data.get("name") || ""}`,
      `Email: ${data.get("email") || ""}`,
      `Phone: ${data.get("phone") || ""}`,
      `Industry: ${data.get("industry") || ""}`,
      `Product Interest: ${data.get("product") || ""}`,
      "",
      "Message:",
      data.get("message") || ""
    ].join("\n");

    const mailto = `mailto:info@ginseal.com?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    window.location.href = mailto;

    if (status) {
      status.innerHTML = 'Your email app should open now. You can also email us directly: <a href="mailto:info@ginseal.com">info@ginseal.com</a>';
    }
  });
});
