// INPUT PASSWORD
function togglePassword(inputId, eyeIconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(eyeIconId);
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.setAttribute('data-icon', 'mdi:eye-outline');
    } else {
        passwordInput.type = 'password';
        eyeIcon.setAttribute('data-icon', 'mdi:eye-off-outline');
    }
    
    // Refresh iconify icon
    if (window.iconify) {
        window.iconify.scan(eyeIcon);
    }
}

//PREVIEW FOTO
function previewImage(input) {
    const preview = document.getElementById('preview-foto');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
