<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Food extends home {

     public function foodcart_item(){

        $mysqli= $this->database;
        $db_handle = $mysqli;
        if(!empty($_POST["actions"])) {
        switch($_POST["actions"]) {
        	case "add":
        		if(!empty($_POST["quantitys"])) {
        			$productByCode = $this->runQuery("SELECT * FROM food WHERE code='" . $_POST["code"] . "'");
        			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["photo_Title_main"], 'code'=>$productByCode[0]["code"], 'quantitys'=>$_POST["quantitys"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["photo"]));
        			
        			if(!empty($_SESSION["foodcart_item"])) {    
        				if(in_array($productByCode[0]["code"],array_keys($_SESSION["foodcart_item"]))) {
        					foreach($_SESSION["foodcart_item"] as $k => $v) {
        							if($productByCode[0]["code"] == $k) {
        								if(empty($_SESSION["foodcart_item"][$k]["quantitys"])) {
        									$_SESSION["foodcart_item"][$k]["quantitys"] = 0;
        								}
        								$_SESSION["foodcart_item"][$k]["quantitys"] += $_POST["quantitys"];
        							}
        					}
        				} else {
        					$_SESSION["foodcart_item"] = array_merge($_SESSION["foodcart_item"],$itemArray);
        				}
        			} else {
        				$_SESSION["foodcart_item"] = $itemArray;
        			}
                }
             exit($this->FoodshowCart_itemSale());
                
        	break;
        	case "remove":
        		if(!empty($_SESSION["foodcart_item"])) {
        			foreach($_SESSION["foodcart_item"] as $k => $v) {
        					if($_POST["code"] == $k)
        						unset($_SESSION["foodcart_item"][$k]);				
        					if(empty($_SESSION["foodcart_item"]))
        						unset($_SESSION["foodcart_item"]);
        			}
                }
             exit($this->FoodshowCart_itemSale());
        	break;
        	case "empty":
        		unset($_SESSION["foodcart_item"]);
        	break;	
        }
        }
    }

     public function FoodshowCart_item(){

        if(isset($_SESSION["foodcart_item"])){
                $total_quantitys = 0;
                $total_price = 0;
            ?>	
            <table class="tbl-cart table table-responsive-sm table-hover table-bordered"  cellpadding="10" cellspacing="1">
            <thead class="main-active">
            <tr>
            <th style="text-align:left;">Name</th>
            <th style="text-align:left;">Code</th>
            <th style="text-align:right;" width="5%">quantitys</th>
            <th style="text-align:right;" width="10%">Unit Price</th>
            <th style="text-align:right;" width="10%">Price</th>
            <th style="text-align:center;" width="5%">Remove</th>
            </tr>	
             </thead>
            <tbody>
            <?php		
                foreach ($_SESSION["foodcart_item"] as $item){
                    $item_price = $item["quantitys"]*$item["price"];
            		?>
            				<tr>
            				<td><img src="<?php echo BASE_URL_PUBLIC ;?>uploads/food/<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
            				<td><?php echo $item["code"]; ?></td>
            				<td style="text-align:right;"><?php echo $item["quantitys"]; ?></td>
            				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
            				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
            				<td style="text-align:center;"><a href="food.php?actions=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveactions"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a></td>
            				</tr>
            				<?php
            				$total_quantitys += $item["quantitys"];
            				$total_price += ($item["price"]*$item["quantitys"]);
            		}
            		?>
            
            <tr>
            <td colspan="2" align="right">Total:</td>
            <td align="right"><?php echo $total_quantitys; ?></td>
            <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
            <td></td>
            </tr>
            </tbody>
            </table>		
              <?php
            } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
            } 
	}
	
    public function FoodshowCart_itemSale(){

        if(isset($_SESSION["foodcart_item"])){
                $total_quantitys = 0;
                $total_price = 0;
            ?>	
            <table class="table table-responsive-sm table-hover table-bordered" id="foodshowcart">
             <thead class="main-active">
               <tr>
               <th style="text-align:center;">Products</th>
               <th style="text-align:center;">Price</th>
               <th style="text-align:center;">Remove</th>
			   </tr>	
			 </thead>
             <tbody class="bg-light">
            <?php		
                foreach ($_SESSION["foodcart_item"] as $item){
                    $item_price = $item["quantitys"]*$item["price"];
            		?>
            		<tr>
                    <td style="background: url('<?php echo BASE_URL_PUBLIC ;?>uploads/food/<?php echo $item["image"]; ?>')no-repeat center center;background-size:contain;height:80px;width:80px;position:relative">
                    <div style="position:absolute;bottom:0px;left:0px;background-color:#0000006e;color:white;width: 100%;"><?php
                    if (strlen($item["name"]) > 12) {
                      echo $item["name"] = substr($item["name"],0,12).'..';
                    }else{
                      echo $item["name"];
                    } ?></div>
                    </td>
            				<td align="right"><?php echo "$ ". number_format($item_price); ?></td>
            				<td align="center">
                                <form method="post" id="form-foodcartitem<?php echo $item['code']; ?>remove" >
                                        <input type="hidden" style="width:30px;" name="actions" value="remove" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $item['code']; ?>" />
                                        <a href="javascript:void(0);" onclick="xxda('remove','<?php echo 'form-foodcartitem'.$item['code'].'remove'; ?>','<?php echo $item['code']; ?>');"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> 
                                </form>
                            </td>
            				</tr>
            				<?php
            				$total_quantitys += $item["quantitys"];
            				$total_price += ($item["price"]*$item["quantitys"]);
            		}
            		?>
            
            <tr>
            <td>Total:</td>
            <td align="left" colspan="2"><strong><?php echo "$ ".number_format($total_price); ?></strong></td>
            </tr>
            </tbody>
            </table>		
              <?php
            } else {
            ?>
            <div class="no-records">Your Cart is Empty</div>
            <?php 
            } 
    }


     public function foodList($categories,$pages,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*10)-10;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM food WHERE categories_food ='$categories' ORDER BY discount > 50 ,rand() Desc Limit $showpages,10");
        ?>
        <div class="card card-primary mb-3 ">
          <?php 
        		// unset($_SESSION["foodcart_item"]);
               //    echo var_dump($_SESSION["foodcart_item"]);
           ?>

         <div class="card-header main-active p-1">
            <form class="form-inline float-right">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i> </span>
                    </div>
                    <input type="text" class="form-control search0"  aria-describedby="helpId" placeholder="Search Accountant, finance ,enginneer">
                </div>
            </form>
            <h5 class="card-title text-center"><i> Food to Search</i></h5>

            <div class="nav-scroller  py-0" style="clear:right;height:2rem;">
                <nav class="nav d-flex justify-content-between pb-0">
                <a class="p-2" href="javascript:void(0)" onclick="foodCategories('food',1,<?php echo $user_id ; ?>);">food<span class="badge badge-primary"><?php echo $this->foodcountPOSTS('food');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="foodCategories('drink',1,<?php echo $user_id ; ?>);">beverage<span class="badge badge-primary"><?php echo $this->foodcountPOSTS('drink');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="foodCategories('fruits',1,<?php echo $user_id ; ?>);">fruits<span class="badge badge-primary"><?php echo $this->foodcountPOSTS('fruits');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="foodCategories('vegetables',1,<?php echo $user_id ; ?>);">vegetable<span class="badge badge-primary"><?php echo $this->foodcountPOSTS('vegetables');?></span></a>
                <a class="p-2" href="javascript:void(0)" onclick="foodCategories('macedone',1,<?php echo $user_id ; ?>);">macedone<span class="badge badge-primary"><?php echo $this->foodcountPOSTS('macedone');?></span></a>
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
                            case $categories == 'food':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'drink':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo1.png" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'fruits':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo2.png" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'vegetables':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo3.jpg" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            case $categories == 'macedone':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo4.jpg" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                            
                        } ?>
                          
                </li>
                     
          <?php while($food= $query->fetch_array()) { ?>
                    <li class="time-label">
                        <?php if($food['discount'] != 0){ ?>
                          <?php echo $this->foodPercentageDiscount($food['discount']); ?>
                        <?php }else { echo ''; ?>
                            <!-- <span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> 0% </span>  -->
                        <?php } ?>

                        <div class="timeline-item card flex-md-row shadow-sm h-md-100 border-0">

                        <div class='card-img-left flex-auto d-none d-lg-block' style="background: url('<?php echo BASE_URL_PUBLIC.'uploads/food/'.$food['photo'] ;?>')no-repeat center center;background-size:cover;height:100px;width:100px">
                        <?php $banner = $food['banner'];
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
                        <span id="response<?php echo $food['food_id']; ?>"></span>
                           <div class="mb-0">
                              <a class="text-primary float-left" href="javascript:void(0)" id="food-readmore" data-food="<?php echo $food['food_id']; ?>" ><?php echo $food['photo_Title_main']; ?></a>
                               <?php if($user_id == $food['user_id3']){ ?>
                                    <ul class="list-inline ml-2  float-right" style="list-style-type: none;">  

                                            <li  class=" list-inline-item">
                                                <ul class="showcartButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px; margin:0px;width:250px;text-align:center;" >
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label class="deletefood"  data-food="<?php echo $food["food_id"];?>"  data-user="<?php echo $food["user_id3"];?>">Delete </label>
                                                            </li>

                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label for="">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                        Banner
                                                                        <div class="input-group">
                                                                              <select class="form-control" name="banner" id="banner<?php echo $food["food_id"];?>">
                                                                                <option value="<?php echo $food['banner']; ?>" selected><?php echo $food['banner']; ?></option>
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
                                                                    discount %
                                                                    <div class="input-group">
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_change" id="discount_change<?php echo $food["food_id"];?>" value="<?php echo $food["discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price<?php echo $food["food_id"];?>" value="<?php echo $food["price_discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="price" id="price<?php echo $food["food_id"];?>" value="<?php echo $food["price"];?>">
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
                                                            <label for="discount" class="update-food-btn" data-food="<?php echo $food["food_id"];?>" data-user="<?php echo $food["user_id3"];?>">submit</label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                    </ul>
                                <?php } ?>
                               <span class="float-right"> <?php if($food['price_discount'] != 0){ ?><span class="mr-2 text-danger " style="text-decoration: line-through;"><?php echo number_format($food['price_discount']); ?> Frw</span> <?php } ?><span class="text-primary" > <?php echo number_format($food['price']); ?> Frw</span></span>
                            </div> 
                            <div class="text-muted clear-float">
                                <span class="float-left"><i class="fa fa-cutlery" aria-hidden="true"></i>  <?php echo $categories; ?></span>
                                <span class="float-right mr-5"><i class="fa fa-heart" aria-hidden="true"></i></span></div>
                            <div class="text-muted clear-float">
                                <span><i class="fa fa-clock-o mt-1" aria-hidden="true"></i> Created on <?php echo $this->timeAgo($food['created_on3'])." By ".$food['authors']; ?></span>
                                <form method="post" id="form-foodcartitem<?php echo $food['code']; ?>add" class="float-right">
                                    <div style="display:inline-flex;" >
                                         <input type="hidden" style="width:30px;" name="actions" value="add" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $food['code']; ?>" />
                                        <input type="text" class="form-control form-control-sm text-center mr-2" style="width:30px;" name="quantitys" value="1" size="2" readonly/>
                                        <input type="button" onclick="xxda('add','<?php echo 'form-foodcartitem'.$food['code'].'add'; ?>','<?php echo $food['code']; ?>');" value="Add to Cart" class="btn btn-outline-success btn-sm " />
                                    </div>
                                </form>
                            </div>
                            <p class="card-text clear-float">200 m square feet Garden,4 bedroom,2 bathroom, kitchen and cabinet, car parking dapibuseget quame... Continue reading... </p>

                        </div><!-- card-body -->
                        </div><!-- card -->
                    </li>
                    <!-- END timeline item -->
                    <?php }
                    
                    $query1= $mysqli->query("SELECT COUNT(*) FROM food WHERE categories_food ='$categories' ");
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
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="foodCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="foodCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="foodCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="foodCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 
    }

      public function foodcountPOSTS($categories)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM food WHERE categories_food ='$categories' ");
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
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.' </span> ';
            break;

        case $variable == 'sold' :
            # code...
            return '<span class="bg-danger text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.' </span> ';
            break;
         default:
            # code...
            echo '';
            break;
        }
    }

      public function foodReadmore($food_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN food F ON F. user_id3 = u. user_id WHERE F. food_id = '$food_id' ");
        $row= $query->fetch_array();
        return $row;
    }

    function foodPercentageDiscount($variable)
    {

    switch ($variable) {
        case $variable <= 10 :
            # code...
            return '<span class="bg-danger text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 20 :
            # code...
            return '<span class="bg-danger text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 30 :
            # code...
            return '<span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 35:
            # code...
            return '<span class="bg-warning text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 40:
            # code...
            return '<span class="bg-info text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 50:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 60:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        case $variable <= 75:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        default:
            # code...
            return '<span class="bg-success text-light" style="position: absolute;font-size: 11px; padding: 2px; margin-left: 10px;"> '.$variable.'% </span> ';
            break;
        }

    }

     
    public function food_getPopupTweet($user_id,$food_id,$food_user_id)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN food B ON B. user_id3 = u. user_id WHERE B. food_id = $food_id AND B. user_id3 = $food_user_id ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }

      
    public function deleteLikesfood($tweet_id)
    {
        $mysqli= $this->database;
        $query="DELETE B , L ,C ,R FROM events B 
                        LEFT JOIN events_like L ON L. like_on = B. events_id 
                        LEFT JOIN events_comment_like C ON C. like_on_ = B. events_id 
                        LEFT JOIN events_comment R ON R. comment_on = B. events_id 
                        WHERE B. events_id = '{$tweet_id}' and B. user_id3 = '{$user_id}' ";

        $query1="SELECT * FROM events WHERE events_id = $tweet_id and user_id3 = $user_id ";

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
                $uploadDir = DOCUMENT_ROOT.'/uploads/events/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/events/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/events/';
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

    public function update_food($banner,$discount_change,$discount_price,$price,$food_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE food SET banner= '$banner', discount = $discount_change ,price_discount = $discount_price, price = $price WHERE food_id= $food_id ";
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

$food = new Food();
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