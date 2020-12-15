<?php
session_start();
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

     if(isset($_REQUEST['pages'])) {  
        echo $follow->Network_FollowingLists($_REQUEST['pages'],$_REQUEST['user_id'],$_REQUEST['follow_id']);
      }

?>