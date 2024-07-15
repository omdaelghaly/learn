
<?php
 session_start();
 include('./../../classes/All.php');
 include('./delete.php');
 $productClass = new Product();
 $funClass = new Fun();
 $userClass = new User();
 $orderClass = new Order();

  // $table= isset($_GET['table'])?$_GET['table'] :0 ;

if(isset($_SESSION['id'])){
 $my_id= $_SESSION['id'];
 $orders=$orderClass->getorders($my_id);

}else{
   $orders=[];
}

if($orders){
    $numRows = count($orders);
?>




          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number noti"><?php echo $numRows ;?> </span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have <span class="noti"><?php echo $numRows ;?></span> new notifications
              <a href="/components/myorders/index.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

    <?php
        foreach($orders as $order){
               $pRow = $productClass->getRow('products','id', $order['pro_id']);
                      $status = $order['status'];

    ?><!--
                 <script type="text/javascript">
                     var status= '<?php echo $status;?>';
                      var noti = $('.noti').text();
                    if(Number(status)!==2){
                     $('.noti').text(Number(noti)+1);
                    }
                 </script>
 -->
            <li class="notification-item" onclick="gotopage()" style="cursor:pointer;">
                <?php
                        if (!$status || $status === 0) { ?>
               <i class="bi bi-exclamation-circle text-warning"></i>
                        <?php }elseif ( (int)$status === 1){ ?>
               <i class="bi bi-check-circle text-success"></i>
                        <?php }else{ ?>
               <i class="bi bi-check-circle text-success"></i>
                        <?php } ?>
              <div dir="rtl">
                <h4 class="col text-center"><?php echo $pRow['name'] ?> </h4>
                    <?php
                        $status = $order['status'];
                        if (!$status || $status === 0) { ?>
                              <p> تم ارسال الطلب .... فى انتظار الموافقة . </p>
                     <?php }else{ ?>
                              <p> تم قبول طلبك  وجارى توصيل الطلب اليك .... </p>
                     <?php } ?>
                <p ><?php echo $funClass->getTime($order['time']); ?></p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

    <?php
        }

        }else{?>

                <div class="col text-center mt-4" style="min-height:200px" dir="rtl" >
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


<script type="text/javascript">
  function gotopage() {
         window.location.href = '/components/myorders/index.php';
  }
</script>



