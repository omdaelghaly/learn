
<?php
 session_start();
 include('./../../classes/All.php');
 include('./plus/deleteorder.php');
 $productClass = new Product();
 $funClass = new Fun();
 $userClass = new User();
 $orderClass = new Order();

  // $table= isset($_GET['table'])?$_GET['table'] :0 ;

 $my_id=''; //empty to get all

$orders=$orderClass->getorders($my_id);

if($orders){
?>
<style type="text/css">
  .admin{
    background-color:orange ;
  }
</style>


<div class="table-reponsive" dir="rtl" style="min-height:400px">

<div class="col text-center">
      <span class="fs-3">  جميع  الطلبات  </span>
</div>

<br>



<table class="table table-striped">
  <thead class="table-secondary">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">pro</th>
      <th scope="col">bill</th>
      <th scope="col">user</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <!-- Table rows will be dynamically added here -->
    <?php
        foreach($orders as $order){
              $pRow = $productClass->getRow('products','id', $order['pro_id']);
              $puser = $productClass->getRow('users','id', $order['user_id']);
    ?>
    <tr>
      <th scope="row"><?php echo $order['index'];?></th>
      <td class="width-td"><?php echo $pRow['name'];  ?></td>
  <!-- bill -->
      <td class="" >

            <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                <span class=" dropdown-toggle ps-2">
                    الفاتورة
                </span>
            </a>
            <!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"  style="max-width:300px">
                <div class="dropdown-header">
                    <h6 class="col text-center" style="text-decoration: underline;">الفاتورة </h6>
                </div>

                    <div class="container">
                        <div class="row text-center" >
                            <div class="col-6 ">
                                <span> رقم الفاتورة </span><hr> <span> المنتج </span><hr><span>الثمن </span><hr><span>عدد </span><hr> <span> التكلفة</span><hr> <span> الشحن  </span>
                            </div>
                            <div class="col-6 ">
                                <span class="width-td"><?php echo $order['bill_num'] ;?></span><hr>
                                <span class="width-td" ><?php echo $pRow['name'];  ?> </span><hr>
                                <span><?php echo $pRow['price_after'].' ';  ?> ج.م </span><hr>
                                <span><?php echo $order['pro_num'];  ?></span><hr>
                                <span><?php echo ((int)$pRow['price_after'] * (int)$order['pro_num']) .' ' ?> ج.م </span><hr><span>50 ج.م </span>
                            </div>
                        </div>
                    </div>

                <li>
                    <hr class="dropdown-divider my-2" style="border-color: red" >

                   <div class="container ">
                        <div class="row text-center" >
                            <div class="col-6 ">
                                <span>الاجمالى  </span>
                            </div>
                            <div class="col-6 ">

                                  <span><?php echo ((int)$pRow['price_after'] * (int)$order['pro_num'])+ 50 .' ' ?> ج.م </span>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center mt-3" style="font-size:10px ;">
                          تاريخ : <?php echo date("Y-m-d H:i:s", $order['time']); ?>
                    </div>

                </li>
            </ul>



      </td>
<!-- end bill -->
<!-- user -->
      <td>

          <a class="nav-link nav-profile d-flex align-items-center " href="#" data-bs-toggle="dropdown">
                <span class=" dropdown-toggle ps-2">
                     <i class="bi bi-person-circle"></i>
                </span>
            </a>
            <!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"  style="max-width:300px">
                <div class="dropdown-header">
                    <h6 class="col text-center">    صاحب الطلب     </h6>
                </div>
                  <div class="container ">
                  	<div class="row">
                  		<div class="col-2 text-right">
                  			       <span>الاسم   </span> <br>
                                 <span>التليفون  </span><br>
                                 <span>العنوان  </span>
                  		</div>
                  		<div class="col-10">
                  			<span><?php echo $puser['name'] ?>  </span><br>
                           <span><?php echo $puser['phone'] ?></span><br>
                           <span><?php echo $puser['address'] ?>  لبققث لاللبع تغ للقق لبققث لاللبع تغ للقق لبققث لاللبع تغ للقق لبققث لاللبع تغ للقق لبققث لاللبع تغ للقق  </span>
                  		</div>

                  	</div><hr>
                  	    <div class="col text-center">
                            <a href="#"  style="cursor:pointer;"
                                 onclick="gotouserpage('<?php echo $_SESSION['id'] ?>','<?php echo $order['user_id'] ?>')" >user profile </a>
                  	    </div>


                   </div>
              </ul>



      </td>


 <!-- -- -->
 <!-- options -->
           <td class="d-flex justify-content-between">
             <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-ellipsis-v"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow text-center" style="cursor: pointer;">

               <?php
                $status = $order['status'];
               if (!$status || $status === 0) {
                ?>
                <li>
                  <a class="dropdown-item" onclick="acceptorder('<?php echo $order['id'];?>')"  href="#"> قبول الطلب
                  </a>
                </li>

              <?php }
              ?>
                <li>
                  <a class="dropdown-item" onclick="delorder('<?php echo $order['id'];?>')"  href="#">حذف الطلب
                  </a>
                </li>

            </ul>
          </div>
           <div class="p-0 m-0"  >
            <?php echo (!$status || $status===0)?'<i class="bi bi-exclamation-circle text-warning"></i>':'<i class="bi bi-check-circle text-success"></i>' ?>

          </div>

          </td>
    </tr>


    <?php
        }
    ?>
  </tbody>
</table>
 <?php
        }else{?>

                <div class="col text-center mt-4" style="min-height:400px" dir="rtl" >
                        ليس لديك اى طلبات حتى الان ........
                </div>
  <?php
        }
    ?>

</div>

<!-- ----============================================== -->

<style type="text/css">
  .width-td{
     max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
  }
  *td{
     max-width: 100px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
  }
</style>



    <!-- =========== -->
<script type="text/javascript">
  function delorder(id){
     $('#delete-ida').val(id);
     $('#tablea').val('orders');
     $('#delete-processa').val('delete');
     $('#order-deletea').click();
  }


function gotouserpage(my_id,u_id){
	if(my_id===u_id){
		window.location.href="/components/profiles/index.php";
	}else{
		window.location.href="/components/profiles/index2.php?u_id="+u_id;
	}
}


function acceptorder(id){
         var formData = new FormData();
              formData.append('id',id);
              formData.append('table','orders');
              formData.append('process','acceptorder');
         $.ajax({
            url: './../../controllers/orderController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
             var res = JSON.parse(response);
             console.log(res);
             //loadPage('./../../components//myorders.php','content','GET',[]);

            loadPage('./orders.php','contentDash','GET',[]);/// default page

          },
          error: function(xhr, status, error) {

           alert('Error occurred. Please try again.');
        }
      });
}

</script>
