<?php ?>
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
                                              <ul class="mt-3 list-inline" style="list-style-type: none; margin-bottom:10px;">  
                                     
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
                                                 
                                                       <li  class=" list-inline-item"><button class="comments-btn text-sm" data-target="#ab<?php echo  $tweet["tweet_id"];?>" data-toggle="collapse">
                                                           <i class="fa fa-comments-o mr-1"></i> Comments (5)
                                                       </button></li>
                                        

                                                        <?php if ($tweet["tweetBy"] == $user_id){ ?>
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
                                                 <div class="card collapse hide border-bottom-0" id="ab<?php echo  $tweet["tweet_id"];?>">
                                                     <div class="card-body">
                                                       <!-- Conversations are loaded here -->
                                                       <div class="direct-chat-message">
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
                                                               </div> <!-- /.direct-chat-text -->
                                                            </div> <!-- /.direct-chat-msg -->
                                                        </div> <!-- /.direct-chat-message -->
                                                     </div> <!-- /.card-body-->
                                                     <div class="card-footer p-0 border-top-0 border-bottom-0">
                                                        <div class="input-group">
                                                             <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                                             <div class="input-group-append">
                                                                 <span class="input-group-text btn" onclick="#" aria-label="Username" aria-describedby="basic-addon1"><span
                                                                         class="fa fa-arrow-right text-muted"></span></span>
                                                             </div>
                                                         </div>
                                                     </div>
                                                   </div> <!-- /.card collapse -->
                                             </div> <!-- /.direct-chat-msg -->

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