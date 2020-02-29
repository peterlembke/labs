<html>
    <head>
        <script src="SvgSetRandomColors.js"></script>
    </head>
    <body>
        <object id="bird" data="Heraldic_peacock.svg" type="image/svg+xml" style="width:250px;"></object>
        <object id="tiger" data="Ghostscript_Tiger.svg" type="image/svg+xml" style="width:250px;"></object>
        <object id="rainbow" data="PEO-rainbow_sky.svg" type="image/svg+xml" style="width:250px;"></object>
        <script>
            window.onload = function() {
                const $me = new SvgSetRandomColors();
                $me.loopColors('rainbow', 'path');
                $me.loopColors('bird', 'path');
                $me.loopColors('tiger', 'g');
            };
        </script>
    </body>
</html>