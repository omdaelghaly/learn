<?php
// // session_start();
 include('./../../classes/All.php');

 $catClass = new Cat();
 $funClass = new Fun();

$cats=$catClass->getCatsx('parent_id=0');

?>

<!-- Button trigger modal -->
<button type="button" hidden class="btn btn-primary addcats" data-bs-toggle="modal" data-bs-target="#exampleModaladdcats">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModaladdcats" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <div class="col text-center">
        <h5 class="modal-title addcatstitle" id="exampleModalLabel">Modal title</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <!-- ====================================================================================== -->
        <form action="" id="catsform">

          <div class="modal-body">
            <div class="mb-3" dir="rtl">

                  <div class="mb-3">
                    <label class="mx-2" >
                      <input type="radio" name="optionsCat" value="1" checked > قسم رئيسى
                    </label>
                    <label>
                      <input type="radio" name="optionsCat" value="2"> قسم فرعى
                    </label>
                  </div>

                  <div class="mb-3" id="selectCatDiv" style="display:none ;">
                   <label for="newdata" class="form-label">  اختر القسم التابع ليه   </label>
                    <select class="form-control" id="selectCat" >
                      <?php
                         foreach ($cats as $cat) { ?>
                         <option value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?> </option>

                      <?php
                         }
                      ?>

                    </select>
                  </div>

              <label for="newdata" class="form-label">  اسم القسم    </label>
              <input type="text" class="form-control" name="newdata" id="newdata" placeholder="قسم جديد ...">
              <input type="text" class="form-control" name="process" id="process" hidden>
              <input type="number" class="form-control" name="row_id" id="row_id" hidden>
              <input type="text" name="table" id="table" value='' hidden  >
              <input type="number" name="parent_id" id="catparent_id" value='' hidden  >
            </div>
             <div class="invalid-feedback name-cat-error" >Error correct cat name !</div>


          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">  الغاء   </button>
            <button type="submit" class="btn btn-primary addcatsbtn"> حفظ  </button>
          </div>

        </form>
        <!-- ======================================================================================= -->

    </div>
  </div>
</div>


<script type="text/javascript">

        // Add change event listener to radio buttons
        var parent_id = $('#selectCat_id').val();

        $('input[type="radio"][name="optionsCat"]').change(function(){
            // Check if the value of the selected radio button is '2'
            if ($(this).val() === '2') {
                $('#selectCatDiv').show(); // Show the select Cat
                parent_id = $('#selectCat').val();
                $('#catparent_id').val(parent_id); //parentid
            } else {
                $('#selectCatDiv').hide(); // Hide the select Cat
                parent_id = 0;
                $('#catparent_id').val(parent_id); //parentid

            }
        });

          $('#selectCat').change(function(){
              parent_id=$('#selectCat').val();
              $('#catparent_id').val(parent_id); //parentid
          });

//////insert cat///////////////////////////////////
     $('.addcatsbtn').prop('disabled', true);
      $(document).ready(function() {
        $('.addcatsbtn').prop('disabled', false);
          $('#catsform').submit(function(e) {
              e.preventDefault(); // Prevent normal form submission
              $('.addcatsbtn').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      ... `);

               parent_id = $('#catparent_id').val();
              var formData = new FormData(this);
                  formData.append('parent_id',parent_id);
                  /// alert(parent_id);
        //console.log(formData);

              $.ajax({
                  url: './../../controllers/catsController.php',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    var res = JSON.parse(response);
                    if(res.status==='error'){
                     $('.addcatsbtn').prop('disabled', false).removeClass('disabled').html('حفظ القسم ');
                      //console.log(res.msg.name);
                      $('.name-cat-error').html(res.msg.name);
                      $('.name-cat-error').show();
                    }else{
                    $('.addcatsbtn').prop('disabled', false).removeClass('disabled').html('حفظ القسم ');
                    $('#newcat').val('');
                    $('.btn-close').click();
               loadPage('./cats.php','contentDash','GET',[]);/// load cats tables
                    }
                    //console.log(res);
                      //alert('Data saved successfully.');
                      // Additional code to handle the response if needed
                  },
                  error: function(xhr, status, error) {
                    $('.addcatsbtn').prop('disabled', false).removeClass('disabled').html('error');

                      alert('Error occurred. Please try again.');
                  }
              });
          });
      });
      /////////////////////////////////////////////////////////////////////////////////////




</script>
