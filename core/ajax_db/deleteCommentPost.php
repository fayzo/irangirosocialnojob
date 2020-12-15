<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
    $user_id= $_SESSION['key'];
    $deletecomment_id= $_POST['deleteTweetHome'];
    $comment->delete('comment',array('comment_id' => $deletecomment_id,'comment_by' => $user_id));
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$comment_id= $_POST['showpopupdelete'];
	$comment_by= $_POST['deleteTweet'];
    $commentS= $home->getPopupDeleteComPost($comment_id);
    var_dump($commentS);
    ?>
    <div class="retweet-popup">
    <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup()"></div>
        <div class="img-popup-wrap"  id="popupEnd">
            <div class="card">
               <span id='responseDeletePost'></span>
                <div class="card-header">
                    <span class="closeDelete"><button class="close-retweet-popup" onclick="togglePopup()" ><i class="fa fa-times" aria-hidden="true"></i></button></span>
                    <span class="closeDelete"><button class="close-retweet-popup"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                    <h5 class="text-center text-muted">Are you sure you want to delete this Comments?</h5>
                </div>
                <div class="card-body">

                    <div class="user-block">
                           <div class="user-blockImgBorder">
                                <div class="user-blockImg">
                                     <?php if (!empty($tweet['profile_img'])) {?>
                                     <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $tweet['profile_img'] ;?>" alt="User Image">
                                     <?php  }else{ ?>
                                       <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                     <?php } ?>
                               </div>
                            </div>
                        <span class="username">
                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $commentS['firstname']." ".$commentS['lastname'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                            <span class="description">Shared publicly - <?php echo $users->timeAgo($commentS['comment_at']); ?></span>
                        </span>
                        <span class="description">
                        <?php echo  $home->getTweetLink($commentS["comment"]) ;?>
                          </span>
                    </div> <!-- user-block -->
                </div><!-- card-body -->
                <div class="card-footer"><!-- card-footer -->
                <button class="delete-its  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-its btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- retweet-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- retweet-popup -->

<?php
}
?>