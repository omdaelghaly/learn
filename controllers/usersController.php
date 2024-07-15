<?php
 require_once './../classes/All.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userClass = new User();
    $funClass = new Fun();

session_start();
$time=time();
$user_id = $_SESSION['id'];
$u_id =$_POST['u_id'];


$set = $userClass->setlevel($u_id);

echo $funClass->response('success', 'msg',$set,'');


////
}
?>
