
<!-- Button trigger modal -->
<button type="button" id="order-delete" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDelete">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> حذف عنصر </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" dir="rtl">  

      <input type="text" name="post_id" id="post-id" value='' hidden  >
      <input type="text" name="id" id="delete-id" value=''   >
      <input type="text" name="table" id="table" value=''   >
      <input type="text" name="process" id="delete-process" value=''   >
                 يمكنك حذف الطلب قبل الموافقة عليه ...<br> هل انت متاكد انك تريد حذف عنصر ؟

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"> لا </button>
        <button type="button" class="btn btn-danger" id="delete-btnx"> نعم </button>
      </div>
    </div>
  </div>
</div>

<script>    




        $('#delete-btnx').click(()=>{
          var id= $('#delete-id').val();
          var table = $('#table').val();
          var process = $('#delete-process').val();
          var formData = new FormData();
          formData.append('table',table);
          formData.append('id',id);
          formData.append('process',process);
          $('.btn-close').click();


                    $.ajax({
                        url: './../../controllers/orderController.php',
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                          var res = JSON.parse(response);
                          console.log(res);
                            //alert('Data saved successfully.');
                            // Additional code to handle the response if needed
                        },
                        error: function(xhr, status, error) {
            
                            alert('Error occurred. Please try again.');
                        }
                    });
                });
         
              
            




               

</script>
