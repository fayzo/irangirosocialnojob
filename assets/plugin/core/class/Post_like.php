<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Post_like extends Users {

        public function add_post_Like_second($user_id,$comment_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment SET likes_counts_ = likes_counts_ +1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$tweet_id,'likes');
        // }
        $this->creates('post_like',array('like_by_' => $user_id ,'like_on_' => $comment_id));
    }

      public function unLike_post_second( $user_id,$comment_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment SET likes_counts_ = likes_counts_ -1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);

        $query= "DELETE FROM post_like WHERE like_by_ = $user_id AND like_on_ = $comment_id";
        $mysqli->query($query);

    }

     public function Like_second($user_id,$comment_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM post_like WHERE like_by_ = $user_id AND like_on_ = $comment_id";
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

     public function dislike($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM post_dislike WHERE like_by_ = $user_id AND like_on_ = $tweet_id";
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

      public function dislike_comment($user_id,$comment_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment SET dislikes_counts_ = dislikes_counts_ +1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);
        // if ($get_id != $user_id) {
        //     Notification::SendNotifications($get_id,$user_id,$tweet_id,'likes');
        // }
        $this->creates('post_dislike',array('like_by_' => $user_id ,'like_on_' => $comment_id));
    }

      public function undislike_comment( $user_id,$comment_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE comment SET dislikes_counts_ = dislikes_counts_ -1 WHERE comment_id= $comment_id ";
        $mysqli->query($query);

        $query= "DELETE FROM post_dislike WHERE like_by_ = $user_id AND like_on_ = $comment_id";
        $mysqli->query($query);

    }

      public function getPopupDeleteComPost0($comment_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM comment, users WHERE comment_id = $comment_id AND comment_by = user_id";
        $result= $mysqli->query($query);
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

    public function seconDcomments($tweet_id)
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
    
    public function CountsComment0($tweet_id){
      $db =$this->database;
      $query="SELECT COUNT(*) FROM comment WHERE comment_on= $tweet_id";
      $sql= $db->query($query);
      $row_Comment = $sql->fetch_array();
      $total_Comment= array_shift($row_Comment);
      $array= array(0,$total_Comment);
      $total_Comment= array_sum($array);
      echo $total_Comment;
    }

}

$post_secondLikeComment= new Post_like();

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