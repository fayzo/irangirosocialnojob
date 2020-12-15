
<?php include "header_navbar_footer/header_if_login.php"?>
<!-- < ?php include "header_navbar_footer/Get_usernameProfile.php"?> -->
<title><?php echo $user['username'].' your setting'; ?></title>
<?php include "header_navbar_footer/header.php"?>


      <section class="content-header">
        <div class="row mb-2">
          <div class="col-4">
            <h1><i class="fa fa-setting"></i>Settings</h1>
          </div>
          <div class="col-8">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php if (isset($_SESSION['key'])){ echo HOME ; }else{ echo LOGIN; } ?>">Home</a></li>
                <li class="breadcrumb-item active"><i>
                <button type="button" class="btn btn-primary btn-sm" onclick="location.href='<?php echo BASE_URL_PUBLIC.$user['username'] ;?>'">Profile</button>
            </ol>
          </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

            <div class="col-md-3 mb-3">
                 <!-- Profile Image -->
                 <?php echo $home->userProfile($user_id); ?>
             </div>
             <!-- /.col -->

             <div class="col-md-3 mb-3">
                 <div class="card">
                     <div class="card-body p-0">
                         <div class="list-group " id="list-tab" role="tablist">
                             <a class="list-group-item list-group-item-action active" id="list-Account-list"
                                 data-toggle="tab" href="#list-Account" role="tab" aria-controls="list-Account"><i
                                     class="fa fa-lock"></i> Account</a>
                             <a class="list-group-item list-group-item-action" id="list-Password-list" data-toggle="tab"
                                 href="#list-Password" role="tab" aria-controls="list-Password"><i
                                     class="fa fa-key"></i> Password</a>

                         </div>
                     </div>
                     <!-- /.card-body -->
                 </div>
                 <!-- /.card -->
             </div>
             <!-- /.col -->

             <div class="col-md-3 mb-3">

                 <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="list-Account" role="tabpanel"
                         aria-labelledby="list-home-list">
                         <?php include "settings/account.php"?>
                     </div> <!-- END-OF A LINK OF inbox ID=#  -->
                     <div class="tab-pane fade " id="list-Password" role="tabpanel"
                         aria-labelledby="list-Password-list">
                         <?php include "settings/password.php"?>
                     </div> <!-- END-OF A LINK OF sent ID=#  -->

                 </div>
             </div>
             <!-- /.col -->

        </div>
      </section>
      <!-- /.content -->
      
      
<?php include "header_navbar_footer/footer.php"?>
