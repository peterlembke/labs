# WebWorker

In this test we take this a bit further.
The WebWorker (WW) will be started with a JavaScript (JS) that can accept more JS and start that too, in the same WW.

URL: http://labs.local/webworker/test3/

## Initial WW code

Be able to get JS code and start that code within the same WW.

## Child code

The child code send messages out of the WW.

## Main software

Main code set up three WW.
The WW itself ask for the extra JS code.
WW gets the extra JS code.
WW starts the extra JS code. Three versions within the WW.
The extra JS code send messages out.
Main code get messages and display them on screen.
Show 3 rows, one for each WW.
Show 3 columns, one for each WW child.
Display the incoming message in the right cell.
