<header class="main-header">
      <!-- Logo -->
      <a href="<?php echo HOME ;?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>IR</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Irangiro </b>LTD</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-expand navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="sidebar-toggle_" href="<?php echo HOME ;?>">
          <i class="fa fa-home"> </i>
          <span class="hidden-xs">Home</span>
          </a>

    <?php if (isset($_SESSION['key'])){ ?>
        
        <a class="sidebar-toggle_ addPostBtn" href="#">
          <i class="fa fa-pencil"></i>
          <span class="hidden-xs">Post</span>
         </a>
        <!-- <a class="sidebar-toggle_" href="jobs.php">
          <i class="fa fa-star"> </i>
          <span class="hidden-xs">Jobs</span>
          </a> -->
        <a class="sidebar-toggle_" href="<?php echo NETWORK ;?>">
          <i class="fa fa-users"> </i>
          <span class="hidden-xs">Network</span>
         </a>

        <div class="navbar-custom-menu ml-auto">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li class="dropdown messages-menu">
              <a href="#" data-toggle="dropdown" id="messages-dropdown-menu">
                <i class="fa fa-envelope-o"></i>
                <span id="messages1"><?php if( $notific['totalmessage'] > 0){echo '<span  class="badge badge-success">'.$notific['totalmessage'].'</span>'; } ?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header main-active">You have <span><?php if( $notific['totalmessage'] > 0){echo '<span>'.$notific['totalmessage'].'</span>'; }else{ echo 'no' ;} ?></span> messages</li>
                <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu large-2" id="messages-menu-view" >
                    <!-- <li>
                      start message
                      <a href="#">
                        <div class="pull-left">
                          <img src="user2-160x160.jpg" class="rounded-circle" alt="User Image">
                        </div>
                        <h4>
                          Support Team
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                      </a>
                    </li> -->
                    <!-- end message -->
                  </ul>
                </li>
                <li class="footer"  id='messagePopup'><a href="#">See All Messages</a></li>
              </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <li class="dropdown notifications-menu">
            <a href="#" data-toggle="dropdown" id="notification-dropdown-menu">
              <i class="fa fa-bell-o"></i>
             <span id="notification1"><?php if( $notific['totalnotification'] > 0){echo '<span class="badge badge-warning navbar-badge">'.$notific['totalnotification'].'</span>'; } ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header main-active">You have  <span ><?php if($notific['totalnotification'] > 0){echo '<span >'.$notific['totalnotification'].'</span>'; }else{ echo 'no';} ?></span> notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu large-2" id="notification-menu-view">
                </ul>
              </li>
              <li class="footer"><a href="<?php echo BASE_URL_PUBLIC ;?>i.notifications" >View all</a></li>
            </ul>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="hidden-xs">
              <form action="#" method="get" class="sidebar-form" style="margin-top: 5px;">
                <div class="input-group input-group-sm">
                  <input type="text" name="search" id="search" class="form-control  search formnnavbar" placeholder="Search...">
                  <span class="input-group-btn">
                    <button type="button" name="search" class="btn btn-flat formnnavbar">
                      <i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
                <div class="search-result"></div>
              </form>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if (!empty($user['profile_img'])) { ?>
                <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="user-image rounded-circle" alt="User Image">
                <?php  }else{ ?>
                  <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="user-image rounded-circle" alt="User Image">
                <?php } ?>
                <span class="hidden-xs"><span id="welcome-json"></span> <?php echo $_SESSION['username'];?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <?php if (!empty($user['cover_img'])) { ?>
                <li class="user-header" style="background: url('<?php echo BASE_URL_LINK ;?>image/users_cover_profile/<?php echo $user['cover_img'] ;?>') center center;background-size: cover; overflow: hidden; width: 100%;">
                  <?php }else{ ?>
                <li class="user-header" style="background: url('<?php echo BASE_URL_LINK.NO_COVER_IMAGE_URL ;?>') center center;background-size: cover; overflow: hidden; width: 100%;">
                <?php  } ?>

                <?php if (!empty($user['profile_img'])) { ?>
                  <img src="<?php echo BASE_URL_LINK ;?>image/users_profile_cover/<?php echo $user['profile_img'] ;?>" class="rounded-circle" alt="User Image">
                  <?php }else{ ?>
                  <img src="<?php echo BASE_URL_LINK.NO_PROFILE_IMAGE_URL ;?>" class="rounded-circle" alt="User Image">
                <?php  } ?>
                
                  <p>
                    <?php echo $_SESSION['username'];?> - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                    <div class="col-4 text-center">
                      <a href="<?php echo SETTINGS;?>">Settings</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="<?php echo PROFILE_EDIT;?>">Profile Edit</a>
                    </div>
                    <div class="col-4 text-center">
                      <a href="<?php echo BASE_URL_PUBLIC.$user['username'];?>">Profile</a>
                    </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer main-active">
                  <div class="pull-left">
                    <a href="<?php echo BASE_URL_PUBLIC.$user['username'];?>" class="btn btn-info btn-sm">Profile</a>
                  </div>
                  <div class="pull-right">
                    <!-- <a href="< ?php echo LOGOUT;?>" class="btn btn-danger btn-sm ">Sign out</a> -->
                    <a href="javascript:void(0)" id="logout-please" class="btn btn-danger btn-sm ">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <?php if(isset($_SESSION['approval']) && $_SESSION['approval'] === 'on'){ ?>

            <li class="hidden-xs">
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
                 <?php } ?>
          </ul>
        </div>
          <?php }else{ ?>
              <a style="color:white;border: none;" class="btn btn-sm btn-outline-success ml-auto" id="login-please" data-login="1" href="javascript:void(0)">
              <i class="fa fa-user" aria-hidden="true"></i> login</a>
          <?php } ?>
      </nav>
    </header>
    <div class="progress progress-navbar m-0 fixed-top" style="height: 6px;display:none">
        <span class="progress-bar bg-info" role="progressbar"
            style="width:0%;" id="progress_width" aria-valuenow="" aria-valuemin="0"
            aria-valuemax="100"></span>
    </div>