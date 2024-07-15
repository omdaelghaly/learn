<?php
$catClass = new Cat();
$funClass = new Fun();

$cats=$catClass->getCats();

?>

<div id="textmodal">

</div>

<!-- Button trigger modal -->
<button type="button" hidden class="btn btn-primary addproducts" data-bs-toggle="modal" data-bs-target="#exampleModaladdproducts">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModaladdproducts" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header ">
        <div class="col text-center">
        <h5 class="modal-title addproductstitle" id="exampleModalLabel">Modal title</h5>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <!-- ====================================================================================== -->
        <form action="" id="productsform" enctype="multipart/form-data" >

          <div class="modal-body">
            <div class="mb-3" dir="rtl">

              <label for="cat_id" class="form-label"> اختر القسم </label>
              <div class="form-control border-0 p-0 m-0">
                <select class="form-select" id='cat_id' name="cat_id" aria-label="Default select example">
                  <?php
                  foreach ($cats as $cat) {
                    ?>
                    <option value="<?php echo $cat['id'] ?>"> <?php echo $cat['name'] ?></option>
                    <?php
                  }
                  ?>

                </select>
              </div>


            <label for="proname" class="form-label mt-2"> اسم المنتج    </label>
            <input type="text" class="form-control" name="proname" id="proname" placeholder="اسم المنتج ...">
            <div class="invalid-feedback col text-center name-products-error" ></div>

            <label for="price" class="form-label mt-2"> السعر قبل الخصم   </label>
            <input type="text" class="form-control" name="price" id="price" placeholder="00.00">
              <div class="invalid-feedback col text-center price-products-error" ></div>

            <label for="price1" class="form-label mt-2"> السعر الحالى    </label>
            <input type="text" class="form-control" name="price1" id="price1" placeholder="00.00">
              <div class="invalid-feedback col text-center price-products-error" ></div>
<!-- textarea -->
            <label for="aboutpro" class="form-label mt-2"> تفاصيل المنتج   </label>
            <!-- <textarea type="text" class="form-control" name="aboutpro" id="aboutpro" placeholder="عن المنتج .... ">
            </textarea> -->
            <div type="text" style="height:100px;overflow-y:scroll ;" class="form-control" name="aboutpro" id="aboutpro" placeholder="عن المنتج .... ">

            </div>

                   <div class="p-0 m-0">
                   <div  class="btn btn-sm btn-secondary" onclick="loadtextmodal()" id="btnaddnewtext">اضف معلومات عن المنتج </div>
                 </div>


<!--  -->
            <input type="text" class="form-control" name="process" id="process" hidden>
            <input type="number" class="form-control" name="row_id" id="row_id" hidden>
            <input type="text" name="table" id="table" value='' hidden  >
            <input type="text" name="old_img" id="old_img" value='' hidden  >
            <input type="number" name="available" id="available" value='' hidden >

            <div class="row mb-3 mt-2">
              <label for="image" class="form-label">رفع صورة للمنتج  </label>

              <input class="form-control" name="image[]" type="file" id="image" accept="image/*" >
            <div class="invalid-feedback col text-center imag-products-error" ></div>
            </div>

                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="availableChecked" checked>
                      <label class="form-check-label" for="availableChecked">
                        <span style="color:green">available</span>
                      </label>
                    </div>

          </div>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">  الغاء   </button>
          <button type="submit" class="btn btn-primary addproductsbtn"> حفظ  </button>
        </div>

      </form>
        <!-- ======================================================================================= -->


    </div>
  </div>
</div>

<style type="text/css">
  #exampleModaladdtext{
    z-index:1090 !important ;
  }
</style>


<script type="text/javascript">
//////insert products///////////////////////////////////
   $('#availableChecked').change(function() {
        if ($(this).prop('checked')) {
                $('#available').val(1);
            $('.form-check-label').html('<span style="color:green">available</span>');
        } else {
              $('#available').val(0);
            $('.form-check-label').html('<span style="color:red">unavailable</span>');
        }
    });
     $('.addproductsbtn').prop('disabled', true);
      $(document).ready(function() {
        $('.addproductsbtn').prop('disabled', false);
          $('#productsform').submit(function(e) {
              e.preventDefault(); // Prevent normal form submission
              $('.addproductsbtn').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      ... `);

               var about = $('#aboutpro').html();
              var formData = new FormData(this);
                   formData.append('aboutpro',about);
             let cat_id=$('#cat_id').val();
             let price =$('#price').val();
             let price1 =$('#price1').val();

           if(price.length < 10 && price1.length < 10){
             // console.log(formData);

              $.ajax({
                  url: './../../controllers/productsController.php',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    var res = JSON.parse(response);
                    if(res.status==='error'){
                    $('.addproductsbtn').prop('disabled', false).removeClass('disabled').html('حفظ القسم ');
                      //console.log(res.msg.name);
                      $('.name-products-error').html(res.msg.name);$('.name-products-error').show();
                      $('.image-products-error').html(res.msg.image);$('.image-products-error').show();
                    }else{
                    $('.addproductsbtn').prop('disabled', false).removeClass('disabled').html('حفظ القسم ');
                    $('#proname').val('');
                    $('.btn-close').click();
                   loadPage('./../dashboard/plus/products_table.php?xcat_id='+cat_id+'&selectedval='+selectedval,'products_table','GET',[]);/// onchange
                    $(document).ready(()=>{
                    $('#selectedcat').val(cat_id);
                   })
                    }
                   // console.log(res);
                      //alert('Data saved successfully.');
                      // Additional code to handle the response if needed
                  },
                  error: function(xhr, status, error) {
                    $('.addproductsbtn').prop('disabled', false).removeClass('disabled').html('error');

                      alert('Error occurred. Please try again.');
                  }
              });

                       }else{
                       $('.price-products-error').html('اختر السعر المناسب ....');$('.price-products-error').show();
                       $('.addproductsbtn').prop('disabled', false).removeClass('disabled').html('حفظ القسم ');


                       }

          });


      });
      /////////////////////////////////////////////////////////////////////////////////////

   // $(document).ready(()=>{
   //  $('#btnaddnewtext').click(()=>{
   //    $('#addnewtext').click();
   //    $('#edit').focus();
   // });
   // });




    // document.querySelector('#newline')
    //     .addEventListener('click', event => {
    //         let area = document.getElementById('aboutpro');
    //         area.value += '<br>';
    //         area.focus();

    //     });

            function loadtextmodal(){
              $.ajax({
                  url: './plus/addtext.php',
                  type: 'GET',
                  data: {},
                  success: function(response) {
                              $('#textmodal').html(response);
                             // $('#addnewtext').click();
                             let myModal = new
                bootstrap.Modal(document.getElementById('exampleModaladdtext'), {});
                     myModal.show();
                    // var res = JSON.parse(response);
                    // console.log(res);
                  },
                  error: function(xhr, status, error) {
                      alert('Error occurred. Please try again......');
                  }
              });
          }





</script>

