<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $user_id= $_SESSION['key'];
    $search= $users->test_input($_POST['search']);
    $result= $home->search($search);
    echo '<h4>People</h4>
          <div class="message-recent"> 
          ';
     foreach ($result as $user) {
         if ($user['user_id'] != $user_id) {
             # code...
             echo '<div class="people-message p-3 people-messageM" data-user="'.$user['user_id'].'">
                    	<div class="people-inner">
                    		<div class="people-img">
                    			 '.((!empty($user['profile_img']))?'
                                    <a href="#"><img src="'.BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'].'"  class="img"/></a>
                                    ':'
                                    <a href="#"><img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"  class="img" /></a>
                                ').'
                    		</div>
                    		<div class="name-right2">
                    			<span></span><span> '.$user['username'].'</span>
                    		</div>
                    	</div>
                     </div> ';
         }
      }
      echo '</div>';
}
?>