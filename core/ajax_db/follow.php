<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['follow']) && !empty($_POST['follow'])) {
    $user_id= $_SESSION['key'];
    $follow_id= $_POST['follow'];
    $profile_id= $_POST['profile'];
    $follow->follows($follow_id,$user_id,$profile_id);
    // $result['following']= "1";
    // echo json_encode($result);
}

if (isset($_POST['unfollow']) && !empty($_POST['unfollow'])) {
    $user_id= $_SESSION['key'];
    $follow_id= $_POST['unfollow'];
    $profile_id= $_POST['profile'];
    $follow->unfollow($follow_id,$user_id,$profile_id);
    // $result['following']= 0;
    // echo json_encode($result);
}


?>