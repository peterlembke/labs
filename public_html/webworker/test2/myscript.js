/**
 * Should be run in a WebWorker
 * You send in a trigger message that get its internal timers started
 * Then it sends a message with the current time every 3 seconds.
 */

self.onmessage = function($e)
{
    let $in, $myVar;
    $in = JSON.parse($e.data);

    if ($in.start === true) {
        $myVar = setInterval(myTimer, 3000);
    }

    function myTimer() {
        let $date = new Date(),
            $currentTime = $date.toLocaleTimeString(),
            $data;

        $data = {
            'time': $currentTime,
            'message': $e.data
        };

        postMessage(JSON.stringify($data));
    }

};