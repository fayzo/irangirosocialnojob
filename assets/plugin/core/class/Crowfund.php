<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Crowfund extends Fundraising {

     public function crowfundraisings($pages,$categories,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*8)-8;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN crowfundraising C ON C. user_id2 = u. user_id WHERE C. categories_crowfundraising ='$categories'  ORDER BY created_on2 Desc Limit $showpages,8");
        ?>
            <div class="row mt-3">
        <?php while($row= $query->fetch_array()) { 
              $likes= $this->Crowfundraisinglikes($user_id,$row['fund_id']); ?>

               <div class="col-md-3 mb-3">
            
            <div class="card borders-bottoms more" >
                <img class="card-img-top" width="242px" id="crowfund-readmore" data-crowfund="<?php echo $row['fund_id'] ;?>" height="160px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/crowfund/<?php echo $row['photo'] ;?>" >
                <div class="card-body">
                    <div class="p-0 font-weight-bold">Funding 

                        <?php if($user_id == $row['user_id2']){ ?>
                         <ul class="list-inline mb-0  float-right" style="list-style-type: none;">  

                                <li  class=" list-inline-item">
                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                        <li>
                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                            <ul style="list-style-type: none; margin:0px;" >
                                                <li style="list-style-type: none; margin:0px;"> 
                                                  <label class="deleteCrowfund"  data-fund="<?php echo $row["fund_id"];?>"  data-user="<?php echo $row["user_id2"];?>">Delete </label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                        </ul>
                        <?php } ?>

                        <?php if($likes['like_on'] == $row['fund_id']){ ?>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-crowfundraising-btn more float-right text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>"><span class="likescounter "><?php echo $row['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                        <?php }else{ ?>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="like-crowfundraising-btn more float-right text-sm mr-2"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>" ><span class="likescounter"> <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                        <?php } ?>
                     
                    </div>

                    <hr>
                     <div style="height:115px;">
                        <a href="javascript:void(0);"  id="crowfund-readmore" data-crowfund="<?php echo $row['fund_id'] ;?>" class="card-text h5"><?php echo $row['photo_Title_main'] ;?></a>
                        <!-- Kogera umusaruro muguhinga -->
                        <p class="text-muted"><?php echo $row['text']; ?></p>
                        <!-- turashaka kongera umusaruro mu buhinzi tukabona ubufasha buhagije no kubona imbuto -->
                    </div>                      
                    <div class="text-muted mb-1"><?php echo $categories; ?>
                        <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                    </div>
                    <div class="card-text">
                    <!-- 40,000 -->
                        <span class="font-weight-bold"><?php echo number_format($row['money_raising']); ?> Frw</span>
                         Raised
                        <span class="float-right"><?php echo $this->donationPercetangeMoneyRaimaing($row['money_raising'],$row['money_to_target']); ?> %</span>
                        <!-- 40 -->
                    </div>
                     <div class="progress clear-float " style="height: 10px;">
                        <?php echo $this->Users_donationMoneyRaising($row['money_raising'],$row['money_to_target']); ?>
                    </div>
                    
                    <div class="clear-float">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <span class="text-muted"><?php echo $this->timeAgo($row['created_on2']); ?></span>
                        <span class="text-muted float-right text-right">out of <?php echo number_format($row['money_to_target']).' Frw'; ?></span>
                        <!-- 13 days Left -->
                    </div>
                </div>
            </div> <!-- card -->
                 
        </div> <!-- col -->

        <?php } 

        $query1= $mysqli->query("SELECT COUNT(*) FROM users U Left JOIN crowfundraising C ON  C. user_id2 = u. user_id WHERE C. categories_crowfundraising ='$categories'  ORDER BY created_on2 Desc ");
        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/8;
        $post_Perpage = ceil($post_Perpages); ?>

    </div>
    <?php if($post_Perpage > 1){ ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($pages > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="crowfundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
            <?php } ?>
            <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                    if ($i == $pages) { ?>
                 <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="crowfundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php }else{ ?>
                <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="crowfundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
            <?php } } ?>
            <?php if ($pages+1 <= $post_Perpage) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="crowfundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
            <?php } ?>
        </ul>
    </nav>
   <?php } ?>
   
   <?php }

    public function crowfundFecthReadmore($fund_id,$user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN crowfundraising C ON C. user_id2 = u. user_id WHERE C. fund_id = '$fund_id' ");
        $row= $query->fetch_array();
        return $row;
    }

      public function Crownfund_comments($tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM comment_crowfunding LEFT JOIN users ON comment_by=user_id WHERE comment_on = $tweet_id ORDER BY comment_at DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

      public function recentDonate($fund_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM crowfund_donation LEFT JOIN users ON sentby_user_id=user_id WHERE fund_id0 = $fund_id ORDER BY created_on3 DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

       public function addLikeCrowFundraising($user_id,$fund_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE crowfundraising SET likes_counts = likes_counts +1 WHERE fund_id= $fund_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$fund_id,'likes');
        // }
        $this->creates('crowfundraising_like',array('like_by' => $user_id ,'like_on' => $fund_id));
    }

      public function unLikeCrowFundraising( $user_id,$fund_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE crowfundraising SET likes_counts = likes_counts -1 WHERE fund_id= $fund_id ";
        $mysqli->query($query);

        $query= "DELETE FROM crowfundraising_like WHERE like_by = $user_id AND like_on = $fund_id ";
        $mysqli->query($query);

    }

       public function addLikeCrowFundraisingUsercomment($user_id,$comment_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment_crowfunding SET likes_counts_ = likes_counts_ +1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$fund_id,'likes');
        // }
        $this->creates('crowfundraising_comment_like',array('like_by_' => $user_id ,'like_on_' => $comment_id));
    }

      public function unLikeCrowFundraisingUsercomment($user_id,$comment_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment_crowfunding SET likes_counts_ = likes_counts_ -1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);

        $query= "DELETE FROM crowfundraising_comment_like WHERE like_by_ = $user_id AND like_on_ = $comment_id ";
        $mysqli->query($query);

    }

    
      public function Crowfundraisinglikes($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM crowfundraising_like WHERE like_by = $user_id AND like_on = $tweet_id";
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

      public function Crowfundraising_comment_like($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM crowfundraising_comment_like WHERE like_by_ = $user_id AND like_on_ = $tweet_id";
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

    public function CountcrowFundraisingComment($fund_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM comment_crowfunding WHERE comment_on= $fund_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

    public function fund_getPopupTweet($user_id,$tweet_id,$tweet_by)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN crowfundraising F ON F. user_id2 = u. user_id Left JOIN crowfundraising_like L ON L. like_on = F. fund_id WHERE F. fund_id = $tweet_id AND F. user_id2 = $tweet_by ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

    
    public function deleteLikesCrowfund($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE C , L , F ,R FROM crowfundraising C 
                        LEFT JOIN crowfundraising_like L ON L. like_on = C. fund_id 
                        LEFT JOIN comment_crowfunding R ON R. comment_on = C. fund_id 
                        LEFT JOIN crowfundraising_comment_like F ON F. like_on_ = R. comment_id 
                        WHERE C. fund_id = '{$tweet_id}' and C. user_id2 = '{$user_id}' ";

        $query1="SELECT * FROM crowfundraising WHERE fund_id = $tweet_id and user_id2 = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'].'='.$rows['other_photo'];
            $expodefile = explode("=",$photo);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$photo);
                $uploadDir = DOCUMENT_ROOT.'/uploads/crowfund/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/crowfund/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/crowfund/';
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

    public function crowfund_donateUpdate($donate,$fund_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE crowfundraising SET donate_counts = donate_counts +1, money_raising = money_raising + $donate  WHERE fund_id= $fund_id ";
        $mysqli->query($query);
    }

    public function CountcrowFundraisingRaising($fund_id)
    {
      $db =$this->database;
      $query="SELECT COUNT(*) FROM crowfund_donation WHERE fund_id0= $fund_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

     public function Post_crowfundraisings($categories,$user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN crowfundraising C ON C. user_id2 = u. user_id ORDER BY created_on2 Desc Limit 6");
        //Columns must be a factor of 12 (1,2,3,4,6,12)
        $numOfCols = 2;
        $rowCount = 0;
        $bootstrapColWidth = 12 / $numOfCols;
       ?>
       <div class="slide-text">
        <div class="slideshow-container">

        <div class="dot-container h5">
          <a href="<?php echo WHOTOFOLLOW; ?>">View more Crowfundraising >>>></a> 
        </div>

        <div class="row mySlidesx mySlidesx1">

        <?php while($row= $query->fetch_array()) { 
              $likes= $this->Crowfundraisinglikes($user_id,$row['fund_id']); ?>

               <div class="col-md-6">
            
            <div class="card borders-bottoms more" >
                <img class="card-img-top" width="242px" id="crowfund-readmore" data-crowfund="<?php echo $row['fund_id'] ;?>" height="160px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/crowfund/<?php echo $row['photo'] ;?>" >
                <div class="card-body">
                    <div class="p-0 font-weight-bold">Funding 

                        <?php if($user_id == $row['user_id2']){ ?>
                         <ul class="list-inline mb-0  float-right" style="list-style-type: none;">  

                                <li  class=" list-inline-item">
                                    <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                        <li>
                                            <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                            <ul style="list-style-type: none; margin:0px;" >
                                                <li style="list-style-type: none; margin:0px;"> 
                                                  <label class="deleteCrowfund"  data-fund="<?php echo $row["fund_id"];?>"  data-user="<?php echo $row["user_id2"];?>">Delete </label>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                        </ul>
                        <?php } ?>

                        <?php if($likes['like_on'] == $row['fund_id']){ ?>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-crowfundraising-btn more float-right text-sm  mr-2"'; }else{ echo 'id="login-please" class="more float-right" data-login="1"'; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>"><span class="likescounter "><?php echo $row['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                        <?php }else{ ?>
                            <span <?php if(isset($_SESSION['key'])){ echo 'class="like-crowfundraising-btn more float-right text-sm mr-2"'; }else{ echo 'id="login-please" class="more float-right"  data-login="1"'; } ?> data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>" ><span class="likescounter"> <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                        <?php } ?>
                     
                    </div>

                    <hr>
                    <div style="height:115px;">
                        <a href="javascript:void(0);"  id="crowfund-readmore" data-crowfund="<?php echo $row['fund_id'] ;?>" class="card-text h5"><?php echo $row['photo_Title_main'] ;?></a>
                        <!-- Kogera umusaruro muguhinga -->
                        <p class="text-muted"><?php echo $row['text']; ?></p>
                        <!-- turashaka kongera umusaruro mu buhinzi tukabona ubufasha buhagije no kubona imbuto -->
                    </div>    
                        
                        <div class="text-muted mb-1"><?php echo $categories; ?>
                            <span class="text-success px-1 float-right" style="border-radius:3px;font-size:11px;"><i class="fa fa-check-circle" aria-hidden="true"></i> Verified</span>
                        </div>
                        <div class="card-text">
                        <!-- 40,000 -->
                            <span class="font-weight-bold"><?php echo number_format($row['money_raising']); ?> Frw</span>
                            Raised
                            <span class="float-right"><?php echo $this->donationPercetangeMoneyRaimaing($row['money_raising'],$row['money_to_target']); ?> %</span>
                            <!-- 40 -->
                        </div>
                        <div class="progress clear-float " style="height: 10px;">
                            <?php echo $this->Users_donationMoneyRaising($row['money_raising'],$row['money_to_target']); ?>
                        </div>
                    <div class="clear-float">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <span class="text-muted"><?php echo $this->timeAgo($row['created_on2']); ?></span>
                        <span class="text-muted float-right text-right">out of <?php echo number_format($row['money_to_target']).' Frw'; ?></span>
                        <!-- 13 days Left -->
                    </div>
                </div>
            </div> <!-- card -->
                 
        </div> <!-- col -->
       <?php     $rowCount++;
                if($rowCount % $numOfCols == 0) echo '</div><div class="row mySlidesx mySlidesx1">';
         } ?>

        </div>
        <!-- Next/prev buttons -->
        <a class="prev" onclick="plusSlides1(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides1(1)">&#10095;</a>
      </div>
        <!-- Dots/bullets/indicators -->
        <div class="dot-container">
            <span class="dot dot1" onclick="currentSlide1(1)"></span>
            <span class="dot dot1" onclick="currentSlide1(2)"></span>
            <span class="dot dot1" onclick="currentSlide1(3)"></span>
        </div>
    </div>

   <?php  }
}

$crowfund = new Crowfund;
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