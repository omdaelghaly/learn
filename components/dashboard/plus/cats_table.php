
<?php
// // session_start();
 include('./../../../classes/All.php');

 $catClass = new Cat();
 $funClass = new Fun();

   $cattype= isset($_GET['cattype'])? $_GET['cattype'] :0 ;
   if((int)$cattype===1){
     $cats=$catClass->getCatsx('parent_id=0');
   }elseif((int)$cattype===2){
     $cats=$catClass->getCatsx('parent_id!=0');
   }else{
     $cats=$catClass->getCats();
   }


?>


<table class="table table-striped">
  <thead class="table-secondary">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Updated</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <!-- Table rows will be dynamically added here -->
    <?php
        foreach($cats as $cat){

    ?>
    <tr>
      <th scope="row"><?php echo $cat['index'];?></th>
      <td class="width-td"><?php echo $cat['name'];?></td>
      <td><?php echo $funClass->getTime($cat['time'])  ?></td>
      <td>
   <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown">
                <!-- <i class="bi bi-three-dots"></i> --> <i class="fas fa-ellipsis-v"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="cursor: pointer;">

      <li><a class="dropdown-item" onclick="editcat('<?php echo $cat['name'];?>' ,'<?php echo $cat["id"];?>','<?php echo (isset($cat['parent_id'])&& $cat['parent_id']!=0)?$cat['parent_id']:0  ;?>')" href="#">edit</a></li>
      <li><a class="dropdown-item" onclick="deletecat('<?php echo $cat['id'];?>')" href="#">delete</a></li>
    </ul>
  </div>

      </td>
    </tr>


    <?php
        }
    ?>
    <!-- Additional rows can be added similarly -->
  </tbody>
</table>
