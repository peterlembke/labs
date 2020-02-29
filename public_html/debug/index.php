<html>
    <head>

    </head>
    <body>
    <h1>See the developer tools</h1>
    The console will show the code for the included + inline + evaluated javascript.

    Thanks to the parameter //# sourceURL=inline.js

        <script src="included.js"></script>

        <script>
            console.log('inline JS');
            //# sourceURL=inline.js
        </script>

        <script>
            const $code = "console.log('evaluated JS');\n//# sourceURL=evaluated.js";
            eval($code);
        </script>
    </body>
</html>