<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title><?php echo $profileData['username'].' your Photos'; ?></title>
<?php include "header_navbar_footer/header.php"?>

<!-- container -->
<div class="container-fluid mb-5 mt-3">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><i>Crop Photos</i></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                    <li class="breadcrumb-item"><button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'">Profile</button></li>
                    <li class="breadcrumb-item active"><i> <?php echo $follow->followBtn($profileData['user_id'],$user_id,$profileData['user_id']) ;?></i></li>
                </ol>
            </div>
        </div>
    </section>

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
                           <h4 class="card-title"> Profile image</h4>
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
                           <h4 class="card-title float-left pl-2 mt-3"><i> CROP Profile image</i></h4>
                     </div> <!-- /.card-header -->
                     <div class="card-body">
                         <div class="row">
                             <div class="col-md-7">
                                  <img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$profileData['profile_img']; ?>" id="cropbox" class="img" /><br />
                             </div>

                             <div class="col-md-5" style="float:right">
                              <div style="float:right">
                                <div id="btn">
                                     <input type='button' id="crop" value='CROP'>
                                </div>
                                <div style="width:100px;height:100px;overflow:hidden;margin-left:5px;margin-top:25px;border:1px black solid">
                                	<img src="<?php echo BASE_URL_LINK."image/users_profile_cover/".$profileData['profile_img']; ?>" id="preview" style="width: 500px; height: 500px; margin-left: -98px; margin-top: -28px;">
                                </div>
                                <div>
                                    <!-- This is the image we're attaching Jcrop to -->
                                    <img src="#" id="cropped_img" style="display: none;border:1px black solid">
                                    <!-- This is the form that our event handler fills -->
                                     <form id='form-crop' method="post" onsubmit="return checkCoords();">
                                         <input type="hidden" id="x" name="x" />
                                         <input type="hidden" id="y" name="y" />
                                         <input type="hidden" id="w" name="w" />
                                         <input type="hidden" id="h" name="h" />
                                         <input type="hidden" name="CROP" value="CROP" />
                                         <input type="hidden" name="src" value="<?php echo $profileData['profile_img']; ?>" />
                                         <input type="button" value="Submit Image" class="btn btn-default btn-inverse mt-2" id="showcropSubmit" style="display: none;"  />
                                     </form>
                                </div>

                              </div>
                             </div><!-- /.col -->
                         </div><!-- /.row -->
                         
                     </div> <!-- /.card-body -->
                 </div> <!-- /.card -->

            </div>
            <!-- /.col-md-6 -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- container -->

<?php include "header_navbar_footer/footer.php"?>