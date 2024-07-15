<?php
 require_once './../classes/All.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $catClass = new Cat();
    // use fun
    $funClass = new Fun();
    $env= new Env();
   
////  
session_start();
$process = $_POST['process'];
$time=time();
$user_id = $_SESSION['id'];
$table = $_POST['table'];
$min=5;
$max=200;





// /////////////////////////add////////////////////////////////
if($process==='add'){
    $newcat = $_POST['newdata'];
    $parent_id = $_POST['parent_id'];
    $columns="(`user_id`,`name`,`time`,`parent_id`)";
    $values = "('$user_id','$newcat','$time','$parent_id')";
    $exists =  $funClass->checkIfExistCat('name',$table,$newcat,$parent_id);
       if(!$exists){
            $LEN =  $funClass->validateLength($newcat,$min,$max);
                 if(!$LEN){
                    $insertcat = $catClass->newRow($table,$columns,$values);
                     echo $funClass->response('success', 'msg',$insertcat,'');
                }else{
                 echo $funClass->response('error', 'name','length should be between 5 and 200 characters','');
                }
        }else{
           echo $funClass->response('error','name','this cat name exists .....','');
        }


}elseif($process==='edit'){

    $newcat = $_POST['newdata'];
    $parent_id = $_POST['parent_id'];
    $cat_id = $_POST['row_id'];
    $newData = "user_id='$user_id', name='$newcat', time='$time' , parent_id='$parent_id' ";
    $exists =  $funClass->checkIfExistCat('name',$table,$newcat,$parent_id);
       if(!$exists){
            $LEN =  $funClass->validateLength($newcat,$min,$max);
                 if(!$LEN){
                         $updatecat = $catClass->editRow($table,$newData,$cat_id);
                         echo $funClass->response('success', 'msg',$updatecat,'');
                }else{
                 echo $funClass->response('error', 'name','length should be between 5 and 200 characters','');
                }
        }else{
           echo $funClass->response('error','name','this data exists .....','');
        }


}elseif($process==='delete'){
    $cat_id = $_POST['row_id']; //only on del_id not row_id////s
    $delcat = $catClass->deleteRow($table,$cat_id);
    echo $funClass->response('success', 'msg',$delcat,'');


}else{
        echo $funClass->response('success', 'msg','nooooooo ddddddatttta','');

}



// // //Insert the post content into the database
// $sql = "INSERT INTO comments (`user_id`,`post_id`,`comment`,`time`) VALUES ('$user_id', '$post_id','$comment','$time')";
// $comment =  $mysqli->query($sql);

// if ($comment === TRUE) {
//     // Retrieve the ID of the last inserted row
//     $comment_id = $mysqli->insert_id;
// };
//  $data = ['user_id'=>$user_id,'post_id'=>$post_id,'comment_id'=>$comment_id];
 
//  echo $funClass->response('success', 'msg',$images,'');

// //  uploaded images

// if (!empty($images['name'][0])) {
//     $allowed = array('jpg', 'jpeg', 'png', 'gif');
//         $validateAllowed = $funClass->validateAllowed($images,$allowed);
//         if(!$validateAllowed){
//                 $validateSize = $funClass->validateSize($images,$maxImageSize);//$maxFileSize 500b = (1 * 1024 * 1024)/2
//                 if(!$validateSize){ // no error
//                       $commentClass->saveFile($images,$imagesDIR,$imagesTable,$i_columns,$data);
                                      
//                 }else{
//                     echo $funClass->response('success', 'msg','file size should be less than '.($maxImageSize/1024).' kb ( '.$validateSize.' )','');
//                 }
//         }else{
//             echo $funClass->response('success', 'msg','this file is not acceptable '.'('.$validateAllowed.')' ,'');

//         }
// }

// //upload files
// if (!empty($files['name'][0])) {
//     $allowed = array('pdf', 'doc', 'docx');
//         $validateAllowed = $funClass->validateAllowed($files,$allowed);
//         if(!$validateAllowed){
//                 $validateSize = $funClass->validateSize($files,$maxFileSize);//$maxFileSize 500b = (1 * 1024 * 1024)/2
//                 if(!$validateSize){ // no error
//                       $commentClass->saveFile($files,$filesDIR,$filesTable,$f_columns,$data);
                                      
//                 }else{
//                     echo $funClass->response('success', 'msg','file size should be less than '.($maxImageSize/1024).' kb ( '.$validateSize.' )','');
//                 }
//         }else{
//             echo $funClass->response('success', 'msg','this file is not acceptable '.'('.$validateAllowed.')' ,'');

//         }
// }



////
}
?>
