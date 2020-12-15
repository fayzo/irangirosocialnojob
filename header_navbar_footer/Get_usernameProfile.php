<?php 
include "core/init.php";

if (isset($_GET['username']) == true && empty($_GET['username']) == false) {
    # code...
    $username= $users->test_input($_GET['username']);
    $uprofileId= $home->usersNameId($username);
	$profileData= $home->userData($uprofileId['user_id']);

   	if ($users->loggedin() == true) {
        $user_id= $_SESSION['key'];

        // $jobs= $home->jobsData($_SESSION['key']);
        // $fundraisingV= $home->fundraisingData($_SESSION['key']);
        // $eventV= $home->eventsData($_SESSION['key']);
        // $saleV= $home->saleData($_SESSION['key']);

		$notific= $notification->getNotificationCount($user_id);
		$notification->notificationsView($user_id);
	}else{
        $user_id= $profileData['user_id'];
	}

	$user= $home->userData($user_id);
	
    if (!isset($profileData['user_id'])) {
        # code...
        header('Location: '.LOGIN.'');
    }

}

else{

//      if (isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.crowfund' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.fundraising' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.Unemployment' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.sale' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.blog' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.jobs0' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.events' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.movies' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.sports' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.news' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.entertainment' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.rwandaPhotos' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.Tembera' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.hotelbooking' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.house' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.car' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.food' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.domestic' ||
//          isset($_SERVER['REQUEST_URI']) == '/Blog_nyarwanda_CMS/jojo.school' 
//     ){
//         # code...
        $username= $users->test_input('irangiro');
        $uprofileId= $home->usersNameId($username);
        $profileData= $home->userData($uprofileId['user_id']);

        if ($users->loggedin() == true) {
            $user_id= $_SESSION['key'];

//             $jobs= $home->jobsData($_SESSION['key']);
//             $fundraisingV= $home->fundraisingData($_SESSION['key']);
//             $eventV= $home->eventsData($_SESSION['key']);
//             $blogV= $home->blogData($_SESSION['key']);
//             $saleV= $home->saleData($_SESSION['key']);

            $notific= $notification->getNotificationCount($user_id);
            $notification->notificationsView($user_id);
        }else{
            $user_id= $profileData['user_id'];
        }

        $_SESSION['irangiro_key'] = 1;

        $user= $home->userData($user_id);
        
        if (!isset($profileData['user_id'])) {
            # code...
            header('Location: '.LOGIN.'');
        }

//     }else{
//          header('Location: '.LOGIN.'');
//     }

}

// echo $sale->cart_item(); 

// echo $food->Foodcart_item(); 

// echo $gurisha->cart_gurisha_item();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    