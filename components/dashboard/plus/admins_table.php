
<?php
// // session_start();
 include('./../../../classes/All.php');

 $catClass = new Cat();
 $funClass = new Fun();
 $userClass = new User();


  $table= isset($_GET['table'])?$_GET['table'] :0 ;
  $column= isset($_GET['column'])?$_GET['column'] :0 ;
  $columnData= isset($_GET['columnData'])?$_GET['columnData'] :0 ;
  $email= isset($_GET['email'])?$_GET['email'] :0 ;
  $level= isset($_GET['level']) && is_numeric($_GET['level'])? intval($_GET['level']) :0 ;

$infos=$userClass->getData($table,$column,$columnData);

if($infos){
?>
<style type="text/css">
  .admin{
    background-color:orange ;
  }
</style>


<table class="table table-striped">
  <thead class="table-secondary">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">email</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <!-- Table rows will be dynamically added here -->
    <?php
        foreach($infos as $info){

    ?>
    <tr >
      <th scope="row"><?php echo $info['index'];?></th>
      <td class="width-td"><?php echo $info['name'];?></td>
      <td class="width-td"><?php echo $info['email'];  ?></td>
      <td class="d-flex justify-content-between">
   <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown">
                <!-- <i class="bi bi-three-dots"></i> --> <i class="fas fa-ellipsis-v"></i>
    </a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="cursor: pointer;">


      <li>
        <a class="dropdown-item" id="<?php echo 'set_'.$info['id'] ?>" onclick="setlevel('<?php echo $info['id'];?>')" href="#">
          <?php echo (isset($info['level'])&&$info['level']==1)?'set_user':'set_admin' ?>

        </a>
      </li>
    </ul>
  </div>

  <div class="p-0 m-0" style="color:blue" id="<?php echo 'checked_'.$info['id'] ?>" >
    <?php echo (isset($info['level'])&&$info['level']==1)?'<i class="fas fa-check-circle"></i>':'' ?>
  </div>

      </td>
    </tr>


    <?php
        }
    ?>
  </tbody>
</table>
 <?php
        }else{?>

                <div class="col text-center " >
                        لم يتم العثور على اى بيانات .....
                </div>
  <?php
        }
    ?>




    <!-- =========== -->
<script type="text/javascript">

function setlevel(u_id) {
              $.ajax({
                  url: './../../controllers/usersController.php',
                  type: 'POST',
                  data: {'u_id':u_id},
                  success: function(response) {
                    var res = JSON.parse(response);
                    let eltext = $('#set_'+u_id).text();
                    if(eltext.trim()==='set_user'){  //now he is admin
                         $('#set_'+u_id).text('set_admin');
                         $('#checked_'+u_id).html('');
                    }else if(eltext.trim()==='set_admin'){ // now he is user
                         $('#set_'+u_id).text('set_user');
                         $('#checked_'+u_id).html(`<i class="fas fa-check-circle"></i>`);
                    }else{
                    console.log('error');
                    }
                  },
                  error: function(xhr, status, error) {
                      alert('Error occurred. Please try again.');
                  }
              });


}

</script>
