/**
 * Should be run in a WebWorker
 * You send in a trigger message that get its internal timers started
 * Then it sends a message with the current time every 3 seconds.
 */

function infohub_webworker() {

    var $childPluginLookup = {};

    this.cmd = function($in = {}) {

        if ($in.command === 'start_main_timer') {
            let timeOut = random(6);
            $myVar = setInterval(myTimer, timeOut, $in.id);
        }

        if ($in.command === 'incoming_child_code') {

            eval.call(this, $in.plugin_code);

            const codeToEval = '$childPluginLookup[$in.id] = new ' + $in.plugin_name + '();';
            try {
                eval(codeToEval);
            } catch ($err) {
                $message = 'Can not not instantiate class:' + $in.plugin_name + ', error:' + $err.message();
            }

            const $out = {
                'command': 'start_main_timer',
                'id': $in.id
            };

            $childPluginLookup[$in.id].cmd($out);
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

var $mainPlugin = new infohub_webworker();

self.onmessage = function($e) {
    const $in = JSON.parse($e.data);
    $mainPlugin.cmd($in);
};
//# sourceURL=infohub_webworker.js