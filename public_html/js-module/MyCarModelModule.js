import CarModule from './CarModule.js';

/**
 * A module that uses other modules
 * @returns {string}
 * @constructor
 */
export default class MyCarModelModule extends CarModule {
    constructor(manufacturer, carType) {
        super(carType);
        this.manufacturer = manufacturer;
    }

    getInformation() {
        let row = 'Manufacturer: ' + this.manufacturer + ', type: ' + this.getCarType();
        return row;
    }
}