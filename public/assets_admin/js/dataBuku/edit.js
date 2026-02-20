
    // Image Preview Function
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    // PDF Preview Function for new file
    function previewPDF(event) {
        const input = event.target;
        const previewContainer = document.getElementById('pdfPreviewContainer');
        const pdfName = document.getElementById('pdfName');
        const pdfSize = document.getElementById('pdfSize');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            pdfName.textContent = file.name;
            
            // Format file size
            const fileSize = file.size;
            const sizeInKB = (fileSize / 1024).toFixed(2);
            const sizeInMB = (fileSize / (1024 * 1024)).toFixed(2);
            pdfSize.textContent = fileSize > 1024 * 1024 ? 
                `${sizeInMB} MB` : `${sizeInKB} KB`;
            
            previewContainer.classList.remove('hidden');
            
            // Load PDF for preview (first page only)
            const fileReader = new FileReader();
            fileReader.onload = function() {
                const typedarray = new Uint8Array(this.result);
                
                // Set up PDF.js
                pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                    // Get the first page
                    pdf.getPage(1).then(function(page) {
                        const scale = 1.2;
                        const viewport = page.getViewport({ scale: scale });
                        
                        // Prepare canvas for rendering
                        const canvas = document.getElementById('pdfPreview');
                        const context = canvas.getContext('2d');
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        
                        // Render PDF page
                        const renderContext = {
                            canvasContext: context,
                            viewport: viewport
                        };
                        page.render(renderContext);
                    });
                });
            };
            fileReader.readAsArrayBuffer(file);
        } else {
            previewContainer.classList.add('hidden');
        }
    }

    // Generate thumbnail for current PDF file
    function generateCurrentPdfThumbnail() {
        const pdfUrl = "{{ asset($buku->file_buku) }}";
        const container = document.getElementById('currentPdfThumbnail');
        
        if (!pdfUrl || pdfUrl === "{{ asset('') }}") return;
        
        // Set up PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
            // Get the first page
            pdf.getPage(1).then(function(page) {
                const scale = 1.2;
                const viewport = page.getViewport({ scale: scale });
                
                // Create canvas for rendering
                const canvas = document.createElement('canvas');
                const context = canvas.getContext('2d');
                canvas.height = viewport.height;
                canvas.width = viewport.width;
                canvas.className = 'max-w-[120px] max-h-[160px] rounded-md border-2 border-[#A4B465] bg-white mx-auto shadow-sm';
                
                // Clear loading message and add canvas
                container.innerHTML = '';
                container.appendChild(canvas);
                
                // Render PDF page
                const renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        }).catch(function(error) {
            console.error('Error generating PDF thumbnail:', error);
            container.innerHTML = `
                <div class="bg-[#f0f4e4] p-4 rounded-lg">
                    <i class="fas fa-file-pdf text-2xl text-[#8a9a58] mb-2"></i>
                    <p class="text-sm font-medium text-[#8a9a58]">Thumbnail tidak dapat dimuat</p>
                </div>
            `;
        });
    }

    // Init
document.addEventListener('DOMContentLoaded', function () {
    const fotoInput = document.getElementById('foto_buku');
    const fileInput = document.getElementById('file_buku');

    // ⛔ hentikan script kalau dua-duanya tidak ada
    if (!fotoInput && !fileInput) return;

    if (fotoInput) {
        fotoInput.addEventListener('change', previewImage);
    }

    if (fileInput) {
        fileInput.addEventListener('change', previewPDF);
    }
});
