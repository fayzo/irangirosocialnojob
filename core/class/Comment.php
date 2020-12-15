<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Comment extends Post_like
{
    public function comments($tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM comment LEFT JOIN users ON comment_by=user_id WHERE comment_on = $tweet_id ORDER BY comment_at DESC ";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }
    
    public function CountsComment($tweet_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM comment WHERE comment_on= $tweet_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

    public function comments_second($tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM post_comment LEFT JOIN users ON comment_by_=user_id WHERE comment_on_ = $tweet_id ORDER BY comment_at_ DESC ";
        $result= $mysqli->query($query);
        $comments= array();
        while ($row= $result->fetch_assoc()) {
             $comments[] = $row;
        }
        return $comments;
    }
    
    public function CountsComment_second($tweet_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM post_comment WHERE comment_on_= $tweet_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

    public function delete($table,$array)
    {
        $mysqli= $this->database;
        $query= "DELETE FROM $table";
        $where= " WHERE"; 
        foreach ($array as $name => $value) {
            # code...
             $query .= "{$where} {$name} = {$value}";
             $where= " AND"; 
        }

        $query1= "SELECT * FROM $table";
        $where1= " WHERE"; 
        foreach ($array as $name => $value) {
            # code...
             $query1 .= "{$where1} {$name} = {$value}";
             $where1= " AND"; 
        }

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['tweet_image'])){
            $expodefile = explode("=",$rows['tweet_image']);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','ocx','lsx'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$rows['tweet_image']);
                $uploadDir = DOCUMENT_ROOT.'/uploads/posts/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/posts/';
                      unlink($uploadDir.$rows['tweet_image']);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/posts/';
                      unlink($uploadDir.$rows['tweet_image']);
            }
        }

        $query= $mysqli->query($query);

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

    public function deleteLikesNotificatPosts($tweet_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE T ,C ,G ,H ,J ,N ,L ,R FROM tweets T 
                        LEFT JOIN comment C ON C. comment_on = T. tweet_id 
                        LEFT JOIN post_like G ON G. like_on_ = C. comment_id 
                        LEFT JOIN post_dislike H ON H. like_on_ = C. comment_id 
                        LEFT JOIN post_comment J ON J. comment_on_ = C. comment_id   
                        LEFT JOIN notification N ON N. target = T. tweet_id 
                        LEFT JOIN likes L ON L. like_on = T. tweet_id 
                        LEFT JOIN trends R ON R. target = T. tweet_id 
                        WHERE T. tweet_id = '{$tweet_id}' and T. tweetBy = '{$user_id}' ";

        $query1="SELECT * FROM tweets WHERE tweet_id = $tweet_id and tweetBy = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['tweet_image'])){
            $expodefile = explode("=",$rows['tweet_image']);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','ocx','lsx'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$rows['tweet_image']);
                $uploadDir = DOCUMENT_ROOT.'/uploads/posts/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/posts/';
                      unlink($uploadDir.$rows['tweet_image']);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/posts/';
                      unlink($uploadDir.$rows['tweet_image']);
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
}

$comment= new Comment();
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