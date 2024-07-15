
<?php
// // session_start();
 include('./../../../classes/All.php');

 $productClass = new Product();
 $funClass = new Fun();

   $xcat_id= isset($_GET['xcat_id'])? $_GET['xcat_id'] :0 ;
   $selectedval= isset($_GET['selectedval'])? $_GET['selectedval'] :0 ;


$products=$productClass->getProducts($xcat_id,$selectedval);

?>
<style type="text/css">
  .green{color:green ;}
  .red{color:red ;}
</style>


<div class="table-reponsive">
<table class="table table-striped">
  <thead class="table-secondary">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">p_old</th>
      <th scope="col">p_now</th>
      <th scope="col">image</th>
      <th scope="col">available</th>
      <th scope="col">update</th>
      <th scope="col">option</th>
    </tr>
  </thead>
  <tbody>
<!-- <span>&#128516</span>
 -->    <!-- Table rows will be dynamically added here -->
    <?php

        foreach($products as $product){
                          $about =$product["about"];

    ?>
    <tr>
      <th scope="row"><?php echo $product['index'];?></th>
      <td class="width-td" ><?php echo $product['name'];?></td>
      <td class="width-td"><?php echo $product['price_before'];?></td>
      <td class="width-td"><?php echo $product['price_after'];?></td>
      <td><img src="./../../assets/images/products/<?php echo $product['image'];?>" style="width:50px;height:40px ;" class="image-rounded p-0 m-0"></td>
      <td><?php echo $product['available']?'<i class="fa fa-circle green"></i>':'<i class="fa fa-circle red"></i>' ;?></td>
      <td><?php echo $funClass->getTime($product['time'])  ?></td>
      <td>
   <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown">
                <!-- <i class="bi bi-three-dots"></i> --> <i class="fas fa-ellipsis-v"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="cursor: pointer;">


      <li><a class="dropdown-item"
        onclick="editproduct('<?php echo $product['cat_id'] ?>','<?php echo $product["name"];?>',
                         '<?php echo $product["price_before"];?>','<?php echo $product["price_after"];?>',
                         '<?php echo htmlspecialchars($about); ?>',
                         '<?php echo $product["image"];?>',
                         '<?php echo $product["available"];?>','<?php echo $product["id"];?>')" href="#">edit
      </a></li>
      <li><a class="dropdown-item" onclick="deleteproduct('<?php echo $product['id'];?>',<?php echo $product['cat_id'];?>')" href="#">delete</a></li>
    </ul>
  </div>

      </td>
    </tr>


    <?php
        }
    ?>
    <!-- Additional rows can be added similarly -->
  </tbody>
</table>
</div>

