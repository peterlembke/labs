/**
 * Demo class
 * @see https://www.w3schools.com/Js/js_classes.asp
 * @see https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Classes/Private_properties
 */
class MyClass extends MyBase {
    #name; // Private property
    #year;
    optionalText; // Public property

    constructor(name, year, optionalText) {
        super();
        this.#name = name;
        this.#year = year;
        this.optionalText = optionalText;
    }

    /**
     * This is a private function
     * @returns {string}
     */
    #createRow() {
        return "My name is " + this.#name + " and I am " + this.#year + " years old."
    }

    /**
     * This is a public function
     * Get the full descriptive row
     * This is a public function
     * @returns {string}
     */
    getRow() {
        let $row = this.#createRow();

        return $row;
    }
}