<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Fundraising extends Follow
{
    public function fundraisings($pages,$categories,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*8)-8;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN fundraising F ON F. user_id2 = u. user_id WHERE F. categories_fundraising ='$categories'  ORDER BY created_on2 Desc Limit $showpages,8");
        ?>
            <div class="row mt-3">
        <?php while($row= $query->fetch_array()) { 
              $likes= $this->Fundraisinglikes($user_id,$row['fund_id']); ?>
        
                <div class="col-md-3 mb-3" >
                    <div class="card" style="border-bottom-left-radius: 0px !important;border-bottom-right-radius: 0px !important;">
                        <img class="card-img-top" height="244px" src="<?php echo BASE_URL_PUBLIC ;?>uploads/fundraising/<?php echo $row['photo'] ;?>" >
                        <div style="position: absolute; top: 0px; right: 0;padding: 1rem;">
                            <span class="btn btn-light"><span style="font-size: 14px" class="material-icons p-0 m-0"> trending_up</span> trending</span>
                        </div>
                        <div style="position: absolute;bottom: 0px; right: 0;left:0px;background-color: #cfd3d6a1">
                            
                                    <?php if($user_id == $row['user_id2']){ ?>          
                                    <ul class="list-inline mb-0 float-right mt-2 ml-1 mr-2" style="list-style-type: none;">  

                                            <li  class=" list-inline-item">
                                                <ul class="deleteButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px;" >
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label class="deleteFundraising"  data-fund="<?php echo $row["fund_id"];?>"  data-user="<?php echo $row["user_id2"];?>">Delete </label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                    </ul>
                                    <?php } ?>

                                <?php if($likes['like_on'] == $row['fund_id']){ ?>
                                            <span <?php if(isset($_SESSION['key'])){ echo 'class="unlike-fundraising-btn more float-right text-sm  mt-1 mr-1 text-dark"'; }else{ echo 'id="login-please" class="more float-right  mt-1 mr-1 text-dark" data-login="1" '; } ?> style="font-size:16px;" data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>"><span class="likescounter "><?php echo $row['likes_counts'] ;?></span> <i class="fa fa-heart"  ></i></span>
                                <?php }else{ ?>
                                    <span <?php if(isset($_SESSION['key'])){ echo 'class="like-fundraising-btn more float-right text-sm  mt-1 mr-1 text-dark"'; }else{ echo 'id="login-please" class="more float-right mt-1 mr-1 text-dark"  data-login="1" '; } ?> style="font-size:16px;" data-fund="<?php echo $row['fund_id']; ?>"  data-user="<?php echo $row['user_id']; ?>" ><span class="likescounter"> <?php if ($row['likes_counts'] > 0){ echo $row['likes_counts'];}else{ echo '';} ?></span> <i class="fa fa-heart-o" ></i> </span>
                                <?php } ?>

                               <h5 class="card-title text-dark m-1 pb-1 pl-2">Helps <?php echo $row['lastname'] ;?> </h5>
                              <div class="progress " style="height: 10px;">
                                  <?php echo $this->Users_donationMoneyRaising($row['money_raising'],$row['money_to_target']); ?>
                                <!-- <div class="progress-bar  bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> -->
                              </div>
                        </div>
                    </div>
                    <div class="card borders-bottoms" style="border-top-left-radius: 0px !important;border-top-right-radius: 0px !important;">
                            <div class="card-body pl-1 pt-0 pb-1">
                              <span class="h5 text-danger"><?php echo number_format($row['money_raising']); ?> Frw </span>
                              <span class="text-muted">raised Out of </span>
                              <span class="text-success"><?php echo number_format($row['money_to_target']).' Frw'; ?></span>
                              <p class="mt-2"><?php echo $row['text'] ;?></p>
                              <div>
                                <span class="text-success float-left ml-2"><i class="fa fa-check-circle" style='font-size:15px;' aria-hidden="true"></i> Verified</span>
                                <button type="button" id="fund-readmore" data-fund="<?php echo $row['fund_id'] ;?>" class="btn btn-primary float-right" >+ Read more</button></div>
                              </div>
                    </div>
                </div>

        <?php } 

        $query1= $mysqli->query("SELECT COUNT(*) FROM users U Left JOIN fundraising F ON F. user_id2 = u. user_id WHERE F. categories_fundraising ='$categories'  ORDER BY created_on2 Desc ");
        $row_Paginaion = $query1->fetch_array();
        $total_Paginaion = array_shift($row_Paginaion);
        $post_Perpages = $total_Paginaion/8;
        $post_Perpage = ceil($post_Perpages); ?>

    </div>
    <?php if($post_Perpage > 1){ ?>
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($pages > 1) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
            <?php } ?>
            <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                    if ($i == $pages) { ?>
                 <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php }else{ ?>
                <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
            <?php } } ?>
            <?php if ($pages+1 <= $post_Perpage) { ?>
                <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="fundraising_FecthRequest('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
            <?php } ?>
        </ul>
    </nav>
   <?php } ?>
   
   <?php }

    public function fundFecthReadmore($fund_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN fundraising F ON F. user_id2 = u. user_id Left JOIN fund_like L ON L. like_on= F. fund_id WHERE F. fund_id = '$fund_id' ");
        $row= $query->fetch_array();
        return $row;
    }

      public function Fundraising_comments($tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM comment_funding LEFT JOIN users ON comment_by=user_id LEFT JOIN fundraising ON comment_on=fund_id Left JOIN fundraising_comment_like ON comment_id =like_on_  WHERE comment_on = $tweet_id ORDER BY comment_at DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

       public function addLikeFundraising($user_id,$fund_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE fundraising SET likes_counts = likes_counts +1 WHERE fund_id= $fund_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$fund_id,'likes');
        // }
        $this->creates('fund_like',array('like_by' => $user_id ,'like_on' => $fund_id));
    }

      public function unLikeFundraising( $user_id,$fund_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE fundraising SET likes_counts = likes_counts -1 WHERE fund_id= $fund_id ";
        $mysqli->query($query);

        $query= "DELETE FROM fund_like WHERE like_by = $user_id AND like_on = $fund_id ";
        $mysqli->query($query);

    }

       public function addLikeFundraisingUsercomment($user_id,$comment_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment_funding SET likes_counts_ = likes_counts_ +1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$fund_id,'likes');
        // }
        $this->creates('fundraising_comment_like',array('like_by_' => $user_id ,'like_on_' => $comment_id));
    }

      public function unLikeFundraisingUsercomment($user_id,$comment_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment_funding SET likes_counts_ = likes_counts_ -1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);

        $query= "DELETE FROM fundraising_comment_like WHERE like_by_ = $user_id AND like_on_ = $comment_id ";
        $mysqli->query($query);

    }

     
      public function Fundraisinglikes($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM fund_like WHERE like_by = $user_id AND like_on = $tweet_id";
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

      public function Fundraising_comment_like($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM fundraising_comment_like WHERE like_by_ = $user_id AND like_on_ = $tweet_id";
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

    public function CountFundraisingComment($fund_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM comment_funding WHERE comment_on= $fund_id";
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
        $result= $mysqli->query("SELECT * FROM users U Left JOIN fundraising F ON F. user_id2 = u. user_id Left JOIN fund_like L ON L. like_on = F. fund_id WHERE F. fund_id = $tweet_id AND F. user_id2 = $tweet_by ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }
    
    public function deleteLikesfund($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE C , L , F ,R FROM fundraising C 
                        LEFT JOIN fund_like L ON L. like_on = C. fund_id 
                        LEFT JOIN comment_funding R ON R. comment_on = C. fund_id 
                        LEFT JOIN fundraising_comment_like F ON F. like_on_ = R. comment_id 
                        WHERE C. fund_id = '{$tweet_id}' and C. user_id2 = '{$user_id}' ";

        $query1="SELECT * FROM fundraising WHERE fund_id = $tweet_id and user_id2 = $user_id ";

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
                $uploadDir = DOCUMENT_ROOT.'/uploads/fundraising/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/fundraising/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/fundraising/';
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

      public function fundraising_donateUpdate($donate,$fund_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE fundraising SET donate_counts = donate_counts +1, money_raising = money_raising + $donate  WHERE fund_id= $fund_id ";
        $mysqli->query($query);
    }

    public function recentFundraisingDonate($fund_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM fundraising_donation LEFT JOIN users ON sentby_user_id=user_id WHERE fund_id0 = $fund_id ORDER BY created_on3 DESC";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }

    public function CountFundraisingRaising($fund_id)
    {
      $db =$this->database;
      $query="SELECT COUNT(*) FROM fundraising_donation WHERE fund_id0= $fund_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }




}

$fundraising = new Fundraising();
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