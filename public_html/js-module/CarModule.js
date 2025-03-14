/**
 * A module for a generic car
 * @returns {string}
 * @constructor
 */
export default class CarModule {
    constructor(carType) {
        this.carType = carType;
    }

    getCarType() {
        return this.carType;
    }
}