
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' your Profile-edit'; ?></title>
<?php include "header_navbar_footer/header.php"?>


      <section class="content">
        <div class="container-fuild">
          <div class="row">
            <div class="col-12">
                <div class="card-widget widget-user">
                    <!-- Background-cover image -->
                    <?php if (!empty($user['cover_img'])) {?>
                    <div class="img-cover-profileEdit  text-white" style="background: url('<?php echo BASE_URL_LINK."image/users_cover_profile/".$user['cover_img'] ;?>')no-repeat center center;background-size:cover;">
                    <?php  }else{ ?>
                        <div class="img-cover-profileEdit  text-white" style="background: url('<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>')no-repeat center center;background-size:cover;">
                    <?php } ?>
                        <div class="profile-upload" >
                            <!-- Hidden upload form -->
                            <form method="post" action="<?php echo BASE_URL_PUBLIC;?>core/ajax_db/profileEdit.php"
                                enctype="multipart/form-data" id="cover_picUploadForm" target="cover_uploadTarget">

                                <input type="hidden" name="edit_cover" id="edit_cover"
                                    value="<?php echo $_SESSION['key'];?>" style="display:none" />
                                <input type="file" name="cover_picture" id="cover_fileInput" style="display:none" />
                            </form>
                            <iframe id="cover_uploadTarget" name="cover_uploadTarget" src="#"
                                style="width:0;height:0;border:0px solid black;"></iframe>
                            <!-- Image update link -->
                            <!-- Profile image -->
                            <div class="text-center img-placeholders">
                                <h1>Update Cover image</h1>
                            </div>
                            <!-- Image update link -->
                            <a href="javascript:void(0);" class="img-cover-iconLinks" id="edit_linkCoverUpload">
                                <i class="fa fa-camera" aria-hidden="true"></i> </a>
                            <!-- Profile image -->
                            <!-- <img id="cover_imagePreview" class="cover_imagePreview" src="assets/image/users_profile_cover/<?php echo $row['cover_img'] ;?>"> -->
                            <img id="cover_imagePreview" class="cover_imagePreview" >
                            <!-- src="<?php echo BASE_URL_LINK ;?>image/img/photo1.png" -->
                        </div>

                        <h3 class="widget-user-usernames">Elizabeth Pierce</h3>
                        <h5 class="widget-user-descs">Web Designer</h5>
                    </div>
                    <!-- END OF Background-cover image -->

                    <!-- START OF PROFILE EDIT IMAGE CONTENT -->
                    <div class="img-relative">
                        <div class="profile-upload">
                            <!-- Hidden upload form -->
                            <form method="post" action="<?php echo BASE_URL_PUBLIC;?>core/ajax_db/profileEdit.php"
                                enctype="multipart/form-data" id="picUploadForm" target="uploadTarget">

                                <input type="hidden" name="edit_profile" id="edit_profile"
                                    value="<?php echo $_SESSION['key'];?>" style="display:none" />
                                <input type="file" name="picture" id="fileInput" style="display:none" />
                            </form>

                            <iframe id="uploadTarget" name="uploadTarget" src="#"
                                style="width:0;height:0;border:0px solid black;"></iframe>
                            <!-- Profile image -->
                            <div class="text-center img-placeholder">
                                <h4>Update image</h4>
                            </div>
                            <!-- Image update link -->
                            <a href="javascript:void(0);" class="img-upload-iconLinks" id="edit_linkUpload">
                                <i class="fa fa-camera" aria-hidden="true"></i> </a>
                                <?php if (!empty($user['profile_img'] )) {?>
                                        <img class="rounded-circle" id="imagePreview" src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'] ;?>">
                                <?php  }else{ ?>
                                        <img class="rounded-circle" id="imagePreview" src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>">
                                <?php } ?>
                            <!-- <img class="rounded-circle" src="<?php echo BASE_URL_LINK ;?>image/img/user3-128x128.jpg"
                                alt="User Avatar"> -->
                        </div>
                    </div>
                    <!-- END OF PROFILE EDIT IMAGE CONTENT -->

                    <!-- <div class="widget-user-image">
                        <img class="rounded-circle" src="<?php echo BASE_URL_LINK ;?>image/img/user3-128x128.jpg"
                            alt="User Avatar">
                    </div> -->
                    <div class="widget-user-image-under">
                    </div>
                    <div class="card-footer">
                      <div class="description">
                            <h5 class="description-header count-followers"><?php echo $user['followers']; ?></h5>
                            <span class="description-text"><a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.followers' ;?>">FOLLOWERS</a></span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description ">
                            <h5 class="description-header count-following"><?php echo $user['following']; ?></h5>
                            <span class="description-text"><a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.following' ;?>"> FOLLOWING</a></span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description">
                            <h5 class="description-header"> <?php echo $home->countsPosts($user['user_id']);?></h5>
                            <span class="description-text"><a href="<?php echo BASE_URL_PUBLIC.$user['username'].'.posts' ;?>"> POSTS</a></span>
                        </div>
                        <!-- /.description-block -->
                        <!-- /.description-block -->
                        <div class="description">
                            <h5 class="description-header"> <?php echo $home->countsLike($user['user_id']);?></h5>
                            <span class="description-text">LIKES</span>
                        </div>
                        <!-- /.description-block -->
                        <div class="description">
                            <h5 class="description-header"><?php echo $user['countViewin_profile'] ;?></h5>
                            <span class="description-text">VIEWS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.footer -->
                </div>
                <!-- /. card widget-user -->
            </div>
            <!-- column -->
        </div>
        <!-- row -->
      </div>
      </section>

      <section class="content-header">
        <div class="row">
            <div class="col-6">
                <h1><i> Profile Edit</i></h1>
            </div>
            <div class="col-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                    <li class="breadcrumb-item active"><i>
                    <button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'">Profile</button>
                    </i></li>
                </ol>
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">

      <div class="row">

        <div class="col-md-3 mb-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline borders-tops mb-3">
                <div class="card-body box-profile">
                    <div class="text-center">
                    <?php if (!empty($user['profile_img'] )) {?>
                        <img class="profile-user-img img-fluid rounded-circle"
                            src='<?php echo BASE_URL_LINK."image/users_profile_cover/".$user['profile_img'] ;?>'
                            alt="User profile picture">
                    <?php  }else{ ?>
                        <img class="profile-user-img img-fluid rounded-circle"
                            src='<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>'
                            alt="User profile picture">
                    <?php } ?>
                    </div>

                    <h3 class="profile-username text-center"><?php echo $user['firstname']." ".$user['lastname'] ;?></h3>

                    <p class="text-muted text-center"><?php echo $user['career'] ;?></p>

                    <hr>
                    <form method="post">
                        <div class="form-group">

                            <label for="firstname">Firstname :</label>
                            <input type="hidden" name="id_career" id="id_career"
                            value="<?php echo $_SESSION['key'];?>" style="display:none" />
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="firstname" id="firstname"
                                    aria-describedby="helpId" value="<?php echo $user['firstname']; ?>" placeholder="Firstname">
                                    <span id="response"></span>
                            </div>

                            <label for="lastname">Lastname :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="lastname" id="lastname"
                                    aria-describedby="helpId" value="<?php echo $user['lastname']; ?>"  placeholder="Lastname">
                                    <span id="response"></span>
                            </div>

                            <label for="specialize">Career :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-star"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="career" id="career"
                                    aria-describedby="helpId" value="<?php echo $user['career']; ?>"  placeholder="Specialize">
                                    <span id="response"></span>
                                </div>
                            </div>
                            <a href="javascript:void(0);" data-user="<?php echo $_SESSION['key']; ?>" class="profile-edit-more float-right">Edit more</a>
                            <button type="button" onclick="careers('career');" class="btn main-active btn-block"><b>Submit</b></button>
                            <span id="respone-success"></span>
                    </form>

                    <!-- btn-primary -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary mb-3 sticky-top" style="top: 52px;">
                <div class="card-header main-active p-1">
                    <h5 class="card-title text-center"><i> About Me</i></h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <input type="hidden" name="id_aboutMe" id="id_aboutMe"
                            value="<?php echo $_SESSION['key'];?>" style="display:none" />
                            <label for="education"><strong><i class="fa fa-book mr-1"></i> Education</strong>
                                :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-book"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="education" id="education"
                                    aria-describedby="helpId" value="<?php echo $user['education'];?>"
                                    placeholder="High school , College or University ">
                            </div>
                            <hr>

                            <label for="education"><strong><i class="fa fa-book mr-1"></i> Diploma/Degree/PhD</strong>
                                :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-book"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="diploma" id="diploma"
                                    aria-describedby="helpId" value="<?php echo $user['diploma'] ;?>"
                                    placeholder="B.S. in Computer Science from the University of Tennessee at Knoxville">
                            </div>
                            <hr>

                            <label for="location"><strong><i class="fa fa-map-marker mr-1"></i>
                                    Location</strong> :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="fa fa-map-marker"></i></span>
                                </div>
                                <input type="text" class="form-control" name="location" id="location"
                                    aria-describedby="helpId" value="<?php echo $user['location'] ;?>" placeholder="Kigali, Rwanda">
                            </div>
                            <hr>

                            <label for="password"><strong><i class="fa fa-pencil mr-1"></i> Skills</strong>
                            </label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="fa fa-pencil"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="skills" id="skills"
                                    aria-describedby="helpId" value="<?php echo $user['skills'] ;?>"
                                    placeholder='UI Design ,Coding ,Javascript ,PHP ,Node.js'>
                            </div>
                            <hr>
                            <label for="password"><strong><i class="fa fa-file-text-o mr-1"></i>
                                    Hobby</strong></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="fa fa-file-text-o"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="hobbys" id="hobbys"
                                    aria-describedby="helpId" value="<?php echo $user['hobbys'] ;?>"
                                    placeholder='studying ,played ,Dance ,Read.....'>
                            </div>
                            <!-- <a href="javascript:void(0);" data-user="< ?php echo $_SESSION['key']; ?>" class="profile-edit-more float-right">Edit more</a> -->
                            <hr>
                        </div> <!-- FORM-GROUP -->
                        <button type="button" onclick="aboutMe('aboutme');" class="btn main-active btn-block"><b>Submit</b></button>
                          <span id="responses"></span>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-6">
            <div class="row">

                <div class="col-md-12 mb-4">
                    <!-- Box Comment -->
                    <div class="card borders-tops card-profile card1">
                        <div class="card-body">
                              <?php echo $home->getUserTweet($user_id,$user_id) ;?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.col-md-6 -->

        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <!-- whoTofollow: user whoTofollow style 1 -->
                    <?php $follow->whoTofollow($user['user_id'],$user['user_id'])?>
                </div>
                <!-- /. col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.col-md-3 -->

        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->

<?php include "header_navbar_footer/footer.php"?>
