<!DOCTYPE html>
<html>
<head>
    <title>DOM to Image - Test 2</title>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
</head>
<body>
<div id="my_div">Testing html to image</div>
<canvas id="my_canvas" width="600" height="600"></canvas>
<script>
    window.jsPDF = window.jspdf.jsPDF;
    const { body } = document;
    const canvas = document.getElementById('my_canvas');
    const ctx = canvas.getContext('2d');
    const myDivElement = document.getElementById('my_div').outerHTML;

    canvas.width = 200; // Adjust the width as needed
    canvas.height = 100; // Adjust the height as needed

    const svgData = `
            <svg xmlns="http://www.w3.org/2000/svg" width="${canvas.width}" height="${canvas.height}">
                <foreignObject width="100%" height="100%">
                    <div xmlns="http://www.w3.org/1999/xhtml">${myDivElement}</div>
                </foreignObject>
            </svg>
        `;

    const img = new Image();

    /*
    img.onload = () => {
        ctx.drawImage(img, 0, 0);
        const targetImg = document.createElement('img');
        targetImg.src = canvas.toDataURL('image/png');
    };
     */

    img.src = 'data:image/svg+xml;charset=utf-8,' + encodeURIComponent(svgData);
    ctx.drawImage(img, 0, 0);
    document.body.appendChild(img);
    const targetImg = document.createElement('img');
    targetImg.src = canvas.toDataURL('image/png');
    document.body.appendChild(targetImg);

    /*
    const doc = new jsPDF();

    doc.text("Hello world!", 10, 10);

    doc.addImage({
        imageData: targetImg,
        format: 'PNG',
        x: 0,
        y: 0,
        width: 200,
        height: 100,
        compression: "FAST"
    });

    doc.save("a4.pdf");

     */
</script>
</body>
</html>