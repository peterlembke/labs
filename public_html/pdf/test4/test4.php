<!DOCTYPE html>
<html>
<head>
    <title>DOM to Image - Test 4</title>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>

<body>
<div id="my_div1">Testing html to canvas to PDF<br>Working example 2025-01-17</div>
<div id="my_div2">More to write here<br>We should have more advanced HTML</div>
<div id="my_div3">But this will have to do for now<br>It is fun to work with Javascript</div>
<div id="my_div4">This is text 4, it does not use WebWorkers<br>The next test 5 will use web workers</div>

<script>
    window.jsPDF = window.jspdf.jsPDF;
    const pdf = new jsPDF();

    const elements = ['my_div1', 'my_div2', 'my_div3', 'my_div4'];

    elements.forEach((elementId, index) => {
        let myDivElement = document.getElementById(elementId);

        html2canvas(myDivElement).then(canvas => {
            debug(canvas, myDivElement);
            addContentToPDF(pdf, canvas, index, elements.length);

            let isLastElement = index === elements.length - 1;
            if (isLastElement === true) {
                pdf.save("test4-multiple_elements.pdf");
            }
        });
    });

    function addContentToPDF(pdf, canvas, index, totalElements) {
        // We have a page to start with, so we don't need to add a new page for the first element
        if (index > 0) {
            pdf.addPage();
        }

        // Add header
        pdf.setFont("helvetica", "bold");
        pdf.setFontSize(12);
        pdf.text("Header Text", 10, 10);

        // Add image
        const imgData = canvas.toDataURL('image/png');
        pdf.addImage(imgData, 'PNG', 10, 20);

        pdf.text("Text after the image", 10, canvas.height + 30);

        // Add footer
        pdf.setFont("helvetica", "normal");
        pdf.setFontSize(10);
        pdf.text("Footer Text", 10, pdf.internal.pageSize.height - 10);

        // Add page number
        pdf.text(`Page ${index + 1} of ${totalElements}`, pdf.internal.pageSize.width - 30, pdf.internal.pageSize.height - 10);
    }

    function debug(canvas, myDivElement) {
        // Append the canvas to the body or any other element, for debug purposes
        document.body.appendChild(canvas); // For debug purposes so we can see the canvas

        // We can see that the processing is serial.
        console.log('Processing element ' + myDivElement.id + ', micro time is ' + performance.now());
    }

</script>
</body>
</html>