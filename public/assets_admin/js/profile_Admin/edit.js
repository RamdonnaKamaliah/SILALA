
document.addEventListener('DOMContentLoaded', function() {
    // ===========================================
    // AUTO REDIRECT AFTER SUCCESS dengan Sweet Alert
    // ===========================================
 

    // ===========================================
    // PREVIEW FOTO REAL-TIME
    // ===========================================
    const fotoInput = document.getElementById('fotoInput');
    const previewImage = document.getElementById('previewImage');
    
    fotoInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                checkProfileChanges();
            }
            reader.readAsDataURL(file);
        }
    });

    // ===========================================
    // DETECT CHANGES - FORM PROFILE
    // ===========================================
    const btnSaveProfile = document.getElementById('btnSaveProfile');
    const nameInput = document.getElementById('nameInput');
    const telpInput = document.getElementById('telpInput');
    
    const initialName = nameInput.value;
    const initialTelp = telpInput.value;
    let fotoChanged = false;
    
    function checkProfileChanges() {
        const nameChanged = nameInput.value !== initialName;
        const telpChanged = telpInput.value !== initialTelp;
        fotoChanged = fotoInput.files.length > 0;
        
        const hasChanges = nameChanged || telpChanged || fotoChanged;
        
        btnSaveProfile.disabled = !hasChanges;
        
        if (hasChanges) {
            btnSaveProfile.classList.remove('bg-gray-400');
            btnSaveProfile.classList.add('bg-gradient-to-r', 'from-[#A4B465]', 'to-[#8C9E55]', 'hover:from-[#8C9E55]', 'hover:to-[#6E7C45]', 'hover:scale-[1.02]');
        } else {
            btnSaveProfile.classList.add('bg-gray-400');
            btnSaveProfile.classList.remove('bg-gradient-to-r', 'from-[#A4B465]', 'to-[#8C9E55]', 'hover:from-[#8C9E55]', 'hover:to-[#6E7C45]', 'hover:scale-[1.02]');
        }
    }
    
    nameInput.addEventListener('input', checkProfileChanges);
    telpInput.addEventListener('input', checkProfileChanges);
    fotoInput.addEventListener('change', checkProfileChanges);

    // ===========================================
    // DETECT CHANGES - FORM PASSWORD
    // ===========================================
    const btnSavePassword = document.getElementById('btnSavePassword');
    const currentPassword = document.getElementById('currentPassword');
    const newPassword = document.getElementById('newPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    
    function checkPasswordChanges() {
        const hasChanges = currentPassword.value.length > 0 || 
                          newPassword.value.length > 0 || 
                          confirmPassword.value.length > 0;
        
        btnSavePassword.disabled = !hasChanges;
        
        if (hasChanges) {
            btnSavePassword.classList.remove('bg-gray-400');
            btnSavePassword.classList.add('bg-gradient-to-r', 'from-[#6E7C45]', 'to-[#5E6A3A]', 'hover:from-[#5E6A3A]', 'hover:to-[#4E5A2A]', 'hover:scale-[1.02]');
        } else {
            btnSavePassword.classList.add('bg-gray-400');
            btnSavePassword.classList.remove('bg-gradient-to-r', 'from-[#6E7C45]', 'to-[#5E6A3A]', 'hover:from-[#5E6A3A]', 'hover:to-[#4E5A2A]', 'hover:scale-[1.02]');
        }
    }
    
    currentPassword.addEventListener('input', checkPasswordChanges);
    newPassword.addEventListener('input', checkPasswordChanges);
    confirmPassword.addEventListener('input', checkPasswordChanges);
});

