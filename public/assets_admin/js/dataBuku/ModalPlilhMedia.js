const modal = document.getElementById("imageModal");
const openBtn = document.getElementById("openModalBtn");
const closeBtn = document.getElementById("closeModalBtn");
const preview = document.getElementById("previewImage");
const input = document.getElementById("selectedImageInput");

// Open modal
openBtn.addEventListener("click", () => {
    modal.classList.remove("hidden");
    modal.classList.add("flex");
});

// Close modal
closeBtn.addEventListener("click", () => {
    modal.classList.remove("flex");
    modal.classList.add("hidden");
});

// choose image
function selectImage(id, url) {
    document.getElementById("selectedImageInput").value = id;

    document.getElementById("previewImage").src = url;
    document.getElementById("previewImage").classList.remove("hidden");

    document.getElementById("imageModal").classList.add("hidden");
}
