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
function SvgSetRandomColors() {

    "use strict";

    /**
     * Find all ids in an svg that has a fill color and/or a stroke color already set.
     * The data can then be used in setRandomColors.
     * @param $name
     * @param $tagName
     * @returns {{fill: {}, stroke: {}}}
     */
    this.findIds = function($name, $tagName) {
        let $svg = getSvgObject($name);
        let $elements = getElementsByTagName($svg, $tagName);

        let $data = {
            'fill': {},
            'stroke': {}
        };

        for (let $key in $elements)
        {
            if ($elements.hasOwnProperty($key) === false) {
                continue;
            }

            const $id = $elements[$key].id;
            if ($id === '') {
                continue;
            }

            let $color = getColor($elements[$key], 'fill');
            $data = _StoreColor($data, 'fill', $color, $id);

            $color = getColor($elements[$key], 'stroke');
            $data = _StoreColor($data, 'stroke', $color, $id);
        }

        return $data;
    };

    /**
     * Store a color and id at the right place in a big data object.
     * @param $data
     * @param $type
     * @param $color
     * @param $id
     * @returns {*}
     * @private
     */
    const _StoreColor = function($data, $type, $color, $id)
    {
        if ($color === 'none') {
            return $data;
        }

        if ($color === '') {
            return $data;
        }

        if (typeof $color === 'undefined') {
            return $data;
        }

        if (_IsSet($data[$type][$color]) === 'false') {
            $data[$type][$color] = [];
        }

        $data[$type][$color].push($id);

        return $data;
    };

    /**
     * Update an svg with new colors.
     * The ids in the data come from findIds()
     * @param $name
     * @param $data
     * @param $tagName
     */
    this.setRandomColors = function($name, $data, $tagName)
    {
        let $svg = getSvgObject($name);

        for (let $type in $data)
        {
            if ($data.hasOwnProperty($type) === false) {
                continue;
            }

            let $timeOut = 1000;

            for (let $color in $data[$type])
            {
                if ($data[$type].hasOwnProperty($color) === false) {
                    continue;
                }

                const $randomColor = _RandomColor();

                setTimeout(function() {
                    setNewColorToAllObjectsThatShareTheSameColor($svg, $data, $type, $color, $randomColor, $tagName);
                }, $timeOut);

                $timeOut = $timeOut + 400;
            }

        }
    };

    /**
     * Set a new color to all objects that share the same color
     * @param $svg
     * @param $data
     * @param $type
     * @param $color
     * @param $randomColor
     */
    let setNewColorToAllObjectsThatShareTheSameColor = function($svg, $data, $type, $color, $randomColor)
    {
        for (let $number in $data[$type][$color])
        {
            if ($data[$type][$color].hasOwnProperty($number) === false) {
                continue;
            }

            const $id = $data[$type][$color][$number];
            const $element = getElementById($svg, $id);
            if ($element) {
                setColor($element, $type, $randomColor);
            }
        }
    };

    /**
     * Set a color on the element style.fill or the fill attribute if exist.
     * @param $element
     * @param $type
     * @param $color
     */
    let setColor = function($element, $type, $color)
    {
        const $value = $element.getAttribute($type);
        if ($value) {
            $element.setAttribute($type, $color);
        }

        if ($type === 'fill') {
            $element.style.fill = $color;
        }

        if ($type === 'stroke') {
            $element.style.stroke = $color;
        }
    };

    /**
     * Get a color from the element style.fill or the fill attribute if exist.
     * @param $element
     * @param $type
     */
    let getColor = function($element, $type)
    {
        const $value = $element.getAttribute($type);
        if ($value) {
            return $value;
        }

        if ($type === 'fill') {
            return $element.style.fill;
        }

        if ($type === 'stroke') {
            return $element.style.stroke;
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

    this.loopColors = function($svgName, $tagName)
    {
        let $data = this.findIds($svgName, $tagName);
        let $that = this;

        const $loops = 10;
        for (let $loopNumber = 0; $loopNumber < $loops; $loopNumber = $loopNumber + 1) {
            setTimeout(function() {
                $that.setRandomColors($svgName, $data, $tagName);
            }, $loopNumber * 3000);
        }
    };

}
