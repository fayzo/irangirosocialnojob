<?php 
include('../init.php');
// $users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['hashtag'])) {
    # code...
    $hashtag= $users->test_input($_POST['hashtag']);
    if (substr($hashtag,0,1) == '#' ) {
        # code...
        $trend= str_replace('#','',$hashtag);
        $trends= $home->getTrendshashtag($trend);

        foreach ($trends as $trendhash) {
            # code...
            echo '<li><span class="getValue">#'.$trendhash["hashtag"].'</span></li>';
        }
    }
    $hashtagMention= $users->test_input($_POST['hashtag']);

     if (substr($hashtagMention,0,1) == '@' ) {
        # code...
        $mention= str_replace('@','',$hashtagMention);
        $mentions= $home->getmention($mention);

        foreach ($mentions as $mentionhash) {
            # code...
            echo '  <li><div class="nav-right-down-inner">
                         '.((!empty($mentionhash["profile_img"])?'
                              <div class="nav-right-down-left user-blockImgBorder">
                              <div class="user-blockImg">
                                <img src="'.BASE_URL_LINK.'image/users_profile_cover/'.$mentionhash["profile_img"].'"
                                alt="user image">
                              </div>
                              </div>
            
                            ':' <div class="nav-right-down-left user-blockImgBorder">
                               <div class="user-blockImg">
                                <img src="'.BASE_URL_LINK.NO_PROFILE_IMAGE_URL.'"
                                alt="user image">
                              </div>
                              </div>
                            ')).'
                      	<div class="nav-right-down-right">
                      		<div class="nav-right-down-right-headline">
                      			<span class="getValue">@'.$mentionhash['username'].'</span><a><span>'.$mentionhash['career'].'</span></a>
                      		</div>
                      	</div>
                      </div><!--nav-right-down-inner end-here-->
                    </li> ';
        }
    }
}
?>