<?php
 require_once 'Env.php';

class Product extends Env{

// //save newProduct
    public function newRow($table,$columns,$values)
    {

         $sql = "INSERT INTO $table $columns VALUES $values ";

            if (mysqli_query($this->connect(),$sql)=== false) {
               die('Error: ' );
            }else{
              return 'oookk';

         }

        
    }

///////////////get cats//////////////////////////
    public function getProducts($cat_id,$select)
    {
    switch ($select) {
        case 1:
            $orderx = " ORDER BY time DESC";
            break;
        case 2:
            $orderx = " ORDER BY time ASC";
            break;
        case 3:
            $orderx = " ORDER BY price_after DESC";
            break;
        case 4:
            $orderx = " ORDER BY price_after ASC";
            break;
        default:
            $orderx = " ORDER BY time DESC";
    };
         $query = "SELECT * FROM products WHERE cat_id='$cat_id' $orderx";
         $result = mysqli_query($this->connect(),$query);
          if(!$result){
                  return []; 
          }
          //var_dump($result);
  if($result){
          $products = [];
          $i=1;
          while ($row = mysqli_fetch_assoc($result)) {
              $product_id = $row['id'];
              if (!isset($products[$product_id])) {
                  $products[$product_id] = [
                      'id' => $product_id,
                      'cat_id' => $row['cat_id'],
                      'name' => $row['name'],
                      'price_before' => $row['price_before'],
                      'price_after' => $row['price_after'],
                      'about' => $row['about'],
                      'image' => $row['image'],
                      'available' => $row['available'],
                      'time' => $row['time'],
                      'index' => $i,
                  ];
              }
              $i++;
          }
          mysqli_free_result($result); // Free result set
         return $products;

        //   var_dump($posts);
 }


    }
////////////////////////////////////updat cats//////////////////////////
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

////////////////////////////////////////deletrow/////////////
 public function deleteRow($table,$id)
    {

                $sql = "DELETE FROM $table WHERE id = $id";
                $result = mysqli_query($this->connect(),$sql);
                if($result){
                        return 'deleteRow successfully';
               }else{
               }
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
