
<!-- Button trigger modal -->
<button type="button" id="delx" hidden class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModaldelx">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModaldelx" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col text-center">
        <h5 class="modal-title delx-title" id="exampleModalLabel">Modal title</h5>
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" dir="rtl">  

      <input type="text" name="del_id" id="del_id" value='' hidden >
      <input type="text" name="del_table" id="del_table" value='' hidden >
      <input type="text" name="del_process" id="del_process" value='' hidden >
      <input type="text" name="urldel" id="urldel" value='' hidden >
      <input type="text" name="cat_id" id="cat_id" value='' hidden >
           سيتم حذف هذا العنصر . هل انت متاكد؟
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal"> لا </button>
        <button type="button" class="btn btn-danger" id="delx-btn"> نعم </button>
      </div>
    </div>
  </div>
</div>

<script>    

 $(document).ready(()=>{



        $('#delx-btn').click(()=>{
          var id= $('#del_id').val();
          var cat_id= $('#cat_id').val();
          var table= $('#del_table').val();
          var processx= $('#del_process').val();
          var formData = new FormData();
          formData.append('row_id',id);
          formData.append('process',processx);
          formData.append('table',table);
          $('.btn-close').click();
          // console.log(id +'----'+table);
          // $('#'+status+id).hide();
               let xpage;
               let xdiv;
                if(table ==='cats'){
                  xurl='./../../controllers/catsController.php';
                  xpage ='./cats.php';
                  xdiv='cats_table';
                }else if(table==='products'){
                  xurl='./../../controllers/productsController.php';
                  xpage ='./products.php';
                  xdiv='products_table';
                }
                    $.ajax({
                        url: xurl,
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                          // cats.php
                        if(table==='cats'){
                          loadPage(xpage,'contentDash','GET',[]);/// load cats tables
                        }else if(table==='products'){
                      loadPage('./../dashboard/plus/products_table.php?xcat_id='+cat_id+'&selectedval='+1,'products_table','GET',[]);/// onchange
                        }
                          var res = JSON.parse(response);
                                console.log(res);
                        },
                        error: function(xhr, status, error) {
            
                            alert('Error occurred. Please try again.');
                        }
                    });
                });
         
              
            });
               

</script>
