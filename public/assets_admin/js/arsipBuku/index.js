
        document.addEventListener('DOMContentLoaded', function() {
            // Select All functionality
            const selectAll = document.getElementById('selectAll');
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const bulkRestoreBtn = document.getElementById('bulkRestoreBtn');
            const selectedIdsInput = document.getElementById('selectedIds');
            const selectedIdsRestoreInput = document.getElementById('selectedIdsRestore');

            selectAll.addEventListener('change', function() {
                const isChecked = this.checked;
                rowCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                    checkbox.parentElement.parentElement.classList.toggle('bg-[#A4B465]/10',
                        isChecked);
                });
                updateBulkButtons();
            });

            // Individual checkbox change
            rowCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    this.parentElement.parentElement.classList.toggle('bg-[#A4B465]/10', this
                        .checked);

                    if (!this.checked) {
                        selectAll.checked = false;
                    } else {
                        const allChecked = Array.from(rowCheckboxes).every(cb => cb.checked);
                        selectAll.checked = allChecked;
                    }
                    updateBulkButtons();
                });
            });

            function updateBulkButtons() {
                const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;

                if (checkedCount > 0) {
                    bulkDeleteBtn.disabled = false;
                    bulkRestoreBtn.disabled = false;
                    bulkDeleteBtn.innerHTML =
                        `<i class="fas fa-trash-alt text-sm"></i><span>Hapus (${checkedCount}) Data</span>`;
                    bulkRestoreBtn.innerHTML =
                        `<i class="fas fa-undo-alt text-sm"></i><span>Pulihkan (${checkedCount}) Data</span>`;

                    const checkedIds = Array.from(document.querySelectorAll('.row-checkbox:checked')).map(cb => cb
                        .value);
                    selectedIdsInput.value = checkedIds.join(',');
                    selectedIdsRestoreInput.value = checkedIds.join(',');
                } else {
                    bulkDeleteBtn.disabled = true;
                    bulkRestoreBtn.disabled = true;
                    bulkDeleteBtn.innerHTML =
                        `<i class="fas fa-trash-alt text-sm"></i><span>Hapus Data Terpilih</span>`;
                    bulkRestoreBtn.innerHTML =
                        `<i class="fas fa-undo-alt text-sm"></i><span>Pulihkan Data Terpilih</span>`;
                }
            }

            // Delete confirmation with SweetAlert-like styling
            document.querySelectorAll('.delete-permanent-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const bookTitle = this.getAttribute('data-title');
                    const form = this.closest('form');

                    // Custom confirmation dialog
                    if (confirm(
                            `Hapus permanen buku "${bookTitle}"?\n\nTindakan ini tidak dapat dibatalkan!`
                        )) {
                        form.submit();
                    }
                });
            });

            // Bulk actions confirmation
            document.getElementById('bulkDeleteArchiveForm').addEventListener('submit', function(e) {
                const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
                if (checkedCount === 0) {
                    e.preventDefault();
                    return;
                }

                if (!confirm(
                        `Hapus permanen ${checkedCount} buku terpilih?\n\nTindakan ini tidak dapat dibatalkan!`
                    )) {
                    e.preventDefault();
                }
            });

            document.getElementById('bulkRestoreForm').addEventListener('submit', function(e) {
                const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
                if (checkedCount === 0) {
                    e.preventDefault();
                    return;
                }

                if (!confirm(
                        `Pulihkan ${checkedCount} buku terpilih?\n\nBuku akan dikembalikan ke data aktif.`
                    )) {
                    e.preventDefault();
                }
            });

            // Add animation to table rows on load
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateY(20px)';

                setTimeout(() => {
                    row.style.transition = 'all 0.5s ease';
                    row.style.opacity = '1';
                    row.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
   
        
