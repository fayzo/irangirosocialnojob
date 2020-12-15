
<!-- < ?php include "header_navbar_footer/header_if_login.php"?> -->
<?php include "header_navbar_footer/Get_usernameProfile.php"?>
<title>Network</title>
<?php include "header_navbar_footer/header.php"?>


            <!-- Main content -->
            <section class="content-header">
                <div class="row">
                    <div class="col-6">
                        <h3>Network</h3>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo HOME ;?>">Home</a></li>
                            <?php if (isset($_SESSION['key'])){ ?>
                            <?php if ($profileData['user_id'] != $_SESSION['key']) { ?>
                            <li class="breadcrumb-item"><span class="people-message more" data-user="<?php echo $profileData['user_id'];?>"><a href="javascript:void(0);" ><i style="font-size: 20px;" class="fa fa-envelope-o"></i> Message </a></span></li>
                            <?php } } ?>
                        </ol>
                   </div>
                </div>
            </section>

    
            <!-- Main content -->
            <section class="content">
                <div class="row">

                    <div class="col-md-3 mb-3 d-none d-md-block">
                        <div class="mb-2">
                            <?php echo $home->userProfile($user_id); ?>
                        </div>
                        <?php echo $trending->trends(); ?>
                        <!-- Profile Image -->
                        <!-- jobs -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-9" id="Follow-view">
                            <?php $follow->Network_FollowingLists(1,$user_id,$user['user_id']); ?>
                    </div>
                    <!-- /.col-md-6 -->
                
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->
           
           
 <?php include "header_navbar_footer/footer.php"?>
