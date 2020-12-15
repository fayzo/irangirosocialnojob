<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['like']) && !empty($_POST['like'])) {
    $user_id= $_SESSION['key'];
    $comment_id= $_POST['like'];
    $get_id= $_POST['user_id'];
    $home->add_post_Like_second($user_id,$comment_id, $get_id);
}

if (isset($_POST['unlike']) && !empty($_POST['unlike'])) {
    $user_id= $_SESSION['key'];
    $comment_id= $_POST['unlike'];
    $get_id= $_POST['user_id'];
    $home->unLike_post_second($user_id,$comment_id, $get_id);
}

if (isset($_POST['dislike']) && !empty($_POST['dislike'])) {
    $user_id= $_SESSION['key'];
    $comment_id= $_POST['dislike'];
    $get_id= $_POST['user_id'];
    $home->dislike_comment($user_id,$comment_id, $get_id);
}

if (isset($_POST['undislike']) && !empty($_POST['undislike'])) {
    $user_id= $_SESSION['key'];
    $comment_id= $_POST['undislike'];
    $get_id= $_POST['user_id'];
    $home->undislike_comment($user_id,$comment_id, $get_id);
}

?>
