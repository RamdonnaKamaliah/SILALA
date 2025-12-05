document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const tableRows = document.querySelectorAll('#tableBody tr, .lg\\:hidden .bg-white[data-status]');
    const emptyFilterState = document.getElementById('emptyFilterState');
    const desktopTable = document.querySelector('.hidden.lg\\:block');
    const mobileCards = document.querySelector('.lg\\:hidden');
    
    if (tableRows.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const status = this.getAttribute('data-status');
                
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.remove('active', 'ring-2', 'ring-[#A4B465]', 'ring-offset-2');
                    if (btn.getAttribute('data-status') === 'all') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-all duration-200 flex items-center gap-2';
                    } else if (btn.getAttribute('data-status') === 'dipinjam') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-all duration-200 flex items-center gap-2';
                    } else if (btn.getAttribute('data-status') === 'dikembalikan') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-green-50 text-green-700 border border-green-200 hover:bg-green-100 transition-all duration-200 flex items-center gap-2';
                    } else if (btn.getAttribute('data-status') === 'bermasalah') {
                        btn.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-red-50 text-red-700 border border-red-200 hover:bg-red-100 transition-all duration-200 flex items-center gap-2';
                    }
                });
                
                this.classList.add('active', 'ring-2', 'ring-[#A4B465]', 'ring-offset-2');
                if (status === 'all') {
                    this.className = 'filter-btn px-4 py-2.5 rounded-xl text-sm font-medium bg-[#A4B465] text-white border border-[#A4B465] hover:bg-[#8a9a58] transition-all duration-200 shadow-sm active transform hover:scale-105 flex items-center gap-2 ring-2 ring-[#A4B465] ring-offset-2';
                }
                
                let visibleRows = 0;
                
                // Filter rows
                tableRows.forEach(row => {
                    if (status === 'all') {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        const rowStatus = row.getAttribute('data-status');
                        if (rowStatus === status) {
                            row.style.display = '';
                            visibleRows++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                // Tampilkan pesan kosong jika tidak ada baris yang terlihat
                if (visibleRows === 0) {
                    if (desktopTable) desktopTable.style.display = 'none';
                    if (mobileCards) mobileCards.style.display = 'none';
                    if (emptyFilterState) emptyFilterState.classList.remove('hidden');
                } else {
                    if (desktopTable) desktopTable.style.display = '';
                    if (mobileCards) mobileCards.style.display = '';
                    if (emptyFilterState) emptyFilterState.classList.add('hidden');
                }
            });
        });
    }
});