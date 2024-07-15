<?php


   $pro_id= isset($_GET['pro_id'])? $_GET['pro_id'] :0 ;

   if (isset($_COOKIE['order'])) {
          $orders = json_decode($_COOKIE['order'], true); //true=>assarray ,false=>obj
          $indexToDelete = -1;
         foreach ($orders as $index => $order) {
           if ((int)$order['pro_id'] === (int)$pro_id) {
            $indexToDelete = $index;
            break;
         }
      }

      if ($indexToDelete !== -1) {
            unset($orders[$indexToDelete]);
           // If you want to reindex the array after deleting the element
            $orders = array_values($orders);
            $jsonOrders = json_encode($orders);
         if($jsonOrders){
            setcookie('order', $jsonOrders, time() + (3600), "/"); // Expires in 1hour
         }else{
            setcookie('order', $jsonOrders, time() - 1 , "/"); // Expires now
         }


      }

   }


?>
<script type="text/javascript">
             loadPage('./../../components/main/home/navcookiesorder.php','nav_cookies_order','GET',[]);

</script>
