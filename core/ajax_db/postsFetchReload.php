
                            <?php
                             include('../init.php');
                            $users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

                                 $tweets= $home->tweets($_SESSION['key'],1);
                             foreach ($tweets as $tweet) {
                                $likes= $home->likes($_SESSION['key'],$tweet['tweet_id']);
                                $retweet= $home->checkRetweet($tweet['tweet_id'],$_SESSION['key']);
                                 $user= $home->userData($tweet['retweet_by']);
                                     # code... 
                                    //  echo var_dump($retweet['retweet_Msg']).'<br>';
                                ?>
                                <div class="post">
                                    <?php 
                                     if($retweet['retweet_id'] == $tweet["tweet_id"] || $tweet["retweet_id"] > 0){ ?>
                                      <span class="t-show-banner">
                                          <div class="t-show-banner-inner">
                                              <span><i class="fa fa-retweet "></i></span><span><?php echo $user['username'].' Shared';?></span>
                                          </div>
                                      </span>
                                     <?php } else{ echo '';}?>

                               <?php if(!empty($retweet['retweet_Msg']) && $tweet["tweet_id"] == $retweet["retweet_id"] || $tweet["retweet_id"] > 0){ ?> 
                                    <div class="user-block">
                                        <img class="rounded-circle img-bordered-sm"
                                            src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'] ;?>"
                                            alt="user image">
                                        <span class="username">
                                            <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $user['firstname']." ".$user['lastname'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                            <span class="description">Shared public - <?php echo $users->timeAgo($retweet['posted_on']); ?></span>
                                        </span>
                                        <span class="description"><?php echo $home->getTweetLink($retweet['retweet_Msg']); ?></span>
                                    </div>

                                    <div class="card bg-light t-show-popup more" data-tweet="<?php echo $tweet["tweet_id"];?>">
                                      <div class="card-body ">
                                        <?php if (!empty($tweet['tweet_image'])) {
                                     			    $expode = explode("=",$tweet['tweet_image']); 
                                                    $count = count($expode); ?>
                                          <div class="row">
                                              <div class="col-6 ">

                                               <?php if ($count === 1) { ?>
                                                    <div class="row mb-1">
                                                           <?php $expode = explode("=",$tweet['tweet_image']); ?>
                                                       <div class="col-sm-12">
                                                           <img class="img-fluid"
                                                               src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$expode[0] ;?>"
                                                               alt="Photo">
                                                       </div>
                                                    </div>

                                               <?php }else if($count == 2 || $count > 2){ ?>
                                                     <div class="row mb-2">
                                                           <?php 
                                                             $expode = explode("=",$tweet['tweet_image']);
                                                             $splice= array_splice($expode,0,2);
                                                             for ($i=0; $i < count($splice); ++$i) { 
                                                             ?>
                                                       <div class="col-sm-6">
                                                           <img class="img-fluid mb-2"
                                                               src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                               alt="Photo">
                                                       </div>
                                                           <?php } ?>
                                                    </div>
                                                    <div class="row">
                                                       <div class="col-sm-12">
                                                           <a name="" id="" class="btn btn-primary btn-sm float-right" href="#" role="button">View More <i class="fa fa-picture-o"></i> >>></a>
                                                        </div>
                                                    </div>
                                                    <!-- /.row -->
                                               <?php } ?>
                                                </div> <!-- col -->

                                                <div class="col-6">
                                                    <div class="row">
                                                        <div class="col-12">
                                                              <div class="user-block">
                                                                  <img class="rounded-circle img-bordered-sm"
                                                                      src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$tweet['profile_img'] ;?>"
                                                                      alt="user image">
                                                                  <span class="username">
                                                                      <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $tweet['firstname']." ".$tweet['lastname'] ;?></a>
                                                                      <!-- //Jonathan Burke Jr. -->
                                                                      <span class="description">Public </span>
                                                                  </span>
                                                                  <span class="description"> <?php echo $home->getTweetLink($tweet['status']); ?></span>
                                                              </div>
                                                        </div> <!-- col -->

                                                        <div class="col-12" style="clear:both">
                                     		    	          <!-- STATUS -->
                                                             <span><?php 
                                                             $tatus= $home->getTweetLink($tweet['status']);
                                                             if(!empty($tatus)){
                                                             $post = (strlen($tatus) > 140)? 
                                                                           strtolower(substr($tatus,0,strlen($tatus)-140).' ...
                                                                                <a name="" id="" class="btn btn-primary btn-sm float-right" 
                                                                                href="#" role="button">
                                                                                View More >>></a>
                                                                           '): $tatus;
                                                             echo $post;
                                                            }else{
                                                            
                                                              echo '<div class="text-center p-0 m-0 "><a style="text-decoration:none;color:#333333;" name="" id=""   
                                                                                href="#" role="button"><i class="fa fa-photo" style="font-size:50px;"></i></a></div>';
                                                             } ?>
                                                             </span>
                                                        </div><!-- col -->
                                                        
                                                    </div><!-- row -->
                                                </div><!-- col -->
                                           </div><!-- row -->
                                           
                                            <?php }else { ?>
                                                    <div class="row">
                                                       <div class="col-12">

                                                              <div class="user-block">
                                                                   <img class="rounded-circle img-bordered-sm"
                                                                       src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$tweet['profile_img'] ;?>"
                                                                       alt="user image">
                                                                   <span class="username">
                                                                       <a style="float:left;padding-right:3px;" href="<?php echo PROFILE ;?>"><?php echo $tweet['firstname']." ".$tweet['lastname'] ;?></a>
                                                                       <!-- //Jonathan Burke Jr. -->
                                                                       <span class="description">Shared publicly - <?php echo $users->timeAgo($tweet['posted_on']); ?></span>
                                                                   </span>
                                                                   <span class="description"><?php echo $home->getTweetLink($tweet['status']); ?></span>
                                                               </div>

                                                        </div><!-- col -->
                                                    </div><!-- row -->

                                            <?php } ?>

                                      </div><!-- card-body -->
                                    </div><!-- card -->

                                <?php } else { ?> 

                                    <div class="user-block">
                                        <img class="rounded-circle img-bordered-sm"
                                            src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$tweet['profile_img'] ;?>"
                                            alt="user image">
                                        <span class="username">
                                            <a
                                                href="<?php echo PROFILE ;?>"><?php echo $tweet['firstname']." ".$tweet['lastname'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description">Shared publicly - <?php echo $users->timeAgo($tweet['posted_on']); ?></span>
                                    </div>
                                    <!-- /.user-block -->
                                    <?php 
                                    if (!empty($tweet['tweet_image'])) {
                                        $expode = explode("=",$tweet['tweet_image']);
                                        $count = count($expode); ?>

                                     <?php if ($count === 1) { ?>

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

                                    <?php }else if($count === 3 || $count === 4 || $count === 5){?>
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
                                  <?php   }else if($count === 6 || $count === 7 || $count === 8 ) { ?>

                                    <div class="row mb-2 more">
                                            <?php $expode = explode("=",$tweet['tweet_image']);
                                              $splice= array_splice($expode,0,1);
                                              ?>
                                        <div class="col-sm-6 mb-2">
                                            <img class="img-fluid imagePopup"
                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[0] ;?>"
                                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                        </div>
                                        <!-- /.col -->

                                        <div class="col-sm-6">
                                            <div class="row">
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
                                            <div class="row">
                                                    <?php 
                                                    $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,3,2);
                                                     for ($i=0; $i < count($splice); ++$i) { ?>
                                                <div class="col-sm-6  mb-2">
                                                    <img class="img-fluid imagePopup"
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

                                    <div class="row more ">
                                        <?php 
                                        $expode = explode("=",$tweet['tweet_image']);
                                        $count = count($expode);
                                        if($count == 6){?>
                                           <div class="col-sm-12">
                                               <a name="" id="" class="btn btn-primary btn-sm float-right" href="#" role="button">View More photo >>></a>
                                           </div>
                                        <?php 
                                        }else{
                                           $expode = explode("=",$tweet['tweet_image']);
                                           $count = count($expode);
                                           $splice= array_splice($expode,5,3);
                                           for ($i=0; $i < count($splice); ++$i) { ?>
                                       <div class="col-sm-4">
                                            <img class="img-fluid mb-1 imagePopup"
                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                        </div>

                                           <?php }
                                        }?>
                                    </div>
                                    <!-- /.row -->

                                    <?php }else if($count === 9 || $count === 10 || $count >= 11) {?>
                                         <div class="row mb-1 more">
                                            <?php $expode = explode("=",$tweet['tweet_image']);
                                              $splice= array_splice($expode,0);
                                              ?>
                                        <div class="col-sm-6">
                                            <img class="img-fluid mb-2 imagePopup"
                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[0] ;?>"
                                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                        </div>
                                        <!-- /.col -->

                                        <div class="col-sm-6">
                                            <div class="row">
                                                    <?php 
                                                    $expode = explode("=",$tweet['tweet_image']);
                                                    // var_dump($expode);
                                                    $splice= array_splice($expode,1,2);
                                                    // var_dump($splice);
                                                     for ($i=0; $i < count($splice); ++$i) { ?>
                                                <div class="col-sm-6 mb-2">
                                                    <img class="img-fluid imagePopup"
                                                        src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                        alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                                </div>
                                                    <?php }?>

                                            </div>
                                            <!-- /.row -->
                                            <div class="row">
                                                    <?php 
                                                    $expode = explode("=",$tweet['tweet_image']);
                                                    $splice= array_splice($expode,3,2);
                                                     for ($i=0; $i < count($splice); ++$i) { ?>
                                                <div class="col-sm-6 mb-2">
                                                    <img class="img-fluid imagePopup"
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

                                    <div class="row mb-2">
                                        <?php 
                                        $expode = explode("=",$tweet['tweet_image']);
                                        $splice= array_splice($expode,5,3);
                                         for ($i=0; $i < count($splice); ++$i) { ?>
                                       <div class="col-sm-4 mb-2">
                                            <img class="img-fluid imagePopup"
                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                alt="Photo">
                                        </div>
                                            <?php }?>
                                    </div>
                                    <!-- /.row -->

                                    <div class="row more">
                                        <?php 
                                        $expode = explode("=",$tweet['tweet_image']);
                                        $splice= array_splice($expode,7,3);
                                         for ($i=0; $i < count($splice); ++$i) { ?>
                                       <div class="col-sm-4 mb-2">
                                            <img class="img-fluid imagePopup"
                                                src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>"
                                                alt="Photo"  data-tweet="<?php echo $tweet["tweet_id"] ;?>">
                                        </div>
                                            <?php }?>
                                    </div>
                                    <!-- /.row -->
                                    <div class="row">
                                       <div class="col-sm-12">
                                           <a name="" id="" class="btn btn-primary btn-sm float-right" href="#" role="button">View More photo >>></a>
                                        </div>
                                    </div>
                                    <!-- /.row -->


                                       <?php }
                                     
                                    } ?>
                                   

                                    <p id="link_">
                                        <?php echo $home->getTweetLink($tweet['status']) ;?>
                                    </p>
                                    
                              <?php }?>

                              <ul class="mt-2 list-inline" style="list-style-type: none; margin-bottom:10px;">  
                                        <?php if($tweet['tweet_id'] == $retweet['retweet_id']){ ?>
                                         <li class=" list-inline-item"><button class="share-btn retweeted text-sm mr-2" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                         <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweet["retweet_counts"];?></span></i>
                                            Share</button></li>
                                        <?php }else{ ?>

                                               <li  class=" list-inline-item"> <button class="share-btn retweet text-sm mr-2" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                <?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>';} ?>
                                                   Share</button></li>

                                         <?php } ?>
                                            <?php if($likes['like_on'] == $tweet['tweet_id']){ ?>
                                                <li  class=" list-inline-item"><button class="unlike-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweet_by']; ?>">
                                                <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                                                    Like</button></li>

                                            <?php }else{ ?>
                                                  <li  class=" list-inline-item"> <button class="like-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweet_by']; ?>">
                                                   <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                                                       Like</button></li>
                                            <?php } ?>
                                         <span style="float:right">
                                    
                                          <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#collapseExampl" data-toggle="collapse">
                                              <i class="fa fa-comments-o mr-1"></i> Comments (5)
                                          </button></li>
                                        

                                         <?php if ($tweet["tweetBy"] == $_SESSION['key']){ ?>
                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                       <a href="#" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px;" >
											                <li style="list-style-type: none; margin:0px;"> 
                        					                    <label class="deleteTweet" data-tweet="<?php echo  $tweet["tweet_id"];?>"  data-user="<?php echo $tweet["tweetBy"];?>" >Delete </label>
                                                           </li>
                                                       </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                         <?php }else{ echo '';}?>
                                         </span>
                                </ul>

                                    <div class="card collapse hide" id="collapseExampl">
                                      <div class="card-body">
                                        <!-- Conversations are loaded here -->
                                        <div class="direct-chat-messages">
                                          <!-- Message. Default to the left -->
                                            <div class="direct-chat-msg">
                                                <div class="direct-chat-info clearfix">
                                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                    <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/img/user1-128x128.jpg" alt="message user image">
                                                <!-- /.direct-chat-img -->
                                                <div class="direct-chat-text">
                                                  Is this template really for free? That's unbelievable!
                                                </div>
                                              <!-- /.direct-chat-text -->
                                            </div>
                                            <!-- /.direct-chat-msg -->
                        
                                          <!-- Message to the right -->
                                          <div class="direct-chat-msg right">
                                                <div class="direct-chat-info clearfix">
                                                      <span class="direct-chat-name float-right">Sarah Bullock</span>
                                                      <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                                </div>
                                                <!-- /.direct-chat-info -->
                                                 <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/img/user3-128x128.jpg" alt="message user image">
                                                 <!-- /.direct-chat-img -->
                                                 <div class="direct-chat-text">
                                                   You better believe it!
                                                 </div> <!-- /.direct-chat-text -->
                                           </div> <!-- /.direct-chat-msg -->
                                        </div> <!-- /.direct-chat-message -->
                                      </div> <!-- /.card-body-->
                                    </div> <!-- /.card /collapse -->

                                    <div class="input-group">
                                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                        <div class="input-group-append">
                                            <span class="input-group-text btn" onclick="#" aria-label="Username" aria-describedby="basic-addon1"><span
                                                    class="fa fa-arrow-right text-muted"></span></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.post -->
                                <?php }?>
              