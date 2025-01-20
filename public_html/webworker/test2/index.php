<script>

    /**
     * Call the server to get the JS code we want to run in the web worker
     */
    function ajaxCall()
    {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
                if (xmlhttp.status == 200) {
                    let $jsCode = xmlhttp.responseText;
                    startWorker($jsCode);
                }
                else if (xmlhttp.status == 400) {
                    alert('There was an error 400');
                }
                else {
                    alert('something else other than 200 was returned');
                }
            }
        };

        xmlhttp.open("GET", "server.php", true);
        xmlhttp.send();
    }

    /**
     * Send in the JS code and it will be started in a WebWorker
     * A WebWorker run in a separate process and can send messages.
     * You can send messages to the WebWorker.
     *
     * @param $jsCode
     */
    function startWorker($jsCode) {
        let $blob, $worker, $out, $message;
        $blob = new Blob([$jsCode], {type: 'application/javascript'});
        $worker = new Worker(URL.createObjectURL($blob));
        $worker.onmessage = function($e)
        {
            const $data = JSON.parse($e.data);
            alert('Response: ' + $data.time);
        };

        // The JS code is written so that you need to send a trigger message to start its internal timer
        $out = {
            'start': true
        };
        $worker.postMessage(JSON.stringify($out));
    }

    ajaxCall();

</script>
