# Drag drop items in a list

* [Code](https://github.com/1milligram/html-dom/blob/master/public/demo/drag-and-drop-element-in-a-list/index.html)
* [Article](https://htmldom.dev/drag-and-drop-element-in-a-list/)

I have tested the code with a mouse - works perfectly and I think this is what I want for Infohub.

I have tested on a phone. The touch do not work at all. Infohub only support touch. Mouse is not supported.
The code need to work with touch. This is what I will try to do in this lab.

We have working touch in this example:
See [W3Schools drag and drop](https://www.w3schools.com/HTML/html5_draganddrop.asp)
And [W3Schools insertbefore](https://www.w3schools.com/jsref/met_node_insertbefore.asp)

If I combine the two then I would get a list that works with touch.

See [local example](http://local.labs.se/dragdroplist/index.html)

There is a good drag and drop example here that use all events.
[W3Schools ondragover](https://www.w3schools.com/jsref/event_ondragover.asp)

## Things to do

* Dragging over an item swaps place with my draggable object in the DOM. Think about a solution how it should work with drag down and drag up.
* Last in list, have a none draggable item that you can drop on. Then you can drag and drop an item to any position.
