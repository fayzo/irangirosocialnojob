<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['search']) && !empty($_POST['search'])) {
    # code...
    $search= $users->test_input($_POST['search']);
    $result= $home->search($search);

     if (is_array($result) || is_object($result)){
       
       echo '<div id="black" class="nav-right-down-wrap main-active">
             <ul '.((count($result) > 6 )?'class="large-2" style="height:400px;"':'').' > ';
                //  echo var_dump($result);
    
    foreach ($result as $user) {
        # code...
        ?>
                 <li>
  	            	<div class="nav-right-down-inner">
                              <div class=" nav-right-down-left">
                                <div class="user-blockImgBorder">
                                     <div class="user-blockImg">
                                          <?php if (!empty($user['profile_img'])) {?>
                                          <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="user-image rounded-circle" alt="User Image">
                                          <?php  }else{ ?>
                                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="user-image rounded-circle" alt="User Image">
                                          <?php } ?>
                                     </div>
                                </div>
                              </div>
	            		<div class="nav-right-down-right">
	            			<div class="nav-right-down-right-headline">
                                <a href="<?php echo BASE_URL_PUBLIC ;?><?php echo $user["username"] ;?>"><?php echo $user["username"] ;?></a>
                                <span ><i class="fa fa-star" style="color:#e21010c7"></i> <?php echo " ".$user["career"]; ?></span>
	            			</div>
	            			<div class="nav-right-down-right-body">
                               <div><i class="fa fa-play" style="color:#e210a3c7"></i> <?php echo " ".$user["hobbys"]; ?></div>
	            			 
	            		    </div>
	            		</div>
	            	</div> 
	             </li> 
     <?php } ?>
           </ul>
         </div> 
<?php  }
}
?>