<!-- Content Wrapper. Contains page content -->
<div class="container mb-5 mt-3">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i>Profile</i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <li class="breadcrumb-item active"><i> <?php echo $follow->followBtn($user['user_id'],$user_id,$user['user_id']) ;?></i></li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3 mb-3">
                      <!-- hastTag Me Box -->
                       <div class="sticky-top " style="top: 52px;">
                        <div class="card card-primary mb-3">
                            <div class="card-header main-active p-1">
                                <h5 class="card-title text-center"><i> About Me</i></h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fa fa-user mr-1"></i>Company || education</strong>

                                <p class="text-muted">
                                    <?php echo $user['company_education']; ?>
                                </p>

                                <strong><i class="fa fa-user mr-1"></i> type of business</strong>

                                <p class="text-muted">
                                    <?php echo $user['type_of_business']; ?>
                                </p>

                                <strong><i class="fa fa-user mr-1"></i>  Address</strong>

                                <p class="text-muted"> <?php echo $user['address']; ?></p>

                                <strong><i class="fa fa-map-marker mr-1"></i>Location</strong>

                                <p class="text-muted"> <?php echo $user['location']; ?></p>

                                <strong><i class="fa fa-user mr-1"></i> Size of people</strong>

                                <p class="text-muted"> <?php echo $user['size_of_people']; ?></p>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                       <?php echo $trending->trends(); ?>
                        </div>
            </div> <!-- /.col -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header borders-tops p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity"
                                    data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">About Me</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- /.post -->
                                <?php echo $home->getUserTweet($user['user_id'],$user_id) ;?>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                       <!-- timeline time label -->
                                       <li class="time-label">
                                           <span class="bg-danger text-light">
                                               10 Feb. 2014
                                           </span>
                                       </li>
                                       <!-- /.timeline-label -->
                                     <?php 
                              $notif= $notification->notifications($user_id);
                              // var_dump($notif);
                              foreach ($notif as $data): 
                                      if ($data['type'] == 'message'):
                        ?>
                            <li>
                                <i class="fa fa-envelope bg-primary text-light"></i>

                                <div class="timeline-item card shadow-lg">
                                  <div class="card-body">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

                                    <h3 class="timeline-header"><a href="#">Support Team</a> sent you an
                                        email</h3>

                                    <div class="timeline-body">
                                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                        weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                        jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                        quora plaxo ideeli hulu weebly balihoo...
                                    </div>
                                    <div class="timeline-footer">
                                        <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                    </div>
                                  </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                           if ($data['type'] == 'follow'):
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-user bg-info text-light"></i>

                                <div class="timeline-item card shadow-lg">
                                  <div class="card-body">
                                     <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['follow_on']) ;?></span>
                                    <div class="user-block">
                                        <div class="user-blockImgBorder">
                                            <div class="user-blockImg">
                                                 <?php if (!empty($data['profile_img'])) {?>
                                                  <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                  <?php  }else{ ?>
                                                    <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                  <?php } ?>
                                            </div>
                                        </div> 
                                       <span class="username">
                                            <a
                                                href="<?php echo PROFILE ;?>"><?php echo $data['firstname']." ".$data['lastname'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                        </span>
                                        <span class="description"> <h3 >Followed you on <!-- accepted your friend request --> </h3></span>
                                    </div><!-- /.user-block -->
                                   
                                  </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                           if ($data['type'] == 'likes'):
                                $tweet= $data;
                                $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-heart bg-danger text-light"></i>

                                <div class="timeline-item card shadow-lg">
                                    <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a
                                                    href="<?php echo PROFILE ;?>"><?php echo $data['firstname']." ".$data['lastname'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <h3>Likes your Post <!-- accepted your friend request --> </h3></span>
                                        </div><!-- /.user-block -->
                                  </div><!-- /.card-header -->
                                  <div class="card-body">
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
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/mp4"> 
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
                              <?php }?>

                                  <p id="link_">
                                     <?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                                   </p>

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
                                            <li  class="list-inline-item"><button class="unlike-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                            <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                                                Like</button></li>
                                        <?php }else{ ?>
                                                <li  class="list-inline-item"> <button class="like-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                                                    Like</button></li>
                                        <?php } ?>

                                         <span style="float:right">
                                    
                                          <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $tweet["tweet_id"];?>" data-toggle="collapse">
                                              <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)
                                          </button></li>
                                        

                                         <?php if ($tweet["tweetBy"] == $user_id){ ?>
                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                       <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
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

                                <div class="input-group">
                                    <input class="form-control form-control-sm" id="commentHome<?php echo $tweet['tweet_id'];?>" type="text"
                                        name="comment"  placeholder="Reply to  <?php echo $tweet['username'] ;?>" >
                                    <div class="input-group-append">
                                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                                            aria-label="Username" aria-describedby="basic-addon1" id="post_HomeComment"  data-tweet="<?php echo $tweet['tweet_id'];?>">
                                            <span class="fa fa-arrow-right text-muted" ></span>
                                        </span>
                                    </div>
                                </div> <!-- input-group -->

                                   <div class="card collapse hide" id="a<?php echo  $tweet["tweet_id"];?>">
                                      <div class="card-body" style="padding-right:0">
                                        <?php if (!empty($comment)) { ?>
                                        <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)</i></h5>
                                        <span id='responseDeletePostSeconds0'></span>

                                         <div class="direct-chat-message direct-chat-messageS large-2" >
                                         <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">
                                           <?php foreach ($comment as $comments) { 
                                               $second_likes= $Posts_copyDraft->Like_second($user_id,$comments['comment_id']);
                                               $dislikes= $Posts_copyDraft->dislike($user_id,$comments['comment_id']);
                                               ?>
                                                <!-- Conversations are loaded here -->
                                                  <!-- Message. Default to the left -->
                                                    <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                                                        <div class="direct-chat-info clearfix">
                                                            <span class="direct-chat-name float-left"><?php echo $comments["username"] ;?></span>
                                                            <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments['comment_at']); ?></span>
                                                        </div>
                                                        <!-- /.direct-chat-info -->
                                                         <?php if (!empty($comments["profile_img"])) {?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                                         <?php  }else{ ?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                         <?php } ?>
                                                        <!-- /.direct-chat-img -->
                                                        <div class="direct-chat-text">
                                                         <?php echo  $Posts_copyDraft->getTweetLink($comments["comment"]) ;?>
                                                      <!-- /.direct-chat-text -->
                                                      <ul class="list-inline clear-float" style="list-style-type: none; margin-bottom:0;">  
                                                       
                                                        <?php if($second_likes['like_on_'] == $comments['comment_id']) { ?>
                                                                <li  class=" list-inline-item"><button class="unlike-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter_"><?php echo $comments['likes_counts_'];?> </span></i> like</button></li>
                                                        <?php }else{ ?>
                                                                <li  class=" list-inline-item"><button  class="like-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>"  data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-heart-o mr-1" > <span class="likescounter_">  <?php if ($comments['likes_counts_'] > 0){ echo $comments['likes_counts_'];}else{ echo '';} ?></span></i> like</button></li>
                                                        <?php } ?>

                                                        <?php if($dislikes['like_on_'] == $comments['comment_id']){ ?>
                                                            <li  class=" list-inline-item"><button class="undislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                            <i class="fa fa-thumbs-o-down R mr-1" style="color: green"> <span class="dislikescounter"><?php echo $comments['dislikes_counts_'] ;?></span></i>
                                                                unlike</button></li>
                                    
                                                         <?php }else{ ?>
                                                               <li  class=" list-inline-item"> <button class="dislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-thumbs-o-down R mr-1"> <span class="dislikescounter"><?php if ($comments['dislikes_counts_'] > 0){ echo $comments['dislikes_counts_'];}else{ echo '';} ?></span></i>
                                                                    unlike</button></li>
                                                         <?php } ?>
                            
                                                        <span style="float:right">
                                                                              
                                                        <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $comments["comment_id"] ;?>" data-toggle="collapse">
                                                            <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)
                                                        </button></li>
                                                                     
                                                            <?php if ($comments["comment_by"] == $user_id){ ?>
                                                               <li  class=" list-inline-item">
                                                                   <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                       <li>
                                                                          <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                           <ul style="list-style-type: none; margin:0px;" >
					                            	    	                <li style="list-style-type: none; margin:0px;"> 
                                                 	    	                    <label class="deleteCommentPostSeconds0" data-comment="<?php echo  $comments["comment_id"];?>"  data-user="<?php echo $comments["comment_by"];?>" >Delete </label>
                                                                              </li>
                                                                          </ul>
                                                                       </li>
                                                                   </ul>
                                                               </li>
                                                            <?php }else{ echo '';}?>
                                                            </span>
                                                        </ul>
                                                    </div>
                                                    
                                                    <div class="card collapse hide border-bottom-0 ml-5" id="a<?php echo $comments["comment_id"];?>" >
                                                        <div class="card-header pb-0 px-0">
                                                            <div class="input-group">
                                                                <input class="form-control form-control-sm" id="commentHomeSecond<?php echo $comments["comment_id"];?>" type="text"
                                                                    name="comment"  placeholder="Reply to  <?php echo $comments['username'] ;?>" >
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                                        aria-label="Username" aria-describedby="basic-addon1" id="post_HomeCommentSecond"  data-comment="<?php echo $comments['comment_id'];?>">
                                                                        <span class="fa fa-arrow-right text-muted" ></span>
                                                                    </span>
                                                                </div>
                                                            </div> <!-- input-group -->
                                                        </div>
                                                        <div class="card-body" style="padding-right:0">
                                                            <?php 
                                                             $comment_second= $Posts_copyDraft->comments_second($comments['comment_id']);
                                                            if (!empty($comment_second)) { ?>
                                                            <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)</i></h5>
                                                            <span id='responseDeletePostSecond'></span>
                                                            <div class="direct-chat-message direct-chat-messageS large-2" >
                                                            <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">
                                                            <?php foreach ($comment_second as $comments0) { ?>
                                                                    <!-- Conversations are loaded here -->
                                                                    <!-- Message. Default to the left -->
                                                                        <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                                            <div class="direct-chat-info clearfix">
                                                                                <span class="direct-chat-name float-left"><?php echo $comments0["username"] ;?></span>
                                                                                <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments0['comment_at_']); ?></span>
                                                                            </div>
                                                                            <!-- /.direct-chat-info -->
                                                                            <?php if (!empty($comments0["profile_img"])) { ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                                            <?php  }else{ ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                                            <?php } ?>
                                                                            <!-- /.direct-chat-img -->
                                                                            <div class="direct-chat-text">
                                                                                <?php echo  $Posts_copyDraft->getTweetLink($comments0["comment_"]) ;?>
                                                                                 <!-- /.direct-chat-text -->
                                                                                <ul class="list-inline float-right" style="list-style-type: none; margin-bottom:0;">  

                                                                                        <?php if ($comments0["comment_by_"] == $user_id){ ?>
                                                                                        <li  class=" list-inline-item">
                                                                                            <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                                                <li>
                                                                                                    <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                                                    <ul style="list-style-type: none; margin:0px;" >
                                                                                                        <li style="list-style-type: none; margin:0px;"> 
                                                                                                            <label class="deleteCommentPostSecondDelete" data-comment="<?php echo  $comments0["comment_id_"];?>"  data-user="<?php echo $comments0["comment_by_"];?>" >Delete </label>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <?php }else{ echo '';}?>
                                                                                        </span>
                                                                                    </ul>
                                                                            </div>
                                                                        </div> <!-- /.direct-chat-messg -->
                                                                  
                                                                <?php } ?>
                                                            </span>
                                                        </div> <!-- /.direct-chat-message -->
                                                      <?php } ?>

                                                    </div> <!-- /.card-body-->
                                                    </div> <!-- /.card collapse -->
                                                   </div> <!-- /.direct-chat-msg -->
                                          <?php } ?>
                                          </span>
                                      </div> <!-- /.direct-message -->
                                          <?php } ?>
                                      </div> <!-- /.card-body-->
                                    </div> <!-- /.card collapse -->

                            </li>
                            <!-- END timeline item -->
                         <?php  endif; 
      
                              if ($data['type'] == 'retweet'):
                                $tweet=$data;
                                $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-retweet bg-success text-light"></i>

                                <div class="timeline-item card shadow-lg">
                                    <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a href="<?php echo PROFILE ;?>"><?php echo $data['firstname']." ".$data['lastname'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <h3>Shares your Post <!-- accepted your friend request --> </h3></span>
                                        </div><!-- /.user-block -->
                             </div><!-- /.card-header -->

                             <div class="card-body">
                                   
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
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/mp4"> 
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
                              <?php }?>

                                  <p id="link_">
                                     <?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                                   </p>

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
                                            <li  class="list-inline-item"><button class="unlike-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                            <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                                                Like</button></li>
                                        <?php }else{ ?>
                                                <li  class="list-inline-item"> <button class="like-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                                                    Like</button></li>
                                        <?php } ?>

                                         <span style="float:right">
                                    
                                          <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $tweet["tweet_id"];?>" data-toggle="collapse">
                                              <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)
                                          </button></li>
                                        

                                         <?php if ($tweet["tweetBy"] == $user_id){ ?>
                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                       <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
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

                                <div class="input-group">
                                    <input class="form-control form-control-sm" id="commentHome<?php echo $tweet['tweet_id'];?>" type="text"
                                        name="comment"  placeholder="Reply to  <?php echo $tweet['username'] ;?>" >
                                    <div class="input-group-append">
                                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                                            aria-label="Username" aria-describedby="basic-addon1" id="post_HomeComment"  data-tweet="<?php echo $tweet['tweet_id'];?>">
                                            <span class="fa fa-arrow-right text-muted" ></span>
                                        </span>
                                    </div>
                                </div> <!-- input-group -->

                                   <div class="card collapse hide" id="a<?php echo  $tweet["tweet_id"];?>">
                                      <div class="card-body" style="padding-right:0">
                                        <?php if (!empty($comment)) { ?>
                                        <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)</i></h5>
                                        <span id='responseDeletePostSeconds0'></span>

                                         <div class="direct-chat-message direct-chat-messageS large-2" >
                                         <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">
                                           <?php foreach ($comment as $comments) { 
                                               $second_likes= $Posts_copyDraft->Like_second($user_id,$comments['comment_id']);
                                               $dislikes= $Posts_copyDraft->dislike($user_id,$comments['comment_id']);
                                               ?>
                                                <!-- Conversations are loaded here -->
                                                  <!-- Message. Default to the left -->
                                                    <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                                                        <div class="direct-chat-info clearfix">
                                                            <span class="direct-chat-name float-left"><?php echo $comments["username"] ;?></span>
                                                            <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments['comment_at']); ?></span>
                                                        </div>
                                                        <!-- /.direct-chat-info -->
                                                         <?php if (!empty($comments["profile_img"])) {?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                                         <?php  }else{ ?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                         <?php } ?>
                                                        <!-- /.direct-chat-img -->
                                                        <div class="direct-chat-text">
                                                         <?php echo  $Posts_copyDraft->getTweetLink($comments["comment"]) ;?>
                                                      <!-- /.direct-chat-text -->
                                                      <ul class="list-inline clear-float" style="list-style-type: none; margin-bottom:0;">  
                                                       
                                                        <?php if($second_likes['like_on_'] == $comments['comment_id']) { ?>
                                                                <li  class=" list-inline-item"><button class="unlike-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter_"><?php echo $comments['likes_counts_'];?> </span></i> like</button></li>
                                                        <?php }else{ ?>
                                                                <li  class=" list-inline-item"><button  class="like-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>"  data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-heart-o mr-1" > <span class="likescounter_">  <?php if ($comments['likes_counts_'] > 0){ echo $comments['likes_counts_'];}else{ echo '';} ?></span></i> like</button></li>
                                                        <?php } ?>

                                                        <?php if($dislikes['like_on_'] == $comments['comment_id']){ ?>
                                                            <li  class=" list-inline-item"><button class="undislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                            <i class="fa fa-thumbs-o-down R mr-1" style="color: green"> <span class="dislikescounter"><?php echo $comments['dislikes_counts_'] ;?></span></i>
                                                                unlike</button></li>
                                    
                                                         <?php }else{ ?>
                                                               <li  class=" list-inline-item"> <button class="dislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-thumbs-o-down R mr-1"> <span class="dislikescounter"><?php if ($comments['dislikes_counts_'] > 0){ echo $comments['dislikes_counts_'];}else{ echo '';} ?></span></i>
                                                                    unlike</button></li>
                                                         <?php } ?>
                            
                                                        <span style="float:right">
                                                                              
                                                        <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $comments["comment_id"] ;?>" data-toggle="collapse">
                                                            <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)
                                                        </button></li>
                                                                     
                                                            <?php if ($comments["comment_by"] == $user_id){ ?>
                                                               <li  class=" list-inline-item">
                                                                   <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                       <li>
                                                                          <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                           <ul style="list-style-type: none; margin:0px;" >
					                            	    	                <li style="list-style-type: none; margin:0px;"> 
                                                 	    	                    <label class="deleteCommentPostSeconds0" data-comment="<?php echo  $comments["comment_id"];?>"  data-user="<?php echo $comments["comment_by"];?>" >Delete </label>
                                                                              </li>
                                                                          </ul>
                                                                       </li>
                                                                   </ul>
                                                               </li>
                                                            <?php }else{ echo '';}?>
                                                            </span>
                                                        </ul>
                                                    </div>
                                                    
                                                    <div class="card collapse hide border-bottom-0 ml-5" id="a<?php echo $comments["comment_id"];?>" >
                                                        <div class="card-header pb-0 px-0">
                                                            <div class="input-group">
                                                                <input class="form-control form-control-sm" id="commentHomeSecond<?php echo $comments["comment_id"];?>" type="text"
                                                                    name="comment"  placeholder="Reply to  <?php echo $comments['username'] ;?>" >
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                                        aria-label="Username" aria-describedby="basic-addon1" id="post_HomeCommentSecond"  data-comment="<?php echo $comments['comment_id'];?>">
                                                                        <span class="fa fa-arrow-right text-muted" ></span>
                                                                    </span>
                                                                </div>
                                                            </div> <!-- input-group -->
                                                        </div>
                                                        <div class="card-body" style="padding-right:0">
                                                            <?php 
                                                             $comment_second= $Posts_copyDraft->comments_second($comments['comment_id']);
                                                            if (!empty($comment_second)) { ?>
                                                            <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)</i></h5>
                                                            <span id='responseDeletePostSecond'></span>
                                                            <div class="direct-chat-message direct-chat-messageS large-2" >
                                                            <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">
                                                            <?php foreach ($comment_second as $comments0) { ?>
                                                                    <!-- Conversations are loaded here -->
                                                                    <!-- Message. Default to the left -->
                                                                        <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                                            <div class="direct-chat-info clearfix">
                                                                                <span class="direct-chat-name float-left"><?php echo $comments0["username"] ;?></span>
                                                                                <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments0['comment_at_']); ?></span>
                                                                            </div>
                                                                            <!-- /.direct-chat-info -->
                                                                            <?php if (!empty($comments0["profile_img"])) { ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                                            <?php  }else{ ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                                            <?php } ?>
                                                                            <!-- /.direct-chat-img -->
                                                                            <div class="direct-chat-text">
                                                                                <?php echo  $Posts_copyDraft->getTweetLink($comments0["comment_"]) ;?>
                                                                                 <!-- /.direct-chat-text -->
                                                                                <ul class="list-inline float-right" style="list-style-type: none; margin-bottom:0;">  

                                                                                        <?php if ($comments0["comment_by_"] == $user_id){ ?>
                                                                                        <li  class=" list-inline-item">
                                                                                            <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                                                <li>
                                                                                                    <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                                                    <ul style="list-style-type: none; margin:0px;" >
                                                                                                        <li style="list-style-type: none; margin:0px;"> 
                                                                                                            <label class="deleteCommentPostSecondDelete" data-comment="<?php echo  $comments0["comment_id_"];?>"  data-user="<?php echo $comments0["comment_by_"];?>" >Delete </label>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <?php }else{ echo '';}?>
                                                                                        </span>
                                                                                    </ul>
                                                                            </div>
                                                                        </div> <!-- /.direct-chat-messg -->
                                                                  
                                                                <?php } ?>
                                                            </span>
                                                        </div> <!-- /.direct-chat-message -->
                                                      <?php } ?>

                                                    </div> <!-- /.card-body-->
                                                    </div> <!-- /.card collapse -->
                                                   </div> <!-- /.direct-chat-msg -->
                                          <?php } ?>
                                          </span>
                                      </div> <!-- /.direct-message -->
                                          <?php } ?>
                                      </div> <!-- /.card-body-->
                                    </div> <!-- /.card collapse -->

                                </div>
                                </div>
                            </li>

                            <!-- END timeline item -->
                         <?php  endif; 
      
                              if ($data['type'] == 'mention'):
                                    $tweet= $data;
                                    $likes= $Posts_copyDraft->likes($user_id,$tweet['tweet_id']);
                                    $retweet= $Posts_copyDraft->checkRetweet($tweet['tweet_id'],$user_id);
                                    $user= $Posts_copyDraft->userData($retweet['retweet_by']);
                                    $comment= $Posts_copyDraft->comments($tweet['tweet_id']);
                          ?>
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-at bg-purple text-dark "></i>
                                <!-- <i class="fa fa-at bg-warning text-light">@</i> -->
                              <div class="timeline-item card shadow-lg">
                                <div class="card-header ">
                                        <span class="time float-right mt-3"><i class=" fa fa-clock-o"></i> <?php echo $users->timeAgo($data['posted_on']) ;?></span>
                                        <div class="user-block">
                                            <div class="user-blockImgBorder">
                                                <div class="user-blockImg">
                                                     <?php if (!empty($data['profile_img'])) {?>
                                                      <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $data['profile_img'] ;?>" alt="User Image">
                                                      <?php  }else{ ?>
                                                        <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                                      <?php } ?>
                                                </div>
                                            </div> 
                                           <span class="username">
                                                <a
                                                    href="<?php echo PROFILE ;?>"><?php echo $data['firstname']." ".$data['lastname'] ;?></a>
                                                <!-- //Jonathan Burke Jr. -->
                                            </span>
                                            <span class="description"> <h3>Mention Your name <!-- accepted your friend request --> </h3></span>
                                        </div><!-- /.user-block -->
                                  </div><!-- /.card-header -->
                                  <div class="card-body">
                                   
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
                                        <source src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$tweet['tweet_image'] ;?>" type="video/mp4"> 
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
                              <?php }?>

                                  <p id="link_">
                                     <?php echo $Posts_copyDraft->getTweetLink($tweet['status']) ;?>
                                   </p>

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
                                            <li  class="list-inline-item"><button class="unlike-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                            <i class="fa fa-thumbs-up mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?></span></i>
                                                Like</button></li>
                                        <?php }else{ ?>
                                                <li  class="list-inline-item"> <button class="like-btn text-sm" data-tweet="<?php echo $tweet['tweet_id']; ?>"  data-user="<?php echo $tweet['tweetBy']; ?>">
                                                <i class="fa fa-thumbs-o-up mr-1"> <span class="likescounter"><?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i>
                                                    Like</button></li>
                                        <?php } ?>

                                         <span style="float:right">
                                    
                                          <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $tweet["tweet_id"];?>" data-toggle="collapse">
                                              <i class="fa fa-comments-o mr-1"></i> Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)
                                          </button></li>
                                        

                                         <?php if ($tweet["tweetBy"] == $user_id){ ?>
                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                       <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
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

                                <div class="input-group">
                                    <input class="form-control form-control-sm" id="commentHome<?php echo $tweet['tweet_id'];?>" type="text"
                                        name="comment"  placeholder="Reply to  <?php echo $tweet['username'] ;?>" >
                                    <div class="input-group-append">
                                        <span class="input-group-text btn" style="padding: 0px 10px;" 
                                            aria-label="Username" aria-describedby="basic-addon1" id="post_HomeComment"  data-tweet="<?php echo $tweet['tweet_id'];?>">
                                            <span class="fa fa-arrow-right text-muted" ></span>
                                        </span>
                                    </div>
                                </div> <!-- input-group -->

                                   <div class="card collapse hide" id="a<?php echo  $tweet["tweet_id"];?>">
                                      <div class="card-body" style="padding-right:0">
                                        <?php if (!empty($comment)) { ?>
                                        <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment($tweet["tweet_id"]); ?>)</i></h5>
                                        <span id='responseDeletePostSeconds0'></span>

                                         <div class="direct-chat-message direct-chat-messageS large-2" >
                                         <span class="commentsHome" id="commentsHome<?php echo $tweet['tweet_id'];?>">
                                           <?php foreach ($comment as $comments) { 
                                               $second_likes= $Posts_copyDraft->Like_second($user_id,$comments['comment_id']);
                                               $dislikes= $Posts_copyDraft->dislike($user_id,$comments['comment_id']);
                                               ?>
                                                <!-- Conversations are loaded here -->
                                                  <!-- Message. Default to the left -->
                                                    <div class="direct-chat-msg" id="userComment0<?php echo $comments['comment_id']; ?>">
                                                        <div class="direct-chat-info clearfix">
                                                            <span class="direct-chat-name float-left"><?php echo $comments["username"] ;?></span>
                                                            <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments['comment_at']); ?></span>
                                                        </div>
                                                        <!-- /.direct-chat-info -->
                                                         <?php if (!empty($comments["profile_img"])) {?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments["profile_img"] ;?>" alt="message user image">
                                                         <?php  }else{ ?>
                                                          <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                         <?php } ?>
                                                        <!-- /.direct-chat-img -->
                                                        <div class="direct-chat-text">
                                                         <?php echo  $Posts_copyDraft->getTweetLink($comments["comment"]) ;?>
                                                      <!-- /.direct-chat-text -->
                                                      <ul class="list-inline clear-float" style="list-style-type: none; margin-bottom:0;">  
                                                       
                                                        <?php if($second_likes['like_on_'] == $comments['comment_id']) { ?>
                                                                <li  class=" list-inline-item"><button class="unlike-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter_"><?php echo $comments['likes_counts_'];?> </span></i> like</button></li>
                                                        <?php }else{ ?>
                                                                <li  class=" list-inline-item"><button  class="like-second-btn text-sm" data-comment="<?php echo $comments['comment_id']; ?>"  data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-heart-o mr-1" > <span class="likescounter_">  <?php if ($comments['likes_counts_'] > 0){ echo $comments['likes_counts_'];}else{ echo '';} ?></span></i> like</button></li>
                                                        <?php } ?>

                                                        <?php if($dislikes['like_on_'] == $comments['comment_id']){ ?>
                                                            <li  class=" list-inline-item"><button class="undislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                            <i class="fa fa-thumbs-o-down R mr-1" style="color: green"> <span class="dislikescounter"><?php echo $comments['dislikes_counts_'] ;?></span></i>
                                                                unlike</button></li>
                                    
                                                         <?php }else{ ?>
                                                               <li  class=" list-inline-item"> <button class="dislike-btn text-sm"  data-comment="<?php echo $comments['comment_id']; ?>" data-user="<?php echo $comments['comment_by']; ?>" >
                                                                <i class="fa fa-thumbs-o-down R mr-1"> <span class="dislikescounter"><?php if ($comments['dislikes_counts_'] > 0){ echo $comments['dislikes_counts_'];}else{ echo '';} ?></span></i>
                                                                    unlike</button></li>
                                                         <?php } ?>
                            
                                                        <span style="float:right">
                                                                              
                                                        <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#a<?php echo  $comments["comment_id"] ;?>" data-toggle="collapse">
                                                            <i class="fa fa-comments-o mr-1"></i> Comments  (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)
                                                        </button></li>
                                                                     
                                                            <?php if ($comments["comment_by"] == $user_id){ ?>
                                                               <li  class=" list-inline-item">
                                                                   <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                       <li>
                                                                          <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                           <ul style="list-style-type: none; margin:0px;" >
					                            	    	                <li style="list-style-type: none; margin:0px;"> 
                                                 	    	                    <label class="deleteCommentPostSeconds0" data-comment="<?php echo  $comments["comment_id"];?>"  data-user="<?php echo $comments["comment_by"];?>" >Delete </label>
                                                                              </li>
                                                                          </ul>
                                                                       </li>
                                                                   </ul>
                                                               </li>
                                                            <?php }else{ echo '';}?>
                                                            </span>
                                                        </ul>
                                                    </div>
                                                    
                                                    <div class="card collapse hide border-bottom-0 ml-5" id="a<?php echo $comments["comment_id"];?>" >
                                                        <div class="card-header pb-0 px-0">
                                                            <div class="input-group">
                                                                <input class="form-control form-control-sm" id="commentHomeSecond<?php echo $comments["comment_id"];?>" type="text"
                                                                    name="comment"  placeholder="Reply to  <?php echo $comments['username'] ;?>" >
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text btn" style="padding: 0px 10px;" 
                                                                        aria-label="Username" aria-describedby="basic-addon1" id="post_HomeCommentSecond"  data-comment="<?php echo $comments['comment_id'];?>">
                                                                        <span class="fa fa-arrow-right text-muted" ></span>
                                                                    </span>
                                                                </div>
                                                            </div> <!-- input-group -->
                                                        </div>
                                                        <div class="card-body" style="padding-right:0">
                                                            <?php 
                                                             $comment_second= $Posts_copyDraft->comments_second($comments['comment_id']);
                                                            if (!empty($comment_second)) { ?>
                                                            <h5><i>Comments (<?php echo $Posts_copyDraft->CountsComment_second($comments["comment_id"]); ?>)</i></h5>
                                                            <span id='responseDeletePostSecond'></span>
                                                            <div class="direct-chat-message direct-chat-messageS large-2" >
                                                            <span class="commentsHome" id="commentsHomeSecond<?php echo $comments['comment_id'];?>">
                                                            <?php foreach ($comment_second as $comments0) { ?>
                                                                    <!-- Conversations are loaded here -->
                                                                    <!-- Message. Default to the left -->
                                                                        <div class="direct-chat-msg" id="userComment<?php echo $comments0["comment_id_"]; ?>" >
                                                                            <div class="direct-chat-info clearfix">
                                                                                <span class="direct-chat-name float-left"><?php echo $comments0["username"] ;?></span>
                                                                                <span class="direct-chat-timestamp float-right"><?php echo $Posts_copyDraft->timeAgo($comments0['comment_at_']); ?></span>
                                                                            </div>
                                                                            <!-- /.direct-chat-info -->
                                                                            <?php if (!empty($comments0["profile_img"])) { ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $comments0["profile_img"] ;?>" alt="message user image">
                                                                            <?php  }else{ ?>
                                                                            <img class="direct-chat-img" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="message user image">
                                                                            <?php } ?>
                                                                            <!-- /.direct-chat-img -->
                                                                            <div class="direct-chat-text">
                                                                                <?php echo  $Posts_copyDraft->getTweetLink($comments0["comment_"]) ;?>
                                                                                 <!-- /.direct-chat-text -->
                                                                                <ul class="list-inline float-right" style="list-style-type: none; margin-bottom:0;">  

                                                                                        <?php if ($comments0["comment_by_"] == $user_id){ ?>
                                                                                        <li  class=" list-inline-item">
                                                                                            <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                                                                <li>
                                                                                                    <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                                                                    <ul style="list-style-type: none; margin:0px;" >
                                                                                                        <li style="list-style-type: none; margin:0px;"> 
                                                                                                            <label class="deleteCommentPostSecondDelete" data-comment="<?php echo  $comments0["comment_id_"];?>"  data-user="<?php echo $comments0["comment_by_"];?>" >Delete </label>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <?php }else{ echo '';}?>
                                                                                        </span>
                                                                                    </ul>
                                                                            </div>
                                                                        </div> <!-- /.direct-chat-messg -->
                                                                  
                                                                <?php } ?>
                                                            </span>
                                                        </div> <!-- /.direct-chat-message -->
                                                      <?php } ?>

                                                    </div> <!-- /.card-body-->
                                                    </div> <!-- /.card collapse -->
                                                   </div> <!-- /.direct-chat-msg -->
                                          <?php } ?>
                                          </span>
                                      </div> <!-- /.direct-message -->
                                          <?php } ?>
                                      </div> <!-- /.card-body-->
                                    </div> <!-- /.card collapse -->
                               
                            </li>
                            <!-- END timeline item -->
                        <?php  endif; 
      
                              if ($data['type'] == 'tweets_photo'):
                          ?>
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-success text-light">
                                    3 Jan. 2014
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-camera text-light" style="background-color:#6f42c1"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o text-light"></i> 2 days
                                        ago</span>

                                    <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                    </h3>

                                    <div class="timeline-body">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                        <img src="<?php echo BASE_URL_LINK ;?>image/img/user4-128x128.jpg" alt="..."
                                            class="margin">
                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <?php    endif; 
                             endforeach; ?>
                            <li >
                                <i class="fa fa-clock-o bg-info text-light"></i>
                            </li>
                        </ul>
                            </div> <!-- /.tab-pane -->
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                              <span id="responsesCOMP"></span>
                                <form class="form-horizontal" >
                                    <input type="hidden" class="form-control" value="<?php echo $user['user_id'];?>" id="company_id" style="display:none">
                                    <div class="form-group">
                                      <label class="control-label" for="">Company || education</label>
                                       <div class="col-sm-10">
                                         <select class="form-control" id="company_education" name="Company_education" >
                                               <?php if(!empty($user['company_education'])){?>
                                                <option > <?php echo $user['company_education'];?></option>
                                             <?php }else{?>
                                                <option >choose... </option>
                                             <?php }?>
                                           <option value="company">Company</option>
                                           <option value="Public">Public</option>
                                           <option value="Private">Private</option>
                                           <option value="education">Education</option>
                                         </select>
                                      </div>
                                    </div>

                                     <div class="form-group">
                                      <label class="control-label" for="">type of business</label>
                                       <div class="col-sm-10">
                                         <select class="form-control" name="type_of_business" id="type_of_business">
                                             <?php if(!empty($user['type_of_business'])){?>
                                                <option > <?php echo $user['type_of_business'];?></option>
                                             <?php }else{?>
                                                <option >choose... </option>
                                             <?php }?>
                                           <option value="architecture">architecture</option>
                                           <option value="electrical">engineer</option>
                                           <option value="sale">sale</option>
                                           <option value="Buyer">Buyer</option>
                                           <option value="builder">builder</option>
                                           <option value="cleaners">cleaners</option>
                                           <option value="Commission">Commission</option>
                                           <option value="Hotel">Hotel</option>
                                         </select>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputName" class="control-label">Address</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="address" placeholder="Address" value="<?php echo $user['address'] ;?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputEmail" class="control-label">Location</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="location" placeholder="Location" value="<?php echo $user['location']; ?>">
                                        </div>
                                    </div>

                                     <div class="form-group">
                                      <label class="control-label" for="">Size of people</label>
                                       <div class="col-sm-10">
                                         <select class="form-control" name="size_of_people" id="size_of_people">
                                             <?php if(!empty($user['size_of_people'])){?>
                                                <option > <?php echo $user['size_of_people'];?></option>
                                             <?php }else{?>
                                                <option >choose... </option>
                                             <?php }?>
                                           <option value="5">5</option>
                                           <option value="10">10</option>
                                           <option value="20">20</option>
                                           <option value="50">50</option>
                                           <option value="100">100</option>
                                           <option value="150">150</option>
                                           <option value="200">200</option>
                                           <option value="250">250</option>
                                           <option value="300">300</option>
                                           <option value="350">350</option>
                                           <option value="500">500</option>
                                           <option value="800">800</option>
                                           <option value="1000">1000</option>
                                         </select>
                                      </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="button" onclick="company('organization');" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                            
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
            
            <div class="col-md-3">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <!-- whoTofollow: user whoTofollow style 1 -->
                        <?php $follow->whoTofollow($user['user_id'],$user['user_id'])?>
                    </div>
                    <!-- /. col -->

                </div>
                <!-- /.row -->
                 <div class="sticky-top " style="top: 52px;">
                        <!-- hastTag Me Box -->
                         <!-- jobs -->
                         <?php echo $home->jobsfetch() ;?>
                         <!-- jobs -->
                </div>
            </div>
            <!-- /.col-md-3 -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- container -->

          