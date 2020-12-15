<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['showpimage']) && !empty($_POST['showpimage'])) {
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    } else {
        # code...
        $user_id= 65;
    }
    
    $tweet_id=$_POST['showpimage'];
    $getid="";
    $tweet= $home->getPopupTweet($user_id,$tweet_id,$getid);
    $tweet_likes= $home->likes($user_id,$tweet_id);
    $Retweet= $home->checkRetweet($tweet_id, $user_id);
    $user= $home->userData($tweet_id);

$filename = $tweet['tweet_image'];
$expodefile = explode("=",$tweet['tweet_image']);
$fileActualExt= array();
for ($i=0; $i < count($expodefile); ++$i) { 
$fileActualExt[]= strtolower(substr($expodefile[$i],-3));
}

$allower_ext = array('jpeg','peg','jpg', 'png', 'gif'); // valid extensions
if (array_diff($fileActualExt,$allower_ext) == false) { ?>

    <div class="img-popup">
      <div class="wrap6"  id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap" id="popupEnd">
          <div class="row ">
           <div class="col-12">
              <div class="card">
                 <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
                <div class="img-popup-body" >
               
                  <div id="jssor_1"  style="position:relative;margin:0 auto;top:0px;left:0px;width:980px;height:380px;overflow:hidden;visibility:hidden;">
                      <!-- Loading Screen -->
                      <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                          <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo BASE_URL_LINK;?>image/img/spin.svg" />
                      </div>
                      <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;"> <!--width:980px height: 380 -->
                            <?php $expode = explode("=",$tweet['tweet_image']);
                              $splice= array_splice($expode,0,10);
                              for ($i=0; $i < count($splice); ++$i) { 
                                  ?>
                            <div class="imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                            <img data-u="image" src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                alt="Photo" >
                            </div>
                            <?php } ?>
                         
                      </div>
                      <!-- Bullet Navigator -->
                      <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                          <div data-u="prototype" class="i" style="width:16px;height:16px;">
                              <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                  <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                              </svg>
                          </div>
                      </div>
                      <!-- Arrow Navigator -->
                      <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                          <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                              <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                              <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                              <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                          </svg>
                      </div>
                      <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                          <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                              <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                              <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                              <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                          </svg>
                      </div>
                 </div>
                 <script type="text/javascript">jssor_1_slider_init();</script>

            </div><!-- img-popup-body -->
            <div class="img-popup-footer">
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
                                <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $tweet['firstname']." ".$tweet['lastname'] ;?></a>
                                <!-- //Jonathan Burke Jr. -->
                                <span class="description">Shared publicly - 7:30 PM today</span>
                            </span>
                            <span class="description"><?php echo $home->getTweetLink($tweet['status']); ?></span>
                        </div> <!-- user-block -->

            </div><!-- card-body -->
            <div class="card-footer text-muted text-center"><!-- card-footer -->
                    <ul class="list-inline">
                        <?php 
           if ($users->loggedin() === true) {
        echo '
            <li class="list-inline-item mx-4 ">
							<div class="d-inline-block ">
								<h3>Shared </h3> 
									 '.(($tweet['tweet_id'] == $Retweet["retweet_id"])? 
									 '<button class="share-btn retweeted" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'" >
									    <i class="fa fa-share green " aria-hidden="true"></i><span class="retweetcounter" > '.$Retweet["retweet_counts"].'</span></button>'
									    :'<button class="retweet" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'" >
									    <i class="fa fa-share" aria-hidden="true"></i><span class="retweetcounter" >'.(($Retweet["retweet_counts"] > 0)? " ".$Retweet["retweet_counts"] :'' ).'</span>
									 </button>').'
							</div>
						</li>
						
            <li class="list-inline-item mx-4">
								<div class="d-inline-block ">
									 <h3>LIKES</h3> 
										'.(($tweet_likes["like_on"] == $tweet["tweet_id"])? 
										'<button class="unlike-btn" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'">
										   <i class="fa fa-thumbs-up" aria-hidden="true"></i><span class="likescounter" > '.$tweet["likes_counts"].'</span></button> ' 
										   : '<button class="like-btn" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'">
									     <i class="fa fa-thumbs-o-up " aria-hidden="true"></i><span class="likescounter" >'.(($tweet["likes_counts"] > 0)? " ".$tweet["likes_counts"]:'' ).'</span>
										</button> ').'
							</div>
						</li>

            <li class="list-inline-item mx-4">
								<div class="d-inline-block ">
							   	<h3>	Viewers </h3> 2,030
						  	</div>
						</li>
            <li class="list-inline-item mx-4">
							<div class="d-inline-block ">
							   	<h3>Posted on</h3>'.$home->timeAgo($tweet['posted_on']).' 
						  	</div>
							 </li>
				 '.(($tweet["tweetBy"] === $user_id)?'
						<li class="list-inline-item mx-4">
							<div class="d-inline-block ">
									 <h3>Delete</h3> 
												<label class="deleteTweet" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'" ><i style="color:red" class="fa fa-trash" aria-hidden="true"></i></label>
						  	</div>
						</li> ' :'').'
									 ';
						 }else {?>
                        <li class="list-inline-item mx-4 ">
                            <div class="d-inline-block ">
                                <h3>Shared </h3>
                                <?php echo $tweet["retweet_counts"] ;?>
                            </div>
                        </li>

                        <li class="list-inline-item mx-4 ">
                            <div class="d-inline-block ">
                                <h3>LIKES</h3>
                                <?php echo $tweet["likes_counts"] ;?>
                            </div>
                        </li>

                        <li class="list-inline-item mx-4">
                            <div class="d-inline-block ">
                                <h3>Posted on</h3> <?php echo $home->timeAgo($tweet['posted_on']);?>
                            </div>
                        </li>

                        <?php } ?>
                    </ul>

                    </div><!-- card-footer END -->
                </div><!-- card -->
            </div> <!-- img-popup-footer -->
         
                </div><!-- col -->
            </div> <!-- row -->
        </div><!-- img-popup-wrap -->
    
       </div> <!-- wrap6 -->
    </div><!-- img-popup ends-->

<?php }
}
?>

