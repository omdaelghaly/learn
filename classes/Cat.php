<?php
 require_once 'Env.php';

class Cat extends Env{

// //save newcat
    public function newRow($table,$columns,$values)
    {

         $sql = "INSERT INTO $table $columns VALUES $values ";

            if (mysqli_query($this->connect(),$sql)=== false) {
               die('Error: ' );
            }else{
              return 'data inserted>>>>';

         }

        
    }
///////////////get cats//////////////////////////
    public function getCats()
    {
        $query = "SELECT * FROM cats  ORDER BY time DESC";

          $result = mysqli_query($this->connect(),$query);
          if(!$result){
                  return [];
          }
          //var_dump($result);
  if($result){
          $cats = [];
          $i=1;
          while ($row = mysqli_fetch_assoc($result)) {
              $cat_id = $row['id'];
              if (!isset($cats[$cat_id])) {
                  $cats[$cat_id] = [
                      'id' => $cat_id,
                      'name' => $row['name'],
                      'user_id' => $row['user_id'],
                      'time' => $row['time'],
                      'parent_id' => $row['parent_id'],
                      'index' => $i,
                  ];
              }
              $i++;
          }

          mysqli_free_result($result); // Free result set
         return $cats;

        //   var_dump($posts);
 }


    }


    public function getsubcats( $parent_id = 0, ) {
       $query = "SELECT * FROM cats WHERE parent_id='$parent_id'  ORDER BY time DESC";
        $result = mysqli_query($this->connect(), $query);
        if (!$result) {
            return [];
        }

        $cats = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $catId = $row['id'];

            $cat = [
                'id' => $catId,
                'user_id' => $row['user_id'],
                'name' => $row['name'],
                'time' => $row['time'],

                'subcats' => $this->getsubcats( $catId), // Recursive call for child cats
            ];


            $cats[] = $cat;
        }

        mysqli_free_result($result); // Free result set
        return $cats;
    }

///////////////get cats//////////////////////////
    public function getCatsx($condition)
    {
        $query = "SELECT * FROM cats WHERE $condition ORDER BY time DESC";

          $result = mysqli_query($this->connect(),$query);
          if(!$result){
                  return []; 
          }
          //var_dump($result);
  if($result){
          $cats = [];
          $i=1;
          while ($row = mysqli_fetch_assoc($result)) {
              $cat_id = $row['id'];
              if (!isset($cats[$cat_id])) {
                  $cats[$cat_id] = [
                      'id' => $cat_id,
                      'name' => $row['name'],
                      'user_id' => $row['user_id'],
                      'time' => $row['time'],
                      'parent_id' => $row['parent_id'],
                      'index' => $i,
                  ];
              }
              $i++;
          }
      
          mysqli_free_result($result); // Free result set
         return $cats;

        //   var_dump($posts);
 }


    }
////////////////////////////////////updat cats//////////////////////////
 public function editRow($table,$newData,$id)
    {
        $query = "UPDATE $table SET $newData WHERE id = $id";
        $result_query = mysqli_query($this->connect(),$query);
        if($result_query){
             return '';
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

    public function __destruct() {
        // Close database connection
        $this->connect()->close();
    }
}



?>
