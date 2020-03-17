/**
 Copyright (C) 2020 Peter Lembke, CharZam soft
 the program is distributed under the terms of the GNU General Public License

 Labs/Svg is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

 Labs/Svg is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Labs/Svg.  If not, see <https://www.gnu.org/licenses/>.'

 * @constructor
 */
function SvgHighlight() {

    "use strict";

    /**
     * Find all ids in an svg that has a fill color and/or a stroke color already set.
     * The data can then be used in setRandomColors.
     * @param $name
     * @param $tagName
     * @returns {[]}
     */
    this.findIds = function($name, $tagName)
    {
        let $svg = getSvgObject($name);
        let $elements = getElementsByTagName($svg, $tagName);

        let $data = {};

        for (let $key in $elements)
        {
            if ($elements.hasOwnProperty($key) === false) {
                continue;
            }

            const $id = $elements[$key].id;
            if ($id === '') {
                continue;
            }
            const $title = $elements[$key].getAttribute('title');

            $data[$id] = $title;
        }

        return $data;
    };

    /**
     * Set event listeners on all objects in the SVG.
     * The ids in the data come from findIds()
     * @param $name
     * @param $data
     * @param $tagName
     */
    this.setEventListeners = function($name, $data, $tagName)
    {
        let $svg = getSvgObject($name);

        for (let $id in $data) {
            if ($data.hasOwnProperty($id) === false) {
                continue;
            }

            const $title = $data[$id];
            const $element = getElementById($svg, $id);
            $element.addEventListener('click', e => {
                console.log('clicked id:' + $id + ', Län: ' + $title);
                const $color = _RandomColor();
                $element.style.fill = $color;
            });
        }
    };

    /**
     * Get a reference to an object
     * @param $name
     * @returns {Document}
     */
    let getSvgObject = function($name) {
        const $svgObject = document.getElementById($name).contentDocument;
        return $svgObject;
    };

    /**
     * Get all elements with a specific tag name from within an object
     * @param $svgObject
     * @param $tagName
     * @returns {HTMLCollectionOf<SVGElementTagNameMap[*]> | HTMLCollectionOf<HTMLElementTagNameMap[*]> | HTMLCollectionOf<Element> | ActiveX.IXMLDOMNodeList}
     */
    let getElementsByTagName = function ($svgObject, $tagName) {
        const $elements = $svgObject.getElementsByTagName($tagName);
        return $elements;
    };

    /**
     * Get an element from within an object
     * @param $object
     * @param $id
     * @returns {Element | HTMLElement}
     */
    let getElementById = function ($object, $id) {
        const $element = $object.getElementById($id);
        return $element;
    };

    /**
     * Test if a parameter in an object are set
     * @returns {string}
     * @private
     */
    const _IsSet = function ()
    {
        const $arguments = arguments;
        let $undefined;

        if ($arguments.length === 0) {
            return 'false';
        }

        if ($arguments[0] === $undefined || $arguments[0] === null) {
            return 'false';
        }

        return 'true';
    };

    /**
     * Construct a random color with 6 hex numbers.
     * Example: #A0B321
     * @returns {string}
     * @private
     */
    const _RandomColor = function()
    {
        const $chars = '0123456789ABCDEF';
        let $color = '';

        for (let $position = 0; $position < 6; $position = $position +1) {
            const $number = Math.floor(Math.random() * 16);
            $color = $color + $chars[$number];
        }

        return '#' + $color;
    };

    this.highlight = function($svgName, $tagName)
    {
        let $data = this.findIds($svgName, $tagName);
        let $that = this;
        $that.setEventListeners($svgName, $data, $tagName);
    };

}
