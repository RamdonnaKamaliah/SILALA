    function showNotification(message, type = 'success') {
    Swal.fire({
        icon: type === 'success' ? 'success' : 'error',
        title: message,
        timer: 2000,
        timerProgressBar: true,
        showConfirmButton: false,
        allowOutsideClick: false
    });
}
