<html>
    <head>
        <script src="SvgHighlight.js"></script>
    </head>
    <body>
        <object id="sweden" data="swedenHigh.svg" type="image/svg+xml" style=""></object>
        <script>
            window.onload = function() {
                const $me = new SvgHighlight();
                $me.highlight('sweden', 'path');
            };
        </script>
    </body>
</html>