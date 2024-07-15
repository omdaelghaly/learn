<?php


   $user_id= isset($_GET['user_id'])? $_GET['user_id'] :0 ;
   $pro_id= isset($_GET['pro_id'])? $_GET['pro_id'] :0 ;
   $q= isset($_GET['q'])? $_GET['q'] :0 ;

    // Set cookies for pro_id and user_id
  // setcookie('pro_id', $pro_id, time() + 3600,path,domin,secure=>false,httponly=>false);
     // $order = isset($_COOKIE['order']) ? json_decode($_COOKIE['order']) : setcookie('order',json_encode([]), time() + 3600, '/');

    // Check if 'order' cookie is set
if (isset($_COOKIE['order'])) {
    //  JSON to PHP
    $order = json_decode($_COOKIE['order'], true);
    $exist= checkifexists($order,$pro_id);
                if(!$exist){
                        setcookiefun($user_id, $pro_id, $q, $order);
                }else{
                    ?>
                   <script type="text/javascript">
                       alert('تمت اضافة هذا المنتج من قبل الى العربة ');
                   </script>
                    <?php
                }
} else {
    setcookie('order', json_encode([]), time() + 3600, '/');
    $order = [];
    setcookiefun($user_id, $pro_id, $q, $order);
}

function setcookiefun($user_id, $pro_id, $q, &$order)
{
    $new_order = ["user_id" => $user_id, "pro_id" => $pro_id, "q" => $q];
    $order[] = $new_order;
    $order_json = json_encode($order);
    setcookie('order', $order_json, time() + 3600, '/');
}

function checkifexists($order,$pro_id)
{
     $exists=false;
    foreach ($order as $item) {
        if ($item['pro_id'] === $pro_id) {
              $exists=true;
              break;
        }
    }

        return $exists;
}




?>
