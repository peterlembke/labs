const worker = new Worker('./worker.js', {
  type: 'module'
})
const img = document.querySelector('img')

window.jsPDF = window.jspdf.jsPDF;
const pdf = new jsPDF();

worker.postMessage({
  width: 600,
  height: 600,
  svg: './example.svg'
})

worker.onmessage = (event) => {
  let pngUrl = event.data.pngUrl;
  img.src = pngUrl;
  addContentToPDF(pdf, pngUrl, 0, 1);

  pdf.save("test5-svg-pdf.pdf");
}

function addContentToPDF(pdf, pngUrl, index, totalElements) {
  // We have a page to start with, so we don't need to add a new page for the first element
  if (index > 0) {
    pdf.addPage();
  }

  // Add header
  pdf.setFont("helvetica", "bold");
  pdf.setFontSize(12);
  pdf.text("Header Text", 10, 10);

  // Add image
  pdf.addImage(pngUrl, 'PNG', 10, 20);

  pdf.text("Text after the image", 10, 630);

  // Add footer
  pdf.setFont("helvetica", "normal");
  pdf.setFontSize(10);
  pdf.text("Footer Text", 10, pdf.internal.pageSize.height - 10);

  // Add page number
  pdf.text(`Page ${index + 1} of ${totalElements}`, pdf.internal.pageSize.width - 30, pdf.internal.pageSize.height - 10);
}