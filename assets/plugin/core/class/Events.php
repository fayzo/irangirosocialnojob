<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Events extends Home{

    public function eventsList($pages,$categories,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*8)-8;
        }
        $mysqli= $this->database;
         $query= $mysqli->query("SELECT * FROM events LEFT JOIN users ON user_id= user_id3 WHERE categories_events ='$categories' AND events_post != 'posted' ORDER BY created_on3 Desc Limit $showpages,8");
        ?>
          <div class="row">
           <?php while($row= $query->fetch_array()){ 
             
              $retweet= $this->checkEventsRetweet($row['events_id'],$user_id);
              $likes= $this->Eventslikes($user_id,$row['events_id']);
             ?>

        <div class="col-md-6">
          <div class="card flex-md-row mb-4 border-0 h-md-250" style="box-shadow:0 0 0.5ch 0.5ch rgba(35, 35, 32, 0.15);">
            <img class="card-img-left flex-auto d-none d-lg-block" width="200px" height="250px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/events/<?php echo $row['photo'] ;?>" alt="Card image cap">
            <div class="card-body d-flex flex-column align-items-start">
              <h4 style="font-family: Playfair Display, Georgia, Times New Roman, serif;text-align:left;">
               <a class="text-primary text-left" href="javascript:void(0)" id="events-readmore" data-events="<?php echo $row['events_id'] ;?>">
                <?php 
                    if (strlen($row["title"]) > 36) {
                      echo $row["title"] = substr($row["title"],0,36).'... ';
                    }else{
                      echo $row["title"];
                    } ?></a>
              </h4>
              <div class="mb-1 text-muted">Created on <?php echo $this->timeAgo($row['created_on3']) ;?> By <?php echo $row['authors'] ;?> </div>
              <p class="mb-auto"> 
                <?php 
                    if (strlen($row["additioninformation"]) > 113) {
                      echo $row["additioninformation"] = substr($row["additioninformation"],0,113).'... <span class="mb-0"><a href="javascript:void(0)" id="events-readmore" data-events="'.$row['events_id'].'" class="text-muted" style"font-weight: 500 !important;">Continue reading >>> </a></span>';
                    }else{
                      echo $row["additioninformation"];
                    } ?> 
              </p>

                <div class="black-bg" style="padding:4px;border-radius:3px">
                     <div>Avenue: <?php echo $row['location_events']; ?> at <?php echo $row['name_place']; ?> </div>
                     <div>start events: <?php echo $row['start_events']; ?> / <?php echo $row['date0']; ?></div>
                     <div>Posted on <?php echo $row['created_on3']; ?> </div>
                </div>
                  <ul class="list-inline mb-0" style="list-style-type: none;">  

                      <?php if($row['events_id'] == $retweet['retweet_events_id']){ ?>
                              <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn events-retweeted0 text-sm mr-2" data-events="'.$row['events_id'].'"  data-user="'.$row['user_id3'].'"'; }else{ echo 'id="login-please" data-login="1"'; } ?>  >
                              <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweet['retweet_counts'] ;?> </span></i></button></li>
                      <?php }else{ ?>
                              <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn events-retweet0 text-sm mr-2" data-events="'.$row['events_id'].'"  data-user="'.$row['user_id3'].'"'; }else{ echo 'id="login-please"  data-login="1"'; } ?>  >
                              <i class="fa fa-share mr-1" > <span class="retweetcounter">  <?php if ($row['retweet_counts'] > 0){ echo $row['retweet_counts'];}else{ echo '';} ?></span></i>
                              <!-- < ?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>';} ?> -->
                              </button></li>
                      <?php } ?>

                      <?php if($likes['like_on'] == $row['events_id']){ ?>
                            <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="unlike-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please"  data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                            <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter"><?php echo $row['likes_counts'] ;?> </span></i></button></li>
                      <?php }else{ ?>
                            <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="like-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please" data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                            <i class="fa fa-heart-o mr-1" > <span class="likescounter">  <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span></i></button></li>
                      <?php } ?>

                            <span class='text-right float-right'>
                        
                              <li  class="list-inline-item"><button class="comments-btn text-sm" >
                                  <i class="fa fa-comments-o mr-1"></i> (5)
                              </button></li>

                         <?php if($user_id == $row['user_id3']){ ?>

                                <li  class=" list-inline-item">
                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                        <li>
                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                            <ul style="list-style-type: none; margin:0px;" >
                                                <li style="list-style-type: none; margin:0px;"> 
                                                  <label class="deleteEvents"  data-events="<?php echo $row["events_id"];?>"  data-user="<?php echo $row["user_id3"];?>">Delete </label>
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
        </div>
            <?php   } 

        $query1= $mysqli->query("SELECT COUNT(*) FROM events WHERE categories_events ='$categories' ORDER BY created_on3 Desc ");
        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/8;
        $post_Perpage = ceil($post_Perpages); ?>

        </div> <!-- row -->

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="events_FecthRequest('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
     
        <?php } 

    }

    public function Recent_Events($categories,$user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM events E Left JOIN users U ON U. user_id = E. user_id3 WHERE E. categories_events ='$categories' AND E. created_on3  > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND E. events_post != 'posted' ORDER BY E. created_on3 Desc , rand() Limit 5");
            //  SECOND	, MINUTE, HOUR, DAY, WEEK	, MONTH	, QUARTER	, YEAR,
        if($query->num_rows != 0){
        ?>
       <div class="card d-none d-lg-block">
        <div class="card-header main-active">
          <h5>Recent Events</h5>
        </div>
        <div class="card-body px-2">
            <div class="row">
        <?php while($row= $query->fetch_array()) {  
              $retweet= $this->checkEventsRetweet($row['events_id'],$user_id);
              $likes= $this->Eventslikes($user_id,$row['events_id']);
          ?>

              <div class="col-md-12 mb-2">
                <div class="card flex-md-row shadow-sm h-md-100 border-0">
                  <img class="card-img-left flex-auto d-none d-lg-block" height="130px" width="100px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/events/<?php echo $row['photo'] ;?>" alt="Card image cap">
                  <div class="card-body d-flex flex-column align-items-start pt-0">
                    <h5 class="text-primary mb-0">
                   <a class="text-primary" href="javascript:void(0)" id="events-readmore" data-events="<?php echo $row['events_id']; ?> ">
                    <?php 
                    if (strlen($row["title"]) > 73) {
                      echo $row["title"] = substr($row["text"],0,73).'... ';
                    }else{
                      echo $row["title"];
                    } ?></a>
                    </h5>
                    <div class="text-muted">Created on <?php echo $this->timeAgo($row['created_on3']) ;?> By <?php echo $row['authors'] ;?> </div>
                    <p class="card-text mb-1">
                         <?php 
                             if (strlen($row["additioninformation"]) > 60) {
                              echo $row["additioninformation"] = substr($row["additioninformation"],0,60).'... <span class="mb-0"><a href="javascript:void(0)" id="events-readmore" data-events="'.$row['events_id'].'" class="text-muted" style"font-weight: 500!important;">Continue reading...</a></span>';
                            }else{
                              echo $row["additioninformation"];
                            } ?> 
                    </p>

                    <div class="black-bg" style="padding:4px;border-radius:3px">
                        <div>Avenue: <?php echo $row['location_events']; ?> at <?php echo $row['name_place']; ?> </div>
                        <div>start events: <?php echo $row['start_events']; ?> / <?php echo $row['date0']; ?></div>
                        <div>Posted on <?php echo $row['created_on3']; ?> </div>
                    </div>

                    <ul class="list-inline mb-0" style="list-style-type: none;">  

                      <?php if($row['events_id'] == $retweet['retweet_events_id']){ ?>
                              <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn events-retweeted0 text-sm mr-2" data-events="'.$row['events_id'].'"  data-user="'.$row['user_id3'].'"'; }else{ echo 'id="login-please" data-login="1"'; } ?>  >
                              <i class="fa fa-share green mr-1" style="color: green"> <span class="retweetcounter"><?php echo $retweet['retweet_counts'] ;?> </span></i></button></li>
                      <?php }else{ ?>
                              <li class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="share-btn events-retweet0 text-sm mr-2" data-events="'.$row['events_id'].'"  data-user="'.$row['user_id3'].'"'; }else{ echo 'id="login-please"  data-login="1"'; } ?>  >
                              <i class="fa fa-share mr-1" > <span class="retweetcounter">  <?php if ($row['retweet_counts'] > 0){ echo $row['retweet_counts'];}else{ echo '';} ?></span></i>
                              <!-- < ?php if($retweet["retweet_counts"] > 0){ echo '<i class="fa fa-share mr-1" style="color: green"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>' ; }else{ echo '<i class="fa fa-share mr-1"> <span class="retweetcounter">'.$retweet["retweet_counts"].'</span></i>';} ?> -->
                              </button></li>
                      <?php } ?>

                      <?php if($likes['like_on'] == $row['events_id']){ ?>
                            <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="unlike-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please"  data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                            <i class="fa fa-heart-o mr-1" style="color: red"> <span class="likescounter"><?php echo $row['likes_counts'] ;?> </span></i></button></li>
                      <?php }else{ ?>
                            <li  class=" list-inline-item"><button <?php if(isset($_SESSION['key'])){ echo 'class="like-events-btn text-sm  mr-2"'; }else{ echo 'id="login-please" data-login="1"'; } ?> data-events="<?php echo $row['events_id']; ?>" data-user="<?php echo $row['user_id']; ?>">
                            <i class="fa fa-heart-o mr-1" > <span class="likescounter">  <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span></i></button></li>
                      <?php } ?>

                            <span class='text-right float-right'>
                        
                              <li  class="list-inline-item"><button class="comments-btn text-sm" >
                                  <i class="fa fa-comments-o mr-1"></i> (5)
                              </button></li>

                         <?php if($user_id == $row['user_id3']){ ?>

                                <li  class=" list-inline-item">
                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                        <li>
                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                            <ul style="list-style-type: none; margin:0px;" >
                                                <li style="list-style-type: none; margin:0px;"> 
                                                  <label class="deleteEvents"  data-events="<?php echo $row["events_id"];?>"  data-user="<?php echo $row["user_id3"];?>">Delete </label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                         <?php } ?>
                              </span>
                        </ul>

                  </div><!-- card-body -->
                </div><!-- card -->
              </div> <!-- col -->

      <?php } ?>

            </div> <!-- row -->
        </div> <!-- card-body -->
      </div> <!-- card -->
      <?php }else{ ?>
         <div class="row text-center">
          <div class="col-md-6 mr-0 d-none d-md-block">
              <div class="card">
                <div class="card-header main-active">
                  <h5>Categories</h5>
                </div>
                <div class="card-body pb-0 px-0">
                  <div class="list-group sticky-top pt-0 px-0" id="list-tab" role="tablist"  style="top: 52px;">
                    <a class="list-group-item list-group-item-action" id="list-Technology-list" data-toggle="tab" href="#list-Technology" role="tab" aria-controls="list-Technology">Technology</a>
                    <a class="list-group-item list-group-item-action active" id="list-Design-list" data-toggle="tab" href="#list-Design" role="tab" aria-controls="list-Design">Design</a>
                    <a class="list-group-item list-group-item-action" id="list-Culture-list" data-toggle="tab" href="#list-Culture" role="tab" aria-controls="list-Culture">Culture</a>
                    <a class="list-group-item list-group-item-action" id="list-Business-list" data-toggle="tab" href="#list-Business" role="tab" aria-controls="list-Business">Business</a>
                    <a class="list-group-item list-group-item-action" id="list-Politics-list" data-toggle="tab" href="#list-Politics" role="tab" aria-controls="list-Politics">Politics</a>
                    <a class="list-group-item list-group-item-action" id="list-Opinion-list" data-toggle="tab" href="#list-Opinion" role="tab" aria-controls="list-Opinion">Opinion</a>
                    <a class="list-group-item list-group-item-action" id="list-Health-list" data-toggle="tab" href="#list-Health" role="tab" aria-controls="list-Health">Health</a>
                    <a class="list-group-item list-group-item-action" id="list-Style-list" data-toggle="tab" href="#list-Style" role="tab" aria-controls="list-Style">Style</a>
                    <a class="list-group-item list-group-item-action" id="list-Travel-list" data-toggle="tab" href="#list-Travel" role="tab" aria-controls="list-Travel">Travel</a>
                    <a class="list-group-item list-group-item-action" id="list-History-list" data-toggle="tab" href="#list-History" role="tab" aria-controls="list-History">History</a>
                    <a class="list-group-item list-group-item-action" id="list-Science-list" data-toggle="tab" href="#list-Science" role="tab" aria-controls="list-Science">Science</a>
                    <a class="list-group-item list-group-item-action" id="list-Science-list" data-toggle="tab"  href="#list-Computer_science" role="tab" aria-controls="list-Computer_science">Computer science</a>
                    <button type="button" class="btn btn-light mt-2" id="add_events" data-events="<?php echo $_SESSION['key']; ?>" > + Add events </button>
                  </div>
                </div> <!-- card-body -->
              </div> <!-- card --> 
          </div> <!-- col -->
          <div class="col-md-6 ml-0 d-none d-md-block">
              <?php echo $this->options(); ?>
          </div> <!-- col -->
        </div> <!-- row -->

      <?php } 

     } 

    public function EventsReadmore($events_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN events B ON B. user_id3 = u. user_id WHERE B. events_id = '$events_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function Events_comments($tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM events_comment LEFT JOIN users ON comment_by=user_id LEFT JOIN events ON comment_on=events_id  WHERE comment_on = $tweet_id ORDER BY comment_at DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

    public function getPopupEventsTweet($user_id,$events_id,$events_by)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN events B ON B. user_id3 = u. user_id Left JOIN events_like L ON L. like_on = B. events_id Left JOIN events_comment C ON C. comment_on = B. events_id WHERE B. user_id3 =$events_by AND B. events_id = $events_id ");
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      public function Eventsretweet($retweet_id,$user_id,$tweet_by,$comments)
    {
        $mysqli= $this->database;
        $stmt = $mysqli->stmt_init();
        $query= "UPDATE events SET retweet_counts = retweet_counts +1  WHERE events_id= ? ";
        $stmt->prepare($query);
        $stmt->bind_param('i',$retweet_id);
        $stmt->execute();
        
        $query= "INSERT INTO events (retweet_events_id,tweet_events_by,country,title,authors,photo_Title,province,districts,sector,cell,village,name_place,location_events,start_events,date0,categories_events,additioninformation,photo,video,youtube,likes_counts,user_id3,retweet_counts,events_posted_on,events_retweet_Msg,events_post,created_on3)
        SELECT ?,?,country,title,authors,photo_Title,province,districts,sector,cell,village,name_place,location_events,start_events,date0,categories_events,additioninformation,photo,video,youtube,likes_counts,user_id3,retweet_counts, ?, ?,?,created_on3 FROM events WHERE events_id= ? ";

        $stmt->prepare($query);
        $time = date('Y-m-d H-i-s');
        $post = 'posted';
        $stmt->bind_param('iisssi', $retweet_id, $user_id,$time,$comments,$post,$retweet_id);
        $stmt->execute();  
        $query= "DELETE FROM events WHERE events_id= ?";
        $stmt->prepare($query);
        $stmt->bind_param('i',$stmt->insert_id);

        // if ($retweet_id != $user_id) {
        //     var_dump($tweet_by,$user_id, $retweet_id,'retweet');
        //     Notification::SendNotifications($tweet_by,$user_id,$retweet_id,'retweet');
        //     var_dump(Notification::SendNotifications($tweet_by,$user_id,$retweet_id,'retweet'));
        // }

        var_dump($stmt->execute());
        
        return $stmt->execute();
    }
     
     public function checkEventsRetweet($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="SELECT * FROM events WHERE retweet_events_id= $tweet_id  AND tweet_events_by= $user_id OR events_id= $tweet_id AND tweet_events_by= $user_id ";
        $result = $mysqli->query($query);
        $CountRetweet= array();
        while ($row= $result->fetch_assoc()) {
             $CountRetweet[] = $row;
        }
        foreach ($CountRetweet as $countsRetweet) {
            # code...
            return $countsRetweet; // Return the $contacts array
        }

    }

      public function Eventslikes($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM events_like WHERE like_by = $user_id AND like_on = $tweet_id";
        $result= $mysqli->query($query);

        $fetchCountLikes= array();
        while ($row= $result->fetch_assoc()) {
             $fetchCountLikes[] = array(
            'like_id' => $row['like_id'],
            'like_by' => $row['like_by'],
            'like_on' => $row['like_on']
           );
        }
        foreach ($fetchCountLikes as $fetchLikes) {
            # code...
            return $fetchLikes; // Return the $contacts array
        }
    }
    
       public function addLikeEvents($user_id,$events_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events SET likes_counts = likes_counts +1 WHERE events_id= $events_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$events_id,'likes');
        // }
        $this->creates('events_like',array('like_by' => $user_id ,'like_on' => $events_id));
    }

      public function unLikeEvents( $user_id,$events_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events SET likes_counts = likes_counts -1 WHERE events_id= $events_id ";
        $mysqli->query($query);

        $query= "DELETE FROM events_like WHERE like_by = $user_id AND like_on = $events_id ";
        $mysqli->query($query);

    }

       public function addLikeEventsUsercomment($user_id,$comment_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events_comment SET likes_counts_ = likes_counts_ +1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$events_id,'likes');
        // }
        $this->creates('events_comment_like',array('like_by_' => $user_id ,'like_on_' => $comment_id));
    }

      public function unLikeEventsUsercomment($user_id,$comment_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE events_comment SET likes_counts_ = likes_counts_ -1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);

        $query= "DELETE FROM events_comment_like WHERE like_by_ = $user_id AND like_on_ = $comment_id ";
        $mysqli->query($query);

    }

      public function events_comment_like($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM events_comment_like WHERE like_by_ = $user_id AND like_on_ = $tweet_id";
        $result= $mysqli->query($query);

        $fetchCountLikes= array();
        while ($row= $result->fetch_assoc()) {
             $fetchCountLikes[] = array(
            'like_id_' => $row['like_id_'],
            'like_by_' => $row['like_by_'],
            'like_on_' => $row['like_on_']
           );
        }
        foreach ($fetchCountLikes as $fetchLikes) {
            # code...
            return $fetchLikes; // Return the $contacts array
        }
    }

    public function CountEventsComment($events_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM events_comment WHERE comment_on= $events_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

     
    public function deleteLikesEvents($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE B , L ,C ,R FROM events B 
                        LEFT JOIN events_like L ON L. like_on = B. events_id 
                        LEFT JOIN events_comment_like C ON C. like_on_ = B. events_id 
                        LEFT JOIN events_comment R ON R. comment_on = B. events_id 
                        WHERE B. events_id = '{$tweet_id}' and B. user_id3 = '{$user_id}' ";

        $query1="SELECT * FROM events WHERE events_id = $tweet_id and user_id3 = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'];
            $expodefile = explode("=",$photo);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$photo);
                $uploadDir = DOCUMENT_ROOT.'/uploads/events/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/events/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/events/';
                      unlink($uploadDir.$photo);
            }
        }

        $query= $mysqli->query($query);
        // var_dump("ERROR: Could not able to execute $query.".mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS DELETE</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail to delete !!!</strong>
                </div>');
        }
    }

      public function events_getPopupTweet($user_id,$tweet_id,$tweet_by)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN events B ON B. user_id3 = u. user_id Left JOIN events_like L ON L. like_on = B. events_id WHERE B. events_id = $tweet_id AND B. user_id3 = $tweet_by ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      public function Post_EventsLists($user_id,$follow_id)
    {
       $mysqli= $this->database;
        //  $query= $mysqli->query("SELECT * FROM events LEFT JOIN users ON user_id= user_id3 WHERE 
        // date0 >=  CURDATE() AND events_post != 'posted' ORDER BY date0  Desc Limit 9");
        $query= $mysqli->query("SELECT * FROM events E LEFT JOIN users U ON U. user_id= E. user_id3 WHERE E. events_post != 'posted' ORDER BY E. created_on3 Desc Limit 9 ");
        //Columns must be a factor of 12 (1,2,3,4,6,12)
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        $numOfCols = 3;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
        if ($query->num_rows != 0) {
          # code...
       ?>
       <div class="slide-text">
        <div class="slideshow-container">

        <div class="dot-container h5">
          <a href="<?php echo EVENTS; ?>">View more Events >>>></a> 
        </div>

        <div class="row mySlidesx mySlidesx0 text-center">
     <?php  while ($events=$query->fetch_array()) {
           # code...
           echo '
                <div class="col-md-4">
                   <div class="card more" id="events-readmore" data-events="'.$events['events_id'].'">
                     <img class="card-img-top" src="'.BASE_URL_PUBLIC."uploads/events/".$events['photo'].'">
                     <div class="card-body p-0">
                        <div class="black-bg" style="padding:4px;border-radius:3px;font-size:9px;">
                            <div>Avenue:'.$events['location_events']."/ ".$events['name_place'].'</div>
                            <div>start events:'.$events['start_events']."/ ".$events['date0'].'</div>
                            <div>Posted on '.$events['created_on3'].'</div>
                        </div>
                     </div>
                   </div>
                </div>
                <!-- col --> ';
                $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div><div class="row mySlidesx mySlidesx0 text-center">';
       } ?>
         
        </div>
        <!-- Next/prev buttons -->
        <a class="prev" onclick="plusSlides0(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides0(1)">&#10095;</a>
      </div>
        <!-- Dots/bullets/indicators -->
        <div class="dot-container">
            <span class="dot dot0" onclick="currentSlide0(1)"></span>
            <span class="dot dot0" onclick="currentSlide0(2)"></span>
            <span class="dot dot0" onclick="currentSlide0(3)"></span>
        </div>
    </div>
 <?php }
  }

}

$events = new Events();
/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>