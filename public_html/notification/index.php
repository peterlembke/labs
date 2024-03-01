<!DOCTYPE HTML>
<html lang="sv">
<head title="Notification API demo">
    <script>

    </script>
    <title>Notification API demo</title>
</head>
<body>

    <h1>Notification API demo #1</h1>

    <p>Press the button to be asked if you allow notifications</p>

    <button onclick="Notification.requestPermission()">Ask for permission</button>

    <p>Press the button to get a notification</p>

    <button onclick="new Notification('Hello', {body: 'I am a notification'})">Get notification</button>

    <p><a href="index.php">Demo #1</a></p>
    <p><a href="index2.php">Demo #2</a></p>

</body>
</html>