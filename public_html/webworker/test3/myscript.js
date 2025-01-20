/**
 * Should be run in a WebWorker
 * You send in a trigger message that get its internal timers started
 * Then it sends a message with the current time every 3 seconds.
 */

self.onmessage = function($e)
{
    var $in, $myVar, $id;
    $in = JSON.parse($e.data);

    if ($in.start === true) {
        $id = $in.id;
        let timeOut = Math.floor(Math.random() * 5000) + 1000;
        $myVar = setInterval(myTimer, timeOut, $id);
    }

    function myTimer($id) {
        let $date = new Date(),
            $currentTime = $date.toLocaleTimeString(),
            $data;

        $data = {
            'id': $id,
            'time': $currentTime,
            'message': $e.data
        };

        postMessage(JSON.stringify($data));
    }

};