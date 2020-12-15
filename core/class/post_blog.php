  <?php } else if(!empty($tweet['blog_retweet_Msg']) == $tweet["retweet_blog_id"] || $tweet["retweet_blog_id"] > 0 ){ ?> 
                                    
                                    <span class="t-show-banner">
                                          <div class="t-show-banner-inner">
                                              <span><i class="fa fa-retweet "></i></span><span><?php echo $tweet['username'].' Shared';?></span>
                                          </div>
                                    </span>

                                     <div class="user-block">
                                        <div class="user-blockImgBorder">
                                        <div class="user-blockImg" >
                                              <?php if (!empty($tweet['profile_img'])) {?>
                                              <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $tweet['profile_img'] ;?>" alt="User Image">
                                              <?php  }else{ ?>
                                                <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                                              <?php } ?>
                                        </div>
                                        </div>
                                        <span class="username">
                                            <a style="float:left;padding-right:3px;" href="<?php echo BASE_URL_PUBLIC.$tweet['username'] ;?>"><?php echo $tweet['firstname']." ".$tweet['lastname'] ;?></a>
                                            <!-- //Jonathan Burke Jr. -->
                                            <span class="description">Shared public - <?php echo $this->timeAgo($tweet['blog_posted_on']); ?></span>
                                        </span>
                                        <span class="description"><?php echo $this->getTweetLink($tweet['blog_retweet_Msg']); ?></span>
                                    </div>

   <?php 
              $retweets= $this->checkBlogRetweet($tweet['blog_id'],$user_id);
              $likes= $this->Bloglikes($user_id,$tweet['blog_id']);
          ?>

          <div class="card flex-md-row mb-4 border-0 h-md-250" style="box-shadow:0 0 0.5ch 0.5ch rgba(35, 35, 32, 0.15);">
            <img class="card-img-left flex-auto d-none d-lg-block" width="200px" height="250px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/Blog/<?php echo $tweet['photo'] ;?>" alt="Card image cap">
            <div class="card-body d-flex flex-column align-items-start">
              <h4 style="font-family: Playfair Display, Georgia, Times New Roman, serif;text-align:left;">
               <a class="text-primary" href="javascript:void(0)" id="blog-readmore" data-blog="<?php echo $tweet['blog_id'] ;?>"> <?php echo  $tweet['title']; ?></a>
              </h4>
              <div class="mb-1 text-muted">Created on <?php echo $this->timeAgo($tweet['created_on3']) ;?> By <?php echo $tweet['authors'] ;?> </div>
              <p class="mb-auto"> 
                <?php 
                    if (strlen($tweet["text"]) > 200) {
                      echo $tweet["text"] = substr($tweet["text"],0,200).'...<br><span class="mb-0"><a href="javascript:void(0)" id="blog-readmore" data-blog="'.$tweet['blog_id'].'" class="text-muted" style"font-weight: 500 !important;">Continue reading...</a></span>';
                    }else{
                      echo $tweet["text"];
                    } ?> 
              </p>
                  <ul class="list-inline mb-0" style="list-style-type: none;">  

                      <?php if($tweet['blog_id'] == $retweets['retweet_blog_id']){ ?>
                              <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn blog-retweeted0 text-sm mr-2" data-blog="'.$tweet['blog_id'].'"  data-user="'.$tweet['user_id3'].'"'; }else{ echo 'id="login-please" data-login="1"'; } ?>  >
                              <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweets['retweet_counts'] ;?> </span></i></button></li>
                      <?php }else{ ?>
                              <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn blog-retweet0 text-sm mr-2" data-blog="'.$tweet['blog_id'].'"  data-user="'.$tweet['user_id3'].'"'; }else{ echo 'id="login-please"  data-login="1"'; } ?>  >
                              <i class="fa fa-share mr-1" > <span class="retweetcounter">  <?php if ($tweet['retweet_counts'] > 0){ echo $tweet['retweet_counts'];}else{ echo '';} ?></span></i>
                              <!-- < ?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>';} ?> -->
                              </button></li>
                      <?php } ?>

                      <?php if($likes['like_on'] == $tweet['blog_id']){ ?>
                            <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="unlike-blog-btn text-sm  mr-2"'; }else{ echo 'id="login-please"  data-login="1"'; } ?> data-blog="<?php echo $tweet['blog_id']; ?>" data-user="<?php echo $tweet['user_id']; ?>">
                            <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter"><?php echo $tweet['likes_counts'] ;?> </span></i></button></li>
                      <?php }else{ ?>
                            <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="like-blog-btn text-sm  mr-2"'; }else{ echo 'id="login-please" data-login="1"'; } ?> data-blog="<?php echo $tweet['blog_id']; ?>" data-user="<?php echo $tweet['user_id']; ?>">
                            <i class="fa fa-heart-o mr-1" > <span class="likescounter">  <?php if ($tweet['likes_counts'] > 0){ echo $tweet['likes_counts'];}else{ echo '';} ?></span></i></button></li>
                      <?php } ?>

                            <span class='text-right float-right'>
                        
                              <li  class="list-inline-item"><button class="comments-btn text-sm" >
                                  <i class="fa fa-comments-o mr-1"></i> (<?php echo $this->CountBlogComment($tweet['blog_id']); ?>)
                              </button></li>

                         <?php if($user_id == $tweet['user_id3']){ ?>

                                <li  class=" list-inline-item">
                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                        <li>
                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                            <ul style="list-style-type: none; margin:0px;" >
                                                <li style="list-style-type: none; margin:0px;"> 
                                                  <label class="deleteblog"  data-blog="<?php echo $tweet["blog_id"];?>"  data-user="<?php echo $tweet["user_id3"];?>">Delete </label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                         <?php } ?>
                              </span>
                        </ul>
        </div>
        </div>
