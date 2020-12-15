 <!-- Content Wrapper. Contains page content -->
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1><i class="fa fa-setting"></i>Configuration</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Settings</a></li>
                     <li class="breadcrumb-item active">Account</li>
                 </ol>
             </div>
         </div>
     </section>

     <section class="content">
         <div class="row">
             <div class="col-md-3 mb-3">

                 <div class="card">
                     <div class="card-header main-active folders p-1">
                         <h4 class="card-title text-center"><i>Settings</i></h4>

                         <div class="card-tools">
                             <button type="button" class="btn btn-tool btn-sm" data-target="#collapseExample7"
                                 data-toggle="collapse"><i class="fa fa-minus"></i>
                             </button>
                         </div>
                     </div>

                     <div class="collapse show" id="collapseExample7">
                         <div class="card-body p-0">
                             <div class="list-group " id="list-tab" role="tablist">
                                 <a class="list-group-item list-group-item-action active" id="list-Account-list"
                                     data-toggle="tab" href="#list-Account" role="tab" aria-controls="list-Account"><i
                                         class="fa fa-lock"></i> Account</a>
                                 <a class="list-group-item list-group-item-action" id="list-Password-list"
                                     data-toggle="tab" href="#list-Password" role="tab" aria-controls="list-Password"><i
                                         class="fa fa-key"></i>  Password</a>

                             </div>
                         </div>
                         <!-- /.card-body -->
                     </div>
                     <!-- end of collapse -->
                 </div>
                 <!-- /.card -->
             </div>
             <!-- /.col -->

             <div class="col-md-9 mb-3" >

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
         <!-- /.row -->
     </section>
     <!-- /.content -->