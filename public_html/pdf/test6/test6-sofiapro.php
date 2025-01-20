<!DOCTYPE html>
<html>
<head>
    <title>DOM to Image - Test 6 - custom font</title>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
</head>

<body>

<script>

    async function loadFont() {
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

        // Initialize jsPDF
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        // Add the font to jsPDF
        pdf.addFileToVFS('SofiaPro-normal.ttf', fontBase64Data);
        pdf.addFont('SofiaPro-normal.ttf', 'Sofia Pro', 'normal');
        pdf.setFont('Sofia Pro');

        // pdf.setFont('helvetica', 'bold');

        // Add some text using the custom font
        pdf.text('Hello, this is a test with Sofia Pro font!', 10, 10);

        // Save the PDF
        pdf.save('custom_font.pdf');
    }

    // Load the font and create the PDF
    loadFont();

</script>
</body>
</html>