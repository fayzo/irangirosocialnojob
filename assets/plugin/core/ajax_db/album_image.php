<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['id_Album'])){
	# code...
	$user_id= $users->test_input($_POST['id_Album']);
	$files= $_FILES['files'];

	if (!empty(array_filter($files['name'])) ) {
		if (!empty($files['name'][0])) {
			# code...
			$tweetimages = $home->uploadAlbumImage($files);
		}

		 $tweet_id= $users->creates('album',array(
                        'target' => $user_id, 
                        'album_image' => $tweetimages, 
                        'created_on' => date('Y-m-d H-i-s')
                    ));

		// $home->addmention($status,$user_id,$tweet_id);
		
		if($tweet_id){
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

?>