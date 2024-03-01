<!DOCTYPE HTML>
<html lang="sv">
<head title="Notification API demo #3">
    <script>

        let currentNotification = null;

        function checkPermission() {

            let permission = Notification.permission;

            if (permission === 'granted') {
                setPermissionStatusText('Notification permission granted.');
                setButtonEnable(true);
                return;
            }

            setButtonEnable(false);

            if (permission === 'denied') {
                setPermissionStatusText('User did not grant the notification permission.');
                return;
            }

            setPermissionStatusText('Notification permission not yet requested.');
        }

        function setButtonEnable(isAllowed) {
            document.getElementById('requestPermission').disabled = isAllowed;
            document.getElementById('notificationButton').disabled = ! isAllowed;
            document.getElementById('removeExistingNotificationButton').disabled = ! isAllowed;
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

            let timeString = new Date().toLocaleTimeString();

            let title = 'Hello';
            let body = 'I am a notification with a tag. Send me again and I update. ' + timeString;
            let tag = 'demo-3-tag';

            let options = {
                body: body,
                icon: 'icon96.png',
                tag: tag,
                image: 'image320.png',
            };

            let notification = new Notification(title, options);

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

            currentNotification = notification;
        }

        function removeExistingNotification() {
            if (currentNotification === null) {
                return;
            }
            currentNotification.close();
            currentNotification = null;
            setNotificationStatusText('Notification removed');
        }

        document.addEventListener("DOMContentLoaded", function() {
            checkPermission();
        }, false);

    </script>
    <title>Notification API demo #3</title>
</head>
<body>
    <h1>Notification API demo #3</h1>

    <p>Demo #3 have an icon in the note. Note is tagged, so you overwrite instead of add another note.</p>

    <p>Press the button to be asked if you allow notifications</p>
    <button id="requestPermission" onclick="requestPermission()">
        Ask for permission
    </button>

    <div id="permissionStatus">Permission status</div>

    <p>Press the button to send a notification to the operating system notification handler</p>
    <button id="notificationButton" onclick="sendNotification()" disabled>
        Send notification
    </button>

    <div id="notificationStatus">Notification status</div>

    <p>Press the button to remove the message</p>
    <button id="removeExistingNotificationButton" onclick="removeExistingNotification()" disabled>
        Remove notification
    </button>

    <h2>Information</h2>
    <p>You can send notifications to the operating system. Like this</p>
    <img src="macOS-Brave-Notification-Example.png" alt="Notification" style="width: 100%; max-width: 400px;">

    <p>Follow the instructions <a href="https://github.com/peterlembke/rox/blob/main/images/web/certificates/Documentation/macos-allow-notifications.md" target="_blank" rel="noopener noreferrer">here</a> to get it working with notifications in different browsers.</p>
    <p>On macOS you see the notification center by clicking on the date-time on the upper right.</p>
    <p>The notification status changes on this web page when you view/click/close the notification.</p>
    <p>The source code is here <a href="https://github.com/peterlembke/labs/tree/master/public_html/notification" target="_blank" rel="noopener noreferrer">GitHub</a></p>

    <div><?php include "menu.php"; ?></div>

</body>
</html>