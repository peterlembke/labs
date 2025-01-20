<!DOCTYPE html>
<html>
<head>
    <title>DOM to Image - Test 7</title>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html-to-image/1.11.11/html-to-image.min.js"></script>
</head>

<body>
<div id="my_div1">Testing html to canvas to PDF<br>Working example 2025-01-17</div>
<div id="my_div2">More to write here<br>We should have more advanced HTML</div>
<div id="my_div3">But this will have to do for now<br>It is fun to work with Javascript</div>
<div id="my_div4">This is text 4, it does not use WebWorkers<br>The next test 5 will use web workers</div>

<script>

    let toSvg = window.htmlToImage.toSvg;

    window.jsPDF = window.jspdf.jsPDF;
    const pdf = new jsPDF();

    async function loadFont(pdf) {
        // Fetch the TTF font file
        const response = await fetch('assets/sofiapro-medium.c56c0855.ttf');
        const arrayBuffer = await response.arrayBuffer();
        const uint8Array = new Uint8Array(arrayBuffer);

        // Convert to base64
        let binary = '';
        for (let i = 0; i < uint8Array.length; i++) {
            binary += String.fromCharCode(uint8Array[i]);
        }
        const fontBase64Data = window.btoa(binary);

        // Add the font to jsPDF
        pdf.addFileToVFS('SofiaPro-normal.ttf', fontBase64Data);
        pdf.addFont('SofiaPro-normal.ttf', 'Sofia Pro', 'normal');
        pdf.setFont('Sofia Pro');
    }

    // Load the font and create the PDF
    loadFont(pdf);

    const elements = ['my_div1', 'my_div2', 'my_div3', 'my_div4'];

    elements.forEach((elementId, index) => {
        let myDivElement = document.getElementById(elementId);

        let options = {
            backgroundColor: "#F0A060", // Orange so we see the canvas size in the PDF
            pixelRatio: 4, // 1 is default. This is 4x resolution. https://github.com/bubkoo/html-to-image/pull/60
        }

        window.htmlToImage.toCanvas(myDivElement, options).then(function (canvas) {
            // debug(canvas, myDivElement);
            addContentToPDF(pdf, canvas, index, elements.length);
            let isLastElement = index === elements.length - 1;
            if (isLastElement === true) {
                pdf.save("test7.pdf");
            }
        });
    });

    function addContentToPDF(pdf, canvas, index, totalElements) {
        // We have a page to start with, so we don't need to add a new page for the first element
        if (index > 0) {
            pdf.addPage();
        }

        // Add header
        pdf.setFontSize(12);
        pdf.text("Header Text", 10, 10);

        let pageWidth = pdf.internal.pageSize.getWidth();
        let canvasWidth = canvas.width;
        let ratio = pageWidth / canvasWidth;

        let newHeight = canvas.height * ratio;

        let scaleUp = 4.0;

        // Add image
        const imgData = canvas.toDataURL('image/png');
        pdf.addImage(imgData, 'PNG', 10, 20, pageWidth * scaleUp, newHeight * scaleUp);

        pdf.setFontSize(24);

        pdf.text("Text after the image", 10, canvas.height + 30);

        const imgElement = document.createElement('img');
        imgElement.src = 'example.png';
        imgElement.alt = 'PNG Image';
        // document.body.appendChild(imgElement); // For debug purposes

        pdf.addImage(imgElement, 'PNG', 10, canvas.height + 40);

        // Add footer
        pdf.setFontSize(10);
        pdf.text("Footer Text", 10, pdf.internal.pageSize.height - 10);

        // Add page number
        pdf.text(`Page ${index + 1} of ${totalElements}`, pdf.internal.pageSize.width - 30, pdf.internal.pageSize.height - 10);
    }

    function debug(canvas, myDivElement) {

        document.body.appendChild(canvas); // For debug purposes so we can see the canvas

        // We can see the times in the log
        console.log('Processing element ' + myDivElement.id + ', micro time is ' + performance.now());
    }

</script>
</body>
</html>