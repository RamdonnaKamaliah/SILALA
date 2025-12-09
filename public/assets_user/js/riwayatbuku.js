document.addEventListener("DOMContentLoaded", () => {

    /* ==========================
       DROPDOWN PROFILE
       ========================== */
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownButton && dropdownMenu) {
        dropdownButton.addEventListener('click', function () {
            dropdownMenu.classList.toggle('hidden');
            const icon = dropdownButton.querySelector('.iconify');
            icon?.classList.toggle('rotate-180');
        });

        document.addEventListener('click', function (e) {
            const wrapper = document.getElementById('dropdownWrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                const icon = dropdownButton.querySelector('.iconify');
                icon?.classList.remove('rotate-180');
            }
        });
    }

    /* ==========================
       VARIABEL GLOBAL
       ========================== */
    let streamAktif = null;
    let fotoDiambil = false;
    let bukuDipilih = null;
    let modeKamera = null;

    /* elemen */
    const modal = document.getElementById('pengembalianModal');
    const overlay = document.getElementById('modalOverlay');
    const btnBatalModal = document.getElementById('btnBatalModal');
    const selectBukuModal = document.getElementById('selectBukuModal');
    const kameraArea = document.getElementById('kameraArea');


    /* ==========================
       HELPER MODAL
       ========================== */
    function openModal() {
        if (!modal || !overlay) return;

        document.body.classList.add('modal-open', 'overflow-hidden');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.add('opacity-100'), 10);

        modal.classList.remove('hidden');
        selectBukuModal?.focus();
    }

    function closeModal() {
        if (!modal || !overlay) return;

        document.body.classList.remove('modal-open', 'overflow-hidden');
        overlay.classList.remove('opacity-100');
        setTimeout(() => overlay.classList.add('hidden'), 200);

        modal.classList.add('hidden');
        hentikanKamera();
        resetModal();
    }

    window.bukaModalPengembalian = function () {
        resetModal();
        openModal();
    };


    function resetModal() {
        kameraArea?.classList.add('hidden');
        document.getElementById('previewContainer')?.classList.add('hidden');

        document.getElementById('btnAmbilFoto')?.classList.remove('hidden');
        document.getElementById('btnKirimFoto')?.classList.add('hidden');

        fotoDiambil = false;
        bukuDipilih = null;
        modeKamera = null;

        document.getElementById('btnKameraDepan')?.classList.remove('bg-[#4C6444]', 'text-white');
        document.getElementById('btnKameraBelakang')?.classList.remove('bg-[#4C6444]', 'text-white');
    }

    /* ==========================
       PILIH KAMERA
       ========================== */
    window.pilihKamera = async function (facingMode) {
        const select = selectBukuModal;
        if (!select) return;

        bukuDipilih = select.value;
        if (!bukuDipilih) {
            alert('Silakan pilih buku terlebih dahulu');
            return;
        }

        const selectedOption = select.options[select.selectedIndex];
        document.getElementById('judulBukuKamera').textContent = selectedOption.text;

        document.getElementById('btnKameraDepan')?.classList.remove('bg-[#4C6444]', 'text-white');
        document.getElementById('btnKameraBelakang')?.classList.remove('bg-[#4C6444]', 'text-white');

        if (facingMode === 'user') {
            document.getElementById('btnKameraDepan')?.classList.add('bg-[#4C6444]', 'text-white');
        } else {
            document.getElementById('btnKameraBelakang')?.classList.add('bg-[#4C6444]', 'text-white');
        }

        modeKamera = facingMode;

        kameraArea?.classList.remove('hidden');
        document.getElementById('previewContainer')?.classList.add('hidden');

        document.getElementById('btnAmbilFoto')?.classList.remove('hidden');
        document.getElementById('btnKirimFoto')?.classList.add('hidden');

        hentikanKamera();

        try {
            streamAktif = await navigator.mediaDevices.getUserMedia({
                video: { facingMode, width: { ideal: 1280 }, height: { ideal: 720 } }
            });

            const videoElement = document.getElementById('kameraStream');
            videoElement.srcObject = streamAktif;
            videoElement.classList.remove('hidden');
        } catch (err) {
            console.error(err);
            alert('Tidak dapat mengakses kamera.');
            kameraArea?.classList.add('hidden');
        }
    };


    /* ==========================
       AMBIL FOTO
       ========================== */
    window.ambilFoto = function () {
        if (!streamAktif) {
            alert('Kamera belum aktif');
            return;
        }

        const video = document.getElementById('kameraStream');
        const canvas = document.getElementById('fotoCanvas');
        const ctx = canvas.getContext('2d');

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

        document.getElementById('previewFoto').src = canvas.toDataURL('image/png');
        document.getElementById('previewContainer')?.classList.remove('hidden');
        video.classList.add('hidden');

        document.getElementById('btnAmbilFoto')?.classList.add('hidden');
        document.getElementById('btnKirimFoto')?.classList.remove('hidden');

        fotoDiambil = true;
        hentikanKamera();
    };


    /* ==========================
       KIRIM FOTO
       ========================== */
    window.kirimFoto = async function () {
        if (!fotoDiambil || !bukuDipilih) {
            alert('Silakan ambil foto dan pilih buku');
            return;
        }

        const canvas = document.getElementById('fotoCanvas');
        const imageData = canvas.toDataURL('image/png');

        const btnKirim = document.getElementById('btnKirimFoto');
        const originalText = btnKirim.innerHTML;

        btnKirim.innerHTML = '<span class="iconify animate-spin" data-icon="mdi:loading"></span> Mengirim...';
        btnKirim.disabled = true;

        try {
            const blob = await fetch(imageData).then(r => r.blob());
            const formData = new FormData();

            formData.append('buku_id', bukuDipilih);
            formData.append('foto', blob, `pengembalian_${Date.now()}.png`);
            formData.append('_token', '{{ csrf_token() }}');

            const response = await fetch('{{ route("user.kembalikan.buku.foto") }}', {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            });

            const result = await response.json();

            if (result.success) {
                alert('Foto berhasil dikirim!');
                closeModal();
                window.location.reload();
            } else {
                throw new Error(result.message || 'Gagal');
            }
        } catch (err) {
            alert('Gagal mengirim foto: ' + err.message);
            btnKirim.innerHTML = originalText;
            btnKirim.disabled = false;
        }
    };


    /* ==========================
       HENTIKAN KAMERA
       ========================== */
    function hentikanKamera() {
        if (streamAktif) {
            streamAktif.getTracks().forEach(t => t.stop());
            streamAktif = null;
        }
    }

    /* ==========================
       EVENT MODAL
       ========================== */
    overlay?.addEventListener('click', closeModal);
    btnBatalModal?.addEventListener('click', closeModal);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && document.body.classList.contains('modal-open')) {
            closeModal();
        }
    });

    selectBukuModal?.addEventListener('change', function () {
        if (streamAktif) {
            hentikanKamera();
            kameraArea?.classList.add('hidden');
            fotoDiambil = false;
            modeKamera = null;
        }
    });

    modal?.addEventListener('click', function (e) {
        const inner = modal.querySelector('.bg-white');
        if (!inner.contains(e.target)) closeModal();
    });

});
