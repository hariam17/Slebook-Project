initPDFViewer=()=>{
    pdfjsLib.getDocument("assets/file/coba.pdf").promise.then(pdfDoc=>{
        console.log(pdfDoc);
        let pages = pdfDoc._pdfInfo.numPages;
        console.log(pages);
        for (let i=1; i <= pages; i++){
            pdfDoc.getPage(i).then(page=>{
                console.log(page);
                var wrapper = document.createElement("div");
                wrapper.className = "flex-row";
                let pdfCanvas = document.createElement('canvas');
                let context = pdfCanvas.getContext('2d');
                let pageViewport = page.getViewport({scale:1});
                console.log(pageViewport);
                pdfCanvas.width = pageViewport.width;
                pdfCanvas.height = pageViewport.height;
                $("#pdfViewer").append(pdfCanvas);
                page.render({
                    canvasContext:context,
                    viewport:pageViewport
                })
            }).catch(pageErr=>{
                console.log(pageErr);
            })
        }
        
    }).catch(pdfErr=>{
        console.log(pdfErr);
    })
}

$(function(){
    initPDFViewer();
})