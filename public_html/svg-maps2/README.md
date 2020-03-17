# SVG Maps
2020-03-14

## Maps
- [sweden](https://www.amcharts.com/svg-maps/?map=sweden)
- [germany](https://www.amcharts.com/svg-maps/?map=germany)

## Browse
This is how you start the demo.
- [start demo](http://local.labs.se/svg-maps2/)

## Postnummer
There is a swedish [article](https://geosupportsystem.wordpress.com/2013/10/21/ar-postnummer-gratis/) that lead me to Geo names and the data for [sweden](http://download.geonames.org/export/zip/SE.zip) and [germany](http://download.geonames.org/export/zip/DE.zip)

## Import postnummer
I have written a data import for the files from Geo names.
- [import](http://local.labs.se/svg-maps2/import.php?path=SE)

## Goal
Goal is to read a file with zip codes.
Look them up in the sqlite database to get the GPS point.
Convert the GPS point to coordinates on the map.
Set an icon on the GPS point.
Be able to unset the icon.
