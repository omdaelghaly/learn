<?php
session_start();
 include('./../../../classes/All.php');
 //include('./delete.php');
 $productClass = new Product();
 $funClass = new Fun();
 $userClass = new User();
 $orderClass = new Order();

if (isset($_COOKIE['order']) && isset(json_decode($_COOKIE['order'], true)[0])) {

    $orders = json_decode($_COOKIE['order'], true); //true=>assarray ,false=>obj


?>



          <a class="nav-link nav-icon cartpop" href="#" data-bs-toggle="dropdown" id="cartpop">
            <i class="bi bi-cart-dash"></i>
            <span class="badge bg-success badge-number"><?php echo count($orders); ?></span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow " id="dmenu">
            <li class="dropdown-header">
              You have added <?php echo count($orders); ?> orders
              <spa id="ttt"></span>
              <a href="/components/myorders/index.php">
                <span class="badge rounded-pill bg-primary p-2 ms-2">View all</span>
              </a>
            </li>
    <!--table-----  -->
<div class="table-reponsive p-1" dir="rtl"  id="popcart" onclick="event.stopPropagation()">
<table class="table table-striped" style="width:80vh;align:center">
  <thead class="table-secondary">
    <tr>
      <th scope="col">م </th>
      <th scope="col">المنتج  </th>
      <th scope="col">الفاتورة  </th>
      <th scope="col">خيارات  </th>
    </tr>
  </thead>
  <tbody>
    <!-- Table rows will be dynamically added here -->
    <?php
        $i=1;
        foreach($orders as $order){
              $order['i']=$i;
              $pRow = $productClass->getRow('products','id', $order['pro_id']);
              $i++;
    ?>
    <tr style="text-align: center;">
      <th scope="row"><?php echo $order['i'];?></th>
      <td class="width-td"><?php echo $pRow['name'];  ?></td>
  <!-- bill -->
      <td class="" >

            <a class="nav-link nav-profile d-flex align-items-center " href="#" data-bs-toggle="dropdown">
                <span class=" dropdown-toggle">
                    الفاتورة
                </span>
            </a>
            <!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <div class="dropdown-header" style="width:300px">
                    <h6 style="text-decoration: underline;">الفاتورة </h6>
                </div>

                    <div class="container">
                        <div class="row text-center" >
                            <div class="col-6 ">
                                <span> رقم الفاتورة </span><hr> <span> المنتج </span><hr><span>الثمن </span><hr><span>عدد </span><hr> <span> التكلفة</span><hr> <span> الشحن  </span>
                            </div>
                            <div class="col-6 ">
                                <span class="width-td"><?php echo '0000' ;?></span><hr>
                                <span class="width-td" ><?php echo $pRow['name'];  ?> </span><hr>
                                <span><?php echo $pRow['price_after'].' ';  ?> ج.م </span><hr>
                                <span><?php echo $order['q'];  ?></span><hr>
                                <span><?php echo ((int)$pRow['price_after'] * (int)$order['q']) .' ' ?> ج.م </span><hr><span>50 ج.م </span>
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

                                  <span><?php echo ((int)$pRow['price_after'] * (int)$order['q'])+ 50 .' ' ?> ج.م </span>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center mt-3" style="font-size:10px ;">
                          تاريخ : <?php echo date("Y-m-d H:i:s", time()); ?>
                    </div>

                </li>
            </ul>



      </td>
<!-- end bill -->

 <!-- options -->
           <td class="">
            <!--  <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-ellipsis-v"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="cursor: pointer;">

                 <li> -->

                  <a class="dropdown-item" type="submit" onclick="delcartorder(event,'<?php echo $order['pro_id'];?>')"  href="#">حذف الطلب
                  </a>
<!--                 </li>

            </ul>
          </div>

 -->       <!--  -->
          </td>
    </tr>


    <?php
        }
    ?>
  </tbody>
</table>
</div>
    <!-- endtable -->


<div class="container col text-center">
    <button class="btn btn-primary" id="saveorderbtn" onclick="saveOrder('<?php echo htmlspecialchars(json_encode($orders), ENT_QUOTES, 'UTF-8'); ?>')" >تأكيد الشراء</button>
</div>



          </ul><!-- End Messages Dropdown Items -->




<!-- if no order============================================================================== -->
<?php  }else{
  ?>

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-cart-dash"></i>
            <span class="badge bg-success badge-number">0</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You add 0 orders
              <a href="/components/myorders/index.php">
<!--                 <span class="badge rounded-pill bg-primary p-2 ms-2">View all</span>
 -->              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item container text-center">
                      no new orders yet.....
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>



            <li class="dropdown-footer">
<!--               <a href="/components/myorders/index.php">Show all orders</a>
 -->            </li>

          </ul><!-- End Messages Dropdown Items -->

  <?php
}

?>

<style type="text/css">
  tr td{
    text-align: center;
  }
  th{
    text-align: center;
  }
  hr{
    padding: 0px;margin: 0px;
  }
</style>
<script type="text/javascript">
    function delcartorder(e,id){
      e.preventDefault();
      e.stopPropagation();
       $.ajax({
         url: '/components/main/home/delprofromcookies.php/?pro_id='+id ,
         type: 'GET',
         success: function(response) {
              //$('#ttt').html(response);
          loadPage('/components/main/home/navcookiesorder.php','nav_cookies_order','GET',[]);

             },
             error: function(xhr, status, error) {
              console.error(xhr.responseText);
           }
        });



    }

//////////////////////////////////add order to database //////////
    function saveOrder(orders){
          var orders = JSON.parse(orders);
      // $('#saveorderbtn').prop('disabled', false);

      // $('#saveorderbtn').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
      //      ... `);

              var Data = {'orders':orders,'process':'neworder'};

              $.ajax({
                  url: './../../../controllers/orderController.php',
                  type: 'POST',
                  data: Data,

                  success: function(response) {
                    var res = JSON.parse(response);
                    console.log(res);
                 loadPage('./../../../components/main/home/navcookiesorder.php','nav_cookies_order','GET',[]);

                    $('#saveorderbtn').prop('disabled', false).removeClass('disabled').html('تاكيد الشراء');

                  },
                  error: function(xhr, status, error) {
                   $('#saveorderbtn').prop('disabled', false).removeClass('disabled').html('تاكيد الشراء');
                      alert('Error occurred. Please try again.');
                  }
              });//end ajax
// console.log(Data);


$('#saveorderbtn').prop('disabled', false).removeClass('disabled').html('تاكيد الشراء');




      //
    }


</script>
