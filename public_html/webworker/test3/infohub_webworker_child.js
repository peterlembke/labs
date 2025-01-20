/**
 * Should be run in a WebWorker
 * You send in a trigger message that get its internal timers started
 * Then it sends a message with the current time every 3 seconds.
 */

function infohub_webworker_child() {

    this.cmd = function($in = {}) {
        if ($in.command === 'start_main_timer') {
            let timeOut = random(6);
            $myVar = setInterval(myTimer, timeOut, $in.id);
        }
    };

    const random = function(maxSeconds) {
        let $numberInt = Math.floor(Math.random() * maxSeconds * 1000) + 1000;
        return $numberInt;
    }

    const myTimer = function($id = {}) {

        let $date = new Date(),
            $currentTime = $date.toLocaleTimeString();

        let $data = {
            'command': 'view',
            'id': $id,
            'time': $currentTime
        };

        postMessage(JSON.stringify($data));
    };
}
//# sourceURL=infohub_webworker_child.js
