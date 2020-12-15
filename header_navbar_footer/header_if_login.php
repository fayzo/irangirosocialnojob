<?php 
include "core/init.php";

if ($users->loggedin() == false) {
    header('location: '.LOGIN.'');
}else if($users->loggedin() == true) {
    $user= $home->userData($_SESSION['key']);
    // $jobs= $home->jobsData($_SESSION['key']);
    // $fundraisingV= $home->fundraisingData($_SESSION['key']);
    // $eventV= $home->eventsData($_SESSION['key']);
    // $blogV= $home->blogData($_SESSION['key']);
    // $saleV= $home->saleData($_SESSION['key']);
    $user_id= $_SESSION['key'];
    $notific= $notification->getNotificationCount($user_id);
    $notification->notificationsView($user_id);
    $_SESSION['irangiro_key'] = 1;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">