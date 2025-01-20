# HTML to PDF

## Test 7

The resolution of the images must improve.

URL: http://aktivbo-api.aktivbo.dev.local/pdf/test7/test7.php

## Test 6

Working in the PDF with custom fonts.
Succeeded in loading the SofiaPro font in TTF format.

URL: http://aktivbo-api.aktivbo.dev.local/pdf/test6/test6.php

## test6-sofiapro

Only loads the font and creates a single page PDF with a text in the SofiaPro font.

## Test 5
The html2canvas used in test4 is slow when there are large HTMLs and many of them.
I want to convert the images in parallel with WebWorkers but those tests failed.
I try htmlToImage instead and hope it is faster. We will see later with a tougher HTML to convert.

Four Div boxes with HTML in them is converted to images. One image / page in the PDF.
Each page get a header, a logo, the converted image, page count a header text, a footer text.

It is not possible to add svg images to the PDF so the logo had top be converted to png first.

URL: http://aktivbo-api.aktivbo.dev.local/pdf/test5/test5.php

## test5-svg - canvg with WebWorkers

The below example is for canvg. It uses web workers to covert SVG to canvas.

https://codesandbox.io/p/sandbox/github/canvg/canvg/tree/master/sandboxes/worker?file=%2Fworker.js%3A12%2C10&from-embed
https://canvg.js.org/examples/worker

The example works well.

URL: http://aktivbo-api.aktivbo.dev.local/pdf/test5-svg/index.html

## test5-svg-pdf - canvg with WebWorkers

Same as test5-svg but now the svg is saved in a PDF file.

The example works well.

## Test 4
Multiple div boxes with html, each converted to canvas.
Each canvas added to a new PDF page. We also add a header and footer text.