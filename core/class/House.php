<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class House extends Home {

     public function houseList($categories,$pages,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*10)-10;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM house H
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
        WHERE H. categories_house ='$categories' ORDER BY H. buy='sold' ,rand() Desc Limit $showpages,10");
        ?>
        <div class="card card-primary mb-3 ">
         <div class="card-header main-active p-1">
            <form class="form-inline float-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <input type="text" class="form-control search0"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                </div>
            </form>
            <h5 class="card-title text-center"><i> House to Search</i></h5>

            <div class="nav-scroller  py-0" style="clear:right;height:2rem;">
                <nav class="nav d-flex justify-content-between pb-0">
                <a class="p-2" href="javascript:void(0)" onclick="houseCategories('House_For_sale',1,<?php echo $user_id ; ?>);">House For sale<span class="badge badge-primary"><?php echo $this->housecountPOSTS('House_For_sale');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="houseCategories('House_For_rent',1,<?php echo $user_id ; ?>);">House For rent<span class="badge badge-primary"><?php echo $this->housecountPOSTS('House_For_rent');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="houseCategories('House_Land',1,<?php echo $user_id ; ?>);">Land & Plots<span class="badge badge-primary"><?php echo $this->housecountPOSTS('House_Land');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="houseCategories('Apartment_For_sale',1,<?php echo $user_id ; ?>);">Apartment For sale<span class="badge badge-primary"><?php echo $this->housecountPOSTS('Apartment_For_sale');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="houseCategories('Apartment_For_rent',1,<?php echo $user_id ; ?>);">Apartment For rent<span class="badge badge-primary"><?php echo $this->housecountPOSTS('Apartment_For_rent');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="houseCategories('Offices_stores',1,<?php echo $user_id ; ?>);">Offices<span class="badge badge-primary"><?php echo $this->housecountPOSTS('Offices_stores');?></span></a>
                </nav>
            </div> <!-- nav-scroller -->
        </div> <!-- card-header -->

        <div class="card-body">
        <span class="job-show"></span>
        <div class="job-hide">
            <ul class="timeline timeline-inverse">  
               <li class="time-label" style="margin-bottom: 0px;">
                        <span style="margin-left: -10px;"> <img src="<?php echo BASE_URL_LINK.'image/banner/discount.png' ;?>" width="80px"> </span>
                        <?php switch ($categories) {
                            case $categories == 'House_For_sale':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'House_For_rent':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo1.png" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'House_Land':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo2.png" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'Apartment_For_sale':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo3.jpg" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'Apartment_For_rent':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo4.jpg" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'Offices_stores':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo4.jpg" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            
                        } ?>
                </li>
                <?php while($house= $query->fetch_array()) { ?>
                    <li class="time-label">
                        <?php echo $this->buychangesColor($house['buy']); ?>
                     
                         <?php if($house['discount'] != 0){ ?>
                            <?php echo $this->PercentageDiscount($house['discount']); ?>
                        <?php }else { echo ''; ?>
                            <!-- <span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> 0% </span>  -->
                        <?php } ?>

                        <div class="timeline-item card flex-md-row shadow-sm h-md-100 border-0">
                        <!-- <img class="card-img-left flex-auto d-none d-lg-block" height="100px" width="100px" src="< ?php echo BASE_URL_PUBLIC.'uploads/house/'.$house['photo'] ;?>" alt="Card image cap"> -->
                        <div class='card-img-left flex-auto d-none d-lg-block' style="background: url('<?php echo BASE_URL_PUBLIC.'uploads/house/'.$house['photo']; ?>')no-repeat center center;background-size:cover;height:100px;width:100px">
                        <?php $banner = $house['banner'];
                        switch ($banner) {
                            case $banner == 'new':
                                # code...
                                echo '<img style="margin-left: -10px;" src="'.BASE_URL_LINK.'image/banner/new.png" height="100px" width="100px">';
                                break;
                            case $banner == 'great_deal':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/great-deal.png" height="100px" width="100px">';
                                break;
                            case $banner == 'new_arrival':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival.png" height="100px" width="100px">';
                                break;
                            case $banner == 'vegetables':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival5.png" height="100px" width="100px">';
                                break;
                            case $banner == 'macedone':
                                # code...
                                echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival5.png" height="100px" width="100px">';
                                break;
                             default:
                                # code...
                                echo '';
                                break;
                        } ?>
                          
                        </div>
                        <div class="card-body pt-0">
                        <span id="response<?php echo $house['house_id']; ?>"></span>
                           <div class="text-primary mb-0">
                              <a class="text-primary float-left" href="javascript:void(0)" id="house-readmore" data-house="<?php echo $house['house_id']; ?>" ><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <!-- < ?php echo $house['provincename']; ?> /  -->
                                <?php echo $house['namedistrict']; ?> District/ 
                                <?php echo $house['namesector']; ?> Sector
                                <!-- < ?php echo $house['nameCell']; ?> Cell  -->
                               </a>
                                
                                <?php if($user_id == $house['user_id3']){ ?>
                                    <ul class="list-inline ml-2  float-right" style="list-style-type: none;">  

                                            <li  class=" list-inline-item">
                                                <ul class="showcartButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px; margin:0px;width:250px;text-align:center;" >
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label class="deleteHouse"  data-house="<?php echo $house["house_id"];?>"  data-user="<?php echo $house["user_id3"];?>">Delete </label>
                                                            </li>

                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label for="">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                        Banner
                                                                        <div class="input-group">
                                                                              <select class="form-control" name="banner" id="banner<?php echo $house["house_id"];?>">
                                                                                <option value="<?php echo $house['banner']; ?>" selected><?php echo $house['banner']; ?></option>
                                                                                <option value="new">New</option>
                                                                                <option value="new_arrival">New arrival</option>
                                                                                <option value="great_deal">Great deal</option>
                                                                                <option value="empty">empty</option>
                                                                              </select>
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >banner</span>
                                                                            </div>
                                                                        </div> <!-- input-group -->
                                                                </div>
                                                            </div>
                                                            </label>
                                                            </li>

                                                          <li style="list-style-type: none; margin:0px;"> 
                                                            <label for="">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                        Sale
                                                                        <div class="input-group">
                                                                              <select class="form-control" name="available" id="available<?php echo $house["house_id"];?>">
                                                                              <?php if ($house['buy'] == 'available') { ?>
                                                                                <option value="available" selected>Available</option>
                                                                                <option value="sold">Sold</option>
                                                                                <option value="empty">empty</option>
                                                                              <?php }else { ?>
                                                                                <option value="sold" selected>Sold</option>
                                                                                <option value="available">Available</option>
                                                                                <option value="empty">empty</option>
                                                                              <?php } ?>
                                                                              </select>
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >sale</span>
                                                                            </div>
                                                                        </div> <!-- input-group -->
                                                                    </label>
                                                                </div>
                                                                <div class="col">
                                                                    discount %
                                                                    <div class="input-group">
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_change" id="discount_change<?php echo $house["house_id"];?>" value="<?php echo $house["discount"];?>">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1" >%</span>
                                                                        </div>
                                                                    </div> <!-- input-group -->
                                                                </div>
                                                            </div>
                                                            </label>
                                                            </li>
                                                            
                                                            <li style="list-style-type: none;"> 
                                                            <label for="discount">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                    discount price
                                                                    <div class="input-group">
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price<?php echo $house["house_id"];?>" value="<?php echo $house["price_discount"];?>">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" style="padding: 0px 10px;" aria-label="Username" aria-describedby="basic-addon1">$</span>
                                                                        </div>
                                                                    </div> <!-- input-group -->
                                                                </div>
                                                                <div class="col">
                                                                        Price
                                                                    <div class="col">
                                                                        </div>
                                                                    <div class="input-group">
                                                                        <input  type="number" class="form-control form-control-sm" name="price" id="price<?php echo $house["house_id"];?>" value="<?php echo $house["price"];?>">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" style="padding: 0px 10px;"
                                                                                aria-label="Username" aria-describedby="basic-addon1" >$</span>
                                                                        </div>
                                                                    </div> <!-- input-group -->
                                                                </div>
                                                            </div>
                                                            </label>
                                                            </li>

                                                            <li style="list-style-type: none;"> 
                                                            <label for="discount" class="update-house-btn" data-house="<?php echo $house["house_id"];?>" data-user="<?php echo $house["user_id3"];?>">submit</label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                    </ul>
                                <?php } ?>

                                <span class="float-right"> 
                                     <?php if($house['price_discount'] != 0){ ?><span class="mr-2 text-danger " style="text-decoration: line-through;"><?php echo number_format($house['price_discount']); ?> Frw</span> <?php } ?><span class="text-primary" > <?php echo number_format($house['price']); ?> Frw</span>
                               </span>
                               <!-- <span class="float-right"> < ?php echo $house['price']; ?> Frw</span> -->
                            </div> 
                            <div class="text-muted clear-float">
                                <span class="float-left"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $categories; ?></span>
                                <span class="float-right mr-5"><i class="fa fa-heart" aria-hidden="true"></i></span></div>
                            <div class="text-muted clear-float">
                                <span><i class="fa fa-clock-o" aria-hidden="true"></i> Created on <?php echo $this->timeAgo($house['created_on3'])." By ".$house['authors']; ?></span>
                            </div>
                            <p class="card-text clear-float">200 m square feet Garden,4 bedroom,2 bathroom, kitchen and cabinet, car parking dapibuseget quame... Continue reading... </p>

                        </div><!-- card-body -->
                        </div><!-- card -->
                    </li>
                    <!-- END timeline item -->
                    <?php }
                    
                    $query1= $mysqli->query("SELECT COUNT(*) FROM house WHERE categories_house ='$categories' ");
                    $row_Paginaion = $query1->fetch_array();
                    $total_Paginaion = array_shift($row_Paginaion);
                    $post_Perpages = $total_Paginaion/10;
                    $post_Perpage = ceil($post_Perpages); ?>    
                    <li>
                        <i class="fa fa-clock-o bg-info text-light"></i>
                    </li>
                  </ul>
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="houseCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="houseCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="houseCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="houseCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 
    }

      public function housecountPOSTS($categories)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM house WHERE categories_house ='$categories' ");
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }


    public function buychangesColor($variable){

    switch ($variable) {
        case $variable == 'available' :
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;"> '.$variable.' </span> ';
            break;

        case $variable == 'sold' :
            # code...
            return '<span class="bg-danger text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;"> '.$variable.' </span> ';
            break;
         default:
            # code...
            echo '';
            break;
        }
    }

      public function houseReadmore($house_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN house H ON H. user_id3 = u. user_id 
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
        WHERE H. house_id = '$house_id' ");
        $row= $query->fetch_array();
        return $row;
    }

     function PercentageDiscount($variable)
    {

    switch ($variable) {
        case $variable <= 10 :
            # code...
            return '<span class="bg-danger text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 20 :
            # code...
            return '<span class="bg-danger text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 30 :
            # code...
            return '<span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 35:
            # code...
            return '<span class="bg-warning text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 40:
            # code...
            return '<span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 50:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 60:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 75:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        default:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px;margin-left: 10px;margin-top: 40px;"> '.$variable.'% </span> ';
            break;
        }

    } 
    
    public function house_getPopupTweet($user_id,$house_id,$house_user_id)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN house H ON H. user_id3 = u. user_id 
        Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
         WHERE H. house_id = $house_id AND H. user_id3 = $house_user_id ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      
    public function deleteLikesHouse($house_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE FROM house WHERE house_id = '{$house_id}' and B. user_id3 = '{$user_id}' ";

        $query1="SELECT * FROM house WHERE house_id = $house_id and user_id3 = $user_id ";

        $result= $mysqli->query($query1);
        $rows= $result->fetch_assoc();

        if(!empty($rows['photo'])){
            $photo=$rows['photo'].'='.$rows['other_photo'];
            $expodefile = explode("=",$photo);
            $fileActualExt= array();
            for ($i=0; $i < count($expodefile); ++$i) { 
                $fileActualExt[]= strtolower(substr($expodefile[$i],-3));
            }
            $allower_ext = array('jpeg', 'jpg', 'png', 'gif', 'bmp', 'pdf' , 'doc' , 'ppt'); // valid extensions
            if (array_diff($fileActualExt,$allower_ext) == false) {
                $expode = explode("=",$photo);
                $uploadDir = DOCUMENT_ROOT.'/uploads/house/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/house/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/house/';
                      unlink($uploadDir.$photo);
            }
        }

        $query= $mysqli->query($query);
        // var_dump("ERROR: Could not able to execute $query.".mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS DELETE</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail to delete !!!</strong>
                </div>');
        }
    }

    public function update_house($banner,$available,$discount_change,$discount_price,$price,$house_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE house SET banner= '$banner', buy = '$available', discount = $discount_change ,price_discount = $discount_price, price = $price WHERE house_id= $house_id ";
        $mysqli->query($query);

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center" style="font-size:12px;padding:2px;">
                    <button class="close" data-dismiss="alert" type="button" style="top:-6px;">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center" style="font-size:12px;padding:2px;">
                    <button class="close" data-dismiss="alert" type="button"  style="top:-6px;">
                        <span>&times;</span>
                    </button>
                    <strong>Fail to Edit !!!</strong>
                </div>');
        }
    }

}

$house = new House();

/*
===========================================
         Notice
===========================================
# You are free to run the software as you wish
# You are free to help yourself study the source code and change to do what you wish
# You are free to help your neighbor copy and distribute the software
# You are free to help community create and distribute modified version as you wish

We promote Open Source Software by educating developers (Beginners)
use PHP Version 5.6.1 > 7.3.20  
===========================================
         For more information contact
=========================================== 
Kigali - Rwanda
Tel : (250)787384312 / (250)787384312
E-mail : shemafaysal@gmail.com

*/
?>