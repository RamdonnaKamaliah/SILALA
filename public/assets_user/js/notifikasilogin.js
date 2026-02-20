document.addEventListener("DOMContentLoaded", () => {
  const toast = document.getElementById("toast-success");
  if (!toast) return;

  setTimeout(() => {
    toast.classList.add("opacity-0", "translate-x-6");
    setTimeout(() => toast.remove(), 500);
  }, 3000);
});
