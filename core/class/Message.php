<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Message extends Home 
{
    public function recentMessage($user_id)
    {
       $mysqli= $this->database;
    //    $query="SELECT * FROM message LEFT JOIN users ON message_from= user_id WHERE message_to= $user_id ORDER BY message_on Desc ;";
       $query="SELECT * FROM message M LEFT JOIN users U ON M. message_from= U. user_id WHERE M. message_to= $user_id AND M. status= 1 GROUP BY M. message_from, M. message_to HAVING  COUNT(DISTINCT M. message_to) AND COUNT(DISTINCT M. message_from) ORDER BY M. message_on Desc ;";
             
    // $query="SELECT DISTINCT * FROM message M LEFT JOIN users U ON M. message_from = U. user_id WHERE M. message_to IN (
    //         SELECT MAX(message_to)
    //         FROM message WHERE message_to = $user_id  AND M. status= 1 GROUP BY message_from ORDER BY M. message_on Desc
    //     ) ORDER BY M. message_on Desc";

    // $query="SELECT * from users U
    // inner join (select message,message_on,MAX(message_from)as ma, MAX(message_to) as maxid from message group by message_on) as b on
    //     U.user_id= b.ma WHERE b.maxid= $user_id GROUP BY b.ma ORDER BY b.message_on Desc";

       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }
       return $data;

    }

    public function recentMessageUnread($user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM message M LEFT JOIN users U ON M. message_from= U. user_id WHERE M. message_to= $user_id AND M. status= 0 GROUP BY M. message_from, M. message_to HAVING  COUNT(DISTINCT M. message_to) AND COUNT(DISTINCT M. message_from) ORDER BY M. message_on Desc ;";

       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }
       return $data;

    }

     public function getMessage($messagefrom,$user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM message LEFT JOIN users ON message_from= user_id WHERE message_from= $messagefrom AND message_to= $user_id OR message_to= $messagefrom AND message_from= $user_id";
       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }

       foreach ($data as $message) {
           # code...
           if ($message['message_from'] == $user_id) {
               # code...
               echo '
                <!-- Chat messages-->
                
                 <!-- Main message BODY RIGHT START -->
                <div class="main-msg-body-right">
                		<div class="main-msg">
                            <div class="msg-img">
                             '.((!empty($message['profile_img']))?'
                                    <a href="#"><img src="'.BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'].'"/></a>
                                    ':'
                                    <a href="#"><img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"/></a>
                                ').'
                			</div>
                			<div class="msg">'.$message['message'].'
                				<div class="msg-time">
                				  '.$this->timeAgo($message['message_on']).'
                				</div>
                			</div>
                			<div class="msg-btn">
                				<a><i class="fa fa-ban" aria-hidden="true"></i></a>
                				<a class="deleteMsg more" data-message="'.$message['message_id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                			</div>
                		</div>
                	</div>
                	<!--Main message BODY RIGHT END--> ';
           }else {
               # code...
               echo '
               <!--Main message BODY LEFT START-->
                		<div class="main-msg-body-left">
                			<div class="main-msg-l">
                                <div class="msg-img-l">
                                '.((!empty($message['profile_img']))?'
                                    <a href="#"><img src="'.BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'].'"/></a>
                                    ':'
                                    <a href="#"><img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"/></a>
                                ').'
                				</div>
                				<div class="msg-l">'.$message['message'].'
                					<div class="msg-time-l">
                					    '.$this->timeAgo($message['message_on']).'
                					</div>	
                				</div>
                				<div class="msg-btn-l">	
                					<a><i class="fa fa-ban" aria-hidden="true"></i></a>
                					<a class="deleteMsg more" data-message="'.$message['message_id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                				</div>
                			</div>
                		</div> 
                	<!--Main message BODY LEFT END-->
                <!-- Chat  --> ';
           }
       }
    }
    
     public function getChatMessage($messagefrom,$user_id)
    {
       $mysqli= $this->database;
       $query="SELECT * FROM message LEFT JOIN users ON message_from= user_id WHERE message_from= $messagefrom AND message_to= $user_id OR message_to= $messagefrom AND message_from= $user_id";
       $result=$mysqli->query($query);
       $data=array();
       while ($row = $result->fetch_array()) {
                $data[]= $row;
       }
    //    echo'
    //       <div class="bg-dark text-light p-2" style="position:fixed;z-index:1;">'.$data[0]['username'].(($data[0]['chat'] == 'on')?' <img src="'.BASE_URL_LINK.'image/color/green.png" class="img-rounded" width="9px"> online':' <img src="'.BASE_URL_LINK.'image/color/rose.png" class="img-rounded" width="9px"> offline '.$this->timeAgo($data[0]['last_login'])).'</div>
    //     ';
        foreach ($data as $message) {
           # code...
           if ($message['message_from'] == $user_id) {
               # code...
                  echo '  <!-- Message to the right -->
                           <div class="direct-chat-msg right">
                               <div class="direct-chat-info clearfix">
                                   <span class="direct-chat-name float-right" style="color: #999;">'.$message['username'].'</span>
                                   <span class="direct-chat-timestamp float-left">
                                   '.$this->timeAgo($message['message_on']).'
                                          <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                          <a class="deleteMsg more" data-message="'.$message['message_id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   </span>
                               </div>
                               <!-- /.direct-chat-info -->
                                '.((!empty($message['profile_img']))?'
                                    <a href="#">   <img class="direct-chat-img"
                                   src="'.BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'].'"/></a>
                                    ':'
                                    <a href="#">   <img class="direct-chat-img"
                                   src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"/></a>
                                ').'
                               <!-- /.direct-chat-img -->
                               <div class="direct-chat-text">
                                 '.$message['message'].'
                               </div>
                               <!-- /.direct-chat-text -->
                           </div>
                           <!-- /.direct-chat-msg -->';
           }else {
               # code...
                echo '      <div class="direct-chat-msg">
                               <div class="direct-chat-info clearfix">
                                   <span class="direct-chat-name float-left" style="color: #999;">'.$message['username'].'</span>
                                   <span class="direct-chat-timestamp float-right">
                                      <a><i class="fa fa-ban" aria-hidden="true"></i></a>
                                      <a class="deleteMsg more" data-message="'.$message['message_id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                   '.$this->timeAgo($message['message_on']).'
                                    </span>
                               </div>
                               <!-- /.direct-chat-info -->
                                 '.((!empty($message['profile_img']))?'
                                    <a href="#">  <img class="direct-chat-img"
                                   src="'.BASE_URL_LINK."image/users_profile_cover/".$message['profile_img'].'"/></a>
                                    ':'
                                    <a href="#">  <img class="direct-chat-img"
                                   src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"/></a>
                                ').'
                               <!-- /.direct-chat-img -->
                               <div class="direct-chat-text">
                                  '.$message['message'].'
                               </div>
                               <!-- /.direct-chat-text -->
                           </div>
                           <!-- /.direct-chat-msg -->';
           }
       }
    }
    
     public function deleteMsg($message_id,$user_id)
    {
        $mysqli= $this->database;
        $query= "DELETE FROM message WHERE message_id = $message_id AND message_from = $user_id OR message_id = $message_id AND message_to = $user_id";
        $mysqli->query($query);
        var_dump($query);
        var_dump( $mysqli->query($query));

    }

     public function deleteMsgAll($message_to,$user_id)
    {
        $mysqli= $this->database;
        $query= "DELETE FROM message WHERE message_to = $message_to AND message_from = $user_id ";
        $sql=$mysqli->query($query);

        if($sql){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }

    }
}


$message= new Message();

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