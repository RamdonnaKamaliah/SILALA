    // Initialize AOS
    AOS.init({
        once: true,
        offset: 100
    });

    // Set PDF.js worker
    pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

    // Preview Image Function
    function previewImage(event) {
        const file = event.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imageName').textContent = file.name;
                document.getElementById('imagePreviewContainer').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Preview PDF Function with Thumbnail
    function previewPDF(event) {
        const file = event.target.files[0];
        if (file && file.type === 'application/pdf') {
            const fileSize = (file.size / 1024 / 1024).toFixed(2);
            document.getElementById('pdfName').textContent = file.name;
            document.getElementById('pdfSize').textContent = `Ukuran: ${fileSize} MB`;
            
            // Generate PDF thumbnail
            const fileReader = new FileReader();
            fileReader.onload = function(e) {
                const typedarray = new Uint8Array(e.target.result);
                
                pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                    // Get first page
                    pdf.getPage(1).then(function(page) {
                        const scale = 1.0;
                        const viewport = page.getViewport({ scale: scale });
                        
                        const canvas = document.getElementById('pdfPreview');
                        const context = canvas.getContext('2d');
                        
                        // Limit canvas size
                        const maxHeight = 120;
                        const scaleFactor = maxHeight / viewport.height;
                        const scaledViewport = page.getViewport({ scale: scale * scaleFactor });
                        
                        canvas.height = scaledViewport.height;
                        canvas.width = scaledViewport.width;
                        
                        const renderContext = {
                            canvasContext: context,
                            viewport: scaledViewport
                        };
                        
                        page.render(renderContext).promise.then(function() {
                            document.getElementById('pdfPreviewContainer').classList.remove('hidden');
                        });
                    });
                }).catch(function(error) {
                    console.error('Error loading PDF:', error);
                    alert('Gagal memuat preview PDF. Pastikan file PDF valid.');
                });
            };
            fileReader.readAsArrayBuffer(file);
        }
    }

