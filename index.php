
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title>Home</title>
<?php include "header_navbar_footer/header.php"?>

      <!-- Main content -->
      <section class="content">

        <div class="row">
          <div class="col-md-3 mb-3 d-none d-md-block">

            <?php echo $home->userProfile($user_id); ?>
            <?php echo $trending->trends(); ?>
            <!-- Profile Image -->

          </div>

          <div class="col-md-6 mb-4">
            <div id="response-posts"></div>
            <div class="card  borders-tops mb-4">
              <div class="card-body message-color" style="padding-bottom: 0rem;">
                <form method="post" id="post_form" enctype="multipart/form-data">
                  <input type="hidden" name="id_posts" id="id_posts" value="<?php echo $_SESSION['key'];?>">
                  <div class="user-block">
                    <div class="user-blockImgBorder">
                      <div class="user-blockImg">
                          <?php if (!empty($user['profile_img'])) {?>
                          <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" alt="User Image">
                          <?php  }else{ ?>
                            <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" alt="User Image">
                          <?php } ?>
                      </div>
                    </div>
                    <span class="username">
                      <textarea class="status" name="status" id="status" placeholder="Type Something here!" rows="4"
                        cols="50"></textarea>
                      <div class="hash-box">
                        <ul>
                        </ul>
                      </div>
                    </span>
                  </div>

                  <div class="message-footer text-muted mb-2">
                    <div class="t-fo-left">

                      <ul>
                        <input type="file" name="files[]" id="file" multiple="">
                        <?php if(isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?>
                        <li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
                          <span class="tweet-error">
                            <span style="color: red;" id="empty-posts"></span>
                          </span>
                        </li>
                        <?php } ?>
                      </ul>

                    </div>
                    <div class="t-fo-right">
                      <span id="count">200</span>
                      <input <?php echo (isset($_SESSION['key']))?'type="submit"':'type="button" id="login-please" data-login="1"';?> class="btn main-active" name="tweet" value="Post">
                    </div>
                    <!--  progress-xs -->
                    <span class="progress progress-hide" style="display: none;">
                      <span class="progress-bar bg-danger" role="progressbar" style="width:0%;" id="pro"
                        aria-valuenow="" aria-valuemin="0" aria-valuemax="100"><span> completed <span
                            class="fa fa-check"></span></span></span>
                    </span>
                  </div>
                </form>
              </div>
              <!-- card-body -->
            </div>
            <!-- card -->

            <div class="posted">
            <!-- Box Comment -->
              <div class="card  borders-tops card-profile card1">
                  <div class="card-body message-color">
                    <?php echo $posts_home->tweets($user_id,15); ?>
                    <!-- Post -->
                  </div>
              </div>
            </div>
            <div class="loading-div text-center mt-2">
                <img id="loader" src="<?php echo BASE_URL_LINK."image/img/"?>loading.svg" style="display: none;"/> 
            </div>
          </div>
          <!-- col -->

          <div class="col-md-3 d-none d-md-block">
            <!-- whoTofollow: user whoTofollow style 1 -->
            <?php echo $follow->whoTofollow($user_id,$user_id) ;?>
          
          </div>
          <!-- col -->
        </div>
        <!-- row -->

      </section>
      <!-- /.content -->


<?php include "header_navbar_footer/footer.php"?>
