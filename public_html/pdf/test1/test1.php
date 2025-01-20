<!DOCTYPE html>
<html>
<head>
    <title>DOM to Image - Test 1</title>
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://unpkg.com/canvg@latest/dist/canvg.min.js"></script>

    <script type="module">
        import { Canvg } from 'https://cdn.skypack.dev/canvg@^4.0.0';

        window.onload = () => {
            window.jsPDF = window.jspdf.jsPDF;

            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext('2d');
            const v = Canvg.fromString(ctx, '<svg width="600" height="600"><text x="50" y="50">Hello World!</text></svg>');

            // Start SVG rendering with animations and mouse handling.
            v.start();

            let imgData = v.canvas.toDataURL('image/png');
            let img = new Image();
            img.src = imgData;
            document.body.appendChild(img);

            const doc = new jsPDF();

            doc.addImage({
                imageData: imgData,
                format: 'PNG',
                x: 0,
                y: 0,
                width: 200,
                height: 100,
                compression: "FAST"
            });

            doc.save("a4.pdf");
        };
    </script>
</head>
<body>
<canvas width="600" height="600"></canvas>
<div id="my_div">Testing html to image</div>
</body>
</html>