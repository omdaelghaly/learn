<?php

include('./../../../classes/All.php');
session_start();

   $env = new Env;
   $funClass = new Fun;
   $productClass = new Product();

   $xcat_id= isset($_GET['xcat_id'])? $_GET['xcat_id'] :0 ;
   $pro_id= isset($_GET['pro_id'])? $_GET['pro_id'] :0 ;


   $product=$productClass->getRow('products','id',$pro_id);
 //   $fielddata=$productClass->getColumnData('cats','name',$xcat_id);

?>
<style type="text/css">
     .product-details {
      height: auto; /* Set the height of the details column to the full viewport height */

    }
    .product-image {
      position: sticky;
      top: 60px;
      height: 400px; /* Set the height of the image column to the full viewport height */
      object-fit: cover;
    }

</style>


<div class="container mt-2">
    <div class="row" dir="rtl">
<!--================================================right==================================================== -->
      <div class="col-lg-6 py-1 cont">
          <!-- Product image -->

        <img style="height:100vh" class="img-rounded card-img-top product-image oneproduct "  src="/assets/images/products/<?php echo isset($product['image'])?$product['image']:'default.jpg';?>">

      </div>
<!-- =============================================left====================================================== -->
      <div class="col-lg-6 py-1 cont">
        <!-- Product details -->

        <div class="card product-details oneproduct">
          <div class="card-body" dir="rtl">

            <div class="col text-center">
                <h5 class="card-title">
                      <?php echo isset($product['name'])?$product['name']:' بدون عنوان .... ';?>
                </h5>
            </div>
            <!--=============== info about=============================== -->
            <p> <?php echo isset($product['about'])?$product['about']:' لا يوجد بيانات  ...';?> </p>
            <br>
             <!-- ==================price================================== -->
          <div class=" text-heading mr-1 mt-1.5 text-sm font-semibold space-s-2 sm:text-base lg:mt-2.5 lg:text-lg
               fs-5 fw-bold">

             <div class="container">
                                 <span>السعر قبل الخصم  :</span>

              <del class="font-normal text-gray-800 sm:text-base mx-1">
              <?php echo '  '.isset($product['price_before'])?$product['price_before']:'' ?>  ج.م
              </del>

              <br>
                  <span>السعر بعد الخصم  :</span>
              <span class="mx-2 ">
               <?php echo '  '.isset($product['price_after'])?$product['price_after']:'' ?>  ج.م
              </span>

             </div>

          </div>

           <div class="col d-flex justify-content-between fs-5 p-1 m-1" style="background:pink">
               <span>تكلفة الشحن  </span> <span> 50 ج.م</span>
           </div>
           <div class="col d-flex justify-content-between fs-5 p-1 m-1" style="background:skyblue">
               <span> الاجمالى   </span> <span>
             <?php echo isset($product['price_after'])?(int)$product['price_after']+50:'' ?>  ج.م

                </span>
           </div>


           <!-- Add to Cart button or any other actions -->
           <hr>
        <!--===================================form========================================================  -->

              <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation p-2" novalidate id="formaddtochart">

                <div class="col-12 mb-2">
                  <label for="pro_num" class="form-label fs-3">عدد القطع المطلوبة </label>
                   <div class="d-flex" style="">
                       <span class="mx-2 fs-3 btnaddchart " id="pluss"><i class="bi bi-file-plus"></i></span>
                       <span class="mx-2 ">
                          <input type="number" class="form-control" id="pro_num" name="pro_num" value="1" style="width: 80px;" required>
                       </span>
                       <span class="mx-2 fs-3 btnaddchart " id="minuss"><i class="bi bi-file-minus"></i></span>
                   </div>
                  <div class="valid-feedback col text-center " id="pro_numv" dir="ltr">
                    Looks good!
                  </div>
                </div>

                <div class="col-12 mb-2">
                  <label for="name" class="form-label fs-3">الاسم كامل  </label>
                  <input type="text" class="form-control" id="name" name="name"
                  value="<?php echo isset($_SESSION['name'])? $_SESSION['name']:' ';?>" required>
                  <div class="valid-feedback col text-center " id="namev" dir="ltr" >
                    Looks good!
                  </div>
                </div>

                <div class="col-12 mb-2">
                  <label for="phone" class="form-label fs-3"> رقم التليفون  </label>
                  <input type="text" class="form-control" id="phone" name="phone"
                     value="<?php echo isset($_SESSION['phone'])? $_SESSION['phone']:'01012345678 ';?>" required>
                  <div class="valid-feedback col text-center " id="phonev" dir="ltr">
                    Looks good!
                  </div>
                </div>

                <div class="col-12 mb-2">
                  <label for="address" class="form-label fs-3">العنوان بالتفصيل </label>
                  <input type="text" class="form-control" id="address" name="address"
                  value="<?php echo isset($_SESSION['address'])? $_SESSION['address']:' استخدم الحروف والارقام فقط  ';?>" required>
                  <div class="valid-feedback col text-center " id="addressv" dir="ltr">
                    Looks good!
                  </div>
                </div>

                <input type="text" name="table" value="orders" hidden>
                <input type="number" name="pro_id" value="<?php echo isset($product['id'])? $product['id']:'';?>" hidden>




                <div class="col text-center btnaddchart">
                  <button class="btn btn-primary" id="btnsubmitaddtochart" type="submit">اضافة الى العربة  </button>
                </div>
              </form><!-- End Custom Styled Validation -->

                  <div class="valid-feedback col text-center " id="orderv" dir="ltr">
                    Looks good!
                  </div>

                  <div class="cookiesdiv"></div>
        <!-- ================================end form===================================================== -->
          </div>
        </div>

      </div>
<!--  -->
    </div>
  </div>


<style type="text/css">
  .cont{

  }
  .oneproduct{
    transition: transform 0.3s ease;
  }
  .oneproduct:hover {
    transform: scale(1.05);
    cursor:pointer ;
}
.btnaddchart{
    transition: transform 0.3s ease;
  }
  .btnaddchart:hover {
    transform: scale(1.05);
    cursor:pointer ;
}
</style>

<script type="text/javascript">
   $('#pluss').click(()=>{
      var x = $('#pro_num').val();
          if(Number(x) <99) {
              $('#pro_num').val((Number(x))+1);
              $('#pro_numv').html('looks good');
              $('#pro_numv').css('color', 'green') ;$('#pro_numv').show();
          }else{
            $('#pro_numv').html('numbers allowed from 1 to 99');
            $('#pro_numv').css('color', 'red') ;$('#pro_numv').show();
          }
   })
   $('#minuss').click(()=>{
      var x = $('#pro_num').val();
        if(Number(x) >1){
          $('#pro_num').val((Number(x))-1);
              $('#pro_numv').html('looks good');
              $('#pro_numv').css('color', 'green') ;$('#pro_numv').show();
        }else if(Number(x) ===1){
              $('#pro_numv').html('looks good');
              $('#pro_numv').css('color', 'green') ;$('#pro_numv').show();
        }else{
            $('#pro_numv').html('numbers allowed from 1 to 99');
            $('#pro_numv').css('color', 'red') ;$('#pro_numv').show();
        }
   })
  $('#pro_num').keyup(() => {
    var x = $('#pro_num').val();
    if (Number(x) < 1) {
        $('#pro_num').val(1);
    }else{
        x=x.slice(0,2);
        $('#pro_num').val(x);
     }
 });

$('#phone').on('input', () => {
    var x = $('#phone').val();
     vphone(x);
});


$('#name').on('input',() => {
    var name = $('#name').val();
     vname(name)
});


$('#address').on('input',() => {
    var address = $('#address').val();
     vaddress(address);
});


function vphone(x){
      var phone = x.replace(/\D/g, ''); // Remove non-digit characters
    if (phone.length > 11) {
        phone = phone.slice(0, 11);
        $('#phone').val(phone);
        $('#phonev').html('Phone number must be 11 numbers');
        $('#phonev').css('color', 'green');
        $('#phonev').show();
        return true;
    } else if (phone.length < 11) {
        $('#phone').val(phone);
        $('#phonev').html('Phone number must be 11 numbers');
        $('#phonev').css('color', 'red');
        $('#phonev').show();
        return false;
    } else {
        $('#phone').val(phone);
        $('#phonev').html('Looks good');
        $('#phonev').css('color', 'green');
        $('#phonev').show();
        return true;
    }
}





function vname(name){
var arabicAndEnglishRegex = /^[\p{L}\s]+$/u;
//alert(name);
  if(name.length < 50 && name.length >=8){
    if (!arabicAndEnglishRegex.test(name)) {
         $('#namev').html('only letters , spaces are allowed.......');
         $('#namev').css('color', 'red') ;$('#namev').show();
         //var xname=name.replace(/[^a-zA-Z\s]/g, '')

         return false;
       }else{
            if(name.length>=8){
              $('#namev').html('looks good .......');
              $('#namev').css('color', 'green') ;$('#namev').show();
              return true;
            }else{
                  $('#namev').html('');
                  return false;
            }
       }
   }else{
         $('#namev').html('name character should be 8 to 50 characters');
         $('#namev').css('color', 'red') ;$('#namev').show();
         return false;
   }
}




function vaddress(address){
      var arabicAndEnglishRegex2 = /^[\p{L}\d\s]+$/u;//numbers/letters/spaces
  if(address.length <100 && address.length >10){
    if (!arabicAndEnglishRegex2.test(address)) {
         $('#addressv').html('only letters ,numbers, spaces are allowed.......');
         $('#addressv').css('color', 'red') ;$('#addressv').show();
         return false;
       }else{
            if(address.length>10){
              $('#addressv').html('looks good .......');
              $('#addressv').css('color', 'green') ;$('#addressv').show();
              return true;
            }else{
                  $('#addressv').html('');
                  return false;
            }
       }
  }else{
         $('#addressv').html('address character should be 8 to 100 characters');
         $('#addressv').css('color', 'red') ;$('#addressv').show();
         return false;
  }
 }
////////////////////////////////add to nav cart

function sendtocart(pro_id,user_id,q) {
  $.ajax({
         url: './../components/main/home/setcookies.php?user_id='+user_id+'&pro_id='+pro_id+'&q='+q,
         type: 'GET',
         success: function(response) {
                $('.cookiesdiv').html(response);
                //cart on nav
        loadPage('./../../components/main/home/navcookiesorder.php','nav_cookies_order','GET',[]);

             },
             error: function(xhr, status, error) {
              console.error(xhr.responseText);
           }
        });

 };
////////////////update user- my info/////////////////////


     $('#btnsubmitaddtochart').prop('disabled', true);
      $(document).ready(function() {
        $('#btnsubmitaddtochart').prop('disabled', false);
          $('#formaddtochart').submit(function(e) {
              e.preventDefault(); // Prevent normal form submission

              var myauth = '<?php echo isset($_SESSION['id'])? $_SESSION['id']:'';?>';
               if(myauth){
                var pro_id = '<?php echo $pro_id;?>';
                var user_id= '<?php echo $_SESSION['id'] ?>';
                var q      = $('#pro_num').val();
                    var x = $('#phone').val();
                    var name = $('#name').val();
                    var address = $('#address').val();
                    var vn = vname(name);
                    var va = vaddress(address);
                    var vp = vphone(x);
                  if(vn && va && vp){
             $('#btnsubmitaddtochart').prop('disabled', true).addClass('disabled').html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                      ... `);

              var formData = new FormData(this);
                  formData.append('process','updateuser');

        //console.log(formData);

              $.ajax({
                  url: './../controllers/orderController.php',
                  type: 'POST',
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    var res = JSON.parse(response);

                    sendtocart(pro_id,user_id,q);

                    if(res.status==='success'){
                    $('#btnsubmitaddtochart').prop('disabled', false).removeClass('disabled').html('اضف الى العربة ');
                      $('#orderv').html('تم ارسال الطلب بنجاح .... ');$('#orderv').css('color','green');
                      $('#orderv').show();
                    }else{
                    $('#btnsubmitaddtochart').prop('disabled', false).removeClass('disabled').html('اضف الى العربة ');
                    $('#orderv').html('حدث خطا  حاول مرة اخرى ... ');$('#orderv').css('color','red');
                      $('#orderv').show();
                     }
                      setTimeout(()=>{
                         $('#orderv').html('');
                      },15000)
                    console.log(res);
                     loadPage('./../../components/myorders/nav_orders_list.php','nav_orders_list','GET',[]);

                  },
                  error: function(xhr, status, error) {
                    $('.addcatsbtn').prop('disabled', false).removeClass('disabled').html('error');

                      alert('Error occurred. Please try again.');
                  }
              });//end ajax

                     //alert('  اعتقد الكل صحيح   ');

                 }else{
                     alert(' قم بتصحيح الخطا اولا ........... ');
                 }

              }else{ //no auth
                  alert(' يجب عليك تسجيل الدخول حتى تتمكن من متابعة الطلب ....   ');
              }


           });
      });







</script>
