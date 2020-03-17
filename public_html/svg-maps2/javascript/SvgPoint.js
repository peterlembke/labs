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
 */

/**
 * Class that put a pin onto the SVG map
 */
function SvgPoint() {

    "use strict";

    /**
     * Put a pin on the map
     * @returns {[]}
     */
    this.setPin = function()
    {
        let $svg = getSvgObject($name);


        return $data;
    };

    /**
     * Get a reference to an object
     * @param $name
     * @returns {Document}
     */
    const calculatePinPoint = function($lat, $long) {

        // Get the upper left lat/long from the svg
        // and the lower right lat/long from the svg
        // Get the viewPort width/height from the svg
        // Calculate an x and y value and return them.

    };

    /**
     * Get a reference to an object
     * @param $name
     * @returns {Document}
     */
    const getSvgObject = function($name) {
        const $svgObject = document.getElementById($name).contentDocument;
        return $svgObject;
    };

    /**
     * Set a pin here.
     * @param $name
     * @returns {Document}
     */
    const setPin = function($x, $y) {
    };

    /**
     * Remove pin here.
     * @param $name
     * @returns {Document}
     */
    const removePin = function($x, $y) {
    };

    /**
     * Get an element from within an object
     * @param $object
     * @param $id
     * @returns {Element | HTMLElement}
     */
    const getElementById = function ($object, $id) {
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
}
