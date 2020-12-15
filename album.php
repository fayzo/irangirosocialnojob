
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title><?php echo $profileData['username'].' your photos'; ?></title>
<?php include "header_navbar_footer/header.php"?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
                <h1><i>Photos</i></h1>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <li class="breadcrumb-item"><button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'">Profile</button></li>
                    <li class="breadcrumb-item active"><i> <?php echo $follow->followBtn($profileData['user_id'],$user_id,$profileData['user_id']) ;?></i></li>
                </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="sticky-top " style="top: 52px;">
                   <div class="card mb-2">
                         <?php if (!empty($profileData['profile_img'])) { ?>
                       <img class="card-img-top" src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$profileData['profile_img']; ?>">
                        <?php }else{ ?>
                       <img class="card-img-top" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL; ?>">
                        <?php } ?>
                       <div class="card-body  py-1 text-center main-active">
                           <h4 class="card-title"><button type="button" class="btn btn-primary" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'].'.album_crop' ;?>'">Click to CROP</button> Profile image</h4>
                       </div>
                   </div>

                   <div class="card mb-2">
                    <?php if (!empty($profileData['cover_img'])) { ?>
                   <img class="card-img-top" src="<?php echo BASE_URL_LINK."image/users_cover_profile/".$profileData['cover_img']; ?>">
                     <?php }else{ ?>
                   <img class="card-img-top" src="<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL; ?>">
                     <?php } ?>
                       <div class="card-body py-1 text-center main-active">
                           <h4 class="card-title">Cover Image</h4>
                       </div>
                   </div>
                </div>
            </div>
            <!-- /.col -->

            <div class="col-md-9 mb-4">
                 <!-- Box Comment -->
                 <div class="card mb-2">
                     <div class="card-header py-1">
                           <h4 class="card-title float-left pl-2 mt-3"><i> Album</i></h4>
                    <?php if (isset($_SESSION['key'])){ ?>
                     <?php if ($profileData['user_id'] == $_SESSION['key']) { ?>
                           <form method="post" id="album_form" enctype="multipart/form-data"  class="float-right">
                                <input type="hidden" name="id_Album" id="id_Album" value="<?php echo $_SESSION['key'];?>" >
                            <div class="t-fo-left">
                                  <ul>
                                       <input type="file" name="files[]" id="file" multiple>
                                      <li><label for="file"><i class="fa fa-camera" aria-hidden="true"></i></label>
                                          <span class="tweet-error">
                                              <span style="color: red;" id="empty-Album"></span>
                                          </span>
                                      </li>
                                  </ul>
                            </div>

                            <input type="submit" class="btn main-active ml-2 mt-2" name="Album" value="+ Create Album Submit">
                          </form>
                           <!--  progress-xs -->
                            <span class="progress progress-Album">
                                <span class="progress-bar bg-info" role="progressbar"
                                    style="width:0%;" id="proAlbum" aria-valuenow="" aria-valuemin="0"
                                    aria-valuemax="100"></span>
                            </span>
                      <?php } } ?>
                     </div> <!-- /.card-header -->
                      <div class="card-header borders-tops p-1">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link  active" href="#timeline"
                             data-toggle="tab">Timeline</a> </li>
                        <li class="nav-item"><a class="nav-link" href="#activity"
                                data-toggle="tab">Activity</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body bg-white">
                        <div class="tab-content">
                             <div class="tab-pane active " id="timeline">
                                 <?php echo $home->albumPhotoTimeline($profileData['user_id']); ?>
                            </div> 
                            <div class="tab-pane" id="activity">
                               <?php echo $home->albumPhoto($profileData['user_id']); ?>
                            </div>
                        </div> <!-- /.tab-content -->
                     </div> <!-- /.card-body -->
                 </div> <!-- /.card -->

            </div>
            <!-- /.col-md-6 -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>