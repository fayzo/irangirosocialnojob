<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['comments']) && !empty($_POST['comments'])) {
    $user_id= $_SESSION['key'];
    $tweet_id= $_POST['tweet_id'];
    $commentz= $users->test_input($_POST['comments']);

    if (!empty($commentz)) {
        # code...
        $home->createsComment('comment',array('comment' => $commentz,'comment_on' => $tweet_id,'comment_by' => $user_id,'comment_at' => date('Y-m-d H:i:s')));
        $commentx= $comment->comments($tweet_id);
        $tweet= $home->getPopupTweet($user_id,$tweet_id,$commentz);
		 # code..
		foreach ($commentx as $comments) {
				# code..
	echo '
 		 <div class="card text-light">
		   <div class="card-body">
		     <div class="user-block">
		       '.((!empty($comments["profile_img"])?'
                  <div class="user-blockImgBorder">
                  <div class="user-blockImg">
                    <img src="'.BASE_URL_LINK.'image/users_profile_cover/'.$comments["profile_img"].'"
                    alt="user image">
                  </div>
                  </div>
                ':'<div class="user-blockImg">
                    <img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"
                    alt="user image">
                  </div>
                  </div>
                ')).'
               <span class="username"> <a href="'.PROFILE.'" style="float:left;padding-right:3px;">'.$tweet['firstname']   ." ".$tweet['lastname'].'</a>
                    <!-- //Jonathan Burke Jr. -->
                </span>
                 <span class="description"> Shared publicly - '.$home->timeAgo($comments["comment_at"]).' today
                 </span>
                 <span class="description">'.$home->getTweetLink($comments["comment"]).'</span>
              </div> <!-- /.user-block -->
		  </div> <!-- /.card-body -->

		  <div class="card-footer text-muted m-0 p-0" style="border-top: none;" ><!-- card-footer -->
				<ul class="list-inline m-0">
                     <li class="list-inline-item mx-3"><button><i class="fa fa-share" aria-hidden="true"></i></button>
                     </li>
                      <li class="list-inline-item mx-3"><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                     </li>
	           	'.(($comments["comment_by"] === $user_id)?'
					   <li class="list-inline-item mx-3">
                         <label class="deleteComment" data-tweet="'.$tweet["tweet_id"].'" data-comment="'.$comments["comment_id"].'" ><i class="fa fa-trash" aria-hidden="true"></i></label>
	           			</li>
	           	 ':'').'
				</ul>
			</div"> <!-- /.card-footer -->
		 </div><!-- /.card -->';
	   }
    }
}
?>