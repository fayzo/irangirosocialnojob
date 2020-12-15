<div role="tabpanel">
  <div class="row">
  
    <div class="col-4 col-md-2 col-lg-2 py-3 px-2" >
      <div class="list-group sticky-top" id="list-tab" role="tablist" style="top: 50px;">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="tab" href="#list-Dashboard" role="tab" aria-controls="list-home">Dashboard</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-settings" role="tab" aria-controls="list-settings">Settings</a>
        <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="tab" href="#list-Logout" role="tab" aria-controls="list-settings">Logout</a>
      </div>
    </div>

    <div class="col-8 col-md-10 col-lg-10 ">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-Dashboard" role="tabpanel" aria-labelledby="list-home-list">
           <?php include "siderbar_jobs/dashboard.php"?>
        </div> <!-- END-OF A LINK OF DASH_BOARD ID=#  -->

        <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
           <?php include "siderbar_jobs/setting.php"?>
        </div> 
        <!-- END-OF A LINK OF setting ID=#  -->

        <div class="tab-pane fade" id="list-Logout" role="tabpanel" aria-labelledby="list-settings-list">
            <?php include "siderbar_jobs/logout.php"?>
        </div> <!-- END-OF A LINK OF logout ID=#  -->
      </div>
    </div>

  </div>
</div>
<!-- Use any element to open the sidenav -->
<!-- <span>open</span> -->

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
<!-- <div id="main">
  ...
</div> -->