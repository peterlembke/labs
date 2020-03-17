<html>
    <head>
        <script src="javascript/SvgHighlight.js"></script>
        <script src="javascript/SvgPoint.js"></script>
        <script src="javascript/Ajax.js"></script>
    </head>
    <body>
        <object id="sweden" data="svg/swedenHigh.svg" type="image/svg+xml" style=""></object>
        <script>
            window.onload = function() {
                const $me = new SvgHighlight();
                $me.highlight('sweden', 'path');

                // Get the

                // Timer that poll data every minute to the backend to get the latest zip codes
                // We then portion out the data on the map so it looks like they just come in.


            };
        </script>
    </body>
</html>