<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['showpoptweet']) && !empty($_POST['showpoptweet'])) {
    $user_id= $_SESSION['key'];
    $tweet_id= $_POST['showpoptweet'];
    $getid="";
    $tweet= $home->getPopupTweet($user_id,$tweet_id,$getid);
    $tweet_likes= $home->likes($user_id,$tweet_id);
    $Retweet= $home->checkRetweet($tweet_id, $user_id);
  	$user= $home->userData($tweet_id);
	$comment_= $comment->comments($tweet_id);
    ?>

<div class="tweet-show-popup-wrap">
    <input type="checkbox" id="tweet-show-popup-wrap">
    <div class="wrap4">
        <label for="tweet-show-popup-wrap">
            <div class="tweet-show-popup-box-cut">
                <i class="fa fa-times" aria-hidden="true"></i>
            </div>
        </label>
        <div class="tweet-show-popup-box">

            <div class="card">
                <div class="card-header">

                    <div class="user-block">
                        <!-- <button class="f-btn btn btn-primary btn-sm float-right"><i class="fa fa-user-plus"></i> Follow</button> -->
                        <div class="float-right"><?php echo $follow->followBtn($tweet['user_id'],$user_id,$tweet['user_id']) ;?></div>
                        <?php if (!empty($tweet['profile_img'])) { ?>
                        <div class="user-blockImgBorder">
                        <div class="user-blockImg">
                          <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$tweet['profile_img'] ;?>"
                          alt="user image">
                        </div>
                        </div>
                        <?php } ?>
                        <span class="username">
                            <a href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['username'] ;?></a>
                            <!-- //Jonathan Burke Jr. -->
                        </span>
                        <span class="description">Shared publicly - <?php echo $home->getTweetLink($tweet['status']); ?></span>
                    </div> <!-- /.user-block -->

                </div> <!-- /.card-headed -->

                <div class="card-body">
                    <p> <?php echo $home->getTweetLink($tweet['status']);?></p>
                 <?php 
                                    $expodefile = explode("=",$tweet['tweet_image']);
                                    $fileActualExt= array();
                                    for ($i=0; $i < count($expodefile); ++$i) { 
                                        $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
                                    }

                                    $allower_ext = array('jpeg','peg','jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','docx','ocx','xlsx','lsx'); // valid extensions
                                if (array_diff($fileActualExt,$allower_ext) == false) {
                                    // if (!empty($tweet['tweet_image'])) {
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
                                    <video controls preload="metadata" width="500px"  height="280px" preload="none">
                                        <source src="<?php 
                                        $expode = explode("=",$tweet['tweet_image']); 
                                        echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>" type="video/mp4"> 
                                        <!-- <source src="video/boatride.webm" type="video/webm">  -->
                                            <!-- fallback content here 
                                            poster="< ?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>"
                                            object-fit="contain"
                                           object-fit= fill
                                           object-fit= none
                                           object-fit= cover
                                           preload=none 
                                           preload=metadata
                                            -->
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
                              <?php } ?>

                </div> <!-- card-body -->
                <div class="card-footer text-muted text-center">
                    <!-- card-footer -->

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
												<label class="deleteTweet more" data-tweet="'.$tweet["tweet_id"].'"  data-user="'.$tweet["tweetBy"].'" ><i class="fa fa-trash" aria-hidden="true"></i></label>
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

                </div><!-- card-footer -->

                <?php if ($users->loggedin() === true) {?>

                <div class="card" style="background-color:rgba(92, 132, 61, 0.2)">
                    <div class="card-body">
                        <div class="user-block">
                            <?php if (!empty($tweet['profile_img'])) {?>
                             <div class="user-blockImgBorder">
                              <div class="user-blockImg">
                                <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$tweet['profile_img'] ;?>"
                                alt="user image">
                              </div>
                              </div>
                            <?php }else {?>
                            <div class="user-blockImgBorder">
                            <div class="user-blockImg">
                              <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>"
                              alt="user image">
                            </div>
                            </div>
                            <?php }?>

                            <div class="username mt-3 mr-0">
                                <div class="input-group">
                                    <input class="form-control form-control-sm" id="commentField" type="text"
                                        name="comment" data-tweet="<?php echo $tweet['tweet_id'];?>"
                                        placeholder="Reply to @<?php echo $tweet['username'] ;?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn" style="padding: 0px 10px;" onclick="#"
                                            aria-label="Username" aria-describedby="basic-addon1">
                                                <span class="fa fa-arrow-right text-muted"
                                                    id="postComment"></span></span>
                                    </div>
                                </div> <!-- input-group -->
                            </div> <!-- input-group -->
                        </div><!-- user-block -->

                    </div><!-- card-body -->
                </div><!-- card-end -->
                <?php  } ?>
                
                <span id="responseComment"></span>
                <!-- <div class="tweet-show-popup-comment-wrap"> -->
                <div id="comments">
                    <!--COMMENTS-->
                    <?php foreach ($comment_ as $comments) {
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

                ':' <div class="user-blockImgBorder">
                   <div class="user-blockImg">
                    <img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"
                    alt="user image">
                  </div>
                  </div>
                ')).'
               <span class="username"> <a href="'.BASE_URL_PUBLIC.$comments['username'].'" style="float:left;padding-right:3px;">'.$comments['firstname']   ." ".$comments['lastname'].'</a>
                    <!-- //Jonathan Burke Jr. -->
                </span>
                 <span class="description"> Shared publicly - '.$home->timeAgo($comments["comment_at"]).' today
                 </span>
                 <span class="description">'.$home->getTweetLink($comments["comment"]).'</span>
              </div> <!-- /.user-block -->
		  </div> <!-- /.card-body -->

		  <div class="card-footer text-muted m-0 p-0" style="border-top: none;"><!-- card-footer -->
				<ul class="list-inline m-0">
                     <li class="list-inline-item mx-3 "><button><i class="fa fa-share" aria-hidden="true"></i></button>
                     </li>
                      <li class="list-inline-item mx-3 "><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                     </li>
	           	'.(($comments["comment_by"] === $user_id)?'
					   <li class="list-inline-item mx-3 more">
                         <label class="deleteComment more" data-tweet="'.$tweet["tweet_id"].'" data-comment="'.$comments["comment_id"].'" ><i class="fa fa-trash" aria-hidden="true"></i></label>
	           			</li>
	           	 ':'').'
				</ul>
			</div"> <!-- /.card-footer -->
		 </div><!-- /.card -->';
	           			  }
	           			 ?>
                </div><!-- comment-End -->

            </div><!-- card-End -->
        </div> <!-- Wrp4 -->
    </div> <!-- tweet-show-popup-wrap" -->

    <?php }
?>