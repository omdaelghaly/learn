<?php
 require_once './../classes/All.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderClass = new Order();
    // use fun
    $funClass = new Fun();
    $env= new Env();
   
// ////
session_start();
$process = $_POST['process'];
$user_id = $_SESSION['id'];
$time=time();


if($process!=='delete'){

   //  $cat_id = $_POST['cat_id'];
   //  $aboutpro = $_POST['aboutpro'];
   //  $proname = $_POST['proname'];
   //  $price= $_POST['price'];
   //  $price1 = $_POST['price1'];
   //  $available = $_POST['available'];
   //  $min=5;  $time=time();
   //  $max=200;
   //   $image='';
   //   $imgName='default.jpg';///default image

   //  if (!empty($_FILES['image']['name'][0])){
   //    $image= $_FILES['image'];
   //    $imagesDIR = './../assets/images/products/'; // Directory to store the uploaded images

   // }
}


if($process==='updateuser'){
         $name = $_POST['name'];
         $phone = $_POST['phone'];
         $address = $_POST['address'];
         $pro_num = $_POST['pro_num'];
         $pro_id = $_POST['pro_id'];
         $table = $_POST['table'];
         $random = mt_rand(1,1000 );
         $bill_num = $random.$time;

   $newData = "name='$name',address='$address', phone='$phone' ";
   $updateuser = $orderClass->editRow('users',$newData,$user_id);
        echo $funClass->response('success','msg','user updated','');



}elseif($process==='neworder'){

      $orders= $_POST['orders'];

         // $name = $_POST['name'];
         // $phone = $_POST['phone'];
         // $address = $_POST['address'];
         // $pro_num = $_POST['pro_num'];
         // $pro_id = $_POST['pro_id'];
         // $table = $_POST['table'];
         // $random = mt_rand(1,1000 );
         // $bill_num = $random.$time;

   // $newData = "name='$name',address='$address', phone='$phone' ";
   // $updateuser = $orderClass->editRow('users',$newData,$user_id);

   // if($updateuser){

          $insertneworder=$orderClass->newRowArray('orders',$orders);
        echo $funClass->response('success','msg',$insertneworder,'');

   // }

}elseif ($process==='acceptorder') {
   $order_id=$_POST['id'];
   $newData = "status=1,time='$time' ";
   $updateuser = $orderClass->editRow('orders',$newData,$order_id);
    echo $funClass->response('success', 'msg','updated','');


}elseif ($process==='recievedorder') {
   $order_id=$_POST['id'];
   $newData = "status=2,time='$time' ";
   $updateuser = $orderClass->editRow('orders',$newData,$order_id);
    echo $funClass->response('success', 'msg','updated-recievedorder','');


}elseif($process==='delete'){
    $order_id = $_POST['id'];
    $table = $_POST['table'];
    $delorder = $orderClass->deleteRow($table,$order_id);
    echo $funClass->response('success', 'msg',$delorder,'');


}else{
        echo $funClass->response('success', 'msg','no data','');

}




////

}
?>
