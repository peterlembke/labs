# SVG manipulated with Javascript
In this demo I want to change color of a peacock and a tiger by the help of Javascript.

Since: 2020-02-29
Version: 2020-02-29

## Background
I created this example code in my Labs/svg repository to:
1. Get a great demo for Infohub_Demo to show what my Infohub_Timer plugin can do.
2. Learn more about manipulating SVG from Javascript.  

## Graphics
Found a [peacock](https://commons.wikimedia.org/wiki/File:Heraldic_peacock.svg) with a suitable license.

And a [tiger](https://commons.wikimedia.org/wiki/File:Ghostscript_Tiger.svg) with a suitable license.

And a [rainbow](https://commons.wikimedia.org/wiki/File:PEO-rainbow_sky.svg) with a suitable license.

## Code
I got help from [this link](http://www.petercollingridge.co.uk/tutorials/svg/interactive/javascript/) how to embed the svg and access it.

You start the code from index.php and use the class in SvgSetRandomColors.js 
The class in SvgSetRandomColors.js is somewhat independent.

## Peacock
The peacock is created with a lot of svg path commands. The path command can have a style.

When interacting with the peacock you provide the object ID "bird" and the tag type we want to modify: "path". 

I had to add a ViewBox to the SVG so it could be scaled.

## Tiger
The tiger is created with a lot of svg g commands. The g command can not have a style. Instead the g command uses direct attributes to set fill and stroke color.

When interacting with the tiger you provide the object ID "tiger" and the tag type we want to modify: "g". 

## Rainbow
The rainbow is created with a lot of svg path commands. The path command can have a style but here the fill and stroke are attributes instead.

When interacting with the rainbow you provide the object ID "rainbow" and the tag type we want to modify: "path". 

I had to add IDs to all paths in the SVG file so the Javascript could reach the ID.
