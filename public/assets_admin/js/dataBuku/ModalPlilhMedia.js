const modal = document.getElementById("modalGambar");
const openBtn = document.getElementById("openModalBtn");
const closeBtn = document.getElementById("closeModalBtn");

const preview = document.getElementById("previewImage");
const inputHidden = document.getElementById("gambar_buku");

openBtn.addEventListener("click", () => {
    modal.classList.remove("hidden");
    modal.classList.add("flex");
});

closeBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
    modal.classList.remove("flex");
});

function pilihGambar(pathFile, urlImage) {
    preview.src = urlImage;
    inputHidden.value = pathFile;

    modal.classList.add("hidden");
    modal.classList.remove("flex");
}
