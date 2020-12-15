<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['deleteTweetHome']) && !empty($_POST['deleteTweetHome'])) {
    $user_id= $_SESSION['key'];
	$tweet_id= $_POST['deleteTweetHome'];
    $comment->deleteLikesNotificatPosts($tweet_id,$user_id);
}

if (isset($_POST['showpopupdelete']) && !empty($_POST['showpopupdelete'])) {
    $user_id= $_SESSION['key'];
	$tweet_id= $_POST['showpopupdelete'];
	$deleteTweet_id= $_POST['deleteTweet'];
    $tweet=$home->getPopupTweet($user_id,$tweet_id,$deleteTweet_id);
    ?>
    <div class="retweet-popup">
      <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <div class="img-popup-wrap"  id="popupEnd">
            <div class="card">
            <span id='responseDeletePost'></span>
                <div class="card-header">
                    <span class="closeDelete"><button class="close-retweet-popup" onclick="togglePopup()"><i class="fa fa-times" aria-hidden="true"></i></button></span>
                    <h5 class="text-center text-muted">Are you sure you want to delete this Posts?</h5>
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
                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $tweet['firstname']." ".$tweet['lastname'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                            <span class="description">Shared publicly - <?php echo $users->timeAgo($tweet['posted_on']); ?></span>
                        </span>
                        <span class="description">
                <?php 
                $expodefile = explode("=",$tweet['tweet_image']);
                $fileActualExt= array();
                for ($i=0; $i < count($expodefile); ++$i) { 
                     $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                }
                $allower_ext = array('jpeg','peg','jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','ocx','lsx'); // valid extensions
            
            if (array_diff($fileActualExt,$allower_ext) == false) {
                    $expode = explode("=",$tweet['tweet_image']);
                    $count = count($expode); ?>

            <?php 
             $docx= array('jpg','jpeg','peg','png','gif','pdf');
             $pdf= array('jpg','jpeg','peg','png','gif');
             $image= array('pdf','doc','ocx','lsx'); ?>

            <?php if(array_diff($fileActualExt,$image)) { 

                if ($count === 1) { ?>

                 <div class="row mb-1">
                        <?php $expode = explode("=",$tweet['tweet_image']); ?>
                    <div class="col-sm-12 more">
                        <img class="img-fluid imagePopup"
                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>"
                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                    </div>
                 </div>

                <?php
                 }else if($count === 2){?>
                    <div class="row mb-2 more">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                              $splice= array_splice($expode,0,2);
                              for ($i=0; $i < count($splice); ++$i) { 
                              ?>
                        <div class="col-sm-6">
                            <img class="img-fluid mb-2 imagePopup"
                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                        </div>
                            <?php }?>
                    </div>

                <?php }else if($count === 3 || $count > 3){?>
                 <div class="row mb-2 more">
                        <?php $expode = explode("=",$tweet['tweet_image']);
                          $splice= array_splice($expode,0,1);
                          ?>
                    <div class="col-sm-6">
                        <img class="img-fluid mb-2 imagePopup"
                            src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[0] ;?>"
                            alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                    </div>
                    <!-- /.col -->

                    <div class="col-sm-6">
                        <div class="row mb-2 more">
                                <?php 
                                $expode = explode("=",$tweet['tweet_image']);
                                // var_dump($expode);
                                $splice= array_splice($expode,1,2);
                                // var_dump($splice);
                                 for ($i=0; $i < count($splice); ++$i) { ?>
                            <div class="col-sm-6">
                                <img class="img-fluid mb-2 imagePopup"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                            </div>
                                <?php }?>

                        </div>
                        <!-- /.row -->
                        <div class="row more">
                                <?php 
                                $expode = explode("=",$tweet['tweet_image']);
                                $splice= array_splice($expode,3,2);
                                 for ($i=0; $i < count($splice); ++$i) { ?>
                            <div class="col-sm-6">
                                <img class="img-fluid mb-2 imagePopup"
                                    src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                    alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                            </div>
                                <?php }?>

                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
              
                 <!-- /.row -->
                <div class="row">
                   <div class="col-sm-12">
                       <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                    </div>
                </div>
                <!-- /.row -->
                   
                <?php } 

                }else if(array_diff($fileActualExt,$docx)) { 

                //Columns must be a factor of 12 (1,2,3,4,6,12)
                $rowCount = 0;
                switch ($count) {
                    case 1:
                           $numOfCols = 1; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <?php 
                    break;
                case 2:
                        # code...
                           $numOfCols = 2; ?>

                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 3:
                        # code...
                           $numOfCols = 3; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 4:
                        # code...
                           $numOfCols = 2; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break; 
                    case 5:
                        # code...
                           $numOfCols = 3; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                     
                    <?php
                        break; 
                    case 6:
                        # code...
                           $numOfCols = 3; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo $numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-word-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- ||Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i
                                            class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                        </div>
                    </div>
                <!-- /.row -->
                    <?php
                        break;
                }
                
                }else if(array_diff($fileActualExt,$pdf)) { 

                //Columns must be a factor of 12 (1,2,3,4,6,12)
                $rowCount = 0;
                switch ($count) {
                    case 1:
                           $numOfCols = 1; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <?php 
                    break;
                case 2:
                        # code...
                           $numOfCols = 2; ?>

                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 3:
                        # code...
                           $numOfCols = 3; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break;
                    case 4:
                        # code...
                           $numOfCols = 2; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    }
                    ?>
                    </div> <?php
                        break; 
                    case 5:
                        # code...
                           $numOfCols = 3; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo 12/$numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                     
                    <?php
                        break; 
                    case 6:
                        # code...
                           $numOfCols = 3; ?>
                           <div class="row">
                            <?php $expode = explode("=",$tweet['tweet_image']);
                            // $splice= array_splice($expode,0,2);
                            $splice= $expode;
                            for ($i=0; $i < count($splice); ++$i) { 
                            ?>
                        <div class="col-md-<?php echo $numOfCols; ?>">
                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                            <div class="mailbox-attachment-info main-active">
                                <a href="<?php echo BASE_URL_PUBLIC."uploads/posts/".pathinfo($splice[$i])['basename'] ;?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                    <?php  echo pathinfo($splice[$i])['basename'] ;?></a><!-- || Sep2014-report.pdf -->
                                <span class="mailbox-attachment-size">
                                    1,245 KB
                                    <a href="#" class="btn btn-default btn-sm float-right"><i class="fa fa-cloud-download"></i></a>
                                </span>
                            </div>
                        </div><!-- col -->
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                    } ?>
                    </div> 
                    <div class="row">
                        <div class="col-sm-12">
                            <span class="btn btn-primary btn-sm float-right imageViewPopup more"  data-tweet="<?php echo $tweet["tweet_id"] ;?>" >View More photo <i class="fa fa-picture-o"></i>  >>></span>
                        </div>
                    </div>
                <!-- /.row -->
                    <?php
                        break;
                }
                
            } ?>
                 
            <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp4') { ?>

                <div class="row mb-2" >
                <div class="col-12" >
                    <?php $expode = explode("=",$tweet['tweet_image']); ?>
                <video controls poster="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>" width="500px" height="280px">
                    <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0];?>" type="video/mp4"> 
                    <!-- <source src="video/boatride.webm" type="video/webm">  -->
                        <!-- fallback content here -->
                </video>
                </div>
                </div>
          <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'webm'){ ?>
             <div class="row mb-2">
                <div class="col-12">
                <video controls poster="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" width="auto" height="auto">
                    <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/webm"> 
                        <!-- fallback content herehere -->
                </video>
                 </div>
                </div>
          <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'mp3'){ ?>
            <div class="row mb-2">
                <div class="col-12">
                <audio controls>
                     <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="audio/mp3">
                         <!-- fallback content here -->
                 </audio>
                  </div>
                </div>
          <?php }else if(array_diff($fileActualExt,$allower_ext)[0] == 'ogg'){ ?>
                <audio controls>
                     <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="audio/ogg"> 
                         <!-- fallback content here -->
                 </audio>
          <?php }?>

                          </span>
                    <p id="link_">
                        <?php echo $home->getTweetLink($tweet['status']) ;?>
                    </p>
                    </div> <!-- user-block -->
                </div><!-- card-body -->
                <div class="card-footer"><!-- card-footer -->
                <button class="delete-it  btn btn-primary btn-md float-right ml-3" type="submit">Delete</button>
                <button class="cancel-it btn btn-info btn-md  float-right">Cancel</button>
                </div><!-- card-footer -->
            </div><!-- card end -->
       </div> <!-- retweet-popup-body-wrap -->
     </div><!-- wrp5 -->
  </div><!-- retweet-popup -->

<?php
}
?>