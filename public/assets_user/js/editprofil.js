// ===============================
// TOGGLE PASSWORD
// ===============================
function togglePassword(inputId, eyeIconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(eyeIconId);

    if (!passwordInput) return; // jika input tidak ditemukan

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.setAttribute("data-icon", "mdi:eye-outline");
    } else {
        passwordInput.type = "password";
        eyeIcon.setAttribute("data-icon", "mdi:eye-off-outline");
    }

    if (window.iconify) window.iconify.scan(eyeIcon);
}



// ===============================
// PREVIEW FOTO
// ===============================
function previewImage(input) {
    const preview = document.getElementById("preview-foto");
    if (!preview || !input.files || !input.files[0]) return;

    const reader = new FileReader();
    reader.onload = (e) => (preview.src = e.target.result);
    reader.readAsDataURL(input.files[0]);
}



// ===============================
// SWEETALERT KONFIRMASI SUBMIT
// ===============================
function confirmSubmit() {
    const form = document.getElementById("formEditProfil");

    if (!form) {
        console.error("Form Edit Profil TIDAK ditemukan!");
        return;
    }

    Swal.fire({
        title: "Simpan Perubahan?",
        text: "Pastikan data yang diubah sudah benar.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#8CA47E",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Simpan",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
