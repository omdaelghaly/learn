<?php
 require_once './../classes/All.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productClass = new Product();
    // use fun
    $funClass = new Fun();
    $env= new Env();
   
// ////
session_start();
$process = $_POST['process'];
$user_id = $_SESSION['id'];
$table = $_POST['table'];

if($process!=='delete'){

    $cat_id = $_POST['cat_id'];
    $aboutpro = $_POST['aboutpro'];
    $proname = $_POST['proname'];
    $price= $_POST['price'];
    $price1 = $_POST['price1'];
    $available = $_POST['available'];
    $min=5;  $time=time();
    $max=200;
     $image='';
     $imgName='default.jpg';///default image

    if (!empty($_FILES['image']['name'][0])){
      $image= $_FILES['image'];
      $imagesDIR = './../assets/images/products/'; // Directory to store the uploaded images

   }
}
   // if($image){
   //                echo $funClass->response('error', 'msg','yesssssssssss','');
   // }else{
   //                echo $funClass->response('error', 'msg','no','');

   // }


if($process==='add'){
     $exists =  $funClass->checkIfExist('name',$table,$proname);
       if(!$exists){
            $LEN =  $funClass->validateLength($proname,$min,$max);
                 if(!$LEN){
                    ///////////////////////////////////////////////////////////////////////////////////
                          if($image){
                                 $allowed = array('jpg', 'jpeg', 'png', 'gif');
                                 $validateAllowed = $funClass->validateAllowed($image,$allowed);
                                if(!$validateAllowed){
                                          $validateSize = $funClass->validateSize($image,(1 * 1024*1024 )/1);//$maxFileSize 1m = (1 * 1024 * 1024)
                                          if(!$validateSize){ // no error

                                                $tmp = $image['tmp_name'][0];
                                                $originName = $image['name'][0];
                                                $Ext = explode('.', $originName);
                                                $extt = strtolower(end($Ext));
                                                $imgName = uniqid().$time.'.'.$extt;
                                                move_uploaded_file($tmp, $imagesDIR.$imgName);

                                          }else{
                                    echo $funClass->response('error','image','image size should be less than 1m','');

                                          }
                                }else{
                         echo $funClass->response('error', 'image','this file type is not acceptable ','');
                                }
                          }//end if image

                          // insert data
$columns = "(`cat_id`, `name`, `price_before`, `price_after`, `about`, `image` , `available`, `time`)";
$values = "('$cat_id', '$proname', '$price', '$price1', '$aboutpro', '$imgName', '$available', '$time')";
$insertproduct = $productClass->newRow($table, $columns, $values);

                                         echo $funClass->response('success', 'msg',$insertproduct,'');

                      ///////////////////////////////////////////////////////////////////////////////////
                }else{
                 echo $funClass->response('error', 'name','length should be between 5 and 200 characters','');
                }
        }else{
              echo $funClass->response('error','name','this product name exists .....','');
        }

    // echo $funClass->response('success', 'msg',$image,'');
    


}elseif ($process==='edit') {



     // $exists =  $funClass->checkIfExist('name',$table,$proname);// sure it exsts
      // if(!$exists){
            $LEN =  $funClass->validateLength($proname,$min,$max);
                 if(!$LEN){
                    ///////////////////////////////////////////////////////////////////////////////////
$imgName=$_POST['old_img'];
$row_id =$_POST['row_id'];
                          if($image){
                                 $allowed = array('jpg', 'jpeg', 'png', 'gif');
                                 $validateAllowed = $funClass->validateAllowed($image,$allowed);
                                if(!$validateAllowed){
                                          $validateSize = $funClass->validateSize($image,(1 * 1024*1024 )/1);//$maxFileSize 1m = (1 * 1024 * 1024)
                                          if(!$validateSize){ // no error

                                            if($imgName && $imgName!=='default.jpg'){
                                                $old_img_path = $imagesDIR.$imgName; //delete old
                                                 unlink($old_img_path);
                                            }
                                                $tmp = $image['tmp_name'][0];
                                                $originName = $image['name'][0];
                                                $Ext = explode('.', $originName);
                                                $extt = strtolower(end($Ext));
 /* if img new $imgName   ===>  */              $imgName = uniqid().$time.'.'.$extt;
                                                move_uploaded_file($tmp, $imagesDIR.$imgName);

                                          }else{
                                    echo $funClass->response('error','image','image size should be less than 1m','');

                                          }
                                }else{
                         echo $funClass->response('error', 'image','this file type is not acceptable ','');
                                }
                          }//end if image

                          // update data

$newData = "cat_id='$cat_id', name='$proname', price_before='$price', price_after='$price1', about='$aboutpro', image='$imgName', available='$available', time='$time'";

$editproduct = $productClass->editRow($table, $newData,$row_id);

                                         echo $funClass->response('success', 'msg',$editproduct,'');

                      ///////////////////////////////////////////////////////////////////////////////////
                }else{
                 echo $funClass->response('error', 'name','length should be between 5 and 200 characters','');
                }
        // }else{
        //       echo $funClass->response('error','name','this product name exists .....','');
        // }

    // echo $funClass->response('success', 'msg',$image,'');






}elseif($process==='delete'){
    $product_id = $_POST['row_id']; //only on del_id not row_id////s
    $delproduct = $productClass->deleteRow($table,$product_id);
    echo $funClass->response('success', 'msg',$delproduct,'');


}else{
        echo $funClass->response('success', 'msg','nooooooo av= '.$aboutpro,'');

}




////

}
?>
