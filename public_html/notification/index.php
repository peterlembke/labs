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

    <div><?php include "menu.php"; ?></div>

</body>
</html>