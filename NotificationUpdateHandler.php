<?php
    require_once('controller.php');
    $userId = $_COOKIE['userid'];
    $notificationController = new NotificationController();
    $notificationController->getNotifications($userId);
?>