<html lang="en">
<head>
    <title>Web Worker test 3</title>
    <meta charset="UTF-8" />
    <style>
        body {
            background-color: lightblue;
        }

        .row {
            border-style: solid;
            border-width: 1px;
            max-width: 90%;
        }

        .bold {
            font-weight: bold;
        }

        .cell {
            border-style: solid;
            border-width: 1px;
            min-width: 30%;
            max-width: 30%;
            display:inline-flex;
        }
    </style>
</head>
<body>
    Three web workers. Each have three classes instantiated. All nine send the current time in random intervals.
    <div id="webworker1" class="row">
        <div class="bold">webworker1</div>
        <span id="webworker1child1" class="cell">webworker1child1</span>
        <span id="webworker1child2" class="cell">webworker1child2</span>
        <span id="webworker1child3" class="cell">webworker1child3</span>
    </div>
    <div id="webworker2" class="row">
        <div class="bold">webworker2</div>
        <span id="webworker2child1" class="cell">webworker2child1</span>
        <span id="webworker2child2" class="cell">webworker2child2</span>
        <span id="webworker2child3" class="cell">webworker2child3</span>
    </div>
    <div id="webworker3" class="row">
        <div class="bold">webworker3</div>
        <span id="webworker3child1" class="cell">webworker3child1</span>
        <span id="webworker3child2" class="cell">webworker3child2</span>
        <span id="webworker3child3" class="cell">webworker3child3</span>
    </div>
    <div id="webworker4" class="row">
        <div class="bold">webworker4</div>
        <span id="webworker4child1" class="cell">webworker3child1</span>
        <span id="webworker4child2" class="cell">webworker3child2</span>
        <span id="webworker4child3" class="cell">webworker3child3</span>
    </div>
    <div id="webworker5" class="row">
        <div class="bold">webworker5</div>
        <span id="webworker5child1" class="cell">webworker3child1</span>
        <span id="webworker5child2" class="cell">webworker3child2</span>
        <span id="webworker5child3" class="cell">webworker3child3</span>
    </div>
</body>
</html>

<script>

    var $workerLookup = {};

    /**
     * Call the server to get the JS code we want to run in the web worker
     */
    function ajaxCall(id, parentId, pluginName, $command)
    {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
                if (xmlhttp.status == 200) {
                    const $responseJson = xmlhttp.responseText;
                    const $in = JSON.parse($responseJson)

                    if ($command === 'start_worker') {
                        startWorker(id, $in.plugin_code, $in.plugin_name);
                    }

                    if ($command === 'send_code_to_worker') {
                        let $out = {
                            'command': 'incoming_child_code',
                            'parent_id': parentId,
                            'id': id,
                            'plugin_name': $in.plugin_name,
                            'plugin_code': $in.plugin_code
                        };
                        const $outJson = JSON.stringify($out);
                        $workerLookup[parentId].postMessage($outJson);
                    }

                }
                else if (xmlhttp.status == 400) {
                    alert('There was an error 400');
                }
                else {
                    alert('something else other than 200 was returned');
                }
            }
        };

        xmlhttp.open("GET", "server.php?want=" + pluginName, true);
        xmlhttp.send();
    }

    function addMessage(id, message) {
        let element = document.getElementById(id);
        let content = element.innerHTML;
        content = message + ', ' + content;
        element.innerHTML = content.substring(0,50);
    }

    /**
     * Send in the JS code and it will be started in a WebWorker
     * A WebWorker run in a separate process and can send messages.
     * You can send messages to the WebWorker.
     *
     * @param $jsCode
     */
    function startWorker(id, $pluginCode, $pluginName) {

        let $blob = new Blob([$pluginCode], {type: 'application/javascript'});
        $workerLookup[id] = new Worker(URL.createObjectURL($blob));

        $workerLookup[id].onmessage = function($e)
        {
            const $in = JSON.parse($e.data);

            if ($in.command === 'view') {
                addMessage($in.id, $in.time);
            }
        };

        // The JS code is written so that you need to send a trigger message to start its internal timer
        const $out = {
            'command': 'start_main_timer',
            'id': id
        };
        const $outJson = JSON.stringify($out);
        // $workerLookup[id].postMessage($outJson); // Just run the child timers instead

        ajaxCall(id + 'child1', id, 'infohub_webworker_child', 'send_code_to_worker');
        ajaxCall(id + 'child2', id, 'infohub_webworker_child', 'send_code_to_worker');
        ajaxCall(id + 'child3', id, 'infohub_webworker_child', 'send_code_to_worker');
    }

    function main() {
        ajaxCall('webworker1', 'webworker1', 'infohub_webworker', 'start_worker');
        ajaxCall('webworker2', 'webworker2', 'infohub_webworker', 'start_worker');
        ajaxCall('webworker3', 'webworker3', 'infohub_webworker', 'start_worker');
        ajaxCall('webworker4', 'webworker4', 'infohub_webworker', 'start_worker');
        ajaxCall('webworker5', 'webworker5', 'infohub_webworker', 'start_worker');
    }

    main()

</script>
