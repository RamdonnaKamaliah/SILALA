
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi Select All
            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkDeleteForm = document.getElementById('bulkDeleteForm');

            selectAll.addEventListener('change', function() {
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = selectAll.checked;
                });
                updateBulkDeleteButton();
            });

            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateBulkDeleteButton);
            });

            function updateBulkDeleteButton() {
                const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
                if (checkedBoxes.length > 0) {
                    bulkDeleteBtn.disabled = false;
                    bulkDeleteBtn.classList.remove('bg-gray-400', 'cursor-not-allowed', 'opacity-50');
                    bulkDeleteBtn.classList.add('bg-red-600', 'cursor-pointer', 'opacity-100', 'hover:bg-red-700');

                    // Tambahkan event listener untuk bulk delete
                    bulkDeleteBtn.onclick = function() {
                        if (confirm(
                                `Apakah Anda yakin ingin menghapus ${checkedBoxes.length} buku yang dipilih?`
                            )) {
                            bulkDeleteForm.submit();
                        }
                    };
                } else {
                    bulkDeleteBtn.disabled = true;
                    bulkDeleteBtn.classList.add('bg-gray-400', 'cursor-not-allowed', 'opacity-50');
                    bulkDeleteBtn.classList.remove('bg-red-600', 'cursor-pointer', 'opacity-100',
                        'hover:bg-red-700');
                    bulkDeleteBtn.onclick = null;
                }
            }

            // Fungsi Search
            const searchInput = document.getElementById('search');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#dataTable tbody tr');

                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        if (text.includes(searchTerm)) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    });
                });
            }

            // Fungsi Entries
            const entriesSelect = document.getElementById('entries');
            if (entriesSelect) {
                entriesSelect.addEventListener('change', function() {
                    // Implementasi pagination berdasarkan jumlah entries
                    console.log('Entries changed to:', this.value);
                    // Di sini Anda bisa menambahkan logika untuk mengubah jumlah data yang ditampilkan
                });
            }
        });
    