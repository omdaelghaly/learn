<?php
 require_once 'Env.php';

class Order extends Env{

    public function newRow($table,$columns,$values)
    {

         $sql = "INSERT INTO $table $columns VALUES $values ";

            if (mysqli_query($this->connect(),$sql)=== false) {
               die('Error: ' );
            }else{
              return 'oookk';

         }


    }
    public function newRowArray($table,$orders)
    {
         foreach ($orders as $order) {
                   $user_id=$order['user_id'];
                   $pro_id=$order['pro_id'];
                   $pro_num=$order['q'];
                   $bill_num=time();
                   $time=time();
                   $columns = "(`user_id`, `pro_id`, `pro_num`,`bill_num`, `time`)";
                   $values = "('$user_id', '$pro_id', '$pro_num', '$bill_num','$time')";

               $sql = "INSERT INTO $table $columns VALUES $values ";
               if (mysqli_query($this->connect(),$sql)=== false) {
                     die('Error: ' );
               }
         }
                 setcookie('order', '', (time()-3600), '/');
                 unset($_COOKIE['order']);

                     return 'order saved in db and clear cookies';
        
    }
    ////////////////////////////////////updat order//////////////////////////
 public function editRow($table,$newData,$id)
    {
        $query = "UPDATE $table SET $newData WHERE id = $id";
        $result_query = mysqli_query($this->connect(),$query);
        if($result_query){
             return true;
        }else{
            return '';
        }
    }

///////////////get order//////////////////////////
    public function getorders($id)
    {
      if(!$id){
         $q = "SELECT * FROM orders ORDER BY time DESC ";
      }else{
         $q = "SELECT * FROM orders WHERE user_id='$id'ORDER BY time DESC ";
      }

         $res = mysqli_query($this->connect(),$q);
          if(!$res){
                  return []; 
          }
          //var_dump($result);
  if($res){
          $orders = [];
          $i=1;
          while ($row = mysqli_fetch_assoc($res)) {
              $order_id = $row['id'];
              if (!isset($orders[$order_id])) {
                  $orders[$order_id] = [
                      'id' => $order_id,
                      'user_id' => $row['user_id'],
                      'pro_id' => $row['pro_id'],
                      'pro_num' => $row['pro_num'],
                      'bill_num' => $row['bill_num'],
                      'time' => $row['time'],
                      'status' => $row['status'],
                      'index' => $i,
                  ];
              }
              $i++;
          }
          mysqli_free_result($res); // Free result set
         return $orders;

 }


    }


////////////////////////////////////////deletrow/////////////
 public function getData($table,$column,$columnData)
{
    $mysqli=  $this->connect();
    $sql =  "SELECT * FROM $table WHERE $column = '$columnData'";
    $rows=  $mysqli->query($sql);

    if($rows){
        return $rows ; /// exists
    }else{
        return []; // not exist
    }
}
///////////////////////
 public function deleteRow($table,$id)
    {
                // $sql = "DELETE FROM $table WHERE id = $id";
                // $result = mysqli_query($this->connect(),$sql);
                // if($result){
                        return 'deleteRow successfully';
               // }else{
               //    return ;
               // }
    }
/////////////////////////////////////////////////
public function getColumnData($table,$column,$id)
{
    $mysqli=  $this->connect();
    $sql =  "SELECT * FROM $table WHERE id = '$id'";
    $rows=  $mysqli->query($sql);
    $data = mysqli_fetch_assoc($rows);

    // Return the number of rows
    if($data){
        return $data[$column] ; /// exists
    }else{
        return ''; // not exist
    }
}

public function getRow($table,$column,$id)
{
    $mysqli=  $this->connect();
    $sql =  "SELECT * FROM $table WHERE $column = '$id'";
    $rows=  $mysqli->query($sql);
    $data = mysqli_fetch_assoc($rows);

    // Return the number of rows
    if($data){
        return $data; /// exists
    }else{
        return ''; // not exist
    }
}

 //////////////////////////////////////////////

    public function __destruct() {
        // Close database connection
        $this->connect()->close();
    }
}



?>
