function togglePassword() {
    const passwords = document.querySelectorAll('.password-text');
    const copyButtons = document.querySelectorAll('.copy-btn');
    const eyeIcon = document.getElementById('eyeIcon');

    const isHidden = passwords[0]?.classList.contains('blur-sm');

    passwords.forEach(el => {
        if (isHidden) {
            el.classList.remove('blur-sm');
            el.dataset.visible = "true";
        } else {
            el.classList.add('blur-sm');
            el.dataset.visible = "false";
        }
    });

    copyButtons.forEach(btn => {
        if (isHidden) {
            btn.classList.remove('hidden');
        } else {
            btn.classList.add('hidden');
        }
    });

    eyeIcon.classList.toggle('fa-eye');
    eyeIcon.classList.toggle('fa-eye-slash');
}

/* COPY PER BARIS */
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.copy-btn');
    if (!btn) return;

    const password = btn.dataset.password;

    navigator.clipboard.writeText(password).then(() => {
        btn.innerHTML = '<i class="fas fa-check text-green-600"></i>';

        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-copy"></i>';
        }, 1000);
    });
});

/* COPY EMAIL */
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.copy-email-btn');
    if (!btn) return;

    const email = btn.dataset.email;

    navigator.clipboard.writeText(email).then(() => {
        btn.innerHTML = '<i class="fas fa-check text-green-600"></i>';

        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-copy"></i>';
        }, 1000);
    });
});
