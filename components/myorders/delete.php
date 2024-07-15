
<!-- Button trigger modal -->
<button type="button" id="order-deleteu" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalDeleteu">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalDeleteu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> حذف عنصر </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" dir="rtl">  

      <input type="text" name="id" id="delete-idu" value='' hidden   >
      <input type="text" name="table" id="tableu" value=''   hidden >
      <input type="text" name="process" id="delete-processu" value='' hidden    >
                 يمكنك حذف الطلب قبل الموافقة عليه ...<br> هل انت متاكد انك تريد حذف عنصر ؟

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"> لا </button>
        <button type="button" class="btn btn-danger" id="delete-btnxu"> نعم </button>
      </div>
    </div>
  </div>
</div>

<script>


  $(document).ready(()=>{


        $('#delete-btnxu').click(()=>{
          var id= $('#delete-idu').val();
          var table = $('#tableu').val();
          var process = $('#delete-processu').val();
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
                               loadPage('./../../components/myorders/myorders.php','my_orders','GET',[]);


                        },
                        error: function(xhr, status, error) {

                            alert('Error occurred. Please try again.');
                        }
                    });
                });

      })






               

</script>
