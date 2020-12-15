<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 } 

class Gurisha extends Home {

     public function cart_gurisha_item()
    {
        $mysqli= $this->database;
        $db_handle = $mysqli;
        if(!empty($_REQUEST["action_gurisha"])) {
        switch($_REQUEST["action_gurisha"]) {
        	case "add":
        		if(!empty($_REQUEST["quantity"])) {
        			$productByCode = $this->runQuery("SELECT * FROM sale_gurisha WHERE code='" . $_REQUEST["code"] . "'");
        			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["title"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["photo"]));
        			
        			if(!empty($_SESSION["cart_item_gurisha"])) {    
        				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item_gurisha"]))) {
        					foreach($_SESSION["cart_item_gurisha"] as $k => $v) {
        							if($productByCode[0]["code"] == $k) {
        								if(empty($_SESSION["cart_item_gurisha"][$k]["quantity"])) {
        									$_SESSION["cart_item_gurisha"][$k]["quantity"] = 0;
        								}
        								$_SESSION["cart_item_gurisha"][$k]["quantity"] += $_REQUEST["quantity"];
        							}
        					}
        				} else {
        					$_SESSION["cart_item_gurisha"] = array_merge($_SESSION["cart_item_gurisha"],$itemArray);
        				}
        			} else {
        				$_SESSION["cart_item_gurisha"] = $itemArray;
        			}
            }
             exit($this->showCart_gurisha_itemSale());
        	break;
        	case "remove":
        		if(!empty($_SESSION["cart_item_gurisha"])) {
        			foreach($_SESSION["cart_item_gurisha"] as $k => $v) {
        					if($_REQUEST["code"] == $k)
        						unset($_SESSION["cart_item_gurisha"][$k]);				
        					if(empty($_SESSION["cart_item_gurisha"]))
        						unset($_SESSION["cart_item_gurisha"]);
        			}
            }
             exit($this->showCart_gurisha_itemSale());
        	break;
        	case "empty":
        		unset($_SESSION["cart_item_gurisha"]);
        	break;	
        }
        }

        if(!empty($_REQUEST["action_gurisha0"])) {
        switch($_REQUEST["action_gurisha0"]) {
        	case "add":
        		if(!empty($_REQUEST["quantity"])) {
        			$productByCode = $this->runQuery("SELECT * FROM sale_gurisha WHERE code='" . $_REQUEST["code"] . "'");
        			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["title"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_REQUEST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["photo"]));
        			
        			if(!empty($_SESSION["cart_item_gurisha"])) {    
        				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item_gurisha"]))) {
        					foreach($_SESSION["cart_item_gurisha"] as $k => $v) {
        							if($productByCode[0]["code"] == $k) {
        								if(empty($_SESSION["cart_item_gurisha"][$k]["quantity"])) {
        									$_SESSION["cart_item_gurisha"][$k]["quantity"] = 0;
        								}
        								$_SESSION["cart_item_gurisha"][$k]["quantity"] += $_REQUEST["quantity"];
        							}
        					}
        				} else {
        					$_SESSION["cart_item_gurisha"] = array_merge($_SESSION["cart_item_gurisha"],$itemArray);
        				}
        			} else {
        				$_SESSION["cart_item_gurisha"] = $itemArray;
        			}
            }
             exit($this->showCart_gurisha_item());
        	break;
        	case "remove":
        		if(!empty($_SESSION["cart_item_gurisha"])) {
        			foreach($_SESSION["cart_item_gurisha"] as $k => $v) {
        					if($_REQUEST["code"] == $k)
        						unset($_SESSION["cart_item_gurisha"][$k]);				
        					if(empty($_SESSION["cart_item_gurisha"]))
        						unset($_SESSION["cart_item_gurisha"]);
        			}
            }
             exit($this->showCart_gurisha_item());
        	break;
        	case "empty":
        		unset($_SESSION["cart_item_gurisha"]);
        	break;	
        }
        }
    }

    public function categories_sale($categories_sale)
    {
        $mysqli= $this->database;
        $query = $mysqli->query("SELECT * FROM users U Left JOIN sale S ON S. user_id01 = U. user_id WHERE S. categories_sale = '{$categories_sale}' ORDER BY created_on01 Desc ");
        
        while($row=$query->fetch_assoc()) {
        ?>
                <div class="ml-1 mb-3 float-left" style="width: 252px;">

                  <div class="card">
                    <div width="252px" height="178px"><img src="<?php echo BASE_URL_PUBLIC."uploads/sale-gurisha/".$row["photo"]; ?>" width="252px" height="178px" ></div>
                      <div class="card-body">
                          <div class="card-title"><?php echo $row["title"]; ?></div> <!-- product-title -->
                          <p class="card-text product-price"><?php echo "$".$row["price"]; ?></p>
                          <form method="post" action="gurisha.php?action_gurisha=add&code=<?php echo $row["code"]; ?>">
               	      	  <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" readonly/><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                          </form>
                      </div><!-- card-body -->
                  </div><!-- card -->

                </div><!-- col -->
    <?php }
    }

     public function cart_gurisha_List($categories,$pages,$user_id)
    {
        $pages= $pages;
        $categories= $categories;
        
        if($pages === 0 || $pages < 1){
            $showpages = 0 ;
        }else{
            $showpages = ($pages*10)-10;
        }
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN sale_gurisha S ON S. user_id01 = U. user_id WHERE S. categories_sale = '{$categories}' ORDER BY created_on01 Desc Limit $showpages,10");
        ?>
        <div class="mb-3 ">
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
            <h5 class="card-title text-center"><i> Items to Search</i></h5>

            <div class="nav-scroller  py-0" style="clear:right;height:2rem;">
                <nav class="nav d-flex justify-content-between pb-0">
                <a class="p-2 text-light active" href="javascript:void(0)" data-toggle="tab" role="tab" onclick="cart_gurisha_ItemsCategories('electronics',1);">Electronics<span class="badge badge-primary"><?php echo $this->cart_gurisha_countPOSTS('electronics');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cart_gurisha_ItemsCategories('clothes',1);">Clothes<span class="badge badge-primary"><?php echo $this->cart_gurisha_countPOSTS('clothes');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cart_gurisha_ItemsCategories('sports',1);">Sports<span class="badge badge-primary"><?php echo $this->cart_gurisha_countPOSTS('sports');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cart_gurisha_ItemsCategories('health_beauty',1);">Health Beauty<span class="badge badge-primary"><?php echo $this->cart_gurisha_countPOSTS('health_beauty');?></span></a>
                <a class="p-2 text-light" href="javascript:void(0)" onclick="cart_gurisha_ItemsCategories('home_garden',1);">Home Garden<span class="badge badge-primary"><?php echo $this->cart_gurisha_countPOSTS('home_garden');?></span></a>
                </nav>
            </div> <!-- nav-scroller -->
        </div> <!-- card-header -->

        <div>
        <span class="job-show"></span>
        <div class="job-hide">
                        <div>
                      <span> <img src="<?php echo BASE_URL_LINK.'image/banner/discount.png' ;?>" width="80px"> </span>
                        <?php switch ($categories) {
                            case $categories == 'electronics':
                                # code...
                                echo '
                                <img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                                <img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                                <img src="'.BASE_URL_LINK.'image/banner/banners1.png" width="200px">
                                    ';
                                break;
                            case $categories == 'clothes':
                                # code...
                                echo '
                                <img src="'.BASE_URL_LINK.'image/img/photo1.png" width="200px">
                                <img src="'.BASE_URL_LINK.'image/img/photo1.png" width="200px">
                                    ';
                                break;
                            case $categories == 'sports':
                                # code...
                                echo '
                                <img src="'.BASE_URL_LINK.'image/img/photo2.png" width="200px">
                                <img src="'.BASE_URL_LINK.'image/img/photo2.png" width="200px">
                                    ';
                                break;
                            case $categories == 'health_beauty':
                                # code...
                                echo '
                                <img src="'.BASE_URL_LINK.'image/img/photo3.jpg" width="200px">
                                <img src="'.BASE_URL_LINK.'image/img/photo3.jpg" width="200px">
                                    ';
                                break;
                            case $categories == 'home_garden':
                                # code...
                                echo '<img src="'.BASE_URL_LINK.'image/img/photo4.jpg" width="200px">
                                      <img style="float: right;margin-top:15px;margin-right:25px;" src="'.BASE_URL_LINK.'image/banner/weekPrice.png" width="200px">
                                    ';
                                break;
                        } ?>
                        </div>

                <div class="row">
                <div class="col-md-12 pr-0">
                    
          <?php while($row= $query->fetch_array()) { ?>

                         <div class="mr-3 mb-3 float-left" style="width: 260px;height:276px;">
                        <!-- //   width: 252px;height:178px -->
                         <!-- <div class="col-md-3"> -->

                          <div class="card">
                            <div class="card-img-top img-fuild" id="sale_gurishaPreview<?php echo $row['sale_id']; ?>" style="background: url('<?php echo BASE_URL_PUBLIC ;?>uploads/sale-gurisha/<?php echo $row["photo"]; ?>')no-repeat center center;background-size:contain;height:178px;width:260px;position:relative" >
                            <!-- <div class="card-img-top img-fuild" id="sale_gurishaPreview< ?php echo $row['sale_id']; ?>" style="width:260px;height:178px;text-align: center;z-index:1;">
                                 <img src="< ?php echo BASE_URL_PUBLIC."uploads/sale-gurisha/".$row["photo"]; ?>" height="178px">
                            </div>
                            <div class="card-img-top img-fuild" id="sale_gurishaPreview< ?php echo $row['sale_id']; ?>" style="position:absolute;z-index:2;"> -->

                                <?php $banner = $row['banner'];
                                      switch ($banner) {
                                          case $banner == 'new':
                                              # code...
                                              echo '<img style="margin-left: -12px;" src="'.BASE_URL_LINK.'image/banner/new.png"  width="138px" height="138px"  >';
                                              break;
                                          case $banner == 'great_deal':
                                              # code...
                                              echo '<img style="float:right;" src="'.BASE_URL_LINK.'image/banner/great-deal.png"  width="138px" height="138px" >';
                                              break;
                                          case $banner == 'new_arrival':
                                              # code...
                                              echo '<img style="margin-right: -10px;" src="'.BASE_URL_LINK.'image/banner/new-arrival.png"  width="138px" height="138px" >';
                                              break;
                                         default:
                                                # code...
                                                echo '';
                                                break;  
                                      } ?>
                            </div>
                              <div class="card-body">
                                 <div id="response<?php echo $row['sale_id']; ?>"></div>

                                  <div class="card-title">
                                   <?php 
                                    $titlex=$row["title"];
                                    if (strlen($titlex) > 30) {
                                    echo $titlex = substr($titlex,0,30).'... ';
                                    }else{
                                    echo $titlex;
                                    } ?>

                                    <?php if($user_id == $row['user_id01']){ ?>
                                    <ul class="list-inline ml-2  float-right" style="list-style-type: none;">  

                                            <li  class=" list-inline-item">
                                                <ul class="showcartButt" style="list-style-type: none; margin:0px;" >
                                                    <li>
                                                        <a href="javascript:void(0)" class="more"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                                        <ul style="list-style-type: none; margin:0px; margin:0px;width:250px;text-align:center;" >
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                                 <label class="delete-gurisha"  data-sale="<?php echo $row["sale_id"];?>"  data-user="<?php echo $row["user_id01"];?>">Delete </label>
                                                            </li>

                                                            <li style="list-style-type: none;"> 
                                                            <label for="title">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                        title
                                                                    <div class="input-group">
                                                                        <input  type="text" class="form-control form-control-sm" name="title" id="title<?php echo $row["sale_id"];?>" value="<?php echo $row["title"];?>">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text" style="padding: 0px 10px;"
                                                                                aria-label="Username" aria-describedby="basic-addon1" ><i class="fa fa-pencil" aria-hidden="true"></i></span>
                                                                        </div>
                                                                    </div> <!-- input-group -->
                                                                </div>
                                                            </div>
                                                            </label>
                                                            </li>
                                                            
                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label >photo
                                                                <form action="<?php echo BASE_URL_PUBLIC;?>core/ajax_db/sale_gurisha_delete.php" method="post" id="form-photo<?php echo $row["sale_id"];?>" enctype="multipart/form-data">
                                                                    <input type="hidden" name="sale_id" value="<?php echo $row["sale_id"];?>">
                                                                    <input type="file" class="form-control-file" name="update-form-sale-gurisha" id="update-form-sale-gurisha" data-sale="<?php echo $row["sale_id"];?>"> <br>
                                                                </form>
                                                             </label>
                                                            </li>

                                                            <li style="list-style-type: none; margin:0px;"> 
                                                            <label for="">
                                                            <div class="form-row">
                                                                <div class="col">
                                                                        Banner
                                                                        <div class="input-group">
                                                                              <select class="form-control" name="banner" id="banner<?php echo $row["sale_id"];?>">
                                                                                <option value="<?php echo $row['banner']; ?>" selected><?php echo $row['banner']; ?></option>
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
                                                                              <select class="form-control" name="available" id="available<?php echo $row["sale_id"];?>">
                                                                              <?php if ($row['buy'] == 'available') { ?>
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
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_change" id="discount_change<?php echo $row["sale_id"];?>" value="<?php echo $row["discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="discount_price" id="discount_price<?php echo $row["sale_id"];?>" value="<?php echo $row["price_discount"];?>">
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
                                                                        <input  type="number" class="form-control form-control-sm" name="price" id="price<?php echo $row["sale_id"];?>" value="<?php echo $row["price"];?>">
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
                                                            <label for="discount" class="update-sale-gurisha-btn" data-sale="<?php echo $row["sale_id"];?>" data-user="<?php echo $row["user_id01"];?>">submit</label>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                    </ul>
                                <?php } ?>

                                     <?php if($row['discount'] != 0){ ?>
                                          <span class="float-right text-danger"><?php echo $row["discount"]; ?>%</span>
                                     <?php } ?>

                                  </div> <!-- product-title -->
                                  <div class="card-text product-price d-inline-block"> 
                                    <?php if($row['price_discount'] != 0){ ?><span class="text-danger " style="text-decoration: line-through;"><?php echo number_format($row['price_discount']); ?> Frw</span> <?php } ?> 
                                   <div> <?php echo number_format($row["price"])." Frw"; ?> </div>
                                  </div>
                                   <form method="post" id="form-cartitem<?php echo $row['code']; ?>add" class="float-right">
                                      <div class="cart-action">
                                          <input type="hidden" style="width:30px;" name="action_gurisha" value="add" />
                                          <input type="hidden" style="width:30px;" name="code" value="<?php echo $row['code']; ?>" />
                                          <input type="text" class="product-quantity" style="width:30px;" name="quantity" value="1" size="2" readonly/>
                                          <input type="button" class="btnAddAction offer-price-gurisha" data-sale="<?php echo $row['sale_id']; ?>" value="Add to cart" />
                                          <!-- <input type="button" onclick="cart_gurisha_add('add','< ?php echo 'form-cartitem'.$row['code'].'add'; ?>','< ?php echo $row['code']; ?>');" value="Add offer" class="btnAddAction" /> -->
                                      </div>
                                  </form>
                              </div><!-- card-body -->
                          </div><!-- card -->

                         </div><!-- float-left -->
                           <!-- </div> -->

                    <?php }
                    
                    $query1= $mysqli->query("SELECT COUNT(*) FROM sale_gurisha WHERE categories_sale ='$categories' ");
                    $row_Paginaion = $query1->fetch_array();
                    $total_Paginaion = array_shift($row_Paginaion);
                    $post_Perpages = $total_Paginaion/10;
                    $post_Perpage = ceil($post_Perpages); ?>    
                    
                </div>
                </div>
           </div>
          </div> <!-- /.card-body -->
       </div> <!-- /.card -->

        <?php if($post_Perpage > 1){ ?>
         <nav>
             <ul class="pagination justify-content-center mt-3">
                 <?php if ($pages > 1) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $pages-1; ?>)">Previous</a></li>
                 <?php } ?>
                 <?php for ($i=1; $i <= $post_Perpage; $i++) { 
                         if ($i == $pages) { ?>
                      <li class="page-item active"><a href="javascript:void(0)"  class="page-link" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                      <?php }else{ ?>
                     <li class="page-item"><a href="javascript:void(0)"  class="page-link" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $i; ?>)" ><?php echo $i; ?> </a></li>
                 <?php } } ?>
                 <?php if ($pages+1 <= $post_Perpage) { ?>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)" onclick="cartItemsCategories('<?php echo $categories; ?>',<?php echo $pages+1; ?>)">Next</a></li>
                 <?php } ?>
             </ul>
         </nav>
        <?php } 
    }

      public function cart_gurisha_countPOSTS($categories)
    {
        $db =$this->database;
        $sql= $db->query("SELECT COUNT(*) FROM sale_gurisha WHERE categories_sale ='$categories' ");
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

    public function showCart_gurisha_item(){

        if(isset($_SESSION["cart_item_gurisha"])){
                $total_quantity = 0;
                $total_price = 0;
            ?>	
            <table class="tbl-cart table table-responsive-sm table-hover table-bordered"  cellpadding="10" cellspacing="1">
            <thead class="main-active">
            <tr>
            <th style="text-align:left;">Name</th>
            <th style="text-align:left;">Code</th>
            <th style="text-align:right;" width="5%">Quantity</th>
            <th style="text-align:right;" width="10%">Unit Price</th>
            <th style="text-align:right;" width="10%">Price</th>
            <th style="text-align:center;" width="5%">Remove</th>
            </tr>	
             </thead>
            <tbody class="bg-light">
            <?php		
                foreach ($_SESSION["cart_item_gurisha"] as $item){
                    $item_price = $item["quantity"]*$item["price"];
            		?>
            				<tr>
                            <td style="background: url('<?php echo BASE_URL_PUBLIC ;?>uploads/sale-gurisha/<?php echo $item["image"]; ?>')no-repeat center center;background-size:contain;height:80px;width:80px;position:relative">
                            </td>
            				<td><?php echo $item["code"]; ?></td>
            				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
            				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
            				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
            				<td style="text-align:center;"><a href="javascript:void(0);" onclick="cart_gura_add('remove','<?php echo $item['code']; ?>');" class="btnRemoveAction"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a></td>
            				<!-- <td style="text-align:center;"><a href="gura.php?action_gurisha0=remove&code=< ?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="< ?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a></td> -->
            				</tr>
            				<?php
            				$total_quantity += $item["quantity"];
            				$total_price += ($item["price"]*$item["quantity"]);
            		}
            		?>
            
            <tr>
            <td colspan="2" align="right">Total:</td>
            <td align="right"><?php echo $total_quantity; ?></td>
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
	
    public function showCart_gurisha_itemSale(){

        if(isset($_SESSION["cart_item_gurisha"])){
                $total_quantity = 0;
                $total_price = 0;
            ?>	
            <table class="table table-responsive-sm table-hover table-bordered" >
             <thead class="main-active">
               <tr>
               <th style="text-align:center;">Products</th>
               <th style="text-align:center;">Price</th>
               <th style="text-align:center;">Remove</th>
			   </tr>	
			 </thead>
             <tbody class="bg-light">
            <?php		
                foreach ($_SESSION["cart_item_gurisha"] as $item){
                    $item_price = $item["quantity"]*$item["price"];
            		?>
                    <tr>
                     <!-- <td style="position:relative;text-align:center;">
                     <img src="< ?php echo BASE_URL_PUBLIC ;?>uploads/sale-gurisha/< ?php echo $item["image"]; ?>" height='80px' > -->
                     <td style="background: url('<?php echo BASE_URL_PUBLIC ;?>uploads/sale-gurisha/<?php echo $item["image"]; ?>')no-repeat center center;background-size:contain;height:80px;width:80px;position:relative">
                    <div style="position:absolute;bottom:0px;left:0px;background-color:#0000006e;color:white;width: 100%;"><?php
                    if (strlen($item["name"]) > 12) {
                      echo $item["name"] = substr($item["name"],0,12).'..';
                    }else{
                      echo $item["name"];
                    } ?></div>
                    </td>
            				<td align="right"><?php echo "$ ". number_format($item_price); ?></td>
            				<td align="center">
                               <form method="post" id="form-cartitem<?php echo $item['code']; ?>remove" >
                                        <input type="hidden" style="width:30px;" name="action_gurisha" value="remove" />
                                        <input type="hidden" style="width:30px;" name="code" value="<?php echo $item['code']; ?>" />
                                        <a href="javascript:void(0);" onclick="cart_gurisha_add('remove','<?php echo 'form-cartitem'.$item['code'].'remove'; ?>','<?php echo $item['code']; ?>');"><img src="<?php echo BASE_URL_LINK ;?>image/product-images/icon-delete.png" alt="Remove Item" /></a> 
                                </form>
                    </td>
            				
                    </tr>
            				<?php
            				$total_quantity += $item["quantity"];
            				$total_price += ($item["price"]*$item["quantity"]);
            		}
            		?>
            
            <tr>
            <td>Total:</td>
            <td align="left" colspan="2" ><strong><?php echo "$ ".number_format($total_price); ?></strong></td>
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

     public function update_gurisha_sale($banner,$title,$available,$discount_change,$discount_price,$price,$sale_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE sale_gurisha SET title= '$title', banner= '$banner', buy = '$available', discount = $discount_change ,price_discount = $discount_price, price = $price WHERE sale_id= $sale_id ";
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

      public function sale_gurisha_getPopupTweet($user_id,$sale_id,$car_user_id)
    {
        $mysqli= $this->database;
        $result= $mysqli->query("SELECT * FROM users U Left JOIN sale_gurisha B ON B. user_id01 = u. user_id WHERE B. sale_id = $sale_id AND B. user_id01 = $car_user_id ");
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));
        while ($row= $result->fetch_array()) {
            # code...
            return $row;
        }
    }
      
    public function delete_gurisha_LikesSale($sale_id,$user_id)
    {
        $mysqli= $this->database;
        $query="DELETE FROM sale_gurisha WHERE sale_id = $sale_id ";

        $query1="SELECT * FROM sale_gurisha WHERE sale_id = $sale_id ";

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
                $uploadDir = DOCUMENT_ROOT.'/uploads/sale-gurisha/';
                for ($i=0; $i < count($expode); ++$i) { 
                      unlink($uploadDir.$expode[$i]);
                }
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp4') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/sale-gurisha/';
                      unlink($uploadDir.$photo);
            }else if (array_diff($fileActualExt,$allower_ext)[0] == 'mp3') {
                $uploadDir = DOCUMENT_ROOT.'/uploads/sale-gurisha/';
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

       public function gurishaReadmore($sale_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users U Left JOIN sale_gurisha H ON H. user_id01 = u. user_id 
            Left JOIN provinces P ON H. province = P. provincecode
            Left JOIN districts M ON H. districts = M. districtcode
            Left JOIN sectors T ON H. sector = T. sectorcode
            Left JOIN cells C ON H. cell = C. codecell
            Left JOIN vilages V ON H. village = V. CodeVillage 
        WHERE H. sale_id = '$sale_id' ");
        $row= $query->fetch_array();
        return $row;
    }

}

$gurisha = new Gurisha();

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