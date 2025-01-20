<!DOCTYPE html>
<html>
<head>
    <title>DOM to Image - Test 3</title>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>
<body>
<div id="my_div">Testing html to canvas to PDF<br>Working example 2025-01-17</div>
<script>
    window.jsPDF = window.jspdf.jsPDF;

    let myDivElement = document.getElementById('my_div');

    html2canvas(myDivElement).then(canvas => {
        // Append the canvas to the body or any other element
        document.body.appendChild(canvas);

        // If you want to use the canvas for jsPDF
        const imgData = canvas.toDataURL('image/png');
        const pdf = new jsPDF();
        pdf.addImage(imgData, 'PNG', 0, 0);
        pdf.save("download.pdf");
    });
</script>
</body>
</html>