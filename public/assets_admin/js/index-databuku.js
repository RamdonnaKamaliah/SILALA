    $(document).ready(function() {
    const table = $('#dataTable').DataTable({
        language: { url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
        pageLength: 10,
        scrollX: true
    });

    $('#entries').on('change', function() {
        table.page.len($(this).val()).draw();
    });
    $('#search').on('keyup', function() {
        table.search(this.value).draw();
    });

    $('#selectAll').on('click', function() {
        $('.row-checkbox').prop('checked', this.checked);
        updateBulkButton();
    });
    $(document).on('change', '.row-checkbox', updateBulkButton);

    function updateBulkButton() {
        const checked = $('.row-checkbox:checked').length;
        const btn = $('#bulkDeleteBtn');
        if (checked > 0) {
            btn.prop('disabled', false)
               .removeClass('cursor-not-allowed opacity-50')
               .html(`<i class="fa-solid fa-trash"></i> Hapus (${checked}) Data Terpilih`);
        } else {
            btn.prop('disabled', true)
               .addClass('cursor-not-allowed opacity-50')
               .html(`<i class="fa-solid fa-trash"></i> Hapus Data Terpilih`);
        }
    }

    // === BULK DELETE FIX ===
    $('#bulkDeleteBtn').on('click', function(e) {
        e.preventDefault();

        const checked = $('.row-checkbox:checked');
        if (checked.length === 0) return;

        Swal.fire({
            title: 'Yakin hapus data terpilih?',
            text: `Sebanyak ${checked.length} buku akan dihapus permanen!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = $('#bulkDeleteForm');
                form.find('input[name="selected_ids[]"]').remove();
                checked.each(function() {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'selected_ids[]',
                        value: $(this).val()
                    }).appendTo(form);
                });

                form.submit(); // 🔥 langsung kirim POST
            }
        });
    });

    // === DELETE SATUAN ===
    $('.delete-btn').on('click', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Yakin hapus data ini?',
            text: 'Data buku akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/admin/data_buku/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(() => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data buku berhasil dihapus!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => location.reload());
                });
            }
        });
    });
});
