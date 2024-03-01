<!DOCTYPE HTML>
<html lang="sv">
<head title="Notification API demo #2">
    <script>

        function checkPermission() {

            let permission = Notification.permission;

            if (permission === 'granted') {
                setPermissionStatusText('Notification permission granted.');
                document.getElementById('requestPermission').disabled = true;
                document.getElementById('notificationButton').disabled = false;
                return;
            }

            document.getElementById('requestPermission').disabled = false;
            document.getElementById('notificationButton').disabled = true;

            if (permission === 'denied') {
                setPermissionStatusText('User did not grant the notification permission.');
                return;
            }

            setPermissionStatusText('Notification permission not yet requested.');
        }

        function setPermissionStatusText(permissionText) {
            let permissionStatusElement = document.getElementById('permissionStatus')
            permissionStatusElement.textContent = 'Permission status: ' + permissionText;
        }

        function setNotificationStatusText(notificationText) {
            let notificationStatusElement = document.getElementById('notificationStatus')
            notificationStatusElement.textContent = 'Notification status: ' + notificationText;
        }

        function requestPermission() {
            Notification.requestPermission().then(function (permission) {
                checkPermission();
            });
        }

        function sendNotification() {

            let title = 'Hello';
            let body = 'I am a notification';

            let notification = new Notification(title, {body: body});

            setNotificationStatusText('Notification sent');

            notification.onclick = function(event) {
                setNotificationStatusText('Notification clicked');
            }

            notification.onclose = function(event) {
                setNotificationStatusText('Notification closed');
            }

            notification.onerror = function(event) {
                setNotificationStatusText('Notification error');
            }

            notification.onshow = function(event) {
                setNotificationStatusText('Notification showed');
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            checkPermission();
        }, false);

    </script>
    <title>Notification API demo #2</title>
</head>
<body>
    <h1>Notification API demo #2</h1>

    <p>Follow the instructions <a href="https://github.com/peterlembke/rox/blob/main/images/web/certificates/Documentation/macos-allow-notifications.md">here</a> to get it working with notifications in different browsers.</p>

    <p>Press the button to be asked if you allow notifications</p>
    <button id="requestPermission" onclick="requestPermission()">
        Ask for permission
    </button>

    <div id="permissionStatus">Permission status</div>

    <p>Press the button to get a notification</p>
    <button id="notificationButton" onclick="sendNotification()" disabled>
        Get notification
    </button>

    <div id="notificationStatus">Notification status</div>

    <p>On macOS you see the notification center by clicking on the date-time on the upper right.</p>

    <p>The notification status changes on this web page when you view/click/close the notification.</p>

    <p>The source code is here <a href="https://github.com/peterlembke/labs/tree/master/public_html/notification">GitHub</a></p>

</body>
</html>