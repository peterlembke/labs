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
 * Class that do the ajax calls to the backend php.
 * @constructor
 */
function Ajax() {

    "use strict";

    /**
     * Ajax call to the backend
     * @returns {[]}
     */
    this.ajax = function()
    {
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
