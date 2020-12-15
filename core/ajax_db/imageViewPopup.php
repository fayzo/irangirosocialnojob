<?php 
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));

if (isset($_POST['showpimage']) && !empty($_POST['showpimage'])) {
    if (isset($_SESSION['key'])) {
        # code...
        $user_id= $_SESSION['key'];
    } else {
        # code...
        $user_id= 65;
    }
    
    $tweet_id=$_POST['showpimage'];
    $getid="";
    $tweet= $home->getPopupTweet($user_id,$tweet_id,$getid); 

$filename = $tweet['tweet_image'];
$expodefile = explode("=",$tweet['tweet_image']);
$fileActualExt= array();
for ($i=0; $i < count($expodefile); ++$i) { 
$fileActualExt[]= strtolower(substr($expodefile[$i],-3));
}

$allower_ext = array('jpeg','peg','jpg', 'png', 'gif'); // valid extensions
if (array_diff($fileActualExt,$allower_ext) == false) { ?>

    <div class="img-popup">
      <div class="wrap6" id="disabler">
        <div class="wrap6Pophide" onclick="togglePopup( )"></div>
        <span class="colose">
        	<button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
        </span>
        <div class="img-popup-wrap"  id="popupEnd">
          <div class="row">
           <div class="col-12">
        	<div class="img-popup-body">
                <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none"  onclick="togglePopup ( )">close</button>
               
                <div id="jssor_2" style="position:relative;margin:0 auto;top:0px;left:0px;width:960px;height:480px;overflow:hidden;visibility:hidden;background-color:#24262e;">
                    <!-- Loading Screen -->
                    <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                        <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="<?php echo BASE_URL_LINK;?>image/img/spin.svg" />
                    </div>
                     <div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">
                         <?php $expode = explode("=",$tweet['tweet_image']);
                              $splice= array_splice($expode,0,10);
                              for ($i=0; $i < count($splice); ++$i) { 
                                  ?>
                            <div>
                                <img data-u="image" src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>" />
                                <img data-u="thumb" src="<?php echo BASE_URL_PUBLIC."uploads/posts/".$splice[$i] ;?>" width="90px" height="auto" />
                            </div>
                            <?php } ?>
                         
                      </div>
                     <!-- Thumbnail Navigator -->
                     <div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;top:0px;width:240px;height:480px;background-color:#000;" data-autocenter="2" data-scale-left="0.75">
                         <div data-u="slides">
                             <div data-u="prototype" class="p" style="width:99px;height:66px;">
                                 <div data-u="thumbnailtemplate" class="t"></div>
                                 <svg viewbox="0 0 16000 16000" class="cv">
                                     <circle class="a" cx="8000" cy="8000" r="3238.1"></circle>
                                     <line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line>
                                     <line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line>
                                 </svg>
                             </div>
                         </div>
                     </div>
                     <!-- Arrow Navigator -->
                     <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:270px;" data-autocenter="2">
                         <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                             <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                             <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                             <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                         </svg>
                     </div>
                     <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2">
                         <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                             <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                             <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                             <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                         </svg>
                     </div>
                </div>
                <!-- #endregion Jssor Slider End -->
                    <script type="text/javascript">jssor_2_slider_init();</script>

               </div><!-- img-popupbody -->
             </div><!-- col -->
            </div> <!-- row -->
        </div><!-- img-popup-wrap -->

       </div> <!-- wrap6 -->
    </div><!-- img-popup ends-->

<?php }
}
?>

