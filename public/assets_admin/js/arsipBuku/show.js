        function openPdfModal(pdfUrl) {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');

            pdfViewer.src = pdfUrl;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePdfModal() {
            const modal = document.getElementById('pdfModal');
            const pdfViewer = document.getElementById('pdfViewer');

            modal.classList.add('hidden');
            pdfViewer.src = '';
            document.body.style.overflow = 'auto';
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePdfModal();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Delete confirmation with enhanced dialog
            document.querySelectorAll('.delete-permanent-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const bookTitle = this.getAttribute('data-title');
                    const form = this.closest('form');

                    const confirmed = confirm(
                        `Hapus permanen buku "${bookTitle}"?\n\n⚠️ Tindakan ini tidak dapat dibatalkan dan data akan hilang selamanya!`
                    );

                    if (confirmed) {
                        form.submit();
                    }
                });
            });

            // Add loading state to buttons
            const buttons = document.querySelectorAll('button, a[href]');
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    if (this.classList.contains('delete-permanent-btn') || this.onclick) return;

                    const originalText = this.innerHTML;
                    this.innerHTML = `
                <div class="flex items-center space-x-2">
                    <div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                    <span>Memproses...</span>
                </div>
            `;
                    this.disabled = true;

                    // Reset after 3 seconds if still processing
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 3000);
                });
            });
        });
