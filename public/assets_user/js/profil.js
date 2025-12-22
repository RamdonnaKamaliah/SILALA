document.addEventListener('DOMContentLoaded', () => {
    const profileEl = document.getElementById('profile-page');
    const message = profileEl.dataset.successMessage;
    const type = profileEl.dataset.alertType;

    if (message) {
        Swal.fire({
            icon: type || 'success',
            title: message,
            timer: 2000,
            showConfirmButton: false
        });
    }
});
