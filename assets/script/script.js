var pdfPath = 'assets/file/marmut.pdf';

    // Inisialisasi PDF.js
     // Inisialisasi PDF.js
     pdfjsLib.getDocument(pdfPath).promise.then(function(pdfDoc) {
        // Menyiapkan elemen kontainer
        var container = document.getElementById('pdfViewer');
        let pages = pdfDoc._pdfInfo.numPages;
  
        // Mengatur nomor halaman yang ingin ditampilkan
        renderPDF=(pageNumber)=>{
            pdfDoc.getPage(pageNumber).then(function(page) {
                // Membuat elemen div untuk menampung halaman PDF
                var div = document.createElement('div');
                div.className = 'pdf-page';
                container.appendChild(div);
        
                // Mengatur ukuran viewport
                var viewport = page.getViewport({ scale: 1 });
                var scale = container.offsetWidth / viewport.width;
                var scaledViewport = page.getViewport({ scale: scale });
        
                // Membuat elemen canvas untuk menampilkan halaman PDF
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                canvas.height = scaledViewport.height;
                canvas.width = scaledViewport.width;
                div.appendChild(canvas);
        
                // Menampilkan halaman PDF pada elemen canvas
                page.render({
                  canvasContext: context,
                  viewport: scaledViewport
                });
              });
        }
        // Mengambil halaman PDF
  
      });
      $(function(){
        for (var i = 0; i < pages; i++) {
            initPDFViewer();
        }
    })