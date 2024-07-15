
<?php
 session_start();
 include('./../../classes/All.php');
 include('./delete.php');
 $productClass = new Product();
 $funClass = new Fun();
 $userClass = new User();
 $orderClass = new Order();

  // $table= isset($_GET['table'])?$_GET['table'] :0 ;

 $my_id= $_SESSION['id'];

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
      <th scope="col">status</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <!-- Table rows will be dynamically added here -->
    <?php
        foreach($orders as $order){
              $pRow = $productClass->getRow('products','id', $order['pro_id']);
    ?>
    <tr>
      <th scope="row"><?php echo $order['index'];?></th>
      <td class="width-td"><?php echo $pRow['name'];  ?></td>
  <!-- bill -->
      <td class="" >

            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <span class=" dropdown-toggle ps-2">
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
<!-- status -->
      <td>

          <a class="nav-link nav-profile d-flex align-items-center " href="#" data-bs-toggle="dropdown">
                <span class=" dropdown-toggle ps-2">
                    حالة الطلب
                </span>
            </a>
            <!-- End Profile Iamge Icon -->
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <div class="dropdown-header">
                    <h6 class="col text-center"> حالة الطلب  </h6>
                </div>
                  <div class="container">
                           <div class="row text-center">
                                <?php
                                $status = $order['status'];

                                if (!$status || $status === 0) {
                                    echo '<span style="color:green;">تم ارسال الطلب</span><br>';
                                    echo '<span style="color:orange;">عادة يتم النظر فى الطلبات فى مدة اقل من 24 ساعة ...</span>';
                                 }else if( (int)$status === 1){  ?>

                                    <div class="col" >
                                       <span class="col text-success">تم قبول الطلب </span><br>
                                       <span class="col text-success">  جارى التوصيل فى اقرب وقت ممكن
                                       </span><br>
                                       <span class="col text-danger">  يتم التوصيل فى مدة 24 ساعة </span><br>
                                       <span class="col text-warning">بعد استلامك الطلب لاتنسى الضغط على زر  "تم استلام الطلب " </span>

                                    </div>
                              <?php  }else{ ?>
                                     <div class="col text-center">
                                         انتهاء نراحل الطلب
                                     </div>
                             <?php }
                                ?>
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
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="cursor: pointer;">

               <?php
               if (!$status || $status === 0  ) {
                ?>
                <li>
                  <a class="dropdown-item" onclick="delorder('<?php echo $order['id'];?>')"  href="#">حذف الطلب
                  </a>
                </li>
              <?php }else if($status &&  (int)$status===2 ){ ?>
                 <li>
                  <a class="dropdown-item" onclick="delorder('<?php echo $order['id'];?>')"  href="#">حذف الطلب
                  </a>
                </li>
              <?php }else{ ?>
                    <li>
                  <a class="dropdown-item" onclick="recievedorder('<?php echo $order['id'];?>')"  href="#">
                     تم استلام الطلب
                  </a>
              <?php }
              ?>
            </ul>
          </div>
  <!-- star evaluate -->
                <?php
                   if ($status && (int)$status===2 ) {
                ?>

          <a class="nav-link nav-profile d-flex align-items-center " href="#" data-bs-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <span class=" dropdown-toggle ps-2">
                      تقييم
                </span>
            </a>
            <!-- End Profile Iamge Icon -->
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <div class="dropdown-header">
                    <h6 class="col text-center"> تقييم المنتج  </h6>
                </div>
                  <div class="container">
                           <div class="row text-center">
                                <form class="col text-center " id="star_rate">

                                </form>

                            </div>
                   </div>
              </div>

<script type="text/javascript">
   function setrate(pro_id,num=null) {
     var el_rate = $('#star_rate');
         el_rate.html('');
     for (var i = 1; i <= 5 ; i++) {
           if(num >=i){
        var starE = $("<span class='one fs-3' onclick='rate(" +pro_id+','+ i + ")'><i class='bi bi-star-fill'></i> </span>");
           }else{
       var starE = $("<span class='one fs-3' onclick='rate(" +pro_id+','+i + ")'><i class='bi bi-star'></i> </span>");
           }

              el_rate.append(starE);
     }
   }
   setrate(<?php echo $order['pro_id'] ?>,'');

</script>


               <?php  }
               ?>
       <!--  -->
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
  .one{
   color: yellow;
   cursor: pointer;

  }
</style>



    <!-- =========== -->
<script type="text/javascript">
  function rate(pro_id,num) {
    setrate(pro_id,num);
 console.log(pro_id+'-'+num);
  }


  function delorder(id){
     $('#delete-idu').val(id);
     $('#tableu').val('orders');
     $('#delete-processu').val('delete');
     $('#order-deleteu').click();
  }

function recievedorder(id){
         var formData = new FormData();
              formData.append('id',id);
              formData.append('table','orders');
              formData.append('process','recievedorder');
         $.ajax({
            url: './../../controllers/orderController.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
             var res = JSON.parse(response);
             console.log(res);
             loadPage('./../../components/myorders/myorders.php','my_orders','GET',[]);


          },
          error: function(xhr, status, error) {

           alert('Error occurred. Please try again.');
        }
      });
}

</script>
