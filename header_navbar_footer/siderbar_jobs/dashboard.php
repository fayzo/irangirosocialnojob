             <!-- TABLE OF ADDPOST -->

 <h4 class="display-5 mb-2 text-center">DASH-BOARD</h4>
 <div class="card mb-3">
     <div class="main-active p-3">
         Website Overview
     </div>
     <div class="card-body text-center ">
         <div class="row">
             <div class="col-md-3 mb-2">
                 <div class="card bg-light text-dark">
                     <div class="card-body">
                         <h4 class="card-title"><i class="fa fa-user" aria-hidden="true"></i>
                             <?php echo $users->countUSERS() ;?>
                             </h4>
                         <p class="card-text">Users</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-3 mb-2">
                 <div class="card bg-light text-dark">
                     <div class="card-body">
                         <h4 class="card-title"><i class="fa fa-book" aria-hidden="true"></i>
                            <?php echo $users->countApprovalBusiness(); ?>
                             </h4>
                         <p class="card-text">Approval Business</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-3 mb-2">
                 <div class="card bg-light text-dark">
                     <div class="card-body">
                         <h4 class="card-title"><i class="fa fa-book" aria-hidden="true"></i>
                                <?php echo $users->countUnApprovalBusiness(); ?>
                             </h4>
                         <p class="card-text">UnApproval Business</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-3 mb-2">
                 <div class="card bg-light text-dark">
                     <div class="card-body">
                         <h4 class="card-title"><i class="fa fa-book" aria-hidden="true"></i>
                           <!-- < ?php echo $users->jobCountbusiness(); ?> -->
                             </h4>
                         <p class="card-text">No Of Jobs</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-3 mb-2">
                 <div class="card bg-light text-dark">
                     <div class="card-body">
                         <h4 class="card-title"><i class="fa fa-pen" aria-hidden="true"></i> 
                         <?php echo $users->countPOSTS(); ?>
                         </h4>
                         <p class="card-text">Posts</p>
                     </div>
                 </div>
             </div>
             <div class="col-md-3 mb-2">
                 <div class="card bg-light text-dark">
                     <div class="card-body">
                         <h4 class="card-title"><i class="material-icons md-48"></i> 3435</h4>
                         <p class="card-text">Visitors</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- END OF CARD -->

 <!-- Calendar -->

 <!-- CARD -->
 <div class="card mb-3">
     <div class="card-body">
         <table class="table table-responsive-sm table_adminLA table-hover ">
             <thead class="main-active">
                 <tr>
                     <th>N0</th>
                     <th class="text-center">
                         <i class="icon-people"></i>
                     </th>
                     <th>User</th>
                     <th>Usage</th>
                     <th>Activity</th>
                 </tr>
             </thead>
             <tbody>
                 <?php 
			         $increment= 1;
                     $result= $db->query("SELECT * FROM users");
			       if ($result->num_rows > 0) {
                     while($row= $result->fetch_array()){ ?>
                 <tr>
                     <td><?php echo  $increment++ ; ?></td>
                     <td class="text-center">
                         <div class="avatar">
                             <?php 
                                 if(!empty($row["profile_img"])){?>
                             <img class="img-avatar"
                                 src="assets/image/users_profile_cover/<?php echo $row["profile_img"] ;?>"
                                 width="80px" alt="<?php echo $row["email"] ;?>">
                             <?php }else{?>
                             <img class="img-avatar" src="assets/image/users_profile_cover/defaultprofileimage.png"
                                 width="80px" alt="<?php echo $row["email"] ;?>">
                             <?php } ?>
                             <span class="avatar-status badge-success"></span>
                         </div>
                     </td>
                     <td>
                         <div><?php echo $row["lastname"];?></div>
                         <div class="small text-muted">
                             <span><?php echo $users->lengths($users->timeAgo($row["date_registry"]));?>|Registered :<?php echo $users->timeAgo($row["date_registry"]);?>
                             </span>
                         </div>
                         <!-- -Jan 1, 2015 -->
                     </td>
                     <td>
                         <div class="clearfix">
                             <div class="text-center">
                                 <strong><?php echo $row["counts_login"] * 100 / 1000 ;?>%</strong>
                             </div>
                             <div>
                                 <small
                                     class="text-muted"><?php echo date('M j, Y',strtotime($row["date_registry"]))." - ".date('M j, Y',strtotime($row["last_login"]));?></small>
                                 <!-- Jun 11, 2015 - Jul 10, 2015 -->
                             </div>
                         </div>
                         <div class="progress progress-xs">
                              <?php echo $users->Users_usage_dashboard($row["counts_login"]) ;?>
                         </div>
                     </td>
                     <td>
                         <div class="small text-muted">Last login</div>
                         <small><?php echo $users->timeAgo($row["last_login"]);?></small>
                     </td>
                 </tr>
                 <?php } }?>

             </tbody>
         </table>
     </div>
 </div>