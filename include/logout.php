<?php
include "../core/init.php";

$users->forgotUsernameCountsTodelete('users',
array('forgotUsernameCounts' => 'forgotUsernameCounts +1', ),$_SESSION['keycreate']);
$db->query("UPDATE users SET chat = 'off' WHERE user_id= $_SESSION[key] ");

session_unset($_SESSION['key']);
session_unset($_SESSION['keycreate']);
session_unset($_SESSION['profile_img']);
session_unset($_SESSION['approval']);
session_unset($_SESSION['chat']);
session_unset($_SESSION['username']);
session_destroy();
header ('location: '.LOGIN.'');


?>