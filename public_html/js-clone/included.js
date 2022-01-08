/**
 * Object deep clone
 * @see https://developer.mozilla.org/en-US/docs/Web/API/Web_Workers_API/Structured_clone_algorithm#Another_way_deep_copy%E2%80%8E
 * @see https://github.com/whatwg/html/issues/793
 * @see https://www.digitalocean.com/community/tutorials/copying-objects-in-javascript
 * @param {object} $objectToBeCloned - A data object
 * @returns {*}
 * @private
 */
const _MiniClone = function($objectToBeCloned = {}) {
    if (($objectToBeCloned instanceof Object) === false) {
        return $objectToBeCloned;
    }

    let Constructor = $objectToBeCloned.constructor,
        objectClone = new Constructor();

    for (let $property in $objectToBeCloned) {
        if ($objectToBeCloned.hasOwnProperty($property) === false) {
            continue;
        }
        if (typeof $objectToBeCloned[$property] !== 'object') {
            objectClone[$property] = $objectToBeCloned[$property];
            continue;
        }
        objectClone[$property] = _MiniClone($objectToBeCloned[$property]);
    }

    return objectClone;
};

/**
 * Object deep clone
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/assign
 * @param {object} $objectToBeCloned - A data object
 * @returns {*}
 * @private
 */
const _MicroClone = function($objectToBeCloned = {}) {
    if (($objectToBeCloned instanceof Object) === false) {
        return $objectToBeCloned;
    }

    let $target = {};
    if (Array.isArray($objectToBeCloned)) {
        $target = [];
    }

    return Object.assign($target, $objectToBeCloned);
};

/**
 * Object deep clone
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Object/assign
 * @param {object} $objectToBeCloned - A data object
 * @returns {*}
 * @private
 */
const _Compare = function($object1, $object2) {

    let $keyArray = Object.keys($object1); // ['a', 'd']

    for (let $key in $keyArray) {
        let $enum1 = $object1.propertyIsEnumerable($key);
        let $enum2 = $object2.propertyIsEnumerable($key);
        if ($enum1 === false || $enum2 === false) {
            console.log('Found none enum', $key);
        }
    }

};

let $object1 = {
    'test a1': 'test value a1',
    'test a2': 'test value a2',
    'test a3': 'test value a3',
    'test object b': {
        'test 1b': 'test value 1b',
        'test 2b': 'test value 2b',
        'test 3b': 'test value 3b',
        'test object c': {
            'test 1c': 'test value 1c',
            'test 2c': 'test value 2c',
            'test 3c': 'test value 3c',
            'test 123': 123,
            'test array1': [
                1,2,3,4,5
            ],
            'test array2': [
                '1', '2', 'abc'
            ]
        }
    },
    'test object c': {
        'test 1c': 'test value 1c',
        'test 2c': 'test value 2c',
        'test 3c': 'test value 3c'
    }
};

let $array1 = [
    {
        'test 1b': 'test value 1b',
        'test 2b': 'test value 2b',
        'test 3b': 'test value 3b',
        'test object c': {
            'test 1c': 'test value 1c',
            'test 2c': 'test value 2c',
            'test 3c': 'test value 3c',
            'test 123': 123,
            'test array1': [
                1, 2, 3, 4, 5
            ],
            'test array2': [
                '1', '2', 'abc'
            ]
        }
    },
    {
        'test 1b': 'test value 1b',
        'test 2b': 'test value 2b',
        'test 3b': 'test value 3b',
        'test object c': {
            'test 1c': 'test value 1c',
            'test 2c': 'test value 2c',
            'test 3c': 'test value 3c',
            'test 123': 123,
            'test array1': [
                1, 2, 3, 4, 5
            ],
            'test array2': [
                '1', '2', 'abc'
            ]
        }
    },
];

$object1['foobar'] = 'Foobar';

let $copy1 = _MiniClone($object1);
console.log('Data', $copy1);
let $copy2 = _MicroClone($object1);
console.log('Data', $copy2);
_Compare($copy1, $copy2)

let $copy3 = _MiniClone($array1);
console.log('Data', $copy3);
let $copy4 = _MicroClone($array1);
console.log('Data', $copy4);
_Compare($copy3, $copy4)
