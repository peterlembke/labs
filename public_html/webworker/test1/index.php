<script>
    var $response = "self.onmessage=function(e){postMessage('Worker: '+e.data);}";
    var $blob = new Blob([$response], {type: 'application/javascript'});
    var $worker = new Worker(URL.createObjectURL($blob));
    $worker.onmessage = function(e) {
        alert('Response: ' + e.data);
    };
    $worker.postMessage('Test');
</script>
