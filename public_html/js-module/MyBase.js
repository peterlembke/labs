/**
 * Demo base class
 * @see https://www.w3schools.com/Js/js_classes.asp
 */
class MyBase {

    constructor() {
    }

    /**
     * This is a public function
     * Get the full descriptive row
     * This is a public function
     * @returns {string}
     */
    getCurrentTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const result = `${hours}:${minutes}:${seconds}`;

        return result;
    }
}